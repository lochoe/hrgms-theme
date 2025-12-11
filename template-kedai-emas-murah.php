<?php
/**
 * File: template-kedai-emas-murah.php
 * Purpose: SEO-optimized page for Kedai Emas Murah with stores listing
 * URL: /kedai-emas-murah/
 * Notes: Mobile-first design, displays random stores by state from API
 */

if (!defined('ABSPATH')) {
    exit;
}

// Fetch stores from API
$stores_data = hrgms_fetch_stores();
$selected_stores = hrgms_get_random_stores_by_state($stores_data, 20);

// Get current date for SEO
$current_date = date('d F Y');
$current_year = date('Y');

// SEO variables
$page_title = 'Kedai Emas Paling Murah di Malaysia';
$page_description = 'Senarai kedai emas murah di Malaysia. Temukan kedai emas terbaik di Pasar Siti Khadijah Kelantan, Jalan Masjid India KL, Lebuh Penang, dan lokasi lain. Bandingkan harga emas dan dapatkan tawaran terbaik.';
$page_keywords = 'kedai emas murah, kedai emas murah malaysia, kedai emas kelantan, kedai emas kuala lumpur, kedai emas pulau pinang, harga emas murah, beli emas murah';

get_header();
?>

<!-- Structured Data for SEO (JSON-LD) -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebPage",
  "name": "<?php echo esc_js($page_title); ?> <?php echo $current_year; ?>",
  "description": "<?php echo esc_js($page_description); ?>",
  "url": "<?php echo esc_url(home_url('/kedai-emas-murah/')); ?>",
  "mainEntity": {
    "@type": "FAQPage",
    "mainEntity": [
      {
        "@type": "Question",
        "name": "Di mana kedai emas paling murah di Malaysia?",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "Kedai emas paling murah di Malaysia biasanya terdapat di Pasar Siti Khadijah Kelantan, Jalan Masjid India Kuala Lumpur, Lebuh Penang Pulau Pinang, Kuala Pilah Negeri Sembilan, dan Pasar Payang Terengganu. Harga emas di seluruh Malaysia hampir sama, perbezaan biasanya pada upah tukang dan strategi peniaga."
        }
      },
      {
        "@type": "Question",
        "name": "Kenapa harga emas setiap kedai berbeza?",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "Harga emas berbeza kerana: 1) Harga emas berubah setiap hari, kedai yang restock pada harga rendah boleh jual lebih murah, 2) Teknik buka harga rendah tapi naikkan upah, 3) Setiap kedai ada strategi sendiri untuk tarik pelanggan, 4) Emas bukan barang kawalan jadi setiap peniaga bebas jual pada harga sendiri."
        }
      },
      {
        "@type": "Question",
        "name": "Berapa harga upah standard untuk design emas?",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "Harga upah standard: Emas padu (gajah, pasir, putra, putri) RM4-8/gram, Emas bajet simple (mesin, pintal) RM6-10/gram, Emas design simple (jagung, coco, lipan) RM8-12/gram, Emas fashion RM8-20/gram, Emas eksklusif design RM12 ke atas per gram."
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
        "name": "<?php echo esc_js($page_title); ?>",
        "item": "<?php echo esc_url(home_url('/kedai-emas-murah/')); ?>"
      }
    ]
  }
}
</script>

<!-- Hero Section -->
<header class="hrgms-hero hrgms-hero-simple" style="padding: 40px 0;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center">
                <?php hrgms_breadcrumb(); ?>
                <h1 class="hrgms-hero-title" style="font-size: 2rem; margin-bottom: 1rem;">
                    <i class="bi bi-shop me-2"></i><?php echo esc_html($page_title); ?>
                </h1>
                <p class="hrgms-hero-subtitle" style="font-size: 1.1rem;">
                    Senarai kedai emas murah di Malaysia dan cara menentukan kedai emas yang betul-betul murah
                </p>
            </div>
        </div>
    </div>
</header>

<section class="hrgms-products">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                
                <!-- Introduction Content -->
                <div class="card mb-4" style="border: 1px solid var(--hrgms-card-border); box-shadow: var(--hrgms-card-shadow);">
                    <div class="card-body p-4 p-lg-5">
                        <p class="lead">
                            Senarai kedai emas murah di Malaysia dan bagaimana untuk menentukan kedai emas itu betul-betul murah? 
                            Untuk pelawat yang mencari kata kunci "kedai emas murah", sila baca dan hadam artikel ini. 
                            Untuk rekod apabila disebut kedai emas murah di Malaysia hanya ada beberapa tempat yang akan bermain di fikiran.
                        </p>
                        
                        <h2 class="h4 mt-4 mb-3">Tempat-Tempat Sinonim dengan Emas Murah</h2>
                        <ul class="list-unstyled">
                            <li><i class="bi bi-check-circle text-success me-2"></i>Kedai emas murah Pasar Siti Khadijah, Kelantan</li>
                            <li><i class="bi bi-check-circle text-success me-2"></i>Kedai emas murah Jalan Masjid India, Kuala Lumpur</li>
                            <li><i class="bi bi-check-circle text-success me-2"></i>Kedai emas murah Lebuh Penang, Pulau Pinang</li>
                            <li><i class="bi bi-check-circle text-success me-2"></i>Kedai emas murah Kuala Pilah, Negeri Sembilan</li>
                            <li><i class="bi bi-check-circle text-success me-2"></i>Kedai emas murah Pasar Payang, Terengganu</li>
                        </ul>
                        
                        <h2 class="h4 mt-4 mb-3">Kenapa Harga Emas Setiap Kedai Berbeza?</h2>
                        <ol>
                            <li><strong>Harga emas berubah setiap hari</strong> - Ada kedai bernasib baik restock barang pada harga rendah, jadi mereka boleh jual rendah, tapi apabila mereka tersilap restock pada harga tinggi, maka mereka terpaksalah jual tinggi.</li>
                            <li><strong>Teknik buka harga rendah, naikkan upah</strong> - Ada juga kedai emas menggunakan teknik buka harga rendah, tapi naikkan harga upah, ini memang hampir majoriti kedai lakukan.</li>
                            <li><strong>Strategi peniaga</strong> - Setiap kedai / syarikat ada cara dan strategi mereka sendiri untuk tarik pelanggan, ada yang fokus kepada barang bajet, barang padu, design ciplak, design clone dan pelbagai lagi, lagi cantik & kemas suatu design lagi mahal upahnya.</li>
                            <li><strong>Emas bukan barang kawalan</strong> - Jadi setiap syarikat atau individu bebas untuk menjual berapa pun harga.</li>
                        </ol>
                        
                        <h2 class="h4 mt-4 mb-3">Harga Upah Standard untuk Design Emas</h2>
                        <ul>
                            <li><strong>Emas padu</strong> – gajah, pasir, putra, putri: <strong>RM4-8/gram</strong></li>
                            <li><strong>Emas bajet simple</strong> – mesin, pintal: <strong>RM6-10/gram</strong></li>
                            <li><strong>Emas design simple</strong> – jagung, coco, lipan: <strong>RM8-RM12/gram</strong></li>
                            <li><strong>Emas fashion</strong>: <strong>RM8-20/gram</strong></li>
                            <li><strong>Emas eksklusif design</strong>: <strong>RM12-RM infiniti pergram</strong></li>
                        </ul>
                        
                        <div class="alert alert-info mt-4">
                            <i class="bi bi-info-circle me-2"></i>
                            <strong>Tips:</strong> Sentiasa bandingkan harga sebelum membeli. 
                            Semak harga emas semasa di <a href="<?php echo esc_url(home_url('/harga/')); ?>" class="alert-link">hargaemas.com.my/harga</a> 
                            untuk rujukan sebelum membuat keputusan.
                        </div>
                    </div>
                </div>
                
                <!-- Stores Listing -->
                <div class="card mb-4" style="border: 1px solid var(--hrgms-card-border); box-shadow: var(--hrgms-card-shadow);">
                    <div class="card-body p-4 p-lg-5">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h2 class="h3 mb-0">
                                <i class="bi bi-shop-window me-2"></i>Senarai Kedai Emas (Sample)
                            </h2>
                            <a href="https://www.hargaemas.my/store" target="_blank" rel="noopener" class="btn btn-hrgms-primary">
                                <i class="bi bi-arrow-right me-2"></i>Lihat Semua Kedai
                            </a>
                        </div>
                        
                        <?php if (!empty($selected_stores)) : ?>
                            <div class="row g-4">
                                <?php 
                                $current_state = '';
                                foreach ($selected_stores as $store) : 
                                    $store_state = isset($store['filter']) && !empty($store['filter']) ? $store['filter'] : 'Others';
                                    $store_title = isset($store['title']) ? $store['title'] : 'Kedai Emas';
                                    $store_subtitle = isset($store['subTitle']) ? $store['subTitle'] : '';
                                    $store_link = isset($store['cardLink']) ? $store['cardLink'] : (isset($store['link']) ? $store['link'] : '#');
                                    $store_image = isset($store['backgroundImageLink']) ? $store['backgroundImageLink'] : '';
                                    
                                    // Show state header if new state
                                    if ($store_state !== $current_state) :
                                        $current_state = $store_state;
                                ?>
                                    <div class="col-12 mt-3">
                                        <h3 class="h5 text-primary border-bottom pb-2">
                                            <i class="bi bi-geo-alt me-2"></i><?php echo esc_html($store_state); ?>
                                        </h3>
                                    </div>
                                <?php endif; ?>
                                
                                <div class="col-6 col-md-4 col-lg-3">
                                    <div class="product-card h-100" style="border: 1px solid var(--hrgms-card-border); box-shadow: var(--hrgms-card-shadow);">
                                        <div class="product-image" style="height: 150px; overflow: hidden;">
                                            <a href="<?php echo esc_url($store_link); ?>" target="_blank" rel="noopener" title="<?php echo esc_attr($store_title); ?>">
                                                <?php if ($store_image) : ?>
                                                    <img src="<?php echo esc_url($store_image); ?>" 
                                                         alt="<?php echo esc_attr($store_title); ?>" 
                                                         class="img-fluid w-100 h-100"
                                                         style="object-fit: cover;"
                                                         loading="lazy"
                                                         onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                                    <div class="d-none align-items-center justify-content-center h-100 bg-gradient" style="background: linear-gradient(135deg, #f39c12, #e67e22);">
                                                        <i class="bi bi-shop text-white" style="font-size: 2rem;"></i>
                                                    </div>
                                                <?php else : ?>
                                                    <div class="d-flex align-items-center justify-content-center h-100 bg-gradient" style="background: linear-gradient(135deg, #f39c12, #e67e22);">
                                                        <i class="bi bi-shop text-white" style="font-size: 2rem;"></i>
                                                    </div>
                                                <?php endif; ?>
                                            </a>
                                        </div>
                                        <div class="product-body p-3">
                                            <h4 class="product-title" style="font-size: 0.95rem; margin-bottom: 0.5rem;">
                                                <a href="<?php echo esc_url($store_link); ?>" target="_blank" rel="noopener">
                                                    <?php echo esc_html($store_title); ?>
                                                </a>
                                            </h4>
                                            <?php if ($store_subtitle) : ?>
                                                <p class="text-muted small mb-2">
                                                    <i class="bi bi-geo-alt me-1"></i><?php echo esc_html($store_subtitle); ?>
                                                </p>
                                            <?php endif; ?>
                                            <a href="<?php echo esc_url($store_link); ?>" target="_blank" rel="noopener" class="btn btn-sm btn-product w-100">
                                                <i class="bi bi-box-arrow-up-right me-1"></i>Lawati Kedai
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                            
                            <div class="text-center mt-4">
                                <a href="https://www.hargaemas.my/store" target="_blank" rel="noopener" class="btn btn-hrgms-primary btn-lg">
                                    <i class="bi bi-arrow-right me-2"></i>Lihat Semua Kedai Emas di Malaysia
                                </a>
                            </div>
                        <?php else : ?>
                            <div class="alert alert-warning">
                                <i class="bi bi-exclamation-triangle me-2"></i>
                                Tiada kedai emas dijumpai pada masa ini. Sila cuba lagi kemudian atau 
                                <a href="https://www.hargaemas.my/store" target="_blank" rel="noopener" class="alert-link">lawati laman utama kedai emas</a>.
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- How to Buy Section -->
                <div class="card mb-4" style="border: 1px solid var(--hrgms-card-border); box-shadow: var(--hrgms-card-shadow);">
                    <div class="card-body p-4 p-lg-5">
                        <h2 class="h4 mb-3">Cara Beli Kedai Emas Murah Online</h2>
                        <ol>
                            <li><strong>Cari peniaga-peniaga emas yang berdekatan tempat anda</strong> - Boleh COD (Cash on Delivery) untuk keselamatan lebih.</li>
                            <li><strong>Gunakan payment gateway di Shopee</strong> - Bayaran anda hanya akan didisburse kepada seller selepas item diterima, jadi risiko minimum.</li>
                            <li><strong>Baca review-review seller dahulu</strong> - Sebelum meneruskan transaksi, pastikan seller mempunyai rating dan review yang baik.</li>
                            <li><strong>Jangan melakukan pembayaran direct kepada akaun seller</strong> - Gunakan payment gateway yang disediakan untuk keselamatan.</li>
                            <li><strong>Semak harga jual di hargaemas.com.my</strong> - Jika terlalu murah dari harga spot, besar kemungkinan adalah scam.</li>
                            <li><strong>Post di Facebook tanya pendapat kawan-kawan</strong> - Mungkin ada kawan boleh membantu atau memberikan cadangan.</li>
                        </ol>
                        
                        <div class="alert alert-success mt-4">
                            <i class="bi bi-lightbulb me-2"></i>
                            <strong>Ingat:</strong> Bila harga yang dijual too good to be true, biasanya memang not true. 
                            Simpan ini selalu di kepala, dan lihat harga emas semasa di 
                            <a href="<?php echo esc_url(home_url('/harga/')); ?>" class="alert-link">www.hargaemas.com.my/harga</a> 
                            sebelum membuat keputusan.
                        </div>
                    </div>
                </div>
                
                <!-- Last Updated -->
                <div class="text-center mt-4 text-muted small">
                    <i class="bi bi-clock-history me-1"></i>
                    Dikemaskini: <?php echo $current_date; ?>
                </div>
                
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>


