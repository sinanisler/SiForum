jQuery(".profile-menu-button").click(function(){
    jQuery(".profile-menu").toggle();
});



// Comment Textarea Width Dynamic Pos
setInterval(function() {
    var width = jQuery('.post-reply-list').width();

    jQuery(".comment-respond").css("width", width);

}, 100);

// Single Post Scrool Go Top
jQuery( ".scroll-container-first-button" ).on( "click", function() { jQuery(document).scrollTop(0); });


// Comment Editor Show/Hide Slide
jQuery( ".scroll-container-reply-button" ).click(function() {
    jQuery("#comment").focus();

    jQuery( ".comment-respond" ).slideToggle( "slow", function() {  });

});



// Comment Editor Add Close Button
jQuery(".comment-respond").append('<div class="editor-close-button"></div>');


