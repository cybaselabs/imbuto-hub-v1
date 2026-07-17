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

class Split_Feature_Widget extends Widget_Base
{
    public function get_name(): string
    {
        return 'imbuto_split_feature';
    }

    public function get_title(): string
    {
        return esc_html__('Imbuto Split Feature Panel', 'imbuto-elementor-widgets');
    }

    public function get_icon(): string
    {
        return 'eicon-columns';
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
        $this->start_controls_section('lead_section', ['label' => esc_html__('Lead Panel', 'imbuto-elementor-widgets')]);
        $this->add_control('eyebrow', ['label' => esc_html__('Eyebrow', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'Why Imbuto Hubs Exist']);
        $this->add_control('title', ['label' => esc_html__('Title', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXTAREA, 'default' => 'A brighter answer to connected challenges.']);

        $tags = new Repeater();
        $tags->add_control('label', ['label' => esc_html__('Label', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'Health']);
        $tags->add_control('subtitle', ['label' => esc_html__('Subtitle', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'Support']);
        $this->add_control('tags', [
            'label' => esc_html__('Summary Tags', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $tags->get_controls(),
            'title_field' => '{{{ label }}}',
            'default' => [
                ['label' => 'Health', 'subtitle' => 'Support'],
                ['label' => 'Skills', 'subtitle' => 'Pathways'],
                ['label' => 'Safe spaces', 'subtitle' => 'Access'],
                ['label' => 'Community', 'subtitle' => 'Trust'],
            ],
        ]);
        $this->end_controls_section();

        $this->start_controls_section('cards_section', ['label' => esc_html__('Feature Cards', 'imbuto-elementor-widgets')]);
        $cards = new Repeater();
        $cards->add_control('icon', ['label' => esc_html__('Icon', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::ICONS, 'default' => ['value' => 'fas fa-lightbulb', 'library' => 'fa-solid']]);
        $cards->add_control('title', ['label' => esc_html__('Title', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'The challenge']);
        $cards->add_control('description', ['label' => esc_html__('Description', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXTAREA, 'default' => 'Across Rwanda, young people and families face challenges that stand between them and their potential.']);
        $cards->add_control('card_background', ['label' => esc_html__('Card Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'default' => '#f7f7f2']);
        $cards->add_control('icon_background', ['label' => esc_html__('Icon Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'default' => '#fde4dc']);
        $cards->add_control('icon_color', ['label' => esc_html__('Icon Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'default' => '#c05d24']);

        $this->add_control('cards', [
            'label' => esc_html__('Cards', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $cards->get_controls(),
            'title_field' => '{{{ title }}}',
            'default' => [
                ['title' => 'The challenge', 'description' => 'Across Rwanda, young people and families face challenges that stand between them and their potential. These include limited access to health education and mental health support, youth unemployment and skills mismatches, fragmented services that rarely connect education with opportunity, and too few safe spaces for out-of-school youth.', 'icon' => ['value' => 'fas fa-lightbulb', 'library' => 'fa-solid'], 'card_background' => '#f7f7f2', 'icon_background' => '#fde4dc', 'icon_color' => '#c05d24'],
                ['title' => 'The response', 'description' => 'Imbuto Hubs respond to these challenges not by addressing them in isolation, but by bringing them together in one trusted, community-centred space.', 'icon' => ['value' => 'far fa-handshake', 'library' => 'fa-regular'], 'card_background' => '#dff5f2', 'icon_background' => '#ffffff', 'icon_color' => '#2b6274'],
            ],
        ]);
        $this->end_controls_section();

        $this->start_controls_section('section_style', ['label' => esc_html__('Section', 'imbuto-elementor-widgets'), 'tab' => Controls_Manager::TAB_STYLE]);
        $this->add_control('section_background', ['label' => esc_html__('Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-split-feature' => 'background: {{VALUE}};']]);
        $this->add_responsive_control('section_padding', ['label' => esc_html__('Padding', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', 'em', '%'], 'selectors' => ['{{WRAPPER}} .imbuto-split-feature' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->end_controls_section();

        $this->start_controls_section('shell_style', ['label' => esc_html__('Outer Panel', 'imbuto-elementor-widgets'), 'tab' => Controls_Manager::TAB_STYLE]);
        $this->add_control('shell_background', ['label' => esc_html__('Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-split-feature__shell' => 'background: {{VALUE}};']]);
        $this->add_control('shell_border_color', ['label' => esc_html__('Border Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-split-feature__shell' => 'border-color: {{VALUE}};']]);
        $this->add_responsive_control('shell_radius', ['label' => esc_html__('Border Radius', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', '%'], 'selectors' => ['{{WRAPPER}} .imbuto-split-feature__shell' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_responsive_control('shell_padding', ['label' => esc_html__('Padding', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', 'em', '%'], 'selectors' => ['{{WRAPPER}} .imbuto-split-feature__shell' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_responsive_control('column_gap', ['label' => esc_html__('Column Gap', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['px'], 'range' => ['px' => ['min' => 0, 'max' => 100]], 'selectors' => ['{{WRAPPER}} .imbuto-split-feature__shell' => 'gap: {{SIZE}}{{UNIT}};']]);
        $this->end_controls_section();

        $this->start_controls_section('lead_style', ['label' => esc_html__('Lead Panel', 'imbuto-elementor-widgets'), 'tab' => Controls_Manager::TAB_STYLE]);
        $this->add_control('lead_background', ['label' => esc_html__('Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-split-feature__lead' => 'background: {{VALUE}};']]);
        $this->add_responsive_control('lead_radius', ['label' => esc_html__('Border Radius', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', '%'], 'selectors' => ['{{WRAPPER}} .imbuto-split-feature__lead' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_responsive_control('lead_padding', ['label' => esc_html__('Padding', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', 'em', '%'], 'selectors' => ['{{WRAPPER}} .imbuto-split-feature__lead' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_control('eyebrow_background', ['label' => esc_html__('Eyebrow Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-split-feature__eyebrow' => 'background: {{VALUE}};']]);
        $this->add_control('eyebrow_color', ['label' => esc_html__('Eyebrow Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-split-feature__eyebrow' => 'color: {{VALUE}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'eyebrow_typography', 'label' => esc_html__('Eyebrow Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-split-feature__eyebrow']);
        $this->add_control('lead_title_color', ['label' => esc_html__('Title Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-split-feature__lead h2' => 'color: {{VALUE}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'lead_title_typography', 'label' => esc_html__('Title Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-split-feature__lead h2']);
        $this->end_controls_section();

        $this->start_controls_section('tag_style', ['label' => esc_html__('Summary Tags', 'imbuto-elementor-widgets'), 'tab' => Controls_Manager::TAB_STYLE]);
        $this->add_control('tag_background', ['label' => esc_html__('Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-split-feature__tag' => 'background: {{VALUE}};']]);
        $this->add_control('tag_label_color', ['label' => esc_html__('Label Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-split-feature__tag strong' => 'color: {{VALUE}};']]);
        $this->add_control('tag_subtitle_color', ['label' => esc_html__('Subtitle Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-split-feature__tag span' => 'color: {{VALUE}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'tag_typography', 'label' => esc_html__('Tag Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-split-feature__tag']);
        $this->end_controls_section();

        $this->start_controls_section('feature_card_style', ['label' => esc_html__('Feature Cards', 'imbuto-elementor-widgets'), 'tab' => Controls_Manager::TAB_STYLE]);
        $this->add_responsive_control('card_gap', ['label' => esc_html__('Card Grid Gap', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['px'], 'range' => ['px' => ['min' => 0, 'max' => 80]], 'selectors' => ['{{WRAPPER}} .imbuto-split-feature__cards' => 'gap: {{SIZE}}{{UNIT}};']]);
        $this->add_responsive_control('card_radius', ['label' => esc_html__('Card Radius', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', '%'], 'selectors' => ['{{WRAPPER}} .imbuto-split-feature-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_responsive_control('card_padding', ['label' => esc_html__('Card Padding', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', 'em', '%'], 'selectors' => ['{{WRAPPER}} .imbuto-split-feature-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_responsive_control('icon_size', ['label' => esc_html__('Icon Box Size', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['px'], 'range' => ['px' => ['min' => 28, 'max' => 120]], 'selectors' => ['{{WRAPPER}} .imbuto-split-feature-card__icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};']]);
        $this->add_control('card_title_color', ['label' => esc_html__('Title Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-split-feature-card h3' => 'color: {{VALUE}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'card_title_typography', 'label' => esc_html__('Title Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-split-feature-card h3']);
        $this->add_control('card_text_color', ['label' => esc_html__('Text Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-split-feature-card p' => 'color: {{VALUE}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'card_text_typography', 'label' => esc_html__('Text Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-split-feature-card p']);
        $this->end_controls_section();
    }

    protected function render(): void
    {
        enqueue_frontend_assets();
        $settings = $this->get_settings_for_display();
        ?>
        <section class="imbuto-split-feature">
            <div class="imbuto-container imbuto-container--wide">
                <div class="imbuto-split-feature__shell">
                    <div class="imbuto-split-feature__lead">
                        <div>
                            <?php if (!empty($settings['eyebrow'])) : ?><div class="imbuto-split-feature__eyebrow"><?php echo esc_html($settings['eyebrow']); ?></div><?php endif; ?>
                            <?php if (!empty($settings['title'])) : ?><h2><?php echo esc_html($settings['title']); ?></h2><?php endif; ?>
                        </div>
                        <div class="imbuto-split-feature__tags">
                            <?php foreach (($settings['tags'] ?? []) as $tag) : ?>
                                <div class="imbuto-split-feature__tag">
                                    <strong><?php echo esc_html($tag['label']); ?></strong>
                                    <span><?php echo esc_html($tag['subtitle']); ?></span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="imbuto-split-feature__cards">
                        <?php foreach (($settings['cards'] ?? []) as $card) : ?>
                            <article class="imbuto-split-feature-card" style="background: <?php echo esc_attr($card['card_background'] ?: '#f7f7f2'); ?>;">
                                <div class="imbuto-split-feature-card__icon" style="background: <?php echo esc_attr($card['icon_background'] ?: '#ffffff'); ?>; color: <?php echo esc_attr($card['icon_color'] ?: '#2b6274'); ?>;">
                                    <?php Icons_Manager::render_icon($card['icon'], ['aria-hidden' => 'true']); ?>
                                </div>
                                <?php if (!empty($card['title'])) : ?><h3><?php echo esc_html($card['title']); ?></h3><?php endif; ?>
                                <?php if (!empty($card['description'])) : ?><p><?php echo esc_html($card['description']); ?></p><?php endif; ?>
                            </article>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
}
