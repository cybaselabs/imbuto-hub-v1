# Imbuto Elementor Widgets

Custom Elementor widgets for the Imbuto Hub WordPress build.

Current version: `0.1.63`

## Widgets

- Imbuto Hero
- Imbuto Page Hero
- Imbuto Header
- Imbuto Pillars
- Imbuto Programme Detail
- Imbuto Actions
- Imbuto About
- Imbuto About Philosophy
- Imbuto Statement Cards
- Imbuto Icon Cards Grid
- Imbuto Split Feature Panel
- Imbuto Media Feature
- Imbuto Life Stages
- Imbuto Stats
- Imbuto Hubs Map
- Imbuto Impact Stories
- Imbuto Impact Gallery
- Imbuto Impact Story Detail
- Imbuto Volunteer & Mentor
- Imbuto Support / Donate
- Imbuto Impact Partnerships
- Imbuto Story CTA
- Imbuto Partners
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
- ACF `short_summary` for the card subtitle
- ACF `short_description` for the card summary
- Excerpt as a fallback
- Sort controls for date, alphabetical title, or menu order in ASC/DESC direction

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

The Impact Stories and Impact Story Detail widgets can read published `impact_story` posts dynamically. Add the detail widget to an Elementor Single template for the Impact Story post type, just like the Programme Detail widget is used for program posts. They use:

- Featured image
- Title
- Post content for the story body
- ACF `person_name`
- ACF `location`
- ACF `related_program`
- ACF `quote`
- ACF `story_summary`
- Optional ACF `attribution`, `person_role`, `read_time`, `path_label`, and `path_summary`

If attribution is not set, the widgets fall back to `person_name` plus `person_role`, `role`, or `impact_metric`.

## Assets

The plugin includes the main images, pin icon, and local Leaflet assets for map rendering.
