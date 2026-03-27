import {
  BookOpen,
  Briefcase,
  Compass,
  Flag,
  HandHeart,
  HeartPulse,
  MapPinned,
  Palette,
  Sparkles,
  Trophy,
  Users,
} from "lucide-react";
import { FacebookIcon, InstagramIcon, LinkedinIcon, XIcon, YoutubeIcon } from "./icons";

export const heroImage =
  "https://images.unsplash.com/photo-1529390079861-591de354faf5?q=80&w=1800&auto=format&fit=crop";
export const featureImage =
  "https://webtesting.co.rw/obproperties/wp-content/uploads/2026/03/205.jpg";
export const ctaImage =
  "https://images.unsplash.com/photo-1517048676732-d65bc937f952?q=80&w=1800&auto=format&fit=crop";

export const quickActions = [
  { title: "Find a Hub", icon: MapPinned, subtitle: "Discover the nearest Imbuto Hub in your community." },
  { title: "Explore Programs", icon: Compass, subtitle: "Browse opportunities for learning, wellbeing, and growth." },
  { title: "Register Interest", icon: Sparkles, subtitle: "Tell us what you need and we will guide you to the right path." },
  { title: "Get Involved", icon: HandHeart, subtitle: "Volunteer, mentor, partner, or support a programme." },
];

export const pillars = [
  { title: "Early Childhood Development", blurb: "Play-based early learning and family support that help children start strong.", icon: BookOpen },
  { title: "Education & Personal Development", blurb: "Reading culture, mentorship, and life skills for success in school and beyond.", icon: Users },
  { title: "Digital Literacy & Innovation", blurb: "Practical digital skills, ICT access, and future-ready learning.", icon: Sparkles },
  { title: "Health & Wellbeing", blurb: "Counselling, mental health awareness, and support for healthy choices.", icon: HeartPulse },
  { title: "Sports & Recreation", blurb: "Safe sport and play that build discipline, confidence, and teamwork.", icon: Trophy },
  { title: "Creative Arts & Culture", blurb: "Spaces to create, express, and grow through arts, culture, and storytelling.", icon: Palette },
  { title: "Skills, Entrepreneurship & Job Readiness", blurb: "Skills training and support to prepare for work and business.", icon: Briefcase },
  { title: "Leadership & Civic Engagement", blurb: "Leadership development and active citizenship for community impact.", icon: Flag },
];

export const ages = [
  { age: "1–6 years", title: "Strong foundations", desc: "Early learning, play, and parent or caregiver support." },
  { age: "7–12 years", title: "Discovery", desc: "Reading culture, skills discovery, safe play, and confidence building." },
  { age: "13–18 years", title: "Growth", desc: "Mentorship, digital skills, wellbeing, creativity, sport, and leadership." },
  { age: "18 and beyond", title: "Purpose", desc: "Skills training, entrepreneurship support, job readiness, and leadership." },
];

export const stats = [
  { value: "12", label: "Hubs across Rwanda" },
  { value: "35,000+", label: "Young people reached" },
  { value: "2,500+", label: "Mentorship sessions delivered" },
  { value: "150+", label: "Community events hosted" },
];

export const partners = [
  { name: "Partner 1", logo: "https://webtesting.co.rw/obproperties/wp-content/uploads/2026/03/preview.webp" },
  { name: "Partner 2", logo: "https://webtesting.co.rw/obproperties/wp-content/uploads/2026/03/preview-1.webp" },
  { name: "Partner 3", logo: "https://webtesting.co.rw/obproperties/wp-content/uploads/2026/03/preview-2.webp" },
  { name: "Partner 4", logo: "https://webtesting.co.rw/obproperties/wp-content/uploads/2026/03/preview-3.webp" },
  { name: "Partner 5", logo: "https://webtesting.co.rw/obproperties/wp-content/uploads/2026/03/preview-4.webp" },
  { name: "Partner 6", logo: "https://webtesting.co.rw/obproperties/wp-content/uploads/2026/03/preview-5.webp" },
  { name: "Partner 7", logo: "https://webtesting.co.rw/obproperties/wp-content/uploads/2026/03/preview-6.webp" },
];

export const hubCards = [
  { name: "Kigali Imbuto Hub", location: "Kigali City", tone: "bg-[#f6edd8] text-[#173d3f]" },
  { name: "Musanze Imbuto Hub", location: "Musanze, Northern Province", tone: "bg-[#dceef8] text-[#173d3f]" },
  { name: "Huye Imbuto Hub", location: "Huye, Southern Province", tone: "bg-[#d9ea52] text-[#111827]" },
  { name: "Rubavu Imbuto Hub", location: "Rubavu, Western Province", tone: "bg-white text-[#111827]" },
  { name: "Nyagatare Imbuto Hub", location: "Nyagatare, Eastern Province", tone: "bg-[#d6a7f4] text-[#111827]" },
  { name: "Rwamagana Imbuto Hub", location: "Rwamagana, Eastern Province", tone: "bg-[#ff5b2e] text-white" },
];

export const pillarBackgrounds = [
  "from-[#043E52] to-[#016A6D]",
  "from-[#E16A3D] to-[#FFA45D]",
  "from-[#016A6D] to-[#45a39a]",
  "from-[#18384b] to-[#2f6472]",
];

export const socialLinks = [
  { name: "Facebook", icon: FacebookIcon },
  { name: "Instagram", icon: InstagramIcon },
  { name: "YouTube", icon: YoutubeIcon },
  { name: "LinkedIn", icon: LinkedinIcon },
  { name: "X", icon: XIcon },
];
