<?php

namespace Imbuto\ElementorWidgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit;
}

class Stats_Widget extends Widget_Base
{
    public function get_name(): string
    {
        return 'imbuto_stats';
    }

    public function get_title(): string
    {
        return esc_html__('Imbuto Stats', 'imbuto-elementor-widgets');
    }

    public function get_icon(): string
    {
        return 'eicon-counter-circle';
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

        $this->add_control('variant', [
            'label' => esc_html__('Variant', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::SELECT,
            'default' => 'dark',
            'options' => [
                'dark' => esc_html__('Dark', 'imbuto-elementor-widgets'),
                'light' => esc_html__('Light', 'imbuto-elementor-widgets'),
            ],
        ]);

        $this->add_control('eyebrow', [
            'label' => esc_html__('Eyebrow', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::TEXT,
            'default' => 'Facts & figures',
        ]);

        $this->add_control('title', [
            'label' => esc_html__('Title', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::TEXTAREA,
            'default' => 'National reach. Human impact.',
        ]);

        $this->add_control('description', [
            'label' => esc_html__('Description', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::TEXTAREA,
            'default' => 'Behind every number is a person, a family, and a community moving forward with greater access, confidence, and opportunity.',
        ]);

        $stats = new Repeater();
        $stats->add_control('value', [
            'label' => esc_html__('Value', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::TEXT,
            'default' => '12',
        ]);
        $stats->add_control('label', [
            'label' => esc_html__('Label', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::TEXT,
            'default' => 'Hubs Nationwide',
        ]);
        $stats->add_control('card_background', [
            'label' => esc_html__('Card Background', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::COLOR,
        ]);
        $stats->add_control('value_color', [
            'label' => esc_html__('Value Color', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::COLOR,
        ]);
        $stats->add_control('label_color', [
            'label' => esc_html__('Label Color', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::COLOR,
        ]);

        $this->add_control('stats', [
            'label' => esc_html__('Stats', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $stats->get_controls(),
            'title_field' => '{{{ value }}} - {{{ label }}}',
            'default' => [
                ['value' => '12', 'label' => 'Hubs Nationwide'],
                ['value' => '926,824', 'label' => 'Youth Empowered Through Youth Forums'],
                ['value' => '8', 'label' => 'Programme Pillars'],
                ['value' => '150+', 'label' => 'Community Events'],
            ],
        ]);

        $this->end_controls_section();

        $this->start_controls_section('section_style', [
            'label' => esc_html__('Section', 'imbuto-elementor-widgets'),
            'tab' => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control('section_background', [
            'label' => esc_html__('Background', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .imbuto-stats' => 'background: {{VALUE}};',
            ],
        ]);

        $this->add_responsive_control('section_padding', [
            'label' => esc_html__('Padding', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors' => [
                '{{WRAPPER}} .imbuto-stats' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->add_responsive_control('heading_gap', [
            'label' => esc_html__('Heading Gap', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => ['px' => ['min' => 0, 'max' => 100]],
            'selectors' => [
                '{{WRAPPER}} .imbuto-section-head' => 'gap: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->add_responsive_control('grid_spacing', [
            'label' => esc_html__('Grid Top Spacing', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => ['px' => ['min' => 0, 'max' => 140]],
            'selectors' => [
                '{{WRAPPER}} .imbuto-stats__grid' => 'margin-top: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->add_responsive_control('grid_gap', [
            'label' => esc_html__('Grid Gap', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => ['px' => ['min' => 0, 'max' => 80]],
            'selectors' => [
                '{{WRAPPER}} .imbuto-stats__grid' => 'gap: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->end_controls_section();

        $this->start_controls_section('text_style', [
            'label' => esc_html__('Heading Text', 'imbuto-elementor-widgets'),
            'tab' => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control('eyebrow_color', [
            'label' => esc_html__('Eyebrow Color', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .imbuto-stats__eyebrow' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_group_control(Group_Control_Typography::get_type(), [
            'name' => 'eyebrow_typography',
            'label' => esc_html__('Eyebrow Typography', 'imbuto-elementor-widgets'),
            'selector' => '{{WRAPPER}} .imbuto-stats__eyebrow',
        ]);

        $this->add_control('title_color', [
            'label' => esc_html__('Title Color', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .imbuto-stats h2' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_group_control(Group_Control_Typography::get_type(), [
            'name' => 'title_typography',
            'label' => esc_html__('Title Typography', 'imbuto-elementor-widgets'),
            'selector' => '{{WRAPPER}} .imbuto-stats h2',
        ]);

        $this->add_responsive_control('title_spacing', [
            'label' => esc_html__('Title Top Spacing', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => ['px' => ['min' => 0, 'max' => 80]],
            'selectors' => [
                '{{WRAPPER}} .imbuto-stats h2' => 'margin-top: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->add_control('description_color', [
            'label' => esc_html__('Description Color', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .imbuto-stats .imbuto-section-head > p' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_group_control(Group_Control_Typography::get_type(), [
            'name' => 'description_typography',
            'label' => esc_html__('Description Typography', 'imbuto-elementor-widgets'),
            'selector' => '{{WRAPPER}} .imbuto-stats .imbuto-section-head > p',
        ]);

        $this->end_controls_section();

        $this->start_controls_section('card_style', [
            'label' => esc_html__('Stat Cards', 'imbuto-elementor-widgets'),
            'tab' => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control('card_background', [
            'label' => esc_html__('Card Background', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .imbuto-stats__grid article' => 'background: {{VALUE}};',
            ],
        ]);

        $this->add_control('card_border_color', [
            'label' => esc_html__('Card Border Color', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .imbuto-stats__grid article' => 'border-color: {{VALUE}};',
            ],
        ]);

        $this->add_responsive_control('card_radius', [
            'label' => esc_html__('Card Radius', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%'],
            'selectors' => [
                '{{WRAPPER}} .imbuto-stats__grid article' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->add_responsive_control('card_padding', [
            'label' => esc_html__('Card Padding', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors' => [
                '{{WRAPPER}} .imbuto-stats__grid article' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->add_responsive_control('card_min_height', [
            'label' => esc_html__('Card Min Height', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => ['px' => ['min' => 80, 'max' => 420]],
            'selectors' => [
                '{{WRAPPER}} .imbuto-stats__grid article' => 'min-height: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->add_control('value_color', [
            'label' => esc_html__('Value Color', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .imbuto-stats__grid strong' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_group_control(Group_Control_Typography::get_type(), [
            'name' => 'value_typography',
            'label' => esc_html__('Value Typography', 'imbuto-elementor-widgets'),
            'selector' => '{{WRAPPER}} .imbuto-stats__grid strong',
        ]);

        $this->add_control('label_color', [
            'label' => esc_html__('Label Color', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .imbuto-stats__grid span' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_group_control(Group_Control_Typography::get_type(), [
            'name' => 'label_typography',
            'label' => esc_html__('Label Typography', 'imbuto-elementor-widgets'),
            'selector' => '{{WRAPPER}} .imbuto-stats__grid span',
        ]);

        $this->add_responsive_control('label_spacing', [
            'label' => esc_html__('Label Top Spacing', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => ['px' => ['min' => 0, 'max' => 80]],
            'selectors' => [
                '{{WRAPPER}} .imbuto-stats__grid span' => 'margin-top: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->end_controls_section();
    }

    protected function render(): void
    {
        enqueue_frontend_assets();
        $settings = $this->get_settings_for_display();
        $is_light = ($settings['variant'] ?? 'dark') === 'light';
        ?>
        <section class="imbuto-stats <?php echo $is_light ? 'imbuto-stats--light' : ''; ?>">
            <div class="imbuto-container">
                <div class="imbuto-section-head <?php echo $is_light ? '' : 'imbuto-section-head--dark'; ?>">
                    <div>
                        <div class="imbuto-stats__eyebrow"><?php echo esc_html($settings['eyebrow']); ?></div>
                        <h2><?php echo esc_html($settings['title']); ?></h2>
                    </div>
                    <p><?php echo esc_html($settings['description']); ?></p>
                </div>
                <div class="imbuto-stats__grid">
                    <?php foreach ($settings['stats'] as $stat) : ?>
                        <article style="<?php echo esc_attr($this->get_stat_style($stat)); ?>">
                            <strong><?php echo esc_html($stat['value'] ?? ''); ?></strong>
                            <span><?php echo esc_html($stat['label'] ?? ''); ?></span>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <?php
    }

    private function get_stat_style(array $stat): string
    {
        $styles = [];
        $map = [
            'card_background' => '--imbuto-stat-card-background',
            'value_color' => '--imbuto-stat-value-color',
            'label_color' => '--imbuto-stat-label-color',
        ];

        foreach ($map as $field => $property) {
            if (empty($stat[$field])) {
                continue;
            }

            $color = sanitize_hex_color($stat[$field]);

            if ($color) {
                $styles[] = $property . ': ' . $color;
            }
        }

        return implode('; ', $styles);
    }
}
