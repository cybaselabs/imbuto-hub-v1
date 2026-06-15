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
  { value: "2", label: "Operational Hubs" },
  { value: "3", label: "Hubs In Development" },
  { value: "926,824", label: "Mentorship sessions delivered" },
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
    id: "musanze",
    name: "Imbuto Hub Musanze",
    location: "Northern Province",
    region: "Northern Rwanda",
    lat: -1.4996,
    lng: 29.6349,
    status: "In Development",
    summary:
      "A hub in development to expand youth-centred learning, skills, and community connection in the north.",
    shortName: "Imbuto Hub Musanze",
  },
  {
    id: "huye",
    name: "Imbuto Hub Huye",
    location: "Southern Province",
    region: "Southern Rwanda",
    lat: -2.5967,
    lng: 29.7394,
    status: "In Development",
    summary:
      "A hub in development to support learning, wellbeing, and life-stage development in the south.",
    shortName: "Imbuto Hub Huye",
  },
  {
    id: "rubavu",
    name: "Imbuto Hub Rubavu",
    location: "Western Province",
    region: "Western Rwanda",
    lat: -1.688938,
    lng: 29.293046,
    status: "In Development",
    summary:
      "A hub in development for community-rooted programming close to Rwanda's western corridor.",
    shortName: "Imbuto Hub Rubavu",
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
