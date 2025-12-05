<?php
/**
 * File: front-page.php
 * Purpose: Homepage template using WordPress posts/data
 * Exposes: Hero, Recent Posts, Featured Content sections
 * Notes: SEO compatible with Yoast, uses WordPress data only
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

// Get site info
$site_name = get_bloginfo('name');
$site_description = get_bloginfo('description');

// Get blog page URL for "Lihat Semua" posts
// Priority: 1) Blog page if set, 2) Custom archive page, 3) Default posts page
$page_for_posts = get_option('page_for_posts');
if ($page_for_posts) {
    $blog_url = get_permalink($page_for_posts);
} else {
    // Use index.php which lists all posts
    $blog_url = home_url('/');
    // If front page is set to static page, posts are at a different URL
    if (get_option('show_on_front') == 'page') {
        $blog_url = get_post_type_archive_link('post');
        if (!$blog_url) {
            $blog_url = home_url('/?post_type=post');
        }
    }
}

// Get pages archive URL
$pages_url = home_url('/halaman/');
?>

<!-- ========== HERO SECTION (Background Image with Blur) ========== -->
<section class="hrgms-hero hrgms-hero-bg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center hrgms-hero-content">
                <h1 class="hrgms-hero-title"><?php echo esc_html($site_name); ?></h1>
                <p class="hrgms-hero-subtitle">
                    <?php echo esc_html($site_description); ?>
                </p>
                <div class="hero-buttons">
                    <a href="https://www.hargaemas.my/ar-rahnu/calculator?selected=ARX" class="btn btn-hrgms-primary">
                        <i class="bi bi-calculator me-2"></i>Kalkulator
                    </a>
                    <a href="https://www.hargaemas.my/gold-bars-999" class="btn btn-hrgms-secondary">
                        <i class="bi bi-folder me-2"></i>Gold Bar
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ========== STATS SECTION ========== -->
<?php
// Get Harga Emas category settings
$harga_emas_cat_id = hrgms_get_harga_emas_cat_id();
$harga_emas_show_front = get_theme_mod('hrgms_harga_emas_show_front', true);
$harga_emas_front_count = absint(get_theme_mod('hrgms_harga_emas_front_count', 6));
$harga_emas_category = get_category($harga_emas_cat_id);

// Count posts excluding Harga Emas
$total_posts = wp_count_posts()->publish;
$harga_emas_count = $harga_emas_category ? $harga_emas_category->count : 0;
$regular_posts_count = $total_posts - $harga_emas_count;
?>
<section class="hrgms-stats">
    <div class="container">
        <div class="row">
            <?php
            $total_pages = wp_count_posts('page')->publish;
            $total_categories = wp_count_terms('category');
            if (is_wp_error($total_categories)) {
                $total_categories = 0;
            }
            ?>
            <div class="col-6 col-md-3">
                <div class="stat-item">
                    <div class="stat-number"><?php echo number_format($harga_emas_count); ?>+</div>
                    <div class="stat-label">Rekod Harga Emas</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-item">
                    <div class="stat-number"><?php echo number_format($regular_posts_count); ?>+</div>
                    <div class="stat-label">Artikel</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-item">
                    <div class="stat-number"><?php echo number_format($total_pages); ?>+</div>
                    <div class="stat-label">Halaman</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-item">
                    <div class="stat-number">24/7</div>
                    <div class="stat-label">Maklumat Terkini</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ========== HARGA EMAS SECTION (DI ATAS SEKALI) ========== -->
<?php if ($harga_emas_show_front && $harga_emas_category) : ?>
<section id="harga-emas" class="hrgms-products" style="background: linear-gradient(135deg, #f9f3e3 0%, #fef9e7 100%);">
    <div class="container">
        <div class="section-header">
            <h2><i class="bi bi-graph-up me-2" style="color: #f39c12;"></i><?php echo esc_html($harga_emas_category->name); ?></h2>
            <a href="<?php echo esc_url(home_url('/harga-emas/')); ?>" class="view-all-link">
                Lihat Semua (<?php echo number_format($harga_emas_count); ?>) <i class="bi bi-arrow-right"></i>
            </a>
        </div>
        
        <div class="row g-3">
            <?php
            $harga_emas_posts = new WP_Query(array(
                'post_type'      => 'post',
                'posts_per_page' => $harga_emas_front_count,
                'post_status'    => 'publish',
                'cat'            => $harga_emas_cat_id,
                'orderby'        => 'date',
                'order'          => 'DESC',
            ));

            if ($harga_emas_posts->have_posts()) :
                while ($harga_emas_posts->have_posts()) : $harga_emas_posts->the_post();
                    $thumb = hrgms_get_first_image(get_the_ID());
            ?>
                <div class="col-6 col-md-4 col-lg-2">
                    <article class="product-card" style="border: 2px solid #f39c12;">
                        <div class="product-image" style="height: 100px;">
                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                <?php if ($thumb) : ?>
                                    <img src="<?php echo esc_url($thumb); ?>" 
                                         alt="<?php the_title_attribute(); ?>" 
                                         class="img-fluid"
                                         style="height: 100%; object-fit: cover;"
                                         loading="lazy">
                                <?php else : ?>
                                    <div class="d-flex align-items-center justify-content-center h-100" style="background: linear-gradient(135deg, #f39c12, #e67e22);">
                                        <i class="bi bi-graph-up text-white" style="font-size: 1.5rem;"></i>
                                    </div>
                                <?php endif; ?>
                            </a>
                        </div>
                        <div class="product-body p-2">
                            <h3 class="product-title" style="font-size: 0.85rem;">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h3>
                            <div class="product-meta" style="font-size: 0.75rem;">
                                <i class="bi bi-calendar"></i> <?php echo get_the_date('d M Y'); ?>
                            </div>
                        </div>
                    </article>
                </div>
            <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>
        
        <div class="text-center mt-4">
            <a href="<?php echo esc_url(home_url('/harga-emas/')); ?>" class="btn btn-hrgms-secondary">
                <i class="bi bi-graph-up me-2"></i>Lihat Semua Rekod Harga Emas
            </a>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- ========== ARTIKEL TERKINI (EXCLUDE HARGA EMAS) ========== -->
<section id="artikel" class="hrgms-products">
    <div class="container">
        <div class="section-header">
            <h2>Artikel Terkini</h2>
            <?php 
            $posts_page_id = get_option('page_for_posts');
            $all_posts_url = $posts_page_id ? get_permalink($posts_page_id) : home_url('/?post_type=post');
            ?>
            <a href="<?php echo esc_url($all_posts_url); ?>" class="view-all-link">
                Lihat Semua (<?php echo number_format($regular_posts_count); ?>) <i class="bi bi-arrow-right"></i>
            </a>
        </div>
        
        <div class="row g-4">
            <?php
            // Exclude Harga Emas category from regular posts
            $recent_posts = new WP_Query(array(
                'post_type'      => 'post',
                'posts_per_page' => 6,
                'post_status'    => 'publish',
                'orderby'        => 'date',
                'order'          => 'DESC',
                'category__not_in' => array($harga_emas_cat_id), // Exclude Harga Emas
            ));

            if ($recent_posts->have_posts()) :
                while ($recent_posts->have_posts()) : $recent_posts->the_post();
            ?>
                <div class="col-6 col-md-4 col-lg-2">
                    <article class="product-card">
                        <div class="product-image">
                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('medium', array(
                                        'class'   => 'img-fluid',
                                        'loading' => 'lazy',
                                        'alt'     => get_the_title()
                                    )); ?>
                                <?php else : ?>
                                    <img src="<?php echo hrgms_get_placeholder_image(get_the_title(), '1e3a5f', 'ffffff', 300, 200); ?>" 
                                         alt="<?php the_title_attribute(); ?>" 
                                         class="img-fluid"
                                         loading="lazy"
                                         onerror="this.src='<?php echo hrgms_get_placeholder_image('Image', '1e3a5f', 'ffffff', 300, 200); ?>';">
                                <?php endif; ?>
                            </a>
                            <?php
                            $categories = get_the_category();
                            if (!empty($categories)) :
                            ?>
                                <span class="product-badge"><?php echo esc_html($categories[0]->name); ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="product-body">
                            <h3 class="product-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h3>
                            <div class="product-meta">
                                <i class="bi bi-calendar"></i> <?php echo get_the_date(); ?>
                            </div>
                            <a href="<?php the_permalink(); ?>" class="btn btn-product">
                                Baca Lagi
                            </a>
                        </div>
                    </article>
                </div>
            <?php
                endwhile;
                wp_reset_postdata();
            else :
            ?>
                <div class="col-12">
                    <div class="alert alert-info">
                        <p>Tiada artikel dijumpai. <a href="<?php echo admin_url('post-new.php'); ?>">Tambah artikel pertama anda</a>.</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- ========== HALAMAN PILIHAN ========== -->
<section class="hrgms-products" style="background: var(--hrgms-body-bg);">
    <div class="container">
        <div class="section-header">
            <h2>Halaman Pilihan</h2>
            <a href="<?php echo esc_url($pages_url); ?>" class="view-all-link">
                Lihat Semua (<?php echo $total_pages; ?>) <i class="bi bi-arrow-right"></i>
            </a>
        </div>
        
        <div class="row g-4">
            <?php
            $front_page_id = get_option('page_on_front');
            $featured_pages = new WP_Query(array(
                'post_type'      => 'page',
                'posts_per_page' => 6,
                'post_status'    => 'publish',
                'post__not_in'   => $front_page_id ? array($front_page_id) : array(),
                'orderby'        => 'menu_order',
                'order'          => 'ASC',
            ));

            if ($featured_pages->have_posts()) :
                while ($featured_pages->have_posts()) : $featured_pages->the_post();
            ?>
                <?php 
                    // Get first image or featured image for page
                    $page_thumb = hrgms_get_first_image(get_the_ID());
                ?>
                <div class="col-6 col-md-4 col-lg-2">
                    <article class="product-card">
                        <div class="product-image">
                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                <?php if ($page_thumb) : ?>
                                    <img src="<?php echo esc_url($page_thumb); ?>" 
                                         alt="<?php the_title_attribute(); ?>" 
                                         class="img-fluid"
                                         loading="lazy">
                                <?php else : ?>
                                    <img src="<?php echo hrgms_get_placeholder_image(get_the_title(), 'e95420', 'ffffff', 300, 200); ?>" 
                                         alt="<?php the_title_attribute(); ?>" 
                                         class="img-fluid"
                                         loading="lazy"
                                         onerror="this.src='<?php echo hrgms_get_placeholder_image('Image', 'e95420', 'ffffff', 300, 200); ?>';">
                                <?php endif; ?>
                            </a>
                        </div>
                        <div class="product-body">
                            <h3 class="product-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h3>
                            <div class="product-meta">
                                <?php echo wp_trim_words(get_the_excerpt(), 8, '...'); ?>
                            </div>
                            <a href="<?php the_permalink(); ?>" class="btn btn-product">
                                Lihat
                            </a>
                        </div>
                    </article>
                </div>
            <?php
                endwhile;
                wp_reset_postdata();
            else :
            ?>
                <div class="col-12">
                    <div class="alert alert-info">
                        <p>Tiada halaman dijumpai.</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- ========== KATEGORI ========== -->
<section id="kategori" class="hrgms-shops">
    <div class="container">
        <div class="section-header">
            <h2>Kategori</h2>
            <a href="<?php echo esc_url(home_url('/kategori/')); ?>" class="view-all-link">
                Lihat Semua (<?php echo $total_categories; ?>) <i class="bi bi-arrow-right"></i>
            </a>
        </div>
        
        <div class="row g-4">
            <?php
            $categories = get_categories(array(
                'orderby'    => 'count',
                'order'      => 'DESC',
                'number'     => 6,
                'hide_empty' => false,
            ));

            if (!empty($categories)) :
                $colors = array('e95420', '77ac68', '3498db', '9b59b6', 'e74c3c', 'f39c12');
                $i = 0;
                foreach ($categories as $category) :
                    $color = $colors[$i % count($colors)];
            ?>
                <div class="col-6 col-md-4 col-lg-2">
                    <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" class="text-decoration-none">
                        <div class="shop-card">
                            <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($category->name); ?>&background=<?php echo $color; ?>&color=fff&size=80" 
                                 alt="<?php echo esc_attr($category->name); ?>" 
                                 class="shop-logo"
                                 loading="lazy">
                            <span class="shop-badge">
                                <i class="bi bi-file-text me-1"></i><?php echo $category->count; ?> artikel
                            </span>
                            <h4 class="shop-name"><?php echo esc_html($category->name); ?></h4>
                            <?php if ($category->description) : ?>
                                <p class="shop-location"><?php echo esc_html(wp_trim_words($category->description, 5, '...')); ?></p>
                            <?php endif; ?>
                        </div>
                    </a>
                </div>
            <?php
                    $i++;
                endforeach;
            else :
            ?>
                <div class="col-12">
                    <div class="alert alert-info">
                        <p>Tiada kategori dijumpai.</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- ========== WHY CHOOSE US ========== -->
<section class="hrgms-why-us">
    <div class="container">
        <h2 class="section-title">Kenapa Pilih <?php echo esc_html($site_name); ?>?</h2>
        
        <div class="row">
            <div class="col-md-4">
                <div class="why-us-card">
                    <div class="why-us-icon">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <h3 class="why-us-title">Dipercayai & Selamat</h3>
                    <p class="why-us-desc">
                        Maklumat yang disediakan adalah tepat dan boleh dipercayai untuk rujukan anda.
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="why-us-card">
                    <div class="why-us-icon">
                        <i class="bi bi-clock-history"></i>
                    </div>
                    <h3 class="why-us-title">Sentiasa Dikemaskini</h3>
                    <p class="why-us-desc">
                        Kandungan dikemaskini secara berkala untuk memastikan ketepatan maklumat.
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="why-us-card">
                    <div class="why-us-icon">
                        <i class="bi bi-graph-up-arrow"></i>
                    </div>
                    <h3 class="why-us-title">Mudah & Pantas</h3>
                    <p class="why-us-desc">
                        Akses maklumat dengan mudah melalui laman web yang mesra pengguna.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ========== CTA SECTION ========== -->
<section class="hrgms-cta">
    <div class="container">
        <h2 class="cta-title">Jangan Ketinggalan!</h2>
        <p class="cta-subtitle">
            Layari <?php echo esc_html($site_name); ?> untuk mendapatkan maklumat terkini dan berguna.
        </p>
        <div class="cta-buttons">
            <a href="https://wa.me/60122864232?text=%F0%9F%AA%99%20Hargatrade%20gold%20appraisal%20%E2%80%94%20fill%20details%20below%20%26%20snap%20a%20pic%20%F0%9F%93%B8%0A%0AKarat%20:%20%0AWeight%20:%20%0ALocation%20%F0%9F%93%8D%20:%20%0ADate%20(if%20pawn/rahnu)%20%F0%9F%93%85%20:%20" class="btn btn-cta-primary">
                <i class="bi bi-whatsapp me-2"></i>Tanya Quotation Harga
            </a>
        </div>
    </div>
</section>

<?php get_footer(); ?>
