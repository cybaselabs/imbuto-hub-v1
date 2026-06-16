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

class Footer_Widget extends Widget_Base
{
    public function get_name(): string
    {
        return 'imbuto_footer';
    }

    public function get_title(): string
    {
        return esc_html__('Imbuto Footer', 'imbuto-elementor-widgets');
    }

    public function get_icon(): string
    {
        return 'eicon-footer';
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

        $this->add_control('logo', [
            'label' => esc_html__('Logo', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::MEDIA,
            'default' => [
                'url' => image_url('updated-IMBUTO LOGO-03.png'),
            ],
        ]);

        $this->add_control('title', [
            'label' => esc_html__('Title', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::TEXTAREA,
            'default' => 'Growing futures, one hub at a time.',
        ]);

        $this->add_control('description', [
            'label' => esc_html__('Description', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::TEXTAREA,
            'default' => 'Imbuto Hubs create safe, inspiring spaces where children, youth, and families access learning, sports, wellbeing, and opportunity across Rwanda.',
        ]);

        $this->add_control('connect_label', [
            'label' => esc_html__('Connect Label', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::TEXT,
            'default' => 'Connect',
        ]);

        $this->add_control('email', [
            'label' => esc_html__('Email', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::TEXT,
            'default' => 'Info@imbutohubs.com',
        ]);

        $socials = new Repeater();

        $socials->add_control('label', [
            'label' => esc_html__('Label', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::TEXT,
            'default' => esc_html__('Facebook', 'imbuto-elementor-widgets'),
        ]);

        $socials->add_control('url', [
            'label' => esc_html__('URL', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::URL,
            'default' => ['url' => '#'],
        ]);

        $socials->add_control('icon', [
            'label' => esc_html__('Icon', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::ICONS,
            'default' => [
                'value' => 'fab fa-facebook-f',
                'library' => 'fa-brands',
            ],
        ]);

        $this->add_control('social_links', [
            'label' => esc_html__('Social Links', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $socials->get_controls(),
            'default' => [
                ['label' => 'Facebook', 'icon' => ['value' => 'fab fa-facebook-f', 'library' => 'fa-brands'], 'url' => ['url' => '#']],
                ['label' => 'Instagram', 'icon' => ['value' => 'fab fa-instagram', 'library' => 'fa-brands'], 'url' => ['url' => '#']],
                ['label' => 'YouTube', 'icon' => ['value' => 'fab fa-youtube', 'library' => 'fa-brands'], 'url' => ['url' => '#']],
                ['label' => 'LinkedIn', 'icon' => ['value' => 'fab fa-linkedin-in', 'library' => 'fa-brands'], 'url' => ['url' => '#']],
                ['label' => 'X', 'icon' => ['value' => 'fab fa-x-twitter', 'library' => 'fa-brands'], 'url' => ['url' => '#']],
            ],
            'title_field' => '{{{ label }}}',
        ]);

        $this->add_control('copyright', [
            'label' => esc_html__('Copyright', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::TEXT,
            'default' => '© 2026 Imbuto Hubs. All Rights Reserved.',
        ]);

        $this->end_controls_section();

        $this->start_controls_section('style_section', [
            'label' => esc_html__('Style', 'imbuto-elementor-widgets'),
            'tab' => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control('section_background', ['label' => esc_html__('Section Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-site-footer' => 'background-color: {{VALUE}};']]);
        $this->add_control('card_background', ['label' => esc_html__('Card Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-site-footer__intro, {{WRAPPER}} .imbuto-site-footer__connect' => 'background: {{VALUE}};']]);
        $this->add_control('card_border_color', ['label' => esc_html__('Card Border Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-site-footer__intro, {{WRAPPER}} .imbuto-site-footer__connect' => 'border-color: {{VALUE}};']]);
        $this->add_responsive_control('section_padding', ['label' => esc_html__('Section Padding', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', 'em', '%'], 'selectors' => ['{{WRAPPER}} .imbuto-site-footer' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_responsive_control('card_padding', ['label' => esc_html__('Card Padding', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', 'em'], 'selectors' => ['{{WRAPPER}} .imbuto-site-footer__intro, {{WRAPPER}} .imbuto-site-footer__connect' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_responsive_control('logo_height', ['label' => esc_html__('Logo Height', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['px'], 'range' => ['px' => ['min' => 20, 'max' => 120]], 'selectors' => ['{{WRAPPER}} .imbuto-site-footer__brand img' => 'height: {{SIZE}}{{UNIT}};']]);
        $this->add_control('title_color', ['label' => esc_html__('Title Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-site-footer h2' => 'color: {{VALUE}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'title_typography', 'label' => esc_html__('Title Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-site-footer h2']);
        $this->add_control('description_color', ['label' => esc_html__('Description Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-site-footer__intro p' => 'color: {{VALUE}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'description_typography', 'label' => esc_html__('Description Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-site-footer__intro p']);
        $this->add_control('accent_color', ['label' => esc_html__('Accent Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-site-footer h3, {{WRAPPER}} .imbuto-site-footer__connect a:hover' => 'color: {{VALUE}};', '{{WRAPPER}} .imbuto-site-footer__socials a:hover' => 'background: {{VALUE}};']]);
        $this->add_responsive_control('social_icon_size', ['label' => esc_html__('Social Icon Size', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['px'], 'range' => ['px' => ['min' => 12, 'max' => 48]], 'selectors' => ['{{WRAPPER}} .imbuto-site-footer__socials svg, {{WRAPPER}} .imbuto-site-footer__socials i' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; font-size: {{SIZE}}{{UNIT}};']]);
        $this->end_controls_section();
    }

    protected function render(): void
    {
        enqueue_frontend_assets();
        $settings = $this->get_settings_for_display();
        $social_links = !empty($settings['social_links']) && is_array($settings['social_links']) ? $settings['social_links'] : [];
        $logo = $settings['logo']['url'] ?? image_url('updated-IMBUTO LOGO-03.png');
        ?>
        <footer class="imbuto-site-footer">
            <div class="imbuto-container">
                <div class="imbuto-site-footer__grid">
                    <div class="imbuto-site-footer__intro">
                        <div class="imbuto-site-footer__brand">
                            <?php if ($logo) : ?><img src="<?php echo esc_url($logo); ?>" alt="<?php echo esc_attr__('Imbuto Hub Logo', 'imbuto-elementor-widgets'); ?>"><?php endif; ?>
                        </div>
                        <h2><?php echo esc_html($settings['title']); ?></h2>
                        <p><?php echo esc_html($settings['description']); ?></p>
                    </div>

                    <div class="imbuto-site-footer__connect">
                        <div>
                            <h3><?php echo esc_html($settings['connect_label']); ?></h3>
                            <?php if (!empty($settings['email'])) : ?>
                                <p><a href="mailto:<?php echo esc_attr($settings['email']); ?>"><?php echo esc_html($settings['email']); ?></a></p>
                            <?php endif; ?>
                        </div>
                        <div class="imbuto-site-footer__socials" aria-label="<?php echo esc_attr__('Social links', 'imbuto-elementor-widgets'); ?>">
                            <?php foreach ($social_links as $social) : ?>
                                <?php if (!empty($social['icon']['value']) || !empty($social['short_label'])) : ?>
                                    <a href="<?php echo esc_url($social['url']['url'] ?? '#'); ?>" aria-label="<?php echo esc_attr($social['label'] ?? 'Social link'); ?>">
                                        <?php if (!empty($social['icon']['value'])) : ?>
                                            <?php Icons_Manager::render_icon($social['icon'], ['aria-hidden' => 'true']); ?>
                                        <?php else : ?>
                                            <?php echo esc_html($social['short_label']); ?>
                                        <?php endif; ?>
                                    </a>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <div class="imbuto-site-footer__bottom">
                    <div><?php echo esc_html($settings['copyright']); ?></div>
                </div>
            </div>
        </footer>
        <?php
    }
}
