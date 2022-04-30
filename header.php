<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
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
        <a href="https://www.atarikafa.com" class="forum-header-menu-logo"> </a>
        <?php
        wp_nav_menu( array(
            'theme_location' => 'header_menu',
            'menu_class'     => 'header_menu',
            ) );
        ?>
    </div>
    </div>
</header>


<?php if(is_archive()) { ?>
<?php $termid = get_queried_object_id(); $color_code = get_term_meta($termid, 'color_code', true); ?>
<div class="category-header" style="background:<?php echo $color_code; ?>">
<div class="container">
    <span style="color:white" class="dashicons <?php echo get_term_meta($termid, 'icon_slug', true); ?>"></span>
    <span class="category-header-title"><?php if(is_category()){ single_cat_title(); } if(is_tag()){ single_tag_title(); }  ?></span>
    <p style=""><?php if(is_category() or is_tag()){ $catID = get_the_category(); echo category_description( $catID[0] );  } ?></p>
</div>
</div>
<?php } ?>


<?php if(is_single()) { ?>
<?php $cc = get_the_category(); $c_id = $cc[0]->cat_ID;    $color_code = get_term_meta($c_id, 'color_code', true);     ?>
<div class="category-header" style="background:<?php echo $color_code; ?>">
<div class="container">
    <span class="dashicons <?php echo get_term_meta($c_id, 'icon_slug', true); ?>"></span>
    <span class="category-header-title"><?php echo $cc[0]->cat_name; ?></span>
    <h1 style=""><?php if(is_category() or is_tag()){   echo category_description( $c_id );  } ?> <?php the_title(); ?></h1>
</div>
</div>
<?php } ?>

