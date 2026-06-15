(function () {
  const maps = new Map();
  const rwandaCenter = [-1.9403, 29.8739];

  function ensureMapSize(el) {
    if (!el.offsetHeight) {
      el.style.height = el.style.height || "520px";
      el.style.minHeight = el.style.minHeight || "520px";
    }
  }

  function makeIcon(pinUrl, active) {
    return L.icon({
      iconUrl: pinUrl,
      iconSize: active ? [42, 42] : [34, 34],
      iconAnchor: active ? [21, 42] : [17, 34],
      popupAnchor: [0, -36],
    });
  }

  function activateHub(mapId, hubId) {
    const state = maps.get(mapId);
    if (!state) return;

    state.activeHubId = hubId;
    state.markers.forEach((marker, id) => {
      marker.setIcon(makeIcon(state.pinUrl, id === hubId));
    });

    document.querySelectorAll(`[data-map-id="${mapId}"]`).forEach((button) => {
      button.classList.toggle("is-active", button.dataset.hubId === hubId);
    });

    const hub = state.hubs.find((item) => item.id === hubId);
    if (hub) {
      state.map.setView([hub.lat, hub.lng], 10, { animate: true });
    }
  }

  function fitMap(state) {
    if (!state.hubs.length) return;

    if (state.hubs.length === 1) {
      state.map.setView([state.hubs[0].lat, state.hubs[0].lng], 10);
      return;
    }

    const bounds = L.latLngBounds(state.hubs.map((hub) => [hub.lat, hub.lng]));
    state.map.fitBounds(bounds, {
      animate: false,
      maxZoom: 9,
      padding: [72, 56],
    });
  }

  function initMap(el) {
    if (!window.L) {
      window.setTimeout(() => initMap(el), 120);
      return;
    }

    ensureMapSize(el);

    if (maps.has(el.id)) {
      const existing = maps.get(el.id);
      if (existing && existing.map) {
        existing.map.invalidateSize();
        fitMap(existing);
      }
      return;
    }

    let hubs = [];
    try {
      hubs = JSON.parse(el.dataset.hubs || "[]");
    } catch (error) {
      hubs = [];
    }

    const pinUrl = el.dataset.pin || "";
    const map = L.map(el, { scrollWheelZoom: false }).setView(rwandaCenter, 9);
    const markers = new Map();

    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
      attribution: "&copy; OpenStreetMap contributors",
    }).addTo(map);

    const state = {
      map,
      hubs,
      pinUrl,
      markers,
      activeHubId: hubs[0] ? hubs[0].id : "",
    };

    hubs.forEach((hub, index) => {
      const marker = L.marker([hub.lat, hub.lng], {
        icon: makeIcon(pinUrl, index === 0),
      })
        .bindTooltip(hub.name, {
          direction: "top",
          offset: [0, -10],
          opacity: 1,
          permanent: true,
        })
        .on("mouseover", () => activateHub(el.id, hub.id))
        .on("click", () => activateHub(el.id, hub.id))
        .addTo(map);

      markers.set(hub.id, marker);
    });

    maps.set(el.id, state);

    [50, 250, 800, 1500].forEach((delay) => {
      window.setTimeout(() => {
        map.invalidateSize();
        fitMap(state);
      }, delay);
    });

    if ("ResizeObserver" in window) {
      const observer = new ResizeObserver(() => {
        map.invalidateSize();
        fitMap(state);
      });
      observer.observe(el);
      state.observer = observer;
    }
  }

  function init() {
    document.querySelectorAll(".imbuto-hubs-map").forEach(initMap);
    document.querySelectorAll(".imbuto-hub-item").forEach((button) => {
      if (button.dataset.imbutoBound === "true") return;

      button.dataset.imbutoBound = "true";
      button.addEventListener("click", () => {
        activateHub(button.dataset.mapId, button.dataset.hubId);
      });
      button.addEventListener("mouseenter", () => {
        activateHub(button.dataset.mapId, button.dataset.hubId);
      });
      button.addEventListener("focus", () => {
        activateHub(button.dataset.mapId, button.dataset.hubId);
      });
    });
    document.querySelectorAll("[data-imbuto-menu-toggle]").forEach((button) => {
      if (button.dataset.imbutoBound === "true") return;

      button.dataset.imbutoBound = "true";
      button.addEventListener("click", () => {
        const header = document.getElementById(button.dataset.imbutoMenuToggle);
        const expanded = button.getAttribute("aria-expanded") === "true";

        if (!header) return;

        header.classList.toggle("is-open", !expanded);
        button.setAttribute("aria-expanded", expanded ? "false" : "true");
      });
    });
  }

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", init);
  } else {
    init();
  }

  window.addEventListener("elementor/frontend/init", init);
  window.addEventListener("load", init);

  if (window.jQuery) {
    window.jQuery(window).on("elementor/frontend/init", () => {
      if (!window.elementorFrontend || !window.elementorFrontend.hooks) return;

      window.elementorFrontend.hooks.addAction(
        "frontend/element_ready/imbuto_hubs_map.default",
        ($scope) => {
          $scope.find(".imbuto-hubs-map").each((index, element) => initMap(element));
          init();
        },
      );

      window.elementorFrontend.hooks.addAction("frontend/element_ready/global", init);
    });
  }
})();
