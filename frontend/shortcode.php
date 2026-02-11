<?php
if (!defined('ABSPATH')) exit;

add_shortcode('fpb_page', function() {
    global $post;
    $sections = get_post_meta($post->ID, '_fpb_sections', true);
    if (!is_array($sections)) return '';

    $output = '';

    foreach ($sections as $section) {
        $type = $section['type'] ?? 'text';
        $file = plugin_dir_path(dirname(__FILE__)) . "sections/{$type}.php";
        if (file_exists($file)) {
            ob_start();
            include $file; // $section available inside
            $output .= ob_get_clean();
        }
    }

    return $output;
});


add_shortcode('fpb_debug', function () {
    global $post;
    $sections = get_post_meta($post->ID, '_fpb_sections', true);
    return '<pre>' . esc_html(json_encode($sections, JSON_PRETTY_PRINT)) . '</pre>';
});
