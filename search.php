<?php
/**
 * File: search.php
 * Purpose: Template for search results
 * Exposes: Search results listing with post cards
 * Notes: SEO optimized - noindex for search pages
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<!-- Search Header -->
<header class="hrgms-hero hrgms-hero-simple" style="padding: 40px 0;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <div class="mb-3">
                    <i class="bi bi-search" style="font-size: 3rem; opacity: 0.5;"></i>
                </div>
                <h1 class="hrgms-hero-title">Hasil Carian</h1>
                <p class="hrgms-hero-subtitle">
                    Carian untuk: <strong>"<?php echo esc_html(get_search_query()); ?>"</strong>
                </p>
                <?php
                global $wp_query;
                if ($wp_query->found_posts > 0) :
                ?>
                    <p class="hrgms-hero-subtitle" style="opacity: 0.8;">
                        <?php printf(__('%d hasil dijumpai', 'hrgms-theme'), $wp_query->found_posts); ?>
                    </p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</header>

<section class="hrgms-products">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <?php if (have_posts()) : ?>
                    
                    <div class="row g-4">
                        <?php while (have_posts()) : the_post(); ?>
                            <div class="col-md-6">
                                <article <?php post_class('product-card h-100'); ?>>
                                    <?php if (has_post_thumbnail()) : ?>
                                        <div class="product-image">
                                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                                <?php the_post_thumbnail('medium', array('class' => 'img-fluid', 'loading' => 'lazy')); ?>
                                            </a>
                                            <span class="product-badge">
                                                <?php echo get_post_type_object(get_post_type())->labels->singular_name; ?>
                                            </span>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <div class="product-body">
                                        <h2 class="product-title">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h2>
                                        <div class="product-meta">
                                            <i class="bi bi-calendar"></i> <?php echo get_the_date(); ?>
                                        </div>
                                        <p class="text-muted small">
                                            <?php echo wp_trim_words(get_the_excerpt(), 15, '...'); ?>
                                        </p>
                                        <a href="<?php the_permalink(); ?>" class="btn btn-product">
                                            Baca Lagi
                                        </a>
                                    </div>
                                </article>
                            </div>
                        <?php endwhile; ?>
                    </div>
                    
                    <!-- Pagination -->
                    <nav class="mt-5" aria-label="<?php esc_attr_e('Search results navigation', 'hrgms-theme'); ?>">
                        <?php
                        the_posts_pagination(array(
                            'mid_size'  => 2,
                            'prev_text' => '<i class="bi bi-chevron-left"></i> Sebelum',
                            'next_text' => 'Seterusnya <i class="bi bi-chevron-right"></i>',
                        ));
                        ?>
                    </nav>
                    
                <?php else : ?>
                    
                    <div class="card" style="border: 1px solid var(--hrgms-card-border); box-shadow: var(--hrgms-card-shadow);">
                        <div class="card-body text-center p-5">
                            <i class="bi bi-emoji-frown" style="font-size: 4rem; color: var(--hrgms-primary);"></i>
                            <h3 class="mt-3">Tiada Hasil Dijumpai</h3>
                            <p class="text-muted">
                                Maaf, tiada hasil dijumpai untuk "<strong><?php echo esc_html(get_search_query()); ?></strong>".
                            </p>
                            <p class="text-muted">Cuba carian lain atau lihat cadangan di bawah.</p>
                            
                            <!-- Search Again -->
                            <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="mt-4">
                                <div class="input-group mx-auto" style="max-width: 400px;">
                                    <input type="search" name="s" class="form-control" placeholder="Cuba carian lain..." value="">
                                    <button type="submit" class="btn btn-hrgms-secondary">
                                        <i class="bi bi-search"></i> Cari
                                    </button>
                                </div>
                            </form>
                            
                            <div class="mt-4">
                                <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-hrgms-primary">
                                    <i class="bi bi-house me-2"></i>Kembali ke Laman Utama
                                </a>
                            </div>
                        </div>
                    </div>
                    
                <?php endif; ?>
            </div>
            
            <!-- Sidebar -->
            <div class="col-lg-4">
                <aside class="sidebar" role="complementary">
                    <!-- Search Again -->
                    <div class="card mb-4" style="border: 1px solid var(--hrgms-card-border); box-shadow: var(--hrgms-card-shadow);">
                        <div class="card-body">
                            <h5 class="card-title">Cari Lagi</h5>
                            <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
                                <div class="input-group">
                                    <input type="search" name="s" class="form-control" placeholder="Kata kunci..." value="<?php echo esc_attr(get_search_query()); ?>">
                                    <button type="submit" class="btn btn-hrgms-secondary">
                                        <i class="bi bi-search"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                    <!-- Popular Posts -->
                    <div class="card mb-4" style="border: 1px solid var(--hrgms-card-border); box-shadow: var(--hrgms-card-shadow);">
                        <div class="card-body">
                            <h5 class="card-title">Artikel Popular</h5>
                            <ul class="list-unstyled mb-0">
                                <?php
                                $popular = new WP_Query(array(
                                    'posts_per_page' => 5,
                                    'orderby' => 'comment_count',
                                    'order' => 'DESC',
                                    'post_status' => 'publish',
                                ));
                                if ($popular->have_posts()) :
                                while ($popular->have_posts()) : $popular->the_post();
                                ?>
                                    <li class="mb-2">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </li>
                                <?php endwhile; endif; wp_reset_postdata(); ?>
                            </ul>
                        </div>
                    </div>
                    
                    <!-- Categories -->
                    <div class="card mb-4" style="border: 1px solid var(--hrgms-card-border); box-shadow: var(--hrgms-card-shadow);">
                        <div class="card-body">
                            <h5 class="card-title">Kategori</h5>
                            <ul class="list-unstyled mb-0">
                                <?php wp_list_categories(array('title_li' => '')); ?>
                            </ul>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
