<?php
if (!isset($section)) return;

$title = esc_html($section['title'] ?? '');
$content = esc_html($section['content'] ?? '');
$tag = esc_html($section['heading_tag'] ?? 'h2');
$bg_color = esc_attr($section['background'] ?? '#ffffff');
$text_color = esc_attr($section['text_color'] ?? '#000000');
$font_size = intval($section['font_size'] ?? 16);
?>

<section class="fpb-text-section" style="background:<?= $bg_color ?>; padding:2rem;">
    <<?= $tag ?> style="color:<?= $text_color ?>;"><?= $title ?></<?= $tag ?>>
    <p style="color:<?= $text_color ?>; font-size:<?= $font_size ?>px;"><?= $content ?></p>
</section>
