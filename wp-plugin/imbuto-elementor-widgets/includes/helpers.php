<?php

namespace Imbuto\ElementorWidgets;

if (!defined('ABSPATH')) {
    exit;
}

function asset_url(string $path): string
{
    return IMBUTO_WIDGETS_URL . 'assets/' . ltrim($path, '/');
}

function image_url(string $filename): string
{
    return asset_url('images/' . ltrim($filename, '/'));
}

function default_pillars(): array
{
    return [
        [
            'title' => 'Early Childhood Development & Family',
            'subtitle' => 'Safe spaces where children learn through play, care, and discovery.',
            'blurb' => 'Children learn through play, care, stories, and safe spaces designed for discovery.',
            'image' => image_url('EarlyChildhood.jpg'),
        ],
        [
            'title' => 'Education & Personal Development',
            'subtitle' => 'Reading culture, mentorship, and life skills.',
            'blurb' => 'Young people build confidence for success in school and beyond.',
            'image' => image_url('54945400951_90ba3d130b_k.jpg'),
        ],
        [
            'title' => 'Digital Literacy & Innovation',
            'subtitle' => 'Skills turn into opportunity.',
            'blurb' => 'Build confidence with digital tools, online spaces, creative tech, and innovation.',
            'image' => image_url('52552727843_776ae789f1_k.jpg'),
        ],
        [
            'title' => 'Health & Wellbeing',
            'subtitle' => 'Supporting communities to thrive in mind and body.',
            'blurb' => 'Safe, open spaces for ASRH education, mental health support, dialogue, and guidance.',
            'image' => image_url('ecadfe9f73f23947.jpeg'),
        ],
        [
            'title' => 'Sports & Recreation',
            'subtitle' => 'Where energy meets opportunity.',
            'blurb' => 'Move, play, and grow through teamwork, discipline, recreation, and active living.',
            'image' => image_url('52548376321_dda8370097_k.jpg'),
        ],
        [
            'title' => 'Creative Arts & Culture',
            'subtitle' => 'Spaces to create, express, and grow.',
            'blurb' => 'Arts, culture, and storytelling help young people discover voice and confidence.',
            'image' => image_url('55137656258_b872b35591_k.jpg'),
        ],
        [
            'title' => 'Skills, Entrepreneurship & Job Readiness',
            'subtitle' => 'Preparing for work, business, and independence.',
            'blurb' => 'Skills training and practical support help young people move toward opportunity.',
            'image' => image_url('54513896658_550ab2509d_k.jpg'),
        ],
        [
            'title' => 'Leadership & Civic Engagement',
            'subtitle' => 'Leadership for community impact.',
            'blurb' => 'Young people grow as active citizens and leaders in their communities.',
            'image' => image_url('54513810799_7d0c00742c_k.jpg'),
        ],
    ];
}

function get_Programmes(int $limit = 8, string $orderby = 'menu_order', string $order = 'ASC'): array
{
    $allowed_orderby = ['date', 'title', 'menu_order'];
    $orderby = in_array($orderby, $allowed_orderby, true) ? $orderby : 'menu_order';
    $order = strtoupper($order) === 'DESC' ? 'DESC' : 'ASC';

    $query = new \WP_Query([
        'post_type' => 'program',
        'post_status' => 'publish',
        'posts_per_page' => $limit,
        'orderby' => $orderby,
        'order' => $order,
    ]);

    if (!$query->have_posts()) {
        return default_pillars();
    }

    $Programmes = [];

    while ($query->have_posts()) {
        $query->the_post();
        $post_id = get_the_ID();
        $image = get_the_post_thumbnail_url($post_id, 'large');
        $subtitle = function_exists('get_field') ? get_field('subtitle', $post_id) : '';
        $tagline = function_exists('get_field') ? get_field('tagline', $post_id) : '';
        $short_summary = function_exists('get_field') ? get_field('short_summary', $post_id) : '';
        $short_description = function_exists('get_field') ? get_field('short_description', $post_id) : '';
        $summary = function_exists('get_field') ? get_field('summary', $post_id) : '';

        $Programmes[] = [
            'title' => get_the_title(),
            'subtitle' => $short_summary ?: $subtitle ?: $tagline,
            'blurb' => $short_description ?: $summary ?: get_the_excerpt(),
            'image' => $image ?: image_url('EarlyChildhood.jpg'),
            'url' => get_permalink($post_id),
            'card_background' => function_exists('get_field') ? (string) get_field('card_background', $post_id) : '',
            'card_hover_background' => function_exists('get_field') ? (string) get_field('card_hover_background', $post_id) : '',
            'label_background' => function_exists('get_field') ? (string) get_field('label_background', $post_id) : '',
            'label_color' => function_exists('get_field') ? (string) get_field('label_color', $post_id) : '',
        ];
    }

    wp_reset_postdata();

    return $Programmes ?: default_pillars();
}

function default_stats(): array
{
    return [
        ['value' => '12', 'label' => 'Hubs Nationwide'],
        ['value' => '926,824', 'label' => 'Youth Empowered Through Youth Forums'],
        ['value' => '8', 'label' => 'Programme Pillars'],
        ['value' => '150+', 'label' => 'Community Events'],
    ];
}

function default_hubs(): array
{
    return [
        [
            'id' => 'bugesera',
            'name' => 'Imbuto Hub Bugesera',
            'province' => 'Eastern Province',
            'district' => 'Bugesera',
            'status' => 'Operational',
            'lat' => -2.148616,
            'lng' => 30.0874138,
            'summary' => 'An operational hub supporting learning, wellbeing, sports, and community opportunity in Bugesera.',
        ],
        [
            'id' => 'nyarugenge',
            'name' => 'Imbuto Hub Nyarugenge (Maison de Jeunes)',
            'province' => 'Kigali City',
            'district' => 'Nyarugenge',
            'status' => 'Operational',
            'lat' => -1.9507,
            'lng' => 30.0608,
            'summary' => 'An operational youth space at Maison de Jeunes, connecting young people to programmes and community support.',
        ],
        [
            'id' => 'musanze',
            'name' => 'Imbuto Hub Musanze',
            'province' => 'Northern Province',
            'district' => 'Musanze',
            'status' => 'In Development',
            'lat' => -1.4996,
            'lng' => 29.6349,
            'summary' => 'A hub in development to expand youth-centred learning, skills, and community connection in the north.',
        ],
        [
            'id' => 'huye',
            'name' => 'Imbuto Hub Huye',
            'province' => 'Southern Province',
            'district' => 'Huye',
            'status' => 'In Development',
            'lat' => -2.5967,
            'lng' => 29.7394,
            'summary' => 'A hub in development to support learning, wellbeing, and life-stage development in the south.',
        ],
        [
            'id' => 'rubavu',
            'name' => 'Imbuto Hub Rubavu',
            'province' => 'Western Province',
            'district' => 'Rubavu',
            'status' => 'In Development',
            'lat' => -1.688938,
            'lng' => 29.293046,
            'summary' => 'A hub in development for community-rooted programming close to Rwanda\'s western corridor.',
        ],
    ];
}

function get_hubs(): array
{
    $query = new \WP_Query([
        'post_type' => 'hub',
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'orderby' => 'title',
        'order' => 'ASC',
    ]);

    if (!$query->have_posts()) {
        return default_hubs();
    }

    $hubs = [];

    while ($query->have_posts()) {
        $query->the_post();
        $post_id = get_the_ID();
        $lat = function_exists('get_field') ? get_field('latitude', $post_id) : '';
        $lng = function_exists('get_field') ? get_field('longitude', $post_id) : '';

        if ($lat === '' || $lng === '') {
            continue;
        }

        $hubs[] = [
            'id' => 'hub-' . $post_id,
            'name' => get_the_title(),
            'province' => function_exists('get_field') ? (string) get_field('province', $post_id) : '',
            'district' => function_exists('get_field') ? (string) get_field('district', $post_id) : '',
            'status' => function_exists('get_field') ? (string) get_field('status', $post_id) : '',
            'lat' => (float) $lat,
            'lng' => (float) $lng,
            'summary' => function_exists('get_field') ? (string) get_field('summary', $post_id) : get_the_excerpt(),
            'url' => get_permalink($post_id),
        ];
    }

    wp_reset_postdata();

    return $hubs ?: default_hubs();
}

function get_acf_text_value(int $post_id, array $field_names, string $fallback = ''): string
{
    if (!function_exists('get_field')) {
        return $fallback;
    }

    foreach ($field_names as $field_name) {
        $value = get_field($field_name, $post_id);

        if (is_string($value) && trim($value) !== '') {
            return trim($value);
        }

        if (is_numeric($value)) {
            return (string) $value;
        }
    }

    return $fallback;
}

function get_related_program_label(int $post_id): string
{
    if (!function_exists('get_field')) {
        return '';
    }

    $related = get_field('related_program', $post_id);

    if (!$related) {
        return '';
    }

    $first = is_array($related) ? reset($related) : $related;

    if ($first instanceof \WP_Post) {
        return get_the_title($first);
    }

    if (is_numeric($first)) {
        return get_the_title((int) $first);
    }

    return '';
}

function get_impact_story_attribution(int $post_id): string
{
    $attribution = get_acf_text_value($post_id, ['attribution', 'quote_attribution', 'person_attribution']);

    if ($attribution !== '') {
        return $attribution;
    }

    $name = get_acf_text_value($post_id, ['person_name']);
    $role = get_acf_text_value($post_id, ['person_role', 'role', 'title', 'impact_metric']);

    if ($name !== '' && $role !== '') {
        return $name . ', ' . $role;
    }

    return $name ?: $role;
}

function get_impact_story_body(int $post_id): string
{
    $body = get_acf_text_value($post_id, ['story_body', 'body', 'full_story', 'story_content']);

    if ($body !== '') {
        return $body;
    }

    $post = get_post($post_id);

    return $post ? (string) $post->post_content : '';
}

function normalize_impact_story_post(int $post_id): array
{
    $person_name = get_acf_text_value($post_id, ['person_name']);
    $summary = get_acf_text_value($post_id, ['story_summary', 'summary'], get_the_excerpt($post_id));
    $subtitle = get_acf_text_value($post_id, ['hero_subtitle', 'subtitle', 'story_subtitle'], $summary);
    $related_program = get_related_program_label($post_id);
    $read_time = get_acf_text_value($post_id, ['read_time', 'reading_time']);
    $path_label = get_acf_text_value($post_id, ['path_label', 'image_badge'], $person_name ? $person_name . '\'s path' : 'Story path');
    $path_summary = get_acf_text_value($post_id, ['path_summary', 'image_caption'], $summary);
    $badge = get_acf_text_value($post_id, ['featured_badge', 'badge_label']);

    if ($badge === '') {
        $badge = trim('Featured Story' . ($person_name ? ', ' . $person_name : ''));
    }

    $image = get_the_post_thumbnail_url($post_id, 'full');

    return [
        'id' => $post_id,
        'title' => get_the_title($post_id),
        'url' => get_permalink($post_id),
        'image' => $image ?: image_url('gallery/55271389639_c61707ed44_k.jpg'),
        'image_alt' => get_post_meta(get_post_thumbnail_id($post_id), '_wp_attachment_image_alt', true) ?: get_the_title($post_id),
        'badge' => $badge,
        'person_name' => $person_name,
        'location' => get_acf_text_value($post_id, ['location']),
        'related_program' => $related_program,
        'quote' => get_acf_text_value($post_id, ['quote']),
        'attribution' => get_impact_story_attribution($post_id),
        'summary' => $summary,
        'subtitle' => $subtitle,
        'read_time' => $read_time,
        'path_label' => $path_label,
        'path_summary' => $path_summary,
        'body' => get_impact_story_body($post_id),
    ];
}

function get_impact_story_posts(string $post_type = 'impact_story', int $limit = 1, int $exclude_id = 0): array
{
    $args = [
        'post_type' => $post_type ?: 'impact_story',
        'post_status' => 'publish',
        'posts_per_page' => $limit,
        'orderby' => 'date',
        'order' => 'DESC',
    ];

    if ($exclude_id > 0) {
        $args['post__not_in'] = [$exclude_id];
    }

    $query = new \WP_Query($args);
    $stories = [];

    while ($query->have_posts()) {
        $query->the_post();
        $stories[] = normalize_impact_story_post(get_the_ID());
    }

    wp_reset_postdata();

    return $stories;
}

function enqueue_frontend_assets(bool $with_map = false): void
{
    wp_enqueue_style('imbuto-widgets');

    if ($with_map) {
        wp_enqueue_style('leaflet');
        wp_enqueue_script('leaflet');
        wp_enqueue_script('imbuto-widgets');
    }
}
