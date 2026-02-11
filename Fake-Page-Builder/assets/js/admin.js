
jQuery(document).ready(function($){

    // Add Section
jQuery(document).ready(function($){

    $(document).on('click', '#fpb-add-section', function(e){
        e.preventDefault();

        var newSection = `
        <div class="fpb-section-item" style="margin-bottom:20px; padding:10px; border:1px solid #ddd;">
            <p>
                <label>Type</label>
                <select name="fpb[type][]" class="fpb-type">
                    <option value="hero">Hero</option>
                    <option value="text">Text</option>
                    <option value="image_text" selected>Image + Text</option>
                </select>
            </p>
            <p>
                <label>Title</label>
                <input type="text" name="fpb[title][]" value="" style="width:100%;">
            </p>
            <p>
                <label>Content</label>
                <textarea name="fpb[content][]" style="width:100%;"></textarea>
            </p>
            <p>
                <label>Heading Tag</label>
                <input type="text" name="fpb[heading_tag][]" value="h2">
            </p>
            <p>
                <label>Text Color</label>
                <input type="color" name="fpb[text_color][]" value="#000000">
            </p>
            <p>
                <label>Background Color</label>
                <input type="color" name="fpb[background][]" value="#ffffff">
            </p>
            <p>
                <label>Font Size</label>
                <input type="number" name="fpb[font_size][]" value="16">
            </p>
            <p>
                <label>Image</label>
                <input type="text" class="fpb-image" name="fpb[image][]" value="" style="width:70%;">
                <button class="button fpb-upload" type="button">Upload</button>
            </p>
            <button class="button fpb-remove-section" type="button" style="margin-top:10px; background:#ff4d4d; color:#fff;">Remove Section</button>
        </div>`;

        $('#fpb-sections-container').append(newSection);
    });

});


    // Remove Section
    $(document).on('click', '.fpb-remove-section', function(e){
        e.preventDefault();
        $(this).closest('.fpb-section-item').remove();
    });

});

    // Upload Button
    $(document).on('click', '.fpb-upload', function(e){
        e.preventDefault();

        var input = $(this).closest('p').find('.fpb-image');
        var frame = wp.media({
            title: 'Select Image',
            button: { text: 'Use this image' },
            multiple: false
        });

        frame.on('select', function(){
            var attachment = frame.state().get('selection').first().toJSON();
            input.val(attachment.url);
        });

        frame.open();
    });

