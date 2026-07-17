<?php

namespace Imbuto\ElementorWidgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit;
}

class Impact_Gallery_Widget extends Widget_Base
{
    public function get_name(): string
    {
        return 'imbuto_impact_gallery';
    }

    public function get_title(): string
    {
        return esc_html__('Imbuto Impact Gallery', 'imbuto-elementor-widgets');
    }

    public function get_icon(): string
    {
        return 'eicon-gallery-grid';
    }

    public function get_categories(): array
    {
        return ['imbuto'];
    }

    public function get_style_depends(): array
    {
        return ['imbuto-widgets'];
    }

    public function get_script_depends(): array
    {
        return ['imbuto-widgets'];
    }

    protected function register_controls(): void
    {
        $this->start_controls_section('content_section', ['label' => esc_html__('Content', 'imbuto-elementor-widgets')]);
        $this->add_control('title', ['label' => esc_html__('Title', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXTAREA, 'default' => 'Gallery']);
        $this->add_control('description', ['label' => esc_html__('Description', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXTAREA, 'default' => 'Moments from learning, mentorship, wellbeing, creativity, sport, and community life across the Imbuto Hubs network.']);
        $this->add_control('modal_label', ['label' => esc_html__('Modal Eyebrow', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'Gallery']);
        $this->add_control('previous_label', ['label' => esc_html__('Previous Label', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'Previous']);
        $this->add_control('next_label', ['label' => esc_html__('Next Label', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'Next']);
        $this->add_control('gallery_images', [
            'label' => esc_html__('Gallery Images', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::GALLERY,
            'default' => $this->default_gallery_images(),
        ]);

        $items = new Repeater();
        $items->add_control('title', ['label' => esc_html__('Title', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'Gallery 01', 'label_block' => true]);
        $items->add_control('image', ['label' => esc_html__('Image', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::MEDIA, 'default' => ['url' => image_url('gallery/55270242117_a0626afba8_k.jpg')]]);

        $this->add_control('items', [
            'label' => esc_html__('Manual Gallery Items', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $items->get_controls(),
            'title_field' => '{{{ title }}}',
            'default' => [],
            'description' => esc_html__('Optional fallback if Gallery Images is empty, or when you need custom per-image titles.', 'imbuto-elementor-widgets'),
        ]);
        $this->end_controls_section();

        $this->start_controls_section('section_style', ['label' => esc_html__('Section', 'imbuto-elementor-widgets'), 'tab' => Controls_Manager::TAB_STYLE]);
        $this->add_control('section_background', ['label' => esc_html__('Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-impact-gallery' => 'background: {{VALUE}};']]);
        $this->add_responsive_control('section_padding', ['label' => esc_html__('Padding', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', 'em', '%'], 'selectors' => ['{{WRAPPER}} .imbuto-impact-gallery' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_responsive_control('header_gap', ['label' => esc_html__('Header Gap', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['px'], 'range' => ['px' => ['min' => 0, 'max' => 80]], 'selectors' => ['{{WRAPPER}} .imbuto-impact-gallery__head' => 'gap: {{SIZE}}{{UNIT}};']]);
        $this->add_responsive_control('grid_spacing', ['label' => esc_html__('Grid Top Spacing', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['px'], 'range' => ['px' => ['min' => 0, 'max' => 100]], 'selectors' => ['{{WRAPPER}} .imbuto-impact-gallery__grid' => 'margin-top: {{SIZE}}{{UNIT}};']]);
        $this->add_responsive_control('grid_gap', ['label' => esc_html__('Grid Gap', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => ['px'], 'range' => ['px' => ['min' => 0, 'max' => 40]], 'selectors' => ['{{WRAPPER}} .imbuto-impact-gallery__grid' => 'gap: {{SIZE}}{{UNIT}};']]);
        $this->add_responsive_control('grid_radius', ['label' => esc_html__('Grid Radius', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', '%'], 'selectors' => ['{{WRAPPER}} .imbuto-impact-gallery__grid' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->end_controls_section();

        $this->start_controls_section('text_style', ['label' => esc_html__('Text', 'imbuto-elementor-widgets'), 'tab' => Controls_Manager::TAB_STYLE]);
        $this->add_control('title_color', ['label' => esc_html__('Title Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-impact-gallery__head h2' => 'color: {{VALUE}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'title_typography', 'label' => esc_html__('Title Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-impact-gallery__head h2']);
        $this->add_control('description_color', ['label' => esc_html__('Description Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-impact-gallery__head p' => 'color: {{VALUE}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'description_typography', 'label' => esc_html__('Description Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-impact-gallery__head p']);
        $this->end_controls_section();

        $this->start_controls_section('image_style', ['label' => esc_html__('Images & Modal', 'imbuto-elementor-widgets'), 'tab' => Controls_Manager::TAB_STYLE]);
        $this->add_control('image_background', ['label' => esc_html__('Image Fallback Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-impact-gallery__item' => 'background: {{VALUE}};']]);
        $this->add_responsive_control('image_aspect', ['label' => esc_html__('Image Aspect Width', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SLIDER, 'size_units' => [''], 'range' => ['' => ['min' => 1, 'max' => 2.5, 'step' => 0.01]], 'selectors' => ['{{WRAPPER}} .imbuto-impact-gallery__item' => 'aspect-ratio: {{SIZE}} / 1;']]);
        $this->add_control('hover_overlay', ['label' => esc_html__('Hover Overlay', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-impact-gallery__item::after' => 'background: {{VALUE}};']]);
        $this->add_control('modal_background', ['label' => esc_html__('Modal Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-impact-gallery-modal' => 'background: {{VALUE}};']]);
        $this->add_control('modal_text_color', ['label' => esc_html__('Modal Text Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-impact-gallery-modal' => 'color: {{VALUE}};']]);
        $this->end_controls_section();
    }

    protected function render(): void
    {
        enqueue_frontend_assets();
        $settings = $this->get_settings_for_display();
        $items = $this->get_gallery_items($settings);
        $gallery_id = 'imbuto-gallery-' . $this->get_id();
        ?>
        <section id="gallery" class="imbuto-impact-gallery" data-imbuto-gallery="<?php echo esc_attr($gallery_id); ?>">
            <div class="imbuto-container">
                <div class="imbuto-impact-gallery__head">
                    <h2><?php echo esc_html($settings['title'] ?? 'Gallery'); ?></h2>
                    <?php if (!empty($settings['description'])) : ?><p><?php echo esc_html($settings['description']); ?></p><?php endif; ?>
                </div>

                <div class="imbuto-impact-gallery__grid">
                    <?php foreach ($items as $index => $item) : ?>
                        <?php $image = $item['image']['url'] ?? ''; ?>
                        <?php if ($image) : ?>
                            <button class="imbuto-impact-gallery__item" type="button" data-gallery-index="<?php echo esc_attr((string) $index); ?>" aria-label="<?php echo esc_attr(sprintf(__('Open %s', 'imbuto-elementor-widgets'), $item['title'] ?? 'gallery image')); ?>">
                                <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($item['alt'] ?? $item['title'] ?? ''); ?>">
                            </button>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="imbuto-impact-gallery-modal" data-gallery-modal hidden data-gallery-items="<?php echo esc_attr(wp_json_encode($this->normalize_items($items))); ?>" data-modal-label="<?php echo esc_attr($settings['modal_label'] ?? 'Gallery'); ?>" data-previous-label="<?php echo esc_attr($settings['previous_label'] ?? 'Previous'); ?>" data-next-label="<?php echo esc_attr($settings['next_label'] ?? 'Next'); ?>">
                <div class="imbuto-impact-gallery-modal__inner" role="dialog" aria-modal="true" aria-label="<?php echo esc_attr($settings['modal_label'] ?? 'Gallery'); ?>">
                    <div class="imbuto-impact-gallery-modal__top">
                        <div>
                            <div class="imbuto-impact-gallery-modal__eyebrow" data-gallery-modal-label><?php echo esc_html($settings['modal_label'] ?? 'Gallery'); ?></div>
                            <h3 data-gallery-modal-title></h3>
                        </div>
                        <button type="button" class="imbuto-impact-gallery-modal__close" data-gallery-close aria-label="<?php echo esc_attr__('Close gallery image', 'imbuto-elementor-widgets'); ?>">×</button>
                    </div>
                    <div class="imbuto-impact-gallery-modal__image"><img data-gallery-modal-image alt=""></div>
                    <div class="imbuto-impact-gallery-modal__nav">
                        <button type="button" data-gallery-prev><?php echo esc_html($settings['previous_label'] ?? 'Previous'); ?></button>
                        <span data-gallery-counter></span>
                        <button type="button" data-gallery-next><?php echo esc_html($settings['next_label'] ?? 'Next'); ?></button>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }

    private function normalize_items(array $items): array
    {
        $normalized = [];

        foreach ($items as $item) {
            $image = $item['image']['url'] ?? '';
            if (!$image) {
                continue;
            }

            $normalized[] = [
                'title' => (string) ($item['title'] ?? ''),
                'alt' => (string) ($item['alt'] ?? $item['title'] ?? ''),
                'image' => $image,
            ];
        }

        return $normalized;
    }

    private function get_gallery_items(array $settings): array
    {
        if (!empty($settings['gallery_images']) && is_array($settings['gallery_images'])) {
            $items = [];

            foreach ($settings['gallery_images'] as $index => $image) {
                if (empty($image['url'])) {
                    continue;
                }

                $attachment_id = !empty($image['id']) ? (int) $image['id'] : 0;
                $title = $attachment_id ? get_the_title($attachment_id) : '';
                $alt = $attachment_id ? get_post_meta($attachment_id, '_wp_attachment_image_alt', true) : '';

                $items[] = [
                    'title' => $title ?: sprintf('Gallery %02d', $index + 1),
                    'alt' => $alt ?: ($title ?: sprintf('Gallery %02d', $index + 1)),
                    'image' => ['url' => $image['url']],
                ];
            }

            if ($items) {
                return $items;
            }
        }

        if (!empty($settings['items']) && is_array($settings['items'])) {
            return $settings['items'];
        }

        return $this->default_items();
    }

    private function default_gallery_images(): array
    {
        return array_map(
            fn ($item) => ['url' => $item['image']['url'] ?? ''],
            $this->default_items()
        );
    }

    private function default_items(): array
    {
        $filenames = [
            '55270242117_a0626afba8_k.jpg',
            '55270243822_a464e83a11_k.jpg',
            '55270244022_af6d12cfa8_k.jpg',
            '55271156911_4b28732802_6k.jpg',
            '55271161021_b50277f8b3_k.jpg',
            '55271161526_942df49b81_k.jpg',
            '55271291243_45ec2e250e_k.jpg',
            '55271387884_4de4c887a3_k.jpg',
            '55271389639_c61707ed44_k.jpg',
            '55271391719_b0b65dbf4c_k.jpg',
            '55271392924_a1247a06ed_k.jpg',
            '55271554100_90f68fe6ac_k.jpg',
            'WhatsApp Image 2026-06-16 at 12.06.34 PM (1).jpeg',
            'WhatsApp Image 2026-06-16 at 12.06.34 PM (2).jpeg',
            'WhatsApp Image 2026-06-16 at 12.06.34 PM.jpeg',
            'WhatsApp Image 2026-06-16 at 12.06.36 PM.jpeg',
        ];
        $items = [];

        foreach ($filenames as $index => $filename) {
            $items[] = [
                'title' => sprintf('Gallery %02d', $index + 1),
                'image' => ['url' => image_url('gallery/' . $filename)],
            ];
        }

        return $items;
    }
}
