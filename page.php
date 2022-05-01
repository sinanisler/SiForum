<?php get_header(); ?>



<div class="container">
    <div class="row">
        <section class="col-md-10 animate__animated animate__fadeIn">
                
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <article>
                    <div class="forum-post ">
                        <h1><?php the_title(); ?></h1>
                    </div>
                    <div class="forum-post-content">
                        <?php the_content(); ?>

                    </div>
                </article>
            <?php endwhile; else : ?>
                <p><?php esc_html_e( 'No posts here.' ); ?></p>
            <?php endif; ?>


                                

        </section>


 



    </div>
</div>


<?php get_footer(); ?>