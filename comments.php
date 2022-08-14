            
<?php if ( post_password_required() ) { return; } ?>
<div id="comments" class="comments-area post-reply">
	<?php if ( have_comments() ) { ?>
		
		<ol class="comment-list post-reply-list">
			<?php wp_list_comments( array( 'avatar_size' => 70, 'style' => 'ul', 'callback' => 'atarikafa_comments', 'type' => 'all' ) ); ?>
		</ol>

		<?php the_comments_pagination( array( 'prev_text' => '<i class="fa fa-angle-left" aria-hidden="true"></i> <span class="screen-reader-text">' . __( 'Previous', 'atarikafa') . '</span>', 'next_text' => '<span class="screen-reader-text">' . __( 'Next', 'atarikafa') . '</span> <i class="fa fa-angle-right" aria-hidden="true"></i>', ) ); ?>

	<?php } ?>


	<?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) { ?>


		<div class="comment-reply-dashed-comment">
					
				<span class="dashicons dashicons-lock locked-post comments-locked-alert" title="<?php _e('Locked Topic','siforum'); ?>"></span> 
				<?php _e( 'Discussion is Locked...','siforum' ); ?>
			
		</div>


	<?php } ?>

	<div class="siforum-comment-form">

		<?php get_avatar( get_current_user_id(), '70' ) ?>

		<?php comment_form(); ?>
		
	</div>

</div>

