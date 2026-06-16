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

class Page_Hero_Widget extends Widget_Base
{
    public function get_name(): string
    {
        return 'imbuto_page_hero';
    }

    public function get_title(): string
    {
        return esc_html__('Imbuto Page Hero', 'imbuto-elementor-widgets');
    }

    public function get_icon(): string
    {
        return 'eicon-banner';
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
        $this->start_controls_section('content_section', [
            'label' => esc_html__('Content', 'imbuto-elementor-widgets'),
        ]);

        $this->add_control('eyebrow', [
            'label' => esc_html__('Eyebrow', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::TEXT,
            'default' => '',
        ]);

        $this->add_control('eyebrow_icon', [
            'label' => esc_html__('Eyebrow Icon', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::ICONS,
            'default' => [
                'value' => 'fas fa-sparkles',
                'library' => 'fa-solid',
            ],
            'condition' => [
                'eyebrow!' => '',
            ],
        ]);

        $this->add_control('title', [
            'label' => esc_html__('Title', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::TEXTAREA,
            'default' => 'About Imbuto Hubs',
        ]);

        $this->add_control('description', [
            'label' => esc_html__('Description', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::TEXTAREA,
            'default' => 'Imbuto Hubs are inclusive, accessible community spaces that connect education, wellbeing, skills, creativity, sport, and leadership.',
        ]);

        $this->add_control('background_image', [
            'label' => esc_html__('Background Image', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::MEDIA,
            'default' => [
                'url' => image_url('gallery/55271389639_c61707ed44_k.jpg'),
            ],
        ]);

        $buttons = new Repeater();
        $buttons->add_control('label', ['label' => esc_html__('Label', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'Register Interest']);
        $buttons->add_control('url', ['label' => esc_html__('URL', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::URL, 'default' => ['url' => '#']]);
        $buttons->add_control('style', [
            'label' => esc_html__('Style', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::SELECT,
            'default' => 'orange',
            'options' => [
                'orange' => esc_html__('Orange', 'imbuto-elementor-widgets'),
                'light' => esc_html__('Light', 'imbuto-elementor-widgets'),
                'ghost' => esc_html__('Ghost', 'imbuto-elementor-widgets'),
            ],
        ]);
        $buttons->add_control('icon', ['label' => esc_html__('Icon', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::ICONS, 'default' => ['value' => 'fas fa-arrow-right', 'library' => 'fa-solid']]);

        $this->add_control('buttons', [
            'label' => esc_html__('Buttons', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $buttons->get_controls(),
            'default' => [],
            'title_field' => '{{{ label }}}',
        ]);

        $this->end_controls_section();

        $this->start_controls_section('layout_style', ['label' => esc_html__('Layout', 'imbuto-elementor-widgets'), 'tab' => Controls_Manager::TAB_STYLE]);
        $this->add_responsive_control('section_padding', ['label' => esc_html__('Section Padding', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', 'em', '%'], 'selectors' => ['{{WRAPPER}} .imbuto-page-hero' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_responsive_control('content_width', ['label' => esc_html__('Content Width', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['px'], 'range' => ['px' => ['min' => 360, 'max' => 1200]], 'selectors' => ['{{WRAPPER}} .imbuto-page-hero__copy' => 'max-width: {{SIZE}}{{UNIT}};']]);
        $this->add_control('overlay_background', ['label' => esc_html__('Overlay Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXTAREA, 'default' => 'linear-gradient(90deg, rgba(4,62,82,0.96) 0%, rgba(4,62,82,0.82) 48%, rgba(4,62,82,0.52) 100%)']);
        $this->end_controls_section();

        $this->start_controls_section('text_style', ['label' => esc_html__('Text', 'imbuto-elementor-widgets'), 'tab' => Controls_Manager::TAB_STYLE]);
        $this->add_control('eyebrow_background', ['label' => esc_html__('Eyebrow Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-page-hero__eyebrow' => 'background: {{VALUE}};']]);
        $this->add_control('eyebrow_color', ['label' => esc_html__('Eyebrow Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-page-hero__eyebrow' => 'color: {{VALUE}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'eyebrow_typography', 'label' => esc_html__('Eyebrow Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-page-hero__eyebrow']);
        $this->add_control('title_color', ['label' => esc_html__('Title Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-page-hero h1' => 'color: {{VALUE}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'title_typography', 'label' => esc_html__('Title Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-page-hero h1']);
        $this->add_control('description_color', ['label' => esc_html__('Description Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-page-hero p' => 'color: {{VALUE}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'description_typography', 'label' => esc_html__('Description Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-page-hero p']);
        $this->end_controls_section();

        $this->start_controls_section('button_style', ['label' => esc_html__('Buttons', 'imbuto-elementor-widgets'), 'tab' => Controls_Manager::TAB_STYLE]);
        $this->add_responsive_control('button_gap', ['label' => esc_html__('Button Gap', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['px'], 'range' => ['px' => ['min' => 0, 'max' => 60]], 'selectors' => ['{{WRAPPER}} .imbuto-page-hero__buttons' => 'gap: {{SIZE}}{{UNIT}};']]);
        $this->add_responsive_control('button_padding', ['label' => esc_html__('Button Padding', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', 'em'], 'selectors' => ['{{WRAPPER}} .imbuto-page-hero__buttons .imbuto-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'button_typography', 'label' => esc_html__('Button Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-page-hero__buttons .imbuto-button']);
        $this->end_controls_section();
    }

    protected function render(): void
    {
        enqueue_frontend_assets();
        $settings = $this->get_settings_for_display();
        $image = $settings['background_image']['url'] ?? image_url('gallery/55271389639_c61707ed44_k.jpg');
        $buttons = !empty($settings['buttons']) && is_array($settings['buttons']) ? $settings['buttons'] : [];
        ?>
        <section class="imbuto-page-hero">
            <div class="imbuto-page-hero__bg" style="background-image: url('<?php echo esc_url($image); ?>');"></div>
            <div class="imbuto-page-hero__overlay" style="background: <?php echo esc_attr($settings['overlay_background']); ?>"></div>
            <div class="imbuto-container">
                <div class="imbuto-page-hero__copy">
                    <?php if (!empty($settings['eyebrow'])) : ?>
                        <div class="imbuto-page-hero__eyebrow">
                            <?php Icons_Manager::render_icon($settings['eyebrow_icon'], ['aria-hidden' => 'true']); ?>
                            <?php echo esc_html($settings['eyebrow']); ?>
                        </div>
                    <?php endif; ?>
                    <h1><?php echo esc_html($settings['title']); ?></h1>
                    <p><?php echo esc_html($settings['description']); ?></p>
                    <?php if ($buttons) : ?>
                        <div class="imbuto-page-hero__buttons">
                            <?php foreach ($buttons as $button) : ?>
                                <?php if (!empty($button['label'])) : ?>
                                    <a class="imbuto-button imbuto-button--<?php echo esc_attr($button['style'] ?? 'orange'); ?>" href="<?php echo esc_url($button['url']['url'] ?? '#'); ?>">
                                        <?php echo esc_html($button['label']); ?>
                                        <?php Icons_Manager::render_icon($button['icon'], ['aria-hidden' => 'true']); ?>
                                    </a>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
        <?php
    }
}
