<?php
/**
 * File: index.php
 * Purpose: Default WordPress template - blog posts listing with pagination
 * Notes: 10 posts per page, with thumbnails, Yoast SEO compatible
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<!-- Header -->
<header class="hrgms-hero hrgms-hero-simple" style="padding: 40px 0;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <?php hrgms_breadcrumb(); ?>
                <h1 class="hrgms-hero-title">
                    <?php
                    if (is_home() && !is_front_page()) {
                        single_post_title();
                    } else {
                        _e('Semua Artikel', 'hrgms-theme');
                    }
                    ?>
                </h1>
                <p class="hrgms-hero-subtitle">
                    <?php
                    global $wp_query;
                    printf(__('%d artikel dijumpai', 'hrgms-theme'), $wp_query->found_posts);
                    ?>
                </p>
            </div>
        </div>
    </div>
</header>

<section class="hrgms-products">
    <div class="container">
        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8">
                <?php if (have_posts()) : ?>
                    
                    <div class="row g-4">
                        <?php while (have_posts()) : the_post(); 
                            $thumb = hrgms_get_first_image(get_the_ID());
                        ?>
                            <div class="col-md-6">
                                <article <?php post_class('product-card h-100'); ?>>
                                    <div class="product-image">
                                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                            <?php if ($thumb) : ?>
                                                <img src="<?php echo esc_url($thumb); ?>" 
                                                     alt="<?php the_title_attribute(); ?>" 
                                                     class="img-fluid"
                                                     loading="lazy">
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
                                        <h2 class="product-title">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h2>
                                        <div class="product-meta">
                                            <i class="bi bi-calendar"></i> <?php echo get_the_date(); ?>
                                            <span class="mx-1">•</span>
                                            <i class="bi bi-person"></i> <?php the_author(); ?>
                                        </div>
                                        <p class="text-muted small mt-2"><?php echo wp_trim_words(get_the_excerpt(), 15, '...'); ?></p>
                                        <a href="<?php the_permalink(); ?>" class="btn btn-product">
                                            Baca Lagi <i class="bi bi-arrow-right"></i>
                                        </a>
                                    </div>
                                </article>
                            </div>
                        <?php endwhile; ?>
                    </div>
                    
                    <!-- Pagination -->
                    <nav class="mt-5" aria-label="<?php esc_attr_e('Posts navigation', 'hrgms-theme'); ?>">
                        <?php
                        $big = 999999999;
                        $pages = paginate_links(array(
                            'base'      => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                            'format'    => '?paged=%#%',
                            'current'   => max(1, get_query_var('paged')),
                            'total'     => $wp_query->max_num_pages,
                            'type'      => 'array',
                            'prev_text' => '<i class="bi bi-chevron-left"></i> Sebelum',
                            'next_text' => 'Seterusnya <i class="bi bi-chevron-right"></i>',
                        ));
                        
                        if (is_array($pages)) :
                        ?>
                            <ul class="pagination justify-content-center">
                                <?php foreach ($pages as $page) : ?>
                                    <li class="page-item <?php echo strpos($page, 'current') !== false ? 'active' : ''; ?>">
                                        <?php echo str_replace('page-numbers', 'page-link', $page); ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                            
                            <p class="text-center text-muted mt-2">
                                Halaman <?php echo max(1, get_query_var('paged')); ?> daripada <?php echo $wp_query->max_num_pages; ?>
                            </p>
                        <?php endif; ?>
                    </nav>
                    
                <?php else : ?>
                    
                    <div class="alert alert-info text-center">
                        <h4><i class="bi bi-info-circle me-2"></i>Tiada Artikel</h4>
                        <p>Tiada artikel dijumpai.</p>
                        <a href="<?php echo home_url('/'); ?>" class="btn btn-hrgms-primary">Kembali ke Laman Utama</a>
                    </div>
                    
                <?php endif; ?>
            </div>
            
            <!-- Sidebar -->
            <div class="col-lg-4">
                <aside class="sidebar" role="complementary">
                    
                    <!-- Search -->
                    <div class="card mb-4" style="border: 1px solid var(--hrgms-card-border); box-shadow: var(--hrgms-card-shadow);">
                        <div class="card-body">
                            <h5 class="card-title">Carian</h5>
                            <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
                                <div class="input-group">
                                    <input type="search" name="s" class="form-control" placeholder="Cari artikel..." value="<?php echo get_search_query(); ?>">
                                    <button type="submit" class="btn btn-hrgms-secondary">
                                        <i class="bi bi-search"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                    <!-- Categories -->
                    <div class="card mb-4" style="border: 1px solid var(--hrgms-card-border); box-shadow: var(--hrgms-card-shadow);">
                        <div class="card-body">
                            <h5 class="card-title">Kategori</h5>
                            <ul class="list-unstyled mb-0">
                                <?php
                                wp_list_categories(array(
                                    'title_li' => '',
                                    'show_count' => true,
                                ));
                                ?>
                            </ul>
                        </div>
                    </div>
                    
                    <!-- Popular Posts -->
                    <div class="card mb-4" style="border: 1px solid var(--hrgms-card-border); box-shadow: var(--hrgms-card-shadow);">
                        <div class="card-body">
                            <h5 class="card-title">Artikel Popular</h5>
                            <?php
                            $popular_posts = new WP_Query(array(
                                'posts_per_page' => 5,
                                'orderby' => 'comment_count',
                                'order' => 'DESC',
                                'post_status' => 'publish',
                            ));
                            if ($popular_posts->have_posts()) :
                            while ($popular_posts->have_posts()) : $popular_posts->the_post();
                                $pop_thumb = hrgms_get_first_image(get_the_ID());
                            ?>
                                <div class="d-flex mb-3 pb-3 border-bottom">
                                    <?php if ($pop_thumb) : ?>
                                        <img src="<?php echo esc_url($pop_thumb); ?>" alt="" class="rounded me-2" style="width: 50px; height: 50px; object-fit: cover;">
                                    <?php endif; ?>
                                    <div>
                                        <a href="<?php the_permalink(); ?>" class="text-decoration-none">
                                            <strong class="d-block small"><?php the_title(); ?></strong>
                                        </a>
                                        <small class="text-muted"><?php echo get_the_date(); ?></small>
                                    </div>
                                </div>
                            <?php endwhile; endif; wp_reset_postdata(); ?>
                        </div>
                    </div>
                    
                    <!-- Tags -->
                    <?php
                    $tags = get_tags(array('number' => 15));
                    if (!empty($tags)) :
                    ?>
                        <div class="card mb-4" style="border: 1px solid var(--hrgms-card-border); box-shadow: var(--hrgms-card-shadow);">
                            <div class="card-body">
                                <h5 class="card-title">Tag</h5>
                                <div class="d-flex flex-wrap gap-1">
                                    <?php foreach ($tags as $tag) : ?>
                                        <a href="<?php echo get_tag_link($tag->term_id); ?>" class="badge bg-secondary text-decoration-none">
                                            <?php echo esc_html($tag->name); ?>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                </aside>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
