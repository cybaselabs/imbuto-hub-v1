import { NextResponse, type NextRequest } from "next/server";
import { submissionsAllowed, allowedRequestHost, productionSiteOnly } from "./lib/local-preview-policy.cjs";

export function proxy(request: NextRequest) {
  const pathname = request.nextUrl.pathname;
  if (!allowedRequestHost(request.headers.get("host") || "", pathname)) {
    return new NextResponse("Allowed website host required", { status: 403 });
  }
  const developmentPost = ["/api/applications", "/api/get-involved"].includes(pathname) && request.method === "POST" && submissionsAllowed() && request.headers.get("origin") === "http://127.0.0.1:3016" && request.headers.get("x-imbuto-dev-test") === "1";
  if ((!["GET", "HEAD"].includes(request.method) && !developmentPost) ||
      (pathname.startsWith("/api/") && !developmentPost)) {
    return NextResponse.json({ error: "Submissions are currently unavailable.", preview: !productionSiteOnly() }, { status: 403 });
  }

  // Config redirects are case-insensitive; only normalize the legacy spelling.
  if (pathname === "/Programmes" || pathname.startsWith("/Programmes/")) {
    const destination = request.nextUrl.clone();
    destination.pathname = `/programmes${pathname.slice("/Programmes".length)}`;
    if (productionSiteOnly()) {
      destination.protocol = "https:";
      destination.host = request.headers.get("host")!;
      destination.port = "";
    }
    return NextResponse.redirect(destination, 308);
  }

  return NextResponse.next();
}

export const config = {
  matcher: "/((?!_next/static|_next/image|favicon.ico).*)",
};
