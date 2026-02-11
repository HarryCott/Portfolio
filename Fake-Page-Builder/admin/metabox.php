<?php
if (!defined('ABSPATH')) exit;

/* ---------------------------------------
   Register Metabox
---------------------------------------- */

add_action('add_meta_boxes', function () {
    add_meta_box(
        'fpb_builder',
        'Fake Page Builder',
        'fpb_render_metabox',
        'page', // change if needed
        'normal',
        'high'
    );
});

/* ---------------------------------------
   Render Metabox
---------------------------------------- */

function fpb_render_metabox($post) {

    wp_nonce_field('fpb_save', 'fpb_nonce');

    $sections = get_post_meta($post->ID, '_fpb_sections', true);
    if (!is_array($sections)) {
        $sections = [];
    }
    ?>

    <div id="fpb-builder">


        <div id="fpb-sections">

            <?php foreach ($sections as $section): ?>
                <?php fpb_render_section($section); ?>
            <?php endforeach; ?>

        </div>

        <button type="button" class="button button-primary" id="fpb-add-section">
            Add Section
        </button>
    </div>

    <?php
}

/* ---------------------------------------
   Render Section
---------------------------------------- */

function fpb_render_section($section = []) {

    $type      = $section['type'] ?? 'hero';
    $title     = $section['title'] ?? '';
    $content   = $section['content'] ?? '';
    $bg_type   = $section['bg_type'] ?? 'colour';
    $bg_colour = $section['bg_colour'] ?? '#ffffff';
    $bg_image  = $section['bg_image'] ?? '';
    ?>

    <div class="fpb-section">

        <hr>

        <p>
            <label><strong>Section Type</strong></label><br>
            <select name="fpb[type][]">
                <option value="hero" <?php selected($type, 'hero'); ?>>Hero</option>
                <option value="text" <?php selected($type, 'text'); ?>>Text</option>
                <option value="image_text" <?php selected ($type, 'image_text');?>>Image + Text</option>
            </select>
        </p>

        <p>
            <label>Title</label><br>
            <input type="text"
                   name="fpb[title][]"
                   value="<?php echo esc_attr($title); ?>"
                   style="width:100%;">
        </p>

        <p>
            <label>Content</label><br>
            <textarea name="fpb[content][]" rows="4" style="width:100%;"><?php
                echo esc_textarea($content);
            ?></textarea>
        </p>

        <p>
            <strong>Background</strong><br>
            <label>
                <input type="radio" class="fpb-bg-type"
                       name="fpb[bg_type][]"
                       value="colour" <?php checked($bg_type, 'colour'); ?>>
                Colour
            </label>
            &nbsp;
            <label>
                <input type="radio" class="fpb-bg-type"
                       name="fpb[bg_type][]"
                       value="image" <?php checked($bg_type, 'image'); ?>>
                Image
            </label>
        </p>

        <div class="fpb-bg-colour">
            <label>Background Colour</label><br>
            <input type="text"
                   class="fpb-colour-picker"
                   name="fpb[bg_colour][]"
                   value="<?php echo esc_attr($bg_colour); ?>">
        </div>

        <div class="fpb-bg-image">
            <label>Background Image</label><br>
            <input type="text"
                   class="fpb-image"
                   name="fpb[bg_image][]"
                   value="<?php echo esc_attr($bg_image); ?>"
                   style="width:70%;">
            <button type="button" class="button fpb-upload">Upload</button>

            <div class="fpb-image-preview" style="margin-top:10px;">
                <?php if ($bg_image): ?>
                    <img src="<?php echo esc_url($bg_image); ?>" style="max-width:150px;">
                <?php endif; ?>
            </div>
        </div>

        <p>
            <button type="button" class="button fpb-remove-section">
                Remove Section
            </button>
        </p>

    </div>

<?php
}

/* ---------------------------------------
   Save Data
---------------------------------------- */

add_action('save_post', function ($post_id) {

    if (!isset($_POST['fpb_nonce']) ||
        !wp_verify_nonce($_POST['fpb_nonce'], 'fpb_save')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;
    if (empty($_POST['fpb'])) return;

    $fpb = $_POST['fpb'];
    $sections = [];

    $count = count($fpb['type']);

    for ($i = 0; $i < $count; $i++) {
        $sections[] = [
            'type'       => sanitize_text_field($fpb['type'][$i] ?? ''),
            'title'      => sanitize_text_field($fpb['title'][$i] ?? ''),
            'content'    => sanitize_textarea_field($fpb['content'][$i] ?? ''),
            'bg_type'    => sanitize_text_field($fpb['bg_type'][$i] ?? 'colour'),
            'bg_colour'  => sanitize_hex_color($fpb['bg_colour'][$i] ?? '#ffffff'),
            'bg_image'   => esc_url_raw($fpb['bg_image'][$i] ?? '')
        ];
    }

    update_post_meta($post_id, '_fpb_sections', $sections);
});
