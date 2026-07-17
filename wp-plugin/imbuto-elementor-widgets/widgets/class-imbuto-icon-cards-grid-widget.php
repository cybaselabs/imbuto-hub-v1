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

class Icon_Cards_Grid_Widget extends Widget_Base
{
    public function get_name(): string
    {
        return 'imbuto_icon_cards_grid';
    }

    public function get_title(): string
    {
        return esc_html__('Imbuto Icon Cards Grid', 'imbuto-elementor-widgets');
    }

    public function get_icon(): string
    {
        return 'eicon-gallery-grid';
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
        $this->start_controls_section('intro_section', ['label' => esc_html__('Intro', 'imbuto-elementor-widgets')]);
        $this->add_control('eyebrow', ['label' => esc_html__('Eyebrow', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXT, 'default' => '']);
        $this->add_control('title', ['label' => esc_html__('Title', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXTAREA, 'default' => 'Values']);
        $this->add_control('description', ['label' => esc_html__('Description', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXTAREA, 'default' => '']);
        $this->end_controls_section();

        $this->start_controls_section('cards_section', ['label' => esc_html__('Cards', 'imbuto-elementor-widgets')]);
        $cards = new Repeater();
        $cards->add_control('icon', ['label' => esc_html__('Icon', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::ICONS, 'default' => ['value' => 'fas fa-shield-alt', 'library' => 'fa-solid']]);
        $cards->add_control('title', ['label' => esc_html__('Title', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'Excellence']);
        $cards->add_control('description', ['label' => esc_html__('Description', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXTAREA, 'default' => 'We hold ourselves to the highest standards in what we deliver, how we operate, and who we are.']);
        $cards->add_control('card_background', ['label' => esc_html__('Card Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'default' => '#f7f7f2']);
        $cards->add_control('icon_background', ['label' => esc_html__('Icon Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'default' => 'rgba(82,179,169,0.18)']);
        $cards->add_control('icon_color', ['label' => esc_html__('Icon Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'default' => '#2b6274']);

        $this->add_control('cards', [
            'label' => esc_html__('Cards', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $cards->get_controls(),
            'title_field' => '{{{ title }}}',
            'default' => [
                ['title' => 'Excellence', 'description' => 'We hold ourselves to the highest standards in what we deliver, how we operate, and who we are.', 'icon' => ['value' => 'fas fa-shield-alt', 'library' => 'fa-solid'], 'card_background' => '#f7f7f2', 'icon_background' => 'rgba(82,179,169,0.18)', 'icon_color' => '#2b6274'],
                ['title' => 'Integrity', 'description' => 'We are transparent, honest, and accountable in everything we do.', 'icon' => ['value' => 'fas fa-check-circle', 'library' => 'fa-solid'], 'card_background' => '#f7f7f2', 'icon_background' => 'rgba(82,179,169,0.18)', 'icon_color' => '#2b6274'],
                ['title' => 'Innovation', 'description' => 'We embrace new ideas and creative approaches to deliver greater impact.', 'icon' => ['value' => 'fas fa-lightbulb', 'library' => 'fa-solid'], 'card_background' => '#f7f7f2', 'icon_background' => 'rgba(82,179,169,0.18)', 'icon_color' => '#2b6274'],
                ['title' => 'Solidarity', 'description' => 'We believe in the power of community, we grow stronger together than apart.', 'icon' => ['value' => 'far fa-handshake', 'library' => 'fa-regular'], 'card_background' => '#f7f7f2', 'icon_background' => 'rgba(82,179,169,0.18)', 'icon_color' => '#2b6274'],
                ['title' => 'Commitment', 'description' => 'We show up, every day, for every young person we serve.', 'icon' => ['value' => 'fas fa-star', 'library' => 'fa-solid'], 'card_background' => '#f7f7f2', 'icon_background' => 'rgba(82,179,169,0.18)', 'icon_color' => '#2b6274'],
            ],
        ]);
        $this->end_controls_section();

        $this->start_controls_section('section_style', ['label' => esc_html__('Section', 'imbuto-elementor-widgets'), 'tab' => Controls_Manager::TAB_STYLE]);
        $this->add_control('section_background', ['label' => esc_html__('Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-icon-grid' => 'background: {{VALUE}};']]);
        $this->add_responsive_control('section_padding', ['label' => esc_html__('Padding', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', 'em', '%'], 'selectors' => ['{{WRAPPER}} .imbuto-icon-grid' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_responsive_control('intro_spacing', ['label' => esc_html__('Intro Bottom Spacing', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['px'], 'range' => ['px' => ['min' => 0, 'max' => 120]], 'selectors' => ['{{WRAPPER}} .imbuto-icon-grid__head' => 'margin-bottom: {{SIZE}}{{UNIT}};']]);
        $this->add_responsive_control('grid_gap', ['label' => esc_html__('Grid Gap', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['px'], 'range' => ['px' => ['min' => 0, 'max' => 80]], 'selectors' => ['{{WRAPPER}} .imbuto-icon-grid__items' => 'gap: {{SIZE}}{{UNIT}};']]);
        $this->end_controls_section();

        $this->start_controls_section('card_style', ['label' => esc_html__('Cards', 'imbuto-elementor-widgets'), 'tab' => Controls_Manager::TAB_STYLE]);
        $this->add_control('card_border_color', ['label' => esc_html__('Border Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-icon-card' => 'border-color: {{VALUE}};']]);
        $this->add_responsive_control('card_min_height', ['label' => esc_html__('Min Height', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['px'], 'range' => ['px' => ['min' => 120, 'max' => 520]], 'selectors' => ['{{WRAPPER}} .imbuto-icon-card' => 'min-height: {{SIZE}}{{UNIT}};']]);
        $this->add_responsive_control('card_radius', ['label' => esc_html__('Border Radius', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', '%'], 'selectors' => ['{{WRAPPER}} .imbuto-icon-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_responsive_control('card_padding', ['label' => esc_html__('Padding', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', 'em', '%'], 'selectors' => ['{{WRAPPER}} .imbuto-icon-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->end_controls_section();

        $this->start_controls_section('icon_style', ['label' => esc_html__('Icons', 'imbuto-elementor-widgets'), 'tab' => Controls_Manager::TAB_STYLE]);
        $this->add_responsive_control('icon_box_size', ['label' => esc_html__('Icon Box Size', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['px'], 'range' => ['px' => ['min' => 28, 'max' => 120]], 'selectors' => ['{{WRAPPER}} .imbuto-icon-card__icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};']]);
        $this->add_responsive_control('icon_size', ['label' => esc_html__('Icon Size', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['px'], 'range' => ['px' => ['min' => 10, 'max' => 64]], 'selectors' => ['{{WRAPPER}} .imbuto-icon-card__icon svg, {{WRAPPER}} .imbuto-icon-card__icon i' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; font-size: {{SIZE}}{{UNIT}};']]);
        $this->add_responsive_control('icon_radius', ['label' => esc_html__('Icon Radius', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', '%'], 'selectors' => ['{{WRAPPER}} .imbuto-icon-card__icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->end_controls_section();

        $this->start_controls_section('text_style', ['label' => esc_html__('Text', 'imbuto-elementor-widgets'), 'tab' => Controls_Manager::TAB_STYLE]);
        $this->add_control('eyebrow_color', ['label' => esc_html__('Eyebrow Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-icon-grid__eyebrow' => 'color: {{VALUE}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'eyebrow_typography', 'label' => esc_html__('Eyebrow Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-icon-grid__eyebrow']);
        $this->add_control('heading_color', ['label' => esc_html__('Heading Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-icon-grid__head h2' => 'color: {{VALUE}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'heading_typography', 'label' => esc_html__('Heading Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-icon-grid__head h2']);
        $this->add_control('intro_color', ['label' => esc_html__('Intro Text Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-icon-grid__head p' => 'color: {{VALUE}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'intro_typography', 'label' => esc_html__('Intro Text Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-icon-grid__head p']);
        $this->add_control('card_title_color', ['label' => esc_html__('Card Title Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-icon-card h3' => 'color: {{VALUE}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'card_title_typography', 'label' => esc_html__('Card Title Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-icon-card h3']);
        $this->add_control('card_text_color', ['label' => esc_html__('Card Text Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-icon-card p' => 'color: {{VALUE}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'card_text_typography', 'label' => esc_html__('Card Text Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-icon-card p']);
        $this->end_controls_section();
    }

    protected function render(): void
    {
        enqueue_frontend_assets();
        $settings = $this->get_settings_for_display();
        ?>
        <section class="imbuto-icon-grid">
            <div class="imbuto-container">
                <?php if (!empty($settings['eyebrow']) || !empty($settings['title']) || !empty($settings['description'])) : ?>
                    <div class="imbuto-icon-grid__head">
                        <?php if (!empty($settings['eyebrow'])) : ?><div class="imbuto-icon-grid__eyebrow"><?php echo esc_html($settings['eyebrow']); ?></div><?php endif; ?>
                        <?php if (!empty($settings['title'])) : ?><h2><?php echo esc_html($settings['title']); ?></h2><?php endif; ?>
                        <?php if (!empty($settings['description'])) : ?><p><?php echo esc_html($settings['description']); ?></p><?php endif; ?>
                    </div>
                <?php endif; ?>
                <div class="imbuto-icon-grid__items">
                    <?php foreach (($settings['cards'] ?? []) as $card) : ?>
                        <article class="imbuto-icon-card" style="background: <?php echo esc_attr($card['card_background'] ?: '#f7f7f2'); ?>;">
                            <div class="imbuto-icon-card__icon" style="background: <?php echo esc_attr($card['icon_background'] ?: 'rgba(82,179,169,0.18)'); ?>; color: <?php echo esc_attr($card['icon_color'] ?: '#2b6274'); ?>;">
                                <?php Icons_Manager::render_icon($card['icon'], ['aria-hidden' => 'true']); ?>
                            </div>
                            <?php if (!empty($card['title'])) : ?><h3><?php echo esc_html($card['title']); ?></h3><?php endif; ?>
                            <?php if (!empty($card['description'])) : ?><p><?php echo esc_html($card['description']); ?></p><?php endif; ?>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <?php
    }
}
