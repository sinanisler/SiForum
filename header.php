<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel=icon href="<?php bloginfo("stylesheet_directory"); ?>/img/favicon.png" type="image/png">
    <title><?php if(is_front_page() || is_home()){ echo get_bloginfo('name');    } else{ echo wp_title('');    }?></title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php bloginfo("stylesheet_directory"); ?>/style.css?v=0.1<?php echo rand(); ?>">
    <?php wp_head(); ?>

    <?php /* if (is_single()){ ?>
    <script src="https://cdn.ckeditor.com/ckeditor5/11.0.1/classic/ckeditor.js"></script>
    <?php  } */ ?>
</head>
<body <?php body_class(); ?>>


<header class="forum-header-menu">
    <div class="container">
    <div class="row">
        <a href="<?php bloginfo( 'url' ); ?>" class="forum-header-menu-logo"> </a>
        <?php
        wp_nav_menu( array(
            'theme_location' => 'header_menu',
            'menu_class'     => 'header_menu',
            ) );
        ?>

    <div class="forum-header-profile">
        <?php  if( is_user_logged_in() ){  ?> 
            <a href ="<?php bloginfo('url'); ?>/members/<?php echo get_the_author_meta( 'login', get_current_user_id() ); ?>" >
                <?php echo get_avatar( get_current_user_id() , 30); ?>
                <?php echo get_the_author_meta( 'login', get_current_user_id() ); ?>
            </a>
        <?php } else{ ?> 
            <a href ="<?php bloginfo( 'url' ); ?>/wp-login.php?redirect_to=<?php bloginfo( 'url' ); ?>" >
                Giriş Yap
            </a> 
        <?php } ?>
    </div>
    
    </div>
    </div>
</header>
 
 
