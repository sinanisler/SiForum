jQuery(".profile-menu-button").click(function(){
    jQuery(".profile-menu").toggle();
});







jQuery(window).scroll(function() {
    
    viewportHeight  = jQuery(window).height();
    documentHeight  = jQuery(document).height();
    postcount       = <?php echo get_comments_number( get_the_ID());  ?>+1;
    ScrollPosition  = jQuery(window).scrollTop();

    divide_scroll_with_count = ScrollPosition / postcount;

    total_window_height = jQuery(document).height();

    percent = (ScrollPosition / (documentHeight - viewportHeight)) * 100;
    clear_percentage = percent.toFixed(1);

    divide_p_with_p = clear_percentage / postcount;


    // Count Print
    jQuery('.scroll-container-position').html(divide_p_with_p.toFixed(1) + " / " + postcount);

    
    // CSS Pos
    jQuery(".scroll-container-position").css("top", clear_percentage * 3);

});
 





jQuery( ".scroll-container-first-button" ).on( "click", function() {    jQuery(document).scrollTop(0);      });


