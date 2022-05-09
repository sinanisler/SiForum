<?php get_header(); ?>




<div class="category-header" >
<div class="container" style="font-size:30px; margin-top:20px">
    <h1 class="category-header-title"><?php the_title(); ?></h1>
</div>
</div>




<div class="container">
    <div class="row">
        <section class="col-md-12 animate__animated animate__fadeIn">
                
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <article>
                    
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