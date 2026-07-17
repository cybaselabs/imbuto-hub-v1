<?php

namespace Imbuto\ElementorWidgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit;
}

class About_Philosophy_Widget extends Widget_Base
{
    public function get_name(): string
    {
        return 'imbuto_about_philosophy';
    }

    public function get_title(): string
    {
        return esc_html__('Imbuto About Philosophy', 'imbuto-elementor-widgets');
    }

    public function get_icon(): string
    {
        return 'eicon-blockquote';
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
        $this->add_control('image', ['label' => esc_html__('Image', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::MEDIA, 'default' => ['url' => image_url('about/54542336239_4fffa8e888_k.jpg')]]);
        $this->add_control('image_alt', ['label' => esc_html__('Image Alt Text', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'H.E. Mrs Jeannette Kagame']);
        $this->add_control('eyebrow', ['label' => esc_html__('Eyebrow', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'Founding Philosophy']);
        $this->add_control('title', ['label' => esc_html__('Title', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXTAREA, 'default' => 'Imbuto means seed.']);
        $this->add_control('description', ['label' => esc_html__('Description', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXTAREA, 'default' => 'In Kinyarwanda, this word means seed, and like a seed given the right conditions, every young Rwandan has the potential to grow into something extraordinary.']);
        $this->add_control('quote', ['label' => esc_html__('Quote', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXTAREA, 'default' => 'A seed well planted, watered, nurtured, and given all the necessary support successfully grows into a healthy plant, one that reaches high and stands tall.']);
        $this->add_control('attribution', ['label' => esc_html__('Attribution', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXTAREA, 'default' => 'H.E. Mrs Jeannette Kagame, First Lady of Rwanda & Chairperson, Imbuto Foundation']);
        $this->end_controls_section();

        $this->start_controls_section('section_style', ['label' => esc_html__('Section', 'imbuto-elementor-widgets'), 'tab' => Controls_Manager::TAB_STYLE]);
        $this->add_control('section_background', ['label' => esc_html__('Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-about-philosophy' => 'background: {{VALUE}};']]);
        $this->add_responsive_control('section_padding', ['label' => esc_html__('Padding', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', 'em', '%'], 'selectors' => ['{{WRAPPER}} .imbuto-about-philosophy' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_responsive_control('layout_gap', ['label' => esc_html__('Column Gap', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['px'], 'range' => ['px' => ['min' => 0, 'max' => 120]], 'selectors' => ['{{WRAPPER}} .imbuto-about-philosophy__grid' => 'gap: {{SIZE}}{{UNIT}};']]);
        $this->end_controls_section();

        $this->start_controls_section('image_style', ['label' => esc_html__('Image', 'imbuto-elementor-widgets'), 'tab' => Controls_Manager::TAB_STYLE]);
        $this->add_responsive_control('image_radius', ['label' => esc_html__('Radius', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', '%'], 'selectors' => ['{{WRAPPER}} .imbuto-about-philosophy__media' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->end_controls_section();

        $this->start_controls_section('text_style', ['label' => esc_html__('Text', 'imbuto-elementor-widgets'), 'tab' => Controls_Manager::TAB_STYLE]);
        $this->add_control('eyebrow_color', ['label' => esc_html__('Eyebrow Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-about-philosophy__eyebrow' => 'color: {{VALUE}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'eyebrow_typography', 'label' => esc_html__('Eyebrow Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-about-philosophy__eyebrow']);
        $this->add_control('title_color', ['label' => esc_html__('Title Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-about-philosophy h2' => 'color: {{VALUE}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'title_typography', 'label' => esc_html__('Title Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-about-philosophy h2']);
        $this->add_control('description_color', ['label' => esc_html__('Description Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-about-philosophy__description' => 'color: {{VALUE}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'description_typography', 'label' => esc_html__('Description Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-about-philosophy__description']);
        $this->add_control('quote_color', ['label' => esc_html__('Quote Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-about-philosophy blockquote' => 'color: {{VALUE}};']]);
        $this->add_control('quote_border_color', ['label' => esc_html__('Quote Border Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-about-philosophy blockquote' => 'border-color: {{VALUE}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'quote_typography', 'label' => esc_html__('Quote Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-about-philosophy blockquote']);
        $this->add_control('attribution_color', ['label' => esc_html__('Attribution Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-about-philosophy__attribution' => 'color: {{VALUE}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'attribution_typography', 'label' => esc_html__('Attribution Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-about-philosophy__attribution']);
        $this->add_responsive_control('attribution_spacing', ['label' => esc_html__('Attribution Top Spacing', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['px', 'em'], 'range' => ['px' => ['min' => 0, 'max' => 100], 'em' => ['min' => 0, 'max' => 8, 'step' => 0.1]], 'selectors' => ['{{WRAPPER}} .imbuto-about-philosophy__attribution' => 'margin-top: {{SIZE}}{{UNIT}};']]);
        $this->end_controls_section();
    }

    protected function render(): void
    {
        enqueue_frontend_assets();
        $settings = $this->get_settings_for_display();
        $image = $settings['image']['url'] ?? image_url('about/54542336239_4fffa8e888_k.jpg');
        ?>
        <section class="imbuto-about-philosophy">
            <div class="imbuto-container">
                <div class="imbuto-about-philosophy__grid">
                    <div class="imbuto-about-philosophy__media">
                        <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($settings['image_alt']); ?>">
                    </div>
                    <div class="imbuto-about-philosophy__copy">
                        <?php if (!empty($settings['eyebrow'])) : ?><div class="imbuto-about-philosophy__eyebrow"><?php echo esc_html($settings['eyebrow']); ?></div><?php endif; ?>
                        <h2><?php echo esc_html($settings['title']); ?></h2>
                        <p class="imbuto-about-philosophy__description"><?php echo esc_html($settings['description']); ?></p>
                        <blockquote><?php echo esc_html($settings['quote']); ?></blockquote>
                        <p class="imbuto-about-philosophy__attribution"><?php echo esc_html($settings['attribution']); ?></p>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
}
