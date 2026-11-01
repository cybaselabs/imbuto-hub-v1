"""Render a Caddy candidate for the inspected private container IP; no I/O or deployment."""
import ipaddress
import sys


def render(address):
    ip = ipaddress.IPv4Address(address)
    allowed = ("10.0.0.0/8", "172.16.0.0/12", "192.168.0.0/16")
    if not any(ip in ipaddress.IPv4Network(network) for network in allowed):
        raise ValueError("An RFC1918 private Docker container IPv4 address is required")
    return (
        "# Rendered candidate; validate and preserve the existing Caddyfile before activation.\n"
        "imbutohub.com, www.imbutohub.com {\n"
        "    encode zstd gzip\n"
        f"    reverse_proxy {ip}:3000\n"
        "}\n"
    )


if __name__ == "__main__":
    try:
        if len(sys.argv) != 2:
            raise ValueError("Provide exactly the inspected private container IPv4 address")
        result = render(sys.argv[1])
    except ValueError:
        sys.exit("A single RFC1918 private Docker container IPv4 address is required; no config rendered.")
    print(result, end="")
