import type { Metadata } from "next";
import { HubsPageClient } from "./HubsPageClient";

export const metadata: Metadata = {
  title: "Hubs",
  description:
    "Find the nearest Imbuto Hub and explore available programmes, facilities, status, and visit details.",
};

export default function HubsPage() {
  return <HubsPageClient />;
}
