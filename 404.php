<?php
/**
 * File: 404.php
 * Purpose: Template for 404 Not Found errors
 * Exposes: Error page with search and helpful links
 * Notes: SEO - noindex page, user-friendly error handling
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<section class="hrgms-hero hrgms-hero-simple" style="min-height: 60vh; display: flex; align-items: center;">
    <div class="container text-center">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div style="font-size: 8rem; font-weight: 700; color: rgba(255,255,255,0.2); line-height: 1;">
                    404
                </div>
                <h1 class="hrgms-hero-title">Halaman Tidak Dijumpai</h1>
                <p class="hrgms-hero-subtitle">
                    Maaf, halaman yang anda cari tidak wujud atau telah dipindahkan.
                </p>
                
                <div class="mt-4">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-hrgms-primary btn-lg">
                        <i class="bi bi-house me-2"></i>Kembali ke Laman Utama
                    </a>
                </div>
                
                <!-- Search Form -->
                <div class="mt-5">
                    <p class="text-white-50 mb-3">Atau cuba cari apa yang anda perlukan:</p>
                    <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="d-flex justify-content-center">
                        <div class="input-group" style="max-width: 450px;">
                            <input type="search" name="s" class="form-control form-control-lg" placeholder="Cari di sini..." value="">
                            <button type="submit" class="btn btn-hrgms-primary btn-lg">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Helpful Links Section -->
<section class="hrgms-products">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card" style="border: 1px solid var(--hrgms-card-border); box-shadow: var(--hrgms-card-shadow);">
                    <div class="card-body p-4">
                        <h3 class="text-center mb-4">Pautan Berguna</h3>
                        
                        <div class="row">
                            <!-- Recent Posts -->
                            <div class="col-md-6 mb-4">
                                <h5><i class="bi bi-newspaper me-2" style="color: var(--hrgms-primary);"></i>Artikel Terkini</h5>
                                <ul class="list-unstyled">
                                    <?php
                                    $recent = new WP_Query(array(
                                        'posts_per_page' => 5,
                                        'post_status' => 'publish',
                                    ));
                                    if ($recent->have_posts()) :
                                    while ($recent->have_posts()) : $recent->the_post();
                                    ?>
                                        <li class="mb-2">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </li>
                                    <?php endwhile; endif; wp_reset_postdata(); ?>
                                </ul>
                            </div>
                            
                            <!-- Categories -->
                            <div class="col-md-6 mb-4">
                                <h5><i class="bi bi-folder me-2" style="color: var(--hrgms-primary);"></i>Kategori</h5>
                                <ul class="list-unstyled">
                                    <?php
                                    wp_list_categories(array(
                                        'title_li' => '',
                                        'number' => 5,
                                    ));
                                    ?>
                                </ul>
                            </div>
                        </div>
                        
                        <!-- Pages -->
                        <div class="mt-3 pt-3 border-top">
                            <h5><i class="bi bi-link-45deg me-2" style="color: var(--hrgms-primary);"></i>Halaman Utama</h5>
                            <div class="d-flex flex-wrap gap-2 mt-2">
                                <?php
                                $pages = get_pages(array('number' => 6));
                                foreach ($pages as $page) :
                                ?>
                                    <a href="<?php echo get_permalink($page->ID); ?>" class="btn btn-outline-secondary btn-sm">
                                        <?php echo esc_html($page->post_title); ?>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
