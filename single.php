<?php get_header(); ?>



<div class="container">
    <div class="row">
        <div class="col-md-11 forum-post-block">
                
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <article class="forum-post-single .ff1">
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
                        </div>

                        <?php the_content(); ?>
                    </div>
                </article>
            <?php endwhile; else : endif; ?>


            

            <div class="forum-post-replies">
            <?php comments_template('/comments.php'); ?>
            </div>
                                

        </div>




        <div class="col-md-1 single-sidebar">

            <div class="scroll-position">

            </div>

            <?php dynamic_sidebar('Sidebar_Single'); ?>
        </div>


    </div>
</div>


<?php get_footer(); ?>