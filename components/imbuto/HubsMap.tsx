"use client";

import { useEffect, useMemo, useState } from "react";
import L from "leaflet";
import {
  MapContainer,
  Marker,
  TileLayer,
  Tooltip,
  useMap,
} from "react-leaflet";
import "leaflet/dist/leaflet.css";

type Hub = {
  id: string;
  name: string;
  location: string;
  region: string;
  lat: number;
  lng: number;
  summary: string;
};

type HubsMapProps = {
  hubs: Hub[];
  activeHubId: string;
  onActiveHubChange: (hubId: string) => void;
};

type LatLngTuple = [number, number];

function FlyToHub({ center }: { center: LatLngTuple }) {
  const map = useMap();

  useEffect(() => {
    if (!map) return;

    const timer = window.setTimeout(() => {
      map.flyTo(center, map.getZoom(), {
        duration: 0.8,
      });
    }, 0);

    return () => window.clearTimeout(timer);
  }, [center, map]);

  return null;
}

function createPinIcon(isActive: boolean) {
  return L.icon({
    iconUrl: "/images/gps.png",
    iconSize: isActive ? [42, 42] : [34, 34],
    iconAnchor: isActive ? [21, 42] : [17, 34],
    popupAnchor: [0, -36],
  });
}

export function HubsMap({
  hubs,
  activeHubId,
  onActiveHubChange,
}: HubsMapProps) {
  const activeHub = useMemo(
    () => hubs.find((hub) => hub.id === activeHubId) ?? hubs[0],
    [hubs, activeHubId]
  );

  const [isMounted, setIsMounted] = useState(false);

  useEffect(() => {
    setIsMounted(true);
  }, []);

  const rwandaCenter: LatLngTuple = [-1.9403, 29.8739];

  if (!isMounted || !activeHub) return null;

  return (
    <div className="h-[520px] w-full overflow-hidden rounded-[26px] bg-white">
      <MapContainer
        key="rwanda-hubs-map"
        center={rwandaCenter}
        zoom={8}
        scrollWheelZoom={false}
        className="h-full w-full"
      >
        <FlyToHub center={[activeHub.lat, activeHub.lng]} />

        <TileLayer
          attribution='&copy; OpenStreetMap contributors'
          url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
        />

        {hubs.map((hub) => {
          const isActive = hub.id === activeHubId;

          return (
            <Marker
              key={hub.id}
              position={[hub.lat, hub.lng]}
              icon={createPinIcon(isActive)}
              eventHandlers={{
                mouseover: () => onActiveHubChange(hub.id),
                click: () => onActiveHubChange(hub.id),
              }}
            >
              <Tooltip direction="top" offset={[0, -8]} opacity={1}>
                <div className="text-xs font-medium">{hub.name}</div>
              </Tooltip>
            </Marker>
          );
        })}
      </MapContainer>
    </div>
  );
}