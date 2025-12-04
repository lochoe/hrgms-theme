<?php
/**
 * File: footer.php
 * Purpose: Theme footer template - 3 column footer, copyright, closing tags
 * Exposes: Footer with company info, quick links, contact details
 * Notes: SEO optimized, uses WordPress widgets and menu system
 */

if (!defined('ABSPATH')) {
    exit;
}
?>
</main><!-- #main-content -->

<!-- Footer -->
<footer class="hrgms-footer" role="contentinfo">
    <div class="container">
        <div class="row">
            <!-- Column 1: Brand Info -->
            <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                <div class="footer-logo">
                    <?php echo esc_html(get_bloginfo('name', 'display')); ?>
                </div>
                <p class="footer-desc">
                    <?php 
                    $description = get_bloginfo('description');
                    echo $description ? esc_html($description) : 'Portal maklumat terkini untuk anda.';
                    ?>
                </p>
            </div>
            
            <!-- Column 2: Quick Links - Uses WordPress Menu (Footer Menu) -->
            <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                <h5 class="footer-title">Pautan Pantas</h5>
                <?php
                if (has_nav_menu('footer-menu')) {
                    // Use footer menu if assigned
                    wp_nav_menu(array(
                        'theme_location' => 'footer-menu',
                        'container'      => false,
                        'menu_class'     => 'footer-links',
                        'depth'          => 1,
                    ));
                } else {
                    // Fallback: List pages
                    ?>
                    <ul class="footer-links">
                        <li><a href="<?php echo esc_url(home_url('/')); ?>">Laman Utama</a></li>
                        <?php
                        $pages = get_pages(array(
                            'sort_column' => 'menu_order',
                            'sort_order'  => 'ASC',
                            'number'      => 5,
                        ));
                        foreach ($pages as $page) :
                            if ($page->ID == get_option('page_on_front')) continue;
                        ?>
                            <li><a href="<?php echo get_permalink($page->ID); ?>"><?php echo esc_html($page->post_title); ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                    <?php
                }
                ?>
            </div>
            
            <!-- Column 3: Contact Info or Widget -->
            <div class="col-lg-4 col-md-12">
                <h5 class="footer-title">Hubungi Kami</h5>
                <?php if (is_active_sidebar('footer-3')) : ?>
                    <?php dynamic_sidebar('footer-3'); ?>
                <?php else : ?>
                    <div class="footer-contact">
                        <p>
                            <i class="bi bi-envelope"></i>
                            Email: <?php echo antispambot(get_option('admin_email')); ?>
                        </p>
                        <p>
                            <i class="bi bi-globe"></i>
                            Web: <?php echo esc_url(home_url('/')); ?>
                        </p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?> - Semua Hak Cipta Terpelihara</p>
            <p class="footer-disclaimer">
                <?php
                // Get privacy policy link if set
                $privacy_policy_id = get_option('wp_page_for_privacy_policy');
                if ($privacy_policy_id) :
                ?>
                    <a href="<?php echo get_permalink($privacy_policy_id); ?>">Dasar Privasi</a> |
                <?php endif; ?>
                Maklumat yang dipaparkan adalah untuk rujukan sahaja.
            </p>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
