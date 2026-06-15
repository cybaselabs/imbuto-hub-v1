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

class About_Widget extends Widget_Base
{
    public function get_name(): string
    {
        return 'imbuto_about';
    }

    public function get_title(): string
    {
        return esc_html__('Imbuto About', 'imbuto-elementor-widgets');
    }

    public function get_icon(): string
    {
        return 'eicon-info-box';
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

        $this->add_control('image', [
            'label' => esc_html__('Image', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::MEDIA,
        ]);
        $this->add_control('left_badge_text', ['label' => esc_html__('Left Image Badge', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'Community']);
        $this->add_control('left_badge_icon', ['label' => esc_html__('Left Badge Icon', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::ICONS, 'default' => ['value' => 'fas fa-wand-magic-sparkles', 'library' => 'fa-solid']]);
        $this->add_control('right_badge_text', ['label' => esc_html__('Right Image Badge', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'Youth-first']);
        $this->add_control('right_badge_icon', ['label' => esc_html__('Right Badge Icon', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::ICONS, 'default' => ['value' => 'fas fa-users', 'library' => 'fa-solid']]);
        $this->add_control('eyebrow', ['label' => esc_html__('Eyebrow', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'What Imbuto Hubs are']);
        $this->add_control('title', ['label' => esc_html__('Title', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXTAREA, 'default' => 'One place. Every opportunity.']);
        $this->add_control('description', ['label' => esc_html__('Description', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXTAREA, 'default' => 'Imbuto Hubs are community-centred spaces supporting every stage of life, from early childhood to adulthood. They offer learning, digital skills, wellbeing, sports, creativity, and pathways to jobs and entrepreneurship in a safe, welcoming environment at the heart of your community.']);
        $this->add_control('button_text', ['label' => esc_html__('Button Text', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'Learn More About Imbuto Hubs']);
        $this->add_control('button_url', ['label' => esc_html__('Button URL', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::URL, 'default' => ['url' => '/about']]);
        $this->add_control('button_icon', ['label' => esc_html__('Button Icon', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::ICONS, 'default' => ['value' => 'fas fa-arrow-right', 'library' => 'fa-solid']]);

        $bullets = new Repeater();
        $bullets->add_control('text', ['label' => esc_html__('Text', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'Learning & mentorship']);
        $bullets->add_control('icon', ['label' => esc_html__('Icon', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::ICONS, 'default' => ['value' => 'fas fa-chevron-right', 'library' => 'fa-solid']]);
        $this->add_control('bullets', [
            'label' => esc_html__('Bullets', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $bullets->get_controls(),
            'title_field' => '{{{ text }}}',
            'default' => [
                ['text' => 'Learning & mentorship', 'icon' => ['value' => 'fas fa-chevron-right', 'library' => 'fa-solid']],
                ['text' => 'Digital skills & innovation', 'icon' => ['value' => 'fas fa-chevron-right', 'library' => 'fa-solid']],
                ['text' => 'Wellbeing & counselling', 'icon' => ['value' => 'fas fa-chevron-right', 'library' => 'fa-solid']],
                ['text' => 'Sports, arts & culture', 'icon' => ['value' => 'fas fa-chevron-right', 'library' => 'fa-solid']],
            ],
        ]);

        $this->end_controls_section();

        $this->start_controls_section('panel_style', ['label' => esc_html__('Section & Panel', 'imbuto-elementor-widgets'), 'tab' => Controls_Manager::TAB_STYLE]);
        $this->add_control('section_background', ['label' => esc_html__('Section Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-about' => 'background: {{VALUE}};']]);
        $this->add_control('panel_background', ['label' => esc_html__('Panel Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-about__panel' => 'background: {{VALUE}};']]);
        $this->add_control('panel_border_color', ['label' => esc_html__('Panel Border Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-about__panel' => 'border-color: {{VALUE}};']]);
        $this->add_responsive_control('panel_radius', ['label' => esc_html__('Panel Radius', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', '%'], 'selectors' => ['{{WRAPPER}} .imbuto-about__panel' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_responsive_control('panel_padding', ['label' => esc_html__('Panel Padding', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', 'em', '%'], 'selectors' => ['{{WRAPPER}} .imbuto-about__panel' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_responsive_control('column_gap', ['label' => esc_html__('Column Gap', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['px'], 'range' => ['px' => ['min' => 0, 'max' => 140]], 'selectors' => ['{{WRAPPER}} .imbuto-about__panel' => 'gap: {{SIZE}}{{UNIT}};']]);
        $this->end_controls_section();

        $this->start_controls_section('image_style', ['label' => esc_html__('Image & Badges', 'imbuto-elementor-widgets'), 'tab' => Controls_Manager::TAB_STYLE]);
        $this->add_responsive_control('image_radius', ['label' => esc_html__('Image Radius', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', '%'], 'selectors' => ['{{WRAPPER}} .imbuto-about__image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_responsive_control('image_min_height', ['label' => esc_html__('Image Min Height', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['px'], 'range' => ['px' => ['min' => 260, 'max' => 760]], 'selectors' => ['{{WRAPPER}} .imbuto-about__image' => 'min-height: {{SIZE}}{{UNIT}};']]);
        $this->add_control('badge_background', ['label' => esc_html__('Badge Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-about__badge' => 'background: {{VALUE}};']]);
        $this->add_control('badge_color', ['label' => esc_html__('Badge Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-about__badge' => 'color: {{VALUE}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'badge_typography', 'label' => esc_html__('Badge Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-about__badge']);
        $this->end_controls_section();

        $this->start_controls_section('text_style', ['label' => esc_html__('Text', 'imbuto-elementor-widgets'), 'tab' => Controls_Manager::TAB_STYLE]);
        $this->add_control('eyebrow_background', ['label' => esc_html__('Eyebrow Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-about__eyebrow' => 'background: {{VALUE}};']]);
        $this->add_control('eyebrow_color', ['label' => esc_html__('Eyebrow Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-about__eyebrow' => 'color: {{VALUE}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'eyebrow_typography', 'label' => esc_html__('Eyebrow Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-about__eyebrow']);
        $this->add_control('title_color', ['label' => esc_html__('Title Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-about__copy h2' => 'color: {{VALUE}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'title_typography', 'label' => esc_html__('Title Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-about__copy h2']);
        $this->add_control('description_color', ['label' => esc_html__('Description Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-about__copy p' => 'color: {{VALUE}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'description_typography', 'label' => esc_html__('Description Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-about__copy p']);
        $this->add_responsive_control('description_spacing', ['label' => esc_html__('Description Top Spacing', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['px'], 'range' => ['px' => ['min' => 0, 'max' => 100]], 'selectors' => ['{{WRAPPER}} .imbuto-about__copy p' => 'margin-top: {{SIZE}}{{UNIT}};']]);
        $this->end_controls_section();

        $this->start_controls_section('bullet_style', ['label' => esc_html__('Bullets', 'imbuto-elementor-widgets'), 'tab' => Controls_Manager::TAB_STYLE]);
        $this->add_responsive_control('bullet_grid_gap', ['label' => esc_html__('Bullet Gap', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['px'], 'range' => ['px' => ['min' => 0, 'max' => 60]], 'selectors' => ['{{WRAPPER}} .imbuto-about__bullets' => 'gap: {{SIZE}}{{UNIT}};']]);
        $this->add_control('bullet_background', ['label' => esc_html__('Bullet Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-about__bullet' => 'background: {{VALUE}};']]);
        $this->add_control('bullet_border_color', ['label' => esc_html__('Bullet Border Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-about__bullet' => 'border-color: {{VALUE}};']]);
        $this->add_control('bullet_color', ['label' => esc_html__('Bullet Text Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-about__bullet' => 'color: {{VALUE}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'bullet_typography', 'label' => esc_html__('Bullet Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-about__bullet']);
        $this->add_control('bullet_icon_background', ['label' => esc_html__('Bullet Icon Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-about__bullet-icon' => 'background: {{VALUE}};']]);
        $this->add_control('bullet_icon_color', ['label' => esc_html__('Bullet Icon Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-about__bullet-icon' => 'color: {{VALUE}};']]);
        $this->end_controls_section();

        $this->start_controls_section('button_style', ['label' => esc_html__('Button', 'imbuto-elementor-widgets'), 'tab' => Controls_Manager::TAB_STYLE]);
        $this->add_control('button_background', ['label' => esc_html__('Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-about__button' => 'background: {{VALUE}};']]);
        $this->add_control('button_color', ['label' => esc_html__('Text Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-about__button' => 'color: {{VALUE}};']]);
        $this->add_control('button_icon_color', ['label' => esc_html__('Icon Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-about__button svg, {{WRAPPER}} .imbuto-about__button i' => 'color: {{VALUE}};', '{{WRAPPER}} .imbuto-about__button svg path' => 'fill: {{VALUE}};']]);
        $this->add_control('button_hover_background', ['label' => esc_html__('Hover Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-about__button:hover' => 'background: {{VALUE}};']]);
        $this->add_control('button_hover_icon_color', ['label' => esc_html__('Hover Icon Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-about__button:hover svg, {{WRAPPER}} .imbuto-about__button:hover i' => 'color: {{VALUE}};', '{{WRAPPER}} .imbuto-about__button:hover svg path' => 'fill: {{VALUE}};']]);
        $this->add_responsive_control('button_radius', ['label' => esc_html__('Border Radius', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', '%'], 'selectors' => ['{{WRAPPER}} .imbuto-about__button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_responsive_control('button_padding', ['label' => esc_html__('Padding', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', 'em'], 'selectors' => ['{{WRAPPER}} .imbuto-about__button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_responsive_control('button_icon_gap', ['label' => esc_html__('Text/Icon Gap', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['px'], 'range' => ['px' => ['min' => 0, 'max' => 40]], 'selectors' => ['{{WRAPPER}} .imbuto-about__button' => 'gap: {{SIZE}}{{UNIT}};']]);
        $this->add_responsive_control('button_icon_size', ['label' => esc_html__('Icon Size', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['px'], 'range' => ['px' => ['min' => 8, 'max' => 40]], 'selectors' => ['{{WRAPPER}} .imbuto-about__button svg, {{WRAPPER}} .imbuto-about__button i' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; font-size: {{SIZE}}{{UNIT}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'button_typography', 'label' => esc_html__('Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-about__button']);
        $this->end_controls_section();
    }

    protected function render(): void
    {
        enqueue_frontend_assets();
        $settings = $this->get_settings_for_display();
        $image = !empty($settings['image']['url']) ? $settings['image']['url'] : image_url('54945681330_6035d49ddf_o.jpg');
        ?>
        <section class="imbuto-about">
            <div class="imbuto-container">
                <div class="imbuto-about__panel">
                    <div class="imbuto-about__image">
                        <div class="imbuto-about__image-fill" style="background-image:url('<?php echo esc_url($image); ?>');"></div>
                        <span class="imbuto-about__badge imbuto-about__badge--left"><?php Icons_Manager::render_icon($settings['left_badge_icon'], ['aria-hidden' => 'true']); ?><?php echo esc_html($settings['left_badge_text']); ?></span>
                        <span class="imbuto-about__badge imbuto-about__badge--right"><?php Icons_Manager::render_icon($settings['right_badge_icon'], ['aria-hidden' => 'true']); ?><?php echo esc_html($settings['right_badge_text']); ?></span>
                    </div>
                    <div class="imbuto-about__copy">
                        <div class="imbuto-about__eyebrow"><?php echo esc_html($settings['eyebrow']); ?></div>
                        <h2><?php echo esc_html($settings['title']); ?></h2>
                        <div class="imbuto-about__bullets">
                            <?php foreach ($settings['bullets'] as $bullet) : ?>
                                <span class="imbuto-about__bullet">
                                    <span class="imbuto-about__bullet-icon"><?php Icons_Manager::render_icon($bullet['icon'], ['aria-hidden' => 'true']); ?></span>
                                    <?php echo esc_html($bullet['text']); ?>
                                </span>
                            <?php endforeach; ?>
                        </div>
                        <p><?php echo esc_html($settings['description']); ?></p>
                        <?php if (!empty($settings['button_text'])) : ?>
                            <a class="imbuto-button imbuto-button--dark imbuto-about__button" href="<?php echo esc_url($settings['button_url']['url'] ?? '#'); ?>">
                                <?php echo esc_html($settings['button_text']); ?>
                                <?php Icons_Manager::render_icon($settings['button_icon'], ['aria-hidden' => 'true']); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
}
