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
            'blurb' => 'A safe, nurturing space where young children learn through play, care, and early stimulation.',
            'image' => image_url('EarlyChildhood.jpg'),
        ],
        [
            'title' => 'Education & Personal Development',
            'blurb' => 'Reading culture, mentorship, and life skills for success in school and beyond.',
            'image' => image_url('54945400951_90ba3d130b_k.jpg'),
        ],
        [
            'title' => 'Digital Literacy & Innovation',
            'blurb' => 'Practical digital skills, ICT access, and future-ready learning.',
            'image' => image_url('52552727843_776ae789f1_k.jpg'),
        ],
        [
            'title' => 'Health & Wellbeing',
            'blurb' => 'Counselling, mental health awareness, and support for healthy choices.',
            'image' => image_url('ecadfe9f73f23947.jpeg'),
        ],
        [
            'title' => 'Sports & Recreation',
            'blurb' => 'Safe sport and play that build discipline, confidence, and teamwork.',
            'image' => image_url('52548376321_dda8370097_k.jpg'),
        ],
        [
            'title' => 'Creative Arts & Culture',
            'blurb' => 'Spaces to create, express, and grow through arts, culture, and storytelling.',
            'image' => image_url('55137656258_b872b35591_k.jpg'),
        ],
        [
            'title' => 'Skills, Entrepreneurship & Job Readiness',
            'blurb' => 'Skills training and support to prepare for work and business.',
            'image' => image_url('54513896658_550ab2509d_k.jpg'),
        ],
        [
            'title' => 'Leadership & Civic Engagement',
            'blurb' => 'Leadership development and active citizenship for community impact.',
            'image' => image_url('54513810799_7d0c00742c_k.jpg'),
        ],
    ];
}

function get_Programmes(int $limit = 8): array
{
    $query = new \WP_Query([
        'post_type' => 'program',
        'post_status' => 'publish',
        'posts_per_page' => $limit,
        'orderby' => ['menu_order' => 'ASC', 'date' => 'DESC'],
    ]);

    if (!$query->have_posts()) {
        return default_pillars();
    }

    $Programmes = [];

    while ($query->have_posts()) {
        $query->the_post();
        $post_id = get_the_ID();
        $image = get_the_post_thumbnail_url($post_id, 'large');
        $short_description = function_exists('get_field') ? get_field('short_description', $post_id) : '';

        $Programmes[] = [
            'title' => get_the_title(),
            'blurb' => $short_description ?: get_the_excerpt(),
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
            'id' => 'kigali',
            'name' => 'Imbuto Hub Kigali',
            'province' => 'Kigali City',
            'district' => 'Kigali',
            'status' => 'Operational',
            'lat' => -1.9441,
            'lng' => 30.0619,
            'summary' => 'Learning, wellbeing, creativity, and youth opportunity in the capital.',
        ],
        [
            'id' => 'musanze',
            'name' => 'Imbuto Hub Musanze',
            'province' => 'Northern Province',
            'district' => 'Musanze',
            'status' => 'Operational',
            'lat' => -1.4996,
            'lng' => 29.6349,
            'summary' => 'A youth-centred hub supporting growth, skills, and community connection.',
        ],
        [
            'id' => 'huye',
            'name' => 'Imbuto Hub Huye',
            'province' => 'Southern Province',
            'district' => 'Huye',
            'status' => 'Operational',
            'lat' => -2.5967,
            'lng' => 29.7394,
            'summary' => 'A space for learning, support, and life-stage development in the south.',
        ],
        [
            'id' => 'rubavu',
            'name' => 'Imbuto Hub Rubavu',
            'province' => 'Western Province',
            'district' => 'Rubavu',
            'status' => 'Operational',
            'lat' => -1.688938,
            'lng' => 29.293046,
            'summary' => 'Community-rooted programming close to Rwanda’s western corridor.',
        ],
        [
            'id' => 'nyagatare',
            'name' => 'Imbuto Hub Nyagatare',
            'province' => 'Eastern Province',
            'district' => 'Nyagatare',
            'status' => 'In Development',
            'lat' => -1.297,
            'lng' => 30.3256,
            'summary' => 'A growing access point for opportunity, wellbeing, and youth engagement.',
        ],
        [
            'id' => 'bugesera',
            'name' => 'Imbuto Hub Bugesera',
            'province' => 'Eastern Province',
            'district' => 'Bugesera',
            'status' => 'Planned',
            'lat' => -2.148616,
            'lng' => 30.0874138,
            'summary' => 'A growing access point for opportunity, wellbeing, and youth engagement.',
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

function enqueue_frontend_assets(bool $with_map = false): void
{
    wp_enqueue_style('imbuto-widgets');

    if ($with_map) {
        wp_enqueue_style('leaflet');
        wp_enqueue_script('leaflet');
        wp_enqueue_script('imbuto-widgets');
    }
}
