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

class Programme_Detail_Widget extends Widget_Base
{
    public function get_name(): string
    {
        return 'imbuto_programme_detail';
    }

    public function get_title(): string
    {
        return esc_html__('Imbuto Programme Detail', 'imbuto-elementor-widgets');
    }

    public function get_icon(): string
    {
        return 'eicon-post-content';
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
        $this->start_controls_section('content_section', ['label' => esc_html__('Dynamic Content', 'imbuto-elementor-widgets')]);
        $this->add_control('use_dynamic_content', [
            'label' => esc_html__('Use Current Program Post', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__('Yes', 'imbuto-elementor-widgets'),
            'label_off' => esc_html__('No', 'imbuto-elementor-widgets'),
            'return_value' => 'yes',
            'default' => 'yes',
        ]);
        $this->add_control('fallback_title', ['label' => esc_html__('Fallback Title', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXTAREA, 'default' => 'Early Childhood Development & Family']);
        $this->add_control('fallback_tagline', ['label' => esc_html__('Fallback Tagline', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXTAREA, 'default' => 'Safe spaces where children learn through play, care, and discovery.']);
        $this->add_control('fallback_body', ['label' => esc_html__('Fallback Body', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXTAREA, 'default' => 'The ECD&F Programme at Imbuto Hubs is all about safe spaces where children learn through play, care, and early stimulation that helps them grow with confidence and curiosity. Little ones can explore the Kids Corner, enjoy stories in the library, and play freely in the playground designed just for them.']);
        $this->add_control('fallback_image', ['label' => esc_html__('Fallback Image', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::MEDIA, 'default' => ['url' => image_url('EarlyChildhood.jpg')]]);
        $this->end_controls_section();

        $this->start_controls_section('hero_section', ['label' => esc_html__('Hero', 'imbuto-elementor-widgets')]);
        $this->add_control('back_label', ['label' => esc_html__('Back Button Label', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'Back to programmes']);
        $this->add_control('back_url', ['label' => esc_html__('Back Button URL', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::URL, 'default' => ['url' => '/Programmes']]);
        $this->add_control('back_icon', ['label' => esc_html__('Back Button Icon', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::ICONS, 'default' => ['value' => 'fas fa-arrow-left', 'library' => 'fa-solid']]);
        $this->add_control('badge_label', ['label' => esc_html__('Badge Label', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'Programme']);
        $this->add_control('badge_icon', ['label' => esc_html__('Badge Icon', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::ICONS, 'default' => ['value' => 'fas fa-book-open', 'library' => 'fa-solid']]);
        $this->add_control('image_source', [
            'label' => esc_html__('Hero Image Source', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::SELECT,
            'default' => 'featured',
            'options' => [
                'featured' => esc_html__('Featured/Fallback Image', 'imbuto-elementor-widgets'),
                'custom' => esc_html__('Custom Image', 'imbuto-elementor-widgets'),
            ],
        ]);
        $this->add_control('custom_image', ['label' => esc_html__('Custom Hero Image', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::MEDIA, 'condition' => ['image_source' => 'custom']]);
        $this->end_controls_section();

        $this->start_controls_section('overview_section', ['label' => esc_html__('Overview', 'imbuto-elementor-widgets')]);
        $this->add_control('overview_eyebrow', ['label' => esc_html__('Eyebrow', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'Programme overview']);
        $this->add_control('overview_title', ['label' => esc_html__('Title', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXTAREA, 'default' => 'What this programme offers.']);
        $this->add_control('show_buttons', [
            'label' => esc_html__('Show Buttons', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__('Show', 'imbuto-elementor-widgets'),
            'label_off' => esc_html__('Hide', 'imbuto-elementor-widgets'),
            'return_value' => 'yes',
            'default' => 'yes',
        ]);
        $buttons = new Repeater();
        $buttons->add_control('label', ['label' => esc_html__('Label', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'Register Interest']);
        $buttons->add_control('url', ['label' => esc_html__('URL', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::URL, 'default' => ['url' => '/apply']]);
        $buttons->add_control('style', ['label' => esc_html__('Style', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SELECT, 'default' => 'solid', 'options' => ['solid' => esc_html__('Solid', 'imbuto-elementor-widgets'), 'outline' => esc_html__('Outline', 'imbuto-elementor-widgets')]]);
        $buttons->add_control('icon', ['label' => esc_html__('Icon', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::ICONS, 'default' => ['value' => 'fas fa-arrow-right', 'library' => 'fa-solid']]);
        $buttons->add_control('icon_position', ['label' => esc_html__('Icon Position', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SELECT, 'default' => 'after', 'options' => ['before' => esc_html__('Before Text', 'imbuto-elementor-widgets'), 'after' => esc_html__('After Text', 'imbuto-elementor-widgets')]]);
        $this->add_control('buttons', [
            'label' => esc_html__('Buttons', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $buttons->get_controls(),
            'default' => [
                ['label' => 'Register Interest', 'url' => ['url' => '/apply'], 'style' => 'solid', 'icon' => ['value' => 'fas fa-arrow-right', 'library' => 'fa-solid'], 'icon_position' => 'after'],
                ['label' => 'Find a Hub', 'url' => ['url' => '/hubs#hub-map'], 'style' => 'outline', 'icon' => ['value' => 'fas fa-arrow-right', 'library' => 'fa-solid'], 'icon_position' => 'after'],
            ],
            'title_field' => '{{{ label }}}',
            'condition' => ['show_buttons' => 'yes'],
        ]);
        $this->end_controls_section();

        $this->start_controls_section('hero_style', ['label' => esc_html__('Hero', 'imbuto-elementor-widgets'), 'tab' => Controls_Manager::TAB_STYLE]);
        $this->add_control('hero_background', ['label' => esc_html__('Fallback Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-programme-detail-hero' => 'background: {{VALUE}};']]);
        $this->add_control('hero_overlay', ['label' => esc_html__('Overlay Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXTAREA, 'default' => 'linear-gradient(90deg, rgba(4,62,82,0.96) 0%, rgba(4,62,82,0.82) 54%, rgba(4,62,82,0.48) 100%)']);
        $this->add_responsive_control('hero_padding', ['label' => esc_html__('Padding', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', 'em', '%'], 'selectors' => ['{{WRAPPER}} .imbuto-programme-detail-hero' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_responsive_control('hero_content_width', ['label' => esc_html__('Content Width', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['px'], 'range' => ['px' => ['min' => 420, 'max' => 1280]], 'selectors' => ['{{WRAPPER}} .imbuto-programme-detail-hero__content' => 'max-width: {{SIZE}}{{UNIT}};']]);
        $this->add_control('image_position', ['label' => esc_html__('Image Position', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SELECT, 'default' => 'center', 'options' => ['center' => 'Center', 'top' => 'Top', 'bottom' => 'Bottom', 'left' => 'Left', 'right' => 'Right'], 'selectors' => ['{{WRAPPER}} .imbuto-programme-detail-hero__bg' => 'background-position: {{VALUE}};']]);
        $this->end_controls_section();

        $this->start_controls_section('hero_text_style', ['label' => esc_html__('Hero Text', 'imbuto-elementor-widgets'), 'tab' => Controls_Manager::TAB_STYLE]);
        $this->add_control('title_color', ['label' => esc_html__('Title Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-programme-detail-hero h1' => 'color: {{VALUE}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'title_typography', 'label' => esc_html__('Title Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-programme-detail-hero h1']);
        $this->add_control('tagline_color', ['label' => esc_html__('Tagline Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-programme-detail-hero__tagline' => 'color: {{VALUE}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'tagline_typography', 'label' => esc_html__('Tagline Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-programme-detail-hero__tagline']);
        $this->add_control('badge_background', ['label' => esc_html__('Badge Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-programme-detail-hero__badge' => 'background: {{VALUE}};']]);
        $this->add_control('badge_color', ['label' => esc_html__('Badge Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-programme-detail-hero__badge' => 'color: {{VALUE}};']]);
        $this->add_control('badge_border', ['label' => esc_html__('Badge Border', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-programme-detail-hero__badge' => 'border-color: {{VALUE}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'badge_typography', 'label' => esc_html__('Badge Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-programme-detail-hero__badge']);
        $this->end_controls_section();

        $this->start_controls_section('back_button_style', ['label' => esc_html__('Back Button', 'imbuto-elementor-widgets'), 'tab' => Controls_Manager::TAB_STYLE]);
        $this->add_control('back_background', ['label' => esc_html__('Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-programme-detail-hero__back' => 'background: {{VALUE}};']]);
        $this->add_control('back_color', ['label' => esc_html__('Text/Icon Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-programme-detail-hero__back' => 'color: {{VALUE}};', '{{WRAPPER}} .imbuto-programme-detail-hero__back svg path' => 'fill: {{VALUE}};']]);
        $this->add_control('back_border', ['label' => esc_html__('Border Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-programme-detail-hero__back' => 'border-color: {{VALUE}};']]);
        $this->add_responsive_control('back_padding', ['label' => esc_html__('Padding', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', 'em'], 'selectors' => ['{{WRAPPER}} .imbuto-programme-detail-hero__back' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_responsive_control('back_radius', ['label' => esc_html__('Radius', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', '%'], 'selectors' => ['{{WRAPPER}} .imbuto-programme-detail-hero__back' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'back_typography', 'label' => esc_html__('Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-programme-detail-hero__back']);
        $this->end_controls_section();

        $this->start_controls_section('overview_style', ['label' => esc_html__('Overview Layout', 'imbuto-elementor-widgets'), 'tab' => Controls_Manager::TAB_STYLE]);
        $this->add_control('overview_background', ['label' => esc_html__('Section Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-programme-detail-overview' => 'background: {{VALUE}};']]);
        $this->add_responsive_control('overview_padding', ['label' => esc_html__('Section Padding', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', 'em', '%'], 'selectors' => ['{{WRAPPER}} .imbuto-programme-detail-overview' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_responsive_control('overview_gap', ['label' => esc_html__('Column Gap', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['px'], 'range' => ['px' => ['min' => 0, 'max' => 140]], 'selectors' => ['{{WRAPPER}} .imbuto-programme-detail-overview__grid' => 'gap: {{SIZE}}{{UNIT}};']]);
        $this->add_control('card_background', ['label' => esc_html__('Content Card Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-programme-detail-overview__card' => 'background: {{VALUE}};']]);
        $this->add_control('card_border', ['label' => esc_html__('Content Card Border', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-programme-detail-overview__card' => 'border-color: {{VALUE}};']]);
        $this->add_responsive_control('card_padding', ['label' => esc_html__('Content Card Padding', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', 'em'], 'selectors' => ['{{WRAPPER}} .imbuto-programme-detail-overview__card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_responsive_control('card_radius', ['label' => esc_html__('Content Card Radius', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', '%'], 'selectors' => ['{{WRAPPER}} .imbuto-programme-detail-overview__card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->end_controls_section();

        $this->start_controls_section('overview_text_style', ['label' => esc_html__('Overview Text', 'imbuto-elementor-widgets'), 'tab' => Controls_Manager::TAB_STYLE]);
        $this->add_control('overview_eyebrow_background', ['label' => esc_html__('Eyebrow Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-programme-detail-overview__eyebrow' => 'background: {{VALUE}};']]);
        $this->add_control('overview_eyebrow_color', ['label' => esc_html__('Eyebrow Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-programme-detail-overview__eyebrow' => 'color: {{VALUE}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'overview_eyebrow_typography', 'label' => esc_html__('Eyebrow Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-programme-detail-overview__eyebrow']);
        $this->add_control('overview_title_color', ['label' => esc_html__('Title Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-programme-detail-overview h2' => 'color: {{VALUE}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'overview_title_typography', 'label' => esc_html__('Title Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-programme-detail-overview h2']);
        $this->add_control('body_color', ['label' => esc_html__('Body Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-programme-detail-overview__body' => 'color: {{VALUE}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'body_typography', 'label' => esc_html__('Body Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-programme-detail-overview__body']);
        $this->end_controls_section();

        $this->start_controls_section('button_style', ['label' => esc_html__('Overview Buttons', 'imbuto-elementor-widgets'), 'tab' => Controls_Manager::TAB_STYLE]);
        $this->add_responsive_control('buttons_gap', ['label' => esc_html__('Buttons Gap', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['px'], 'range' => ['px' => ['min' => 0, 'max' => 60]], 'selectors' => ['{{WRAPPER}} .imbuto-programme-detail-overview__buttons' => 'gap: {{SIZE}}{{UNIT}};']]);
        $this->add_control('button_color', ['label' => esc_html__('Solid Text Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-programme-detail-button--solid' => 'color: {{VALUE}};']]);
        $this->add_control('button_background', ['label' => esc_html__('Solid Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-programme-detail-button--solid' => 'background: {{VALUE}};']]);
        $this->add_control('outline_color', ['label' => esc_html__('Outline Text Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-programme-detail-button--outline' => 'color: {{VALUE}};']]);
        $this->add_control('outline_background', ['label' => esc_html__('Outline Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-programme-detail-button--outline' => 'background: {{VALUE}};']]);
        $this->add_control('outline_border', ['label' => esc_html__('Outline Border', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-programme-detail-button--outline' => 'border-color: {{VALUE}};']]);
        $this->add_control('button_icon_color', ['label' => esc_html__('Icon Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-programme-detail-button svg, {{WRAPPER}} .imbuto-programme-detail-button i' => 'color: {{VALUE}};', '{{WRAPPER}} .imbuto-programme-detail-button svg path' => 'fill: {{VALUE}};']]);
        $this->add_responsive_control('button_icon_size', ['label' => esc_html__('Icon Size', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['px'], 'range' => ['px' => ['min' => 8, 'max' => 48]], 'selectors' => ['{{WRAPPER}} .imbuto-programme-detail-button svg, {{WRAPPER}} .imbuto-programme-detail-button i' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; font-size: {{SIZE}}{{UNIT}};']]);
        $this->add_responsive_control('button_text_icon_gap', ['label' => esc_html__('Text/Icon Gap', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['px'], 'range' => ['px' => ['min' => 0, 'max' => 40]], 'selectors' => ['{{WRAPPER}} .imbuto-programme-detail-button' => 'gap: {{SIZE}}{{UNIT}};']]);
        $this->add_responsive_control('button_padding', ['label' => esc_html__('Padding', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', 'em'], 'selectors' => ['{{WRAPPER}} .imbuto-programme-detail-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_responsive_control('button_radius', ['label' => esc_html__('Radius', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', '%'], 'selectors' => ['{{WRAPPER}} .imbuto-programme-detail-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'button_typography', 'label' => esc_html__('Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-programme-detail-button']);
        $this->end_controls_section();
    }

    protected function render(): void
    {
        enqueue_frontend_assets();
        $settings = $this->get_settings_for_display();
        $data = $this->get_programme_data($settings);
        $image = $data['image'];
        if (($settings['image_source'] ?? 'featured') === 'custom' && !empty($settings['custom_image']['url'])) {
            $image = $settings['custom_image']['url'];
        }
        ?>
        <main class="imbuto-programme-detail">
            <section class="imbuto-programme-detail-hero">
                <div class="imbuto-programme-detail-hero__bg" style="background-image: url('<?php echo esc_url($image); ?>');"></div>
                <div class="imbuto-programme-detail-hero__overlay" style="background: <?php echo esc_attr($settings['hero_overlay']); ?>"></div>
                <div class="imbuto-container">
                    <?php if (!empty($settings['back_label'])) : ?>
                        <a class="imbuto-programme-detail-hero__back" href="<?php echo esc_url($settings['back_url']['url'] ?? '/Programmes'); ?>">
                            <?php if (!empty($settings['back_icon']['value'])) : ?><?php Icons_Manager::render_icon($settings['back_icon'], ['aria-hidden' => 'true']); ?><?php endif; ?>
                            <?php echo esc_html($settings['back_label']); ?>
                        </a>
                    <?php endif; ?>
                    <div class="imbuto-programme-detail-hero__content">
                        <?php if (!empty($settings['badge_label'])) : ?>
                            <div class="imbuto-programme-detail-hero__badge">
                                <?php if (!empty($settings['badge_icon']['value'])) : ?><?php Icons_Manager::render_icon($settings['badge_icon'], ['aria-hidden' => 'true']); ?><?php endif; ?>
                                <?php echo esc_html($settings['badge_label']); ?>
                            </div>
                        <?php endif; ?>
                        <h1><?php echo esc_html($data['title']); ?></h1>
                        <?php if (!empty($data['tagline'])) : ?><p class="imbuto-programme-detail-hero__tagline"><?php echo esc_html($data['tagline']); ?></p><?php endif; ?>
                    </div>
                </div>
            </section>

            <section class="imbuto-programme-detail-overview">
                <div class="imbuto-container">
                    <div class="imbuto-programme-detail-overview__grid">
                        <div class="imbuto-programme-detail-overview__head">
                            <?php if (!empty($settings['overview_eyebrow'])) : ?><div class="imbuto-programme-detail-overview__eyebrow"><?php echo esc_html($settings['overview_eyebrow']); ?></div><?php endif; ?>
                            <?php if (!empty($settings['overview_title'])) : ?><h2><?php echo esc_html($settings['overview_title']); ?></h2><?php endif; ?>
                        </div>
                        <div class="imbuto-programme-detail-overview__card">
                            <div class="imbuto-programme-detail-overview__body"><?php echo wp_kses_post(wpautop($data['body'])); ?></div>
                            <?php if (($settings['show_buttons'] ?? 'yes') === 'yes' && !empty($settings['buttons'])) : ?>
                                <div class="imbuto-programme-detail-overview__buttons">
                                    <?php foreach ($settings['buttons'] as $button) : ?>
                                        <?php if (empty($button['label'])) { continue; } ?>
                                        <a class="imbuto-programme-detail-button imbuto-programme-detail-button--<?php echo esc_attr($button['style'] ?? 'solid'); ?>" href="<?php echo esc_url($button['url']['url'] ?? '#'); ?>">
                                            <?php if (($button['icon_position'] ?? 'after') === 'before' && !empty($button['icon']['value'])) : ?><?php Icons_Manager::render_icon($button['icon'], ['aria-hidden' => 'true']); ?><?php endif; ?>
                                            <?php echo esc_html($button['label']); ?>
                                            <?php if (($button['icon_position'] ?? 'after') === 'after' && !empty($button['icon']['value'])) : ?><?php Icons_Manager::render_icon($button['icon'], ['aria-hidden' => 'true']); ?><?php endif; ?>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </section>
        </main>
        <?php
    }

    private function get_programme_data(array $settings): array
    {
        $fallback_image = $settings['fallback_image']['url'] ?? image_url('EarlyChildhood.jpg');
        $data = [
            'title' => $settings['fallback_title'] ?? '',
            'tagline' => $settings['fallback_tagline'] ?? '',
            'body' => $settings['fallback_body'] ?? '',
            'image' => $fallback_image ?: image_url('EarlyChildhood.jpg'),
        ];

        if (($settings['use_dynamic_content'] ?? 'yes') !== 'yes') {
            return $data;
        }

        $post_id = get_the_ID();
        if (!$post_id) {
            return $data;
        }

        $featured_image = get_the_post_thumbnail_url($post_id, 'full');
        $short_summary = function_exists('get_field') ? (string) get_field('short_summary', $post_id) : '';
        $tagline = function_exists('get_field') ? (string) get_field('tagline', $post_id) : '';
        $subtitle = function_exists('get_field') ? (string) get_field('subtitle', $post_id) : '';
        $short_description = function_exists('get_field') ? (string) get_field('short_description', $post_id) : '';
        $body = function_exists('get_field') ? (string) get_field('body', $post_id) : '';
        $full_description = function_exists('get_field') ? (string) get_field('full_description', $post_id) : '';
        $summary = function_exists('get_field') ? (string) get_field('summary', $post_id) : '';
        $content = get_post_field('post_content', $post_id);

        return [
            'title' => get_the_title($post_id) ?: $data['title'],
            'tagline' => $short_summary ?: $tagline ?: $subtitle ?: get_the_excerpt($post_id) ?: $data['tagline'],
            'body' => $body ?: $full_description ?: $content ?: $short_description ?: $summary ?: $data['body'],
            'image' => $featured_image ?: $data['image'],
        ];
    }
}
