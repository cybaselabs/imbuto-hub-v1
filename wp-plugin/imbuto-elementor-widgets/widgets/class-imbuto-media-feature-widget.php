<?php

namespace Imbuto\ElementorWidgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit;
}

class Media_Feature_Widget extends Widget_Base
{
    public function get_name(): string
    {
        return 'imbuto_media_feature';
    }

    public function get_title(): string
    {
        return esc_html__('Imbuto Media Feature', 'imbuto-elementor-widgets');
    }

    public function get_icon(): string
    {
        return 'eicon-image-before-after';
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
        $this->add_control('image', ['label' => esc_html__('Image', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::MEDIA, 'default' => ['url' => image_url('about/54542383848_b26b6d6743_k.jpg')]]);
        $this->add_control('image_alt', ['label' => esc_html__('Image Alt Text', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'Imbuto Foundation leadership and governance']);
        $this->add_control('badge_text', ['label' => esc_html__('Image Badge Text', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'Governance']);
        $this->add_control('badge_icon', ['label' => esc_html__('Image Badge Icon', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::ICONS, 'default' => ['value' => 'fas fa-heart-pulse', 'library' => 'fa-solid']]);
        $this->add_control('eyebrow', ['label' => esc_html__('Eyebrow', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'Leadership & Governance']);
        $this->add_control('title', ['label' => esc_html__('Title', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXTAREA, 'default' => 'Guided by Imbuto Foundation\'s commitment to national progress.']);
        $this->add_control('description', ['label' => esc_html__('Description', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXTAREA, 'default' => 'Imbuto Hubs operate under the leadership of Imbuto Foundation, guided by its commitment to youth development, community wellbeing, and national progress.']);
        $this->add_control('layout', [
            'label' => esc_html__('Layout', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::SELECT,
            'default' => 'media-left',
            'options' => [
                'media-left' => esc_html__('Media Left', 'imbuto-elementor-widgets'),
                'media-right' => esc_html__('Media Right', 'imbuto-elementor-widgets'),
            ],
        ]);
        $this->end_controls_section();

        $this->start_controls_section('section_style', ['label' => esc_html__('Section', 'imbuto-elementor-widgets'), 'tab' => Controls_Manager::TAB_STYLE]);
        $this->add_control('section_background', ['label' => esc_html__('Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-media-feature' => 'background: {{VALUE}};']]);
        $this->add_responsive_control('section_padding', ['label' => esc_html__('Padding', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', 'em', '%'], 'selectors' => ['{{WRAPPER}} .imbuto-media-feature' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_responsive_control('column_gap', ['label' => esc_html__('Column Gap', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['px'], 'range' => ['px' => ['min' => 0, 'max' => 140]], 'selectors' => ['{{WRAPPER}} .imbuto-media-feature__grid' => 'gap: {{SIZE}}{{UNIT}};']]);
        $this->end_controls_section();

        $this->start_controls_section('media_style', ['label' => esc_html__('Media Card', 'imbuto-elementor-widgets'), 'tab' => Controls_Manager::TAB_STYLE]);
        $this->add_control('media_background', ['label' => esc_html__('Card Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-media-feature__media' => 'background: {{VALUE}};']]);
        $this->add_control('media_border_color', ['label' => esc_html__('Border Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-media-feature__media' => 'border-color: {{VALUE}};']]);
        $this->add_responsive_control('media_radius', ['label' => esc_html__('Border Radius', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', '%'], 'selectors' => ['{{WRAPPER}} .imbuto-media-feature__media' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_responsive_control('media_aspect_ratio', ['label' => esc_html__('Image Height Ratio', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['%'], 'range' => ['%' => ['min' => 45, 'max' => 120]], 'selectors' => ['{{WRAPPER}} .imbuto-media-feature__image' => 'padding-top: {{SIZE}}%;']]);
        $this->add_control('image_position', ['label' => esc_html__('Image Position', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SELECT, 'default' => 'center', 'options' => ['center' => 'Center', 'top' => 'Top', 'bottom' => 'Bottom', 'left' => 'Left', 'right' => 'Right'], 'selectors' => ['{{WRAPPER}} .imbuto-media-feature__image img' => 'object-position: {{VALUE}};']]);
        $this->end_controls_section();

        $this->start_controls_section('badge_style', ['label' => esc_html__('Image Badge', 'imbuto-elementor-widgets'), 'tab' => Controls_Manager::TAB_STYLE]);
        $this->add_control('badge_background', ['label' => esc_html__('Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-media-feature__badge' => 'background: {{VALUE}};']]);
        $this->add_control('badge_color', ['label' => esc_html__('Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-media-feature__badge' => 'color: {{VALUE}};']]);
        $this->add_responsive_control('badge_padding', ['label' => esc_html__('Padding', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', 'em'], 'selectors' => ['{{WRAPPER}} .imbuto-media-feature__badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_responsive_control('badge_radius', ['label' => esc_html__('Border Radius', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', '%'], 'selectors' => ['{{WRAPPER}} .imbuto-media-feature__badge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'badge_typography', 'label' => esc_html__('Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-media-feature__badge']);
        $this->end_controls_section();

        $this->start_controls_section('text_style', ['label' => esc_html__('Text', 'imbuto-elementor-widgets'), 'tab' => Controls_Manager::TAB_STYLE]);
        $this->add_control('eyebrow_color', ['label' => esc_html__('Eyebrow Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-media-feature__eyebrow' => 'color: {{VALUE}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'eyebrow_typography', 'label' => esc_html__('Eyebrow Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-media-feature__eyebrow']);
        $this->add_control('title_color', ['label' => esc_html__('Title Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-media-feature__copy h2' => 'color: {{VALUE}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'title_typography', 'label' => esc_html__('Title Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-media-feature__copy h2']);
        $this->add_responsive_control('title_spacing', ['label' => esc_html__('Title Top Spacing', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['px'], 'range' => ['px' => ['min' => 0, 'max' => 80]], 'selectors' => ['{{WRAPPER}} .imbuto-media-feature__copy h2' => 'margin-top: {{SIZE}}{{UNIT}};']]);
        $this->add_control('description_color', ['label' => esc_html__('Description Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-media-feature__copy p' => 'color: {{VALUE}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'description_typography', 'label' => esc_html__('Description Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-media-feature__copy p']);
        $this->add_responsive_control('description_spacing', ['label' => esc_html__('Description Top Spacing', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['px'], 'range' => ['px' => ['min' => 0, 'max' => 80]], 'selectors' => ['{{WRAPPER}} .imbuto-media-feature__copy p' => 'margin-top: {{SIZE}}{{UNIT}};']]);
        $this->end_controls_section();
    }

    protected function render(): void
    {
        enqueue_frontend_assets();
        $settings = $this->get_settings_for_display();
        $image = $settings['image']['url'] ?? image_url('about/54542383848_b26b6d6743_k.jpg');
        $layout = $settings['layout'] === 'media-right' ? ' imbuto-media-feature--media-right' : '';
        ?>
        <section class="imbuto-media-feature<?php echo esc_attr($layout); ?>">
            <div class="imbuto-container">
                <div class="imbuto-media-feature__grid">
                    <div class="imbuto-media-feature__media">
                        <div class="imbuto-media-feature__image">
                            <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($settings['image_alt']); ?>">
                            <div class="imbuto-media-feature__overlay"></div>
                            <?php if (!empty($settings['badge_text'])) : ?>
                                <div class="imbuto-media-feature__badge">
                                    <?php Icons_Manager::render_icon($settings['badge_icon'], ['aria-hidden' => 'true']); ?>
                                    <span><?php echo esc_html($settings['badge_text']); ?></span>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="imbuto-media-feature__copy">
                        <?php if (!empty($settings['eyebrow'])) : ?><div class="imbuto-media-feature__eyebrow"><?php echo esc_html($settings['eyebrow']); ?></div><?php endif; ?>
                        <?php if (!empty($settings['title'])) : ?><h2><?php echo esc_html($settings['title']); ?></h2><?php endif; ?>
                        <?php if (!empty($settings['description'])) : ?><p><?php echo esc_html($settings['description']); ?></p><?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
}
