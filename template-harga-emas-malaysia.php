<?php
/**
 * File: template-harga-emas-malaysia.php
 * Purpose: SEO-optimized page for Harga Emas Malaysia with live data from APIs
 * URL: /harga-emas-malaysia/
 * Notes: Includes structured data, comprehensive SEO content, and live price data
 */

if (!defined('ABSPATH')) {
    exit;
}

// Fetch data from APIs
$gold_prices = hrgms_fetch_gold_prices();
$ar_rahnu_prices = hrgms_fetch_ar_rahnu_prices();

// Get current date for SEO
$current_date = date('d F Y');
$current_year = date('Y');

get_header();
?>

<!-- Structured Data for SEO (JSON-LD) -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebPage",
  "name": "Harga Emas Malaysia <?php echo $current_year; ?> - Harga Emas Terkini Hari Ini",
  "description": "Dapatkan harga emas Malaysia terkini hari ini. Harga emas 999, 916, 835, 750 per gram. Harga Ar-Rahnu, harga emas Public Gold, dan maklumat lengkap harga emas di Malaysia.",
  "url": "<?php echo esc_url(home_url('/harga-emas-malaysia/')); ?>",
  "mainEntity": {
    "@type": "FAQPage",
    "mainEntity": [
      {
        "@type": "Question",
        "name": "Berapa harga emas 999 Malaysia hari ini?",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "Harga emas 999 Malaysia hari ini adalah sekitar <?php echo $gold_prices ? hrgms_format_currency($gold_prices['prices']['MksBuy'] / 100) : 'RM 55-57'; ?> per gram untuk belian dan <?php echo $gold_prices ? hrgms_format_currency($gold_prices['prices']['MksSell'] / 100) : 'RM 56-58'; ?> per gram untuk jualan."
        }
      },
      {
        "@type": "Question",
        "name": "Di mana boleh beli emas di Malaysia?",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "Anda boleh beli emas di Public Gold, Kedai Emas Anuar, Kedai Emas Habib, Ar-Rahnu bank, dan kedai emas berlesen di seluruh Malaysia."
        }
      },
      {
        "@type": "Question",
        "name": "Apakah perbezaan emas 999, 916, dan 835?",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "Emas 999 adalah emas tulen (99.9%), emas 916 adalah 91.6% emas (22 karat), dan emas 835 adalah 83.5% emas (20 karat). Harga berbeza mengikut kandungan emas."
        }
      }
    ]
  },
  "breadcrumb": {
    "@type": "BreadcrumbList",
    "itemListElement": [
      {
        "@type": "ListItem",
        "position": 1,
        "name": "Laman Utama",
        "item": "<?php echo esc_url(home_url('/')); ?>"
      },
      {
        "@type": "ListItem",
        "position": 2,
        "name": "Harga Emas Malaysia",
        "item": "<?php echo esc_url(home_url('/harga-emas-malaysia/')); ?>"
      }
    ]
  }
}
</script>

<!-- Hero Section -->
<header class="hrgms-hero hrgms-hero-bg" style="padding: 60px 0;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center">
                <?php hrgms_breadcrumb(); ?>
                <h1 class="hrgms-hero-title" style="font-size: 2.5rem; margin-bottom: 1rem;">
                    <i class="bi bi-graph-up-arrow me-2"></i>Harga Emas Malaysia <?php echo $current_year; ?>
                </h1>
                <p class="hrgms-hero-subtitle" style="font-size: 1.2rem; margin-bottom: 0.5rem;">
                    Harga Emas Terkini Hari Ini - <?php echo $current_date; ?>
                </p>
                <?php if ($gold_prices && isset($gold_prices['prices'])) : ?>
                <div class="mt-4">
                    <div class="row justify-content-center g-3">
                        <div class="col-6 col-md-3">
                            <div class="card" style="background: rgba(255,255,255,0.95); border: 2px solid #f39c12;">
                                <div class="card-body text-center p-3">
                                    <small class="text-muted d-block mb-1">Harga Beli 999</small>
                                    <strong class="text-primary" style="font-size: 1.3rem;">
                                        <?php echo hrgms_format_price_per_gram($gold_prices['prices']['MksBuy']); ?>
                                    </strong>
                                    <small class="text-muted d-block mt-1">per gram</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="card" style="background: rgba(255,255,255,0.95); border: 2px solid #e67e22;">
                                <div class="card-body text-center p-3">
                                    <small class="text-muted d-block mb-1">Harga Jual 999</small>
                                    <strong class="text-danger" style="font-size: 1.3rem;">
                                        <?php echo hrgms_format_price_per_gram($gold_prices['prices']['MksSell']); ?>
                                    </strong>
                                    <small class="text-muted d-block mt-1">per gram</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if (isset($gold_prices['lastUpdate'])) : ?>
                    <p class="text-white-50 mt-3 small">
                        <i class="bi bi-clock me-1"></i>Dikemaskini: <?php echo date('d M Y, H:i', strtotime($gold_prices['lastUpdate'])); ?>
                    </p>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</header>

<!-- Main Content Section -->
<section class="hrgms-products" style="padding: 60px 0;">
    <div class="container">
        
        <!-- SEO Content Section -->
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto">
                <article class="card" style="border: 1px solid var(--hrgms-card-border); box-shadow: var(--hrgms-card-shadow);">
                    <div class="card-body p-4 p-lg-5">
                        
                        <!-- Introduction -->
                        <div class="mb-4">
                            <h2 class="h3 mb-3">Harga Emas Malaysia <?php echo $current_year; ?> - Panduan Lengkap</h2>
                            <p class="lead">
                                Dapatkan maklumat terkini tentang <strong>harga emas Malaysia</strong> hari ini. Laman ini menyediakan 
                                harga emas terkini termasuk harga emas 999, 916, 835, dan 750 per gram. Kami juga menyediakan 
                                maklumat lengkap tentang <strong>harga Ar-Rahnu</strong> dari pelbagai institusi kewangan di Malaysia.
                            </p>
                        </div>

                        <!-- Current Gold Prices Table -->
                        <?php if ($gold_prices && isset($gold_prices['prices'])) : ?>
                        <div class="mb-5">
                            <h3 class="h4 mb-3"><i class="bi bi-table me-2"></i>Harga Emas Malaysia Hari Ini</h3>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Jenis Emas</th>
                                            <th class="text-end">Harga Beli (RM/gram)</th>
                                            <th class="text-end">Harga Jual (RM/gram)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><strong>Emas 999 (24K)</strong><br><small class="text-muted">Emas Tulen</small></td>
                                            <td class="text-end"><strong class="text-primary"><?php echo hrgms_format_price_per_gram($gold_prices['prices']['MksBuy']); ?></strong></td>
                                            <td class="text-end"><strong class="text-danger"><?php echo hrgms_format_price_per_gram($gold_prices['prices']['MksSell']); ?></strong></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Emas Tael</strong><br><small class="text-muted">37.5 gram</small></td>
                                            <td class="text-end"><?php echo hrgms_format_currency($gold_prices['prices']['TaelBuy']); ?></td>
                                            <td class="text-end"><?php echo hrgms_format_currency($gold_prices['prices']['TaelSell']); ?></td>
                                        </tr>
                                        <?php if (isset($gold_prices['prices']['SilverBuy'])) : ?>
                                        <tr>
                                            <td><strong>Perak (Silver)</strong></td>
                                            <td class="text-end"><?php echo hrgms_format_currency($gold_prices['prices']['SilverBuy']); ?></td>
                                            <td class="text-end"><?php echo hrgms_format_currency($gold_prices['prices']['SilverSell']); ?></td>
                                        </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                            <p class="text-muted small mt-2">
                                <i class="bi bi-info-circle me-1"></i>Harga adalah anggaran dan mungkin berbeza mengikut kedai emas. 
                                Sila hubungi kedai emas berlesen untuk harga terkini.
                            </p>
                        </div>
                        <?php endif; ?>

                        <!-- SEO Content: Understanding Gold Prices -->
                        <div class="mb-5">
                            <h3 class="h4 mb-3">Memahami Harga Emas di Malaysia</h3>
                            <p>
                                <strong>Harga emas Malaysia</strong> ditentukan oleh beberapa faktor termasuk harga emas antarabangsa, 
                                kadar tukaran mata wang, dan permintaan tempatan. Harga emas biasanya dinyatakan dalam <strong>RM per gram</strong> 
                                atau <strong>RM per 100 gram</strong>.
                            </p>
                            
                            <h4 class="h5 mt-4 mb-3">Jenis-jenis Emas di Malaysia:</h4>
                            <ul>
                                <li><strong>Emas 999 (24 Karat)</strong> - Emas tulen dengan kandungan 99.9% emas. Ini adalah emas paling bernilai.</li>
                                <li><strong>Emas 916 (22 Karat)</strong> - Kandungan 91.6% emas, popular untuk barang kemas.</li>
                                <li><strong>Emas 835 (20 Karat)</strong> - Kandungan 83.5% emas, lebih tahan lasak.</li>
                                <li><strong>Emas 750 (18 Karat)</strong> - Kandungan 75% emas, biasa digunakan dalam perhiasan.</li>
                            </ul>
                        </div>

                        <!-- Ar-Rahnu Section -->
                        <?php if ($ar_rahnu_prices && isset($ar_rahnu_prices['arRahnu'])) : ?>
                        <div class="mb-5">
                            <h3 class="h4 mb-3"><i class="bi bi-bank me-2"></i>Harga Ar-Rahnu di Malaysia</h3>
                            <p>
                                <strong>Ar-Rahnu</strong> adalah sistem pajak gadai Islam yang membolehkan anda mendapatkan pinjaman dengan 
                                menggunakan emas sebagai cagaran. Berikut adalah harga Ar-Rahnu dari pelbagai institusi di Malaysia:
                            </p>
                            
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Institusi</th>
                                            <th class="text-end">750</th>
                                            <th class="text-end">835</th>
                                            <th class="text-end">875</th>
                                            <th class="text-end">916</th>
                                            <th class="text-end">950</th>
                                            <th class="text-end">999</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $ar_rahnu_list = $ar_rahnu_prices['arRahnu'];
                                        // Show top 5 for better UX
                                        $top_ar_rahnu = array_slice($ar_rahnu_list, 0, 5);
                                        foreach ($top_ar_rahnu as $institution) : 
                                        ?>
                                        <tr>
                                            <td>
                                                <strong><?php echo esc_html($institution['name']); ?></strong>
                                            </td>
                                            <td class="text-end"><?php echo isset($institution['prices']['750']) ? hrgms_format_currency($institution['prices']['750'] / 100) : '-'; ?></td>
                                            <td class="text-end"><?php echo isset($institution['prices']['835']) ? hrgms_format_currency($institution['prices']['835'] / 100) : '-'; ?></td>
                                            <td class="text-end"><?php echo isset($institution['prices']['875']) ? hrgms_format_currency($institution['prices']['875'] / 100) : '-'; ?></td>
                                            <td class="text-end"><?php echo isset($institution['prices']['916']) ? hrgms_format_currency($institution['prices']['916'] / 100) : '-'; ?></td>
                                            <td class="text-end"><?php echo isset($institution['prices']['950']) ? hrgms_format_currency($institution['prices']['950'] / 100) : '-'; ?></td>
                                            <td class="text-end"><strong><?php echo isset($institution['prices']['999']) ? hrgms_format_currency($institution['prices']['999'] / 100) : '-'; ?></strong></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <p class="text-muted small mt-2">
                                <i class="bi bi-info-circle me-1"></i>Harga Ar-Rahnu adalah per 100 gram. Harga mungkin berbeza mengikut cawangan.
                            </p>
                        </div>
                        <?php endif; ?>

                        <!-- SEO Content: Tips and Information -->
                        <div class="mb-4">
                            <h3 class="h4 mb-3">Tips Membeli dan Menjual Emas di Malaysia</h3>
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="card h-100" style="border: 1px solid #e0e0e0;">
                                        <div class="card-body">
                                            <h5 class="card-title"><i class="bi bi-check-circle text-success me-2"></i>Tips Membeli Emas</h5>
                                            <ul class="mb-0">
                                                <li>Beli dari kedai emas berlesen dan dipercayai</li>
                                                <li>Periksa sijil autentikasi emas</li>
                                                <li>Bandingkan harga dari beberapa kedai</li>
                                                <li>Fahami perbezaan harga beli dan jual</li>
                                                <li>Simpan resit pembelian dengan selamat</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card h-100" style="border: 1px solid #e0e0e0;">
                                        <div class="card-body">
                                            <h5 class="card-title"><i class="bi bi-info-circle text-info me-2"></i>Faktor Mempengaruhi Harga</h5>
                                            <ul class="mb-0">
                                                <li>Harga emas antarabangsa (spot price)</li>
                                                <li>Kadar tukaran USD/MYR</li>
                                                <li>Permintaan dan penawaran tempatan</li>
                                                <li>Kos pengeluaran dan overhead</li>
                                                <li>Margin keuntungan kedai</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- SEO Content: Frequently Asked Questions -->
                        <div class="mb-4">
                            <h3 class="h4 mb-3">Soalan Lazim (FAQ) Tentang Harga Emas Malaysia</h3>
                            <div class="accordion" id="faqAccordion">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                            Berapa harga emas 999 per gram di Malaysia hari ini?
                                        </button>
                                    </h2>
                                    <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                                        <div class="accordion-body">
                                            Harga emas 999 per gram di Malaysia hari ini adalah sekitar 
                                            <?php echo $gold_prices ? hrgms_format_price_per_gram($gold_prices['prices']['MksBuy']) : 'RM 55-57'; ?> 
                                            untuk belian dan <?php echo $gold_prices ? hrgms_format_price_per_gram($gold_prices['prices']['MksSell']) : 'RM 56-58'; ?> 
                                            untuk jualan. Harga ini berubah mengikut harga emas antarabangsa dan kadar tukaran mata wang.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                            Di mana tempat terbaik untuk beli emas di Malaysia?
                                        </button>
                                    </h2>
                                    <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                        <div class="accordion-body">
                                            Tempat terbaik untuk membeli emas di Malaysia termasuk Public Gold, Kedai Emas Anuar, 
                                            Kedai Emas Habib, dan kedai emas berlesen yang lain. Pastikan kedai tersebut mempunyai 
                                            lesen yang sah dan menyediakan sijil autentikasi.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                            Apakah perbezaan antara emas 999, 916, dan 835?
                                        </button>
                                    </h2>
                                    <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                        <div class="accordion-body">
                                            <strong>Emas 999</strong> adalah emas tulen dengan kandungan 99.9% emas (24 karat). 
                                            <strong>Emas 916</strong> mengandungi 91.6% emas (22 karat) dan popular untuk barang kemas. 
                                            <strong>Emas 835</strong> mengandungi 83.5% emas (20 karat) dan lebih tahan lasak. 
                                            Harga berbeza mengikut kandungan emas.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                            Bagaimana harga emas dikira?
                                        </button>
                                    </h2>
                                    <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                        <div class="accordion-body">
                                            Harga emas dikira berdasarkan harga emas antarabangsa (spot price), kadar tukaran USD/MYR, 
                                            dan margin keuntungan kedai. Harga biasanya dinyatakan dalam RM per gram atau RM per 100 gram.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Call to Action -->
                        <div class="alert alert-info mt-4">
                            <h5 class="alert-heading"><i class="bi bi-lightbulb me-2"></i>Ingin Tahu Harga Emas Terkini?</h5>
                            <p class="mb-2">
                                Dapatkan maklumat terkini tentang harga emas Malaysia setiap hari. Harga dikemaskini secara berkala 
                                untuk memastikan ketepatan maklumat.
                            </p>
                            <a href="<?php echo esc_url(home_url('/harga-emas/')); ?>" class="btn btn-primary">
                                Lihat Semua Rekod Harga Emas <i class="bi bi-arrow-right ms-1"></i>
                            </a>
                        </div>

                    </div>
                </article>
            </div>
        </div>

        <!-- Related Content -->
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <h3 class="h4 mb-4">Artikel Berkaitan</h3>
                <div class="row g-4">
                    <?php
                    // Get related posts about gold prices
                    $related_posts = new WP_Query(array(
                        'post_type' => 'post',
                        'posts_per_page' => 3,
                        'post_status' => 'publish',
                        'orderby' => 'date',
                        'order' => 'DESC',
                        's' => 'emas',
                    ));
                    
                    if ($related_posts->have_posts()) :
                        while ($related_posts->have_posts()) : $related_posts->the_post();
                            $thumb = hrgms_get_first_image(get_the_ID());
                    ?>
                        <div class="col-md-4">
                            <article class="card h-100" style="border: 1px solid var(--hrgms-card-border);">
                                <?php if ($thumb) : ?>
                                <img src="<?php echo esc_url($thumb); ?>" class="card-img-top" alt="<?php the_title_attribute(); ?>" style="height: 150px; object-fit: cover;">
                                <?php endif; ?>
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <a href="<?php the_permalink(); ?>" class="text-decoration-none"><?php the_title(); ?></a>
                                    </h5>
                                    <p class="card-text small text-muted"><?php echo wp_trim_words(get_the_excerpt(), 15, '...'); ?></p>
                                    <a href="<?php the_permalink(); ?>" class="btn btn-sm btn-outline-primary">Baca Lagi</a>
                                </div>
                            </article>
                        </div>
                    <?php 
                        endwhile;
                        wp_reset_postdata();
                    endif;
                    ?>
                </div>
            </div>
        </div>

    </div>
</section>

<?php get_footer(); ?>

