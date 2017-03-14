$(function() {
    $('select.select2').each(function() {
        if (!$(element).hasClass('select2-hidden-accessible')) {
            $(this).select2({
                containerCssClass: 'form-control custom-select select2-override',
                dropdownCssClass: 'select2-option-override',
            });
        }
    });
});
