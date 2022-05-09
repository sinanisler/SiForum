<?php get_header(); ?>


<div class="container index-container">
    <div class="row">
        <div class="col-md-3 sidebar_index">

            <?php include('sidecategories.php'); ?>

            <?php // dynamic_sidebar('Sidebar_Index'); ?>

        </div>
        <div class="col-md-9">
            
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




        <?php
        global $wp_query; 
        
        if (  $wp_query->max_num_pages > 1 )
            echo '<div class="load_more_posts">Daha Fazla Yükle</div>'; 
        ?>




        </div>
    </div>
</div>


 <script>
jQuery(function($){ 
	$('.load_more_posts').click(function(){
 
		var button = $(this),
		    data = {
			'action': 'loadmore',
			'query': misha_loadmore_params.posts, 
			'page' : misha_loadmore_params.current_page
		};
 
		$.ajax({ 
			url : misha_loadmore_params.ajaxurl,
			data : data,
			type : 'POST',
			beforeSend : function ( xhr ) {
				button.text('Yükleniyor...'); 
			},
			success : function( data ){
				if( data ) { 
					button.text( 'Daha Fazla Yükle' ).prev().before(data); 
					misha_loadmore_params.current_page++;
 
					if ( misha_loadmore_params.current_page == misha_loadmore_params.max_page ) 
						button.remove(); 
				} else {
					button.remove(); 
				}
			}
		});
	});
});
 </script>



<?php get_footer(); ?>