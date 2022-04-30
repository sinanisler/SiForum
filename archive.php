<?php get_header(); ?>


<div class="container">
    <div class="row">
        <aside class="col-md-3 sidebar_index">
            <ul class="cat-list">
                <?php $taxonomies = get_terms( array( 'taxonomy' => 'category', 'hide_empty' => false, 'exlude' => array(19,19) ) ); 
                foreach( $taxonomies as $c ) { ?>
                
                <li>
                    <a href="<?php echo get_term_link( $c ); ?>">
                    <span style="color:<?php echo get_term_meta($c->term_id, 'color_code', true); ?>" class="dashicons <?php echo get_term_meta($c->term_id, 'icon_slug', true); ?>"></span><?php echo $c->name; ?> 
                    <p style="display:none"><?php echo $c->description; ?></p>
                    </a>
                </li>
                <?php } ?> 
            </ul>

            <?php dynamic_sidebar('Sidebar_Index'); ?>


        </aside>
        <div class="col-md-9 animate__animated animate__fadeIn">
            
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

        <a href="<?php the_permalink(); ?>" class="forum-post-index">
            <span class="forum-post-index-comment-count">
                <span class="dashicons dashicons-welcome-comments"></span><?php echo get_comments_number($post->ID); ?>
            </span>
            <span class="forum-post-index-category">
                <?php 
                $categories = get_the_terms( $post->ID, 'category' ); $i=1;
                foreach( $categories as $c ) {
                    $termid = $c->term_id;
                    $color_code = get_term_meta($termid, 'color_code', true);
                    echo '<span style="background:'.$color_code.'">' . $c->name.'</span>'; if(++$i > 3) break;
                } ?>
            </span>
            <div class="forum-post-index-avatar"><?php echo get_avatar( get_the_author_meta( 'ID' ), 50 ); ?></div>
            <div href="<?php the_permalink(); ?>" class="forum-post-index-title"><?php the_title(); ?> </div> 
            <span class="forum-post-index-author"><b><?php the_author(); ?></b>
            <?php $t = get_the_time('U'); echo human_time_diff($t,current_time( 'U' )). " önce"; ?> 
            </span> 
        </a>
        <?php endwhile; else : ?><p><?php esc_html_e( 'No posts here.' ); ?></p><?php endif; ?>

        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-9">
            <div class="nav-previous alignleft"><?php next_posts_link( 'Daha Fazla' ); ?></div>
            <div class="nav-next alignright"><?php previous_posts_link( 'Geri Dön' ); ?></div>
        </div>
    </div>
 </div>


<?php get_footer(); ?>