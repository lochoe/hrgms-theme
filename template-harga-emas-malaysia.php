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
          "text": "Harga emas 999 Malaysia hari ini adalah sekitar <?php echo $gold_prices ? hrgms_format_price_per_gram($gold_prices['prices']['MksBuy']) : 'RM 55-57'; ?> per gram untuk belian dan <?php echo $gold_prices ? hrgms_format_price_per_gram($gold_prices['prices']['MksSell']) : 'RM 56-58'; ?> per gram untuk jualan."
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
<header class="hrgms-hero hrgms-hero-bg" style="padding: 40px 0;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center">
                <?php hrgms_breadcrumb(); ?>
                <h1 class="hrgms-hero-title" style="font-size: 2rem; margin-bottom: 1rem;">
                    <i class="bi bi-graph-up-arrow me-2"></i>Harga Emas Malaysia <?php echo $current_year; ?>
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
        <?php if ($gold_prices && isset($gold_prices['prices'])) : 
            $mks_buy_per_kg = floatval($gold_prices['prices']['MksBuy']);
            $mks_sell_per_kg = floatval($gold_prices['prices']['MksSell']);
            $mks_buy_per_gram = $mks_buy_per_kg / 1000;
            $mks_sell_per_gram = $mks_sell_per_kg / 1000;
            
            // Gold karats
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
        ?>
        <div class="card shadow-lg mb-4" style="border: none; border-radius: 16px; overflow: hidden;">
            <div class="card-header text-center" style="background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%); color: white; padding: 20px;">
                <h2 class="h4 mb-0">
                    <i class="bi bi-gem me-2"></i>Harga Emas 999 Hari Ini
                </h2>
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
        <div class="mb-5">
                <article class="card shadow-lg" style="border: none; border-radius: 16px; background: var(--hrgms-card-bg); box-shadow: 0 4px 6px -1px rgba(0,0,0,.1), 0 2px 4px -1px rgba(0,0,0,.06);">
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
                            <h3 class="h4 mb-4" style="color: var(--hrgms-primary);">
                                <i class="bi bi-graph-up me-2" style="color: #f39c12;"></i>Harga Emas Malaysia Hari Ini
                            </h3>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" style="border-radius: 8px; overflow: hidden;">
                                    <thead style="background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%); color: white;">
                                        <tr>
                                            <th style="border: none; padding: 15px;"><i class="bi bi-gem me-2"></i>Jenis Emas</th>
                                            <th class="text-end" style="border: none; padding: 15px;"><i class="bi bi-arrow-down-circle me-2"></i>Harga Beli (RM/gram)</th>
                                            <th class="text-end" style="border: none; padding: 15px;"><i class="bi bi-arrow-up-circle me-2"></i>Harga Jual (RM/gram)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr style="background: linear-gradient(135deg, #fef9e7 0%, #f9f3e3 100%);">
                                            <td style="border-color: #e2e8f0;"><strong>Emas 999 (24K)</strong><br><small class="text-muted">Emas Tulen</small></td>
                                            <td class="text-end" style="border-color: #e2e8f0;"><strong style="color: #77ac68; font-size: 1.1rem;"><?php echo hrgms_format_price_per_gram($gold_prices['prices']['MksBuy']); ?></strong></td>
                                            <td class="text-end" style="border-color: #e2e8f0;"><strong style="color: #e67e22; font-size: 1.1rem;"><?php echo hrgms_format_price_per_gram($gold_prices['prices']['MksSell']); ?></strong></td>
                                        </tr>
                                        <tr>
                                            <td style="border-color: #e2e8f0;"><strong>Emas Tael</strong><br><small class="text-muted">37.5 gram</small></td>
                                            <td class="text-end" style="border-color: #e2e8f0;"><?php echo hrgms_format_currency($gold_prices['prices']['TaelBuy']); ?></td>
                                            <td class="text-end" style="border-color: #e2e8f0;"><?php echo hrgms_format_currency($gold_prices['prices']['TaelSell']); ?></td>
                                        </tr>
                                        <?php if (isset($gold_prices['prices']['SilverBuy'])) : ?>
                                        <tr>
                                            <td style="border-color: #e2e8f0;"><strong>Perak (Silver)</strong></td>
                                            <td class="text-end" style="border-color: #e2e8f0;"><?php echo hrgms_format_currency($gold_prices['prices']['SilverBuy']); ?></td>
                                            <td class="text-end" style="border-color: #e2e8f0;"><?php echo hrgms_format_currency($gold_prices['prices']['SilverSell']); ?></td>
                                        </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="alert alert-info mt-3" style="background: #e3f2fd; border-left: 4px solid #2196F3; border-radius: 8px;">
                                <i class="bi bi-info-circle me-2"></i><strong>Nota:</strong> Harga spot yang dipaparkan adalah <strong>harga raw material emas sahaja</strong> dan sama di seluruh dunia. 
                                Harga sebenar di kedai emas akan ditambah premium 5-10% untuk belian item baru, atau tolak susut nilai 5-10% untuk jualan. 
                                Sila hubungi kedai emas berlesen untuk harga terkini.
                            </div>
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
                            <h3 class="h4 mb-4" style="color: var(--hrgms-primary);">
                                <i class="bi bi-bank me-2" style="color: #f39c12;"></i>Harga Ar-Rahnu di Malaysia
                            </h3>
                            <p class="mb-4">
                                <strong>Ar-Rahnu</strong> adalah sistem pajak gadai Islam yang membolehkan anda mendapatkan pinjaman dengan 
                                menggunakan emas sebagai cagaran. Berikut adalah harga Ar-Rahnu dari pelbagai institusi di Malaysia:
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
                                        // Show top 5 for better UX
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
                            <div class="alert alert-warning mt-3" style="background: #fff3cd; border-left: 4px solid #ffc107; border-radius: 8px;">
                                <i class="bi bi-info-circle me-2"></i><strong>Nota:</strong> Harga Ar-Rahnu adalah per gram. Harga mungkin berbeza mengikut cawangan. 
                                Sila hubungi institusi untuk maklumat terkini.
                            </div>
                        </div>
                        <?php endif; ?>

                        <!-- SEO Content: Tips and Information -->
                        <div class="mb-4">
                            <h3 class="h4 mb-4" style="color: var(--hrgms-primary);">
                                <i class="bi bi-lightbulb me-2" style="color: #f39c12;"></i>Tips Membeli dan Menjual Emas di Malaysia
                            </h3>
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="card h-100 shadow-sm" style="border: 2px solid #77ac68; border-radius: 12px; background: linear-gradient(135deg, #f0f9f0 0%, #ffffff 100%);">
                                        <div class="card-body p-4">
                                            <h5 class="card-title mb-3" style="color: #77ac68;">
                                                <i class="bi bi-check-circle-fill me-2"></i>Tips Membeli Emas
                                            </h5>
                                            <ul class="mb-0" style="line-height: 2;">
                                                <li><i class="bi bi-check2 text-success me-2"></i>Beli dari kedai emas berlesen dan dipercayai</li>
                                                <li><i class="bi bi-check2 text-success me-2"></i>Periksa sijil autentikasi emas</li>
                                                <li><i class="bi bi-check2 text-success me-2"></i>Bandingkan harga dari beberapa kedai</li>
                                                <li><i class="bi bi-check2 text-success me-2"></i>Fahami perbezaan harga beli dan jual</li>
                                                <li><i class="bi bi-check2 text-success me-2"></i>Simpan resit pembelian dengan selamat</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card h-100 shadow-sm" style="border: 2px solid #e67e22; border-radius: 12px; background: linear-gradient(135deg, #fff5e6 0%, #ffffff 100%);">
                                        <div class="card-body p-4">
                                            <h5 class="card-title mb-3" style="color: #e67e22;">
                                                <i class="bi bi-info-circle-fill me-2"></i>Faktor Mempengaruhi Harga
                                            </h5>
                                            <ul class="mb-0" style="line-height: 2;">
                                                <li><i class="bi bi-graph-up text-warning me-2"></i>Harga emas antarabangsa (spot price)</li>
                                                <li><i class="bi bi-graph-up text-warning me-2"></i>Kadar tukaran USD/MYR</li>
                                                <li><i class="bi bi-graph-up text-warning me-2"></i>Permintaan dan penawaran tempatan</li>
                                                <li><i class="bi bi-graph-up text-warning me-2"></i>Kos pengeluaran dan overhead</li>
                                                <li><i class="bi bi-graph-up text-warning me-2"></i>Margin keuntungan kedai</li>
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
                                            <?php echo $gold_prices ? hrgms_format_price_per_gram($gold_prices['prices']['MksBuy']) : 'RM 55.000-57.000'; ?> 
                                            untuk belian dan <?php echo $gold_prices ? hrgms_format_price_per_gram($gold_prices['prices']['MksSell']) : 'RM 56.000-58.000'; ?> 
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
                        <div class="alert mt-4" style="background: linear-gradient(135deg, #f9f3e3 0%, #fef9e7 100%); border: 2px solid #f39c12; border-radius: 12px; padding: 25px;">
                            <h5 class="alert-heading mb-3" style="color: #e67e22;">
                                <i class="bi bi-lightbulb-fill me-2" style="color: #f39c12;"></i>Ingin Tahu Harga Emas Terkini?
                            </h5>
                            <p class="mb-3" style="color: #2d3748;">
                                Dapatkan maklumat terkini tentang harga emas Malaysia setiap hari. Harga dikemaskini secara berkala 
                                untuk memastikan ketepatan maklumat.
                            </p>
                            <a href="<?php echo esc_url(home_url('/harga-emas/')); ?>" class="btn" style="background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%); color: white; border: none; padding: 12px 24px; border-radius: 8px; font-weight: 600;">
                                <i class="bi bi-graph-up me-2"></i>Lihat Semua Rekod Harga Emas <i class="bi bi-arrow-right ms-1"></i>
                            </a>
                        </div>

                    </div>
                </article>
        </div>

        <!-- Related Content -->
        <div class="row mt-4">
            <div class="col-lg-10">
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
        </div>
    </div>
</section>

<?php get_footer(); ?>

