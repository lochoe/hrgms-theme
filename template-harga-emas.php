<?php
/**
 * File: template-harga-emas.php
 * Purpose: List all Harga Emas posts with pagination
 * URL: /harga-emas/ and /harga-emas/page/2/
 * Notes: Special listing for Harga Emas category posts
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

$paged = get_query_var('paged') ? get_query_var('paged') : 1;
$per_page = absint(get_theme_mod('hrgms_harga_emas_per_page', 30));
$cat_id = hrgms_get_harga_emas_cat_id();
$category = get_category($cat_id);

// Query Harga Emas posts
$harga_emas_query = new WP_Query(array(
    'post_type'      => 'post',
    'posts_per_page' => $per_page,
    'paged'          => $paged,
    'post_status'    => 'publish',
    'cat'            => $cat_id,
    'orderby'        => 'date',
    'order'          => 'DESC',
));

$total_pages = $harga_emas_query->max_num_pages;
$total_items = $harga_emas_query->found_posts;
?>

<!-- Header -->
<header class="hrgms-hero hrgms-hero-bg" style="padding: 40px 0;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <?php hrgms_breadcrumb(); ?>
                <h1 class="hrgms-hero-title">
                    <i class="bi bi-graph-up me-2"></i><?php echo $category ? esc_html($category->name) : 'Harga Emas'; ?>
                </h1>
                <p class="hrgms-hero-subtitle">
                    <?php 
                    if ($category && $category->description) {
                        echo esc_html($category->description);
                    } else {
                        echo 'Kemaskini harga emas harian';
                    }
                    ?>
                </p>
                <p class="hrgms-hero-subtitle" style="opacity: 0.8;">
                    <i class="bi bi-file-text me-1"></i>
                    <?php printf(__('%s rekod harga emas', 'hrgms-theme'), number_format($total_items)); ?>
                </p>
            </div>
        </div>
    </div>
</header>

<section class="hrgms-products">
    <div class="container">
        <?php if ($harga_emas_query->have_posts()) : ?>
            
            <!-- Filter/Info Bar -->
            <div class="d-flex justify-content-between align-items-center mb-4 p-3 rounded" style="background: var(--hrgms-card-bg); border: 1px solid var(--hrgms-card-border);">
                <div>
                    <strong>Halaman <?php echo $paged; ?></strong> daripada <?php echo $total_pages; ?>
                </div>
                <div class="text-muted small">
                    <i class="bi bi-clock me-1"></i>Dikemaskini: <?php echo get_the_modified_date('', $harga_emas_query->posts[0]->ID); ?>
                </div>
            </div>
            
            <!-- Posts Grid -->
            <div class="row g-3">
                <?php while ($harga_emas_query->have_posts()) : $harga_emas_query->the_post(); 
                    $thumb = hrgms_get_first_image(get_the_ID());
                ?>
                    <div class="col-6 col-md-4 col-lg-2">
                        <article class="product-card h-100">
                            <div class="product-image" style="height: 120px;">
                                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                    <?php if ($thumb) : ?>
                                        <img src="<?php echo esc_url($thumb); ?>" 
                                             alt="<?php the_title_attribute(); ?>" 
                                             class="img-fluid"
                                             style="height: 100%; object-fit: cover;"
                                             loading="lazy">
                                    <?php else : ?>
                                        <div class="d-flex align-items-center justify-content-center h-100" style="background: linear-gradient(135deg, #f39c12, #e67e22);">
                                            <i class="bi bi-graph-up text-white" style="font-size: 2rem;"></i>
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
                <?php endwhile; ?>
            </div>
            
            <!-- Pagination -->
            <?php if ($total_pages > 1) : ?>
                <nav class="mt-5" aria-label="<?php esc_attr_e('Harga Emas navigation', 'hrgms-theme'); ?>">
                    <?php
                    $big = 999999999;
                    $pages = paginate_links(array(
                        'base'      => home_url('/harga-emas/page/%#%/'),
                        'format'    => '',
                        'current'   => $paged,
                        'total'     => $total_pages,
                        'type'      => 'array',
                        'prev_text' => '<i class="bi bi-chevron-left"></i>',
                        'next_text' => '<i class="bi bi-chevron-right"></i>',
                        'end_size'  => 2,
                        'mid_size'  => 3,
                    ));
                    
                    if (is_array($pages)) :
                    ?>
                        <ul class="pagination pagination-sm justify-content-center flex-wrap">
                            <?php foreach ($pages as $page) : ?>
                                <li class="page-item <?php echo strpos($page, 'current') !== false ? 'active' : ''; ?>">
                                    <?php echo str_replace('page-numbers', 'page-link', $page); ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                        
                        <p class="text-center text-muted mt-2 small">
                            Halaman <?php echo $paged; ?> daripada <?php echo $total_pages; ?> 
                            (<?php echo number_format($total_items); ?> rekod)
                        </p>
                    <?php endif; ?>
                </nav>
            <?php endif; ?>
            
        <?php else : ?>
            <div class="alert alert-info text-center">
                <h4>Tiada Rekod</h4>
                <p>Tiada rekod harga emas dijumpai.</p>
                <a href="<?php echo home_url('/'); ?>" class="btn btn-hrgms-primary">Kembali ke Laman Utama</a>
            </div>
        <?php endif; wp_reset_postdata(); ?>
    </div>
</section>

<?php get_footer(); ?>

