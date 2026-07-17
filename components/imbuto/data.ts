import {
  Compass,
  HandHeart,
  MapPinned,
  Sparkles,
} from "lucide-react";
import { programmes } from "./programmes";

export const heroImage = "/images/55271563510_75dc1f389e_k.jpg";
export const programmeImage = "/images/gallery/55271554100_90f68fe6ac_k.jpg";
export const aboutImage = "/images/gallery/55271389639_c61707ed44_k.jpg";
export const lifeStageImage = "/images/gallery/55271554100_90f68fe6ac_k.jpg";
export const lifeStageImage2 = "/images/54513810799_7d0c00742c_k.jpg";
export const hubsImage = "/images/54945709915_c6b625f130_k.jpg";
export const hubsImage2 = "/images/55271563510_75dc1f389e_k.jpg";
export const ctaImage = "/images/gallery/55271389639_c61707ed44_k.jpg";

export const quickActions = [
  {
    title: "Register for a programme",
    href: "/apply",
    icon: MapPinned,
    subtitle: "Join an Imbuto Hub programme that fits your goals.",
  },
  {
    title: "Explore Programmes",
    href: "/Programmes",
    icon: Compass,
    subtitle: "Browse opportunities for learning, wellbeing, and growth.",
  },
  {
    title: "Register for a course",
    href: "/apply",
    icon: Sparkles,
    subtitle: "Tell us what you want to learn and we will guide you.",
  },
  {
    title: "Get Involved",
    href: "/get-involved",
    icon: HandHeart,
    subtitle: "Volunteer, mentor, partner, or support a programme.",
  },
];

export const pillars = programmes.map((programme) => ({
  title: programme.title,
  shortTitle: programme.shortTitle,
  blurb: programme.summary,
  icon: programme.icon,
  image: programme.image,
  href: `/Programmes/${programme.slug}`,
}));

export const ages = [
  {
    age: "1–6 years",
    title: "Strong foundations",
    desc: "Early learning, play, and parent or caregiver support.",
    tone: "bg-[#ed9b37] text-[#0b2f3b]",
  },
  {
    age: "7–12 years",
    title: "Discovery",
    desc: "Reading culture, skills discovery, safe play, and confidence building.",
    tone: "bg-white text-[#0b2f3b] border border-slate-200/70",
  },
  {
    age: "13–18 years",
    title: "Growth",
    desc: "Mentorship, digital skills, wellbeing, creativity, sport, and leadership.",
    tone: "bg-[#52b3a9] text-[#161616]",
  },
  {
    age: "18 and beyond",
    title: "Purpose",
    desc: "Skills training, entrepreneurship support, job readiness, and leadership.",
    tone: "bg-[#e9f0ec] text-[#0b2f3b]",
  },
];

export const stats = [
  { value: "2", label: "Operational Hubs (Imbuto Hub Bugesera and Imbuto Hub Nyarugenge; Maison de jeunes)." },
  { value: "4", label: "Hubs in development (Kicukiro, Muhanga, Rwamagana, and Gasabo)" },
  { value: "30", label: "Hubs envisioned" },
  // { value: "926,824", label: "Mentorship sessions delivered" },
  // { value: "150+", label: "Community events hosted" },
];

export const hubs = [
  {
    id: "bugesera",
    name: "Imbuto Hub Bugesera",
    location: "Eastern Province",
    region: "Eastern Rwanda",
    lat: -2.148616,
    lng: 30.0874138,
    status: "Operational",
    summary:
      "An operational hub supporting learning, wellbeing, sports, and community opportunity in Bugesera.",
    shortName: "Imbuto Hub Bugesera",
  },
  {
    id: "nyarugenge",
    name: "Imbuto Hub Nyarugenge (Maison de Jeunes)",
    location: "Kigali City",
    region: "Kigali, Rwanda",
    lat: -1.9507,
    lng: 30.0608,
    status: "Operational",
    summary:
      "An operational youth space at Maison de Jeunes, connecting young people to programmes and community support.",
    shortName: "Nyarugenge Maison de Jeunes",
  },
  {
    id: "kicukiro",
    name: "Imbuto Hub Kicukiro",
    location: "Kigali City",
    region: "Kigali, Rwanda",
    lat: -1.9912,
    lng: 30.1023,
    status: "In Development",
    summary:
      "A hub in development to expand youth-centred learning, skills, wellbeing, and community connection in Kicukiro.",
    shortName: "Imbuto Hub Kicukiro",
  },
  {
    id: "muhanga",
    name: "Imbuto Hub Muhanga",
    location: "Southern Province",
    region: "Southern Rwanda",
    lat: -2.0854,
    lng: 29.7527,
    status: "In Development",
    summary:
      "A hub in development to support learning, wellbeing, and life-stage development in Muhanga.",
    shortName: "Imbuto Hub Muhanga",
  },
  {
    id: "rwamagana",
    name: "Imbuto Hub Rwamagana",
    location: "Eastern Province",
    region: "Eastern Rwanda",
    lat: -1.9487,
    lng: 30.4347,
    status: "In Development",
    summary:
      "A hub in development for community-rooted programming and practical opportunities in Rwamagana.",
    shortName: "Imbuto Hub Rwamagana",
  },
  {
    id: "gasabo",
    name: "Imbuto Hub Gasabo",
    location: "Kigali City",
    region: "Kigali, Rwanda",
    lat: -1.8922,
    lng: 30.1153,
    status: "In Development",
    summary:
      "A hub in development to strengthen access to hub programmes and community services in Gasabo.",
    shortName: "Imbuto Hub Gasabo",
  },
];

export const partners = [
  {
    name: "Partner 1",
    logo: "/images/partners/Coat_of_arms_of_Rwanda.svg",
  },
  {
    name: "Partner 2",
    logo: "/images/partners/RSSBlogo.png",
  },
  {
    name: "Partner 3",
    logo: "/images/partners/imbutofoundationlogo.png",
  },
];
