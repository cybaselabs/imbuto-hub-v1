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

class Impact_Stories_Widget extends Widget_Base
{
    public function get_name(): string
    {
        return 'imbuto_impact_stories';
    }

    public function get_title(): string
    {
        return esc_html__('Imbuto Impact Stories', 'imbuto-elementor-widgets');
    }

    public function get_icon(): string
    {
        return 'eicon-posts-grid';
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
        $this->start_controls_section('header_section', ['label' => esc_html__('Header', 'imbuto-elementor-widgets')]);
        $this->add_control('title', ['label' => esc_html__('Title', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXTAREA, 'default' => 'Impact Stories']);
        $this->add_control('browse_label', ['label' => esc_html__('Browse Button Label', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'Browse All Stories']);
        $this->add_control('browse_url', ['label' => esc_html__('Browse Button URL', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::URL, 'default' => ['url' => '#']]);
        $this->add_control('browse_icon', ['label' => esc_html__('Browse Button Icon', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::ICONS, 'default' => ['value' => 'fas fa-arrow-right', 'library' => 'fa-solid']]);
        $this->end_controls_section();

        $this->start_controls_section('featured_section', ['label' => esc_html__('Featured Story', 'imbuto-elementor-widgets')]);
        $this->add_control('use_dynamic_story', ['label' => esc_html__('Use Impact Story Post', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SWITCHER, 'label_on' => esc_html__('Yes', 'imbuto-elementor-widgets'), 'label_off' => esc_html__('No', 'imbuto-elementor-widgets'), 'return_value' => 'yes', 'default' => 'yes']);
        $this->add_control('story_post_type', ['label' => esc_html__('Story Post Type Slug', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'impact_story', 'description' => esc_html__('Use the CPT slug from ACF Post Types, for example impact_story.', 'imbuto-elementor-widgets'), 'condition' => ['use_dynamic_story' => 'yes']]);
        $this->add_control('featured_story_id', ['label' => esc_html__('Featured Story Post ID', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::NUMBER, 'min' => 0, 'default' => 0, 'description' => esc_html__('Leave empty/0 to use the latest published story.', 'imbuto-elementor-widgets'), 'condition' => ['use_dynamic_story' => 'yes']]);
        $this->add_control('featured_badge', ['label' => esc_html__('Featured Badge Text', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXTAREA, 'default' => 'Featured Story, Keza', 'label_block' => true]);
        $this->add_control('featured_title', ['label' => esc_html__('Title', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXTAREA, 'default' => 'The Journey of Keza']);
        $this->add_control('featured_summary', ['label' => esc_html__('Summary', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXTAREA, 'default' => 'Keza\'s story follows a child with big dreams through early learning, education, health support, mental wellbeing, youth empowerment, and mentorship, showing how Imbuto Hubs can shape a life from childhood to adulthood.']);
        $this->add_control('featured_quote', ['label' => esc_html__('Quote', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXTAREA, 'default' => 'Once upon a time I was you, and one day you will be me.']);
        $this->add_control('featured_attribution', ['label' => esc_html__('Attribution', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXTAREA, 'default' => 'Keza, Medical Student & Imbuto Hub Mentor', 'label_block' => true]);
        $this->add_control('featured_image', ['label' => esc_html__('Image', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::MEDIA, 'default' => ['url' => image_url('gallery/55271389639_c61707ed44_k.jpg')]]);
        $this->add_control('featured_alt', ['label' => esc_html__('Image Alt Text', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'Young people taking part in an Imbuto Hub programme']);
        $this->add_control('read_label', ['label' => esc_html__('Read Button Label', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'Read Story']);
        $this->add_control('read_url', ['label' => esc_html__('Read Button URL', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::URL, 'default' => ['url' => '/impact/keza']]);
        $this->add_control('read_icon', ['label' => esc_html__('Read Button Icon', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::ICONS, 'default' => ['value' => 'fas fa-arrow-right', 'library' => 'fa-solid']]);
        $this->add_control('quote_icon', ['label' => esc_html__('Quote Icon', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::ICONS, 'default' => ['value' => 'fas fa-quote-left', 'library' => 'fa-solid']]);
        $this->end_controls_section();

        $this->start_controls_section('additional_section', ['label' => esc_html__('Additional Stories', 'imbuto-elementor-widgets')]);
        $this->add_control('show_additional', ['label' => esc_html__('Show Additional Stories', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SWITCHER, 'label_on' => esc_html__('Show', 'imbuto-elementor-widgets'), 'label_off' => esc_html__('Hide', 'imbuto-elementor-widgets'), 'return_value' => 'yes', 'default' => '']);
        $this->add_control('additional_count', ['label' => esc_html__('Dynamic Story Count', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::NUMBER, 'min' => 1, 'max' => 12, 'default' => 3, 'condition' => ['use_dynamic_story' => 'yes', 'show_additional' => 'yes']]);

        $stories = new Repeater();
        $stories->add_control('category', ['label' => esc_html__('Category', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'Education']);
        $stories->add_control('title', ['label' => esc_html__('Title', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXTAREA, 'default' => 'Reading Into Confidence']);
        $stories->add_control('hub', ['label' => esc_html__('Hub', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'Imbuto Hub Kigali']);
        $stories->add_control('text', ['label' => esc_html__('Text', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXTAREA, 'default' => 'A young learner builds a reading routine in the hub library and gains the confidence to participate more fully at school.']);
        $stories->add_control('image', ['label' => esc_html__('Image', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::MEDIA, 'default' => ['url' => image_url('gallery/55271389639_c61707ed44_k.jpg')]]);
        $stories->add_control('icon', ['label' => esc_html__('Icon', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::ICONS, 'default' => ['value' => 'fas fa-book-open', 'library' => 'fa-solid']]);
        $stories->add_control('url', ['label' => esc_html__('URL', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::URL, 'default' => ['url' => '#']]);

        $this->add_control('stories', [
            'label' => esc_html__('Stories', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $stories->get_controls(),
            'title_field' => '{{{ title }}}',
            'condition' => ['show_additional' => 'yes'],
            'default' => [
                ['category' => 'Education', 'title' => 'Reading Into Confidence', 'hub' => 'Imbuto Hub Kigali', 'text' => 'A young learner builds a reading routine in the hub library and gains the confidence to participate more fully at school.', 'image' => ['url' => image_url('54513984590_0fcde5be3d_k.jpg')], 'icon' => ['value' => 'fas fa-book-open', 'library' => 'fa-solid'], 'url' => ['url' => '#']],
                ['category' => 'Wellbeing', 'title' => 'A Safer Space to Breathe', 'hub' => 'Imbuto Hub Huye', 'text' => 'Through wellness sessions and trusted support, a participant learns how to manage stress and ask for help early.', 'image' => ['url' => image_url('ecadfe9f73f23947.jpeg')], 'icon' => ['value' => 'fas fa-heart-pulse', 'library' => 'fa-solid'], 'url' => ['url' => '#']],
            ],
        ]);
        $this->end_controls_section();

        $this->start_controls_section('section_style', ['label' => esc_html__('Section', 'imbuto-elementor-widgets'), 'tab' => Controls_Manager::TAB_STYLE]);
        $this->add_control('section_background', ['label' => esc_html__('Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-impact-stories' => 'background: {{VALUE}};']]);
        $this->add_responsive_control('section_padding', ['label' => esc_html__('Padding', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', 'em', '%'], 'selectors' => ['{{WRAPPER}} .imbuto-impact-stories' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_responsive_control('header_gap', ['label' => esc_html__('Header Gap', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['px'], 'range' => ['px' => ['min' => 0, 'max' => 80]], 'selectors' => ['{{WRAPPER}} .imbuto-impact-stories__head' => 'gap: {{SIZE}}{{UNIT}};']]);
        $this->add_responsive_control('featured_spacing', ['label' => esc_html__('Featured Top Spacing', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['px'], 'range' => ['px' => ['min' => 0, 'max' => 100]], 'selectors' => ['{{WRAPPER}} .imbuto-impact-story-featured' => 'margin-top: {{SIZE}}{{UNIT}};']]);
        $this->end_controls_section();

        $this->start_controls_section('typography_style', ['label' => esc_html__('Typography & Colors', 'imbuto-elementor-widgets'), 'tab' => Controls_Manager::TAB_STYLE]);
        $this->add_control('title_color', ['label' => esc_html__('Section Title Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-impact-stories__head h2' => 'color: {{VALUE}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'section_title_typography', 'label' => esc_html__('Section Title Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-impact-stories__head h2']);
        $this->add_control('featured_title_color', ['label' => esc_html__('Featured Title Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-impact-story-featured__content h2' => 'color: {{VALUE}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'featured_title_typography', 'label' => esc_html__('Featured Title Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-impact-story-featured__content h2']);
        $this->add_control('summary_color', ['label' => esc_html__('Summary Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-impact-story-featured__summary' => 'color: {{VALUE}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'summary_typography', 'label' => esc_html__('Summary Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-impact-story-featured__summary']);
        $this->add_control('quote_color', ['label' => esc_html__('Quote Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-impact-story-featured blockquote' => 'color: {{VALUE}};']]);
        $this->add_control('quote_border_color', ['label' => esc_html__('Quote Border Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-impact-story-featured blockquote' => 'border-color: {{VALUE}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'quote_typography', 'label' => esc_html__('Quote Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-impact-story-featured blockquote']);
        $this->add_control('attribution_color', ['label' => esc_html__('Attribution Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-impact-story-featured__attribution' => 'color: {{VALUE}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'attribution_typography', 'label' => esc_html__('Attribution Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-impact-story-featured__attribution']);
        $this->add_responsive_control('attribution_spacing', ['label' => esc_html__('Attribution Top Spacing', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['px', 'em'], 'range' => ['px' => ['min' => 0, 'max' => 80], 'em' => ['min' => 0, 'max' => 8, 'step' => 0.1]], 'selectors' => ['{{WRAPPER}} .imbuto-impact-story-featured__attribution' => 'margin-top: {{SIZE}}{{UNIT}};']]);
        $this->end_controls_section();

        $this->start_controls_section('quote_icon_style', ['label' => esc_html__('Quote Icon & Attribution', 'imbuto-elementor-widgets'), 'tab' => Controls_Manager::TAB_STYLE]);
        $this->add_control('quote_icon_background', ['label' => esc_html__('Icon Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-impact-story-featured__icon' => 'background: {{VALUE}};']]);
        $this->add_control('quote_icon_color', ['label' => esc_html__('Icon Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-impact-story-featured__icon svg, {{WRAPPER}} .imbuto-impact-story-featured__icon i' => 'color: {{VALUE}};', '{{WRAPPER}} .imbuto-impact-story-featured__icon svg path' => 'fill: {{VALUE}};']]);
        $this->add_responsive_control('quote_icon_box_size', ['label' => esc_html__('Icon Box Size', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['px'], 'range' => ['px' => ['min' => 24, 'max' => 96]], 'selectors' => ['{{WRAPPER}} .imbuto-impact-story-featured__icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};']]);
        $this->add_responsive_control('quote_icon_size', ['label' => esc_html__('Icon Size', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['px'], 'range' => ['px' => ['min' => 10, 'max' => 48]], 'selectors' => ['{{WRAPPER}} .imbuto-impact-story-featured__icon svg, {{WRAPPER}} .imbuto-impact-story-featured__icon i' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; font-size: {{SIZE}}{{UNIT}};']]);
        $this->add_responsive_control('quote_icon_radius', ['label' => esc_html__('Icon Radius', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', '%'], 'selectors' => ['{{WRAPPER}} .imbuto-impact-story-featured__icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_responsive_control('quote_icon_spacing', ['label' => esc_html__('Icon Bottom Spacing', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['px', 'em'], 'range' => ['px' => ['min' => 0, 'max' => 80], 'em' => ['min' => 0, 'max' => 8, 'step' => 0.1]], 'selectors' => ['{{WRAPPER}} .imbuto-impact-story-featured__content h2' => 'margin-top: {{SIZE}}{{UNIT}};']]);
        $this->add_control('attribution_heading', ['label' => esc_html__('Attribution', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::HEADING, 'separator' => 'before']);
        $this->add_control('attribution_background', ['label' => esc_html__('Attribution Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-impact-story-featured__attribution' => 'background: {{VALUE}};']]);
        $this->add_responsive_control('attribution_padding', ['label' => esc_html__('Attribution Padding', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', 'em'], 'selectors' => ['{{WRAPPER}} .imbuto-impact-story-featured__attribution' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_responsive_control('attribution_radius', ['label' => esc_html__('Attribution Radius', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', '%'], 'selectors' => ['{{WRAPPER}} .imbuto-impact-story-featured__attribution' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->end_controls_section();

        $this->start_controls_section('featured_badge_style', ['label' => esc_html__('Featured Badge', 'imbuto-elementor-widgets'), 'tab' => Controls_Manager::TAB_STYLE]);
        $this->add_control('featured_badge_color', ['label' => esc_html__('Text Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-impact-story-featured__badge' => 'color: {{VALUE}};']]);
        $this->add_control('featured_badge_background', ['label' => esc_html__('Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-impact-story-featured__badge' => 'background: {{VALUE}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'featured_badge_typography', 'label' => esc_html__('Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-impact-story-featured__badge']);
        $this->add_responsive_control('featured_badge_top', ['label' => esc_html__('Top Position', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['px', '%'], 'range' => ['px' => ['min' => 0, 'max' => 160], '%' => ['min' => 0, 'max' => 80]], 'selectors' => ['{{WRAPPER}} .imbuto-impact-story-featured__badge' => 'top: {{SIZE}}{{UNIT}};']]);
        $this->add_responsive_control('featured_badge_left', ['label' => esc_html__('Left Position', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['px', '%'], 'range' => ['px' => ['min' => 0, 'max' => 160], '%' => ['min' => 0, 'max' => 80]], 'selectors' => ['{{WRAPPER}} .imbuto-impact-story-featured__badge' => 'left: {{SIZE}}{{UNIT}};']]);
        $this->add_responsive_control('featured_badge_padding', ['label' => esc_html__('Padding', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', 'em'], 'selectors' => ['{{WRAPPER}} .imbuto-impact-story-featured__badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_responsive_control('featured_badge_radius', ['label' => esc_html__('Radius', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', '%'], 'selectors' => ['{{WRAPPER}} .imbuto-impact-story-featured__badge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->end_controls_section();

        $this->start_controls_section('card_style', ['label' => esc_html__('Cards & Buttons', 'imbuto-elementor-widgets'), 'tab' => Controls_Manager::TAB_STYLE]);
        $this->add_control('card_background', ['label' => esc_html__('Featured Card Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-impact-story-featured' => 'background: {{VALUE}};']]);
        $this->add_control('card_border_color', ['label' => esc_html__('Featured Card Border', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-impact-story-featured' => 'border-color: {{VALUE}};']]);
        $this->add_responsive_control('card_radius', ['label' => esc_html__('Featured Radius', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', '%'], 'selectors' => ['{{WRAPPER}} .imbuto-impact-story-featured' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_responsive_control('content_padding', ['label' => esc_html__('Content Padding', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', 'em', '%'], 'selectors' => ['{{WRAPPER}} .imbuto-impact-story-featured__content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_control('button_color', ['label' => esc_html__('Button Text Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-impact-button' => 'color: {{VALUE}};']]);
        $this->add_control('button_background', ['label' => esc_html__('Button Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-impact-button' => 'background: {{VALUE}};']]);
        $this->add_control('button_icon_color', ['label' => esc_html__('Button Icon Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-impact-button svg, {{WRAPPER}} .imbuto-impact-button i' => 'color: {{VALUE}};', '{{WRAPPER}} .imbuto-impact-button svg path' => 'fill: {{VALUE}};']]);
        $this->add_responsive_control('button_gap', ['label' => esc_html__('Button Text/Icon Gap', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['px'], 'range' => ['px' => ['min' => 0, 'max' => 32]], 'selectors' => ['{{WRAPPER}} .imbuto-impact-button' => 'gap: {{SIZE}}{{UNIT}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'button_typography', 'label' => esc_html__('Button Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-impact-button']);
        $this->end_controls_section();
    }

    protected function render(): void
    {
        enqueue_frontend_assets();
        $settings = $this->get_settings_for_display();
        $dynamic_story = $this->get_featured_story($settings);
        $image = $dynamic_story['image'] ?? ($settings['featured_image']['url'] ?? image_url('gallery/55271389639_c61707ed44_k.jpg'));
        $featured_badge = $dynamic_story['badge'] ?? ($settings['featured_badge'] ?? '');
        $featured_title = $dynamic_story['title'] ?? ($settings['featured_title'] ?? '');
        $featured_summary = $dynamic_story['summary'] ?? ($settings['featured_summary'] ?? '');
        $featured_quote = $dynamic_story['quote'] ?? ($settings['featured_quote'] ?? '');
        $featured_attribution = $dynamic_story['attribution'] ?? ($settings['featured_attribution'] ?? '');
        $featured_alt = $dynamic_story['image_alt'] ?? ($settings['featured_alt'] ?? '');
        $read_url = $dynamic_story['url'] ?? ($settings['read_url']['url'] ?? '#');
        $stories = !empty($settings['stories']) && is_array($settings['stories']) ? $settings['stories'] : [];
        $dynamic_stories = [];

        if (($settings['use_dynamic_story'] ?? '') === 'yes' && ($settings['show_additional'] ?? '') === 'yes') {
            $dynamic_stories = get_impact_story_posts(
                (string) ($settings['story_post_type'] ?? 'impact_story'),
                max(1, (int) ($settings['additional_count'] ?? 3)),
                (int) ($dynamic_story['id'] ?? 0)
            );
        }
        ?>
        <section id="stories" class="imbuto-impact-stories">
            <div class="imbuto-container">
                <div class="imbuto-impact-stories__head">
                    <h2><?php echo esc_html($settings['title'] ?? 'Impact Stories'); ?></h2>
                    <?php if (!empty($settings['browse_label'])) : ?>
                        <a class="imbuto-impact-button" href="<?php echo esc_url($settings['browse_url']['url'] ?? '#'); ?>">
                            <?php echo esc_html($settings['browse_label']); ?>
                            <?php if (!empty($settings['browse_icon']['value'])) : ?><?php Icons_Manager::render_icon($settings['browse_icon'], ['aria-hidden' => 'true']); ?><?php endif; ?>
                        </a>
                    <?php endif; ?>
                </div>

                <article class="imbuto-impact-story-featured">
                    <div class="imbuto-impact-story-featured__media">
                        <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($featured_alt); ?>">
                        <?php if (!empty($featured_badge)) : ?><span class="imbuto-impact-story-featured__badge"><?php echo esc_html($featured_badge); ?></span><?php endif; ?>
                    </div>
                    <div class="imbuto-impact-story-featured__content">
                        <div class="imbuto-impact-story-featured__icon">
                            <?php if (!empty($settings['quote_icon']['value'])) : ?><?php Icons_Manager::render_icon($settings['quote_icon'], ['aria-hidden' => 'true']); ?><?php endif; ?>
                        </div>
                        <h2><?php echo esc_html($featured_title); ?></h2>
                        <p class="imbuto-impact-story-featured__summary"><?php echo esc_html($featured_summary); ?></p>
                        <?php if (!empty($featured_quote)) : ?><blockquote><?php echo esc_html($featured_quote); ?></blockquote><?php endif; ?>
                        <?php if (!empty($featured_attribution)) : ?><p class="imbuto-impact-story-featured__attribution"><?php echo esc_html($featured_attribution); ?></p><?php endif; ?>
                        <?php if (!empty($settings['read_label'])) : ?>
                            <a class="imbuto-impact-button" href="<?php echo esc_url($read_url); ?>">
                                <?php echo esc_html($settings['read_label']); ?>
                                <?php if (!empty($settings['read_icon']['value'])) : ?><?php Icons_Manager::render_icon($settings['read_icon'], ['aria-hidden' => 'true']); ?><?php endif; ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </article>

                <?php if (($settings['show_additional'] ?? '') === 'yes' && ($stories || $dynamic_stories)) : ?>
                    <div class="imbuto-impact-stories__grid">
                        <?php foreach ($this->additional_stories($stories, $dynamic_stories) as $story) : ?>
                            <article class="imbuto-impact-story-card">
                                <div class="imbuto-impact-story-card__media">
                                    <img src="<?php echo esc_url($story['image']['url'] ?? $story['image'] ?? image_url('gallery/55271389639_c61707ed44_k.jpg')); ?>" alt="<?php echo esc_attr($story['title'] ?? ''); ?>">
                                </div>
                                <div class="imbuto-impact-story-card__body">
                                    <div class="imbuto-impact-story-card__meta">
                                        <span><?php echo esc_html($story['category'] ?? $story['related_program'] ?? 'Impact Story'); ?></span>
                                        <div><?php if (!empty($story['icon']['value'])) : ?><?php Icons_Manager::render_icon($story['icon'], ['aria-hidden' => 'true']); ?><?php endif; ?></div>
                                    </div>
                                    <h3><?php echo esc_html($story['title'] ?? ''); ?></h3>
                                    <?php if (!empty($story['hub']) || !empty($story['location'])) : ?><p class="imbuto-impact-story-card__hub"><?php echo esc_html($story['hub'] ?? $story['location']); ?></p><?php endif; ?>
                                    <p><?php echo esc_html($story['text'] ?? $story['summary'] ?? ''); ?></p>
                                    <a class="imbuto-impact-story-card__link" href="<?php echo esc_url($story['url']['url'] ?? $story['url'] ?? '#'); ?>"><?php echo esc_html($settings['read_label'] ?? 'Read Story'); ?> <?php Icons_Manager::render_icon(['value' => 'fas fa-arrow-right', 'library' => 'fa-solid'], ['aria-hidden' => 'true']); ?></a>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </section>
        <?php
    }

    private function get_featured_story(array $settings): ?array
    {
        if (($settings['use_dynamic_story'] ?? '') !== 'yes') {
            return null;
        }

        $featured_id = (int) ($settings['featured_story_id'] ?? 0);

        if ($featured_id > 0 && get_post_status($featured_id) === 'publish') {
            return normalize_impact_story_post($featured_id);
        }

        $stories = get_impact_story_posts((string) ($settings['story_post_type'] ?? 'impact_story'), 1);

        return $stories[0] ?? null;
    }

    private function additional_stories(array $manual_stories, array $dynamic_stories): array
    {
        if ($dynamic_stories) {
            return $dynamic_stories;
        }

        return $manual_stories;
    }
}
