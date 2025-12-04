<?php
/**
 * File: template-categories-list.php
 * Purpose: List all categories
 * URL: /kategori/
 * Notes: Yoast SEO compatible
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

// Get all categories
$categories = get_categories(array(
    'orderby'    => 'name',
    'order'      => 'ASC',
    'hide_empty' => false,
));

$total_categories = count($categories);
?>

<!-- Header -->
<header class="hrgms-hero hrgms-hero-simple" style="padding: 40px 0;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <?php hrgms_breadcrumb(); ?>
                <h1 class="hrgms-hero-title">Semua Kategori</h1>
                <p class="hrgms-hero-subtitle">
                    <?php printf(__('%d kategori dijumpai', 'hrgms-theme'), $total_categories); ?>
                </p>
            </div>
        </div>
    </div>
</header>

<section class="hrgms-shops">
    <div class="container">
        <?php if (!empty($categories)) : ?>
            
            <div class="row g-4">
                <?php 
                $colors = array('e95420', '77ac68', '3498db', '9b59b6', 'e74c3c', 'f39c12', '1e3a5f', '2d3748');
                $i = 0;
                foreach ($categories as $category) : 
                    $color = $colors[$i % count($colors)];
                ?>
                    <div class="col-6 col-md-4 col-lg-3">
                        <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" class="text-decoration-none">
                            <div class="shop-card h-100">
                                <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($category->name); ?>&background=<?php echo $color; ?>&color=fff&size=100&font-size=0.4" 
                                     alt="<?php echo esc_attr($category->name); ?>" 
                                     class="shop-logo"
                                     style="width: 100px; height: 100px;"
                                     loading="lazy">
                                <span class="shop-badge">
                                    <i class="bi bi-file-text me-1"></i><?php echo $category->count; ?> artikel
                                </span>
                                <h3 class="shop-name"><?php echo esc_html($category->name); ?></h3>
                                <?php if ($category->description) : ?>
                                    <p class="shop-location"><?php echo esc_html(wp_trim_words($category->description, 10, '...')); ?></p>
                                <?php else : ?>
                                    <p class="shop-location">Lihat semua artikel dalam kategori ini</p>
                                <?php endif; ?>
                                <div class="mt-2">
                                    <span class="btn btn-product btn-sm">Lihat Artikel <i class="bi bi-arrow-right"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php 
                    $i++;
                endforeach; 
                ?>
            </div>
            
        <?php else : ?>
            <div class="alert alert-info text-center">
                <h4>Tiada Kategori</h4>
                <p>Tiada kategori dijumpai.</p>
                <a href="<?php echo home_url('/'); ?>" class="btn btn-hrgms-primary">Kembali ke Laman Utama</a>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>

