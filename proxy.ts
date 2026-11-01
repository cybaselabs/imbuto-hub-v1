import { NextResponse, type NextRequest } from "next/server";
import { isLocalOnly, submissionsAllowed } from "./lib/local-preview-policy.cjs";

export function proxy(request: NextRequest) {
  const pathname = request.nextUrl.pathname;
  if (isLocalOnly() && !/^(127\.0\.0\.1|localhost|\[::1\])(?::\d+)?$/i.test(request.headers.get("host") || "")) {
    return new NextResponse("Local preview host required", { status: 403 });
  }
  const developmentPost = ["/api/applications", "/api/get-involved"].includes(pathname) && request.method === "POST" && submissionsAllowed() && request.headers.get("origin") === "http://127.0.0.1:3016" && request.headers.get("x-imbuto-dev-test") === "1";
  if ((isLocalOnly() && !["GET", "HEAD"].includes(request.method) && !developmentPost) ||
      (pathname.startsWith("/api/") && !developmentPost)) {
    return NextResponse.json({ error: "Submissions are disabled in local preview.", preview: true }, { status: 403 });
  }

  // Config redirects are case-insensitive; only normalize the legacy spelling.
  if (pathname === "/Programmes" || pathname.startsWith("/Programmes/")) {
    const destination = request.nextUrl.clone();
    destination.pathname = `/programmes${pathname.slice("/Programmes".length)}`;
    return NextResponse.redirect(destination, 308);
  }

  return NextResponse.next();
}

export const config = {
  matcher: "/((?!_next/static|_next/image|favicon.ico).*)",
};
