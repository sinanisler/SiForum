<?php


load_theme_textdomain( 'siforum', get_template_directory() . '/lang' );


// Add Menu
add_theme_support( 'menus' );
register_nav_menus(
	array(
		'header_menu' => 'Header Menu',
	)
);





// Add Widgets 
/*
register_sidebars( 1, array( 'name' => 'Sidebar_Single' ) );
register_sidebars( 1, array( 'name' => 'Sidebar_Index' ) );
*/



// Login - Register Logo Change
function siforum_logo_change() { ?>
	<style type="text/css">
		body{
			background:#14191f !important;
			font-size:20px !important;
		}
		.login form{
			border-radius:10px;
		}

		#login h1 a, .login h1 a {
			background: url(<?php echo get_stylesheet_directory_uri(); ?>/img/logo.png) center no-repeat red;
			height:105px;
			width:320px;
			padding-bottom: 30px ;
			border-radius:10px;
		}
	</style>
	<?php
}
add_action( 'login_enqueue_scripts', 'siforum_logo_change' );


// LOGIN  and REGISTER LOGO URL
/*
function custom_loginlogo_url($url) {
     return bloginfo('url');
}
add_filter( 'login_headerurl', 'custom_loginlogo_url' );


*/








// Allowing html tags like the_content output
function filter_html_usage() {
	global $allowedtags;
	$allowedtags['code']       = array( 'class' => array() );
	$allowedtags['pre']        = array( 'class' => array() );
	$allowedtags['p']          = array( 'class' => array() );
	$allowedtags['strong']     = array( 'class' => array() );
	$allowedtags['href']       = array( 'class' => array() );
	$allowedtags['a']          = array( 'class' => array() );
	$allowedtags['ul']         = array( 'class' => array() );
	$allowedtags['li']         = array( 'class' => array() );
	$allowedtags['i']          = array( 'class' => array() );
	$allowedtags['h1']         = array( 'class' => array() );
	$allowedtags['h2']         = array( 'class' => array() );
	$allowedtags['h3']         = array( 'class' => array() );
	$allowedtags['b']          = array( 'class' => array() );
	$allowedtags['abbr']       = array( 'class' => array() );
	$allowedtags['acronym']    = array( 'class' => array() );
	$allowedtags['blockquote'] = array( 'class' => array() );
	$allowedtags['cite']       = array( 'class' => array() );
	$allowedtags['em']         = array( 'class' => array() );
}
add_action( 'init', 'filter_html_usage', 11 );
















// CATEGORY ICONS and COLORS

function wcr_category_fields( $term ) {

	if ( current_filter() == 'category_edit_form_fields' ) {
		$icon_slug  = get_term_meta( $term->term_id, 'icon_slug', true );
		$color_code = get_term_meta( $term->term_id, 'color_code', true );
		?>
		<tr class="form-field">
			<th valign="top" scope="row"><label for="term_fields[icon_slug]"><?php _e( 'Dash Icon Slug-Name' ); ?></label></th>
			<td>
				<input type="text" size="40" value="<?php echo esc_attr( $icon_slug ); ?>" id="term_fields[icon_slug]" name="term_fields[icon_slug]"><br/>
				<span class="description"><?php _e( 'Dash Icon Slug-Name' ); ?> - https://developer.wordpress.org/resource/dashicons/</span>
			</td>
		</tr>
		<tr class="form-field">
			<th valign="top" scope="row"><label for="term_fields[color_code]"><?php _e( 'Color code' ); ?></label></th>
			<td>
				<input type="text" size="40" value="<?php echo esc_attr( $color_code ); ?>" id="term_fields[color_code]" name="term_fields[color_code]"><br/>
				<span class="description"><?php _e( 'Please enter color hex code' ); ?> - https://www.w3.org/wiki/CSS/Properties/color/keywords</span>
			</td>
		</tr>
		<?php
	} elseif ( current_filter() == 'category_add_form_fields' ) {
		?>
		<div class="form-field">
			<label for="term_fields[icon_slug]"><?php _e( 'Dash-Icon-Name-Slug' ); ?></label>
			<textarea cols="40" rows="1" id="term_fields[icon_slug]" name="term_fields[icon_slug]"></textarea>
			<p class="description">enter dashicon name - https://developer.wordpress.org/resource/dashicons/</p>
		</div>
		<div class="form-field">
			<label for="term_fields[color_code]"><?php _e( 'Color code' ); ?></label>
			<input type="text" size="40" value="" id="term_fields[color_code]" name="term_fields[color_code]">
			<p class="description">enter color code/name - https://www.w3.org/wiki/CSS/Properties/color/keywords</p>
		</div>
		<?php
	}

}

add_action( 'category_add_form_fields', 'wcr_category_fields', 10, 2 );
add_action( 'category_edit_form_fields', 'wcr_category_fields', 10, 2 );


function wcr_save_category_fields( $term_id ) {
	if ( ! isset( $_POST['term_fields'] ) ) {
		return;
	}

	foreach ( $_POST['term_fields'] as $key => $value ) {
		update_term_meta( $term_id, $key, sanitize_text_field( $value ) );
	}
}

add_action( 'edited_category', 'wcr_save_category_fields', 10, 2 );
add_action( 'create_category', 'wcr_save_category_fields', 10, 2 );













// SiForum Comments Custom Callback
function atarikafa_comments( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">

		<div class="comment-wrap">
			<div class="comment-img">
				<a href="<?php echo get_comment_author_url(); ?>">
				<?php echo get_avatar( $comment, $args['avatar_size'], null, null, array( 'class' => array( 'img-responsive', 'img-circle' ) ) ); ?>
				</a>
			</div>
			<div class="comment-body">
				<span class="comment-author-name"><?php echo get_comment_author_link(); ?></span>
				<span class="comment-date"><?php printf( __( '%1$s at %2$s', 'siforum' ), get_comment_date(), get_comment_time() ); ?></span>
				<?php
				if ( $comment->comment_approved == '0' ) {
					?>
					<em><i class="fa fa-spinner fa-spin" aria-hidden="true"></i> <?php _e( 'Comment awaiting approval', 'siforum' ); ?></em><br /><?php } ?>
				<?php comment_text(); ?>
				<span class="comment-reply">
				<?php
				comment_reply_link(
					array_merge(
						$args,
						array(
							'reply_text' => __( 'Reply', 'siforum' ),
							'depth'      => $depth,
							'max_depth'  => $args['max_depth'],
						)
					),
					$comment->comment_ID
				);
				?>
				</span>
			</div>
		</div>
	<?php
}





// Security - Removing some Actions for normal users
add_action( 'bulk_actions-edit-comments', 'author_remove_comments_actions' );
add_action( 'comment_row_actions', 'author_remove_comments_actions' );

function author_remove_comments_actions( $actions ) {

	if ( ! current_user_can( 'moderate_comments' ) ) {
		if ( isset( $actions['delete'] ) ) {
			unset( $actions['delete'] );
		}
		if ( isset( $actions['trash'] ) ) {
			unset( $actions['trash'] );
		}
		if ( isset( $actions['spam'] ) ) {
			unset( $actions['spam'] );
		}
		if ( isset( $actions['edit'] ) ) {
			unset( $actions['edit'] );
		}
		if ( isset( $actions['quickedit'] ) ) {
			unset( $actions['quickedit'] );
		}
		if ( isset( $actions['approve'] ) ) {
			unset( $actions['approve'] );
		}
		if ( isset( $actions['unapprove'] ) ) {
			unset( $actions['unapprove'] );
		}
	}

	return $actions;
}


// Security - Hiding comment IPs for normal users
function lp_remove_IP_for_user( $comment_author_IP, $comment_ID, $comment ) {

	if ( ! is_admin() ) {
		return $comment_author_IP; // only do this on admin, though with this particular function, it probably only applies to admin at all
	}
	if ( ! current_user_can( 'manage_options' ) ) {
		return '';
	}

	return $comment_author_IP;

}
add_filter( 'get_comment_author_IP', 'lp_remove_IP_for_user', 10, 3 );












// Security - Hiding others posts for user to see
function only_show_own_author_posts( $wp_query ) {
	if ( strpos( $_SERVER['REQUEST_URI'], '/wp-admin/edit.php' ) !== false ) {
		if ( ! current_user_can( 'activate_plugins' ) ) {
			add_action( 'views_edit-post', 'remove_items_from_edit' );
			global $current_user;
			$wp_query->set( 'author', $current_user->id );
		}
	}
}

add_filter( 'parse_query', 'only_show_own_author_posts' );

function remove_items_from_edit( $views ) {
	unset( $views['all'] );
	unset( $views['publish'] );
	unset( $views['trash'] );
	unset( $views['draft'] );
	unset( $views['pending'] );
	return $views;
}









// Load More Posts
function misha_my_load_more_scripts() {

	global $wp_query;

	wp_enqueue_script( 'jquery' );

	wp_register_script( 'my_loadmore', get_stylesheet_directory_uri() . '/assets/js/siforum.js', array( 'jquery' ) , 15 , true );

	wp_localize_script(
		'my_loadmore',
		'misha_loadmore_params',
		array(
			'ajaxurl'      => site_url() . '/wp-admin/admin-ajax.php', // WordPress AJAX
			'posts'        => json_encode( $wp_query->query_vars ), // everything about your loop is here
			'current_page' => get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1,
			'max_page'     => $wp_query->max_num_pages,
		)
	);

	wp_enqueue_script( 'my_loadmore' );
}

add_action( 'wp_enqueue_scripts', 'misha_my_load_more_scripts' );




function misha_loadmore_ajax_handler() {

	// prepare our arguments for the query
	$args                = json_decode( stripslashes( $_POST['query'] ), true );
	$args['paged']       = $_POST['page'] + 1; // we need next page to be loaded
	$args['post_status'] = 'publish';

	// it is always better to use WP_Query but not here
	query_posts( $args );

	if ( have_posts() ) :

		// run the loop
		while ( have_posts() ) :
			the_post();
			?>

		<a href="<?php the_permalink(); ?>" class="forum-post-index">
			<span class="forum-post-index-comment-count">
				<span class="dashicons dashicons-welcome-comments"></span><?php echo get_comments_number( $post->ID ); ?>
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
			<div class="forum-post-index-avatar"><?php echo get_avatar( get_the_author_meta( 'ID' ), 50 ); ?></div>
			<div href="<?php the_permalink(); ?>" class="forum-post-index-title"><?php the_title(); ?> </div>
			<span class="forum-post-index-author"><b><?php the_author(); ?></b>
			<?php
			$t = get_the_time( 'U' );
			echo human_time_diff( $t, current_time( 'U' ) ) . __( ' ago','siforum' );
			?>

			</span>
		</a>


			<?php
		endwhile;

	endif;
	die;
}




// Some Ajax for Image Upload, Reply and New Post

add_action( 'wp_ajax_loadmore', 'misha_loadmore_ajax_handler' ); // wp_ajax_{action}
add_action( 'wp_ajax_nopriv_loadmore', 'misha_loadmore_ajax_handler' ); // wp_ajax_nopriv_{action}

/** Ajax Image Upload  */

	add_action( 'wp_ajax_sicomment_file_upload', 'si_comment_file_upload' );

function si_comment_file_upload() {
	check_ajax_referer( 'file_upload', 'security' );
	$arr_img_ext = array( 'image/png', 'image/jpeg', 'image/jpg', 'image/gif' );
	if ( $_FILES ) {
		require_once( ABSPATH . 'wp-admin/includes/file.php' );
		require_once( ABSPATH . 'wp-admin/includes/image.php' );
		require_once( ABSPATH . 'wp-admin/includes/media.php' );
	}

	if ( in_array( $_FILES['file']['type'], $arr_img_ext, true ) ) {
		$upload = media_handle_upload( 'file', 0 );
		if ( $upload && ! is_wp_error( $upload ) ) {
			wp_send_json_success( si_get_image_for_return( $upload ), 200 );
		} else {
			wp_send_json_error( 'Error', 403, );
		}
	}
	wp_die();
}

function si_get_image_for_return( $id, $size = 'full' ) {
	return wp_json_encode( wp_get_attachment_image_src( $id, $size )[0] );
}

/** Ajax Image Upload  */

/** Ajax New Post */
	add_action( 'wp_ajax_create_new_from_from_index', 'create_new_from_from_index' );

	function create_new_from_from_index(){
		check_ajax_referer( 'new_post_sec', 'security' );

		$the_content_text = $_POST['text'];
		/*
		$tidy = new tidy();
		$clean_text = $tidy->repairString($the_content_text);
		*/
		$args = array(
		'post_title'    => wp_strip_all_tags( $_POST['title'] ),
		'post_content'  => $_POST['text'],
		'post_status'   => 'publish',
		'post_author'   => $_POST['author'],
		'post_category' => array( $_POST['cat'] )
		);

		$post_id = wp_insert_post($args);
			if(!is_wp_error($post_id)){
				wp_send_json_success( get_the_permalink( $post_id ), 200 );
			}else{
				wp_send_json_error( $post_id->get_error_message(), 403, );
			}


		wp_die();
	}


/** Ajax New Post */






?>
