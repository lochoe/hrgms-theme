<?php
/**
 * File: page.php
 * Purpose: Template for single pages
 * Notes: Yoast SEO compatible - no duplicate meta tags, proper structure
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<article <?php post_class(); ?>>
    
    <!-- Page Header -->
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
                            // Show parent pages in breadcrumb
                            $ancestors = get_post_ancestors(get_the_ID());
                            if ($ancestors) :
                                $ancestors = array_reverse($ancestors);
                                foreach ($ancestors as $ancestor) :
                            ?>
                                <li class="breadcrumb-item">
                                    <a href="<?php echo get_permalink($ancestor); ?>" style="color: rgba(255,255,255,0.8);">
                                        <?php echo get_the_title($ancestor); ?>
                                    </a>
                                </li>
                            <?php 
                                endforeach;
                            endif; 
                            ?>
                            <li class="breadcrumb-item active" aria-current="page" style="color: #fff;">
                                <?php the_title(); ?>
                            </li>
                        </ol>
                    </nav>
                    
                    <h1 class="hrgms-hero-title"><?php the_title(); ?></h1>
                    
                    <?php if (has_excerpt()) : ?>
                        <p class="hrgms-hero-subtitle"><?php the_excerpt(); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header>
    
    <section class="hrgms-products">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    
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
                    
                    <!-- Page Content -->
                    <div class="page-content card" style="border: 1px solid var(--hrgms-card-border); box-shadow: var(--hrgms-card-shadow);">
                        <div class="card-body p-4 p-lg-5">
                            <?php the_content(); ?>
                            
                            <?php
                            // Pagination for multi-page content
                            wp_link_pages(array(
                                'before' => '<nav class="page-links mt-4 pt-4 border-top"><span class="page-links-title">' . __('Halaman:', 'hrgms-theme') . '</span>',
                                'after'  => '</nav>',
                                'link_before' => '<span class="badge bg-primary mx-1">',
                                'link_after'  => '</span>',
                            ));
                            ?>
                        </div>
                    </div>
                    
                    <!-- Last Modified -->
                    <div class="text-center mt-4 text-muted small">
                        <i class="bi bi-clock-history me-1"></i>
                        Dikemaskini: <?php echo get_the_modified_date(); ?>
                    </div>
                    
                    <!-- Child Pages (if any) -->
                    <?php
                    $child_pages = get_pages(array(
                        'parent' => get_the_ID(),
                        'sort_column' => 'menu_order',
                    ));
                    
                    if (!empty($child_pages)) :
                    ?>
                        <div class="child-pages mt-5">
                            <h3 class="mb-4">Halaman Berkaitan</h3>
                            <div class="row g-4">
                                <?php foreach ($child_pages as $child) : 
                                    $child_thumb = hrgms_get_first_image($child->ID);
                                ?>
                                    <div class="col-md-4">
                                        <div class="product-card h-100">
                                            <div class="product-image">
                                                <a href="<?php echo get_permalink($child->ID); ?>">
                                                    <?php if ($child_thumb) : ?>
                                                        <img src="<?php echo esc_url($child_thumb); ?>" alt="<?php echo esc_attr($child->post_title); ?>" class="img-fluid">
                                                    <?php else : ?>
                                                        <img src="https://via.placeholder.com/300x200/1e3a5f/ffffff?text=<?php echo urlencode(substr($child->post_title, 0, 10)); ?>" alt="" class="img-fluid">
                                                    <?php endif; ?>
                                                </a>
                                            </div>
                                            <div class="product-body">
                                                <h4 class="product-title">
                                                    <a href="<?php echo get_permalink($child->ID); ?>"><?php echo esc_html($child->post_title); ?></a>
                                                </h4>
                                                <a href="<?php echo get_permalink($child->ID); ?>" class="btn btn-product">Lihat</a>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <!-- Comments -->
                    <?php if (comments_open() || get_comments_number()) : ?>
                        <div class="comments-area mt-5">
                            <?php comments_template(); ?>
                        </div>
                    <?php endif; ?>
                    
                </div>
            </div>
        </div>
    </section>
</article>

<?php endwhile; endif; ?>

<?php get_footer(); ?>
