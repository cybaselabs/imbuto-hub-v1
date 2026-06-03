import type { Metadata } from "next";
import { GetInvolvedPageClient } from "./GetInvolvedPageClient";

export const metadata: Metadata = {
  title: "Get Involved",
  description:
    "Volunteer, mentor, partner, or support a programme through Imbuto Hubs.",
};

export default function GetInvolvedPage() {
  return <GetInvolvedPageClient />;
}
