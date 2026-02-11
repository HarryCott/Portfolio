<?php
if (!isset($section)) return;

// Sanitize values
$title       = !empty($section['title']) ? esc_html($section['title']) : '';
$content     = !empty($section['content']) ? esc_html($section['content']) : '';
$bg_color    = !empty($section['background']) ? esc_attr($section['background']) : '#eeeeee';
$text_color  = !empty($section['text_color']) ? esc_attr($section['text_color']) : '#000000';
$font_size   = !empty($section['font_size']) ? intval($section['font_size']) : 32;

// IMPORTANT FIX — fallback if empty string
$allowed_tags = ['h1','h2','h3','h4','h5','h6'];
$tag = (!empty($section['heading_tag']) && in_array($section['heading_tag'], $allowed_tags))
    ? $section['heading_tag']
    : 'h1';
?>

<section class="fpb-hero" style="background:<?= $bg_color ?>; padding:3rem; text-align:center;">
    <<?= esc_attr($tag) ?> style="color:<?= $text_color ?>; font-size:<?= $font_size ?>px;">
        <?= $title ?>
    </<?= esc_attr($tag) ?>>
    
    <?php if (!empty($content)) : ?>
        <p style="color:<?= $text_color ?>;">
            <?= $content ?>
        </p>
    <?php endif; ?>
</section>
