<?php

namespace Imbuto\ElementorWidgets;

use Elementor\Controls_Manager;
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

        $this->add_control('title', [
            'label' => esc_html__('Title', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::TEXTAREA,
            'default' => 'Growing futures, one hub at a time.',
        ]);

        $this->add_control('description', [
            'label' => esc_html__('Description', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::TEXTAREA,
            'default' => 'Imbuto Hubs create safe, inspiring spaces where children, youth, and families access learning, wellbeing, creativity, mentorship, and opportunity across Rwanda.',
        ]);

        $this->add_control('email', [
            'label' => esc_html__('Email', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::TEXT,
            'default' => 'info@imbutofoundation.org',
        ]);

        $this->add_control('phone', [
            'label' => esc_html__('Phone', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::TEXT,
            'default' => '+250 XXX XXX XXX',
        ]);

        $this->end_controls_section();
    }

    protected function render(): void
    {
        enqueue_frontend_assets();
        $settings = $this->get_settings_for_display();
        $groups = [
            [
                'title' => 'About',
                'items' => ['About Imbuto Hubs', 'Our Model', 'Vision & Mission', 'Impact Stories'],
            ],
            [
                'title' => 'Programmes',
                'items' => ['Early Childhood Development', 'Education & Personal Development', 'Digital Literacy & Innovation', 'Health & Wellbeing', 'Sports & Recreation', 'Creative Arts & Culture'],
            ],
            [
                'title' => 'Explore',
                'items' => ['Kigali Imbuto Hub', 'Musanze Imbuto Hub', 'Huye Imbuto Hub', 'Rubavu Imbuto Hub', 'Nyagatare Imbuto Hub', 'Bugesera Imbuto Hub'],
            ],
        ];
        ?>
        <footer class="imbuto-site-footer">
            <div class="imbuto-container">
                <div class="imbuto-site-footer__grid">
                    <div class="imbuto-site-footer__intro">
                        <div class="imbuto-site-footer__brand">
                            <span>IH</span>
                            Imbuto Foundation
                        </div>
                        <h2><?php echo esc_html($settings['title']); ?></h2>
                        <p><?php echo esc_html($settings['description']); ?></p>
                        <div class="imbuto-site-footer__actions">
                            <a class="imbuto-button imbuto-button--orange" href="/hubs#hub-map">Find a Hub</a>
                            <a class="imbuto-button imbuto-button--ghost" href="/get-involved">Get Involved</a>
                        </div>
                    </div>

                    <div class="imbuto-site-footer__content">
                        <div class="imbuto-site-footer__links">
                            <?php foreach ($groups as $group) : ?>
                                <section>
                                    <h3><?php echo esc_html($group['title']); ?></h3>
                                    <ul>
                                        <?php foreach ($group['items'] as $item) : ?>
                                            <li><?php echo esc_html($item); ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </section>
                            <?php endforeach; ?>
                        </div>

                        <div class="imbuto-site-footer__connect">
                            <div>
                                <h3>Connect</h3>
                                <p>Imbuto Foundation</p>
                                <p>Kigali, Rwanda</p>
                                <p><?php echo esc_html($settings['email']); ?></p>
                                <p><?php echo esc_html($settings['phone']); ?></p>
                            </div>
                            <div class="imbuto-site-footer__socials" aria-label="<?php echo esc_attr__('Social links', 'imbuto-elementor-widgets'); ?>">
                                <?php foreach (['F', 'I', 'Y', 'L', 'X'] as $social) : ?>
                                    <span><?php echo esc_html($social); ?></span>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="imbuto-site-footer__bottom">
                    <div>
                        <span>Privacy Policy</span>
                        <span>Terms of Use</span>
                        <span>Accessibility Statement</span>
                    </div>
                    <div>© <?php echo esc_html((string) gmdate('Y')); ?> Imbuto Hubs. All Rights Reserved.</div>
                </div>
            </div>
        </footer>
        <?php
    }
}
