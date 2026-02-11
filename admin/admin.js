jQuery(document).ready(function ($) {

    /* ==============================
       ADD SECTION
    ============================== */

    $('#fpb-add-section').on('click', function () {

        const template = $('.fpb-section').first().clone();

        // Clear all inputs in clone
        template.find('input[type="text"]').val('');
        template.find('textarea').val('');
        template.find('.fpb-image-preview').html('');

        // Reset radios to colour
        template.find('.fpb-bg-type[value="colour"]').prop('checked', true);
        template.find('.fpb-bg-type[value="image"]').prop('checked', false);

        $('#fpb-sections').append(template);

        updateBackgroundUI(template);
    });

    /* ==============================
       REMOVE SECTION
    ============================== */

    $(document).on('click', '.fpb-remove-section', function () {
        if ($('.fpb-section').length > 1) {
            $(this).closest('.fpb-section').remove();
        } else {
            alert('You must have at least one section.');
        }
    });

    /* ==============================
       BACKGROUND TOGGLE
    ============================== */

    function updateBackgroundUI(section) {
        const type = section.find('.fpb-bg-type:checked').val();

        if (type === 'image') {
            section.find('.fpb-bg-image').show();
            section.find('.fpb-bg-colour').hide();
        } else {
            section.find('.fpb-bg-colour').show();
            section.find('.fpb-bg-image').hide();
        }
    }

    // Initial state
    $('.fpb-section').each(function () {
        updateBackgroundUI($(this));
    });

    // Change handler
    $(document).on('change', '.fpb-bg-type', function () {
        updateBackgroundUI($(this).closest('.fpb-section'));
    });

    /* ==============================
       MEDIA UPLOADER
    ============================== */

    $(document).on('click', '.fpb-upload', function (e) {
        e.preventDefault();

        const button = $(this);
        const section = button.closest('.fpb-section');
        const input = section.find('.fpb-image');
        const preview = section.find('.fpb-image-preview');

        const frame = wp.media({
            title: 'Select Image',
            button: { text: 'Use Image' },
            multiple: false
        });

        frame.on('select', function () {
            const attachment = frame.state().get('selection').first().toJSON();

            input.val(attachment.url);

            preview.html(
                '<img src="' + attachment.url + '" style="max-width:150px;height:auto;">'
            );
        });

        frame.open();
    });

});
