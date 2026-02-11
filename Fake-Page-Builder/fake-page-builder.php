<?php
/*
Plugin Name: Fake Page Builder
Description: Simple ACF-style page builder plugin.
Version: 1.0
Author: HadesVerse
*/

if (!defined('ABSPATH')) exit;

// Load admin files
if (is_admin()) {
    require_once plugin_dir_path(__FILE__) . 'admin/metabox.php';
}

// Load frontend shortcode
require_once plugin_dir_path(__FILE__) . 'frontend/shortcode.php';

// Save post hook
add_action('save_post', function($post_id){

    // Don't save during autosave
    if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    
    // Check user permissions
    if(!current_user_can('edit_post', $post_id)) return;

    if(isset($_POST['fpb']) && is_array($_POST['fpb'])){
        $fpb = $_POST['fpb'];

        $sections = [];
        $count = count($fpb['type']); // number of sections

        for($i = 0; $i < $count; $i++){
            $sections[] = [
                'type'        => sanitize_text_field($fpb['type'][$i] ?? ''),
                'title'       => sanitize_text_field($fpb['title'][$i] ?? ''),
                'content'     => sanitize_textarea_field($fpb['content'][$i] ?? ''),
                'heading_tag' => sanitize_text_field($fpb['heading_tag'][$i] ?? ''),
                'text_color'  => sanitize_text_field($fpb['text_color'][$i] ?? ''),
                'background'  => sanitize_text_field($fpb['background'][$i] ?? ''),
                'font_size'   => intval($fpb['font_size'][$i] ?? 16),
                'image'       => esc_url_raw($fpb['image'][$i] ?? ''), // save image URL
            ];
        }

        update_post_meta($post_id, '_fpb_sections', $sections);
    }

}, 10, 1);


add_action('admin_enqueue_scripts', function () {

    wp_enqueue_media();

    wp_enqueue_script(
        'fpb-admin',
        plugin_dir_url(__FILE__) . 'admin/admin.js',
        ['jquery'],
        '1.0',
        true
    );

});