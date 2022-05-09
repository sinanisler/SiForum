<?php get_header(); ?>

<?php $cc = get_the_category(); $c_id = $cc[0]->cat_ID;    $color_code = get_term_meta($c_id, 'color_code', true);     ?>
<div class="category-header" style="background:<?php echo $color_code; ?>">
<div class="container">
    <span class="dashicons <?php echo get_term_meta($c_id, 'icon_slug', true); ?>"></span>
    <span class="category-header-title"><?php echo $cc[0]->cat_name; ?></span>
    <h1 style=""><?php if(is_category() or is_tag()){   echo category_description( $c_id );  } ?> <?php the_title(); ?></h1>
</div>
</div>



<div class="container">
    <div class="row">
        <div class="col-md-10 forum-post-block">
                
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <article id="post" class="forum-post-single .ff1">
                    <div class="forum-post-author "> 
                        <?php // if(is_plugin_active('buddypress/bp-loader.php')){                           
                            if(in_array('buddypress/bp-loader.php', apply_filters('active_plugins', get_option('active_plugins')))){ 
                            ?> <a href ="<?php bloginfo('url'); ?>/members/<?php echo get_the_author_meta( 'login'); ?>" >
                        <?php echo get_avatar( get_the_author_meta( 'ID') , 70); ?>  </a>
                        <?php } else{ ?> <a href ="<?php bloginfo('url'); ?>/author/<?php echo get_the_author_meta( 'login'); ?>" >
                        <?php echo get_avatar( get_the_author_meta( 'ID') , 70); ?>  </a> <?php } ?>
                    </div>
                    <div class="forum-post-content">
                        <div class="forum-post-content-author">
                            <?php //if(is_plugin_active('buddypress/bp-loader.php')){ 
                                if(in_array('buddypress/bp-loader.php', apply_filters('active_plugins', get_option('active_plugins')))){ 
                                ?> <a href ="<?php bloginfo('url'); ?>/members/<?php echo get_the_author_meta( 'login'); ?>" >
                            <?php echo get_the_author_meta( 'login'); ?> </a>
                            <?php } else{ ?> <a href ="<?php bloginfo('url'); ?>/author/<?php echo get_the_author_meta( 'login'); ?>" >
                            <?php echo get_the_author_meta( 'login'); ?> </a> <?php } ?>
                            <span class="comment-date"><?php the_date( 'F n, Y - H:i' ); ?>  </span>
                        </div>

                        <?php the_content(); ?>
                    </div>
                </article>
            <?php endwhile; else : endif; ?>


                

            <?php comments_template('/comments.php'); ?>
            
            <div id="comment-bottom"></div>
        </div>


        <div class="col-md-2 single-sidebar">
            <div class="sidebar-scroll-container">
                
                <div class="scroll-container"> 
                    <?php if(is_user_logged_in(  )){ ?>
                    <div class="scroll-block1">
                        <?php 
                        $get_post = get_post( get_the_ID() ); 
                        $status = $get_post->comment_status;

                        if($status == 'open'){ ?>
                            <a href="#comment-bottom" class="scroll-container-reply-button">
                            <span class="dashicons dashicons-admin-comments"></span> Cevap Yaz</a>
                        <?php } else { ?>
                            <div class="scroll-container-reply-button cant-reply">
                            <span class="dashicons dashicons-lock"></span> Konu Kilitli
                            </div>
                        <?php } ?>
                    </div>
                    <?php } ?>




                    <div class="scroll-block2">
                    <a href="#" class="scroll-container-first-button"><span class="dashicons dashicons-arrow-up-alt2"></span> İlk Yazı</a>
                    </div>

                    <div class="scroll-block3">
                    <div class="scroll-container-position">1 / <?php echo get_comments_number( get_the_ID()) + 1;  ?></div>
                    </div>

                    <div class="scroll-block4">
                    <a href="#comment-bottom"  class="scroll-container-last-button"><span class="dashicons dashicons-arrow-down-alt2"></span> Son Cevap</a>
                    </div>
                </div>
            </div>
            

            <?php // dynamic_sidebar('Sidebar_Single'); ?>
        </div>

    </div>
</div>



<script>

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
    jQuery('.scroll-container-position').html(percent.toFixed(1) + " / " + postcount);

    // CSS Pos
    jQuery(".scroll-container-position").css("top", clear_percentage * 3);

});
 

 
// Comment Textarea Width Dynamic Pos
setInterval(function() {
    var width = jQuery('.post-reply-list').width();

    jQuery(".comment-respond").css("width", width);
    jQuery(".comment-body").css("width", width-10);

}, 100);




// Single Post Scrool Go Top
jQuery( ".scroll-container-first-button" ).on( "click", function() { jQuery(document).scrollTop(0); });


// Comment Editor Show/Hide Slide
jQuery( ".scroll-container-reply-button" ).click(function() {
    jQuery( ".comment-respond" ).slideToggle( "fast", function() {  });
});


// Comment Editor Buttons
jQuery(".comment-respond").append('<span  title="Kapat" class="editor-close dashicons dashicons-no"></span>');
jQuery(document).on('click',".editor-close", function(){
    jQuery( ".comment-respond" ).slideToggle( "fast", function() {  });
});

jQuery(".comment-respond").append('<span title="Kalın" class="editor-bold dashicons     dashicons-editor-bold"></span>');
jQuery(".comment-respond").append('<span title="Yatay" class="editor-italic dashicons   dashicons-editor-italic"></span>');
jQuery(".comment-respond").append('<span title="Başlık" class="editor-h2 dashicons      dashicons-heading"></span>');
jQuery(".comment-respond").append('<span title="Kod" class="editor-code dashicons       dashicons-editor-code"></span>');
jQuery(".comment-respond").append('<span title="Link" class="editor-link dashicons      dashicons-admin-links"></span>');
jQuery(".comment-respond").append('<span title="Foto" class="editor-image dashicons     dashicons-format-image"></span>');
jQuery(".comment-respond").append('<span title="List" class="editor-list dashicons      dashicons-editor-ul"></span>');
jQuery(".comment-respond").append('<span title="Mention" class="editor-mention          dashicons  ">@</span>');
jQuery(document).on('click',".editor-bold", function(){ jQuery('#comment').val(function(i, text) {  return text + '<b> Kalın </b>';   }); });
jQuery(document).on('click',".editor-italic", function(){ jQuery('#comment').val(function(i, text) {  return text + '<i> Yatay </i>';   }); });
jQuery(document).on('click',".editor-h2", function(){ jQuery('#comment').val(function(i, text) {  return text + '<h2> Başlık </h2>';   }); });
jQuery(document).on('click',".editor-code", function(){ jQuery('#comment').val(function(i, text) {  return text + '<pre><code>\n \n</code></pre>'; }); });
jQuery(document).on('click',".editor-link", function(){ jQuery('#comment').val(function(i, text) {  return text + '<a href="https://atarikafa.com"> LİNK TEXT </a>'; }); });
jQuery(document).on('click',".editor-image", function(){ jQuery('#comment').val(function(i, text) {  return text + '<img src="https://atarikafa.com/foto.png">'; }); });
jQuery(document).on('click',".editor-list", function(){ jQuery('#comment').val(function(i, text) {  return text + '<ul>'+'\n <li> bir </li>\n<li> iki </li>\n<li> üç </li> \n'+'</ul>';   }); });
jQuery(document).on('click',".editor-mention", function(){ jQuery('#comment').val(function(i, text) {  return text + '@username';   }); });


// Text Selection, Quote Reply and Share Button
document.onselectionchange = function() {

var ele = document.getElementById('quote-reply-share');
var sel = window.getSelection();

var rel1= document.createRange();
rel1.selectNode(document.getElementById('cal1'));

var rel2= document.createRange();
rel2.selectNode(document.getElementById('cal2'));

window.addEventListener('mouseup', function () {
    if (!sel.isCollapsed && window.getSelection().rangeCount >0) {

            var r = sel.getRangeAt(0).getBoundingClientRect();
            var rb1 = rel1.getBoundingClientRect();
            var rb2 = rel2.getBoundingClientRect();
            ele.style.top = (r.bottom - rb2.top)*100/(rb1.top-rb2.top) + 'px'; 
            ele.style.left = (r.left - rb2.left)*100/(rb1.left-rb2.left) + 'px'; 

            ele.style.display = 'block';
        } else{
            ele.style.display = 'none';
        }
    });

};

selection_range = sel.toString ()

jQuery(document).on('click',"#share-reply", function(){ jQuery('#comment').val(function(i, text) { return text + selection_range  }); });

</script> 




<div id="cal1">&nbsp;</div>
<div id="cal2">&nbsp;</div>
<div id="quote-reply-share"> 
    <span title="Cevap Yaz"         id="share-reply" class=" dashicons dashicons-admin-comments">  </span>
    <span title="Twitter Paylaş"    id="share-twitter"  class=" dashicons dashicons-twitter">  </span>
    <span title="Facebook Paylaş"   id="share-facebook"  class=" dashicons dashicons-facebook">  </span>
    <span title="Linkedin Paylaş"   id="share-linkedin"  class=" dashicons dashicons-linkedin">  </span>
</div>


<?php get_footer(); ?>
