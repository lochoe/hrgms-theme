<?php
/**
 * File: archive.php
 * Purpose: Template for archive pages (categories, tags, dates, authors)
 * Notes: 10 posts per page with thumbnails, Yoast SEO compatible
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<!-- Archive Header -->
<header class="hrgms-hero hrgms-hero-simple" style="padding: 40px 0;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <?php hrgms_breadcrumb(); ?>
                
                <?php
                $archive_icon = 'bi-folder';
                if (is_category()) {
                    $archive_icon = 'bi-folder';
                } elseif (is_tag()) {
                    $archive_icon = 'bi-tag';
                } elseif (is_author()) {
                    $archive_icon = 'bi-person';
                } elseif (is_date()) {
                    $archive_icon = 'bi-calendar';
                }
                ?>
                <div class="mb-2">
                    <span class="badge" style="background: rgba(255,255,255,0.2); font-size: 1rem; padding: 10px 20px;">
                        <i class="bi <?php echo $archive_icon; ?> me-2"></i>
                        <?php
                        if (is_category()) {
                            _e('Kategori', 'hrgms-theme');
                        } elseif (is_tag()) {
                            _e('Tag', 'hrgms-theme');
                        } elseif (is_author()) {
                            _e('Pengarang', 'hrgms-theme');
                        } elseif (is_date()) {
                            _e('Arkib', 'hrgms-theme');
                        } else {
                            _e('Arkib', 'hrgms-theme');
                        }
                        ?>
                    </span>
                </div>
                
                <?php the_archive_title('<h1 class="hrgms-hero-title">', '</h1>'); ?>
                
                <?php
                $description = get_the_archive_description();
                if ($description) :
                ?>
                    <p class="hrgms-hero-subtitle"><?php echo wp_strip_all_tags($description); ?></p>
                <?php endif; ?>
                
                <p class="hrgms-hero-subtitle" style="opacity: 0.8;">
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
                                                <img src="https://via.placeholder.com/300x200/1e3a5f/ffffff?text=<?php echo urlencode(substr(get_the_title(), 0, 15)); ?>" 
                                                     alt="<?php the_title_attribute(); ?>" 
                                                     class="img-fluid"
                                                     loading="lazy">
                                            <?php endif; ?>
                                        </a>
                                        <?php
                                        $categories = get_the_category();
                                        if (!empty($categories) && !is_category()) :
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
                                        <p class="text-muted small mt-2"><?php echo wp_trim_words(get_the_excerpt(), 12, '...'); ?></p>
                                        <a href="<?php the_permalink(); ?>" class="btn btn-product">
                                            Baca Lagi <i class="bi bi-arrow-right"></i>
                                        </a>
                                    </div>
                                </article>
                            </div>
                        <?php endwhile; ?>
                    </div>
                    
                    <!-- Pagination -->
                    <nav class="mt-5" aria-label="<?php esc_attr_e('Archive navigation', 'hrgms-theme'); ?>">
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
                        <p>Tiada artikel dijumpai dalam arkib ini.</p>
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-hrgms-primary">
                            <i class="bi bi-house me-2"></i>Kembali ke Laman Utama
                        </a>
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
                                    <input type="search" name="s" class="form-control" placeholder="Cari artikel...">
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
                                <?php wp_list_categories(array('title_li' => '', 'show_count' => true)); ?>
                            </ul>
                        </div>
                    </div>
                    
                    <!-- Monthly Archives -->
                    <div class="card mb-4" style="border: 1px solid var(--hrgms-card-border); box-shadow: var(--hrgms-card-shadow);">
                        <div class="card-body">
                            <h5 class="card-title">Arkib Bulanan</h5>
                            <ul class="list-unstyled mb-0">
                                <?php wp_get_archives(array('type' => 'monthly', 'limit' => 12)); ?>
                            </ul>
                        </div>
                    </div>
                    
                </aside>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
