# Imbuto Elementor Widgets

Custom Elementor widgets for the Imbuto Hub WordPress build.

Current version: `0.1.24`

## Widgets

- Imbuto Hero
- Imbuto Header
- Imbuto Pillars
- Imbuto Actions
- Imbuto About
- Imbuto Life Stages
- Imbuto Stats
- Imbuto Hubs Map
- Imbuto CTA
- Imbuto Footer

## Install

1. Upload `imbuto-elementor-widgets.zip` in WordPress under Plugins > Add Plugin > Upload Plugin.
2. Activate the plugin.
3. Open a page with Elementor.
4. Look for the `Imbuto` widget category.
5. Drag the widgets into the page in the desired order.

## Content

The Imbuto Pillars widget reads published `program` posts first. It uses:

- Featured image
- Title
- Excerpt
- ACF `short_description` when available

Optional per-program ACF color overrides:

- `card_background`
- `card_hover_background`
- `label_background`
- `label_color`

The Hubs Map widget reads published `hub` posts and these ACF fields when available:

- `province`
- `district`
- `status`
- `latitude`
- `longitude`
- `summary`

If no hub posts are available, the widget falls back to default Rwanda hub data.

## Assets

The plugin includes the main images, pin icon, and local Leaflet assets for map rendering.
