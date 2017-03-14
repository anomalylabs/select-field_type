$(function() {
    $('select.select2').each(function() {
        $(this).select2({
            containerCssClass: 'form-control custom-select select2-override',
            dropdownCssClass: 'select2-option-override',
        });
    });
});
