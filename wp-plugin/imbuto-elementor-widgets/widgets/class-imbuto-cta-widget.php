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

class Cta_Widget extends Widget_Base
{
    public function get_name(): string
    {
        return 'imbuto_cta';
    }

    public function get_title(): string
    {
        return esc_html__('Imbuto CTA', 'imbuto-elementor-widgets');
    }

    public function get_icon(): string
    {
        return 'eicon-call-to-action';
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
            'default' => 'Get involved',
        ]);

        $this->add_control('title', [
            'label' => esc_html__('Title', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::TEXTAREA,
            'default' => 'Your place in this story starts here.',
        ]);

        $this->add_control('description', [
            'label' => esc_html__('Description', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::TEXTAREA,
            'default' => 'Whether you are a young person looking for opportunity, a professional ready to mentor, or an organisation that wants to invest in Rwanda’s future, there is a role for you in Imbuto Hubs.',
        ]);

        $this->add_control('background_image', [
            'label' => esc_html__('Background Image', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::MEDIA,
            'default' => [
                'url' => image_url('gallery/55271389639_c61707ed44_k.jpg'),
            ],
        ]);

        $buttons = new Repeater();

        $buttons->add_control('label', [
            'label' => esc_html__('Label', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::TEXT,
            'default' => esc_html__('Join a Hub', 'imbuto-elementor-widgets'),
            'label_block' => true,
        ]);

        $buttons->add_control('url', [
            'label' => esc_html__('URL', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::URL,
            'default' => ['url' => '/apply'],
        ]);

        $buttons->add_control('style', [
            'label' => esc_html__('Style', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::SELECT,
            'default' => 'light',
            'options' => [
                'light' => esc_html__('Light', 'imbuto-elementor-widgets'),
                'ghost' => esc_html__('Ghost', 'imbuto-elementor-widgets'),
                'orange' => esc_html__('Orange', 'imbuto-elementor-widgets'),
            ],
        ]);

        $buttons->add_control('icon', [
            'label' => esc_html__('Icon', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::ICONS,
            'default' => ['value' => 'fas fa-arrow-right', 'library' => 'fa-solid'],
        ]);

        $this->add_control('buttons', [
            'label' => esc_html__('Buttons', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $buttons->get_controls(),
            'default' => [
                ['label' => 'Join a Hub', 'url' => ['url' => '/apply'], 'style' => 'light', 'icon' => ['value' => 'fas fa-arrow-right', 'library' => 'fa-solid']],
                ['label' => 'Volunteer or Mentor', 'url' => ['url' => '/get-involved#volunteer'], 'style' => 'ghost', 'icon' => ['value' => 'far fa-handshake', 'library' => 'fa-regular']],
                ['label' => 'Partner With Us', 'url' => ['url' => '/get-involved#partner'], 'style' => 'ghost', 'icon' => ['value' => 'fas fa-arrow-right', 'library' => 'fa-solid']],
            ],
            'title_field' => '{{{ label }}}',
        ]);

        $this->end_controls_section();

        $this->start_controls_section('style_section', [
            'label' => esc_html__('Style', 'imbuto-elementor-widgets'),
            'tab' => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control('section_background', ['label' => esc_html__('Fallback Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-cta' => 'background-color: {{VALUE}};']]);
        $this->add_responsive_control('section_padding', ['label' => esc_html__('Section Padding', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', 'em', '%'], 'selectors' => ['{{WRAPPER}} .imbuto-cta' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_control('eyebrow_color', ['label' => esc_html__('Eyebrow Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-cta .imbuto-kicker' => 'color: {{VALUE}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'eyebrow_typography', 'label' => esc_html__('Eyebrow Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-cta .imbuto-kicker']);
        $this->add_control('title_color', ['label' => esc_html__('Title Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-cta h2' => 'color: {{VALUE}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'title_typography', 'label' => esc_html__('Title Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-cta h2']);
        $this->add_control('description_color', ['label' => esc_html__('Description Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-cta p' => 'color: {{VALUE}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'description_typography', 'label' => esc_html__('Description Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-cta p']);
        $this->add_responsive_control('button_gap', ['label' => esc_html__('Button Gap', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['px'], 'range' => ['px' => ['min' => 0, 'max' => 60]], 'selectors' => ['{{WRAPPER}} .imbuto-cta__actions' => 'gap: {{SIZE}}{{UNIT}};']]);
        $this->add_responsive_control('button_icon_gap', ['label' => esc_html__('Button Text/Icon Gap', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['px'], 'range' => ['px' => ['min' => 0, 'max' => 40]], 'selectors' => ['{{WRAPPER}} .imbuto-cta__actions .imbuto-button' => 'gap: {{SIZE}}{{UNIT}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'button_typography', 'label' => esc_html__('Button Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-cta__actions .imbuto-button']);
        $this->add_control('button_icon_color', ['label' => esc_html__('Button Icon Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-cta__actions .imbuto-button svg, {{WRAPPER}} .imbuto-cta__actions .imbuto-button i' => 'color: {{VALUE}};', '{{WRAPPER}} .imbuto-cta__actions .imbuto-button svg path' => 'fill: {{VALUE}};']]);
        $this->add_control('button_hover_icon_color', ['label' => esc_html__('Button Hover Icon Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-cta__actions .imbuto-button:hover svg, {{WRAPPER}} .imbuto-cta__actions .imbuto-button:hover i' => 'color: {{VALUE}};', '{{WRAPPER}} .imbuto-cta__actions .imbuto-button:hover svg path' => 'fill: {{VALUE}};']]);
        $this->add_responsive_control('button_icon_size', ['label' => esc_html__('Button Icon Size', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['px'], 'range' => ['px' => ['min' => 10, 'max' => 40]], 'selectors' => ['{{WRAPPER}} .imbuto-cta__actions .imbuto-button svg, {{WRAPPER}} .imbuto-cta__actions .imbuto-button i' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; font-size: {{SIZE}}{{UNIT}};']]);
        $this->end_controls_section();
    }

    protected function render(): void
    {
        enqueue_frontend_assets();
        $settings = $this->get_settings_for_display();
        $image = $settings['background_image']['url'] ?? image_url('gallery/55271389639_c61707ed44_k.jpg');
        $buttons = !empty($settings['buttons']) && is_array($settings['buttons']) ? $settings['buttons'] : [];
        ?>
        <section class="imbuto-cta" style="--imbuto-cta-image: url('<?php echo esc_url($image); ?>');">
            <div class="imbuto-container">
                <?php if (!empty($settings['eyebrow'])) : ?><div class="imbuto-kicker"><?php echo esc_html($settings['eyebrow']); ?></div><?php endif; ?>
                <h2><?php echo esc_html($settings['title']); ?></h2>
                <p><?php echo esc_html($settings['description']); ?></p>
                <div class="imbuto-cta__actions">
                    <?php foreach ($buttons as $button) : ?>
                        <?php if (!empty($button['label'])) : ?>
                            <a class="imbuto-button imbuto-button--<?php echo esc_attr($button['style'] ?? 'ghost'); ?>" href="<?php echo esc_url($button['url']['url'] ?? '#'); ?>">
                                <?php echo esc_html($button['label']); ?>
                                <?php if (!empty($button['icon']['value'])) : ?>
                                    <?php Icons_Manager::render_icon($button['icon'], ['aria-hidden' => 'true']); ?>
                                <?php endif; ?>
                            </a>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <?php
    }
}
