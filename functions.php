<?php







// Add Menu
add_theme_support( 'menus' );
register_nav_menus( array(
	'header_menu' => 'Header Menu'
) );


// Add Widgets
register_sidebars(1, array('name'=>'Sidebar_Single'));
register_sidebars(1, array('name'=>'Sidebar_Index'));



// Settings
function siforum_customize_register($wp_customize){
     
    $wp_customize->add_section('themename_color_scheme', array(
        'title'    => __('Color Scheme', 'themename'),
        'description' => '',
        'priority' => 120,
    ));
  
    //  =============================
    //  = Text Input                =
    //  =============================
    $wp_customize->add_setting('siforum_theme_options[text_test]', array(
        'default'        => 'value_xyz',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
  
    ));
  
    $wp_customize->add_control('themename_text_test', array(
        'label'      => __('Text Test', 'themename'),
        'section'    => 'themename_color_scheme',
        'settings'   => 'siforum_theme_options[text_test]',
    ));
  
    //  =============================
    //  = Radio Input               =
    //  =============================
    $wp_customize->add_setting('siforum_theme_options[color_scheme]', array(
        'default'        => 'value2',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
    ));
  
    $wp_customize->add_control('themename_color_scheme', array(
        'label'      => __('Color Scheme', 'themename'),
        'section'    => 'themename_color_scheme',
        'settings'   => 'siforum_theme_options[color_scheme]',
        'type'       => 'radio',
        'choices'    => array(
            'value1' => 'Choice 1',
            'value2' => 'Choice 2',
            'value3' => 'Choice 3',
        ),
    ));
  
    //  =============================
    //  = Checkbox                  =
    //  =============================
    $wp_customize->add_setting('siforum_theme_options[checkbox_test]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
    ));
  
    $wp_customize->add_control('display_header_text', array(
        'settings' => 'siforum_theme_options[checkbox_test]',
        'label'    => __('Display Header Text'),
        'section'  => 'themename_color_scheme',
        'type'     => 'checkbox',
    ));
  
  
    //  =============================
    //  = Select Box                =
    //  =============================
     $wp_customize->add_setting('siforum_theme_options[header_select]', array(
        'default'        => 'value2',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
  
    ));
    $wp_customize->add_control( 'example_select_box', array(
        'settings' => 'siforum_theme_options[header_select]',
        'label'   => 'Select Something:',
        'section' => 'themename_color_scheme',
        'type'    => 'select',
        'choices'    => array(
            'value1' => 'Choice 1',
            'value2' => 'Choice 2',
            'value3' => 'Choice 3',
        ),
    ));
  
  
    //  =============================
    //  = Image Upload              =
    //  =============================
    $wp_customize->add_setting('siforum_theme_options[image_upload_test]', array(
        'default'           => 'image.jpg',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
  
    ));
  
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'image_upload_test', array(
        'label'    => __('Image Upload Test', 'themename'),
        'section'  => 'themename_color_scheme',
        'settings' => 'siforum_theme_options[image_upload_test]',
    )));
  
    //  =============================
    //  = File Upload               =
    //  =============================
    $wp_customize->add_setting('siforum_theme_options[upload_test]', array(
        'default'           => 'uploadtest',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
  
    ));
  
    $wp_customize->add_control( new WP_Customize_Upload_Control($wp_customize, 'upload_test', array(
        'label'    => __('Upload Test', 'themename'),
        'section'  => 'themename_color_scheme',
        'settings' => 'siforum_theme_options[upload_test]',
    )));
  
  
    //  =============================
    //  = Color Picker              =
    //  =============================
    $wp_customize->add_setting('siforum_theme_options[link_color]', array(
        'default'           => '#000',
        'sanitize_callback' => 'sanitize_hex_color',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
  
    ));
  
    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'link_color', array(
        'label'    => __('Link Color', 'themename'),
        'section'  => 'themename_color_scheme',
        'settings' => 'siforum_theme_options[link_color]',
    )));
  
  
    //  =============================
    //  = Page Dropdown             =
    //  =============================
    $wp_customize->add_setting('siforum_theme_options[page_test]', array(
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
  
    ));
  
    $wp_customize->add_control('themename_page_test', array(
        'label'      => __('Page Test', 'themename'),
        'section'    => 'themename_color_scheme',
        'type'    => 'dropdown-pages',
        'settings'   => 'siforum_theme_options[page_test]',
    ));
 
    // =====================
    //  = Category Dropdown =
    //  =====================
    $categories = get_categories();
    $cats = array();
    $i = 0;
    foreach($categories as $category){
        if($i==0){
            $default = $category->slug;
            $i++;
        }
        $cats[$category->slug] = $category->name;
    }
  
    $wp_customize->add_setting('_s_f_slide_cat', array(
        'default'        => $default
    ));
    $wp_customize->add_control( 'cat_select_box', array(
        'settings' => '_s_f_slide_cat',
        'label'   => 'Select Category:',
        'section'  => '_s_f_home_slider',
        'type'    => 'select',
        'choices' => $cats,
    ));
}
  
add_action('customize_register', 'siforum_customize_register');






// CATEGORY META ICONS

function wcr_category_fields($term) {
    // we check the name of the action because we need to have different output
    // if you have other taxonomy name, replace category with the name of your taxonomy. ex: book_add_form_fields, book_edit_form_fields
    if (current_filter() == 'category_edit_form_fields') {
        $icon_slug = get_term_meta($term->term_id, 'icon_slug', true);
        $color_code = get_term_meta($term->term_id, 'color_code', true);
        ?>
        <tr class="form-field">
            <th valign="top" scope="row"><label for="term_fields[icon_slug]"><?php _e('Dash Icon Slug-Name'); ?></label></th>
            <td>            
                <input type="text" size="40" value="<?php echo esc_attr($icon_slug); ?>" id="term_fields[icon_slug]" name="term_fields[icon_slug]"><br/>
                <span class="description"><?php _e('Dash Icon Slug-Name'); ?> - https://developer.wordpress.org/resource/dashicons/</span>
            </td>
        </tr>
        <tr class="form-field">
            <th valign="top" scope="row"><label for="term_fields[color_code]"><?php _e('Color code'); ?></label></th>
            <td>
                <input type="text" size="40" value="<?php echo esc_attr($color_code); ?>" id="term_fields[color_code]" name="term_fields[color_code]"><br/>
                <span class="description"><?php _e('Please enter color hex code'); ?> - https://www.w3.org/wiki/CSS/Properties/color/keywords</span>
            </td>
        </tr>   
    <?php } elseif (current_filter() == 'category_add_form_fields') {
        ?>
        <div class="form-field">
            <label for="term_fields[icon_slug]"><?php _e('Dash-Icon-Name-Slug'); ?></label>
            <textarea cols="40" rows="5" id="term_fields[icon_slug]" name="term_fields[icon_slug]"></textarea>
            <p class="description"><?php _e('Please enter short description'); ?></p>
        </div>
        <div class="form-field">
            <label for="term_fields[color_code]"><?php _e('Color code'); ?></label>
            <input type="text" size="40" value="" id="term_fields[color_code]" name="term_fields[color_code]">
            <p class="description"><?php _e('Please enter color hex code'); ?></p>
        </div>  
    <?php
    }
}

// Add the fields, using our callback function  
// if you have other taxonomy name, replace category with the name of your taxonomy. ex: book_add_form_fields, book_edit_form_fields
add_action('category_add_form_fields', 'wcr_category_fields', 10, 2);
add_action('category_edit_form_fields', 'wcr_category_fields', 10, 2);


function wcr_save_category_fields($term_id) {
    if (!isset($_POST['term_fields'])) {
        return;
    }

    foreach ($_POST['term_fields'] as $key => $value) {
        update_term_meta($term_id, $key, sanitize_text_field($value));
    }
}

// Save the fields values, using our callback function
// if you have other taxonomy name, replace category with the name of your taxonomy. ex: edited_book, create_book
add_action('edited_category', 'wcr_save_category_fields', 10, 2);
add_action('create_category', 'wcr_save_category_fields', 10, 2);













// Comment Custom Callback
            
function atarikafa_comments($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
	    
		<div class="comment-wrap">
			<div class="comment-img">
                <a href="<?php echo get_comment_author_url(); ?>">
				<?php echo get_avatar($comment,$args['avatar_size'],null,null,array('class' => array('img-responsive', 'img-circle') )); ?>
                </a>
			</div>
			<div class="comment-body">
				<span class="comment-author-name"><?php echo get_comment_author_link(); ?></span>
				<span class="comment-date"><?php printf(__('%1$s at %2$s', 'atarikafa'), get_comment_date(),  get_comment_time()) ?></span>
				<?php if ($comment->comment_approved == '0') { ?><em><i class="fa fa-spinner fa-spin" aria-hidden="true"></i> <?php _e('Comment awaiting approval', 'atarikafa'); ?></em><br /><?php } ?>
				<?php comment_text(); ?>
				<span class="comment-reply"> <?php comment_reply_link(array_merge( $args, array('reply_text' => __('Cevap', 'atarikafa'), 'depth' => $depth, 'max_depth' => $args['max_depth'])), $comment->comment_ID); ?></span>
			</div>
		</div>
<?php }

// Enqueue comment-reply























function only_show_own_author_posts( $wp_query ) {
    if ( strpos( $_SERVER[ 'REQUEST_URI' ], '/wp-admin/edit.php' ) !== false ) {
        if ( !current_user_can( 'activate_plugins' ) )  {
			add_action( 'views_edit-post', 'remove_items_from_edit' );
            global $current_user;
            $wp_query->set( 'author', $current_user->id );
        }
    }
}

add_filter('parse_query', 'only_show_own_author_posts' );

function remove_items_from_edit( $views ) {
    unset($views['all']);
    unset($views['publish']);
    unset($views['trash']);
    unset($views['draft']);
    unset($views['pending']);
    return $views;
}















?>