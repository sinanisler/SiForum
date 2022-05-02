<?php get_header(); ?>



<div class="container">
    <div class="row">
        <div class="col-md-10 forum-post-block">
                
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <article id="post" class="forum-post-single .ff1">
                    <div class="forum-post-author "> 
                        <?php if(function_exists(bp_is_active)){ ?> <a href ="<?php bloginfo(url); ?>/members/<?php echo get_the_author_meta( 'login'); ?>" >
                        <?php echo get_avatar( get_the_author_meta( 'ID') , 70); ?>  </a>
                        <?php } else{ ?> <a href ="<?php bloginfo(url); ?>/author/<?php echo get_the_author_meta( 'login'); ?>" >
                        <?php echo get_avatar( get_the_author_meta( 'ID') , 70); ?>  </a> <?php } ?>
                    </div>
                    <div class="forum-post-content">
                        <div class="forum-post-content-author">
                            <?php if(function_exists(bp_is_active)){ ?> <a href ="<?php bloginfo(url); ?>/members/<?php echo get_the_author_meta( 'login'); ?>" >
                            <?php echo get_the_author_meta( 'login'); ?> </a>
                            <?php } else{ ?> <a href ="<?php bloginfo(url); ?>/author/<?php echo get_the_author_meta( 'login'); ?>" >
                            <?php echo get_the_author_meta( 'login'); ?> </a> <?php } ?>
                            <span class="comment-date"><?php the_date( 'F n, Y - H:i' ); ?>  </span>
                        </div>

                        <?php the_content(); ?>
                    </div>
                </article>
            <?php endwhile; else : endif; ?>


            <div class="forum-post-replies">
            <?php comments_template('/comments.php'); ?>
            </div>
                                

        </div>


        <div class="col-md-2 single-sidebar">
            <div class="sidebar-scroll-container">
                
                <div class="scroll-container">
                    <div class="scroll-block1">
                    <a href="#respond" class="scroll-container-reply-button"><span class="dashicons dashicons-admin-comments"></span> Cevap Yaz</a>
                    </div>

                    <div class="scroll-block2">
                    <a href="#" class="scroll-container-first-button"><span class="dashicons dashicons-arrow-up-alt2"></span> İlk Yazı</a>
                    </div>

                    <div class="scroll-block3">
                    <div class="scroll-container-position">1 / <?php echo get_comments_number( get_the_ID()) + 1;  ?></div>
                    </div>

                    <div class="scroll-block4">
                    <a href="#respond"  class="scroll-container-last-button"><span class="dashicons dashicons-arrow-down-alt2"></span> Son Cevap</a>
                    </div>
                </div>
            </div>

            <?php dynamic_sidebar('Sidebar_Single'); ?>
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
    jQuery('.scroll-container-position').html(divide_p_with_p.toFixed(1) + " / " + postcount);

    
    // CSS Pos
    jQuery(".scroll-container-position").css("top", clear_percentage * 3);

});
 





jQuery( ".scroll-container-reply-button" ).on( "click", function() {    jQuery(document).scrollBottom(0);   });
jQuery( ".scroll-container-first-button" ).on( "click", function() {    jQuery(document).scrollTop(0);      });
jQuery( ".scroll-container-last-button" ).on( "click", function()  {    jQuery(document).scrollBottom(0);   });




</script> 












<?php get_footer(); ?>