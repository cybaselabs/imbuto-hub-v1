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

class Life_Stages_Widget extends Widget_Base
{
    public function get_name(): string
    {
        return 'imbuto_life_stages';
    }

    public function get_title(): string
    {
        return esc_html__('Imbuto Life Stages', 'imbuto-elementor-widgets');
    }

    public function get_icon(): string
    {
        return 'eicon-post-list';
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
        $this->add_control('image', ['label' => esc_html__('Image', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::MEDIA]);
        $this->add_control('eyebrow', ['label' => esc_html__('Eyebrow', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'Programmes by life stage']);
        $this->add_control('title', ['label' => esc_html__('Title', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXTAREA, 'default' => 'From early learning to purpose and leadership.']);
        $this->add_control('description', ['label' => esc_html__('Description', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXTAREA, 'default' => 'Imbuto Hubs support children, youth, and families through a connected journey of learning, wellbeing, creativity, sport, mentorship, and opportunity.']);
        $this->add_control('primary_label', ['label' => esc_html__('Primary Button Text', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'Explore age groups']);
        $this->add_control('primary_url', ['label' => esc_html__('Primary Button URL', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::URL, 'default' => ['url' => '/Programmes']]);
        $this->add_control('primary_icon', ['label' => esc_html__('Primary Button Icon', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::ICONS]);
        $this->add_control('secondary_label', ['label' => esc_html__('Secondary Button Text', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'Find a Hub']);
        $this->add_control('secondary_url', ['label' => esc_html__('Secondary Button URL', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::URL, 'default' => ['url' => '/hubs#hub-map']]);
        $this->add_control('secondary_icon', ['label' => esc_html__('Secondary Button Icon', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::ICONS]);

        $stages = new Repeater();
        $stages->add_control('age', ['label' => esc_html__('Age', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXT, 'default' => '1-6 years']);
        $stages->add_control('title', ['label' => esc_html__('Title', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'Strong foundations']);
        $stages->add_control('description', ['label' => esc_html__('Description', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXTAREA, 'default' => 'Early learning, play, and parent or caregiver support.']);
        $stages->add_control('background', ['label' => esc_html__('Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'default' => '#ed9b37']);
        $stages->add_control('color', ['label' => esc_html__('Text Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'default' => '#0b2f3b']);
        $stages->add_control('arrow_icon', ['label' => esc_html__('Arrow Icon', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::ICONS, 'default' => ['value' => 'fas fa-arrow-right', 'library' => 'fa-solid']]);
        $this->add_control('stages', [
            'label' => esc_html__('Stages', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $stages->get_controls(),
            'title_field' => '{{{ age }}}',
            'default' => [
                ['age' => '1-6 years', 'title' => 'Strong foundations', 'description' => 'Early learning, play, and parent or caregiver support.', 'background' => '#ed9b37', 'color' => '#0b2f3b', 'arrow_icon' => ['value' => 'fas fa-arrow-right', 'library' => 'fa-solid']],
                ['age' => '7-12 years', 'title' => 'Discovery', 'description' => 'Reading culture, skills discovery, safe play, and confidence building.', 'background' => '#ffffff', 'color' => '#0b2f3b', 'arrow_icon' => ['value' => 'fas fa-arrow-right', 'library' => 'fa-solid']],
                ['age' => '13-18 years', 'title' => 'Growth', 'description' => 'Mentorship, digital skills, wellbeing, creativity, sport, and leadership.', 'background' => '#52b3a9', 'color' => '#161616', 'arrow_icon' => ['value' => 'fas fa-arrow-right', 'library' => 'fa-solid']],
                ['age' => '18 and beyond', 'title' => 'Purpose', 'description' => 'Skills training, entrepreneurship support, job readiness, and leadership.', 'background' => '#e9f0ec', 'color' => '#0b2f3b', 'arrow_icon' => ['value' => 'fas fa-arrow-right', 'library' => 'fa-solid']],
            ],
        ]);
        $this->end_controls_section();

        $this->start_controls_section('section_style', ['label' => esc_html__('Section & Panel', 'imbuto-elementor-widgets'), 'tab' => Controls_Manager::TAB_STYLE]);
        $this->add_control('section_background', ['label' => esc_html__('Section Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-life-stages' => 'background: {{VALUE}};']]);
        $this->add_control('panel_background', ['label' => esc_html__('Panel Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-life-stages__panel' => 'background: {{VALUE}};']]);
        $this->add_responsive_control('section_padding', ['label' => esc_html__('Section Padding', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', 'em', '%'], 'selectors' => ['{{WRAPPER}} .imbuto-life-stages' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_responsive_control('panel_radius', ['label' => esc_html__('Panel Radius', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', '%'], 'selectors' => ['{{WRAPPER}} .imbuto-life-stages__panel' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_responsive_control('content_gap', ['label' => esc_html__('Top Row Gap', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['px'], 'range' => ['px' => ['min' => 0, 'max' => 100]], 'selectors' => ['{{WRAPPER}} .imbuto-life-stages__top' => 'gap: {{SIZE}}{{UNIT}};']]);
        $this->add_responsive_control('stage_grid_gap', ['label' => esc_html__('Stage Grid Gap', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['px'], 'range' => ['px' => ['min' => 0, 'max' => 80]], 'selectors' => ['{{WRAPPER}} .imbuto-life-stages__grid' => 'gap: {{SIZE}}{{UNIT}};']]);
        $this->add_responsive_control('stage_grid_spacing', ['label' => esc_html__('Stage Grid Top Spacing', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['px'], 'range' => ['px' => ['min' => 0, 'max' => 120]], 'selectors' => ['{{WRAPPER}} .imbuto-life-stages__grid' => 'margin-top: {{SIZE}}{{UNIT}};']]);
        $this->end_controls_section();

        $this->start_controls_section('intro_card_style', ['label' => esc_html__('Intro Card', 'imbuto-elementor-widgets'), 'tab' => Controls_Manager::TAB_STYLE]);
        $this->add_control('intro_background', ['label' => esc_html__('Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-life-stages__copy' => 'background: {{VALUE}};']]);
        $this->add_control('intro_border_color', ['label' => esc_html__('Border Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-life-stages__copy' => 'border-color: {{VALUE}};']]);
        $this->add_responsive_control('intro_radius', ['label' => esc_html__('Border Radius', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', '%'], 'selectors' => ['{{WRAPPER}} .imbuto-life-stages__copy' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_responsive_control('intro_padding', ['label' => esc_html__('Padding', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', 'em', '%'], 'selectors' => ['{{WRAPPER}} .imbuto-life-stages__copy' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_control('eyebrow_color', ['label' => esc_html__('Eyebrow Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-life-stages__eyebrow' => 'color: {{VALUE}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'eyebrow_typography', 'label' => esc_html__('Eyebrow Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-life-stages__eyebrow']);
        $this->add_control('title_color', ['label' => esc_html__('Title Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-life-stages__copy h2' => 'color: {{VALUE}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'title_typography', 'label' => esc_html__('Title Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-life-stages__copy h2']);
        $this->add_responsive_control('title_spacing', ['label' => esc_html__('Title Top Spacing', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['px'], 'range' => ['px' => ['min' => 0, 'max' => 80]], 'selectors' => ['{{WRAPPER}} .imbuto-life-stages__copy h2' => 'margin-top: {{SIZE}}{{UNIT}};']]);
        $this->add_control('description_color', ['label' => esc_html__('Description Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-life-stages__copy p' => 'color: {{VALUE}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'description_typography', 'label' => esc_html__('Description Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-life-stages__copy p']);
        $this->end_controls_section();

        $this->start_controls_section('image_style', ['label' => esc_html__('Image', 'imbuto-elementor-widgets'), 'tab' => Controls_Manager::TAB_STYLE]);
        $this->add_responsive_control('image_min_height', ['label' => esc_html__('Min Height', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['px'], 'range' => ['px' => ['min' => 180, 'max' => 720]], 'selectors' => ['{{WRAPPER}} .imbuto-life-stages__image' => 'min-height: {{SIZE}}{{UNIT}};']]);
        $this->add_responsive_control('image_radius', ['label' => esc_html__('Border Radius', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', '%'], 'selectors' => ['{{WRAPPER}} .imbuto-life-stages__image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_control('image_position', ['label' => esc_html__('Image Position', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SELECT, 'default' => 'center', 'options' => ['center' => 'Center', 'top' => 'Top', 'bottom' => 'Bottom', 'left' => 'Left', 'right' => 'Right'], 'selectors' => ['{{WRAPPER}} .imbuto-life-stages__image' => 'background-position: {{VALUE}};']]);
        $this->end_controls_section();

        $this->start_controls_section('button_style', ['label' => esc_html__('Buttons', 'imbuto-elementor-widgets'), 'tab' => Controls_Manager::TAB_STYLE]);
        $this->add_responsive_control('button_gap', ['label' => esc_html__('Button Gap', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['px'], 'range' => ['px' => ['min' => 0, 'max' => 60]], 'selectors' => ['{{WRAPPER}} .imbuto-life-stages__buttons' => 'gap: {{SIZE}}{{UNIT}};']]);
        $this->add_responsive_control('button_padding', ['label' => esc_html__('Button Padding', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', 'em'], 'selectors' => ['{{WRAPPER}} .imbuto-life-stages__buttons .imbuto-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_responsive_control('button_radius', ['label' => esc_html__('Button Radius', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', '%'], 'selectors' => ['{{WRAPPER}} .imbuto-life-stages__buttons .imbuto-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_control('primary_background', ['label' => esc_html__('Primary Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-life-stages__primary' => 'background: {{VALUE}};']]);
        $this->add_control('primary_color', ['label' => esc_html__('Primary Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-life-stages__primary' => 'color: {{VALUE}};']]);
        $this->add_control('secondary_background', ['label' => esc_html__('Secondary Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-life-stages__secondary' => 'background: {{VALUE}};']]);
        $this->add_control('secondary_color', ['label' => esc_html__('Secondary Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-life-stages__secondary' => 'color: {{VALUE}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'button_typography', 'label' => esc_html__('Button Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-life-stages__buttons .imbuto-button']);
        $this->end_controls_section();

        $this->start_controls_section('stage_card_style', ['label' => esc_html__('Stage Cards', 'imbuto-elementor-widgets'), 'tab' => Controls_Manager::TAB_STYLE]);
        $this->add_responsive_control('stage_card_padding', ['label' => esc_html__('Card Padding', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', 'em', '%'], 'selectors' => ['{{WRAPPER}} .imbuto-life-stages__grid article' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_responsive_control('stage_card_radius', ['label' => esc_html__('Card Radius', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', '%'], 'selectors' => ['{{WRAPPER}} .imbuto-life-stages__grid article' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'stage_age_typography', 'label' => esc_html__('Age Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-life-stages__grid article span']);
        $this->add_control('stage_age_color', ['label' => esc_html__('Age Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-life-stages__grid article span' => 'color: {{VALUE}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'stage_title_typography', 'label' => esc_html__('Stage Title Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-life-stages__grid article strong']);
        $this->add_control('stage_title_color', ['label' => esc_html__('Stage Title Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-life-stages__grid article strong' => 'color: {{VALUE}};']]);
        $this->add_responsive_control('stage_title_spacing', ['label' => esc_html__('Stage Title Top Spacing', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['px'], 'range' => ['px' => ['min' => 0, 'max' => 80]], 'selectors' => ['{{WRAPPER}} .imbuto-life-stages__grid article strong' => 'margin-top: {{SIZE}}{{UNIT}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'stage_description_typography', 'label' => esc_html__('Stage Description Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-life-stages__grid article p']);
        $this->add_control('stage_description_color', ['label' => esc_html__('Stage Description Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-life-stages__grid article p' => 'color: {{VALUE}};']]);
        $this->add_control('stage_arrow_color', ['label' => esc_html__('Arrow Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-life-stages__grid article em' => 'color: {{VALUE}};']]);
        $this->add_responsive_control('stage_arrow_size', ['label' => esc_html__('Arrow Size', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['px'], 'range' => ['px' => ['min' => 10, 'max' => 44]], 'selectors' => ['{{WRAPPER}} .imbuto-life-stages__grid article em svg, {{WRAPPER}} .imbuto-life-stages__grid article em i' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; font-size: {{SIZE}}{{UNIT}};']]);
        $this->end_controls_section();
    }

    protected function render(): void
    {
        enqueue_frontend_assets();
        $settings = $this->get_settings_for_display();
        $image = !empty($settings['image']['url']) ? $settings['image']['url'] : image_url('leadership.jpg');
        ?>
        <section class="imbuto-life-stages">
            <div class="imbuto-life-stages__panel">
                <div class="imbuto-life-stages__top">
                    <div class="imbuto-life-stages__copy">
                        <div class="imbuto-life-stages__eyebrow"><?php echo esc_html($settings['eyebrow']); ?></div>
                        <h2><?php echo esc_html($settings['title']); ?></h2>
                        <p><?php echo esc_html($settings['description']); ?></p>
                        <div class="imbuto-life-stages__buttons">
                            <?php if (!empty($settings['primary_label'])) : ?><a class="imbuto-button imbuto-button--teal imbuto-life-stages__primary" href="<?php echo esc_url($settings['primary_url']['url'] ?? '#'); ?>"><?php echo esc_html($settings['primary_label']); ?><?php Icons_Manager::render_icon($settings['primary_icon'], ['aria-hidden' => 'true']); ?></a><?php endif; ?>
                            <?php if (!empty($settings['secondary_label'])) : ?><a class="imbuto-button imbuto-button--outline-teal imbuto-life-stages__secondary" href="<?php echo esc_url($settings['secondary_url']['url'] ?? '#'); ?>"><?php echo esc_html($settings['secondary_label']); ?><?php Icons_Manager::render_icon($settings['secondary_icon'], ['aria-hidden' => 'true']); ?></a><?php endif; ?>
                        </div>
                    </div>
                    <div class="imbuto-life-stages__image" style="background-image:url('<?php echo esc_url($image); ?>');"></div>
                </div>
                <div class="imbuto-life-stages__grid">
                    <?php foreach ($settings['stages'] as $stage) : ?>
                        <article style="background:<?php echo esc_attr($stage['background']); ?>; color:<?php echo esc_attr($stage['color']); ?>;">
                            <div><span><?php echo esc_html($stage['age']); ?></span><em><?php Icons_Manager::render_icon($stage['arrow_icon'], ['aria-hidden' => 'true']); ?></em></div>
                            <strong><?php echo esc_html($stage['title']); ?></strong>
                            <p><?php echo esc_html($stage['description']); ?></p>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <?php
    }
}
