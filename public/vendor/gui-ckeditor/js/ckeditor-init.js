$(function() {
    /* CKEditor */
    $('.ckeditor').each(function() {
        $(this).ckeditor({
            filebrowserBrowseUrl: cfg['ckeditorBrowseUrl'],
            filebrowserUploadUrl: cfg['ckeditorUploadUrl'],
        });
    });
});