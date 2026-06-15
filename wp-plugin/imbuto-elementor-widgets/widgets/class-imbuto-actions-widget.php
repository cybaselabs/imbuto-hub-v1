<?php

namespace Imbuto\ElementorWidgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Repeater;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit;
}

class Actions_Widget extends Widget_Base
{
    public function get_name(): string
    {
        return 'imbuto_actions';
    }

    public function get_title(): string
    {
        return esc_html__('Imbuto Actions', 'imbuto-elementor-widgets');
    }

    public function get_icon(): string
    {
        return 'eicon-call-to-action';
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
            'type' => Controls_Manager::TEXT,
            'default' => 'Your journey starts here',
        ]);

        $this->add_control('title', [
            'label' => esc_html__('Title', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::TEXTAREA,
            'default' => 'Choose the next step that fits you best.',
        ]);

        $this->add_control('description', [
            'label' => esc_html__('Description', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::TEXTAREA,
            'default' => 'Ready to discover a Hub, explore programmes, or join the journey? Start here.',
        ]);

        $this->add_control('primary_label', [
            'label' => esc_html__('Primary Button Text', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::TEXT,
            'default' => 'Find a Hub',
        ]);

        $this->add_control('primary_url', [
            'label' => esc_html__('Primary Button URL', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::URL,
            'default' => ['url' => '/hubs#hub-map'],
        ]);

        $this->add_control('primary_icon', [
            'label' => esc_html__('Primary Button Icon', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::ICONS,
            'default' => ['value' => 'fas fa-arrow-right', 'library' => 'fa-solid'],
        ]);

        $this->add_control('secondary_label', [
            'label' => esc_html__('Secondary Button Text', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::TEXT,
            'default' => 'Explore Programmes',
        ]);

        $this->add_control('secondary_url', [
            'label' => esc_html__('Secondary Button URL', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::URL,
            'default' => ['url' => '/Programmes'],
        ]);

        $this->add_control('secondary_icon', [
            'label' => esc_html__('Secondary Button Icon', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::ICONS,
        ]);

        $cards = new Repeater();
        $cards->add_control('title', [
            'label' => esc_html__('Title', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::TEXT,
            'default' => 'Find a Hub',
        ]);
        $cards->add_control('subtitle', [
            'label' => esc_html__('Subtitle', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::TEXTAREA,
            'default' => 'Discover the nearest Imbuto Hub in your community.',
        ]);
        $cards->add_control('url', [
            'label' => esc_html__('URL', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::URL,
            'default' => ['url' => '/hubs#hub-map'],
        ]);
        $cards->add_control('icon', [
            'label' => esc_html__('Icon', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::ICONS,
            'default' => ['value' => 'fas fa-location-dot', 'library' => 'fa-solid'],
        ]);
        $cards->add_control('cta_label', [
            'label' => esc_html__('CTA Label', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::TEXT,
            'default' => 'Explore',
        ]);
        $cards->add_control('cta_icon', [
            'label' => esc_html__('CTA Icon', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::ICONS,
            'default' => ['value' => 'fas fa-chevron-right', 'library' => 'fa-solid'],
        ]);

        $this->add_control('cards', [
            'label' => esc_html__('Action Cards', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $cards->get_controls(),
            'title_field' => '{{{ title }}}',
            'default' => [
                ['title' => 'Find a Hub', 'subtitle' => 'Discover the nearest Imbuto Hub in your community.', 'url' => ['url' => '/hubs#hub-map'], 'icon' => ['value' => 'fas fa-location-dot', 'library' => 'fa-solid'], 'cta_label' => 'Explore', 'cta_icon' => ['value' => 'fas fa-chevron-right', 'library' => 'fa-solid']],
                ['title' => 'Explore Programmes', 'subtitle' => 'Browse opportunities for learning, wellbeing, and growth.', 'url' => ['url' => '/Programmes'], 'icon' => ['value' => 'far fa-compass', 'library' => 'fa-regular'], 'cta_label' => 'Explore', 'cta_icon' => ['value' => 'fas fa-chevron-right', 'library' => 'fa-solid']],
                ['title' => 'Register Interest', 'subtitle' => 'Tell us what you need and we will guide you to the right path.', 'url' => ['url' => '/get-involved#story'], 'icon' => ['value' => 'fas fa-wand-magic-sparkles', 'library' => 'fa-solid'], 'cta_label' => 'Explore', 'cta_icon' => ['value' => 'fas fa-chevron-right', 'library' => 'fa-solid']],
                ['title' => 'Get Involved', 'subtitle' => 'Volunteer, mentor, partner, or support a programme.', 'url' => ['url' => '/get-involved'], 'icon' => ['value' => 'far fa-handshake', 'library' => 'fa-regular'], 'cta_label' => 'Explore', 'cta_icon' => ['value' => 'fas fa-chevron-right', 'library' => 'fa-solid']],
            ],
        ]);

        $this->end_controls_section();

        $this->start_controls_section('section_style', [
            'label' => esc_html__('Section & Panel', 'imbuto-elementor-widgets'),
            'tab' => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control('section_background', [
            'label' => esc_html__('Section Background', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .imbuto-actions' => 'background: {{VALUE}};',
            ],
        ]);

        $this->add_control('panel_background', [
            'label' => esc_html__('Panel Background', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .imbuto-actions__panel' => 'background: {{VALUE}};',
            ],
        ]);

        $this->add_control('panel_border_color', [
            'label' => esc_html__('Panel Border Color', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .imbuto-actions__panel' => 'border-color: {{VALUE}};',
            ],
        ]);

        $this->add_responsive_control('panel_radius', [
            'label' => esc_html__('Panel Border Radius', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%'],
            'selectors' => [
                '{{WRAPPER}} .imbuto-actions__panel' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->add_responsive_control('panel_padding', [
            'label' => esc_html__('Panel Padding', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors' => [
                '{{WRAPPER}} .imbuto-actions__panel' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->add_responsive_control('header_gap', [
            'label' => esc_html__('Header Column Gap', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => ['px' => ['min' => 0, 'max' => 120]],
            'selectors' => [
                '{{WRAPPER}} .imbuto-actions__head' => 'gap: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->add_responsive_control('cards_top_spacing', [
            'label' => esc_html__('Cards Top Spacing', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => ['px' => ['min' => 0, 'max' => 140]],
            'selectors' => [
                '{{WRAPPER}} .imbuto-actions__grid' => 'margin-top: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->end_controls_section();

        $this->start_controls_section('text_style', [
            'label' => esc_html__('Text', 'imbuto-elementor-widgets'),
            'tab' => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control('eyebrow_background', [
            'label' => esc_html__('Eyebrow Background', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .imbuto-actions__eyebrow' => 'background: {{VALUE}};',
            ],
        ]);

        $this->add_control('eyebrow_color', [
            'label' => esc_html__('Eyebrow Color', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .imbuto-actions__eyebrow' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_group_control(Group_Control_Typography::get_type(), [
            'name' => 'eyebrow_typography',
            'label' => esc_html__('Eyebrow Typography', 'imbuto-elementor-widgets'),
            'selector' => '{{WRAPPER}} .imbuto-actions__eyebrow',
        ]);

        $this->add_control('title_color', [
            'label' => esc_html__('Title Color', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .imbuto-actions__head h2' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_group_control(Group_Control_Typography::get_type(), [
            'name' => 'title_typography',
            'label' => esc_html__('Title Typography', 'imbuto-elementor-widgets'),
            'selector' => '{{WRAPPER}} .imbuto-actions__head h2',
        ]);

        $this->add_control('description_color', [
            'label' => esc_html__('Description Color', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .imbuto-actions__head p' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_group_control(Group_Control_Typography::get_type(), [
            'name' => 'description_typography',
            'label' => esc_html__('Description Typography', 'imbuto-elementor-widgets'),
            'selector' => '{{WRAPPER}} .imbuto-actions__head p',
        ]);

        $this->add_responsive_control('description_spacing', [
            'label' => esc_html__('Description Top Spacing', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => ['px' => ['min' => 0, 'max' => 80]],
            'selectors' => [
                '{{WRAPPER}} .imbuto-actions__head p' => 'margin-top: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->end_controls_section();

        $this->start_controls_section('button_style', [
            'label' => esc_html__('Buttons', 'imbuto-elementor-widgets'),
            'tab' => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_responsive_control('button_gap', [
            'label' => esc_html__('Button Gap', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => ['px' => ['min' => 0, 'max' => 60]],
            'selectors' => [
                '{{WRAPPER}} .imbuto-actions__buttons' => 'gap: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->add_responsive_control('button_icon_gap', [
            'label' => esc_html__('Button Text/Icon Gap', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => ['px' => ['min' => 0, 'max' => 36]],
            'selectors' => [
                '{{WRAPPER}} .imbuto-actions__buttons .imbuto-button' => 'gap: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->add_responsive_control('button_icon_size', [
            'label' => esc_html__('Button Icon Size', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => ['px' => ['min' => 8, 'max' => 36]],
            'selectors' => [
                '{{WRAPPER}} .imbuto-actions__buttons .imbuto-button svg, {{WRAPPER}} .imbuto-actions__buttons .imbuto-button i' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; font-size: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->add_responsive_control('button_padding', [
            'label' => esc_html__('Button Padding', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em'],
            'selectors' => [
                '{{WRAPPER}} .imbuto-actions__buttons .imbuto-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->add_responsive_control('button_radius', [
            'label' => esc_html__('Button Border Radius', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%'],
            'selectors' => [
                '{{WRAPPER}} .imbuto-actions__buttons .imbuto-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->add_control('primary_button_background', [
            'label' => esc_html__('Primary Background', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .imbuto-actions__buttons .imbuto-button--orange' => 'background: {{VALUE}};',
            ],
        ]);

        $this->add_control('primary_button_color', [
            'label' => esc_html__('Primary Text Color', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .imbuto-actions__buttons .imbuto-button--orange' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_control('secondary_button_background', [
            'label' => esc_html__('Secondary Background', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .imbuto-actions__buttons .imbuto-button--white' => 'background: {{VALUE}};',
            ],
        ]);

        $this->add_control('secondary_button_color', [
            'label' => esc_html__('Secondary Text Color', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .imbuto-actions__buttons .imbuto-button--white' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_group_control(Group_Control_Typography::get_type(), [
            'name' => 'button_typography',
            'label' => esc_html__('Button Typography', 'imbuto-elementor-widgets'),
            'selector' => '{{WRAPPER}} .imbuto-actions__buttons .imbuto-button',
        ]);

        $this->end_controls_section();

        $this->start_controls_section('card_style', [
            'label' => esc_html__('Action Cards', 'imbuto-elementor-widgets'),
            'tab' => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control('card_background', [
            'label' => esc_html__('Card Background', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .imbuto-action-card' => 'background: {{VALUE}};',
            ],
        ]);

        $this->add_control('card_border_color', [
            'label' => esc_html__('Card Border Color', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .imbuto-action-card' => 'border-color: {{VALUE}};',
            ],
        ]);

        $this->add_responsive_control('card_radius', [
            'label' => esc_html__('Card Border Radius', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%'],
            'selectors' => [
                '{{WRAPPER}} .imbuto-action-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->add_responsive_control('card_padding', [
            'label' => esc_html__('Card Padding', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors' => [
                '{{WRAPPER}} .imbuto-action-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->add_responsive_control('card_gap', [
            'label' => esc_html__('Card Grid Gap', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => ['px' => ['min' => 0, 'max' => 80]],
            'selectors' => [
                '{{WRAPPER}} .imbuto-actions__grid' => 'gap: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->add_control('card_title_color', [
            'label' => esc_html__('Card Title Color', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .imbuto-action-card strong' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_group_control(Group_Control_Typography::get_type(), [
            'name' => 'card_title_typography',
            'label' => esc_html__('Card Title Typography', 'imbuto-elementor-widgets'),
            'selector' => '{{WRAPPER}} .imbuto-action-card strong',
        ]);

        $this->add_control('card_text_color', [
            'label' => esc_html__('Card Text Color', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .imbuto-action-card > span:not(.imbuto-action-card__icon)' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_group_control(Group_Control_Typography::get_type(), [
            'name' => 'card_text_typography',
            'label' => esc_html__('Card Text Typography', 'imbuto-elementor-widgets'),
            'selector' => '{{WRAPPER}} .imbuto-action-card > span:not(.imbuto-action-card__icon)',
        ]);

        $this->add_control('card_cta_color', [
            'label' => esc_html__('Card CTA Color', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .imbuto-action-card em' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_responsive_control('card_cta_icon_size', [
            'label' => esc_html__('Card CTA Icon Size', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => ['px' => ['min' => 8, 'max' => 34]],
            'selectors' => [
                '{{WRAPPER}} .imbuto-action-card em svg, {{WRAPPER}} .imbuto-action-card em i' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; font-size: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->add_responsive_control('card_cta_gap', [
            'label' => esc_html__('Card CTA Text/Icon Gap', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => ['px' => ['min' => 0, 'max' => 36]],
            'selectors' => [
                '{{WRAPPER}} .imbuto-action-card em' => 'gap: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->add_group_control(Group_Control_Typography::get_type(), [
            'name' => 'card_cta_typography',
            'label' => esc_html__('Card CTA Typography', 'imbuto-elementor-widgets'),
            'selector' => '{{WRAPPER}} .imbuto-action-card em',
        ]);

        $this->add_responsive_control('icon_size', [
            'label' => esc_html__('Icon Box Size', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => ['px' => ['min' => 28, 'max' => 96]],
            'selectors' => [
                '{{WRAPPER}} .imbuto-action-card__icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->end_controls_section();
    }

    protected function render(): void
    {
        enqueue_frontend_assets();
        $settings = $this->get_settings_for_display();
        ?>
        <section class="imbuto-actions">
            <div class="imbuto-container">
                <div class="imbuto-actions__panel">
                    <div class="imbuto-actions__head">
                        <div>
                            <div class="imbuto-actions__eyebrow"><span>◉</span><?php echo esc_html($settings['eyebrow']); ?></div>
                            <h2><?php echo esc_html($settings['title']); ?></h2>
                            <p><?php echo esc_html($settings['description']); ?></p>
                        </div>
                        <div class="imbuto-actions__buttons">
                            <?php if (!empty($settings['primary_label'])) : ?>
                                <a class="imbuto-button imbuto-button--orange" href="<?php echo esc_url($settings['primary_url']['url'] ?? '#'); ?>">
                                    <?php echo esc_html($settings['primary_label']); ?>
                                    <?php Icons_Manager::render_icon($settings['primary_icon'], ['aria-hidden' => 'true']); ?>
                                </a>
                            <?php endif; ?>
                            <?php if (!empty($settings['secondary_label'])) : ?>
                                <a class="imbuto-button imbuto-button--white" href="<?php echo esc_url($settings['secondary_url']['url'] ?? '#'); ?>">
                                    <?php echo esc_html($settings['secondary_label']); ?>
                                    <?php Icons_Manager::render_icon($settings['secondary_icon'], ['aria-hidden' => 'true']); ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="imbuto-actions__grid">
                        <?php foreach ($settings['cards'] as $card) : ?>
                            <a class="imbuto-action-card" href="<?php echo esc_url($card['url']['url'] ?? '#'); ?>">
                                <span class="imbuto-action-card__icon"><?php Icons_Manager::render_icon($card['icon'], ['aria-hidden' => 'true']); ?></span>
                                <strong><?php echo esc_html($card['title']); ?></strong>
                                <span><?php echo esc_html($card['subtitle']); ?></span>
                                <em>
                                    <?php echo esc_html($card['cta_label'] ?? 'Explore'); ?>
                                    <?php Icons_Manager::render_icon($card['cta_icon'], ['aria-hidden' => 'true']); ?>
                                </em>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
}
