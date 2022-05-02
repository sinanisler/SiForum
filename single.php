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






<?php get_footer(); ?>