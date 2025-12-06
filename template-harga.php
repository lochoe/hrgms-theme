<?php
/**
 * File: template-harga.php
 * Purpose: SEO-optimized page for Harga Emas with all karat prices
 * URL: /harga/, /harga-emas-malaysia/, /harga-emas-terkini-di-malaysia/
 * Notes: Mobile-first design, comprehensive price display for all karats
 *        Shared template for multiple URLs to maintain Google indexing
 */

if (!defined('ABSPATH')) {
    exit;
}

// Detect which URL/page we're on for SEO customization
$request_uri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
$is_harga = is_page('harga') || (strpos($request_uri, '/harga') !== false && strpos($request_uri, '/harga-emas') === false);
$is_harga_emas_malaysia = is_page('harga-emas-malaysia') || strpos($request_uri, '/harga-emas-malaysia') !== false;
$is_harga_emas_terkini = is_page('harga-emas-terkini-di-malaysia') || strpos($request_uri, '/harga-emas-terkini-di-malaysia') !== false;

// Set page-specific variables for SEO
if ($is_harga_emas_terkini) {
    $page_title = 'Harga Emas Terkini di Malaysia';
    $page_slug = 'harga-emas-terkini-di-malaysia';
    $page_description = 'Harga emas terkini di Malaysia hari ini. Dapatkan harga emas 999, 916, 835, 750 dan semua karat emas. Harga spot raw material, harga retail persatuan peniaga emas, dan harga Ar-Rahnu.';
    $page_keywords = 'harga emas terkini di malaysia, harga emas hari ini, harga emas 999, harga emas 916, harga emas malaysia, harga spot emas';
} elseif ($is_harga_emas_malaysia) {
    $page_title = 'Harga Emas Malaysia';
    $page_slug = 'harga-emas-malaysia';
    $page_description = 'Dapatkan harga emas Malaysia terkini hari ini. Harga emas 999, 916, 835, 750 per gram. Harga Ar-Rahnu, harga emas Public Gold, dan maklumat lengkap harga emas di Malaysia.';
    $page_keywords = 'harga emas malaysia, harga emas 999, harga emas hari ini, harga emas per gram, harga ar-rahnu, emas malaysia';
} else {
    // Default: /harga/
    $page_title = 'Harga Emas 916 999 Malaysia';
    $page_slug = 'harga';
    $page_description = 'Dapatkan harga emas 916, 999 dan semua karat emas Malaysia terkini hari ini. Harga spot raw material emas, harga retail persatuan peniaga emas (Ar-Rahnu ID PAJAK), dan harga Ar-Rahnu.';
    $page_keywords = 'harga emas 916, harga emas 999, harga emas malaysia, harga emas hari ini, harga emas per gram, harga emas fgjam, harga arrahnu';
}

// Fetch gold prices from API
$gold_prices = hrgms_fetch_gold_prices();
$ar_rahnu_prices = hrgms_fetch_ar_rahnu_prices();

// Get current date for SEO
$current_date = date('d F Y');
$current_year = date('Y');

// Get prices (per kilogram) and convert to per gram
$mks_buy_per_kg = $gold_prices && isset($gold_prices['prices']['MksBuy']) 
    ? floatval($gold_prices['prices']['MksBuy']) 
    : 0;
$mks_sell_per_kg = $gold_prices && isset($gold_prices['prices']['MksSell']) 
    ? floatval($gold_prices['prices']['MksSell']) 
    : 0;
$mks_buy_per_gram = $mks_buy_per_kg / 1000;
$mks_sell_per_gram = $mks_sell_per_kg / 1000;

// Gold karats with their purity percentages
// STANDARD: Karat tertinggi (999) di atas/kiri, terendah (375) di bawah/kanan
$gold_karats = array(
    '999' => 0.999,  // 24K - Tertinggi
    '950' => 0.950,
    '916' => 0.916,  // 22K
    '875' => 0.875,
    '835' => 0.835,  // 20K
    '800' => 0.800,
    '750' => 0.750,  // 18K
    '585' => 0.585,  // 14K
    '375' => 0.375,  // 9K - Terendah
);

get_header();
?>

<!-- Structured Data for SEO (JSON-LD) -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebPage",
  "name": "<?php echo esc_js($page_title); ?> <?php echo $current_year; ?> - Harga Emas Terkini Hari Ini",
  "description": "<?php echo esc_js($page_description); ?> Harga spot untuk emas 999, 950, 916, 875, 835, 800, 750, 585, 375.",
  "url": "<?php echo esc_url(home_url('/' . $page_slug . '/')); ?>",
  "mainEntity": {
    "@type": "FAQPage",
    "mainEntity": [
      {
        "@type": "Question",
        "name": "Berapa harga emas 916 Malaysia hari ini?",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "Harga emas 916 Malaysia hari ini adalah sekitar <?php echo $mks_sell_per_gram > 0 ? 'RM ' . number_format($mks_sell_per_gram * 0.916, 3, '.', ',') : 'RM 50-52'; ?> per gram untuk jualan. Harga ini berdasarkan harga emas 999 dikalikan dengan 91.6% (kandungan emas dalam 916)."
        }
      },
      {
        "@type": "Question",
        "name": "Apakah perbezaan harga emas 999 dan 916?",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "Emas 999 adalah emas tulen (99.9%) manakala emas 916 mengandungi 91.6% emas. Harga emas 916 adalah lebih rendah kerana kandungan emas yang kurang. Biasanya harga emas 916 adalah sekitar 91.6% dari harga emas 999."
        }
      },
      {
        "@type": "Question",
        "name": "Di mana boleh lihat harga emas persatuan peniaga emas Malaysia?",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "Harga retail persatuan peniaga emas boleh dirujuk di harga Ar-Rahnu ID 'PAJAK' dalam API. Harga yang dipaparkan di laman ini adalah harga spot (raw material) terkini yang dikemaskini setiap hari dan sama di seluruh dunia."
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
        "item": "<?php echo esc_url(home_url('/' . $page_slug . '/')); ?>"
      }
    ]
  }
}
</script>

<!-- Hero Section -->
<header class="hrgms-hero hrgms-hero-bg" style="padding: 40px 0;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center">
                <?php hrgms_breadcrumb(); ?>
                <h1 class="hrgms-hero-title" style="font-size: 2rem; margin-bottom: 1rem;">
                    <i class="bi bi-gem me-2"></i><?php echo esc_html($page_title); ?>
                </h1>
                <p class="hrgms-hero-subtitle" style="font-size: 1.1rem;">
                    Harga Emas Terkini Hari Ini - <?php echo $current_date; ?>
                </p>
                <?php if ($gold_prices && isset($gold_prices['lastUpdate'])) : ?>
                <p class="text-white-50 mt-2 small">
                    <i class="bi bi-clock me-1"></i>Dikemaskini: <?php echo date('d M Y, H:i', strtotime($gold_prices['lastUpdate'])); ?>
                </p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</header>

<!-- Main Content Section -->
<section class="hrgms-products" style="padding: 40px 0; background: var(--hrgms-body-bg);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                
                <!-- Current Gold Prices Display -->
                <?php if ($gold_prices && isset($gold_prices['prices'])) : ?>
                <div class="card shadow-lg mb-4" style="border: none; border-radius: 16px; overflow: hidden;">
                    <div class="card-header text-center" style="background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%); color: white; padding: 20px;">
                        <h2 class="h4 mb-0">
                            <i class="bi bi-gem me-2"></i>Harga Emas 999 Hari Ini
                        </h2>
                        <p class="mb-0 mt-2 small" style="opacity: 0.9;">
                            Harga Spot (Raw Material) - Sama Di Seluruh Dunia
                        </p>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-3 mb-4">
                            <div class="col-6 col-md-6">
                                <div class="text-center p-3" style="background: linear-gradient(135deg, #fff5e6 0%, #ffe8cc 100%); border-radius: 8px; border: 2px solid #e67e22;">
                                    <small class="text-muted d-block mb-2 fw-bold">Harga Jual 999</small>
                                    <strong class="d-block" style="font-size: 1.5rem; color: #e67e22; font-weight: 700;">
                                        <?php echo hrgms_format_price_per_gram($mks_sell_per_kg); ?>
                                    </strong>
                                    <small class="text-muted d-block mt-2">per gram</small>
                                </div>
                            </div>
                            <div class="col-6 col-md-6">
                                <div class="text-center p-3" style="background: linear-gradient(135deg, #f0f9f0 0%, #e8f5e9 100%); border-radius: 8px; border: 2px solid #77ac68;">
                                    <small class="text-muted d-block mb-2 fw-bold">Harga Beli 999</small>
                                    <strong class="d-block" style="font-size: 1.5rem; color: #77ac68; font-weight: 700;">
                                        <?php echo hrgms_format_price_per_gram($mks_buy_per_kg); ?>
                                    </strong>
                                    <small class="text-muted d-block mt-2">per gram</small>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Info Penting: Susut Nilai & Premium -->
                        <div class="alert alert-warning mb-4" style="background: #fff3cd; border-left: 4px solid #ffc107; border-radius: 8px;">
                            <h5 class="alert-heading mb-3">
                                <i class="bi bi-exclamation-triangle me-2"></i>Penting: Memahami Harga Spot, Susut Nilai & Premium
                            </h5>
                            
                            <!-- Harga Spot -->
                            <div class="mb-3">
                                <h6 class="fw-bold mb-2" style="color: #856404;">
                                    <i class="bi bi-info-circle me-2"></i>Harga Spot (Raw Material)
                                </h6>
                                <p class="small mb-0" style="line-height: 1.7;">
                                    Harga spot yang ditunjukkan adalah <strong>harga raw material emas sahaja</strong> dan <strong>sama di seluruh dunia</strong>. 
                                    Ini adalah harga asas emas sebelum ditambah kos-kos lain.
                                </p>
                            </div>
                            
                            <!-- Susut Nilai Bila Jual -->
                            <div class="mb-3">
                                <h6 class="fw-bold mb-2" style="color: #856404;">
                                    <i class="bi bi-arrow-down-circle me-2"></i>Susut Nilai Bila Jual (5-10%)
                                </h6>
                                <p class="small mb-2" style="line-height: 1.7;">
                                    Apabila anda <strong>menjual emas dan ambil tunai</strong>, akan ada <strong>susut nilai emas sebanyak 5-10%</strong> dari harga spot semasa. 
                                    Kadar susut nilai ini bergantung kepada:
                                </p>
                                <ul class="small mb-2" style="line-height: 1.8;">
                                    <li>Keadaan emas (baru, terpakai, rosak)</li>
                                    <li>Ketulenan emas (perlu uji jika tiada sijil)</li>
                                    <li>Polisi kedai emas</li>
                                    <li>Kos pemprosesan dan penyucian</li>
                                </ul>
                            </div>
                            
                            <!-- Premium Bila Beli -->
                            <div class="mb-3">
                                <h6 class="fw-bold mb-2" style="color: #856404;">
                                    <i class="bi bi-arrow-up-circle me-2"></i>Premium Bila Beli Item Baru (5-10%)
                                </h6>
                                <p class="small mb-2" style="line-height: 1.7;">
                                    Apabila anda <strong>membeli barang kemas baru</strong>, akan ada <strong>premium tambahan sebanyak 5-10%</strong> dari harga spot. 
                                    Premium ini merangkumi:
                                </p>
                                <ul class="small mb-2" style="line-height: 1.8;">
                                    <li>Kos tukang emas (upah kerja tangan)</li>
                                    <li>Keuntungan kedai emas</li>
                                    <li>Komisyen agent</li>
                                    <li>Kos logistik dan penghantaran</li>
                                    <li>Kos simpanan dan security</li>
                                </ul>
                            </div>
                            
                            <p class="mb-0 small fw-bold mt-3 pt-3" style="line-height: 1.7; color: #856404; border-top: 1px solid rgba(133, 100, 4, 0.3);">
                                <i class="bi bi-info-circle me-2"></i>
                                <strong>Sila rujuk nota di belakang resit belian barang kemas anda dahulu</strong> untuk maklumat lengkap tentang susut nilai, premium, dan terma jual beli.
                            </p>
                        </div>
                        
                        <!-- Harga Spot untuk Semua Karat -->
                        <div class="mt-4">
                            <h3 class="h5 mb-3 text-center">
                                <i class="bi bi-list-ul me-2"></i>Harga Spot untuk Semua Karat Emas
                            </h3>
                            <div class="table-responsive">
                                <table class="table table-hover mb-0" style="border-radius: 8px; overflow: hidden;">
                                    <thead style="background: linear-gradient(135deg, #f9f3e3 0%, #fef9e7 100%);">
                                        <tr>
                                            <th style="border: none; padding: 12px; font-weight: 600;">Karat</th>
                                            <th class="text-end" style="border: none; padding: 12px; font-weight: 600;">Harga Jual / gram</th>
                                            <th class="text-end" style="border: none; padding: 12px; font-weight: 600;">Harga Beli / gram</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($gold_karats as $karat => $purity) : 
                                            $buy_price = $mks_buy_per_gram * $purity;
                                            $sell_price = $mks_sell_per_gram * $purity;
                                        ?>
                                        <tr>
                                            <td style="padding: 12px; border-bottom: 1px solid #e2e8f0;">
                                                <strong style="color: #f39c12;"><?php echo esc_html($karat); ?></strong>
                                                <br>
                                                <small class="text-muted">
                                                    <?php 
                                                    if ($karat == '999') echo '24K - Emas Tulen';
                                                    elseif ($karat == '916') echo '22K - Barang Kemas';
                                                    elseif ($karat == '835') echo '20K';
                                                    elseif ($karat == '750') echo '18K';
                                                    elseif ($karat == '585') echo '14K';
                                                    elseif ($karat == '375') echo '9K';
                                                    else echo number_format($purity * 100, 1) . '% Emas';
                                                    ?>
                                                </small>
                                            </td>
                                            <td class="text-end" style="padding: 12px; border-bottom: 1px solid #e2e8f0; font-weight: 600; color: #e67e22;">
                                                <?php echo 'RM ' . number_format($sell_price, 3, '.', ','); ?>
                                            </td>
                                            <td class="text-end" style="padding: 12px; border-bottom: 1px solid #e2e8f0; font-weight: 600; color: #77ac68;">
                                                <?php echo 'RM ' . number_format($buy_price, 3, '.', ','); ?>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- Harga Retail Persatuan Peniaga Emas (PAJAK) -->
        <?php 
        // Find PAJAK ID in Ar-Rahnu prices
        $pajak_prices = null;
        if ($ar_rahnu_prices && isset($ar_rahnu_prices['arRahnu'])) {
            foreach ($ar_rahnu_prices['arRahnu'] as $institution) {
                if (isset($institution['id']) && strtoupper($institution['id']) === 'PAJAK') {
                    $pajak_prices = $institution;
                    break;
                }
            }
        }
        ?>
        <?php if ($pajak_prices && isset($pajak_prices['prices'])) : ?>
        <div class="card shadow-lg mb-4" style="border: none; border-radius: 16px; overflow: hidden; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
            <div class="card-header text-center" style="background: transparent; color: white; padding: 20px; border: none;">
                <h2 class="h4 mb-0">
                    <i class="bi bi-shop-window me-2"></i>Harga Cadangan Jualan Kedai-Kedai Emas
                </h2>
                <p class="mb-0 mt-2 small" style="opacity: 0.9;">
                    Harga retail persatuan peniaga-peniaga emas (ID: PAJAK)
                </p>
            </div>
            <div class="card-body p-4" style="background: white;">
                <div class="table-responsive">
                    <table class="table table-hover mb-0" style="border-radius: 8px; overflow: hidden;">
                        <thead style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                            <tr>
                                <th style="border: none; padding: 15px; font-weight: 600;">
                                    <i class="bi bi-gem me-2"></i>Karat Emas
                                </th>
                                <th class="text-end" style="border: none; padding: 15px; font-weight: 600;">
                                    <i class="bi bi-cash-coin me-2"></i>Harga / gram
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            // Standard: Karat tertinggi (999) di atas, terendah (750) di bawah
                            $pajak_karats = array('999', '950', '916', '875', '835', '750');
                            $row_count = 0;
                            foreach ($pajak_karats as $karat) : 
                                if (!isset($pajak_prices['prices'][$karat])) continue;
                                $row_count++;
                                $bg_class = ($row_count % 2 == 0) ? 'style="background: #f8f9fa;"' : '';
                            ?>
                            <tr <?php echo $bg_class; ?>>
                                <td style="padding: 15px; border-bottom: 1px solid #e2e8f0;">
                                    <strong style="color: #764ba2; font-size: 1.1rem;"><?php echo esc_html($karat); ?></strong>
                                    <br>
                                    <small class="text-muted">
                                        <?php 
                                        if ($karat == '999') echo '24K - Emas Tulen';
                                        elseif ($karat == '916') echo '22K - Barang Kemas';
                                        elseif ($karat == '835') echo '20K';
                                        elseif ($karat == '750') echo '18K';
                                        else echo 'Karat ' . $karat;
                                        ?>
                                    </small>
                                </td>
                                <td class="text-end" style="padding: 15px; border-bottom: 1px solid #e2e8f0; font-weight: 700; color: #667eea; font-size: 1.1rem;">
                                    <?php echo hrgms_format_ar_rahnu_price($pajak_prices['prices'][$karat]); ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="alert alert-info mt-3 mb-0" style="background: #e3f2fd; border-left: 4px solid #2196F3; border-radius: 8px;">
                    <p class="small mb-0" style="line-height: 1.7;">
                        <i class="bi bi-info-circle me-2"></i>
                        <strong>Harga cadangan jualan</strong> ini adalah harga referensi yang digunakan oleh pembeli dan peniaga emas di Malaysia. 
                        Harga sebenar di kedai emas mungkin berbeza mengikut lokasi dan polisi kedai.
                    </p>
                </div>
            </div>
        </div>
        <?php endif; ?>

                <!-- SEO Content Section -->
                <div class="card shadow-sm mb-4" style="border: none; border-radius: 16px;">
                    <div class="card-body p-4 p-lg-5">
                        
                        <!-- Introduction -->
                        <div class="mb-4">
                            <h2 class="h3 mb-3"><?php echo esc_html($page_title); ?> <?php echo $current_year; ?></h2>
                            <p class="lead">
                                Laman ini menyediakan <strong>harga emas terkini</strong> untuk semua karat emas di Malaysia termasuk 
                                <strong>harga emas 999</strong> (24K), <strong>harga emas 916</strong> (22K), dan karat emas yang lain. 
                                Harga yang dipaparkan adalah <strong>harga spot (raw material emas)</strong> yang sama di seluruh dunia 
                                dan dikemaskini setiap hari. Harga retail persatuan peniaga emas boleh dirujuk di harga Ar-Rahnu ID "PAJAK".
                            </p>
                        </div>

                        <!-- Harga Emas 916 Ar-Rahnu -->
                        <?php if ($ar_rahnu_prices && isset($ar_rahnu_prices['arRahnu'])) : ?>
                        <div class="mb-5">
                            <h3 class="h4 mb-4" style="color: var(--hrgms-primary);">
                                <i class="bi bi-bank me-2" style="color: #f39c12;"></i>Harga Emas 916 Ar-Rahnu di Malaysia
                            </h3>
                            <p class="mb-4">
                                <strong>Harga Ar-Rahnu</strong> adalah harga marhun (cagaran) yang digunakan oleh bank Ar-Rahnu, 
                                lembaga zakat negeri, dan syarikat berasaskan Islamik. Harga Ar-Rahnu biasanya lebih rendah 
                                daripada harga jualan di kedai emas.
                            </p>
                            
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" style="border-radius: 8px; overflow: hidden;">
                                    <thead style="background: linear-gradient(135deg, #1e3a5f 0%, #2d3748 100%); color: white;">
                                        <tr>
                                            <th style="border: none; padding: 15px;"><i class="bi bi-building me-2"></i>Institusi</th>
                                            <th class="text-end" style="border: none; padding: 15px;"><strong>999</strong></th>
                                            <th class="text-end" style="border: none; padding: 15px;">950</th>
                                            <th class="text-end" style="border: none; padding: 15px;">916</th>
                                            <th class="text-end" style="border: none; padding: 15px;">875</th>
                                            <th class="text-end" style="border: none; padding: 15px;">835</th>
                                            <th class="text-end" style="border: none; padding: 15px;">750</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $ar_rahnu_list = $ar_rahnu_prices['arRahnu'];
                                        $top_ar_rahnu = array_slice($ar_rahnu_list, 0, 5);
                                        $row_count = 0;
                                        foreach ($top_ar_rahnu as $institution) : 
                                            $row_count++;
                                            $bg_class = ($row_count % 2 == 0) ? 'style="background: #f8f9fa;"' : '';
                                        ?>
                                        <tr <?php echo $bg_class; ?>>
                                            <td style="border-color: #e2e8f0;">
                                                <strong><?php echo esc_html($institution['name']); ?></strong>
                                            </td>
                                            <td class="text-end" style="border-color: #e2e8f0;"><strong style="color: #f39c12; font-size: 1.05rem;"><?php echo isset($institution['prices']['999']) ? hrgms_format_ar_rahnu_price($institution['prices']['999']) : '-'; ?></strong></td>
                                            <td class="text-end" style="border-color: #e2e8f0;"><?php echo isset($institution['prices']['950']) ? hrgms_format_ar_rahnu_price($institution['prices']['950']) : '-'; ?></td>
                                            <td class="text-end" style="border-color: #e2e8f0;"><?php echo isset($institution['prices']['916']) ? hrgms_format_ar_rahnu_price($institution['prices']['916']) : '-'; ?></td>
                                            <td class="text-end" style="border-color: #e2e8f0;"><?php echo isset($institution['prices']['875']) ? hrgms_format_ar_rahnu_price($institution['prices']['875']) : '-'; ?></td>
                                            <td class="text-end" style="border-color: #e2e8f0;"><?php echo isset($institution['prices']['835']) ? hrgms_format_ar_rahnu_price($institution['prices']['835']) : '-'; ?></td>
                                            <td class="text-end" style="border-color: #e2e8f0;"><?php echo isset($institution['prices']['750']) ? hrgms_format_ar_rahnu_price($institution['prices']['750']) : '-'; ?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <?php endif; ?>

                        <!-- Nota Penting -->
                        <div class="alert alert-info mt-4" style="background: #e3f2fd; border-left: 4px solid #2196F3; border-radius: 8px;">
                            <h5 class="alert-heading mb-2">
                                <i class="bi bi-info-circle me-2"></i>Nota Penting
                            </h5>
                            <p class="mb-2 small" style="line-height: 1.7;">
                                <strong>*Harga yang dipaparkan di atas adalah untuk rujukan sahaja.</strong> Harga emas biasanya berbeza-beza di setiap lokasi. 
                                Rujukan harga di atas tidak semestinya sama dengan harga yang anda akan perolehi termasuk kos upah, caj, logistik & etc.
                            </p>
                            <p class="mb-0 small" style="line-height: 1.7;">
                                Harga yang dipaparkan di atas adalah harga spot (raw material) yang sama di seluruh dunia. 
                                Harga sebenar di kedai emas akan ditambah premium 5-10% untuk belian item baru, atau tolak susut nilai 5-10% untuk jualan.
                            </p>
                        </div>

                        <!-- Info Tambahan -->
                        <div class="mt-4">
                            <h3 class="h5 mb-3">Maklumat Tambahan</h3>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="p-3" style="background: #f8f9fa; border-radius: 8px;">
                                        <h5 class="h6 mb-2" style="color: #e67e22;">
                                            <i class="bi bi-info-circle me-2"></i>Pajak Gadai (Ar-Rahnu)
                                        </h5>
                                        <p class="small mb-0" style="line-height: 1.7;">
                                            Pada kebiasaannya penggadai akan mendapat <strong>65-70%</strong> dari harga Ar-Rahnu apabila memajak barang kemas.
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="p-3" style="background: #f8f9fa; border-radius: 8px;">
                                        <h5 class="h6 mb-2" style="color: #77ac68;">
                                            <i class="bi bi-cash-coin me-2"></i>Jual Barang Kemas
                                        </h5>
                                        <p class="small mb-0" style="line-height: 1.7;">
                                            Kira-kira <strong>80-85%</strong> apabila menjual barang kemas kepada tunai, bergantung kepada ketulenan dan condition barang kemas itu sendiri.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>

