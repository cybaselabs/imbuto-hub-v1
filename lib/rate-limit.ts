import { createHash } from "node:crypto";

type RateLimitOptions = {
  limit: number;
  windowMs: number;
  prefix: string;
};

type RateLimitResult = {
  allowed: boolean;
  limit: number;
  remaining: number;
  resetAt: number;
};

type RedisCommandResult = {
  result?: number | string | null;
  error?: string;
};

type MemoryEntry = {
  count: number;
  expiresAt: number;
};

const memoryStore = new Map<string, MemoryEntry>();

function hashIdentifier(identifier: string) {
  return createHash("sha256").update(identifier).digest("hex").slice(0, 32);
}

function checkMemoryRateLimit(
  key: string,
  now: number,
  options: RateLimitOptions,
): RateLimitResult {
  if (memoryStore.size > 1_000) {
    for (const [entryKey, entry] of memoryStore) {
      if (entry.expiresAt <= now) memoryStore.delete(entryKey);
    }
  }

  const existing = memoryStore.get(key);
  const entry =
    existing && existing.expiresAt > now
      ? existing
      : { count: 0, expiresAt: now + options.windowMs };

  entry.count += 1;
  memoryStore.set(key, entry);

  return {
    allowed: entry.count <= options.limit,
    limit: options.limit,
    remaining: Math.max(options.limit - entry.count, 0),
    resetAt: entry.expiresAt,
  };
}

export async function checkRateLimit(
  identifier: string,
  options: RateLimitOptions,
): Promise<RateLimitResult> {
  const now = Date.now();
  const bucket = Math.floor(now / options.windowMs);
  const key = `${options.prefix}:${hashIdentifier(identifier)}:${bucket}`;
  const resetAt = (bucket + 1) * options.windowMs;
  const redisUrl = process.env.UPSTASH_REDIS_REST_URL?.replace(/\/$/, "");
  const redisToken = process.env.UPSTASH_REDIS_REST_TOKEN;

  if (!redisUrl || !redisToken) {
    return checkMemoryRateLimit(key, now, options);
  }

  try {
    const response = await fetch(`${redisUrl}/multi-exec`, {
      method: "POST",
      headers: {
        Authorization: `Bearer ${redisToken}`,
        "Content-Type": "application/json",
      },
      body: JSON.stringify([
        ["INCR", key],
        ["PEXPIRE", key, options.windowMs * 2, "NX"],
      ]),
      cache: "no-store",
      signal: AbortSignal.timeout(3_000),
    });

    if (!response.ok) {
      throw new Error(`Redis rate limit failed (${response.status}).`);
    }

    const results = (await response.json()) as RedisCommandResult[];
    const count = Number(results[0]?.result);

    if (!Number.isFinite(count) || results.some((result) => result.error)) {
      throw new Error("Redis returned an invalid rate-limit response.");
    }

    return {
      allowed: count <= options.limit,
      limit: options.limit,
      remaining: Math.max(options.limit - count, 0),
      resetAt,
    };
  } catch (error) {
    console.error("Persistent rate limit unavailable; using local fallback:", error);
    return checkMemoryRateLimit(key, now, options);
  }
}
