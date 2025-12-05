<?php
/**
 * File: header.php
 * Purpose: Theme header template - HTML head, navigation bar
 * Exposes: Opening HTML structure, navbar with Bootstrap 5
 * Notes: SEO optimized with proper meta tags, uses WordPress menu system
 */

if (!defined('ABSPATH')) {
    exit;
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <!-- Permissions Policy - Fix for unload warning -->
    <meta http-equiv="Permissions-Policy" content="unload=*">
    
    <!-- Theme Color for Mobile Browsers -->
    <meta name="theme-color" content="#e95420">
    <meta name="msapplication-navbutton-color" content="#e95420">
    <meta name="apple-mobile-web-app-status-bar-style" content="#e95420">
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Skip to Content Link (Accessibility) -->
<a class="visually-hidden-focusable" href="#main-content">Skip to main content</a>

<!-- Header Navigation -->
<header class="hrgms-header" role="banner">
    <nav class="navbar navbar-expand-lg hrgms-navbar" role="navigation" aria-label="<?php esc_attr_e('Primary Navigation', 'hrgms-theme'); ?>">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand hrgms-logo" href="<?php echo esc_url(home_url('/')); ?>" rel="home" title="<?php echo esc_attr(get_bloginfo('name')); ?>">
                <?php
                if (has_custom_logo()) {
                    // Output custom logo with proper alt text
                    $custom_logo_id = get_theme_mod('custom_logo');
                    $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
                    if ($logo) {
                        echo '<img src="' . esc_url($logo[0]) . '" alt="' . esc_attr(get_bloginfo('name')) . '" class="custom-logo" height="40">';
                    }
                } else {
                    echo esc_html(get_bloginfo('name', 'display'));
                }
                ?>
            </a>
            
            <!-- Mobile Toggle Button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#hrgmsNavbar" aria-controls="hrgmsNavbar" aria-expanded="false" aria-label="<?php esc_attr_e('Toggle navigation', 'hrgms-theme'); ?>">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <!-- Navigation Menu - Uses WordPress Menu System (Header Menu) -->
            <div class="collapse navbar-collapse" id="hrgmsNavbar">
                <?php
                // Use WordPress menu if assigned, fallback to pages
                if (has_nav_menu('header-menu')) {
                    wp_nav_menu(array(
                        'theme_location' => 'header-menu',
                        'container'      => false,
                        'menu_class'     => 'navbar-nav ms-auto',
                        'walker'         => new HRGMS_Bootstrap_Nav_Walker(),
                        'fallback_cb'    => 'hrgms_fallback_menu',
                        'depth'          => 2,
                    ));
                } else {
                    // Fallback: List pages as menu
                    ?>
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link hrgms-nav-link <?php echo is_front_page() ? 'active' : ''; ?>" href="<?php echo esc_url(home_url('/')); ?>">
                                Home
                            </a>
                        </li>
                        <?php
                        // List published pages
                        $pages = get_pages(array(
                            'sort_column' => 'menu_order',
                            'sort_order'  => 'ASC',
                            'number'      => 6,
                        ));
                        foreach ($pages as $page) :
                            // Skip if this is front page
                            if ($page->ID == get_option('page_on_front')) continue;
                        ?>
                            <li class="nav-item">
                                <a class="nav-link hrgms-nav-link <?php echo is_page($page->ID) ? 'active' : ''; ?>" href="<?php echo get_permalink($page->ID); ?>">
                                    <?php echo esc_html($page->post_title); ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <?php
                }
                ?>
            </div>
        </div>
    </nav>
</header>

<!-- Main Content Area -->
<main id="main-content" role="main">
