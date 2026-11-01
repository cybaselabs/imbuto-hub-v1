import importlib.util
from pathlib import Path
import unittest

root = Path(__file__).resolve().parents[1]
spec = importlib.util.spec_from_file_location("production_proxy", root / "scripts/render-production-caddy.py")
renderer = importlib.util.module_from_spec(spec)
spec.loader.exec_module(renderer)


class ProxyRendererTests(unittest.TestCase):
    def test_only_private_container_upstream_and_fixed_public_domains(self):
        for address in ("172.18.0.2", "10.42.0.7", "192.168.100.2"):
            output = renderer.render(address)
            self.assertIn(f"reverse_proxy {address}:3000", output)
            self.assertIn("imbutohub.com, www.imbutohub.com", output)
            self.assertNotIn("1014", output)

    def test_rejects_public_loopback_metadata_and_configuration_injection(self):
        for address in ("201.79.35.46", "127.0.0.1", "169.254.169.254", "0.0.0.0", "::1", "172.18.0.2:3000", "172.18.0.2\nfile_server", "attacker.invalid", ""):
            with self.assertRaises(ValueError, msg=address):
                renderer.render(address)


if __name__ == "__main__":
    unittest.main()
