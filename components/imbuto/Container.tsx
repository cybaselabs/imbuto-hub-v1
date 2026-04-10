
import type { ReactNode } from "react";

export function Container({
  children,
  className = "",
}: {
  children: ReactNode;
  className?: string;
}) {
  return (
    <div
      className={`mx-auto max-w-[1440px] px-6 md:px-8 lg:px-10 xl:px-14 2xl:px-20 ${className}`}
    >
      {children}
    </div>
  );
}
