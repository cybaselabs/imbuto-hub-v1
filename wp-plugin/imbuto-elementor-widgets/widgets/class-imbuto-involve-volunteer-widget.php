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

class Involve_Volunteer_Widget extends Widget_Base
{
    public function get_name(): string
    {
        return 'imbuto_involve_volunteer';
    }

    public function get_title(): string
    {
        return esc_html__('Imbuto Volunteer & Mentor', 'imbuto-elementor-widgets');
    }

    public function get_icon(): string
    {
        return 'eicon-person';
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
        $this->start_controls_section('content_section', ['label' => esc_html__('Content', 'imbuto-elementor-widgets')]);
        $this->add_control('section_id', ['label' => esc_html__('Section ID', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'volunteer']);
        $this->add_control('eyebrow', ['label' => esc_html__('Eyebrow', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'Volunteer & Mentor']);
        $this->add_control('title', ['label' => esc_html__('Title', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXTAREA, 'default' => 'Your experience is someone else\'s opportunity.']);
        $this->add_control('description', ['label' => esc_html__('Description', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXTAREA, 'default' => 'Support young people through mentorship, coaching, training sessions, or community activities. Share your knowledge and help others build confidence and direction.']);
        $this->add_control('button_label', ['label' => esc_html__('Button Label', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'Submit Volunteer Application']);
        $this->add_control('button_url', ['label' => esc_html__('Button URL', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::URL, 'default' => ['url' => '#volunteer-form']]);
        $this->add_control('button_icon', ['label' => esc_html__('Button Icon', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::ICONS, 'default' => ['value' => 'fas fa-arrow-right', 'library' => 'fa-solid']]);
        $this->add_control('button_icon_position', [
            'label' => esc_html__('Button Icon Position', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::SELECT,
            'default' => 'after',
            'options' => [
                'before' => esc_html__('Before Text', 'imbuto-elementor-widgets'),
                'after' => esc_html__('After Text', 'imbuto-elementor-widgets'),
            ],
        ]);
        $this->end_controls_section();

        $this->start_controls_section('ways_section', ['label' => esc_html__('Volunteer Ways', 'imbuto-elementor-widgets')]);
        $ways = new Repeater();
        $ways->add_control('icon', ['label' => esc_html__('Icon', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::ICONS, 'default' => ['value' => 'fas fa-wand-magic-sparkles', 'library' => 'fa-solid']]);
        $ways->add_control('title', ['label' => esc_html__('Title', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'Programme Delivery']);
        $ways->add_control('text', ['label' => esc_html__('Text', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXTAREA, 'default' => 'Lead or support learning sessions in your area of expertise.']);
        $this->add_control('ways', [
            'label' => esc_html__('Cards', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $ways->get_controls(),
            'title_field' => '{{{ title }}}',
            'default' => [
                ['title' => 'Programme Delivery', 'text' => 'Lead or support learning sessions in your area of expertise.', 'icon' => ['value' => 'fas fa-wand-magic-sparkles', 'library' => 'fa-solid']],
                ['title' => 'Mentorship', 'text' => 'Guide a young person through education, career decisions, and personal growth.', 'icon' => ['value' => 'far fa-handshake', 'library' => 'fa-regular']],
                ['title' => 'Skills Facilitation', 'text' => 'Teach practical skills such as coding, fashion, agriculture, sports coaching, health education, or financial literacy.', 'icon' => ['value' => 'fas fa-chalkboard-user', 'library' => 'fa-solid']],
                ['title' => 'Community Activation', 'text' => 'Help organise events and bring more people into the hub community.', 'icon' => ['value' => 'fas fa-people-group', 'library' => 'fa-solid']],
            ],
        ]);
        $this->end_controls_section();

        $this->start_controls_section('gains_section', ['label' => esc_html__('Volunteer Gains', 'imbuto-elementor-widgets')]);
        $this->add_control('gains_title', ['label' => esc_html__('Title', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'What volunteers gain']);
        $this->add_control('gains_icon', ['label' => esc_html__('List Icon', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::ICONS, 'default' => ['value' => 'fas fa-circle-check', 'library' => 'fa-solid']]);
        $gains = new Repeater();
        $gains->add_control('text', ['label' => esc_html__('Text', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXTAREA, 'default' => 'A meaningful connection to Rwanda\'s youth development story', 'label_block' => true]);
        $this->add_control('gains', [
            'label' => esc_html__('Gain Items', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $gains->get_controls(),
            'title_field' => '{{{ text }}}',
            'default' => [
                ['text' => 'A meaningful connection to Rwanda\'s youth development story'],
                ['text' => 'Recognition and reference letters for formal volunteer service'],
                ['text' => 'Training and orientation from Imbuto Foundation staff'],
                ['text' => 'A community of like-minded changemakers'],
            ],
        ]);
        $this->end_controls_section();

        $this->add_common_style_controls('.imbuto-involve-volunteer');
    }

    private function add_common_style_controls(string $scope): void
    {
        $this->start_controls_section('section_style', ['label' => esc_html__('Section & Layout', 'imbuto-elementor-widgets'), 'tab' => Controls_Manager::TAB_STYLE]);
        $this->add_control('section_background', ['label' => esc_html__('Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ["{{WRAPPER}} {$scope}" => 'background: {{VALUE}};']]);
        $this->add_responsive_control('section_padding', ['label' => esc_html__('Padding', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', 'em', '%'], 'selectors' => ["{{WRAPPER}} {$scope}" => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_responsive_control('column_gap', ['label' => esc_html__('Column Gap', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['px'], 'range' => ['px' => ['min' => 0, 'max' => 140]], 'selectors' => ["{{WRAPPER}} {$scope}__grid" => 'gap: {{SIZE}}{{UNIT}};']]);
        $this->end_controls_section();

        $this->start_controls_section('text_style', ['label' => esc_html__('Text', 'imbuto-elementor-widgets'), 'tab' => Controls_Manager::TAB_STYLE]);
        $this->add_control('eyebrow_color', ['label' => esc_html__('Eyebrow Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ["{{WRAPPER}} {$scope}__eyebrow" => 'color: {{VALUE}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'eyebrow_typography', 'label' => esc_html__('Eyebrow Typography', 'imbuto-elementor-widgets'), 'selector' => "{{WRAPPER}} {$scope}__eyebrow"]);
        $this->add_control('title_color', ['label' => esc_html__('Title Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ["{{WRAPPER}} {$scope}__copy h2" => 'color: {{VALUE}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'title_typography', 'label' => esc_html__('Title Typography', 'imbuto-elementor-widgets'), 'selector' => "{{WRAPPER}} {$scope}__copy h2"]);
        $this->add_control('description_color', ['label' => esc_html__('Description Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ["{{WRAPPER}} {$scope}__copy > p" => 'color: {{VALUE}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'description_typography', 'label' => esc_html__('Description Typography', 'imbuto-elementor-widgets'), 'selector' => "{{WRAPPER}} {$scope}__copy > p"]);
        $this->end_controls_section();

        $this->start_controls_section('button_style', ['label' => esc_html__('Button', 'imbuto-elementor-widgets'), 'tab' => Controls_Manager::TAB_STYLE]);
        $this->add_control('button_color', ['label' => esc_html__('Text Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-involve-button' => 'color: {{VALUE}};']]);
        $this->add_control('button_background', ['label' => esc_html__('Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-involve-button' => 'background: {{VALUE}};']]);
        $this->add_control('button_hover_background', ['label' => esc_html__('Hover Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-involve-button:hover' => 'background: {{VALUE}};']]);
        $this->add_control('button_icon_color', ['label' => esc_html__('Icon Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-involve-button svg, {{WRAPPER}} .imbuto-involve-button i' => 'color: {{VALUE}};', '{{WRAPPER}} .imbuto-involve-button svg path' => 'fill: {{VALUE}};']]);
        $this->add_responsive_control('button_icon_size', ['label' => esc_html__('Icon Size', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['px'], 'range' => ['px' => ['min' => 8, 'max' => 48]], 'selectors' => ['{{WRAPPER}} .imbuto-involve-button svg, {{WRAPPER}} .imbuto-involve-button i' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; font-size: {{SIZE}}{{UNIT}};']]);
        $this->add_responsive_control('button_padding', ['label' => esc_html__('Padding', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', 'em'], 'selectors' => ['{{WRAPPER}} .imbuto-involve-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_responsive_control('button_radius', ['label' => esc_html__('Radius', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', '%'], 'selectors' => ['{{WRAPPER}} .imbuto-involve-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_responsive_control('button_gap', ['label' => esc_html__('Text/Icon Gap', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['px'], 'range' => ['px' => ['min' => 0, 'max' => 40]], 'selectors' => ['{{WRAPPER}} .imbuto-involve-button' => 'gap: {{SIZE}}{{UNIT}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'button_typography', 'label' => esc_html__('Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-involve-button']);
        $this->end_controls_section();

        $this->start_controls_section('card_style', ['label' => esc_html__('Cards', 'imbuto-elementor-widgets'), 'tab' => Controls_Manager::TAB_STYLE]);
        $this->add_responsive_control('cards_gap', ['label' => esc_html__('Cards Gap', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['px'], 'range' => ['px' => ['min' => 0, 'max' => 80]], 'selectors' => ["{{WRAPPER}} {$scope}__cards" => 'gap: {{SIZE}}{{UNIT}};']]);
        $this->add_control('card_background', ['label' => esc_html__('Card Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ["{{WRAPPER}} {$scope}__card, {{WRAPPER}} {$scope}__panel" => 'background: {{VALUE}};']]);
        $this->add_control('card_border', ['label' => esc_html__('Card Border', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ["{{WRAPPER}} {$scope}__card, {{WRAPPER}} {$scope}__panel" => 'border-color: {{VALUE}};']]);
        $this->add_responsive_control('card_padding', ['label' => esc_html__('Card Padding', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', 'em'], 'selectors' => ["{{WRAPPER}} {$scope}__card, {{WRAPPER}} {$scope}__panel" => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_responsive_control('card_radius', ['label' => esc_html__('Card Radius', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', '%'], 'selectors' => ["{{WRAPPER}} {$scope}__card, {{WRAPPER}} {$scope}__panel" => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_control('card_title_color', ['label' => esc_html__('Card Title Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ["{{WRAPPER}} {$scope}__card h3" => 'color: {{VALUE}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'card_title_typography', 'label' => esc_html__('Card Title Typography', 'imbuto-elementor-widgets'), 'selector' => "{{WRAPPER}} {$scope}__card h3"]);
        $this->add_responsive_control('card_title_spacing', ['label' => esc_html__('Card Title Spacing', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['px', 'em'], 'range' => ['px' => ['min' => 0, 'max' => 80], 'em' => ['min' => 0, 'max' => 6]], 'selectors' => ["{{WRAPPER}} {$scope}__card h3" => 'margin-top: {{SIZE}}{{UNIT}};']]);
        $this->add_control('card_text_color', ['label' => esc_html__('Card Text Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ["{{WRAPPER}} {$scope}__card p" => 'color: {{VALUE}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'card_text_typography', 'label' => esc_html__('Card Text Typography', 'imbuto-elementor-widgets'), 'selector' => "{{WRAPPER}} {$scope}__card p"]);
        $this->add_responsive_control('card_text_spacing', ['label' => esc_html__('Card Text Spacing', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['px', 'em'], 'range' => ['px' => ['min' => 0, 'max' => 80], 'em' => ['min' => 0, 'max' => 6]], 'selectors' => ["{{WRAPPER}} {$scope}__card p" => 'margin-top: {{SIZE}}{{UNIT}};']]);
        $this->add_control('gain_title_color', ['label' => esc_html__('Gains Title Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ["{{WRAPPER}} {$scope}__panel h3" => 'color: {{VALUE}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'gain_title_typography', 'label' => esc_html__('Gains Title Typography', 'imbuto-elementor-widgets'), 'selector' => "{{WRAPPER}} {$scope}__panel h3"]);
        $this->add_control('gain_text_color', ['label' => esc_html__('Gains Text Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ["{{WRAPPER}} {$scope}__gain" => 'color: {{VALUE}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'gain_text_typography', 'label' => esc_html__('Gains Text Typography', 'imbuto-elementor-widgets'), 'selector' => "{{WRAPPER}} {$scope}__gain"]);
        $this->add_responsive_control('gains_gap', ['label' => esc_html__('Gains Gap', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['px'], 'range' => ['px' => ['min' => 0, 'max' => 60]], 'selectors' => ["{{WRAPPER}} {$scope}__gain-list" => 'gap: {{SIZE}}{{UNIT}};']]);
        $this->end_controls_section();

        $this->start_controls_section('icon_style', ['label' => esc_html__('Icons', 'imbuto-elementor-widgets'), 'tab' => Controls_Manager::TAB_STYLE]);
        $this->add_control('icon_background', ['label' => esc_html__('Icon Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ["{{WRAPPER}} {$scope}__icon" => 'background: {{VALUE}};']]);
        $this->add_control('icon_color', ['label' => esc_html__('Icon Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ["{{WRAPPER}} {$scope}__icon, {{WRAPPER}} {$scope}__check" => 'color: {{VALUE}};', "{{WRAPPER}} {$scope}__icon svg path, {{WRAPPER}} {$scope}__check svg path" => 'fill: {{VALUE}};']]);
        $this->add_responsive_control('icon_box_size', ['label' => esc_html__('Icon Box Size', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['px'], 'range' => ['px' => ['min' => 24, 'max' => 100]], 'selectors' => ["{{WRAPPER}} {$scope}__icon" => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};']]);
        $this->add_responsive_control('icon_size', ['label' => esc_html__('Icon Size', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['px'], 'range' => ['px' => ['min' => 10, 'max' => 48]], 'selectors' => ["{{WRAPPER}} {$scope}__icon svg, {{WRAPPER}} {$scope}__icon i, {{WRAPPER}} {$scope}__check svg, {{WRAPPER}} {$scope}__check i" => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; font-size: {{SIZE}}{{UNIT}};']]);
        $this->end_controls_section();
    }

    protected function render(): void
    {
        enqueue_frontend_assets();
        $settings = $this->get_settings_for_display();
        ?>
        <section id="<?php echo esc_attr($settings['section_id'] ?? 'volunteer'); ?>" class="imbuto-involve-volunteer">
            <div class="imbuto-container">
                <div class="imbuto-involve-volunteer__grid">
                    <div class="imbuto-involve-volunteer__copy">
                        <?php if (!empty($settings['eyebrow'])) : ?><div class="imbuto-involve-volunteer__eyebrow"><?php echo esc_html($settings['eyebrow']); ?></div><?php endif; ?>
                        <?php if (!empty($settings['title'])) : ?><h2><?php echo esc_html($settings['title']); ?></h2><?php endif; ?>
                        <?php if (!empty($settings['description'])) : ?><p><?php echo esc_html($settings['description']); ?></p><?php endif; ?>
                        <?php if (!empty($settings['button_label'])) : ?>
                            <a class="imbuto-involve-button" href="<?php echo esc_url($settings['button_url']['url'] ?? '#'); ?>">
                                <?php if (($settings['button_icon_position'] ?? 'after') === 'before' && !empty($settings['button_icon']['value'])) : ?><?php Icons_Manager::render_icon($settings['button_icon'], ['aria-hidden' => 'true']); ?><?php endif; ?>
                                <?php echo esc_html($settings['button_label']); ?>
                                <?php if (($settings['button_icon_position'] ?? 'after') === 'after' && !empty($settings['button_icon']['value'])) : ?><?php Icons_Manager::render_icon($settings['button_icon'], ['aria-hidden' => 'true']); ?><?php endif; ?>
                            </a>
                        <?php endif; ?>
                    </div>
                    <div>
                        <div class="imbuto-involve-volunteer__cards">
                            <?php foreach (($settings['ways'] ?? []) as $way) : ?>
                                <article class="imbuto-involve-volunteer__card">
                                    <div class="imbuto-involve-volunteer__icon"><?php Icons_Manager::render_icon($way['icon'], ['aria-hidden' => 'true']); ?></div>
                                    <h3><?php echo esc_html($way['title'] ?? ''); ?></h3>
                                    <p><?php echo esc_html($way['text'] ?? ''); ?></p>
                                </article>
                            <?php endforeach; ?>
                        </div>
                        <div class="imbuto-involve-volunteer__panel">
                            <?php if (!empty($settings['gains_title'])) : ?><h3><?php echo esc_html($settings['gains_title']); ?></h3><?php endif; ?>
                            <div class="imbuto-involve-volunteer__gain-list">
                                <?php foreach (($settings['gains'] ?? []) as $gain) : ?>
                                    <div class="imbuto-involve-volunteer__gain">
                                        <span class="imbuto-involve-volunteer__check"><?php Icons_Manager::render_icon($settings['gains_icon'], ['aria-hidden' => 'true']); ?></span>
                                        <span><?php echo esc_html($gain['text'] ?? ''); ?></span>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
}
