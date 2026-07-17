<?php

namespace Imbuto\ElementorWidgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit;
}

class Involve_Partnerships_Widget extends Widget_Base
{
    public function get_name(): string
    {
        return 'imbuto_involve_partnerships';
    }

    public function get_title(): string
    {
        return esc_html__('Imbuto Impact Partnerships', 'imbuto-elementor-widgets');
    }

    public function get_icon(): string
    {
        return 'eicon-image-box';
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
        $this->add_control('section_id', ['label' => esc_html__('Section ID', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'impact-partnerships']);
        $this->add_control('eyebrow', ['label' => esc_html__('Eyebrow', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'Partnerships That Create Impact']);
        $this->add_control('title', ['label' => esc_html__('Title', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXTAREA, 'default' => 'Partnerships expand opportunity across Rwanda.']);
        $this->add_control('description_one', ['label' => esc_html__('Description 1', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXTAREA, 'default' => 'Imbuto Hubs work with government institutions, NGOs, businesses, and community organisations to expand opportunities for youth across Rwanda.']);
        $this->add_control('description_two', ['label' => esc_html__('Description 2', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXTAREA, 'default' => 'Our partners support programmes in areas such as education, health, digital skills, entrepreneurship, and sports.']);
        $this->add_control('button_label', ['label' => esc_html__('Button Label', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'Partner With Us']);
        $this->add_control('button_url', ['label' => esc_html__('Button URL', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::URL, 'default' => ['url' => '#partner-form']]);
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
        $this->add_control('image', ['label' => esc_html__('Image', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::MEDIA, 'default' => ['url' => image_url('54513896658_550ab2509d_k.jpg')]]);
        $this->add_control('image_alt', ['label' => esc_html__('Image Alt Text', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'Partners seated together at an Imbuto Hubs gathering']);
        $this->add_control('image_caption', ['label' => esc_html__('Image Caption', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXTAREA, 'default' => 'Partnership brings institutions, businesses, and communities together around practical opportunities for young people.']);
        $this->end_controls_section();

        $this->start_controls_section('section_style', ['label' => esc_html__('Section & Layout', 'imbuto-elementor-widgets'), 'tab' => Controls_Manager::TAB_STYLE]);
        $this->add_control('section_background', ['label' => esc_html__('Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-involve-partnerships' => 'background: {{VALUE}};']]);
        $this->add_responsive_control('section_padding', ['label' => esc_html__('Padding', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', 'em', '%'], 'selectors' => ['{{WRAPPER}} .imbuto-involve-partnerships' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_responsive_control('column_gap', ['label' => esc_html__('Column Gap', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['px'], 'range' => ['px' => ['min' => 0, 'max' => 140]], 'selectors' => ['{{WRAPPER}} .imbuto-involve-partnerships__grid' => 'gap: {{SIZE}}{{UNIT}};']]);
        $this->end_controls_section();

        $this->start_controls_section('text_style', ['label' => esc_html__('Text', 'imbuto-elementor-widgets'), 'tab' => Controls_Manager::TAB_STYLE]);
        $this->add_control('eyebrow_color', ['label' => esc_html__('Eyebrow Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-involve-partnerships__eyebrow' => 'color: {{VALUE}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'eyebrow_typography', 'label' => esc_html__('Eyebrow Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-involve-partnerships__eyebrow']);
        $this->add_control('title_color', ['label' => esc_html__('Title Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-involve-partnerships__copy h2' => 'color: {{VALUE}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'title_typography', 'label' => esc_html__('Title Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-involve-partnerships__copy h2']);
        $this->add_control('description_color', ['label' => esc_html__('Description Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-involve-partnerships__copy p' => 'color: {{VALUE}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'description_typography', 'label' => esc_html__('Description Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-involve-partnerships__copy p']);
        $this->end_controls_section();

        $this->start_controls_section('media_style', ['label' => esc_html__('Media', 'imbuto-elementor-widgets'), 'tab' => Controls_Manager::TAB_STYLE]);
        $this->add_control('media_background', ['label' => esc_html__('Fallback Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-involve-partnerships__media' => 'background: {{VALUE}};']]);
        $this->add_responsive_control('media_min_height', ['label' => esc_html__('Min Height', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['px'], 'range' => ['px' => ['min' => 220, 'max' => 760]], 'selectors' => ['{{WRAPPER}} .imbuto-involve-partnerships__media' => 'min-height: {{SIZE}}{{UNIT}};']]);
        $this->add_responsive_control('media_radius', ['label' => esc_html__('Radius', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', '%'], 'selectors' => ['{{WRAPPER}} .imbuto-involve-partnerships__media' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_control('image_position', ['label' => esc_html__('Image Position', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SELECT, 'default' => 'center', 'options' => ['center' => 'Center', 'top' => 'Top', 'bottom' => 'Bottom', 'left' => 'Left', 'right' => 'Right'], 'selectors' => ['{{WRAPPER}} .imbuto-involve-partnerships__media img' => 'object-position: {{VALUE}};']]);
        $this->add_control('overlay_background', ['label' => esc_html__('Overlay Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-involve-partnerships__caption' => 'background: {{VALUE}};']]);
        $this->add_control('caption_color', ['label' => esc_html__('Caption Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-involve-partnerships__caption p' => 'color: {{VALUE}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'caption_typography', 'label' => esc_html__('Caption Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-involve-partnerships__caption p']);
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
    }

    protected function render(): void
    {
        enqueue_frontend_assets();
        $settings = $this->get_settings_for_display();
        $image = $settings['image']['url'] ?? image_url('54513896658_550ab2509d_k.jpg');
        ?>
        <section id="<?php echo esc_attr($settings['section_id'] ?? 'impact-partnerships'); ?>" class="imbuto-involve-partnerships">
            <div class="imbuto-container">
                <div class="imbuto-involve-partnerships__grid">
                    <div class="imbuto-involve-partnerships__copy">
                        <?php if (!empty($settings['eyebrow'])) : ?><div class="imbuto-involve-partnerships__eyebrow"><?php echo esc_html($settings['eyebrow']); ?></div><?php endif; ?>
                        <?php if (!empty($settings['title'])) : ?><h2><?php echo esc_html($settings['title']); ?></h2><?php endif; ?>
                        <?php if (!empty($settings['description_one'])) : ?><p><?php echo esc_html($settings['description_one']); ?></p><?php endif; ?>
                        <?php if (!empty($settings['description_two'])) : ?><p><?php echo esc_html($settings['description_two']); ?></p><?php endif; ?>
                        <?php if (!empty($settings['button_label'])) : ?>
                            <a class="imbuto-involve-button" href="<?php echo esc_url($settings['button_url']['url'] ?? '#'); ?>">
                                <?php if (($settings['button_icon_position'] ?? 'after') === 'before' && !empty($settings['button_icon']['value'])) : ?><?php Icons_Manager::render_icon($settings['button_icon'], ['aria-hidden' => 'true']); ?><?php endif; ?>
                                <?php echo esc_html($settings['button_label']); ?>
                                <?php if (($settings['button_icon_position'] ?? 'after') === 'after' && !empty($settings['button_icon']['value'])) : ?><?php Icons_Manager::render_icon($settings['button_icon'], ['aria-hidden' => 'true']); ?><?php endif; ?>
                            </a>
                        <?php endif; ?>
                    </div>
                    <div class="imbuto-involve-partnerships__media">
                        <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($settings['image_alt'] ?? ''); ?>">
                        <?php if (!empty($settings['image_caption'])) : ?><div class="imbuto-involve-partnerships__caption"><p><?php echo esc_html($settings['image_caption']); ?></p></div><?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
}
