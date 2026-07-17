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
            'default' => 'Two hubs are currently operational in Bugesera and Nyarugenge (Maison de Jeunes), with three more hubs in development across Rwanda.',
        ]);

        $this->add_control('variant', [
            'label' => esc_html__('Layout Variant', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::SELECT,
            'default' => 'feature',
            'options' => [
                'feature' => esc_html__('Feature Map', 'imbuto-elementor-widgets'),
                'search' => esc_html__('Search & Filter', 'imbuto-elementor-widgets'),
            ],
        ]);

        $this->add_control('search_placeholder', [
            'label' => esc_html__('Search Placeholder', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::TEXT,
            'default' => 'Search by hub, district, or province',
            'condition' => [
                'variant' => 'search',
            ],
        ]);

        $this->add_control('empty_message', [
            'label' => esc_html__('Empty State Message', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::TEXTAREA,
            'default' => 'No hubs match those filters yet. Try removing one filter or search term.',
            'condition' => [
                'variant' => 'search',
            ],
        ]);

        $province_options = new Repeater();
        $province_options->add_control('label', ['label' => esc_html__('Label', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'Kigali City', 'label_block' => true]);

        $this->add_control('province_options', [
            'label' => esc_html__('Province Options', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $province_options->get_controls(),
            'default' => [
                ['label' => 'Kigali City'],
                ['label' => 'Northern Province'],
                ['label' => 'Southern Province'],
                ['label' => 'Western Province'],
                ['label' => 'Eastern Province'],
            ],
            'title_field' => '{{{ label }}}',
            'condition' => [
                'variant' => 'search',
            ],
        ]);

        $status_options = new Repeater();
        $status_options->add_control('label', ['label' => esc_html__('Label', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'Operational', 'label_block' => true]);

        $this->add_control('status_options', [
            'label' => esc_html__('Status Options', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $status_options->get_controls(),
            'default' => [
                ['label' => 'Operational'],
                ['label' => 'In Development'],
            ],
            'title_field' => '{{{ label }}}',
            'condition' => [
                'variant' => 'search',
            ],
        ]);

        $programme_options = new Repeater();
        $programme_options->add_control('label', ['label' => esc_html__('Label', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'Early Childhood Development & Family', 'label_block' => true]);

        $this->add_control('programme_options', [
            'label' => esc_html__('Programme Options', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $programme_options->get_controls(),
            'default' => [
                ['label' => 'Early Childhood Development & Family'],
                ['label' => 'Digital Literacy & Innovation'],
                ['label' => 'Health & Wellbeing'],
                ['label' => 'Sports & Recreation'],
            ],
            'title_field' => '{{{ label }}}',
            'condition' => [
                'variant' => 'search',
            ],
        ]);

        $this->add_control('show_summary_badges', [
            'label' => esc_html__('Show Summary Badges', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__('Show', 'imbuto-elementor-widgets'),
            'label_off' => esc_html__('Hide', 'imbuto-elementor-widgets'),
            'return_value' => 'yes',
            'default' => 'yes',
        ]);

        $summary_badges = new Repeater();

        $summary_badges->add_control('text', [
            'label' => esc_html__('Text', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::TEXT,
            'default' => esc_html__('2 operational', 'imbuto-elementor-widgets'),
            'label_block' => true,
        ]);

        $summary_badges->add_control('background', [
            'label' => esc_html__('Background', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::COLOR,
            'default' => '#dff5f2',
        ]);

        $summary_badges->add_control('color', [
            'label' => esc_html__('Text Color', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::COLOR,
            'default' => '#0f5b58',
        ]);

        $this->add_control('summary_badges', [
            'label' => esc_html__('Summary Badges', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $summary_badges->get_controls(),
            'default' => [
                [
                    'text' => '2 operational',
                    'background' => '#dff5f2',
                    'color' => '#0f5b58',
                ],
                [
                    'text' => '3 in development',
                    'background' => '#fff1e3',
                    'color' => '#a6511f',
                ],
            ],
            'title_field' => '{{{ text }}}',
            'condition' => [
                'show_summary_badges' => 'yes',
            ],
        ]);

        $this->add_control('show_buttons', [
            'label' => esc_html__('Show Buttons', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__('Show', 'imbuto-elementor-widgets'),
            'label_off' => esc_html__('Hide', 'imbuto-elementor-widgets'),
            'return_value' => 'yes',
            'default' => '',
        ]);

        $this->add_control('primary_label', [
            'label' => esc_html__('Primary Button Text', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::TEXT,
            'default' => '',
            'condition' => [
                'show_buttons' => 'yes',
            ],
        ]);

        $this->add_control('primary_url', [
            'label' => esc_html__('Primary Button URL', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::URL,
            'default' => ['url' => '/hubs'],
            'condition' => [
                'show_buttons' => 'yes',
            ],
        ]);

        $this->add_control('primary_icon', [
            'label' => esc_html__('Primary Button Icon', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::ICONS,
            'condition' => [
                'show_buttons' => 'yes',
            ],
        ]);

        $this->add_control('secondary_label', [
            'label' => esc_html__('Secondary Button Text', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::TEXT,
            'default' => '',
            'condition' => [
                'show_buttons' => 'yes',
            ],
        ]);

        $this->add_control('secondary_url', [
            'label' => esc_html__('Secondary Button URL', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::URL,
            'default' => ['url' => '/hubs#hub-map'],
            'condition' => [
                'show_buttons' => 'yes',
            ],
        ]);

        $this->add_control('secondary_icon', [
            'label' => esc_html__('Secondary Button Icon', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::ICONS,
            'condition' => [
                'show_buttons' => 'yes',
            ],
        ]);

        $this->add_control('show_status', [
            'label' => esc_html__('Show Hub Status Badge', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::SWITCHER,
            'return_value' => 'yes',
            'default' => 'yes',
        ]);

        $this->add_control('operational_status_icon', [
            'label' => esc_html__('Operational Status Icon', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::ICONS,
            'default' => ['value' => 'fas fa-circle-check', 'library' => 'fa-solid'],
            'condition' => [
                'show_status' => 'yes',
            ],
        ]);

        $this->add_control('development_status_icon', [
            'label' => esc_html__('Development Status Icon', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::ICONS,
            'default' => ['value' => 'fas fa-clock', 'library' => 'fa-solid'],
            'condition' => [
                'show_status' => 'yes',
            ],
        ]);

        $this->add_control('view_hub_label', [
            'label' => esc_html__('View Hub Label', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::TEXT,
            'default' => 'View Hub',
            'condition' => [
                'variant' => 'search',
            ],
        ]);

        $this->add_control('view_hub_icon', [
            'label' => esc_html__('View Hub Icon', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::ICONS,
            'default' => ['value' => 'fas fa-arrow-right', 'library' => 'fa-solid'],
            'condition' => [
                'variant' => 'search',
            ],
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

        $this->start_controls_section('summary_badges_style', ['label' => esc_html__('Summary Badges', 'imbuto-elementor-widgets'), 'tab' => Controls_Manager::TAB_STYLE]);
        $this->add_responsive_control('summary_badges_gap', ['label' => esc_html__('Gap', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['px'], 'range' => ['px' => ['min' => 0, 'max' => 40]], 'selectors' => ['{{WRAPPER}} .imbuto-hubs-summary-badges' => 'gap: {{SIZE}}{{UNIT}};']]);
        $this->add_responsive_control('summary_badges_padding', ['label' => esc_html__('Padding', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', 'em'], 'selectors' => ['{{WRAPPER}} .imbuto-hubs-summary-badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_responsive_control('summary_badges_radius', ['label' => esc_html__('Border Radius', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', '%'], 'selectors' => ['{{WRAPPER}} .imbuto-hubs-summary-badge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'summary_badges_typography', 'label' => esc_html__('Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-hubs-summary-badge']);
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
        $this->add_responsive_control('hub_list_gap', ['label' => esc_html__('List Gap', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['px'], 'range' => ['px' => ['min' => 0, 'max' => 50]], 'selectors' => ['{{WRAPPER}} .imbuto-hubs-list, {{WRAPPER}} .imbuto-hubs-card-grid' => 'gap: {{SIZE}}{{UNIT}};']]);
        $this->add_control('hub_background', ['label' => esc_html__('Hub Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-hub-card, {{WRAPPER}} .imbuto-hub-item--feature' => 'background: {{VALUE}};']]);
        $this->add_control('hub_active_background', ['label' => esc_html__('Active Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-hub-card.is-active, {{WRAPPER}} .imbuto-hub-item--feature.is-active' => 'background: {{VALUE}};']]);
        $this->add_control('hub_text_color', ['label' => esc_html__('Hub Text Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-hub-card h3, {{WRAPPER}} .imbuto-hub-item--feature strong' => 'color: {{VALUE}};']]);
        $this->add_control('hub_active_text_color', ['label' => esc_html__('Active Text Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-hub-card.is-active h3, {{WRAPPER}} .imbuto-hub-card.is-active .imbuto-hub-card__top p, {{WRAPPER}} .imbuto-hub-card.is-active .imbuto-hub-card__summary, {{WRAPPER}} .imbuto-hub-item--feature.is-active strong, {{WRAPPER}} .imbuto-hub-item--feature.is-active em' => 'color: {{VALUE}};']]);
        $this->add_control('hub_meta_color', ['label' => esc_html__('Hub Meta Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-hub-card__top p, {{WRAPPER}} .imbuto-hub-card__summary, {{WRAPPER}} .imbuto-hub-item--feature em' => 'color: {{VALUE}};']]);
        $this->add_control('hub_status_background', ['label' => esc_html__('Status Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-hub-status, {{WRAPPER}} .imbuto-hub-item--feature.is-active .imbuto-hub-status, {{WRAPPER}} .imbuto-hub-card.is-active .imbuto-hub-status' => 'background: {{VALUE}};']]);
        $this->add_control('hub_status_color', ['label' => esc_html__('Status Text Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-hub-status, {{WRAPPER}} .imbuto-hub-item--feature.is-active .imbuto-hub-status, {{WRAPPER}} .imbuto-hub-card.is-active .imbuto-hub-status' => 'color: {{VALUE}};']]);
        $this->add_responsive_control('hub_status_spacing', ['label' => esc_html__('Status Top Spacing', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['px', 'em'], 'range' => ['px' => ['min' => 0, 'max' => 80], 'em' => ['min' => 0, 'max' => 8, 'step' => 0.1]], 'selectors' => ['{{WRAPPER}} .imbuto-hub-status' => 'margin-top: {{SIZE}}{{UNIT}};']]);
        $this->add_responsive_control('hub_status_padding', ['label' => esc_html__('Status Padding', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', 'em'], 'selectors' => ['{{WRAPPER}} .imbuto-hub-status' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_responsive_control('hub_status_radius', ['label' => esc_html__('Status Radius', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', '%'], 'selectors' => ['{{WRAPPER}} .imbuto-hub-status' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_responsive_control('hub_status_card_gap', ['label' => esc_html__('Status Side Gap', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['px'], 'range' => ['px' => ['min' => 0, 'max' => 60]], 'selectors' => ['{{WRAPPER}} .imbuto-hub-card__top' => 'gap: {{SIZE}}{{UNIT}};', '{{WRAPPER}} .imbuto-hub-item--feature .imbuto-hub-status' => 'margin-left: {{SIZE}}{{UNIT}};']]);
        $this->add_control('hub_status_icon_color', ['label' => esc_html__('Status Icon Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-hub-status svg, {{WRAPPER}} .imbuto-hub-status i' => 'color: {{VALUE}};', '{{WRAPPER}} .imbuto-hub-status svg path' => 'fill: {{VALUE}};']]);
        $this->add_responsive_control('hub_status_icon_size', ['label' => esc_html__('Status Icon Size', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['px'], 'range' => ['px' => ['min' => 8, 'max' => 32]], 'selectors' => ['{{WRAPPER}} .imbuto-hub-status svg, {{WRAPPER}} .imbuto-hub-status i' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; font-size: {{SIZE}}{{UNIT}};']]);
        $this->add_responsive_control('hub_status_icon_gap', ['label' => esc_html__('Status Text/Icon Gap', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['px'], 'range' => ['px' => ['min' => 0, 'max' => 24]], 'selectors' => ['{{WRAPPER}} .imbuto-hub-status' => 'gap: {{SIZE}}{{UNIT}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'hub_title_typography', 'label' => esc_html__('Hub Title Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-hub-card h3, {{WRAPPER}} .imbuto-hub-item--feature strong']);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'hub_meta_typography', 'label' => esc_html__('Hub Meta Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-hub-card__top p, {{WRAPPER}} .imbuto-hub-card__summary, {{WRAPPER}} .imbuto-hub-item--feature em']);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'hub_status_typography', 'label' => esc_html__('Hub Status Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-hub-status']);
        $this->add_responsive_control('hub_padding', ['label' => esc_html__('Hub Padding', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', 'em'], 'selectors' => ['{{WRAPPER}} .imbuto-hub-card, {{WRAPPER}} .imbuto-hub-item--feature' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_responsive_control('hub_radius', ['label' => esc_html__('Hub Radius', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', '%'], 'selectors' => ['{{WRAPPER}} .imbuto-hub-card, {{WRAPPER}} .imbuto-hub-item--feature' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->end_controls_section();

        $this->start_controls_section('view_hub_style', ['label' => esc_html__('View Hub Button', 'imbuto-elementor-widgets'), 'tab' => Controls_Manager::TAB_STYLE]);
        $this->add_control('view_hub_color', ['label' => esc_html__('Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-hub-card__link' => 'color: {{VALUE}};']]);
        $this->add_control('view_hub_icon_color', ['label' => esc_html__('Icon Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-hub-card__link svg, {{WRAPPER}} .imbuto-hub-card__link i' => 'color: {{VALUE}};', '{{WRAPPER}} .imbuto-hub-card__link svg path' => 'fill: {{VALUE}};']]);
        $this->add_control('view_hub_active_color', ['label' => esc_html__('Active Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-hub-card.is-active .imbuto-hub-card__link' => 'color: {{VALUE}};']]);
        $this->add_control('view_hub_background', ['label' => esc_html__('Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-hub-card__link' => 'background: {{VALUE}};']]);
        $this->add_control('view_hub_hover_background', ['label' => esc_html__('Hover Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-hub-card__link:hover' => 'background: {{VALUE}};']]);
        $this->add_control('view_hub_hover_color', ['label' => esc_html__('Hover Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-hub-card__link:hover' => 'color: {{VALUE}};']]);
        $this->add_control('view_hub_hover_icon_color', ['label' => esc_html__('Hover Icon Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-hub-card__link:hover svg, {{WRAPPER}} .imbuto-hub-card__link:hover i' => 'color: {{VALUE}};', '{{WRAPPER}} .imbuto-hub-card__link:hover svg path' => 'fill: {{VALUE}};']]);
        $this->add_control('view_hub_border_color', ['label' => esc_html__('Border Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-hub-card__link' => 'border-color: {{VALUE}};']]);
        $this->add_responsive_control('view_hub_spacing', ['label' => esc_html__('Top Spacing', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['px', 'em'], 'range' => ['px' => ['min' => 0, 'max' => 100], 'em' => ['min' => 0, 'max' => 8, 'step' => 0.1]], 'selectors' => ['{{WRAPPER}} .imbuto-hub-card__link' => 'margin-top: {{SIZE}}{{UNIT}};']]);
        $this->add_responsive_control('view_hub_padding', ['label' => esc_html__('Padding', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', 'em'], 'selectors' => ['{{WRAPPER}} .imbuto-hub-card__link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_responsive_control('view_hub_radius', ['label' => esc_html__('Radius', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', '%'], 'selectors' => ['{{WRAPPER}} .imbuto-hub-card__link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_responsive_control('view_hub_icon_size', ['label' => esc_html__('Icon Size', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['px'], 'range' => ['px' => ['min' => 8, 'max' => 32]], 'selectors' => ['{{WRAPPER}} .imbuto-hub-card__link svg, {{WRAPPER}} .imbuto-hub-card__link i' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; font-size: {{SIZE}}{{UNIT}};']]);
        $this->add_responsive_control('view_hub_icon_gap', ['label' => esc_html__('Text/Icon Gap', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['px'], 'range' => ['px' => ['min' => 0, 'max' => 32]], 'selectors' => ['{{WRAPPER}} .imbuto-hub-card__link' => 'gap: {{SIZE}}{{UNIT}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'view_hub_typography', 'label' => esc_html__('Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-hub-card__link']);
        $this->end_controls_section();

        $this->start_controls_section('map_style', ['label' => esc_html__('Map', 'imbuto-elementor-widgets'), 'tab' => Controls_Manager::TAB_STYLE]);
        $this->add_control('map_frame_background', ['label' => esc_html__('Map Frame Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-hubs-map-frame' => 'background: {{VALUE}};']]);
        $this->add_control('map_frame_border_color', ['label' => esc_html__('Map Frame Border Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-hubs-map-frame' => 'border-color: {{VALUE}};']]);
        $this->add_responsive_control('map_frame_padding', ['label' => esc_html__('Map Frame Padding', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px'], 'selectors' => ['{{WRAPPER}} .imbuto-hubs-map-frame' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_responsive_control('map_frame_radius', ['label' => esc_html__('Map Frame Radius', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', '%'], 'selectors' => ['{{WRAPPER}} .imbuto-hubs-map-frame' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_responsive_control('map_height', ['label' => esc_html__('Map Height', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['px'], 'range' => ['px' => ['min' => 260, 'max' => 760]], 'selectors' => ['{{WRAPPER}} .imbuto-hubs-map' => 'height: {{SIZE}}{{UNIT}}; min-height: {{SIZE}}{{UNIT}};']]);
        $this->end_controls_section();

        $this->start_controls_section('filters_style', ['label' => esc_html__('Search & Filters', 'imbuto-elementor-widgets'), 'tab' => Controls_Manager::TAB_STYLE]);
        $this->add_control('filters_background', ['label' => esc_html__('Filter Bar Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-hubs-filterbar' => 'background: {{VALUE}};']]);
        $this->add_control('filters_border_color', ['label' => esc_html__('Filter Bar Border Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-hubs-filterbar' => 'border-color: {{VALUE}};']]);
        $this->add_responsive_control('filters_padding', ['label' => esc_html__('Filter Bar Padding', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', 'em'], 'selectors' => ['{{WRAPPER}} .imbuto-hubs-filterbar' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_responsive_control('filters_radius', ['label' => esc_html__('Filter Bar Radius', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', '%'], 'selectors' => ['{{WRAPPER}} .imbuto-hubs-filterbar' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_control('field_background', ['label' => esc_html__('Field Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-hubs-filterbar input, {{WRAPPER}} .imbuto-hubs-filterbar select' => 'background: {{VALUE}};']]);
        $this->add_control('field_color', ['label' => esc_html__('Field Text Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-hubs-filterbar input, {{WRAPPER}} .imbuto-hubs-filterbar select' => 'color: {{VALUE}};']]);
        $this->add_control('field_border_color', ['label' => esc_html__('Field Border Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-hubs-filterbar input, {{WRAPPER}} .imbuto-hubs-filterbar select' => 'border-color: {{VALUE}};']]);
        $this->add_control('field_focus_border_color', ['label' => esc_html__('Field Focus Border Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-hubs-filterbar input:focus, {{WRAPPER}} .imbuto-hubs-filterbar select:focus' => 'border-color: {{VALUE}};']]);
        $this->add_control('field_icon_color', ['label' => esc_html__('Field Icon Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-hubs-filter-field svg, {{WRAPPER}} .imbuto-hubs-filter-field i' => 'color: {{VALUE}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'filter_field_typography', 'label' => esc_html__('Field Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-hubs-filterbar input, {{WRAPPER}} .imbuto-hubs-filterbar select']);
        $this->end_controls_section();
    }

    protected function render(): void
    {
        enqueue_frontend_assets(true);
        $settings = $this->get_settings_for_display();
        $hubs = get_hubs();
        $map_id = 'imbuto-map-' . $this->get_id();
        $summary_badges = $this->get_summary_badges($settings);
        $variant = ($settings['variant'] ?? 'feature') === 'search' ? 'search' : 'feature';

        if ($variant === 'search') {
            $this->render_search_filter_layout($settings, $hubs, $map_id);
            return;
        }
        ?>
        <section class="imbuto-hubs-map-section imbuto-hubs-map-section--feature">
            <div class="imbuto-container">
                <div class="imbuto-hubs-panel">
                    <div class="imbuto-hubs-map-layout">
                        <div class="imbuto-hubs__copy">
                            <div class="imbuto-hubs__eyebrow"><?php echo esc_html($settings['eyebrow']); ?></div>
                            <h2><?php echo esc_html($settings['title']); ?></h2>
                            <p><?php echo esc_html($settings['description']); ?></p>
                            <?php if (($settings['show_summary_badges'] ?? 'yes') === 'yes') : ?>
                                <div class="imbuto-hubs-summary-badges">
                                    <?php foreach ($summary_badges as $badge) : ?>
                                        <?php if (!empty($badge['text'])) : ?><span class="imbuto-hubs-summary-badge" style="<?php echo esc_attr($this->get_summary_badge_style($badge)); ?>"><?php echo esc_html($badge['text']); ?></span><?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                            <?php if (($settings['show_buttons'] ?? '') === 'yes') : ?>
                                <div class="imbuto-hubs__buttons">
                                    <?php if (!empty($settings['primary_label'])) : ?><a class="imbuto-button imbuto-button--teal imbuto-hubs__primary" href="<?php echo esc_url($settings['primary_url']['url'] ?? '#'); ?>"><?php echo esc_html($settings['primary_label']); ?><?php Icons_Manager::render_icon($settings['primary_icon'], ['aria-hidden' => 'true']); ?></a><?php endif; ?>
                                    <?php if (!empty($settings['secondary_label'])) : ?><a class="imbuto-button imbuto-button--outline-teal imbuto-hubs__secondary" href="<?php echo esc_url($settings['secondary_url']['url'] ?? '#'); ?>"><?php echo esc_html($settings['secondary_label']); ?><?php Icons_Manager::render_icon($settings['secondary_icon'], ['aria-hidden' => 'true']); ?></a><?php endif; ?>
                                </div>
                            <?php endif; ?>
                            <div class="imbuto-hubs-list">
                                <?php foreach ($hubs as $index => $hub) : ?>
                                    <button class="imbuto-hub-item imbuto-hub-item--feature <?php echo $index === 0 ? 'is-active' : ''; ?>" type="button" data-hub-id="<?php echo esc_attr($hub['id']); ?>" data-map-id="<?php echo esc_attr($map_id); ?>">
                                        <strong><?php echo esc_html($hub['name']); ?></strong>
                                        <em><?php echo esc_html($this->get_hub_region($hub)); ?></em>
                                        <?php if (($settings['show_status'] ?? 'yes') === 'yes') : ?><?php $this->render_status_badge($hub, $settings); ?><?php endif; ?>
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

    private function render_search_filter_layout(array $settings, array $hubs, string $map_id): void
    {
        $province_options = $this->get_repeater_labels($settings['province_options'] ?? [], ['Kigali City', 'Northern Province', 'Southern Province', 'Western Province', 'Eastern Province']);
        $status_options = $this->get_repeater_labels($settings['status_options'] ?? [], ['Operational', 'In Development']);
        $programme_options = $this->get_repeater_labels($settings['programme_options'] ?? [], ['Early Childhood Development & Family', 'Digital Literacy & Innovation', 'Health & Wellbeing', 'Sports & Recreation']);
        $filter_hubs = array_map(fn ($hub) => $this->get_filter_hub($hub, $programme_options), $hubs);
        ?>
        <section id="hub-map" class="imbuto-hubs-map-section imbuto-hubs-map-section--search">
            <div class="imbuto-container">
                <div class="imbuto-hubs-search-head">
                    <div>
                        <?php if (!empty($settings['eyebrow'])) : ?><div class="imbuto-hubs__eyebrow"><?php echo esc_html($settings['eyebrow']); ?></div><?php endif; ?>
                        <h2><?php echo esc_html($settings['title']); ?></h2>
                    </div>
                    <?php if (!empty($settings['description'])) : ?><p><?php echo esc_html($settings['description']); ?></p><?php endif; ?>
                </div>

                <div class="imbuto-hubs-filterbar" data-imbuto-hub-filters="<?php echo esc_attr($map_id); ?>">
                    <label class="imbuto-hubs-filter-field imbuto-hubs-filter-field--search">
                        <span class="screen-reader-text"><?php echo esc_html__('Search hubs', 'imbuto-elementor-widgets'); ?></span>
                        <?php Icons_Manager::render_icon(['value' => 'fas fa-search', 'library' => 'fa-solid'], ['aria-hidden' => 'true']); ?>
                        <input type="search" data-filter-type="query" placeholder="<?php echo esc_attr($settings['search_placeholder'] ?? 'Search by hub, district, or province'); ?>">
                    </label>
                    <?php $this->render_filter_select($province_options, 'province', esc_html__('All provinces', 'imbuto-elementor-widgets')); ?>
                    <?php $this->render_filter_select($status_options, 'status', esc_html__('All statuses', 'imbuto-elementor-widgets')); ?>
                    <?php $this->render_filter_select($programme_options, 'programme', esc_html__('All programmes', 'imbuto-elementor-widgets')); ?>
                </div>

                <div class="imbuto-hubs-search-layout">
                    <div class="imbuto-hubs-map-frame">
                        <div id="<?php echo esc_attr($map_id); ?>" class="imbuto-hubs-map" data-hubs="<?php echo esc_attr(wp_json_encode($filter_hubs)); ?>" data-pin="<?php echo esc_url(image_url('pin.png')); ?>"></div>
                    </div>
                    <div class="imbuto-hubs-card-grid" data-imbuto-hub-results="<?php echo esc_attr($map_id); ?>">
                        <div class="imbuto-hubs-empty" hidden><?php echo esc_html($settings['empty_message'] ?? 'No hubs match those filters yet. Try removing one filter or search term.'); ?></div>
                        <?php foreach ($filter_hubs as $index => $hub) : ?>
                            <article class="imbuto-hub-card <?php echo $index === 0 ? 'is-active' : ''; ?>" data-map-id="<?php echo esc_attr($map_id); ?>" data-hub-id="<?php echo esc_attr($hub['id']); ?>" data-query="<?php echo esc_attr($hub['search_text']); ?>" data-province="<?php echo esc_attr($hub['province']); ?>" data-status="<?php echo esc_attr($hub['status']); ?>" data-programmes="<?php echo esc_attr(implode('|', $hub['programmes'])); ?>">
                                <div class="imbuto-hub-card__top">
                                    <div>
                                        <h3><?php echo esc_html($hub['name']); ?></h3>
                                        <p><?php echo esc_html($this->get_hub_location($hub)); ?></p>
                                        <?php if (($settings['show_status'] ?? 'yes') === 'yes') : ?><?php $this->render_status_badge($hub, $settings); ?><?php endif; ?>
                                    </div>
                                </div>
                                <?php if (!empty($hub['summary'])) : ?><p class="imbuto-hub-card__summary"><?php echo esc_html($hub['summary']); ?></p><?php endif; ?>
                                <a href="<?php echo esc_url($hub['url'] ?? '#'); ?>" class="imbuto-hub-card__link">
                                    <?php echo esc_html($settings['view_hub_label'] ?? 'View Hub'); ?>
                                    <?php if (!empty($settings['view_hub_icon']['value'])) : ?>
                                        <?php Icons_Manager::render_icon($settings['view_hub_icon'], ['aria-hidden' => 'true']); ?>
                                    <?php endif; ?>
                                </a>
                            </article>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }

    private function render_filter_select(array $options, string $type, string $default_label): void
    {
        ?>
        <label class="imbuto-hubs-filter-field">
            <span class="screen-reader-text"><?php echo esc_html($default_label); ?></span>
            <?php Icons_Manager::render_icon(['value' => 'fas fa-filter', 'library' => 'fa-solid'], ['aria-hidden' => 'true']); ?>
            <select data-filter-type="<?php echo esc_attr($type); ?>">
                <option value=""><?php echo esc_html($default_label); ?></option>
                <?php foreach ($options as $option) : ?>
                    <option value="<?php echo esc_attr($option); ?>"><?php echo esc_html($option); ?></option>
                <?php endforeach; ?>
            </select>
        </label>
        <?php
    }

    private function get_hub_location(array $hub): string
    {
        if (!empty($hub['location'])) {
            return (string) $hub['location'];
        }

        return trim(($hub['district'] ?? '') . ', ' . ($hub['province'] ?? ''), ', ');
    }

    private function get_hub_region(array $hub): string
    {
        if (!empty($hub['province'])) {
            return (string) $hub['province'];
        }

        if (!empty($hub['location'])) {
            $parts = array_map('trim', explode(',', (string) $hub['location']));
            return end($parts) ?: (string) $hub['location'];
        }

        return $this->get_hub_location($hub);
    }

    private function get_repeater_labels(array $items, array $fallback): array
    {
        $labels = [];

        foreach ($items as $item) {
            if (!empty($item['label'])) {
                $labels[] = trim((string) $item['label']);
            }
        }

        $labels = array_values(array_unique(array_filter($labels)));

        return $labels ?: $fallback;
    }

    private function get_filter_hub(array $hub, array $programme_options): array
    {
        $province = !empty($hub['province']) ? (string) $hub['province'] : (string) ($hub['location'] ?? '');
        $district = !empty($hub['district']) ? (string) $hub['district'] : trim(str_replace(['Imbuto Hub ', ' (Maison de Jeunes)'], '', (string) ($hub['name'] ?? '')));
        $programmes = !empty($hub['programmes']) && is_array($hub['programmes']) ? $hub['programmes'] : $programme_options;
        $search_parts = [$hub['name'] ?? '', $district, $province, $hub['status'] ?? '', $hub['summary'] ?? '', implode(' ', $programmes)];

        $hub['province'] = $province;
        $hub['district'] = $district;
        $hub['programmes'] = $programmes;
        $hub['search_text'] = strtolower(trim(implode(' ', array_filter($search_parts))));

        return $hub;
    }

    private function render_status_badge(array $hub, array $settings): void
    {
        $status = (string) ($hub['status'] ?? '');
        $icon = $this->get_status_icon($status, $settings);
        ?>
        <span class="imbuto-hub-status <?php echo esc_attr($this->get_status_class($status)); ?>">
            <?php if (!empty($icon['value'])) : ?>
                <?php Icons_Manager::render_icon($icon, ['aria-hidden' => 'true']); ?>
            <?php endif; ?>
            <span><?php echo esc_html($status ?: 'Hub'); ?></span>
        </span>
        <?php
    }

    private function get_status_icon(string $status, array $settings): array
    {
        $normalized = strtolower(trim($status));
        $is_development = $normalized === 'in development' || strpos($normalized, 'development') !== false;
        $setting_key = $is_development ? 'development_status_icon' : 'operational_status_icon';
        $fallback = $is_development
            ? ['value' => 'fas fa-clock', 'library' => 'fa-solid']
            : ['value' => 'fas fa-circle-check', 'library' => 'fa-solid'];

        return !empty($settings[$setting_key]) && is_array($settings[$setting_key]) ? $settings[$setting_key] : $fallback;
    }

    private function get_status_class(string $status): string
    {
        return sanitize_html_class('imbuto-hub-status--' . strtolower(str_replace(' ', '-', $status)));
    }

    private function get_summary_badges(array $settings): array
    {
        if (!empty($settings['summary_badges']) && is_array($settings['summary_badges'])) {
            return $settings['summary_badges'];
        }

        return [
            [
                'text' => '2 operational',
                'background' => '#dff5f2',
                'color' => '#0f5b58',
            ],
            [
                'text' => '3 in development',
                'background' => '#fff1e3',
                'color' => '#a6511f',
            ],
        ];
    }

    private function get_summary_badge_style(array $badge): string
    {
        $styles = [];
        $background = !empty($badge['background']) ? sanitize_hex_color($badge['background']) : '';
        $color = !empty($badge['color']) ? sanitize_hex_color($badge['color']) : '';

        if ($background) {
            $styles[] = 'background: ' . $background;
        }

        if ($color) {
            $styles[] = 'color: ' . $color;
        }

        return implode('; ', $styles);
    }
}
