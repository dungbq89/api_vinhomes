$(document).ready(function() {
    function toggleNavbarMethod() {
        if ($(window).width() > 768) {
            $('.navitor .dropdown').on('mouseover', function(){
                $('.dropdown-toggle', this).trigger('click');
            }).on('mouseout', function(){
                $('.dropdown-toggle', this).trigger('click').blur();
            });
        }
        else {
            $('.navitor .dropdown').off('mouseover').off('mouseout');
        }
    }

    // toggle navbar hover
    toggleNavbarMethod();

    // bind resize event
    $(window).resize(toggleNavbarMethod);
});