<?php


if (!isset($section)) return;

$title = esc_html($section['title'] ?? '');
$content = esc_html($section['content'] ?? '');
$tag = esc_html($section['heading_tag'] ?? 'h2');
$bg_color = esc_attr($section['background'] ?? '#ffffff');
$text_color = esc_attr($section['text_color'] ?? '#000000');
$font_size = intval($section['font_size'] ?? 16);
$image_url = esc_url($section['image'] ?? '');
?>

<section class="fpb-image-text-section" style="background: <?= $bg_color ?>; padding:2rem; display:flex; gap:1rem; align-items:center;">
    <?php if ($image_url): ?>
        <div class="fpb-image" style="flex:1;">
            <img src="<?= $image_url ?>" style="max-width:100%; height:auto;" alt="">
        </div>
    <?php endif; ?>

    <div class="fpb-text" style="flex:1;">
        <<?= $tag ?> style="color:<?= $text_color ?>;"><?= $title ?></<?= $tag ?>>
        <p style="color:<?= $text_color ?>; font-size:<?= $font_size ?>px;"><?= $content ?></p>
    </div>
</section>
