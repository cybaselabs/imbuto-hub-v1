<?php

namespace Imbuto\ElementorWidgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit;
}

class Partners_Widget extends Widget_Base
{
    public function get_name(): string
    {
        return 'imbuto_partners';
    }

    public function get_title(): string
    {
        return esc_html__('Imbuto Partners', 'imbuto-elementor-widgets');
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
        $this->start_controls_section('content_section', [
            'label' => esc_html__('Content', 'imbuto-elementor-widgets'),
        ]);

        $this->add_control('eyebrow', [
            'label' => esc_html__('Eyebrow', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::TEXT,
            'default' => '',
        ]);

        $this->add_control('title', [
            'label' => esc_html__('Title', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::TEXTAREA,
            'default' => 'Our Partners',
        ]);

        $partners = new Repeater();

        $partners->add_control('name', [
            'label' => esc_html__('Name', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::TEXT,
            'default' => esc_html__('Partner', 'imbuto-elementor-widgets'),
            'label_block' => true,
        ]);

        $partners->add_control('logo', [
            'label' => esc_html__('Logo', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::MEDIA,
        ]);

        $this->add_control('partners', [
            'label' => esc_html__('Partners', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $partners->get_controls(),
            'default' => [
                ['name' => 'Partner 1', 'logo' => ['url' => image_url('partners/Coat_of_arms_of_Rwanda.svg')]],
                ['name' => 'Partner 2', 'logo' => ['url' => image_url('partners/RSSBlogo.png')]],
                ['name' => 'Partner 3', 'logo' => ['url' => image_url('partners/imbutofoundationlogo.png')]],
            ],
            'title_field' => '{{{ name }}}',
        ]);

        $this->end_controls_section();

        $this->start_controls_section('section_style', [
            'label' => esc_html__('Section', 'imbuto-elementor-widgets'),
            'tab' => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control('section_background', ['label' => esc_html__('Section Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-partners' => 'background: {{VALUE}};']]);
        $this->add_control('panel_background', ['label' => esc_html__('Panel Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-partners__panel' => 'background: {{VALUE}};']]);
        $this->add_responsive_control('section_padding', ['label' => esc_html__('Section Padding', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', 'em', '%'], 'selectors' => ['{{WRAPPER}} .imbuto-partners' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_responsive_control('panel_padding', ['label' => esc_html__('Panel Padding', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', 'em', '%'], 'selectors' => ['{{WRAPPER}} .imbuto-partners__panel' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_responsive_control('panel_radius', ['label' => esc_html__('Panel Radius', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', '%'], 'selectors' => ['{{WRAPPER}} .imbuto-partners__panel' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->end_controls_section();

        $this->start_controls_section('text_style', [
            'label' => esc_html__('Text', 'imbuto-elementor-widgets'),
            'tab' => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control('eyebrow_color', ['label' => esc_html__('Eyebrow Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-partners__eyebrow' => 'color: {{VALUE}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'eyebrow_typography', 'label' => esc_html__('Eyebrow Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-partners__eyebrow']);
        $this->add_control('title_color', ['label' => esc_html__('Title Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-partners h2' => 'color: {{VALUE}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'title_typography', 'label' => esc_html__('Title Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-partners h2']);
        $this->end_controls_section();

        $this->start_controls_section('logo_style', [
            'label' => esc_html__('Logo Cards', 'imbuto-elementor-widgets'),
            'tab' => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_responsive_control('logo_grid_gap', ['label' => esc_html__('Grid Gap', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['px'], 'range' => ['px' => ['min' => 0, 'max' => 60]], 'selectors' => ['{{WRAPPER}} .imbuto-partners__grid' => 'gap: {{SIZE}}{{UNIT}};']]);
        $this->add_control('logo_card_background', ['label' => esc_html__('Card Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-partners__card' => 'background: {{VALUE}};']]);
        $this->add_responsive_control('logo_card_radius', ['label' => esc_html__('Card Radius', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', '%'], 'selectors' => ['{{WRAPPER}} .imbuto-partners__card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_responsive_control('logo_card_height', ['label' => esc_html__('Card Min Height', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['px'], 'range' => ['px' => ['min' => 80, 'max' => 260]], 'selectors' => ['{{WRAPPER}} .imbuto-partners__card' => 'min-height: {{SIZE}}{{UNIT}};']]);
        $this->add_responsive_control('logo_height', ['label' => esc_html__('Logo Max Height', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['px'], 'range' => ['px' => ['min' => 24, 'max' => 160]], 'selectors' => ['{{WRAPPER}} .imbuto-partners__card img' => 'max-height: {{SIZE}}{{UNIT}};']]);
        $this->end_controls_section();
    }

    protected function render(): void
    {
        enqueue_frontend_assets();
        $settings = $this->get_settings_for_display();
        $partners = !empty($settings['partners']) && is_array($settings['partners']) ? $settings['partners'] : [];
        ?>
        <section class="imbuto-partners">
            <div class="imbuto-container">
                <div class="imbuto-partners__panel">
                    <div class="imbuto-partners__head">
                        <?php if (!empty($settings['eyebrow'])) : ?><div class="imbuto-partners__eyebrow"><?php echo esc_html($settings['eyebrow']); ?></div><?php endif; ?>
                        <h2><?php echo esc_html($settings['title']); ?></h2>
                    </div>
                    <div class="imbuto-partners__grid">
                        <?php foreach ($partners as $partner) : ?>
                            <?php $logo = $partner['logo']['url'] ?? ''; ?>
                            <?php if ($logo) : ?>
                                <div class="imbuto-partners__item">
                                    <div class="imbuto-partners__card" title="<?php echo esc_attr($partner['name'] ?? ''); ?>">
                                        <img src="<?php echo esc_url($logo); ?>" alt="<?php echo esc_attr($partner['name'] ?? 'Partner logo'); ?>">
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
}
