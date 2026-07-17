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

class Involve_Support_Widget extends Widget_Base
{
    public function get_name(): string
    {
        return 'imbuto_involve_support';
    }

    public function get_title(): string
    {
        return esc_html__('Imbuto Support / Donate', 'imbuto-elementor-widgets');
    }

    public function get_icon(): string
    {
        return 'eicon-heart';
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
        $this->add_control('section_id', ['label' => esc_html__('Section ID', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'support']);
        $this->add_control('eyebrow', ['label' => esc_html__('Eyebrow', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'Support a Programme / Donate']);
        $this->add_control('title', ['label' => esc_html__('Title', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXTAREA, 'default' => 'Every contribution grows something.']);
        $this->add_control('description', ['label' => esc_html__('Description', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXTAREA, 'default' => 'Support can include equipment, programme funding, volunteer time, training, or services that strengthen hub delivery and reach. Your contribution helps keep core programmes accessible and free for participants.']);
        $this->add_control('notice', ['label' => esc_html__('Notice', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXTAREA, 'default' => 'Donation processing platform and payment gateway to be confirmed by Imbuto Foundation before this section goes live.']);
        $this->add_control('button_label', ['label' => esc_html__('Button Label', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'Support Imbuto Hubs']);
        $this->add_control('button_url', ['label' => esc_html__('Button URL', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::URL, 'default' => ['url' => '#support-form']]);
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
        $this->end_controls_section();

        $this->start_controls_section('options_section', ['label' => esc_html__('Support Options', 'imbuto-elementor-widgets')]);
        $options = new Repeater();
        $options->add_control('title', ['label' => esc_html__('Title', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'Infrastructure Partner']);
        $options->add_control('text', ['label' => esc_html__('Text', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXTAREA, 'default' => 'Support the construction or equipping of hub facilities.']);
        $this->add_control('options', [
            'label' => esc_html__('Options', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $options->get_controls(),
            'title_field' => '{{{ title }}}',
            'default' => [
                ['title' => 'Infrastructure Partner', 'text' => 'Support the construction or equipping of hub facilities.'],
                ['title' => 'Programme Partner', 'text' => 'Co-deliver or co-fund programmes.'],
                ['title' => 'Corporate Sponsor', 'text' => 'Support hubs through sponsorship and brand partnerships.'],
                ['title' => 'Technical Partner', 'text' => 'Provide expertise, equipment, or technology.'],
                ['title' => 'Employment Pathway Partner', 'text' => 'Offer internships, apprenticeships, or job opportunities.'],
            ],
        ]);
        $this->end_controls_section();

        $this->start_controls_section('section_style', ['label' => esc_html__('Section & Panel', 'imbuto-elementor-widgets'), 'tab' => Controls_Manager::TAB_STYLE]);
        $this->add_control('section_background', ['label' => esc_html__('Section Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-involve-support' => 'background: {{VALUE}};']]);
        $this->add_control('panel_background', ['label' => esc_html__('Panel Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-involve-support__panel' => 'background: {{VALUE}};']]);
        $this->add_responsive_control('section_padding', ['label' => esc_html__('Section Padding', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', 'em', '%'], 'selectors' => ['{{WRAPPER}} .imbuto-involve-support' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_responsive_control('panel_padding', ['label' => esc_html__('Panel Padding', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', 'em', '%'], 'selectors' => ['{{WRAPPER}} .imbuto-involve-support__panel' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_responsive_control('panel_radius', ['label' => esc_html__('Panel Radius', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', '%'], 'selectors' => ['{{WRAPPER}} .imbuto-involve-support__panel' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->end_controls_section();

        $this->start_controls_section('text_style', ['label' => esc_html__('Text', 'imbuto-elementor-widgets'), 'tab' => Controls_Manager::TAB_STYLE]);
        $this->add_control('eyebrow_color', ['label' => esc_html__('Eyebrow Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-involve-support__eyebrow' => 'color: {{VALUE}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'eyebrow_typography', 'label' => esc_html__('Eyebrow Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-involve-support__eyebrow']);
        $this->add_control('title_color', ['label' => esc_html__('Title Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-involve-support h2' => 'color: {{VALUE}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'title_typography', 'label' => esc_html__('Title Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-involve-support h2']);
        $this->add_control('description_color', ['label' => esc_html__('Description Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-involve-support__description' => 'color: {{VALUE}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'description_typography', 'label' => esc_html__('Description Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-involve-support__description']);
        $this->end_controls_section();

        $this->start_controls_section('option_style', ['label' => esc_html__('Option Cards', 'imbuto-elementor-widgets'), 'tab' => Controls_Manager::TAB_STYLE]);
        $this->add_responsive_control('options_gap', ['label' => esc_html__('Gap', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['px'], 'range' => ['px' => ['min' => 0, 'max' => 60]], 'selectors' => ['{{WRAPPER}} .imbuto-involve-support__options' => 'gap: {{SIZE}}{{UNIT}};']]);
        $this->add_control('option_background', ['label' => esc_html__('Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-involve-support__option, {{WRAPPER}} .imbuto-involve-support__notice' => 'background: {{VALUE}};']]);
        $this->add_control('option_border', ['label' => esc_html__('Border Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-involve-support__option, {{WRAPPER}} .imbuto-involve-support__notice' => 'border-color: {{VALUE}};']]);
        $this->add_responsive_control('option_padding', ['label' => esc_html__('Padding', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', 'em'], 'selectors' => ['{{WRAPPER}} .imbuto-involve-support__option, {{WRAPPER}} .imbuto-involve-support__notice' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_responsive_control('option_radius', ['label' => esc_html__('Radius', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', '%'], 'selectors' => ['{{WRAPPER}} .imbuto-involve-support__option, {{WRAPPER}} .imbuto-involve-support__notice' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_control('option_title_color', ['label' => esc_html__('Title Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-involve-support__option h3' => 'color: {{VALUE}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'option_title_typography', 'label' => esc_html__('Title Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-involve-support__option h3']);
        $this->add_control('option_text_color', ['label' => esc_html__('Text Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-involve-support__option p, {{WRAPPER}} .imbuto-involve-support__notice' => 'color: {{VALUE}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'option_text_typography', 'label' => esc_html__('Text Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-involve-support__option p, {{WRAPPER}} .imbuto-involve-support__notice']);
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
        ?>
        <section id="<?php echo esc_attr($settings['section_id'] ?? 'support'); ?>" class="imbuto-involve-support">
            <div class="imbuto-container">
                <div class="imbuto-involve-support__panel">
                    <?php if (!empty($settings['eyebrow'])) : ?><div class="imbuto-involve-support__eyebrow"><?php echo esc_html($settings['eyebrow']); ?></div><?php endif; ?>
                    <?php if (!empty($settings['title'])) : ?><h2><?php echo esc_html($settings['title']); ?></h2><?php endif; ?>
                    <?php if (!empty($settings['description'])) : ?><p class="imbuto-involve-support__description"><?php echo esc_html($settings['description']); ?></p><?php endif; ?>
                    <div class="imbuto-involve-support__options">
                        <?php foreach (($settings['options'] ?? []) as $option) : ?>
                            <article class="imbuto-involve-support__option">
                                <h3><?php echo esc_html($option['title'] ?? ''); ?></h3>
                                <p><?php echo esc_html($option['text'] ?? ''); ?></p>
                            </article>
                        <?php endforeach; ?>
                    </div>
                    <?php if (!empty($settings['notice'])) : ?><div class="imbuto-involve-support__notice"><?php echo esc_html($settings['notice']); ?></div><?php endif; ?>
                    <?php if (!empty($settings['button_label'])) : ?>
                        <a class="imbuto-involve-button imbuto-involve-button--light" href="<?php echo esc_url($settings['button_url']['url'] ?? '#'); ?>">
                            <?php if (($settings['button_icon_position'] ?? 'after') === 'before' && !empty($settings['button_icon']['value'])) : ?><?php Icons_Manager::render_icon($settings['button_icon'], ['aria-hidden' => 'true']); ?><?php endif; ?>
                            <?php echo esc_html($settings['button_label']); ?>
                            <?php if (($settings['button_icon_position'] ?? 'after') === 'after' && !empty($settings['button_icon']['value'])) : ?><?php Icons_Manager::render_icon($settings['button_icon'], ['aria-hidden' => 'true']); ?><?php endif; ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </section>
        <?php
    }
}
