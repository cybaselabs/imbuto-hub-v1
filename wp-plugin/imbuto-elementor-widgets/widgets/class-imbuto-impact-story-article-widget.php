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

class Impact_Story_Article_Widget extends Widget_Base
{
    public function get_name(): string
    {
        return 'imbuto_impact_story_article';
    }

    public function get_title(): string
    {
        return esc_html__('Imbuto Impact Story Detail', 'imbuto-elementor-widgets');
    }

    public function get_icon(): string
    {
        return 'eicon-single-post';
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
        $this->start_controls_section('hero_section', ['label' => esc_html__('Dynamic Story Detail', 'imbuto-elementor-widgets')]);
        $this->add_control('use_dynamic_post', ['label' => esc_html__('Use Current Impact Story Post', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SWITCHER, 'label_on' => esc_html__('Yes', 'imbuto-elementor-widgets'), 'label_off' => esc_html__('No', 'imbuto-elementor-widgets'), 'return_value' => 'yes', 'default' => 'yes']);
        $this->add_control('dynamic_story_id', ['label' => esc_html__('Fallback Story Post ID', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::NUMBER, 'min' => 0, 'default' => 0, 'description' => esc_html__('Optional. Used when this widget is not on a single story page.', 'imbuto-elementor-widgets'), 'condition' => ['use_dynamic_post' => 'yes']]);
        $this->add_control('back_label', ['label' => esc_html__('Back Link Label', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'Back to impact stories']);
        $this->add_control('back_url', ['label' => esc_html__('Back Link URL', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::URL, 'default' => ['url' => '/impact#stories']]);
        $this->add_control('back_icon', ['label' => esc_html__('Back Link Icon', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::ICONS, 'default' => ['value' => 'fas fa-arrow-left', 'library' => 'fa-solid']]);
        $this->add_control('eyebrow', ['label' => esc_html__('Eyebrow', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'Impact story']);
        $this->add_control('title', ['label' => esc_html__('Title', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXTAREA, 'default' => 'The Journey of Keza']);
        $this->add_control('subtitle', ['label' => esc_html__('Subtitle', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXTAREA, 'default' => 'A life shaped by learning, health, confidence, culture, and opportunity.']);
        $this->add_control('image', ['label' => esc_html__('Image', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::MEDIA, 'default' => ['url' => image_url('gallery/55271389639_c61707ed44_k.jpg')]]);
        $this->add_control('image_alt', ['label' => esc_html__('Image Alt Text', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'Aerial view of an Imbuto Hub campus']);
        $this->add_control('image_badge', ['label' => esc_html__('Image Badge', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'Keza\'s path']);
        $this->add_control('image_caption', ['label' => esc_html__('Image Caption', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXTAREA, 'default' => 'From early learning to mentorship, her story follows what becomes possible when services meet a young person at each stage of life.']);

        $meta = new Repeater();
        $meta->add_control('text', ['label' => esc_html__('Text', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'Featured story', 'label_block' => true]);
        $this->add_control('meta', [
            'label' => esc_html__('Meta Pills', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $meta->get_controls(),
            'title_field' => '{{{ text }}}',
            'default' => [['text' => 'Featured story'], ['text' => 'Imbuto Hubs'], ['text' => '5 min read']],
        ]);
        $this->end_controls_section();

        $this->start_controls_section('body_section', ['label' => esc_html__('Story Body', 'imbuto-elementor-widgets')]);
        $paragraphs = new Repeater();
        $paragraphs->add_control('text', ['label' => esc_html__('Paragraph', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXTAREA, 'default' => 'Before I tell you Keza\'s story, let\'s start with yours.', 'label_block' => true]);
        $this->add_control('paragraphs', [
            'label' => esc_html__('Paragraphs', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $paragraphs->get_controls(),
            'title_field' => '{{{ text }}}',
            'default' => $this->default_paragraphs(),
        ]);
        $this->add_control('quote_after', ['label' => esc_html__('Insert Quote After Paragraph #', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::NUMBER, 'default' => 16, 'min' => 0]);
        $this->add_control('quote', ['label' => esc_html__('Quote', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXTAREA, 'default' => 'Once upon a time I was you, and one day you will be me.']);
        $this->add_control('quote_attribution', ['label' => esc_html__('Quote Attribution', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'Keza, medical student & mentor']);
        $this->add_control('quote_icon', ['label' => esc_html__('Quote Icon', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::ICONS, 'default' => ['value' => 'fas fa-quote-left', 'library' => 'fa-solid']]);
        $this->end_controls_section();

        $this->start_controls_section('closing_section', ['label' => esc_html__('Closing CTA', 'imbuto-elementor-widgets')]);
        $this->add_control('closing_title', ['label' => esc_html__('Title', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXTAREA, 'default' => 'Where potential meets opportunity.']);
        $this->add_control('closing_text', ['label' => esc_html__('Text', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXTAREA, 'default' => 'Keza\'s story is a reminder that transformation rarely comes from one moment alone. It is built through care, structure, mentorship, and spaces that allow young people to grow.']);
        $buttons = new Repeater();
        $buttons->add_control('label', ['label' => esc_html__('Label', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::TEXT, 'default' => 'Register for a programme']);
        $buttons->add_control('url', ['label' => esc_html__('URL', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::URL, 'default' => ['url' => '/apply']]);
        $buttons->add_control('style', ['label' => esc_html__('Style', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::SELECT, 'default' => 'orange', 'options' => ['orange' => esc_html__('Orange', 'imbuto-elementor-widgets'), 'light' => esc_html__('Light', 'imbuto-elementor-widgets')]]);
        $buttons->add_control('icon', ['label' => esc_html__('Icon', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::ICONS, 'default' => ['value' => 'fas fa-arrow-right', 'library' => 'fa-solid']]);
        $this->add_control('buttons', [
            'label' => esc_html__('Buttons', 'imbuto-elementor-widgets'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $buttons->get_controls(),
            'title_field' => '{{{ label }}}',
            'default' => [
                ['label' => 'Register for a programme', 'url' => ['url' => '/apply'], 'style' => 'orange', 'icon' => ['value' => 'fas fa-arrow-right', 'library' => 'fa-solid']],
                ['label' => 'View gallery', 'url' => ['url' => '/impact#gallery'], 'style' => 'light', 'icon' => ['value' => 'fas fa-arrow-right', 'library' => 'fa-solid']],
            ],
        ]);
        $this->end_controls_section();

        $this->start_controls_section('section_style', ['label' => esc_html__('Section', 'imbuto-elementor-widgets'), 'tab' => Controls_Manager::TAB_STYLE]);
        $this->add_control('section_background', ['label' => esc_html__('Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-impact-article' => 'background: {{VALUE}};']]);
        $this->add_responsive_control('hero_padding', ['label' => esc_html__('Hero Padding', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', 'em', '%'], 'selectors' => ['{{WRAPPER}} .imbuto-impact-article__hero' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_responsive_control('body_padding', ['label' => esc_html__('Body Padding', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', 'em', '%'], 'selectors' => ['{{WRAPPER}} .imbuto-impact-article__body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->end_controls_section();

        $this->start_controls_section('card_style', ['label' => esc_html__('Cards', 'imbuto-elementor-widgets'), 'tab' => Controls_Manager::TAB_STYLE]);
        $this->add_control('hero_card_background', ['label' => esc_html__('Hero Card Background', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-impact-article__card, {{WRAPPER}} .imbuto-impact-article__content-card' => 'background: {{VALUE}};']]);
        $this->add_control('hero_card_border', ['label' => esc_html__('Hero Card Border', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-impact-article__card, {{WRAPPER}} .imbuto-impact-article__content-card' => 'border-color: {{VALUE}};']]);
        $this->add_responsive_control('card_radius', ['label' => esc_html__('Card Radius', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', '%'], 'selectors' => ['{{WRAPPER}} .imbuto-impact-article__card, {{WRAPPER}} .imbuto-impact-article__content-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_responsive_control('card_padding', ['label' => esc_html__('Content Card Padding', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => ['px', 'em', '%'], 'selectors' => ['{{WRAPPER}} .imbuto-impact-article__content-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->end_controls_section();

        $this->start_controls_section('text_style', ['label' => esc_html__('Typography & Colors', 'imbuto-elementor-widgets'), 'tab' => Controls_Manager::TAB_STYLE]);
        $this->add_control('title_color', ['label' => esc_html__('Title Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-impact-article__intro h1' => 'color: {{VALUE}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'title_typography', 'label' => esc_html__('Title Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-impact-article__intro h1']);
        $this->add_control('subtitle_color', ['label' => esc_html__('Subtitle Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-impact-article__subtitle' => 'color: {{VALUE}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'subtitle_typography', 'label' => esc_html__('Subtitle Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-impact-article__subtitle']);
        $this->add_control('paragraph_color', ['label' => esc_html__('Paragraph Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-impact-article__paragraphs p' => 'color: {{VALUE}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'paragraph_typography', 'label' => esc_html__('Paragraph Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-impact-article__paragraphs p']);
        $this->add_control('quote_color', ['label' => esc_html__('Quote Color', 'imbuto-elementor-widgets'), 'type' => Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .imbuto-impact-article__quote blockquote' => 'color: {{VALUE}};']]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name' => 'quote_typography', 'label' => esc_html__('Quote Typography', 'imbuto-elementor-widgets'), 'selector' => '{{WRAPPER}} .imbuto-impact-article__quote blockquote']);
        $this->end_controls_section();
    }

    protected function render(): void
    {
        enqueue_frontend_assets();
        $settings = $this->get_settings_for_display();
        $story = $this->get_dynamic_story($settings);
        $image = $story['image'] ?? ($settings['image']['url'] ?? image_url('gallery/55271389639_c61707ed44_k.jpg'));
        $title = $story['title'] ?? ($settings['title'] ?? '');
        $subtitle = $story['subtitle'] ?? ($settings['subtitle'] ?? '');
        $image_alt = $story['image_alt'] ?? ($settings['image_alt'] ?? '');
        $image_badge = $story['path_label'] ?? ($settings['image_badge'] ?? '');
        $image_caption = $story['path_summary'] ?? ($settings['image_caption'] ?? '');
        $quote = $story['quote'] ?? ($settings['quote'] ?? '');
        $quote_attribution = $story['attribution'] ?? ($settings['quote_attribution'] ?? '');
        $paragraphs = $story && !empty($story['body']) ? $this->paragraphs_from_body($story['body']) : (!empty($settings['paragraphs']) && is_array($settings['paragraphs']) ? $settings['paragraphs'] : $this->default_paragraphs());
        $meta = $story ? $this->dynamic_meta($story, $settings) : ($settings['meta'] ?? []);
        $quote_after = max(0, (int) ($settings['quote_after'] ?? 16));
        ?>
        <article class="imbuto-impact-article">
            <header class="imbuto-impact-article__hero">
                <div class="imbuto-container">
                    <?php if (!empty($settings['back_label'])) : ?>
                        <a class="imbuto-impact-article__back" href="<?php echo esc_url($settings['back_url']['url'] ?? '#'); ?>">
                            <?php if (!empty($settings['back_icon']['value'])) : ?><?php Icons_Manager::render_icon($settings['back_icon'], ['aria-hidden' => 'true']); ?><?php endif; ?>
                            <?php echo esc_html($settings['back_label']); ?>
                        </a>
                    <?php endif; ?>

                    <div class="imbuto-impact-article__card">
                        <div class="imbuto-impact-article__intro">
                            <?php if (!empty($settings['eyebrow'])) : ?><div class="imbuto-impact-article__eyebrow"><?php echo esc_html($settings['eyebrow']); ?></div><?php endif; ?>
                            <h1><?php echo esc_html($title); ?></h1>
                            <p class="imbuto-impact-article__subtitle"><?php echo esc_html($subtitle); ?></p>
                            <div class="imbuto-impact-article__meta">
                                <?php foreach ($meta as $meta_item) : ?>
                                    <?php if (!empty($meta_item['text'])) : ?><span><?php echo esc_html($meta_item['text']); ?></span><?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="imbuto-impact-article__media">
                            <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($image_alt); ?>">
                            <div class="imbuto-impact-article__caption">
                                <?php if (!empty($image_badge)) : ?><p><?php echo esc_html($image_badge); ?></p><?php endif; ?>
                                <?php if (!empty($image_caption)) : ?><span><?php echo esc_html($image_caption); ?></span><?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <section class="imbuto-impact-article__body">
                <div class="imbuto-container">
                    <div class="imbuto-impact-article__content-card">
                        <div class="imbuto-impact-article__paragraphs">
                            <?php foreach ($paragraphs as $index => $paragraph) : ?>
                                <?php if (!empty($paragraph['text'])) : ?><p class="<?php echo $index === 0 ? 'is-lead' : ''; ?>"><?php echo esc_html($paragraph['text']); ?></p><?php endif; ?>
                                <?php if ($quote_after === $index + 1 && !empty($quote)) : ?>
                                    <aside class="imbuto-impact-article__quote">
                                        <div><?php if (!empty($settings['quote_icon']['value'])) : ?><?php Icons_Manager::render_icon($settings['quote_icon'], ['aria-hidden' => 'true']); ?><?php endif; ?></div>
                                        <blockquote><?php echo esc_html($quote); ?></blockquote>
                                        <?php if (!empty($quote_attribution)) : ?><p><?php echo esc_html($quote_attribution); ?></p><?php endif; ?>
                                    </aside>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            <?php if ($quote_after > count($paragraphs) && !empty($quote)) : ?>
                                <aside class="imbuto-impact-article__quote">
                                    <div><?php if (!empty($settings['quote_icon']['value'])) : ?><?php Icons_Manager::render_icon($settings['quote_icon'], ['aria-hidden' => 'true']); ?><?php endif; ?></div>
                                    <blockquote><?php echo esc_html($quote); ?></blockquote>
                                    <?php if (!empty($quote_attribution)) : ?><p><?php echo esc_html($quote_attribution); ?></p><?php endif; ?>
                                </aside>
                            <?php endif; ?>
                        </div>

                        <div class="imbuto-impact-article__closing">
                            <?php if (!empty($settings['closing_title'])) : ?><h2><?php echo esc_html($settings['closing_title']); ?></h2><?php endif; ?>
                            <?php if (!empty($settings['closing_text'])) : ?><p><?php echo esc_html($settings['closing_text']); ?></p><?php endif; ?>
                            <div class="imbuto-impact-article__buttons">
                                <?php foreach (($settings['buttons'] ?? []) as $button) : ?>
                                    <?php if (!empty($button['label'])) : ?>
                                        <a class="imbuto-impact-article__button imbuto-impact-article__button--<?php echo esc_attr($button['style'] ?? 'light'); ?>" href="<?php echo esc_url($button['url']['url'] ?? '#'); ?>">
                                            <?php echo esc_html($button['label']); ?>
                                            <?php if (!empty($button['icon']['value'])) : ?><?php Icons_Manager::render_icon($button['icon'], ['aria-hidden' => 'true']); ?><?php endif; ?>
                                        </a>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </article>
        <?php
    }

    private function default_paragraphs(): array
    {
        $paragraphs = [
            "Before I tell you Keza's story, let's start with yours.",
            'You may sit in different departments, handling reports, budgets, programme plans, and schedules. But you are more than just a title.',
            'You are architects of possibility. Builders of dreams. You are the reason the Kezas and the Cyusas of Rwanda will rise and thrive.',
            'Whether you are in education, laying the foundation for brighter futures; in health, ensuring young bodies and minds grow strong; in mental health, creating safe spaces; or in finance, making sure every resource counts, every single one of you is essential.',
            "You don't just work behind desks. You help craft lives. It is through your dedication that Imbuto Hubs will soon stand as spaces of transformation.",
            'Now let me introduce you to Keza. Her story belongs to all of you.',
            'Keza was born in Musanze, one of those children with big eyes, bigger dreams, and a laugh that could light up the hills. Her life changed the day she toddled into an ECD center: bright walls, playful songs, and stories that made her believe she could be anything, even a doctor.',
            'But dreams, as we all know, need structure. Education. Zealous Keza was selected as an Edified Generation, an education programme that taught Keza more than math and science. It taught her excellence.',
            "As Keza entered her teens, she had questions. Why was Cyusa suddenly texting her so much? Why did her mother raise an eyebrow every time she talked about group projects? Health and ASRH, Adolescent Sexual Reproductive Health, stepped in through workshops where Keza learned to navigate her new age confidently. And no, she never replied to Cyusa's texts during study time.",
            "Yet life isn't just about physical health. It is also about the mind. Keza struggled some days, feeling unsure of herself and overwhelmed by expectations. That is when mental health programmes stepped in. She met counsellors who reminded her that self-love is part of success and equipped her with coping mechanisms.",
            'As she grew, Keza began asking deeper questions about our motherland. That is when Friday evenings at the hubs became her favourite: elders gathering to share stories through intergenerational dialogues. Their tales, rich with history and wisdom, would answer her questions and teach her about the giants whose shoulders we stand on.',
            'These elders will pass on lessons of resilience, strength, and unity, ensuring that as the youth rise, they do so with deep roots in their heritage.',
            'The Imbuto Hubs, a game-changer, will not be just a space. They will be home for every service Keza needs. Youth empowerment will help her discover her knack for hairstyling, a side hustle that will make her the unofficial braid boss of her district. Sports programmes will teach her teamwork. And knowledge development? Well, let us just say Keza can now write a budget that would make our finance department weep tears of joy.',
            'All of this, education, health, empowerment, and mental wellness, will be under one roof, guiding our youth from childhood to adulthood.',
            'Behind the scenes, HR found the people who mentored her. Procurement ensured every chalkboard, ball, and counselling tool made it to the right place. PMER, monitoring and evaluation, tracked her progress, making sure every effort counted. And communication made sure the world knew what Rwanda is doing for its youth.',
            'Today, Keza is a medical student. She still comes back to the hubs, this time as a mentor, telling kids: once upon a time I was you, and one day you will be me.',
            'To everyone, this is the power of us. Every Keza out there, every child who dares to dream, is a testament to what you do.',
            "Imbuto Hubs are where potential meets opportunity, where Keza's story isn't just a story. It is the future. And that future? It is in your hands.",
            'So let us build it. One hub at a time. One child at a time. One dream at a time.',
        ];

        return array_map(fn ($text) => ['text' => $text], $paragraphs);
    }

    private function get_dynamic_story(array $settings): ?array
    {
        if (($settings['use_dynamic_post'] ?? '') !== 'yes') {
            return null;
        }

        $post_id = get_the_ID();
        $fallback_id = (int) ($settings['dynamic_story_id'] ?? 0);

        if ($fallback_id > 0) {
            $post_id = $fallback_id;
        }

        if (!$post_id || get_post_status($post_id) !== 'publish') {
            return null;
        }

        return normalize_impact_story_post((int) $post_id);
    }

    private function dynamic_meta(array $story, array $settings): array
    {
        $meta = [];
        $meta[] = ['text' => $story['badge'] ? preg_replace('/,\s*.*/', '', $story['badge']) : 'Featured story'];

        if (!empty($story['related_program'])) {
            $meta[] = ['text' => $story['related_program']];
        }

        if (!empty($story['read_time'])) {
            $meta[] = ['text' => $story['read_time']];
        }

        return count($meta) > 1 ? $meta : ($settings['meta'] ?? $meta);
    }

    private function paragraphs_from_body(string $body): array
    {
        $body = trim(wp_strip_all_tags(strip_shortcodes($body)));

        if ($body === '') {
            return $this->default_paragraphs();
        }

        $chunks = preg_split('/\n\s*\n/', $body) ?: [$body];
        $paragraphs = [];

        foreach ($chunks as $chunk) {
            $text = trim(preg_replace('/\s+/', ' ', $chunk));

            if ($text !== '') {
                $paragraphs[] = ['text' => $text];
            }
        }

        return $paragraphs ?: $this->default_paragraphs();
    }
}
