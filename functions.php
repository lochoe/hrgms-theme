<?php
/**
 * File: functions.php
 * Purpose: Theme setup, enqueue scripts/styles, register menus & widgets
 * Exposes: Theme support features, Bootstrap 5 CDN, custom navigation
 * Notes: Yoast SEO compatible - no duplicate meta tags or schema
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * hrgms_theme_setup
 * What: Setup theme features and support
 */
function hrgms_theme_setup() {
    // Add theme support
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo', array(
        'height'      => 50,
        'width'       => 150,
        'flex-width'  => true,
        'flex-height' => true,
    ));
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
    add_theme_support('automatic-feed-links');
    
    // Register navigation menus
    register_nav_menus(array(
        'header-menu' => __('Header Menu', 'hrgms-theme'),
        'footer-menu' => __('Footer Menu', 'hrgms-theme'),
    ));
    
    // Set default thumbnail size
    set_post_thumbnail_size(300, 200, true);
    
    // Add custom image sizes
    add_image_size('hrgms-card', 300, 200, true);
    add_image_size('hrgms-featured', 800, 400, true);
}
add_action('after_setup_theme', 'hrgms_theme_setup');

/**
 * hrgms_enqueue_scripts
 * What: Load all CSS and JS files including Bootstrap 5 CDN
 */
function hrgms_enqueue_scripts() {
    // Google Fonts - Poppins
    wp_enqueue_style(
        'google-fonts-poppins',
        'https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap',
        array(),
        null
    );
    
    // Bootstrap 5 CSS (CDN)
    wp_enqueue_style(
        'bootstrap-css',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css',
        array(),
        '5.3.2'
    );
    
    // Bootstrap Icons (CDN)
    wp_enqueue_style(
        'bootstrap-icons',
        'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css',
        array(),
        '1.11.1'
    );
    
    // Theme main stylesheet (with cache busting)
    wp_enqueue_style(
        'hrgms-style',
        get_stylesheet_uri(),
        array('bootstrap-css'),
        wp_get_theme()->get('Version') . '.' . filemtime(get_stylesheet_directory() . '/style.css')
    );
    
    // Bootstrap 5 JS Bundle (includes Popper) - CDN
    wp_enqueue_script(
        'bootstrap-js',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js',
        array(),
        '5.3.2',
        true
    );
    
    // Theme custom JS
    wp_enqueue_script(
        'hrgms-custom-js',
        get_template_directory_uri() . '/assets/js/custom.js',
        array('bootstrap-js'),
        wp_get_theme()->get('Version'),
        true
    );
}
add_action('wp_enqueue_scripts', 'hrgms_enqueue_scripts');

/**
 * hrgms_register_widgets
 * What: Register widget areas / sidebars
 */
function hrgms_register_widgets() {
    register_sidebar(array(
        'name'          => __('Footer Widget 1', 'hrgms-theme'),
        'id'            => 'footer-1',
        'description'   => __('Footer column 1 widget area', 'hrgms-theme'),
        'before_widget' => '<div class="footer-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h5 class="footer-title">',
        'after_title'   => '</h5>',
    ));
    
    register_sidebar(array(
        'name'          => __('Footer Widget 2', 'hrgms-theme'),
        'id'            => 'footer-2',
        'description'   => __('Footer column 2 widget area', 'hrgms-theme'),
        'before_widget' => '<div class="footer-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h5 class="footer-title">',
        'after_title'   => '</h5>',
    ));
    
    register_sidebar(array(
        'name'          => __('Footer Widget 3', 'hrgms-theme'),
        'id'            => 'footer-3',
        'description'   => __('Footer column 3 widget area', 'hrgms-theme'),
        'before_widget' => '<div class="footer-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h5 class="footer-title">',
        'after_title'   => '</h5>',
    ));
    
    register_sidebar(array(
        'name'          => __('Sidebar', 'hrgms-theme'),
        'id'            => 'sidebar-1',
        'description'   => __('Main sidebar widget area', 'hrgms-theme'),
        'before_widget' => '<div class="card mb-4" style="border: 1px solid var(--hrgms-card-border); box-shadow: var(--hrgms-card-shadow);"><div class="card-body">',
        'after_widget'  => '</div></div>',
        'before_title'  => '<h5 class="card-title">',
        'after_title'   => '</h5>',
    ));
}
add_action('widgets_init', 'hrgms_register_widgets');

/**
 * Custom Walker for Bootstrap 5 Navigation
 */
class HRGMS_Bootstrap_Nav_Walker extends Walker_Nav_Menu {
    
    function start_lvl(&$output, $depth = 0, $args = null) {
        $output .= '<ul class="dropdown-menu">';
    }
    
    function end_lvl(&$output, $depth = 0, $args = null) {
        $output .= '</ul>';
    }
    
    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $has_children = in_array('menu-item-has-children', $classes);
        
        $li_class = 'nav-item';
        if ($has_children) {
            $li_class .= ' dropdown';
        }
        if (in_array('current-menu-item', $classes)) {
            $li_class .= ' active';
        }
        
        $output .= '<li class="' . esc_attr($li_class) . '">';
        
        $link_class = 'nav-link hrgms-nav-link';
        if ($has_children) {
            $link_class .= ' dropdown-toggle';
        }
        if (in_array('current-menu-item', $classes)) {
            $link_class .= ' active';
        }
        
        $atts = array(
            'href'  => !empty($item->url) ? $item->url : '',
            'class' => $link_class,
        );
        
        if ($has_children) {
            $atts['data-bs-toggle'] = 'dropdown';
            $atts['role'] = 'button';
            $atts['aria-expanded'] = 'false';
        }
        
        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (!empty($value)) {
                $attributes .= ' ' . $attr . '="' . esc_attr($value) . '"';
            }
        }
        
        $output .= '<a' . $attributes . '>';
        $output .= apply_filters('the_title', $item->title, $item->ID);
        $output .= '</a>';
    }
    
    function end_el(&$output, $item, $depth = 0, $args = null) {
        $output .= '</li>';
    }
}

/**
 * hrgms_fallback_menu
 * What: Display fallback menu if no menu assigned
 */
function hrgms_fallback_menu() {
    ?>
    <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link hrgms-nav-link active" href="<?php echo esc_url(home_url('/')); ?>">Home</a></li>
        <?php
        $pages = get_pages(array('number' => 5, 'sort_column' => 'menu_order'));
        foreach ($pages as $page) :
            if ($page->ID == get_option('page_on_front')) continue;
        ?>
            <li class="nav-item"><a class="nav-link hrgms-nav-link" href="<?php echo get_permalink($page->ID); ?>"><?php echo esc_html($page->post_title); ?></a></li>
        <?php endforeach; ?>
    </ul>
    <?php
}

/**
 * hrgms_custom_excerpt_length
 * What: Set custom excerpt length
 */
function hrgms_custom_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'hrgms_custom_excerpt_length');

/**
 * hrgms_custom_excerpt_more
 * What: Change excerpt ending
 */
function hrgms_custom_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'hrgms_custom_excerpt_more');

/**
 * hrgms_reading_time
 * What: Calculate estimated reading time for a post
 */
function hrgms_reading_time($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    
    $content = get_post_field('post_content', $post_id);
    $word_count = str_word_count(strip_tags($content));
    $reading_time = ceil($word_count / 200);
    
    return max(1, $reading_time);
}

/* ==========================================================================
   PERFORMANCE OPTIMIZATIONS (Yoast handles SEO meta/schema)
   ========================================================================== */

/**
 * hrgms_add_preload_hints
 * What: Add resource hints for performance
 */
function hrgms_add_preload_hints() {
    echo '<link rel="preconnect" href="https://fonts.googleapis.com" />' . "\n";
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />' . "\n";
    echo '<link rel="preconnect" href="https://cdn.jsdelivr.net" />' . "\n";
    echo '<link rel="dns-prefetch" href="//fonts.googleapis.com" />' . "\n";
    echo '<link rel="dns-prefetch" href="//cdn.jsdelivr.net" />' . "\n";
}
add_action('wp_head', 'hrgms_add_preload_hints', 0);

/**
 * hrgms_add_pingback
 * What: Add pingback URL for posts
 */
function hrgms_add_pingback() {
    if (is_singular() && pings_open()) {
        echo '<link rel="pingback" href="' . esc_url(get_bloginfo('pingback_url')) . '" />' . "\n";
    }
}
add_action('wp_head', 'hrgms_add_pingback', 5);

/**
 * hrgms_remove_wp_version
 * What: Remove WordPress version for security
 */
function hrgms_remove_wp_version() {
    return '';
}
add_filter('the_generator', 'hrgms_remove_wp_version');

/**
 * hrgms_async_scripts
 * What: Add defer to scripts for performance
 */
function hrgms_async_scripts($tag, $handle, $src) {
    $defer_scripts = array('bootstrap-js', 'hrgms-custom-js');
    
    if (in_array($handle, $defer_scripts)) {
        return str_replace(' src', ' defer src', $tag);
    }
    
    return $tag;
}
add_filter('script_loader_tag', 'hrgms_async_scripts', 10, 3);

/* ==========================================================================
   CUSTOM REWRITE RULES FOR LISTING PAGES
   ========================================================================== */

/**
 * hrgms_custom_rewrite_rules
 * What: Add custom URL structure for listing pages
 */
function hrgms_custom_rewrite_rules() {
    // /halaman/ for pages listing
    add_rewrite_rule(
        '^halaman/?$',
        'index.php?hrgms_pages_list=1',
        'top'
    );
    add_rewrite_rule(
        '^halaman/page/([0-9]+)/?$',
        'index.php?hrgms_pages_list=1&paged=$matches[1]',
        'top'
    );
    
    // /kategori/ for categories listing
    add_rewrite_rule(
        '^kategori/?$',
        'index.php?hrgms_categories_list=1',
        'top'
    );
}
add_action('init', 'hrgms_custom_rewrite_rules');

/**
 * hrgms_query_vars
 * What: Register custom query vars
 */
function hrgms_query_vars($vars) {
    $vars[] = 'hrgms_pages_list';
    $vars[] = 'hrgms_categories_list';
    return $vars;
}
add_filter('query_vars', 'hrgms_query_vars');

/**
 * hrgms_template_redirect
 * What: Load custom templates for listing pages
 */
function hrgms_template_redirect() {
    if (get_query_var('hrgms_pages_list')) {
        include get_template_directory() . '/template-pages-list.php';
        exit;
    }
    if (get_query_var('hrgms_categories_list')) {
        include get_template_directory() . '/template-categories-list.php';
        exit;
    }
}
add_action('template_redirect', 'hrgms_template_redirect');

/**
 * hrgms_flush_rewrite_rules
 * What: Flush rewrite rules on theme activation
 */
function hrgms_flush_rewrite_rules() {
    hrgms_custom_rewrite_rules();
    hrgms_harga_emas_rewrite_rules(); // Include harga emas rules
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'hrgms_flush_rewrite_rules');

/* ==========================================================================
   PAGINATION SETTINGS
   ========================================================================== */

/**
 * hrgms_posts_per_page
 * What: Set default posts per page to 10
 */
function hrgms_posts_per_page($query) {
    if (!is_admin() && $query->is_main_query()) {
        if (is_home() || is_archive() || is_search()) {
            $query->set('posts_per_page', 10);
        }
    }
}
add_action('pre_get_posts', 'hrgms_posts_per_page');

/**
 * hrgms_get_first_image
 * What: Get first image from post content if no featured image
 * Input: post_id (optional)
 * Output: string|false - Image URL or false if not found
 * 
 * Priority:
 * 1. Featured Image (WordPress)
 * 2. First <img src=""> in content
 * 3. First <img data-src=""> (lazy loading)
 * 4. First <img data-lazy-src=""> (lazy loading plugins)
 * 5. WordPress Gutenberg image block
 * 6. Direct image URL in content (Pinterest, etc.)
 */
function hrgms_get_first_image($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    
    // Validate post ID
    if (!$post_id || !is_numeric($post_id)) {
        return false;
    }
    
    // 1. First check for featured image (highest priority)
    if (has_post_thumbnail($post_id)) {
        $thumb_url = get_the_post_thumbnail_url($post_id, 'hrgms-card');
        if ($thumb_url) {
            return $thumb_url;
        }
    }
    
    // Get post content
    $post = get_post($post_id);
    if (!$post || empty($post->post_content)) {
        return false;
    }
    
    $content = $post->post_content;
    
    // 2. Try standard img src attribute
    if (preg_match('/<img[^>]+src=[\'"]([^\'"]+)[\'"][^>]*>/i', $content, $match)) {
        $url = trim($match[1]);
        if (hrgms_is_valid_image_url($url)) {
            return esc_url($url);
        }
    }
    
    // 3. Try data-src attribute (lazy loading)
    if (preg_match('/<img[^>]+data-src=[\'"]([^\'"]+)[\'"][^>]*>/i', $content, $match)) {
        $url = trim($match[1]);
        if (hrgms_is_valid_image_url($url)) {
            return esc_url($url);
        }
    }
    
    // 4. Try data-lazy-src attribute (some lazy load plugins)
    if (preg_match('/<img[^>]+data-lazy-src=[\'"]([^\'"]+)[\'"][^>]*>/i', $content, $match)) {
        $url = trim($match[1]);
        if (hrgms_is_valid_image_url($url)) {
            return esc_url($url);
        }
    }
    
    // 5. Try WordPress attachment ID from Gutenberg blocks
    if (preg_match('/wp:image[^}]*"id":(\d+)/i', $content, $match)) {
        $attachment_id = intval($match[1]);
        $img_url = wp_get_attachment_image_url($attachment_id, 'hrgms-card');
        if ($img_url) {
            return $img_url;
        }
    }
    
    // 6. Try to find direct image URL in content (Pinterest, external URLs, etc.)
    // This catches URLs that are just text links to images
    $image_extensions = 'jpe?g|png|gif|webp|bmp|svg';
    if (preg_match('/(https?:\/\/[^\s"\'<>]+\.(?:' . $image_extensions . '))(?:\?[^\s"\'<>]*)?/i', $content, $match)) {
        $url = trim($match[1]);
        if (hrgms_is_valid_image_url($url)) {
            return esc_url($url);
        }
    }
    
    // 7. Check for Pinterest specific patterns (pinimg.com)
    if (preg_match('/(https?:\/\/i\.pinimg\.com\/[^\s"\'<>]+)/i', $content, $match)) {
        return esc_url(trim($match[1]));
    }
    
    // 8. Check for other common image CDNs
    $cdn_patterns = array(
        'images\.unsplash\.com',
        'cdn\.pixabay\.com',
        'images\.pexels\.com',
        'imgur\.com',
        'cloudinary\.com',
    );
    foreach ($cdn_patterns as $pattern) {
        if (preg_match('/(https?:\/\/[^\s"\'<>]*' . $pattern . '[^\s"\'<>]*)/i', $content, $match)) {
            return esc_url(trim($match[1]));
        }
    }
    
    return false;
}

/**
 * hrgms_is_valid_image_url
 * What: Check if URL is a valid image URL
 * Input: string URL
 * Output: boolean
 */
function hrgms_is_valid_image_url($url) {
    if (empty($url)) {
        return false;
    }
    
    // Must start with http:// or https://
    if (strpos($url, 'http://') !== 0 && strpos($url, 'https://') !== 0) {
        return false;
    }
    
    // Check for common image extensions or known image CDNs
    $image_extensions = array('.jpg', '.jpeg', '.png', '.gif', '.webp', '.bmp', '.svg');
    $image_cdns = array('pinimg.com', 'unsplash.com', 'pixabay.com', 'pexels.com', 'imgur.com', 'cloudinary.com', 'wp.com', 'gravatar.com');
    
    $url_lower = strtolower($url);
    
    // Check file extensions
    foreach ($image_extensions as $ext) {
        if (strpos($url_lower, $ext) !== false) {
            return true;
        }
    }
    
    // Check known image CDNs (they might not have extensions)
    foreach ($image_cdns as $cdn) {
        if (strpos($url_lower, $cdn) !== false) {
            return true;
        }
    }
    
    // Check for common image URL patterns
    if (preg_match('/\/(?:images?|img|photos?|pics?|media|uploads?|files?)\//', $url_lower)) {
        return true;
    }
    
    return false;
}

/* ==========================================================================
   THEME CUSTOMIZER - Harga Emas Category Settings
   ========================================================================== */

/**
 * hrgms_customize_register
 * What: Add theme customizer settings for Harga Emas category
 */
function hrgms_customize_register($wp_customize) {
    // Add Section
    $wp_customize->add_section('hrgms_harga_emas_section', array(
        'title'       => __('Harga Emas Settings', 'hrgms-theme'),
        'description' => __('Tetapan untuk kategori Harga Emas', 'hrgms-theme'),
        'priority'    => 30,
    ));
    
    // Setting: Category ID
    $wp_customize->add_setting('hrgms_harga_emas_cat_id', array(
        'default'           => 9,
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('hrgms_harga_emas_cat_id', array(
        'label'       => __('Harga Emas Category ID', 'hrgms-theme'),
        'description' => __('ID kategori untuk post Harga Emas (default: 9)', 'hrgms-theme'),
        'section'     => 'hrgms_harga_emas_section',
        'type'        => 'number',
        'input_attrs' => array(
            'min' => 1,
        ),
    ));
    
    // Setting: Posts per page for Harga Emas
    $wp_customize->add_setting('hrgms_harga_emas_per_page', array(
        'default'           => 30,
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('hrgms_harga_emas_per_page', array(
        'label'       => __('Posts Per Page', 'hrgms-theme'),
        'description' => __('Bilangan post Harga Emas per halaman', 'hrgms-theme'),
        'section'     => 'hrgms_harga_emas_section',
        'type'        => 'number',
        'input_attrs' => array(
            'min' => 10,
            'max' => 100,
        ),
    ));
    
    // Setting: Show on front page
    $wp_customize->add_setting('hrgms_harga_emas_show_front', array(
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('hrgms_harga_emas_show_front', array(
        'label'       => __('Papar di Front Page', 'hrgms-theme'),
        'description' => __('Papar section Harga Emas di front page', 'hrgms-theme'),
        'section'     => 'hrgms_harga_emas_section',
        'type'        => 'checkbox',
    ));
    
    // Setting: Number of posts on front page
    $wp_customize->add_setting('hrgms_harga_emas_front_count', array(
        'default'           => 6,
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('hrgms_harga_emas_front_count', array(
        'label'       => __('Bilangan di Front Page', 'hrgms-theme'),
        'description' => __('Bilangan post Harga Emas di front page', 'hrgms-theme'),
        'section'     => 'hrgms_harga_emas_section',
        'type'        => 'number',
        'input_attrs' => array(
            'min' => 3,
            'max' => 12,
        ),
    ));
}
add_action('customize_register', 'hrgms_customize_register');

/**
 * hrgms_get_harga_emas_cat_id
 * What: Get Harga Emas category ID from customizer
 */
function hrgms_get_harga_emas_cat_id() {
    return absint(get_theme_mod('hrgms_harga_emas_cat_id', 9));
}

/**
 * hrgms_is_harga_emas_category
 * What: Check if current post is in Harga Emas category
 */
function hrgms_is_harga_emas_category($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    $cat_id = hrgms_get_harga_emas_cat_id();
    return has_category($cat_id, $post_id);
}

/* ==========================================================================
   CUSTOM REWRITE FOR HARGA EMAS LISTING
   ========================================================================== */

/**
 * Add rewrite rule for /harga-emas/ listing page
 */
function hrgms_harga_emas_rewrite_rules() {
    add_rewrite_rule(
        '^harga-emas/?$',
        'index.php?hrgms_harga_emas_list=1',
        'top'
    );
    add_rewrite_rule(
        '^harga-emas/page/([0-9]+)/?$',
        'index.php?hrgms_harga_emas_list=1&paged=$matches[1]',
        'top'
    );
}
add_action('init', 'hrgms_harga_emas_rewrite_rules');

/**
 * Register query var
 */
function hrgms_harga_emas_query_vars($vars) {
    $vars[] = 'hrgms_harga_emas_list';
    return $vars;
}
add_filter('query_vars', 'hrgms_harga_emas_query_vars');

/**
 * Load template for harga emas listing
 */
function hrgms_harga_emas_template_redirect() {
    if (get_query_var('hrgms_harga_emas_list')) {
        include get_template_directory() . '/template-harga-emas.php';
        exit;
    }
}
add_action('template_redirect', 'hrgms_harga_emas_template_redirect');

/**
 * hrgms_exclude_harga_emas_from_main_query
 * What: Exclude Harga Emas category from main blog queries
 * This ensures Harga Emas posts don't appear in regular blog listings
 */
function hrgms_exclude_harga_emas_from_main_query($query) {
    // Only modify main query on front-end
    if (is_admin() || !$query->is_main_query()) {
        return;
    }
    
    $harga_emas_cat_id = hrgms_get_harga_emas_cat_id();
    
    // Exclude from home blog page, archives, search
    if ($query->is_home() || $query->is_archive() || $query->is_search()) {
        // Don't exclude if viewing the Harga Emas category itself
        if ($query->is_category($harga_emas_cat_id)) {
            return;
        }
        
        // Get existing exclusions and add Harga Emas
        $exclude_cats = $query->get('category__not_in');
        if (!is_array($exclude_cats)) {
            $exclude_cats = array();
        }
        $exclude_cats[] = $harga_emas_cat_id;
        
        $query->set('category__not_in', $exclude_cats);
    }
}
add_action('pre_get_posts', 'hrgms_exclude_harga_emas_from_main_query');

/**
 * hrgms_breadcrumb
 * What: Generate SEO-friendly breadcrumb (for non-Yoast pages)
 */
function hrgms_breadcrumb() {
    if (is_front_page()) return;
    
    echo '<nav aria-label="breadcrumb" class="mb-3">';
    echo '<ol class="breadcrumb" style="background: transparent; margin: 0;">';
    echo '<li class="breadcrumb-item"><a href="' . home_url('/') . '"><i class="bi bi-house"></i> Laman Utama</a></li>';
    
    if (is_category()) {
        $cat = get_queried_object();
        echo '<li class="breadcrumb-item active" aria-current="page">' . esc_html($cat->name) . '</li>';
    } elseif (is_tag()) {
        $tag = get_queried_object();
        echo '<li class="breadcrumb-item active" aria-current="page">Tag: ' . esc_html($tag->name) . '</li>';
    } elseif (is_single()) {
        $categories = get_the_category();
        if (!empty($categories)) {
            echo '<li class="breadcrumb-item"><a href="' . get_category_link($categories[0]->term_id) . '">' . esc_html($categories[0]->name) . '</a></li>';
        }
        echo '<li class="breadcrumb-item active" aria-current="page">' . get_the_title() . '</li>';
    } elseif (is_page()) {
        $ancestors = get_post_ancestors(get_the_ID());
        if ($ancestors) {
            $ancestors = array_reverse($ancestors);
            foreach ($ancestors as $ancestor) {
                echo '<li class="breadcrumb-item"><a href="' . get_permalink($ancestor) . '">' . get_the_title($ancestor) . '</a></li>';
            }
        }
        echo '<li class="breadcrumb-item active" aria-current="page">' . get_the_title() . '</li>';
    } elseif (is_search()) {
        echo '<li class="breadcrumb-item active" aria-current="page">Carian: ' . get_search_query() . '</li>';
    } elseif (is_archive()) {
        echo '<li class="breadcrumb-item active" aria-current="page">' . get_the_archive_title() . '</li>';
    }
    
    echo '</ol>';
    echo '</nav>';
}
