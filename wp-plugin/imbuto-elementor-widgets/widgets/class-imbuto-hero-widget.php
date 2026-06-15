<?php

namespace Imbuto\ElementorWidgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit;
}

class Hero_Widget extends Widget_Base
{
    public function get_name(): string
    {
        return 'imbuto_hero';
    }

    public function get_title(): string
    {
        return esc_html__('Imbuto Hero', 'imbuto-elementor-widgets');
    }

    public function get_icon(): string
    {
        return 'eicon-banner';
    }

    public function get_categories(): array
    {
        return ['imbuto'];
    }

    public function get_style_depends(): array
    {
        return ['imbuto-widgets'];
    }

    protected function register_controls(): void
    {
        $this->start_controls_section('content_section', [
            'label' => esc_html__('Content', 'imbuto-elementor-widgets'),
        ]);

        $this->add_control('eyebrow', [
            'label' => esc_html__('Eyebrow', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::TEXTAREA,
            'default' => 'Community spaces for learning, wellbeing, creativity, sports, and leadership',
        ]);

        $this->add_control('title', [
            'label' => esc_html__('Title', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::TEXTAREA,
            'default' => 'A safe space to learn, grow, and thrive.',
        ]);

        $this->add_control('description', [
            'label' => esc_html__('Description', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::TEXTAREA,
            'default' => 'Imbuto Hubs are vibrant community spaces across Rwanda where children, youth, and families come together to learn, grow, create, play, and thrive.',
        ]);

        $this->add_control('background_image', [
            'label' => esc_html__('Background Image', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::MEDIA,
        ]);

        $this->add_control('background_css', [
            'label' => esc_html__('Background Image CSS', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::TEXTAREA,
            'default' => $this->get_default_background_css(),
            'description' => esc_html__('Used when no background image is selected.', 'imbuto-elementor-widgets'),
        ]);

        $this->end_controls_section();

        $this->start_controls_section('stats_section', [
            'label' => esc_html__('Stat Cards', 'imbuto-elementor-widgets'),
        ]);

        $this->add_control('primary_stat_value', [
            'label' => esc_html__('Primary Stat Value', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::TEXT,
            'default' => '35K+',
        ]);

        $this->add_control('primary_stat_label', [
            'label' => esc_html__('Primary Stat Label', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::TEXTAREA,
            'default' => 'Youth Reached',
        ]);

        $this->add_control('primary_stat_description', [
            'label' => esc_html__('Primary Stat Description', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::TEXTAREA,
            'default' => 'Empowering young people across Rwanda with access to learning, skills, and opportunity.',
        ]);

        $this->add_control('secondary_stat_value', [
            'label' => esc_html__('Top Right Stat Value', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::TEXT,
            'default' => '12',
        ]);

        $this->add_control('secondary_stat_label', [
            'label' => esc_html__('Top Right Stat Label', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::TEXT,
            'default' => 'Hubs Nationwide',
        ]);

        $this->add_control('programme_stat_value', [
            'label' => esc_html__('Programme Stat Value', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::TEXT,
            'default' => '8',
        ]);

        $this->add_control('programme_stat_label', [
            'label' => esc_html__('Programme Stat Label', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::TEXT,
            'default' => 'Programmes',
        ]);

        $this->add_control('programme_stat_description', [
            'label' => esc_html__('Programme Stat Description', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::TEXTAREA,
            'default' => 'Every stage. Every need. From early childhood to adulthood.',
        ]);

        $this->add_control('event_stat_value', [
            'label' => esc_html__('Bottom Stat Value', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::TEXT,
            'default' => '150+',
        ]);

        $this->add_control('event_stat_label', [
            'label' => esc_html__('Bottom Stat Label', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::TEXT,
            'default' => 'Community Events',
        ]);

        $this->end_controls_section();

        $this->add_stat_card_style_controls(
            'primary',
            esc_html__('Primary Stat Card Style', 'imbuto-elementor-widgets'),
            '.imbuto-stat-card--primary'
        );

        $this->add_stat_card_style_controls(
            'secondary',
            esc_html__('Top Right Stat Card Style', 'imbuto-elementor-widgets'),
            '.imbuto-stat-card--secondary'
        );

        $this->add_stat_card_style_controls(
            'programme',
            esc_html__('Programme Stat Card Style', 'imbuto-elementor-widgets'),
            '.imbuto-stat-card--programme'
        );

        $this->add_stat_card_style_controls(
            'event',
            esc_html__('Bottom Stat Card Style', 'imbuto-elementor-widgets'),
            '.imbuto-stat-card--event'
        );
    }

    protected function render(): void
    {
        enqueue_frontend_assets();
        $settings = $this->get_settings_for_display();
        $has_image = !empty($settings['background_image']['url']);
        $bg_style = $has_image
            ? "background-image: url('" . esc_url($settings['background_image']['url']) . "');"
            : 'background-image: ' . esc_attr($settings['background_css'] ?: $this->get_default_background_css()) . ';';
        ?>
        <section class="imbuto-hero <?php echo esc_attr($has_image ? 'imbuto-hero--image' : 'imbuto-hero--gradient'); ?>">
            <div class="imbuto-hero__bg" style="<?php echo esc_attr($bg_style); ?>"></div>
            <?php if ($has_image) : ?><div class="imbuto-hero__overlay"></div><?php endif; ?>
            <div class="imbuto-container imbuto-hero__inner">
                <div class="imbuto-hero__copy">
                    <div class="imbuto-chip imbuto-chip--glass"><?php echo esc_html($settings['eyebrow']); ?></div>
                    <h1><?php echo esc_html($settings['title']); ?></h1>
                    <p><?php echo esc_html($settings['description']); ?></p>
                </div>
                <div class="imbuto-hero__stats" aria-label="<?php echo esc_attr__('Imbuto Hub highlights', 'imbuto-elementor-widgets'); ?>">
                    <article class="imbuto-stat-card imbuto-stat-card--tall imbuto-stat-card--primary">
                        <strong><?php echo esc_html($settings['primary_stat_value']); ?></strong>
                        <span><?php echo esc_html($settings['primary_stat_label']); ?></span>
                        <p><?php echo esc_html($settings['primary_stat_description']); ?></p>
                    </article>
                    <article class="imbuto-stat-card imbuto-stat-card--secondary">
                        <strong><?php echo esc_html($settings['secondary_stat_value']); ?></strong>
                        <span><?php echo esc_html($settings['secondary_stat_label']); ?></span>
                    </article>
                    <article class="imbuto-stat-card imbuto-stat-card--programme">
                        <strong><?php echo esc_html($settings['programme_stat_value']); ?></strong>
                        <span><?php echo esc_html($settings['programme_stat_label']); ?></span>
                        <p><?php echo esc_html($settings['programme_stat_description']); ?></p>
                    </article>
                    <article class="imbuto-stat-card imbuto-stat-card--event">
                        <strong><?php echo esc_html($settings['event_stat_value']); ?></strong>
                        <span><?php echo esc_html($settings['event_stat_label']); ?></span>
                    </article>
                </div>
            </div>
        </section>
        <?php
    }

    private function get_default_background_css(): string
    {
        return 'radial-gradient(circle at 10% 0, #ffa45d47, #0000 10%), radial-gradient(circle at 0, #016a6d6b, #0000 1%), linear-gradient(90deg, #043e52f2 0%, #043e52c7 1%, #043e526b 100%)';
    }

    private function add_stat_card_style_controls(string $prefix, string $label, string $selector): void
    {
        $this->start_controls_section($prefix . '_stat_style_section', [
            'label' => $label,
            'tab' => Controls_Manager::TAB_STYLE,
        ]);
        
        $this->add_control($prefix . '_stat_background', [
            'label' => esc_html__('Card Background', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} ' . $selector => 'background: {{VALUE}};',
            ],
        ]);

        $this->add_control($prefix . '_stat_border_color', [
            'label' => esc_html__('Border Color', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} ' . $selector => 'border-color: {{VALUE}};',
            ],
        ]);

        $this->add_responsive_control($prefix . '_stat_border_radius', [
            'label' => esc_html__('Border Radius', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%'],
            'selectors' => [
                '{{WRAPPER}} ' . $selector => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->add_responsive_control($prefix . '_stat_padding', [
            'label' => esc_html__('Padding', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors' => [
                '{{WRAPPER}} ' . $selector => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->add_responsive_control($prefix . '_stat_min_height', [
            'label' => esc_html__('Min Height', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 80,
                    'max' => 520,
                    'step' => 1,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} ' . $selector => 'min-height: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->add_control($prefix . '_stat_horizontal_align', [
            'label' => esc_html__('Content Alignment', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::CHOOSE,
            'options' => [
                'start' => [
                    'title' => esc_html__('Left', 'imbuto-elementor-widgets'),
                    'icon' => 'eicon-text-align-left',
                ],
                'center' => [
                    'title' => esc_html__('Center', 'imbuto-elementor-widgets'),
                    'icon' => 'eicon-text-align-center',
                ],
                'end' => [
                    'title' => esc_html__('Right', 'imbuto-elementor-widgets'),
                    'icon' => 'eicon-text-align-right',
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} ' . $selector => 'align-items: {{VALUE}};',
                '{{WRAPPER}} ' . $selector . ' strong, {{WRAPPER}} ' . $selector . ' span, {{WRAPPER}} ' . $selector . ' p' => 'text-align: {{VALUE}};',
            ],
        ]);

        $this->add_control($prefix . '_stat_vertical_align', [
            'label' => esc_html__('Content Position', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::CHOOSE,
            'options' => [
                'flex-start' => [
                    'title' => esc_html__('Top', 'imbuto-elementor-widgets'),
                    'icon' => 'eicon-v-align-top',
                ],
                'center' => [
                    'title' => esc_html__('Middle', 'imbuto-elementor-widgets'),
                    'icon' => 'eicon-v-align-middle',
                ],
                'flex-end' => [
                    'title' => esc_html__('Bottom', 'imbuto-elementor-widgets'),
                    'icon' => 'eicon-v-align-bottom',
                ],
                'space-between' => [
                    'title' => esc_html__('Spread', 'imbuto-elementor-widgets'),
                    'icon' => 'eicon-justify-space-between-h',
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} ' . $selector => 'justify-content: {{VALUE}};',
            ],
        ]);

        $this->add_control($prefix . '_stat_value_color', [
            'label' => esc_html__('Number Color', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} ' . $selector . ' strong' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_responsive_control($prefix . '_stat_value_size', [
            'label' => esc_html__('Number Size', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 24,
                    'max' => 110,
                    'step' => 1,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} ' . $selector . ' strong' => 'font-size: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->add_control($prefix . '_stat_label_color', [
            'label' => esc_html__('Label Color', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} ' . $selector . ' span' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_responsive_control($prefix . '_stat_label_size', [
            'label' => esc_html__('Label Size', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 12,
                    'max' => 64,
                    'step' => 1,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} ' . $selector . ' span' => 'font-size: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->add_control($prefix . '_stat_description_color', [
            'label' => esc_html__('Description Color', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} ' . $selector . ' p' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_responsive_control($prefix . '_stat_description_size', [
            'label' => esc_html__('Description Size', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 12,
                    'max' => 32,
                    'step' => 1,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} ' . $selector . ' p' => 'font-size: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->end_controls_section();
    }
}
