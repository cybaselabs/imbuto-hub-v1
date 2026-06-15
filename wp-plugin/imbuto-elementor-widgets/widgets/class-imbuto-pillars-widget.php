<?php

namespace Imbuto\ElementorWidgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit;
}

class Pillars_Widget extends Widget_Base
{
    public function get_name(): string
    {
        return 'imbuto_pillars';
    }

    public function get_title(): string
    {
        return esc_html__('Imbuto Pillars', 'imbuto-elementor-widgets');
    }

    public function get_icon(): string
    {
        return 'eicon-posts-carousel';
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

        $this->add_control('title', [
            'label' => esc_html__('Title', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::TEXT,
            'default' => 'What we offer',
        ]);

        $this->add_control('description', [
            'label' => esc_html__('Description', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::TEXTAREA,
            'default' => 'A brighter, more energetic way to browse the Imbuto Hubs experience.',
        ]);

        $this->add_control('link_url', [
            'label' => esc_html__('Programmes Link', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::URL,
            'default' => ['url' => '/Programmes'],
        ]);

        $this->add_control('section_button_text', [
            'label' => esc_html__('Section Button Text', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::TEXT,
            'default' => 'Explore All Programmes',
        ]);

        $this->add_control('source', [
            'label' => esc_html__('Card Source', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::SELECT,
            'default' => 'Programmes',
            'options' => [
                'Programmes' => esc_html__('Program CPT', 'imbuto-elementor-widgets'),
                'fallback' => esc_html__('Fallback Cards', 'imbuto-elementor-widgets'),
            ],
        ]);

        $this->add_control('posts_per_page', [
            'label' => esc_html__('Number of Programmes', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::NUMBER,
            'min' => 1,
            'max' => 24,
            'step' => 1,
            'default' => 8,
            'condition' => [
                'source' => 'Programmes',
            ],
        ]);

        $this->add_control('card_label', [
            'label' => esc_html__('Card Label', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::TEXT,
            'default' => 'Programme',
        ]);

        $this->add_control('cta_label', [
            'label' => esc_html__('Card CTA Label', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::TEXT,
            'default' => 'Learn more',
        ]);

        $this->add_control('cta_icon', [
            'label' => esc_html__('Card CTA Icon', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::ICONS,
            'default' => [
                'value' => 'fas fa-arrow-right',
                'library' => 'fa-solid',
            ],
        ]);

        $this->add_control('summary_length', [
            'label' => esc_html__('Summary Character Limit', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::NUMBER,
            'min' => 20,
            'max' => 500,
            'step' => 5,
            'default' => 120,
        ]);

        $this->end_controls_section();

        $this->start_controls_section('style_section', [
            'label' => esc_html__('Program Cards Style', 'imbuto-elementor-widgets'),
            'tab' => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control('section_background', [
            'label' => esc_html__('Section Background', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .imbuto-pillars' => 'background: {{VALUE}};',
            ],
        ]);

        $this->add_control('card_background', [
            'label' => esc_html__('Card Background', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .imbuto-programme-card' => '--imbuto-programme-card-bg: {{VALUE}};',
            ],
        ]);

        $this->add_control('card_hover_background', [
            'label' => esc_html__('Card Hover Background', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .imbuto-programme-card' => '--imbuto-programme-card-hover-bg: {{VALUE}};',
            ],
        ]);

        $this->add_control('card_border_color', [
            'label' => esc_html__('Card Border Color', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .imbuto-programme-card' => 'border-color: {{VALUE}};',
            ],
        ]);

        $this->add_responsive_control('card_border_radius', [
            'label' => esc_html__('Card Border Radius', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%'],
            'selectors' => [
                '{{WRAPPER}} .imbuto-programme-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->add_responsive_control('card_content_padding', [
            'label' => esc_html__('Card Content Padding', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors' => [
                '{{WRAPPER}} .imbuto-programme-card__image strong' => 'left: {{LEFT}}{{UNIT}}; right: {{RIGHT}}{{UNIT}};',
                '{{WRAPPER}} .imbuto-programme-card > span:not(.imbuto-programme-card__image, .imbuto-programme-card__label)' => 'margin-left: {{LEFT}}{{UNIT}}; margin-right: {{RIGHT}}{{UNIT}};',
                '{{WRAPPER}} .imbuto-programme-card em' => 'margin-left: {{LEFT}}{{UNIT}}; margin-right: {{RIGHT}}{{UNIT}}; margin-bottom: {{BOTTOM}}{{UNIT}};',
            ],
        ]);

        $this->add_control('label_background', [
            'label' => esc_html__('Label Background', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .imbuto-programme-card__label' => 'background: {{VALUE}};',
            ],
        ]);

        $this->add_control('label_color', [
            'label' => esc_html__('Label Text Color', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .imbuto-programme-card__label' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_group_control(Group_Control_Typography::get_type(), [
            'name' => 'label_typography',
            'label' => esc_html__('Label Typography', 'imbuto-elementor-widgets'),
            'selector' => '{{WRAPPER}} .imbuto-programme-card__label',
        ]);

        $this->add_control('title_color', [
            'label' => esc_html__('Title Color', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .imbuto-programme-card strong' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_group_control(Group_Control_Typography::get_type(), [
            'name' => 'title_typography',
            'label' => esc_html__('Title Typography', 'imbuto-elementor-widgets'),
            'selector' => '{{WRAPPER}} .imbuto-programme-card strong',
        ]);

        $this->add_responsive_control('title_size', [
            'label' => esc_html__('Title Size', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 18,
                    'max' => 64,
                    'step' => 1,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .imbuto-programme-card strong' => 'font-size: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->add_responsive_control('title_spacing', [
            'label' => esc_html__('Title Bottom Offset', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                    'step' => 1,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .imbuto-programme-card__image strong' => 'bottom: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->add_control('description_color', [
            'label' => esc_html__('Description Color', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .imbuto-programme-card > span:not(.imbuto-programme-card__image, .imbuto-programme-card__label)' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_group_control(Group_Control_Typography::get_type(), [
            'name' => 'description_typography',
            'label' => esc_html__('Description Typography', 'imbuto-elementor-widgets'),
            'selector' => '{{WRAPPER}} .imbuto-programme-card > span:not(.imbuto-programme-card__image, .imbuto-programme-card__label)',
        ]);

        $this->add_responsive_control('description_size', [
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
                '{{WRAPPER}} .imbuto-programme-card > span:not(.imbuto-programme-card__image, .imbuto-programme-card__label)' => 'font-size: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->add_responsive_control('description_spacing', [
            'label' => esc_html__('Description Top Spacing', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                    'step' => 1,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .imbuto-programme-card > span:not(.imbuto-programme-card__image, .imbuto-programme-card__label)' => 'margin-top: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->add_control('cta_color', [
            'label' => esc_html__('CTA Text Color', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .imbuto-programme-card em' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_control('cta_icon_color', [
            'label' => esc_html__('CTA Icon Color', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .imbuto-programme-card em svg, {{WRAPPER}} .imbuto-programme-card em i' => 'color: {{VALUE}};',
                '{{WRAPPER}} .imbuto-programme-card em svg path' => 'fill: {{VALUE}};',
            ],
        ]);

        $this->add_control('cta_background', [
            'label' => esc_html__('CTA Background', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .imbuto-programme-card em' => 'background: {{VALUE}};',
            ],
        ]);

        $this->add_control('cta_hover_color', [
            'label' => esc_html__('CTA Hover Text Color', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .imbuto-programme-card:hover em' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_control('cta_hover_icon_color', [
            'label' => esc_html__('CTA Hover Icon Color', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .imbuto-programme-card:hover em svg, {{WRAPPER}} .imbuto-programme-card:hover em i' => 'color: {{VALUE}};',
                '{{WRAPPER}} .imbuto-programme-card:hover em svg path' => 'fill: {{VALUE}};',
            ],
        ]);

        $this->add_control('cta_hover_background', [
            'label' => esc_html__('CTA Hover Background', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .imbuto-programme-card:hover em' => 'background: {{VALUE}};',
            ],
        ]);

        $this->add_control('cta_border_color', [
            'label' => esc_html__('CTA Border Color', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .imbuto-programme-card em' => 'border-color: {{VALUE}};',
            ],
        ]);

        $this->add_control('cta_hover_border_color', [
            'label' => esc_html__('CTA Hover Border Color', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .imbuto-programme-card:hover em' => 'border-color: {{VALUE}};',
            ],
        ]);

        $this->add_responsive_control('cta_border_radius', [
            'label' => esc_html__('CTA Border Radius', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%'],
            'selectors' => [
                '{{WRAPPER}} .imbuto-programme-card em' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->add_responsive_control('cta_padding', [
            'label' => esc_html__('CTA Padding', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors' => [
                '{{WRAPPER}} .imbuto-programme-card em' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->add_responsive_control('cta_spacing', [
            'label' => esc_html__('CTA Top Spacing', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 140,
                    'step' => 1,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .imbuto-programme-card em' => '--imbuto-programme-cta-margin-top: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->add_responsive_control('cta_bottom_spacing', [
            'label' => esc_html__('CTA Bottom Spacing', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                    'step' => 1,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .imbuto-programme-card em' => '--imbuto-programme-cta-margin-bottom: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->add_responsive_control('cta_gap', [
            'label' => esc_html__('CTA Text/Icon Gap', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 40,
                    'step' => 1,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .imbuto-programme-card em' => 'gap: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->add_group_control(Group_Control_Typography::get_type(), [
            'name' => 'cta_typography',
            'label' => esc_html__('CTA Typography', 'imbuto-elementor-widgets'),
            'selector' => '{{WRAPPER}} .imbuto-programme-card em',
        ]);

        $this->add_responsive_control('cta_size', [
            'label' => esc_html__('CTA Size', 'imbuto-elementor-widgets'),
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
                '{{WRAPPER}} .imbuto-programme-card em' => 'font-size: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->add_responsive_control('cta_icon_size', [
            'label' => esc_html__('CTA Icon Size', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 10,
                    'max' => 40,
                    'step' => 1,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .imbuto-programme-card em svg, {{WRAPPER}} .imbuto-programme-card em i' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; font-size: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->add_responsive_control('card_width', [
            'label' => esc_html__('Card Width', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 240,
                    'max' => 520,
                    'step' => 1,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .imbuto-programme-card' => 'flex-basis: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->add_responsive_control('card_min_height', [
            'label' => esc_html__('Card Min Height', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 320,
                    'max' => 760,
                    'step' => 1,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .imbuto-programme-card' => 'min-height: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->add_responsive_control('image_height', [
            'label' => esc_html__('Image Height', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 160,
                    'max' => 420,
                    'step' => 1,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .imbuto-programme-card__image' => 'min-height: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->end_controls_section();
    }

    protected function render(): void
    {
        enqueue_frontend_assets();
        $settings = $this->get_settings_for_display();
        $limit = isset($settings['posts_per_page']) ? (int) $settings['posts_per_page'] : 8;
        $pillars = ($settings['source'] ?? 'Programmes') === 'Programmes' ? get_Programmes($limit) : default_pillars();
        $link = !empty($settings['link_url']['url']) ? $settings['link_url']['url'] : '/Programmes';
        $summary_length = isset($settings['summary_length']) ? (int) $settings['summary_length'] : 120;
        ?>
        <section class="imbuto-pillars">
            <div class="imbuto-container">
                <div class="imbuto-section-head imbuto-section-head--dark">
                    <div>
                        <div class="imbuto-kicker">Programmes</div>
                        <h2><?php echo esc_html($settings['title']); ?></h2>
                        <p><?php echo esc_html($settings['description']); ?></p>
                    </div>
                    <?php if (!empty($settings['section_button_text'])) : ?>
                        <a class="imbuto-button imbuto-button--light" href="<?php echo esc_url($link); ?>"><?php echo esc_html($settings['section_button_text']); ?></a>
                    <?php endif; ?>
                </div>
                <div class="imbuto-programme-rail">
                    <?php foreach ($pillars as $index => $pillar) : ?>
                        <a class="imbuto-programme-card imbuto-accent-<?php echo esc_attr((string) (($index % 4) + 1)); ?>" href="<?php echo esc_url($pillar['url'] ?? $link); ?>" style="<?php echo esc_attr($this->get_card_style($pillar)); ?>">
                            <span class="imbuto-programme-card__image" style="background-image: url('<?php echo esc_url($pillar['image']); ?>');">
                                <span class="imbuto-programme-card__label"><?php echo esc_html($settings['card_label']); ?></span>
                                <strong><?php echo esc_html($pillar['title']); ?></strong>
                            </span>
                            <span><?php echo esc_html($this->trim_summary((string) $pillar['blurb'], $summary_length)); ?></span>
                            <em>
                                <?php echo esc_html($settings['cta_label']); ?>
                                <?php Icons_Manager::render_icon($settings['cta_icon'], ['aria-hidden' => 'true']); ?>
                            </em>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <?php
    }

    private function get_card_style(array $pillar): string
    {
        $styles = [];
        $color_map = [
            'card_background' => '--imbuto-programme-card-bg',
            'card_hover_background' => '--imbuto-programme-card-hover-bg',
            'label_background' => '--imbuto-programme-label-bg',
            'label_color' => '--imbuto-programme-label-color',
        ];

        foreach ($color_map as $field => $property) {
            if (empty($pillar[$field])) {
                continue;
            }

            $color = sanitize_hex_color($pillar[$field]);

            if ($color) {
                $styles[] = $property . ': ' . $color;
            }
        }

        return implode('; ', array_filter($styles));
    }

    private function trim_summary(string $summary, int $limit): string
    {
        $summary = trim(wp_strip_all_tags($summary));

        $length = function_exists('mb_strlen') ? mb_strlen($summary) : strlen($summary);

        if ($limit <= 0 || $length <= $limit) {
            return $summary;
        }

        $trimmed = function_exists('mb_substr') ? mb_substr($summary, 0, $limit) : substr($summary, 0, $limit);

        return rtrim($trimmed, " \t\n\r\0\x0B.,;:") . '...';
    }
}
