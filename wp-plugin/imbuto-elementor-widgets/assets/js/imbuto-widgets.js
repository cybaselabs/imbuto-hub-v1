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
    const hubs = state.visibleHubs || state.hubs;

    if (!hubs.length) return;

    if (hubs.length === 1) {
      state.map.setView([hubs[0].lat, hubs[0].lng], 10);
      return;
    }

    const bounds = L.latLngBounds(hubs.map((hub) => [hub.lat, hub.lng]));
    state.map.fitBounds(bounds, {
      animate: false,
      maxZoom: 9,
      padding: [72, 56],
    });
  }

  function renderMarkers(state, hubs) {
    state.markers.forEach((marker) => marker.remove());
    state.markers.clear();
    state.visibleHubs = hubs;

    hubs.forEach((hub, index) => {
      const marker = L.marker([hub.lat, hub.lng], {
        icon: makeIcon(state.pinUrl, index === 0),
      })
        .bindTooltip(hub.name, {
          direction: "top",
          offset: [0, -10],
          opacity: 1,
          permanent: true,
        })
        .on("mouseover", () => activateHub(state.mapId, hub.id))
        .on("click", () => activateHub(state.mapId, hub.id))
        .addTo(state.map);

      state.markers.set(hub.id, marker);
    });

    if (hubs[0]) {
      activateHub(state.mapId, hubs[0].id);
    }

    fitMap(state);
  }

  function hubMatchesFilters(card, values) {
    const query = values.query.trim().toLowerCase();
    const programmes = (card.dataset.programmes || "").split("|").filter(Boolean);

    if (query && !(card.dataset.query || "").includes(query)) return false;
    if (values.province && card.dataset.province !== values.province) return false;
    if (values.status && card.dataset.status !== values.status) return false;
    if (values.programme && !programmes.includes(values.programme)) return false;

    return true;
  }

  function applyHubFilters(form) {
    const mapId = form.dataset.imbutoHubFilters;
    const state = maps.get(mapId);
    const resultRoot = document.querySelector(`[data-imbuto-hub-results="${mapId}"]`);
    if (!state || !resultRoot) return;

    const values = {
      query: form.querySelector('[data-filter-type="query"]')?.value || "",
      province: form.querySelector('[data-filter-type="province"]')?.value || "",
      status: form.querySelector('[data-filter-type="status"]')?.value || "",
      programme: form.querySelector('[data-filter-type="programme"]')?.value || "",
    };

    const cards = Array.from(resultRoot.querySelectorAll(".imbuto-hub-card"));
    const visibleIds = [];

    cards.forEach((card) => {
      const visible = hubMatchesFilters(card, values);
      card.hidden = !visible;
      if (visible) visibleIds.push(card.dataset.hubId);
    });

    const visibleHubs = state.hubs.filter((hub) => visibleIds.includes(hub.id));
    const empty = resultRoot.querySelector(".imbuto-hubs-empty");
    if (empty) empty.hidden = visibleHubs.length > 0;

    renderMarkers(state, visibleHubs.length ? visibleHubs : state.hubs);
  }

  function getGalleryItems(root) {
    const modal = root.querySelector("[data-gallery-modal]");
    if (!modal) return [];

    try {
      return JSON.parse(modal.dataset.galleryItems || "[]");
    } catch (error) {
      return [];
    }
  }

  function renderGalleryModal(root, index) {
    const modal = root.querySelector("[data-gallery-modal]");
    const items = getGalleryItems(root);
    const item = items[index];

    if (!modal || !item) return;

    const image = modal.querySelector("[data-gallery-modal-image]");
    const title = modal.querySelector("[data-gallery-modal-title]");
    const counter = modal.querySelector("[data-gallery-counter]");

    root.dataset.galleryActiveIndex = String(index);

    if (image) {
      image.src = item.image;
      image.alt = item.alt || item.title || "";
    }

    if (title) title.textContent = item.title || "";
    if (counter) counter.textContent = `${index + 1} / ${items.length}`;

    modal.hidden = false;
    document.body.style.overflow = "hidden";
  }

  function closeGalleryModal(root) {
    const modal = root.querySelector("[data-gallery-modal]");
    if (!modal) return;

    modal.hidden = true;
    root.dataset.galleryActiveIndex = "";
    document.body.style.overflow = "";
  }

  function moveGallery(root, direction) {
    const items = getGalleryItems(root);
    if (!items.length) return;

    const current = Number(root.dataset.galleryActiveIndex || "0");
    const next = (current + direction + items.length) % items.length;
    renderGalleryModal(root, next);
  }

  function initGallery(root) {
    if (root.dataset.imbutoGalleryBound === "true") return;

    root.dataset.imbutoGalleryBound = "true";

    root.querySelectorAll("[data-gallery-index]").forEach((button) => {
      button.addEventListener("click", () => {
        renderGalleryModal(root, Number(button.dataset.galleryIndex || "0"));
      });
    });

    const modal = root.querySelector("[data-gallery-modal]");
    if (!modal) return;

    modal.querySelector("[data-gallery-close]")?.addEventListener("click", () => closeGalleryModal(root));
    modal.querySelector("[data-gallery-prev]")?.addEventListener("click", () => moveGallery(root, -1));
    modal.querySelector("[data-gallery-next]")?.addEventListener("click", () => moveGallery(root, 1));
    modal.addEventListener("click", (event) => {
      if (event.target === modal) closeGalleryModal(root);
    });

    document.addEventListener("keydown", (event) => {
      if (modal.hidden) return;

      if (event.key === "Escape") closeGalleryModal(root);
      if (event.key === "ArrowLeft") moveGallery(root, -1);
      if (event.key === "ArrowRight") moveGallery(root, 1);
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
      mapId: el.id,
      hubs,
      visibleHubs: hubs,
      pinUrl,
      markers,
      activeHubId: hubs[0] ? hubs[0].id : "",
    };

    maps.set(el.id, state);
    renderMarkers(state, hubs);

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
    document.querySelectorAll("[data-imbuto-gallery]").forEach(initGallery);
    document.querySelectorAll(".imbuto-hub-item").forEach((button) => {
      if (button.dataset.imbutoBound === "true") return;

      button.dataset.imbutoBound = "true";
      button.addEventListener("click", () => {
        activateHub(button.dataset.mapId, button.dataset.hubId);
      });
      button.addEventListener("mouseenter", () => {
        activateHub(button.dataset.mapId, button.dataset.hubId);
      });
      button.addEventListener("pointerenter", () => {
        activateHub(button.dataset.mapId, button.dataset.hubId);
      });
      button.addEventListener("focus", () => {
        activateHub(button.dataset.mapId, button.dataset.hubId);
      });
    });
    document.querySelectorAll(".imbuto-hub-card").forEach((card) => {
      if (card.dataset.imbutoBound === "true") return;

      card.dataset.imbutoBound = "true";
      card.addEventListener("mouseenter", () => {
        activateHub(card.dataset.mapId, card.dataset.hubId);
      });
      card.addEventListener("pointerenter", () => {
        activateHub(card.dataset.mapId, card.dataset.hubId);
      });
      card.addEventListener("focusin", () => {
        activateHub(card.dataset.mapId, card.dataset.hubId);
      });
    });
    document.querySelectorAll("[data-imbuto-hub-filters]").forEach((form) => {
      if (form.dataset.imbutoBound === "true") return;

      form.dataset.imbutoBound = "true";
      form.querySelectorAll("input, select").forEach((field) => {
        field.addEventListener("input", () => applyHubFilters(form));
        field.addEventListener("change", () => applyHubFilters(form));
      });
      applyHubFilters(form);
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

      window.elementorFrontend.hooks.addAction(
        "frontend/element_ready/imbuto_impact_gallery.default",
        ($scope) => {
          $scope.find("[data-imbuto-gallery]").each((index, element) => initGallery(element));
          init();
        },
      );

      window.elementorFrontend.hooks.addAction("frontend/element_ready/global", init);
    });
  }
})();
