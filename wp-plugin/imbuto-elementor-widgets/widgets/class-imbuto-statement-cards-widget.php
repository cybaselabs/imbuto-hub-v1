<?php

namespace Imbuto\ElementorWidgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit;
}

class Statement_Cards_Widget extends Widget_Base
{
    public function get_name(): string
    {
        return 'imbuto_statement_cards';
    }

    public function get_title(): string
    {
        return esc_html__('Imbuto Statement Cards', 'imbuto-elementor-widgets');
    }

    public function get_icon(): string
    {
        return 'eicon-info-box';
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
        $this->start_controls_section('content_section', ['label' => esc_html__('Cards', 'imbuto-elementor-widgets')]);

        $cards = new Repeater();
        $cards->add_control('eyebrow', ['label' => esc_html__('Eyebrow', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'Motto']);
        $cards->add_control('title', ['label' => esc_html__('Title', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXTAREA, 'default' => 'Rooted in community.']);
        $cards->add_control('description', ['label' => esc_html__('Description', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXTAREA, 'default' => 'Imbuto Hubs are grounded in the people, families, and local partnerships that shape each community\'s growth.']);
        $cards->add_control('card_background', ['label' => esc_html__('Card Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'default' => '#102c35']);
        $cards->add_control('eyebrow_color', ['label' => esc_html__('Eyebrow Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'default' => '#e16a3d']);
        $cards->add_control('title_color', ['label' => esc_html__('Title Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'default' => '#f5c346']);
        $cards->add_control('description_color', ['label' => esc_html__('Description Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'default' => 'rgba(255,255,255,0.78)']);

        $this->add_control('cards', [
            'label' => esc_html__('Statement Cards', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $cards->get_controls(),
            'title_field' => '{{{ eyebrow }}}',
            'default' => [
                ['eyebrow' => 'Motto', 'title' => 'Rooted in community.', 'description' => 'Imbuto Hubs are grounded in the people, families, and local partnerships that shape each community\'s growth.', 'card_background' => '#102c35', 'eyebrow_color' => '#e16a3d', 'title_color' => '#f5c346', 'description_color' => 'rgba(255,255,255,0.78)'],
                ['eyebrow' => 'Vision', 'title' => 'A thriving, empowered, and inclusive Rwanda.', 'description' => 'A Rwanda where every individual, from childhood to adulthood, is healthy, educated, and equipped to contribute meaningfully to their community and the nation\'s sustainable development.', 'card_background' => '#f7f7f2', 'eyebrow_color' => '#e16a3d', 'title_color' => '#102c35', 'description_color' => '#334155'],
                ['eyebrow' => 'Mission', 'title' => 'Safe spaces for full potential.', 'description' => 'To support the development of a healthy, educated, and prosperous society by providing safe, inclusive community spaces where young Rwandans can access the programmes, skills, connections, and support they need to reach their full potential.', 'card_background' => '#dff5f2', 'eyebrow_color' => '#e16a3d', 'title_color' => '#102c35', 'description_color' => '#334155'],
            ],
        ]);

        $this->end_controls_section();

        $this->start_controls_section('section_style', ['label' => esc_html__('Section', 'imbuto-elementor-widgets'), 'tab' => Controls_Manager::TAB_STYLE]);
        $this->add_control('section_background', ['label' => esc_html__('Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-statement-cards' => 'background: {{VALUE}};']]);
        $this->add_responsive_control('section_padding', ['label' => esc_html__('Padding', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', 'em', '%'], 'selectors' => ['{{WRAPPER}} .imbuto-statement-cards' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_responsive_control('grid_gap', ['label' => esc_html__('Grid Gap', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['px'], 'range' => ['px' => ['min' => 0, 'max' => 80]], 'selectors' => ['{{WRAPPER}} .imbuto-statement-cards__grid' => 'gap: {{SIZE}}{{UNIT}};']]);
        $this->end_controls_section();

        $this->start_controls_section('card_style', ['label' => esc_html__('Cards', 'imbuto-elementor-widgets'), 'tab' => Controls_Manager::TAB_STYLE]);
        $this->add_control('card_border_color', ['label' => esc_html__('Border Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-statement-card' => 'border-color: {{VALUE}};']]);
        $this->add_responsive_control('card_radius', ['label' => esc_html__('Border Radius', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', '%'], 'selectors' => ['{{WRAPPER}} .imbuto-statement-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_responsive_control('card_padding', ['label' => esc_html__('Padding', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', 'em', '%'], 'selectors' => ['{{WRAPPER}} .imbuto-statement-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_responsive_control('title_spacing', ['label' => esc_html__('Title Top Spacing', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['px'], 'range' => ['px' => ['min' => 0, 'max' => 80]], 'selectors' => ['{{WRAPPER}} .imbuto-statement-card h2' => 'margin-top: {{SIZE}}{{UNIT}};']]);
        $this->add_responsive_control('description_spacing', ['label' => esc_html__('Description Top Spacing', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['px'], 'range' => ['px' => ['min' => 0, 'max' => 80]], 'selectors' => ['{{WRAPPER}} .imbuto-statement-card p' => 'margin-top: {{SIZE}}{{UNIT}};']]);
        $this->end_controls_section();

        $this->start_controls_section('typography_style', ['label' => esc_html__('Typography', 'imbuto-elementor-widgets'), 'tab' => Controls_Manager::TAB_STYLE]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'eyebrow_typography', 'label' => esc_html__('Eyebrow Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-statement-card__eyebrow']);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'title_typography', 'label' => esc_html__('Title Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-statement-card h2']);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'description_typography', 'label' => esc_html__('Description Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-statement-card p']);
        $this->end_controls_section();
    }

    protected function render(): void
    {
        enqueue_frontend_assets();
        $settings = $this->get_settings_for_display();
        ?>
        <section class="imbuto-statement-cards">
            <div class="imbuto-container">
                <div class="imbuto-statement-cards__grid">
                    <?php foreach (($settings['cards'] ?? []) as $card) : ?>
                        <article class="imbuto-statement-card" style="background: <?php echo esc_attr($card['card_background'] ?: '#f7f7f2'); ?>;">
                            <?php if (!empty($card['eyebrow'])) : ?><div class="imbuto-statement-card__eyebrow" style="color: <?php echo esc_attr($card['eyebrow_color'] ?: '#e16a3d'); ?>;"><?php echo esc_html($card['eyebrow']); ?></div><?php endif; ?>
                            <?php if (!empty($card['title'])) : ?><h2 style="color: <?php echo esc_attr($card['title_color'] ?: '#102c35'); ?>;"><?php echo esc_html($card['title']); ?></h2><?php endif; ?>
                            <?php if (!empty($card['description'])) : ?><p style="color: <?php echo esc_attr($card['description_color'] ?: '#334155'); ?>;"><?php echo esc_html($card['description']); ?></p><?php endif; ?>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <?php
    }
}
