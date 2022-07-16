<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel=icon href="<?php bloginfo("stylesheet_directory"); ?>/assets/img/favicon.png" type="image/png">
    <title><?php if(is_front_page() || is_home()){  bloginfo('name');    } else{ echo wp_title('');    }?></title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php bloginfo("stylesheet_directory"); ?>/style.css?v=76">
    
<?php wp_head(); ?>
<?php if ( ! current_user_can( 'delete_others_posts' ) and !is_user_logged_in( ) ) { ?><style>#wpadminbar{display:none} html{margin-top: 0px !important;}</style><?php } ?>
</head>
<body <?php body_class(); ?>>


<header class="forum-header-menu">
    <div class="container">
    <div class="row">
        <a href="https://www.atarikafa.com/<?php // bloginfo( 'url' ); ?>" class="forum-header-menu-logo"> </a>

        <span class="forum-header-menu-mobile-button dashicons dashicons-menu" style="display:none"></span>

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
            <ul class="dropdown-user">
                <li><a href="<?php bloginfo('url'); ?>/members/<?php echo get_the_author_meta( 'login', get_current_user_id() ); ?>">Profil</a></li>
                <li><a href="<?php echo wp_logout_url( home_url() ); ?>">Çıkış Yap</a></li>
            </ul>
        <?php } else{ ?> 
            <a href ="<?php bloginfo( 'url' ); ?>/wp-login.php?redirect_to=<?php bloginfo( 'url' ); ?>" >
                Giriş Yap
            </a> 
        <?php } ?>
    </div>
    
    </div>
    </div>
</header>
 
 
