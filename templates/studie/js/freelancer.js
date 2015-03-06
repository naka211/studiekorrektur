/*!
 * Start Bootstrap - Freelancer Bootstrap Theme (http://startbootstrap.com)
 * Code licensed under the Apache License v2.0.
 * For details, see http://www.apache.org/licenses/LICENSE-2.0.
 */

// jQuery for page scrolling feature - requires jQuery Easing plugin
jQuery(function() {
    /*var navHeight = jQuery('#fixedNav').outerHeight(); // adjust this for your nav id*/

    jQuery(window).bind('resize', function(){
        navHeight = jQuery('#fixedNav').outerHeight(); // adjust this for your nav id
    });

    jQuery('body').on('click', '.page-scroll a', function(event) {
        var jQueryanchor = jQuery(this);
        jQuery('html, body').stop().animate({
            scrollTop: jQuery(jQueryanchor.attr('href')).offset().top /* - navHeight*/
        }, 1500, 'easeInOutExpo');
        event.preventDefault();
    });
});

// Floating label headings for the contact form
jQuery(function() {
    jQuery("body").on("input propertychange", ".floating-label-form-group", function(e) {
        jQuery(this).toggleClass("floating-label-form-group-with-value", !! jQuery(e.target).val());
    }).on("focus", ".floating-label-form-group", function() {
        jQuery(this).addClass("floating-label-form-group-with-focus");
    }).on("blur", ".floating-label-form-group", function() {
        jQuery(this).removeClass("floating-label-form-group-with-focus");
    });
});

// Highlight the top nav as scrolling occurs
jQuery('body').scrollspy({
    target: '.navbar-fixed-top'
})

// Closes the Responsive Menu on Menu Item Click
jQuery('.navbar-collapse ul li a').click(function() {
    jQuery('.navbar-toggle:visible').click();
});
