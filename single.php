<?php
/**
 * File: single.php
 * Purpose: Template for single posts/articles
 * Notes: Yoast SEO compatible - no duplicate meta tags, proper structure for Yoast
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<article <?php post_class('hrgms-single-post'); ?>>
    
    <!-- Article Header -->
    <header class="hrgms-hero hrgms-hero-simple" style="padding: 40px 0;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb" class="mb-3">
                        <ol class="breadcrumb justify-content-center" style="background: transparent;">
                            <li class="breadcrumb-item">
                                <a href="<?php echo esc_url(home_url('/')); ?>" style="color: rgba(255,255,255,0.8);">
                                    <i class="bi bi-house"></i> Laman Utama
                                </a>
                            </li>
                            <?php
                            $categories = get_the_category();
                            if (!empty($categories)) :
                            ?>
                                <li class="breadcrumb-item">
                                    <a href="<?php echo get_category_link($categories[0]->term_id); ?>" style="color: rgba(255,255,255,0.8);">
                                        <?php echo esc_html($categories[0]->name); ?>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <li class="breadcrumb-item active" aria-current="page" style="color: #fff;">
                                <?php the_title(); ?>
                            </li>
                        </ol>
                    </nav>
                    
                    <!-- Categories badges -->
                    <?php if (!empty($categories)) : ?>
                        <div class="mb-3">
                            <?php foreach ($categories as $cat) : ?>
                                <a href="<?php echo get_category_link($cat->term_id); ?>" class="badge text-decoration-none" style="background: rgba(255,255,255,0.2); color: #fff;">
                                    <?php echo esc_html($cat->name); ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    
                    <h1 class="hrgms-hero-title"><?php the_title(); ?></h1>
                    
                    <div class="hrgms-hero-subtitle">
                        <span>
                            <i class="bi bi-person me-1"></i><?php the_author(); ?>
                        </span>
                        <span class="mx-2">•</span>
                        <span>
                            <i class="bi bi-calendar me-1"></i><?php echo get_the_date(); ?>
                        </span>
                        <span class="mx-2">•</span>
                        <span>
                            <i class="bi bi-clock me-1"></i><?php echo hrgms_reading_time(); ?> min baca
                        </span>
                        <?php if (get_comments_number() > 0) : ?>
                            <span class="mx-2">•</span>
                            <span>
                                <i class="bi bi-chat me-1"></i><?php echo get_comments_number(); ?> komen
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </header>
    
    <section class="hrgms-products">
        <div class="container">
            <div class="row">
                <!-- Main Content -->
                <div class="col-lg-8">
                    
                    <!-- Featured Image -->
                    <?php 
                    $thumb = hrgms_get_first_image(get_the_ID());
                    if ($thumb) : 
                    ?>
                        <figure class="mb-4">
                            <img src="<?php echo esc_url($thumb); ?>" 
                                 alt="<?php the_title_attribute(); ?>" 
                                 class="img-fluid rounded shadow w-100">
                            <?php
                            $caption = get_the_post_thumbnail_caption();
                            if ($caption) :
                            ?>
                                <figcaption class="text-muted text-center mt-2 small"><?php echo esc_html($caption); ?></figcaption>
                            <?php endif; ?>
                        </figure>
                    <?php endif; ?>
                    
                    <!-- Post Content -->
                    <div class="post-content card" style="border: 1px solid var(--hrgms-card-border); box-shadow: var(--hrgms-card-shadow);">
                        <div class="card-body p-4">
                            <?php the_content(); ?>
                            
                            <?php
                            // Pagination for multi-page posts
                            wp_link_pages(array(
                                'before' => '<nav class="page-links mt-4 pt-4 border-top"><span class="page-links-title">' . __('Halaman:', 'hrgms-theme') . '</span>',
                                'after'  => '</nav>',
                                'link_before' => '<span class="badge bg-primary mx-1">',
                                'link_after'  => '</span>',
                            ));
                            ?>
                        </div>
                    </div>
                    
                    <!-- Tags -->
                    <?php if (has_tag()) : ?>
                        <div class="post-tags mt-4">
                            <i class="bi bi-tags me-2"></i>
                            <?php the_tags('<span class="badge bg-secondary me-1">', '</span><span class="badge bg-secondary me-1">', '</span>'); ?>
                        </div>
                    <?php endif; ?>
                    
                    <!-- Post Navigation -->
                    <nav class="post-navigation mt-5 pt-4 border-top" aria-label="<?php esc_attr_e('Post navigation', 'hrgms-theme'); ?>">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <?php
                                $prev_post = get_previous_post();
                                if (!empty($prev_post)) :
                                    $prev_thumb = hrgms_get_first_image($prev_post->ID);
                                ?>
                                    <a href="<?php echo get_permalink($prev_post->ID); ?>" class="text-decoration-none d-block p-3 rounded h-100" style="background: var(--hrgms-body-bg);">
                                        <small class="text-muted"><i class="bi bi-arrow-left"></i> Artikel Sebelum</small>
                                        <div class="d-flex align-items-center mt-2">
                                            <?php if ($prev_thumb) : ?>
                                                <img src="<?php echo esc_url($prev_thumb); ?>" alt="" class="rounded me-2" style="width: 50px; height: 50px; object-fit: cover;">
                                            <?php endif; ?>
                                            <p class="mb-0 fw-bold small"><?php echo esc_html($prev_post->post_title); ?></p>
                                        </div>
                                    </a>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-6">
                                <?php
                                $next_post = get_next_post();
                                if (!empty($next_post)) :
                                    $next_thumb = hrgms_get_first_image($next_post->ID);
                                ?>
                                    <a href="<?php echo get_permalink($next_post->ID); ?>" class="text-decoration-none d-block p-3 rounded h-100 text-end" style="background: var(--hrgms-body-bg);">
                                        <small class="text-muted">Artikel Seterusnya <i class="bi bi-arrow-right"></i></small>
                                        <div class="d-flex align-items-center justify-content-end mt-2">
                                            <p class="mb-0 fw-bold small"><?php echo esc_html($next_post->post_title); ?></p>
                                            <?php if ($next_thumb) : ?>
                                                <img src="<?php echo esc_url($next_thumb); ?>" alt="" class="rounded ms-2" style="width: 50px; height: 50px; object-fit: cover;">
                                            <?php endif; ?>
                                        </div>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </nav>
                    
                    <!-- Author Box -->
                    <div class="author-box mt-5 p-4 rounded" style="background: var(--hrgms-body-bg);">
                        <div class="d-flex">
                            <?php echo get_avatar(get_the_author_meta('ID'), 80, '', '', array('class' => 'rounded-circle me-3')); ?>
                            <div>
                                <h5 class="mb-1">Ditulis oleh <?php the_author(); ?></h5>
                                <p class="mb-2 text-muted small"><?php echo get_the_author_meta('description') ?: 'Penulis di ' . get_bloginfo('name'); ?></p>
                                <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" class="btn btn-sm btn-outline-secondary">
                                    Lihat Semua Artikel <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Comments -->
                    <?php if (comments_open() || get_comments_number()) : ?>
                        <div class="comments-area mt-5">
                            <?php comments_template(); ?>
                        </div>
                    <?php endif; ?>
                    
                </div>
                
                <!-- Sidebar -->
                <div class="col-lg-4">
                    <aside class="sidebar" role="complementary">
                        
                        <!-- Related Posts -->
                        <?php
                        // Store current post ID before related posts query
                        $current_post_id = get_the_ID();
                        $main_categories = get_the_category($current_post_id);
                        
                        if (!empty($main_categories)) :
                            $related_posts = new WP_Query(array(
                                'category__in'   => wp_list_pluck($main_categories, 'term_id'),
                                'post__not_in'   => array($current_post_id),
                                'posts_per_page' => 4,
                                'post_status'    => 'publish',
                            ));
                            
                            if ($related_posts->have_posts()) :
                        ?>
                            <div class="card mb-4" style="border: 1px solid var(--hrgms-card-border); box-shadow: var(--hrgms-card-shadow);">
                                <div class="card-body">
                                    <h5 class="card-title">Artikel Berkaitan</h5>
                                    <?php while ($related_posts->have_posts()) : $related_posts->the_post(); 
                                        $rel_thumb = hrgms_get_first_image(get_the_ID());
                                    ?>
                                        <div class="d-flex mb-3 pb-3 border-bottom">
                                            <?php if ($rel_thumb) : ?>
                                                <img src="<?php echo esc_url($rel_thumb); ?>" alt="" class="rounded me-2" style="width: 60px; height: 60px; object-fit: cover;">
                                            <?php endif; ?>
                                            <div>
                                                <a href="<?php the_permalink(); ?>" class="text-decoration-none">
                                                    <strong class="d-block small"><?php the_title(); ?></strong>
                                                </a>
                                                <small class="text-muted"><?php echo get_the_date(); ?></small>
                                            </div>
                                        </div>
                                    <?php endwhile; ?>
                                </div>
                            </div>
                        <?php 
                            endif;
                            wp_reset_postdata(); // Reset after related posts loop
                        endif; 
                        ?>
                        
                        <!-- Categories -->
                        <div class="card mb-4" style="border: 1px solid var(--hrgms-card-border); box-shadow: var(--hrgms-card-shadow);">
                            <div class="card-body">
                                <h5 class="card-title">Kategori</h5>
                                <ul class="list-unstyled mb-0">
                                    <?php wp_list_categories(array('title_li' => '', 'show_count' => true)); ?>
                                </ul>
                            </div>
                        </div>
                        
                        <!-- Popular Tags -->
                        <?php
                        $tags = get_tags(array('number' => 15, 'orderby' => 'count', 'order' => 'DESC'));
                        if (!empty($tags)) :
                        ?>
                            <div class="card mb-4" style="border: 1px solid var(--hrgms-card-border); box-shadow: var(--hrgms-card-shadow);">
                                <div class="card-body">
                                    <h5 class="card-title">Tag Popular</h5>
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
</article>

<?php endwhile; endif; ?>

<?php get_footer(); ?>
