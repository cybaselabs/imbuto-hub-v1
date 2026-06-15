<?php

namespace Imbuto\ElementorWidgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit;
}

class Header_Widget extends Widget_Base
{
    public function get_name(): string
    {
        return 'imbuto_header';
    }

    public function get_title(): string
    {
        return esc_html__('Imbuto Header', 'imbuto-elementor-widgets');
    }

    public function get_icon(): string
    {
        return 'eicon-header';
    }

    public function get_categories(): array
    {
        return ['imbuto'];
    }

    public function get_style_depends(): array
    {
        return ['imbuto-widgets'];
    }

    public function get_script_depends(): array
    {
        return ['imbuto-widgets'];
    }

    protected function register_controls(): void
    {
        $menus = ['' => esc_html__('Fallback menu', 'imbuto-elementor-widgets')];
        foreach (wp_get_nav_menus() as $menu) {
            $menus[(string) $menu->term_id] = $menu->name;
        }

        $this->start_controls_section('content_section', [
            'label' => esc_html__('Content', 'imbuto-elementor-widgets'),
        ]);

        $this->add_control('logo', [
            'label' => esc_html__('Logo', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::MEDIA,
        ]);

        $this->add_control('logo_alt', [
            'label' => esc_html__('Logo Alt Text', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::TEXT,
            'default' => 'Imbuto Hub Logo',
        ]);

        $this->add_responsive_control('logo_height', [
            'label' => esc_html__('Logo Height', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 24,
                    'max' => 120,
                    'step' => 1,
                ],
            ],
            'default' => [
                'unit' => 'px',
                'size' => 42,
            ],
            'tablet_default' => [
                'unit' => 'px',
                'size' => 40,
            ],
            'mobile_default' => [
                'unit' => 'px',
                'size' => 36,
            ],
            'selectors' => [
                '{{WRAPPER}} .imbuto-site-header__logo img' => 'height: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->add_responsive_control('logo_max_width', [
            'label' => esc_html__('Logo Max Width', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 60,
                    'max' => 320,
                    'step' => 1,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .imbuto-site-header__logo img' => 'max-width: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->add_control('logo_fit', [
            'label' => esc_html__('Logo Fit', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::SELECT,
            'default' => 'contain',
            'options' => [
                'contain' => esc_html__('Contain', 'imbuto-elementor-widgets'),
                'cover' => esc_html__('Cover', 'imbuto-elementor-widgets'),
                'fill' => esc_html__('Fill', 'imbuto-elementor-widgets'),
            ],
            'selectors' => [
                '{{WRAPPER}} .imbuto-site-header__logo img' => 'object-fit: {{VALUE}};',
            ],
        ]);

        $this->add_control('menu_id', [
            'label' => esc_html__('WordPress Menu', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::SELECT,
            'default' => '',
            'options' => $menus,
        ]);

        $this->add_control('cta_label', [
            'label' => esc_html__('CTA Label', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::TEXT,
            'default' => 'Find a Hub',
        ]);

        $this->add_control('cta_url', [
            'label' => esc_html__('CTA URL', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::URL,
            'default' => ['url' => '/hubs'],
        ]);

        $this->add_control('language_label', [
            'label' => esc_html__('Language Label', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::TEXT,
            'default' => 'EN / RW',
        ]);

        $this->add_control('position_mode', [
            'label' => esc_html__('Header Position', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::SELECT,
            'default' => 'fixed',
            'options' => [
                'normal' => esc_html__('Normal', 'imbuto-elementor-widgets'),
                'sticky' => esc_html__('Sticky', 'imbuto-elementor-widgets'),
                'fixed' => esc_html__('Fixed Overlay', 'imbuto-elementor-widgets'),
                'absolute' => esc_html__('Absolute Overlay', 'imbuto-elementor-widgets'),
            ],
        ]);

        $this->end_controls_section();
    }

    protected function render(): void
    {
        enqueue_frontend_assets(true);
        $settings = $this->get_settings_for_display();
        $menu_id = $settings['menu_id'] ?? '';
        $cta_url = !empty($settings['cta_url']['url']) ? $settings['cta_url']['url'] : '/hubs';
        $logo_url = !empty($settings['logo']['url']) ? $settings['logo']['url'] : image_url('Imbutohublogo_v2.png');
        $logo_alt = !empty($settings['logo_alt']) ? $settings['logo_alt'] : 'Imbuto Hub Logo';
        $header_id = 'imbuto-header-' . $this->get_id();
        $classes = 'imbuto-site-header';
        $position_mode = $settings['position_mode'] ?? 'fixed';

        if ($position_mode === 'sticky') {
            $classes .= ' imbuto-site-header--sticky';
        } elseif ($position_mode === 'fixed') {
            $classes .= ' imbuto-site-header--fixed';
        } elseif ($position_mode === 'absolute') {
            $classes .= ' imbuto-site-header--absolute';
        }
        ?>
        <header id="<?php echo esc_attr($header_id); ?>" class="<?php echo esc_attr($classes); ?>">
            <div class="imbuto-container">
                <div class="imbuto-site-header__bar">
                    <a class="imbuto-site-header__logo" href="<?php echo esc_url(home_url('/')); ?>" aria-label="<?php echo esc_attr__('Imbuto Hubs home', 'imbuto-elementor-widgets'); ?>">
                        <img src="<?php echo esc_url($logo_url); ?>" alt="<?php echo esc_attr($logo_alt); ?>">
                    </a>

                    <nav class="imbuto-site-header__nav" aria-label="<?php echo esc_attr__('Main menu', 'imbuto-elementor-widgets'); ?>">
                        <?php $this->render_menu($menu_id); ?>
                    </nav>

                    <div class="imbuto-site-header__actions">
                        <?php if (!empty($settings['language_label'])) : ?>
                            <span class="imbuto-site-header__language"><?php echo esc_html($settings['language_label']); ?></span>
                        <?php endif; ?>
                        <a class="imbuto-site-header__cta" href="<?php echo esc_url($cta_url); ?>"><?php echo esc_html($settings['cta_label']); ?></a>
                        <button class="imbuto-site-header__toggle" type="button" aria-label="<?php echo esc_attr__('Open menu', 'imbuto-elementor-widgets'); ?>" aria-expanded="false" data-imbuto-menu-toggle="<?php echo esc_attr($header_id); ?>">
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
        </header>
        <?php
    }

    private function render_menu(string $menu_id): void
    {
        if ($menu_id !== '') {
            wp_nav_menu([
                'menu' => (int) $menu_id,
                'container' => false,
                'menu_class' => 'imbuto-site-header__menu',
                'fallback_cb' => false,
                'depth' => 1,
            ]);
            return;
        }

        $items = [
            ['Home', home_url('/')],
            ['About', home_url('/about')],
            ['Programmes', home_url('/Programmes')],
            ['Hubs', home_url('/hubs')],
            ['Impact', home_url('/impact')],
            ['Events', home_url('/events')],
            ['Get Involved', home_url('/get-involved')],
        ];

        echo '<ul class="imbuto-site-header__menu">';
        foreach ($items as $item) {
            printf(
                '<li><a href="%s">%s</a></li>',
                esc_url($item[1]),
                esc_html($item[0])
            );
        }
        echo '</ul>';
    }
}
