import { programmes } from "./programmes";
import { ProgrammeCard, programmeCardAccents } from "./ProgrammeCard";

type ProgrammeCardsGridProps = {
  tone?: "dark" | "light";
  limit?: number;
};

export function ProgrammeCardsGrid({
  tone = "dark",
  limit,
}: ProgrammeCardsGridProps) {
  const visibleProgrammes =
    typeof limit === "number" ? programmes.slice(0, limit) : programmes;

  return (
    <div className="grid gap-5 md:grid-cols-2 xl:grid-cols-4">
      {visibleProgrammes.map((programme, index) => (
        <ProgrammeCard
          key={programme.title}
          title={programme.title}
          description={
            <>
              <span className="block text-base font-semibold leading-7 text-white">
                {programme.tagline}
              </span>
              <span className="mt-4 block text-sm leading-7 text-white/72">
                {programme.summary}
              </span>
            </>
          }
          image={programme.image}
          icon={programme.icon}
          layout="grid"
          href={`/Programmes/${programme.slug}`}
          tone={tone}
          accent={programmeCardAccents[index % programmeCardAccents.length]}
        />
      ))}
    </div>
  );
}
