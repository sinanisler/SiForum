<?php get_header(); ?>


<div class="container index-container">
	<div class="row">
		<div class="col-md-3 sidebar_index">

			<?php if ( is_user_logged_in() ) { ?>
				<div class="new-post-index-button"><?php _e('Start New Topic','siforum'); ?></div>

			<?php } ?>

			<?php include( 'sidecategories.php' ); ?>

			<?php // dynamic_sidebar('Sidebar_Index'); ?>

		</div>
		<div class="col-md-9">

		<?php
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
				?>

		<a href="<?php the_permalink(); ?>" class="forum-post-index">
			<span class="forum-post-index-comment-count">
				<span class="dashicons dashicons-welcome-comments"></span><?php echo get_comments_number( $post->ID ) + 1; ?>
			</span>
			<span class="forum-post-index-category">
				<?php
				$categories = get_the_terms( $post->ID, 'category' );
				$i          = 1;
				foreach ( $categories as $c ) {
					$termid     = $c->term_id;
					$color_code = get_term_meta( $termid, 'color_code', true );
					echo '<span style="background:' . $color_code . '">' . $c->name . '</span>';
					if ( ++$i > 3 ) {
						break;
					}
				}
				?>
			</span>
			<div class="forum-post-index-avatar">
				<?php echo get_avatar( get_the_author_meta( 'ID' ), 60 ); ?>

				<?php
				$get_post = get_post( get_the_ID() );
				$status   = $get_post->comment_status; if ( 'closed' === $status ) {
					?>
					<span class="dashicons dashicons-lock locked-post" title="<?php _e('Locked Topic','siforum'); ?>"></span>
					<?php } ?>

							<?php if ( is_sticky() ) { ?>
					<span class="dashicons dashicons-sticky sticky-and-<?php echo $status; ?>" title="<?php _e('Pinned Topic','siforum'); ?>"></span>
				<?php } ?>

			</div>
			<div href="<?php the_permalink(); ?>" class="forum-post-index-title"><?php the_title(); ?> </div>
			<span class="forum-post-index-author"><b><?php the_author(); ?></b>
							<?php
							$t = get_the_time( 'U' );
                            //phpcs:disable
							echo human_time_diff( $t, current_time( 'U' ) ) . __(' ago','siforum');
                            //phpcs:enable
							?>
			</span>
		</a>
					<?php
		endwhile; else :
			?>
						<p><?php _e( 'No topics here.','siforum' ); ?></p><?php endif; ?>




		<?php
		global $wp_query;

		if ( $wp_query->max_num_pages > 1 ) {
			echo '<div class="load_more_posts">'.__('Load More','siforum').'</div>';
		}
		?>
		</div>
	</div>
</div>




<?php if ( is_user_logged_in() ) { ?>
<div class="container index-container">
<div class="row">
	<div class="siforum-comment-form">
	<div id="respond" class="new-post-form comment-respond" style="">
		<form action="new_post" method="post" id="newpostform" class="newpostform">
			<input type="text" id="title" name="title" val=""  required placeholder="<?php _e( 'Title...','siforum' ); ?>" class="new-post-form-title">

			<?php wp_dropdown_categories( 'selected=1' ); ?>

			<textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525"
			required="required" spellcheck="true" placeholder="<?php _e( 'Start Writing...','siforum' ); ?>"></textarea>

			<p class="form-submit">
				<input name="author" type="hidden" id="author" value="<?php echo get_current_user_id(); ?>">
				<input name="submit" type="submit" id="submit" class="submit" value="<?php _e( 'Publish New Topic','siforum' ); ?>">
			</p>
		</form>
	</div>
	</div>
</div>
</div>
<?php } ?>


<script>
<?php if ( is_user_logged_in() ) { ?>
// Comment Textarea Width Dynamic Width
setInterval(function() {
	var width = jQuery('.row').width();

	jQuery(".comment-respond").css("width", width);
	jQuery(".comment-body").css("width", width-10);
	jQuery(".new-post-form-title").css("width", (width/2) - 50);



}, 100);


// New Post Button Editor Show/Hide Form

var file_sec = "<?php echo wp_create_nonce( 'file_upload' ); ?>";
var new_post_sec = "<?php echo wp_create_nonce( 'new_post_sec' ); ?>";
var file_ajax_url = "<?php echo admin_url( 'admin-ajax.php' ); ?>";

jQuery( ".new-post-index-button" ).click(function() {
	jQuery( ".new-post-form" ).slideToggle( "fast", function() {  });
});


// Post Editor Buttons
jQuery(".new-post-form").append('<span  title="Kapat" class="editor-close dashicons dashicons-no"></span>');
jQuery(document).on('click',".editor-close", function(){
	jQuery( ".new-post-form" ).slideToggle( "fast", function() {  });
});
jQuery(".new-post-form").append('<span title="Kalın" class="editor-bold dashicons     dashicons-editor-bold"></span>');
jQuery(".new-post-form").append('<span title="Yatay" class="editor-italic dashicons   dashicons-editor-italic"></span>');
jQuery(".new-post-form").append('<span title="Başlık" class="editor-h2 dashicons      dashicons-heading"></span>');
jQuery(".new-post-form").append('<span title="Kod" class="editor-code dashicons       dashicons-editor-code"></span>');
jQuery(".new-post-form").append('<span title="Link" class="editor-link dashicons      dashicons-admin-links"></span>');
jQuery(".new-post-form").append('<span title="Foto Yükle" class="upload-image dashicons     dashicons-images-alt2"></span>');
jQuery(".new-post-form").append('<span title="Foto" class="editor-image dashicons     dashicons-format-image"></span>');
jQuery(".new-post-form").append('<span title="List" class="editor-list dashicons      dashicons-editor-ul"></span>');
jQuery(".new-post-form").append('<span title="Mention" class="editor-mention          dashicons  ">@</span>');
jQuery(".new-post-form").append('<input type="file" id="image_upload" onChange="upload_image_and_return(this)" style="display:none" >');

jQuery(document).on('click',".editor-bold", function(){ jQuery('#comment').val(function(i, text) {  return text + '<b> Bold </b>';   }); });
jQuery(document).on('click',".editor-italic", function(){ jQuery('#comment').val(function(i, text) {  return text + '<i> Italic </i>';   }); });
jQuery(document).on('click',".editor-h2", function(){ jQuery('#comment').val(function(i, text) {  return text + '<h2> Title </h2>';   }); });
jQuery(document).on('click',".editor-code", function(){ jQuery('#comment').val(function(i, text) {  return text + '<pre><code>\n \n</code></pre>'; }); });
jQuery(document).on('click',".editor-link", function(){ jQuery('#comment').val(function(i, text) {  return text + '<a href="https://examplelink.com"> link Text </a>'; }); });
jQuery(document).on('click',".editor-image", function(){ jQuery('#comment').val(function(i, text) {  return text + '<img src="https://examplelink.com/photo.png">'; }); });
jQuery(document).on('click',".editor-list", function(){ jQuery('#comment').val(function(i, text) {  return text + '<ul>'+'\n <li> 1 </li>\n<li> 2 </li>\n<li> 3 </li> \n'+'</ul>';   }); });
jQuery(document).on('click',".editor-mention", function(){ jQuery('#comment').val(function(i, text) {  return text + '@username';   }); });
jQuery(document).on('click',".upload-image", function(){ jQuery('#image_upload').trigger("click"); });

async function upload_image_and_return(input){
	const formData = new FormData();
	formData.append("action", "sicomment_file_upload");
	formData.append("security", file_sec);
	formData.append("file", input.files[0]);
	const rawResponse = await fetch(file_ajax_url, {
		method: "POST",
		body: formData,
		});
	const respo = await rawResponse.json();
	if (respo.success) {
		let $comm = jQuery("#comment").val();
		jQuery("#comment").val($comm+"<img src='"+JSON.parse(respo.data)+"'>");
	} else {
		console.log("error");
	}
}

jQuery('#newpostform').submit(async function( event ){
	event.preventDefault();
	let form = document.querySelector('form#newpostform');
	let title = form.querySelector('input[name="title"]');
	let cat = form.querySelector('select[name="cat"]');
	let text = form.querySelector('textarea[name="comment"]');
	let author = form.querySelector('input[name="author"]');
	const fData = new FormData();
	fData.append("action","create_new_from_from_index");
	fData.append("security", new_post_sec);
	fData.append("title",title.value);
	fData.append("cat",cat.value);
	fData.append("text",text.value);
	fData.append("author",author.value);

	const rawResponse = await fetch(file_ajax_url, {
		method: "POST",
		body: fData,
		});
	const respo = await rawResponse.json();
	if (respo.success) {
		//jQuery("#comment").val("<img src='"+JSON.parse(respo.data)+"'>");
		window.location.href=respo.data;
	} else {
		console.log("error");
	}


})

<?php } ?>

  
  

// Pagination Load More
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
				button.text('<?php _e( 'Loading','siforum' ); ?>...');
			},
			success : function( data ){
				if( data ) {
					button.text( '<?php _e( 'Load More','siforum' ); ?>' ).prev().before(data);
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
