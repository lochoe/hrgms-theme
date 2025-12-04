<?php
/**
 * File: template-pages-list.php
 * Purpose: List all pages with pagination (10 per page)
 * URL: /halaman/ and /halaman/page/2/
 * Notes: Yoast SEO compatible
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

$paged = get_query_var('paged') ? get_query_var('paged') : 1;
$per_page = 10;

// Query pages
$front_page_id = get_option('page_on_front');
$exclude_pages = $front_page_id ? array($front_page_id) : array();

$pages_query = new WP_Query(array(
    'post_type'      => 'page',
    'posts_per_page' => $per_page,
    'paged'          => $paged,
    'post_status'    => 'publish',
    'post__not_in'   => $exclude_pages,
    'orderby'        => 'title',
    'order'          => 'ASC',
));

$total_pages = $pages_query->max_num_pages;
$total_items = $pages_query->found_posts;
?>

<!-- Header -->
<header class="hrgms-hero hrgms-hero-simple" style="padding: 40px 0;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <?php hrgms_breadcrumb(); ?>
                <h1 class="hrgms-hero-title">Semua Halaman</h1>
                <p class="hrgms-hero-subtitle">
                    <?php printf(__('%d halaman dijumpai', 'hrgms-theme'), $total_items); ?>
                </p>
            </div>
        </div>
    </div>
</header>

<section class="hrgms-products">
    <div class="container">
        <?php if ($pages_query->have_posts()) : ?>
            
            <div class="row g-4">
                <?php while ($pages_query->have_posts()) : $pages_query->the_post(); ?>
                    <div class="col-6 col-md-4 col-lg-3">
                        <article class="product-card h-100">
                            <div class="product-image">
                                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                    <?php 
                                    $thumb = hrgms_get_first_image(get_the_ID());
                                    if ($thumb) : 
                                    ?>
                                        <img src="<?php echo esc_url($thumb); ?>" 
                                             alt="<?php the_title_attribute(); ?>" 
                                             class="img-fluid"
                                             loading="lazy">
                                    <?php else : ?>
                                        <img src="https://via.placeholder.com/300x200/e95420/ffffff?text=<?php echo urlencode(substr(get_the_title(), 0, 15)); ?>" 
                                             alt="<?php the_title_attribute(); ?>" 
                                             class="img-fluid"
                                             loading="lazy">
                                    <?php endif; ?>
                                </a>
                            </div>
                            <div class="product-body">
                                <h2 class="product-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>
                                <div class="product-meta">
                                    <?php echo wp_trim_words(get_the_excerpt(), 10, '...'); ?>
                                </div>
                                <a href="<?php the_permalink(); ?>" class="btn btn-product">
                                    Lihat
                                </a>
                            </div>
                        </article>
                    </div>
                <?php endwhile; ?>
            </div>
            
            <!-- Pagination -->
            <?php if ($total_pages > 1) : ?>
                <nav class="mt-5" aria-label="<?php esc_attr_e('Pages navigation', 'hrgms-theme'); ?>">
                    <ul class="pagination justify-content-center">
                        <?php if ($paged > 1) : ?>
                            <li class="page-item">
                                <a class="page-link" href="<?php echo home_url('/halaman/' . ($paged > 2 ? 'page/' . ($paged - 1) . '/' : '')); ?>">
                                    <i class="bi bi-chevron-left"></i> Sebelum
                                </a>
                            </li>
                        <?php endif; ?>
                        
                        <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                            <li class="page-item <?php echo $i == $paged ? 'active' : ''; ?>">
                                <a class="page-link" href="<?php echo home_url('/halaman/' . ($i > 1 ? 'page/' . $i . '/' : '')); ?>">
                                    <?php echo $i; ?>
                                </a>
                            </li>
                        <?php endfor; ?>
                        
                        <?php if ($paged < $total_pages) : ?>
                            <li class="page-item">
                                <a class="page-link" href="<?php echo home_url('/halaman/page/' . ($paged + 1) . '/'); ?>">
                                    Seterusnya <i class="bi bi-chevron-right"></i>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                    
                    <p class="text-center text-muted mt-2">
                        Halaman <?php echo $paged; ?> daripada <?php echo $total_pages; ?>
                    </p>
                </nav>
            <?php endif; ?>
            
        <?php else : ?>
            <div class="alert alert-info text-center">
                <h4>Tiada Halaman</h4>
                <p>Tiada halaman dijumpai.</p>
                <a href="<?php echo home_url('/'); ?>" class="btn btn-hrgms-primary">Kembali ke Laman Utama</a>
            </div>
        <?php endif; wp_reset_postdata(); ?>
    </div>
</section>

<?php get_footer(); ?>


