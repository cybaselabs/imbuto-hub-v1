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

class Involve_Story_Widget extends Widget_Base
{
    public function get_name(): string
    {
        return 'imbuto_involve_story';
    }

    public function get_title(): string
    {
        return esc_html__('Imbuto Story CTA', 'imbuto-elementor-widgets');
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
        $this->start_controls_section('content_section', ['label' => esc_html__('Content', 'imbuto-elementor-widgets')]);
        $this->add_control('section_id', ['label' => esc_html__('Section ID', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'story']);
        $this->add_control('eyebrow', ['label' => esc_html__('Eyebrow', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'Be Part of the Imbuto Hubs Story']);
        $this->add_control('title', ['label' => esc_html__('Title', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXTAREA, 'default' => 'Register your interest.']);
        $this->add_control('description', ['label' => esc_html__('Description', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXTAREA, 'default' => 'Tell us who you are, what you are looking for, and where you are located so we can connect you to the right hub or programme. A coordinator will follow up within 48 hours.']);
        $this->end_controls_section();

        $this->start_controls_section('buttons_section', ['label' => esc_html__('Buttons', 'imbuto-elementor-widgets')]);
        $buttons = new Repeater();
        $buttons->add_control('label', ['label' => esc_html__('Label', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'Submit Registration']);
        $buttons->add_control('url', ['label' => esc_html__('URL', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::URL, 'default' => ['url' => '#registration-form']]);
        $buttons->add_control('style', ['label' => esc_html__('Style', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SELECT, 'default' => 'solid', 'options' => ['solid' => esc_html__('Solid', 'imbuto-elementor-widgets'), 'light' => esc_html__('Light', 'imbuto-elementor-widgets'), 'outline' => esc_html__('Outline', 'imbuto-elementor-widgets')]]);
        $buttons->add_control('icon', ['label' => esc_html__('Icon', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::ICONS, 'default' => ['value' => 'fas fa-arrow-right', 'library' => 'fa-solid']]);
        $buttons->add_control('icon_position', [
            'label' => esc_html__('Icon Position', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::SELECT,
            'default' => 'after',
            'options' => [
                'before' => esc_html__('Before Text', 'imbuto-elementor-widgets'),
                'after' => esc_html__('After Text', 'imbuto-elementor-widgets'),
            ],
        ]);
        $this->add_control('buttons', [
            'label' => esc_html__('CTA Buttons', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $buttons->get_controls(),
            'title_field' => '{{{ label }}}',
            'default' => [
                ['label' => 'Submit Registration', 'url' => ['url' => '#registration-form'], 'style' => 'solid', 'icon' => ['value' => 'fas fa-arrow-right', 'library' => 'fa-solid'], 'icon_position' => 'after'],
                ['label' => 'Volunteer or Mentor', 'url' => ['url' => '#volunteer-form'], 'style' => 'solid', 'icon' => ['value' => 'fas fa-arrow-right', 'library' => 'fa-solid'], 'icon_position' => 'after'],
                ['label' => 'Partner With Us', 'url' => ['url' => '#partner-form'], 'style' => 'solid', 'icon' => ['value' => 'fas fa-arrow-right', 'library' => 'fa-solid'], 'icon_position' => 'after'],
                ['label' => 'Support a Programme', 'url' => ['url' => '#support-form'], 'style' => 'solid', 'icon' => ['value' => 'fas fa-arrow-right', 'library' => 'fa-solid'], 'icon_position' => 'after'],
            ],
        ]);
        $this->end_controls_section();

        $this->start_controls_section('note_section', ['label' => esc_html__('Side Card', 'imbuto-elementor-widgets')]);
        $this->add_control('note_title', ['label' => esc_html__('Title', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'Privacy note']);
        $this->add_control('note_icon', ['label' => esc_html__('List Icon', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::ICONS, 'default' => ['value' => 'fas fa-circle-check', 'library' => 'fa-solid']]);
        $items = new Repeater();
        $items->add_control('text', ['label' => esc_html__('Text', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXTAREA, 'default' => 'We collect this information to support your request and connect you to the right hub or programme.', 'label_block' => true]);
        $this->add_control('note_items', [
            'label' => esc_html__('Items', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $items->get_controls(),
            'title_field' => '{{{ text }}}',
            'default' => [
                ['text' => 'We collect this information to support your request and connect you to the right hub or programme.'],
                ['text' => 'We will not share your personal information outside the approved Imbuto Hubs management process without your consent.'],
            ],
        ]);
        $this->end_controls_section();

        $this->start_controls_section('section_style', ['label' => esc_html__('Section & Layout', 'imbuto-elementor-widgets'), 'tab' => Controls_Manager::TAB_STYLE]);
        $this->add_control('section_background', ['label' => esc_html__('Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-involve-story' => 'background: {{VALUE}};']]);
        $this->add_responsive_control('section_padding', ['label' => esc_html__('Padding', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', 'em', '%'], 'selectors' => ['{{WRAPPER}} .imbuto-involve-story' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_responsive_control('column_gap', ['label' => esc_html__('Column Gap', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['px'], 'range' => ['px' => ['min' => 0, 'max' => 140]], 'selectors' => ['{{WRAPPER}} .imbuto-involve-story__grid' => 'gap: {{SIZE}}{{UNIT}};']]);
        $this->end_controls_section();

        $this->start_controls_section('text_style', ['label' => esc_html__('Text', 'imbuto-elementor-widgets'), 'tab' => Controls_Manager::TAB_STYLE]);
        $this->add_control('eyebrow_color', ['label' => esc_html__('Eyebrow Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-involve-story__eyebrow' => 'color: {{VALUE}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'eyebrow_typography', 'label' => esc_html__('Eyebrow Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-involve-story__eyebrow']);
        $this->add_control('title_color', ['label' => esc_html__('Title Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-involve-story__copy h2' => 'color: {{VALUE}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'title_typography', 'label' => esc_html__('Title Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-involve-story__copy h2']);
        $this->add_control('description_color', ['label' => esc_html__('Description Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-involve-story__copy p' => 'color: {{VALUE}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'description_typography', 'label' => esc_html__('Description Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-involve-story__copy p']);
        $this->end_controls_section();

        $this->start_controls_section('button_style', ['label' => esc_html__('Buttons', 'imbuto-elementor-widgets'), 'tab' => Controls_Manager::TAB_STYLE]);
        $this->add_responsive_control('button_gap', ['label' => esc_html__('Button Gap', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['px'], 'range' => ['px' => ['min' => 0, 'max' => 60]], 'selectors' => ['{{WRAPPER}} .imbuto-involve-story__buttons' => 'gap: {{SIZE}}{{UNIT}};']]);
        $this->add_control('button_color', ['label' => esc_html__('Solid Text Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-involve-button' => 'color: {{VALUE}};']]);
        $this->add_control('button_background', ['label' => esc_html__('Solid Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-involve-button' => 'background: {{VALUE}};']]);
        $this->add_control('button_hover_background', ['label' => esc_html__('Solid Hover Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-involve-button:hover' => 'background: {{VALUE}};']]);
        $this->add_control('button_icon_color', ['label' => esc_html__('Icon Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-involve-button svg, {{WRAPPER}} .imbuto-involve-button i' => 'color: {{VALUE}};', '{{WRAPPER}} .imbuto-involve-button svg path' => 'fill: {{VALUE}};']]);
        $this->add_responsive_control('button_icon_size', ['label' => esc_html__('Icon Size', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['px'], 'range' => ['px' => ['min' => 8, 'max' => 48]], 'selectors' => ['{{WRAPPER}} .imbuto-involve-button svg, {{WRAPPER}} .imbuto-involve-button i' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; font-size: {{SIZE}}{{UNIT}};']]);
        $this->add_responsive_control('button_text_icon_gap', ['label' => esc_html__('Text/Icon Gap', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['px'], 'range' => ['px' => ['min' => 0, 'max' => 40]], 'selectors' => ['{{WRAPPER}} .imbuto-involve-button' => 'gap: {{SIZE}}{{UNIT}};']]);
        $this->add_responsive_control('button_padding', ['label' => esc_html__('Button Padding', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', 'em'], 'selectors' => ['{{WRAPPER}} .imbuto-involve-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_responsive_control('button_radius', ['label' => esc_html__('Button Radius', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', '%'], 'selectors' => ['{{WRAPPER}} .imbuto-involve-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'button_typography', 'label' => esc_html__('Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-involve-button']);
        $this->end_controls_section();

        $this->start_controls_section('note_style', ['label' => esc_html__('Side Card', 'imbuto-elementor-widgets'), 'tab' => Controls_Manager::TAB_STYLE]);
        $this->add_control('note_background', ['label' => esc_html__('Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-involve-story__panel' => 'background: {{VALUE}};']]);
        $this->add_control('note_border', ['label' => esc_html__('Border Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-involve-story__panel' => 'border-color: {{VALUE}};']]);
        $this->add_responsive_control('note_padding', ['label' => esc_html__('Padding', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', 'em'], 'selectors' => ['{{WRAPPER}} .imbuto-involve-story__panel' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_responsive_control('note_radius', ['label' => esc_html__('Radius', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', '%'], 'selectors' => ['{{WRAPPER}} .imbuto-involve-story__panel' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_control('note_title_color', ['label' => esc_html__('Title Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-involve-story__panel h3' => 'color: {{VALUE}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'note_title_typography', 'label' => esc_html__('Title Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-involve-story__panel h3']);
        $this->add_control('note_text_color', ['label' => esc_html__('Text Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-involve-story__item' => 'color: {{VALUE}};']]);
        $this->add_control('note_icon_color', ['label' => esc_html__('Icon Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-involve-story__check' => 'color: {{VALUE}};', '{{WRAPPER}} .imbuto-involve-story__check svg path' => 'fill: {{VALUE}};']]);
        $this->end_controls_section();
    }

    protected function render(): void
    {
        enqueue_frontend_assets();
        $settings = $this->get_settings_for_display();
        ?>
        <section id="<?php echo esc_attr($settings['section_id'] ?? 'story'); ?>" class="imbuto-involve-story">
            <div class="imbuto-container">
                <div class="imbuto-involve-story__grid">
                    <div class="imbuto-involve-story__copy">
                        <?php if (!empty($settings['eyebrow'])) : ?><div class="imbuto-involve-story__eyebrow"><?php echo esc_html($settings['eyebrow']); ?></div><?php endif; ?>
                        <?php if (!empty($settings['title'])) : ?><h2><?php echo esc_html($settings['title']); ?></h2><?php endif; ?>
                        <?php if (!empty($settings['description'])) : ?><p><?php echo esc_html($settings['description']); ?></p><?php endif; ?>
                        <div class="imbuto-involve-story__buttons">
                            <?php foreach (($settings['buttons'] ?? []) as $button) : ?>
                                <?php if (!empty($button['label'])) : ?>
                                    <a class="imbuto-involve-button imbuto-involve-button--<?php echo esc_attr($button['style'] ?? 'solid'); ?>" href="<?php echo esc_url($button['url']['url'] ?? '#'); ?>">
                                        <?php if (($button['icon_position'] ?? 'after') === 'before' && !empty($button['icon']['value'])) : ?><?php Icons_Manager::render_icon($button['icon'], ['aria-hidden' => 'true']); ?><?php endif; ?>
                                        <?php echo esc_html($button['label']); ?>
                                        <?php if (($button['icon_position'] ?? 'after') === 'after' && !empty($button['icon']['value'])) : ?><?php Icons_Manager::render_icon($button['icon'], ['aria-hidden' => 'true']); ?><?php endif; ?>
                                    </a>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="imbuto-involve-story__panel">
                        <?php if (!empty($settings['note_title'])) : ?><h3><?php echo esc_html($settings['note_title']); ?></h3><?php endif; ?>
                        <div class="imbuto-involve-story__list">
                            <?php foreach (($settings['note_items'] ?? []) as $item) : ?>
                                <div class="imbuto-involve-story__item">
                                    <span class="imbuto-involve-story__check"><?php Icons_Manager::render_icon($settings['note_icon'], ['aria-hidden' => 'true']); ?></span>
                                    <span><?php echo esc_html($item['text'] ?? ''); ?></span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
}
