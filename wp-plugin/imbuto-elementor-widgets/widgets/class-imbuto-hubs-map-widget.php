<?php

namespace Imbuto\ElementorWidgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit;
}

class Hubs_Map_Widget extends Widget_Base
{
    public function get_name(): string
    {
        return 'imbuto_hubs_map';
    }

    public function get_title(): string
    {
        return esc_html__('Imbuto Hubs Map', 'imbuto-elementor-widgets');
    }

    public function get_icon(): string
    {
        return 'eicon-google-maps';
    }

    public function get_categories(): array
    {
        return ['imbuto'];
    }

    public function get_style_depends(): array
    {
        return ['imbuto-widgets', 'leaflet'];
    }

    public function get_script_depends(): array
    {
        return ['leaflet', 'imbuto-widgets'];
    }

    protected function register_controls(): void
    {
        $this->start_controls_section('content_section', [
            'label' => esc_html__('Content', 'imbuto-elementor-widgets'),
        ]);

        $this->add_control('eyebrow', [
            'label' => esc_html__('Eyebrow', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::TEXT,
            'default' => 'Hub network',
        ]);

        $this->add_control('title', [
            'label' => esc_html__('Title', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::TEXTAREA,
            'default' => 'Find an Imbuto Hub near you.',
        ]);

        $this->add_control('description', [
            'label' => esc_html__('Description', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::TEXTAREA,
            'default' => 'Explore the growing Imbuto Hub network across Rwanda and discover where learning, wellbeing, creativity, and opportunity are taking root.',
        ]);

        $this->add_control('primary_label', [
            'label' => esc_html__('Primary Button Text', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::TEXT,
            'default' => 'Explore all hubs',
        ]);

        $this->add_control('primary_url', [
            'label' => esc_html__('Primary Button URL', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::URL,
            'default' => ['url' => '/hubs'],
        ]);

        $this->add_control('primary_icon', [
            'label' => esc_html__('Primary Button Icon', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::ICONS,
        ]);

        $this->add_control('secondary_label', [
            'label' => esc_html__('Secondary Button Text', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::TEXT,
            'default' => 'Find a Hub',
        ]);

        $this->add_control('secondary_url', [
            'label' => esc_html__('Secondary Button URL', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::URL,
            'default' => ['url' => '/hubs#hub-map'],
        ]);

        $this->add_control('secondary_icon', [
            'label' => esc_html__('Secondary Button Icon', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::ICONS,
        ]);

        $this->add_control('show_status', [
            'label' => esc_html__('Show Hub Status Badge', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::SWITCHER,
            'return_value' => 'yes',
            'default' => '',
        ]);

        $this->end_controls_section();

        $this->start_controls_section('section_style', ['label' => esc_html__('Section & Panel', 'imbuto-elementor-widgets'), 'tab' => Controls_Manager::TAB_STYLE]);
        $this->add_control('section_background', ['label' => esc_html__('Section Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-hubs-map-section' => 'background: {{VALUE}};']]);
        $this->add_control('panel_background', ['label' => esc_html__('Panel Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-hubs-panel' => 'background: {{VALUE}};']]);
        $this->add_control('panel_border_color', ['label' => esc_html__('Panel Border Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-hubs-panel' => 'border-color: {{VALUE}};']]);
        $this->add_responsive_control('section_padding', ['label' => esc_html__('Section Padding', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', 'em', '%'], 'selectors' => ['{{WRAPPER}} .imbuto-hubs-map-section' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_responsive_control('panel_padding', ['label' => esc_html__('Panel Padding', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', 'em', '%'], 'selectors' => ['{{WRAPPER}} .imbuto-hubs-panel' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_responsive_control('panel_radius', ['label' => esc_html__('Panel Radius', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', '%'], 'selectors' => ['{{WRAPPER}} .imbuto-hubs-panel' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_responsive_control('layout_gap', ['label' => esc_html__('Layout Gap', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['px'], 'range' => ['px' => ['min' => 0, 'max' => 100]], 'selectors' => ['{{WRAPPER}} .imbuto-hubs-map-layout' => 'gap: {{SIZE}}{{UNIT}};']]);
        $this->end_controls_section();

        $this->start_controls_section('text_style', ['label' => esc_html__('Text', 'imbuto-elementor-widgets'), 'tab' => Controls_Manager::TAB_STYLE]);
        $this->add_control('eyebrow_color', ['label' => esc_html__('Eyebrow Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-hubs__eyebrow' => 'color: {{VALUE}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'eyebrow_typography', 'label' => esc_html__('Eyebrow Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-hubs__eyebrow']);
        $this->add_control('title_color', ['label' => esc_html__('Title Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-hubs__copy h2' => 'color: {{VALUE}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'title_typography', 'label' => esc_html__('Title Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-hubs__copy h2']);
        $this->add_control('description_color', ['label' => esc_html__('Description Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-hubs__copy > p' => 'color: {{VALUE}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'description_typography', 'label' => esc_html__('Description Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-hubs__copy > p']);
        $this->end_controls_section();

        $this->start_controls_section('button_style', ['label' => esc_html__('Buttons', 'imbuto-elementor-widgets'), 'tab' => Controls_Manager::TAB_STYLE]);
        $this->add_responsive_control('button_gap', ['label' => esc_html__('Button Gap', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['px'], 'range' => ['px' => ['min' => 0, 'max' => 60]], 'selectors' => ['{{WRAPPER}} .imbuto-hubs__buttons' => 'gap: {{SIZE}}{{UNIT}};']]);
        $this->add_responsive_control('button_padding', ['label' => esc_html__('Button Padding', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', 'em'], 'selectors' => ['{{WRAPPER}} .imbuto-hubs__buttons .imbuto-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_responsive_control('button_radius', ['label' => esc_html__('Button Radius', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', '%'], 'selectors' => ['{{WRAPPER}} .imbuto-hubs__buttons .imbuto-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_control('primary_background', ['label' => esc_html__('Primary Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-hubs__primary' => 'background: {{VALUE}};']]);
        $this->add_control('primary_color', ['label' => esc_html__('Primary Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-hubs__primary' => 'color: {{VALUE}};']]);
        $this->add_control('secondary_background', ['label' => esc_html__('Secondary Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-hubs__secondary' => 'background: {{VALUE}};']]);
        $this->add_control('secondary_color', ['label' => esc_html__('Secondary Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-hubs__secondary' => 'color: {{VALUE}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'button_typography', 'label' => esc_html__('Button Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-hubs__buttons .imbuto-button']);
        $this->end_controls_section();

        $this->start_controls_section('hub_list_style', ['label' => esc_html__('Hub List', 'imbuto-elementor-widgets'), 'tab' => Controls_Manager::TAB_STYLE]);
        $this->add_responsive_control('hub_list_gap', ['label' => esc_html__('List Gap', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['px'], 'range' => ['px' => ['min' => 0, 'max' => 50]], 'selectors' => ['{{WRAPPER}} .imbuto-hubs-list' => 'gap: {{SIZE}}{{UNIT}};']]);
        $this->add_control('hub_background', ['label' => esc_html__('Hub Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-hub-item' => 'background: {{VALUE}};']]);
        $this->add_control('hub_active_background', ['label' => esc_html__('Active Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-hub-item.is-active' => 'background: {{VALUE}};']]);
        $this->add_control('hub_text_color', ['label' => esc_html__('Hub Text Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-hub-item strong' => 'color: {{VALUE}};']]);
        $this->add_control('hub_active_text_color', ['label' => esc_html__('Active Text Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-hub-item.is-active strong, {{WRAPPER}} .imbuto-hub-item.is-active em' => 'color: {{VALUE}};']]);
        $this->add_control('hub_meta_color', ['label' => esc_html__('Hub Meta Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-hub-item em' => 'color: {{VALUE}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'hub_title_typography', 'label' => esc_html__('Hub Title Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-hub-item strong']);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'hub_meta_typography', 'label' => esc_html__('Hub Meta Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-hub-item em']);
        $this->add_responsive_control('hub_padding', ['label' => esc_html__('Hub Padding', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', 'em'], 'selectors' => ['{{WRAPPER}} .imbuto-hub-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_responsive_control('hub_radius', ['label' => esc_html__('Hub Radius', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', '%'], 'selectors' => ['{{WRAPPER}} .imbuto-hub-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->end_controls_section();

        $this->start_controls_section('map_style', ['label' => esc_html__('Map', 'imbuto-elementor-widgets'), 'tab' => Controls_Manager::TAB_STYLE]);
        $this->add_control('map_frame_background', ['label' => esc_html__('Map Frame Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-hubs-map-frame' => 'background: {{VALUE}};']]);
        $this->add_control('map_frame_border_color', ['label' => esc_html__('Map Frame Border Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-hubs-map-frame' => 'border-color: {{VALUE}};']]);
        $this->add_responsive_control('map_frame_padding', ['label' => esc_html__('Map Frame Padding', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px'], 'selectors' => ['{{WRAPPER}} .imbuto-hubs-map-frame' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_responsive_control('map_frame_radius', ['label' => esc_html__('Map Frame Radius', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', '%'], 'selectors' => ['{{WRAPPER}} .imbuto-hubs-map-frame' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_responsive_control('map_height', ['label' => esc_html__('Map Height', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['px'], 'range' => ['px' => ['min' => 260, 'max' => 760]], 'selectors' => ['{{WRAPPER}} .imbuto-hubs-map' => 'height: {{SIZE}}{{UNIT}}; min-height: {{SIZE}}{{UNIT}};']]);
        $this->end_controls_section();
    }

    protected function render(): void
    {
        enqueue_frontend_assets(true);
        $settings = $this->get_settings_for_display();
        $hubs = get_hubs();
        $map_id = 'imbuto-map-' . $this->get_id();
        ?>
        <section class="imbuto-hubs-map-section">
            <div class="imbuto-container">
                <div class="imbuto-hubs-panel">
                    <div class="imbuto-hubs-map-layout">
                        <div class="imbuto-hubs__copy">
                            <div class="imbuto-hubs__eyebrow"><?php echo esc_html($settings['eyebrow']); ?></div>
                            <h2><?php echo esc_html($settings['title']); ?></h2>
                            <p><?php echo esc_html($settings['description']); ?></p>
                            <div class="imbuto-hubs__buttons">
                                <?php if (!empty($settings['primary_label'])) : ?><a class="imbuto-button imbuto-button--teal imbuto-hubs__primary" href="<?php echo esc_url($settings['primary_url']['url'] ?? '#'); ?>"><?php echo esc_html($settings['primary_label']); ?><?php Icons_Manager::render_icon($settings['primary_icon'], ['aria-hidden' => 'true']); ?></a><?php endif; ?>
                                <?php if (!empty($settings['secondary_label'])) : ?><a class="imbuto-button imbuto-button--outline-teal imbuto-hubs__secondary" href="<?php echo esc_url($settings['secondary_url']['url'] ?? '#'); ?>"><?php echo esc_html($settings['secondary_label']); ?><?php Icons_Manager::render_icon($settings['secondary_icon'], ['aria-hidden' => 'true']); ?></a><?php endif; ?>
                            </div>
                            <div class="imbuto-hubs-list">
                                <?php foreach ($hubs as $index => $hub) : ?>
                                    <button class="imbuto-hub-item <?php echo $index === 0 ? 'is-active' : ''; ?>" type="button" data-hub-id="<?php echo esc_attr($hub['id']); ?>" data-map-id="<?php echo esc_attr($map_id); ?>">
                                        <?php if (($settings['show_status'] ?? '') === 'yes') : ?><span><?php echo esc_html($hub['status'] ?: 'Hub'); ?></span><?php endif; ?>
                                        <strong><?php echo esc_html($hub['name']); ?></strong>
                                        <em><?php echo esc_html($this->get_hub_location($hub)); ?></em>
                                    </button>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="imbuto-hubs-map-frame">
                            <div id="<?php echo esc_attr($map_id); ?>" class="imbuto-hubs-map" data-hubs="<?php echo esc_attr(wp_json_encode($hubs)); ?>" data-pin="<?php echo esc_url(image_url('pin.png')); ?>"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }

    private function get_hub_location(array $hub): string
    {
        if (!empty($hub['location'])) {
            return (string) $hub['location'];
        }

        return trim(($hub['district'] ?? '') . ', ' . ($hub['province'] ?? ''), ', ');
    }
}
