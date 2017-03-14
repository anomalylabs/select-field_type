$(function() {
    $('select.select2').each(function() {
        var $this = $(this);
        
        if (!$this.hasClass('select2-hidden-accessible')) {
            $this.select2({
                containerCssClass: 'form-control custom-select select2-override',
                dropdownCssClass: 'select2-option-override',
            });
        }
    });
});
