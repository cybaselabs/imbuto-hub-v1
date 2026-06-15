<?php

namespace Imbuto\ElementorWidgets;

use Elementor\Controls_Manager;
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

        $this->end_controls_section();
    }

    protected function render(): void
    {
        enqueue_frontend_assets();
        $settings = $this->get_settings_for_display();
        ?>
        <section class="imbuto-cta" style="--imbuto-cta-image: url('<?php echo esc_url(image_url('55137870940_234fc85fe2_k.jpg')); ?>');">
            <div class="imbuto-container">
                <div class="imbuto-kicker">Get involved</div>
                <h2><?php echo esc_html($settings['title']); ?></h2>
                <p><?php echo esc_html($settings['description']); ?></p>
                <div class="imbuto-cta__actions">
                    <a class="imbuto-button imbuto-button--light" href="/get-involved#story">Join a Hub</a>
                    <a class="imbuto-button imbuto-button--ghost" href="/get-involved#volunteer">Volunteer or Mentor</a>
                    <a class="imbuto-button imbuto-button--ghost" href="/get-involved#partner">Partner With Us</a>
                </div>
            </div>
        </section>
        <?php
    }
}
