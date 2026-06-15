"use client";

import { useEffect, useRef } from "react";
import L from "leaflet";
import "leaflet/dist/leaflet.css";

type Hub = {
  id: string;
  name: string;
  location: string;
  region: string;
  lat: number;
  lng: number;
  summary: string;
  shortName: string;
};

type HubsMapProps = {
  hubs: Hub[];
  activeHubId: string;
  onActiveHubChange: (hubId: string) => void;
};

type LatLngTuple = [number, number];

type LeafletElement = HTMLDivElement & {
  _leaflet_id?: number;
};

const rwandaCenter: LatLngTuple = [-1.9403, 29.8739];
const rwandaZoom = 9;
const focusedZoom = 11;
const mapBoundsPadding: L.PointTuple = [92, 64];

function createPinIcon(isActive: boolean) {
  return L.icon({
    iconUrl: "/images/pin.png",
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
  const mapElementRef = useRef<LeafletElement | null>(null);
  const mapRef = useRef<L.Map | null>(null);
  const markersLayerRef = useRef<L.LayerGroup | null>(null);

  useEffect(() => {
    const mapElement = mapElementRef.current;

    if (!mapElement || mapRef.current) return;

    delete mapElement._leaflet_id;

    const map = L.map(mapElement, {
      scrollWheelZoom: false,
    }).setView(rwandaCenter, rwandaZoom);

    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
      attribution: "&copy; OpenStreetMap contributors",
    }).addTo(map);

    markersLayerRef.current = L.layerGroup().addTo(map);
    mapRef.current = map;

    const resizeTimer = window.setTimeout(() => {
      map.invalidateSize();
    }, 0);

    return () => {
      window.clearTimeout(resizeTimer);
      map.remove();
      mapRef.current = null;
      markersLayerRef.current = null;
      delete mapElement._leaflet_id;
    };
  }, []);

  useEffect(() => {
    const markersLayer = markersLayerRef.current;
    const map = mapRef.current;

    if (!markersLayer || !map) return;

    markersLayer.clearLayers();

    hubs.forEach((hub) => {
      const isActive = hub.id === activeHubId;
      const tooltipContent = document.createElement("div");

      tooltipContent.className = "text-xs font-semibold text-[#102c35]";
      tooltipContent.textContent = hub.shortName;

      L.marker([hub.lat, hub.lng], {
        icon: createPinIcon(isActive),
      })
        .on("mouseover", () => onActiveHubChange(hub.id))
        .on("click", () => onActiveHubChange(hub.id))
        .bindTooltip(tooltipContent, {
          direction: "top",
          offset: [0, -10],
          opacity: 1,
          permanent: true,
        })
        .addTo(markersLayer);
    });

    map.invalidateSize();
  }, [activeHubId, hubs, onActiveHubChange]);

  useEffect(() => {
    const map = mapRef.current;

    if (!map) return;

    const timer = window.setTimeout(() => {
      map.invalidateSize();
      fitHubsInView(map, hubs);
    }, 0);

    return () => window.clearTimeout(timer);
  }, [hubs]);

  return (
    <div className="h-full min-h-[520px] w-full overflow-hidden rounded-[26px] bg-white">
      <div ref={mapElementRef} className="h-full min-h-[520px] w-full" />
    </div>
  );
}

function fitHubsInView(map: L.Map, hubs: Hub[]) {
  if (hubs.length === 0) return;

  if (hubs.length === 1) {
    map.setView([hubs[0].lat, hubs[0].lng], focusedZoom, {
      animate: false,
    });
    return;
  }

  const bounds = L.latLngBounds(hubs.map((hub) => [hub.lat, hub.lng]));
  const maxZoom = hubs.length <= 2 ? focusedZoom : rwandaZoom;

  map.fitBounds(bounds, {
    animate: false,
    maxZoom,
    padding: mapBoundsPadding,
  });
}
