

jQuery( ".forum-header-menu-mobile-button" ).click(function() {
    jQuery( ".new-post-form" ).toggle();
});





// Comment Textarea Width Dynamic Width
setInterval(function() {
	var width = jQuery('.col-md-10').width();

	jQuery(".comment-respond").css("width", width);

	jQuery(".comment-body").css("width", width-10);
	
	jQuery(".comment-body img").css("max-width", width-80);

	jQuery(".forum-post-content img").css("max-width", width-80);

	jQuery(".comment-body pre").css("max-width", width-80);

}, 100);

// Single Post Scrool Go Top
jQuery( ".scroll-container-first-button" ).on( "click", function() { jQuery(document).scrollTop(0); });

// Comment Editor Show/Hide Slide
jQuery( ".scroll-container-reply-button" ).click(function() {
	jQuery( ".comment-respond" ).slideToggle( "fast", function() {  });
});

jQuery( ".comment-reply-dashed" ).click(function() {
	jQuery( ".comment-respond" ).slideToggle( "fast", function() {  });
});

