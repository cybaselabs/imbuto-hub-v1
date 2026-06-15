import type { LucideIcon } from "lucide-react";
import { BookOpen, HeartPulse, Sparkles, Trophy } from "lucide-react";

export type Programme = {
  slug: string;
  title: string;
  shortTitle?: string;
  tagline: string;
  summary: string;
  body: string;
  icon: LucideIcon;
  image: string;
  tone: string;
};

export const programmes: Programme[] = [
  {
    slug: "early-childhood-development-family",
    title: "Early Childhood Development & Family",
    shortTitle: "ECD&F",
    tagline: "Safe spaces where children learn through play, care, and discovery.",
    summary:
      "Children learn through play, care, stories, and safe spaces designed for discovery.",
    body: "The ECD&F Programme at Imbuto Hubs is all about safe spaces where children learn through play, care, and early stimulation that helps them grow with confidence and curiosity. Little ones can explore the Kids' Corner, enjoy stories in the library, and play freely in the playground designed just for them. It's a joyful start to learning, where every moment is built for discovery, care, and connection.",
    icon: BookOpen,
    image: "/images/EarlyChildhood.jpg",
    tone: "bg-[#fff1e3] text-[#c05d24]",
  },
  {
    slug: "sports-recreation",
    title: "Sports & Recreation",
    tagline: "Where energy meets opportunity.",
    summary:
      "Move, play, and grow through teamwork, discipline, recreation, and active living.",
    body: "The Sports & Recreation Programme at Imbuto Hubs is where energy meets opportunity. It's a space to move, play, and grow through teamwork, discipline, and fun, whether on the field, in friendly matches, or through everyday recreation. Open to all ages, it brings the community together, building confidence, health, and joy through active living.",
    icon: Trophy,
    image: "/images/52548376321_dda8370097_k.jpg",
    tone: "bg-[#f8e7a8] text-[#8f5217]",
  },
  {
    slug: "digital-literacy-innovation",
    title: "Digital Literacy & Innovation",
    tagline: "Skills turn into opportunity.",
    summary:
      "Build confidence with digital tools, online spaces, creative tech, and innovation.",
    body: "The IT, Digital Literacy and Innovation Programme at Imbuto Hubs opens the door to the digital world, where skills turn into opportunity. From basic computer literacy to creative tech exploration, learners build confidence in using digital tools, navigating online spaces, and thinking innovatively. It's a space to learn, create, and prepare for a future shaped by technology.",
    icon: Sparkles,
    image: "/images/52552727843_776ae789f1_k.jpg",
    tone: "bg-[#fde4dc] text-[#c05d24]",
  },
  {
    slug: "health-wellbeing",
    title: "Health & Wellbeing",
    tagline: "Supporting communities to thrive in mind and body.",
    summary:
      "Safe, open spaces for ASRH education, mental health support, dialogue, and guidance.",
    body: "The Health and Wellbeing Programme at Imbuto Hubs supports young people and communities to thrive in mind and body. It includes Adolescent Sexual and Reproductive Health (ASRH) education and mental health support, creating safe, open spaces for learning, dialogue, and guidance. It's about building awareness, resilience, and healthy choices for a stronger, more confident generation.",
    icon: HeartPulse,
    image: "/images/ecadfe9f73f23947.jpeg",
    tone: "bg-[#dde9ee] text-[#2b6274]",
  },
];

export function getProgrammeBySlug(slug: string) {
  return programmes.find((programme) => programme.slug === slug);
}
