<?php
/**
 * Plugin Name: Imbuto Elementor Widgets
 * Description: Custom Elementor widgets for the Imbuto Hub website.
 * Version: 0.1.24
 * Author: Imbuto
 * Text Domain: imbuto-elementor-widgets
 */

if (!defined('ABSPATH')) {
    exit;
}

define('IMBUTO_WIDGETS_VERSION', '0.1.24');
define('IMBUTO_WIDGETS_FILE', __FILE__);
define('IMBUTO_WIDGETS_PATH', plugin_dir_path(__FILE__));
define('IMBUTO_WIDGETS_URL', plugin_dir_url(__FILE__));

require_once IMBUTO_WIDGETS_PATH . 'includes/helpers.php';

function imbuto_widgets_register_assets(): void
{
    wp_register_style(
        'imbuto-widgets',
        IMBUTO_WIDGETS_URL . 'assets/css/imbuto-widgets.css',
        [],
        IMBUTO_WIDGETS_VERSION
    );

    wp_register_script(
        'leaflet',
        IMBUTO_WIDGETS_URL . 'assets/vendor/leaflet/leaflet.js',
        [],
        '1.9.4',
        true
    );

    wp_register_style(
        'leaflet',
        IMBUTO_WIDGETS_URL . 'assets/vendor/leaflet/leaflet.css',
        [],
        '1.9.4'
    );

    wp_register_script(
        'imbuto-widgets',
        IMBUTO_WIDGETS_URL . 'assets/js/imbuto-widgets.js',
        ['leaflet'],
        IMBUTO_WIDGETS_VERSION,
        true
    );
}
add_action('wp_enqueue_scripts', 'imbuto_widgets_register_assets');
add_action('elementor/frontend/after_register_scripts', 'imbuto_widgets_register_assets');
add_action('elementor/frontend/after_register_styles', 'imbuto_widgets_register_assets');

function imbuto_widgets_register_category($elements_manager): void
{
    $elements_manager->add_category(
        'imbuto',
        [
            'title' => esc_html__('Imbuto', 'imbuto-elementor-widgets'),
            'icon' => 'fa fa-plug',
        ]
    );
}
add_action('elementor/elements/categories_registered', 'imbuto_widgets_register_category');

function imbuto_widgets_register($widgets_manager): void
{
    if (!did_action('elementor/loaded')) {
        return;
    }

    require_once IMBUTO_WIDGETS_PATH . 'widgets/class-imbuto-hero-widget.php';
    require_once IMBUTO_WIDGETS_PATH . 'widgets/class-imbuto-header-widget.php';
    require_once IMBUTO_WIDGETS_PATH . 'widgets/class-imbuto-actions-widget.php';
    require_once IMBUTO_WIDGETS_PATH . 'widgets/class-imbuto-pillars-widget.php';
    require_once IMBUTO_WIDGETS_PATH . 'widgets/class-imbuto-about-widget.php';
    require_once IMBUTO_WIDGETS_PATH . 'widgets/class-imbuto-life-stages-widget.php';
    require_once IMBUTO_WIDGETS_PATH . 'widgets/class-imbuto-stats-widget.php';
    require_once IMBUTO_WIDGETS_PATH . 'widgets/class-imbuto-hubs-map-widget.php';
    require_once IMBUTO_WIDGETS_PATH . 'widgets/class-imbuto-cta-widget.php';
    require_once IMBUTO_WIDGETS_PATH . 'widgets/class-imbuto-footer-widget.php';

    $widgets_manager->register(new \Imbuto\ElementorWidgets\Header_Widget());
    $widgets_manager->register(new \Imbuto\ElementorWidgets\Hero_Widget());
    $widgets_manager->register(new \Imbuto\ElementorWidgets\Actions_Widget());
    $widgets_manager->register(new \Imbuto\ElementorWidgets\Pillars_Widget());
    $widgets_manager->register(new \Imbuto\ElementorWidgets\About_Widget());
    $widgets_manager->register(new \Imbuto\ElementorWidgets\Life_Stages_Widget());
    $widgets_manager->register(new \Imbuto\ElementorWidgets\Stats_Widget());
    $widgets_manager->register(new \Imbuto\ElementorWidgets\Hubs_Map_Widget());
    $widgets_manager->register(new \Imbuto\ElementorWidgets\Cta_Widget());
    $widgets_manager->register(new \Imbuto\ElementorWidgets\Footer_Widget());
}
add_action('elementor/widgets/register', 'imbuto_widgets_register');

function imbuto_widgets_missing_elementor_notice(): void
{
    if (did_action('elementor/loaded')) {
        return;
    }

    echo '<div class="notice notice-warning"><p>';
    echo esc_html__('Imbuto Elementor Widgets requires Elementor to be active.', 'imbuto-elementor-widgets');
    echo '</p></div>';
}
add_action('admin_notices', 'imbuto_widgets_missing_elementor_notice');
