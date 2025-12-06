<?php
/**
 * File: template-ar-rahnu.php
 * Purpose: SEO-optimized page for Ar-Rahnu listing with all institutions
 * URL: /ar-rahnu/, /harga-emas-ar-rahnu-hari-ini/
 * Notes: Mobile-first design, displays all Ar-Rahnu institutions from API in card format
 *        Shared template for multiple URLs to maintain Google indexing
 */

if (!defined('ABSPATH')) {
    exit;
}

// Detect which URL/page we're on for SEO customization
$request_uri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
$is_harga_emas_ar_rahnu_hari_ini = is_page('harga-emas-ar-rahnu-hari-ini') || strpos($request_uri, '/harga-emas-ar-rahnu-hari-ini') !== false;
$is_ar_rahnu = is_page('ar-rahnu') || (strpos($request_uri, '/ar-rahnu') !== false && strpos($request_uri, '/ar-rahnu/calculator') === false);

// Set page-specific variables for SEO
if ($is_harga_emas_ar_rahnu_hari_ini) {
    $page_title = 'Harga Emas Ar-Rahnu Hari Ini';
    $page_slug = 'harga-emas-ar-rahnu-hari-ini';
    $page_description = 'Harga emas Ar-Rahnu hari ini di Malaysia. Dapatkan harga Ar-Rahnu terkini dari semua bank dan institusi Ar-Rahnu. Bandingkan harga Ar-Rahnu Agrobank, Bank Islam, Bank Muamalat, X\'Change, YaPEIM, CIMB Islamic, RHB Islamic hari ini.';
    $page_keywords = 'harga emas ar-rahnu hari ini, ar-rahnu hari ini, harga ar-rahnu terkini, ar-rahnu xchange hari ini, ar-rahnu yapeim hari ini, ar-rahnu bank hari ini, harga emas ar-rahnu malaysia';
} else {
    // Default: /ar-rahnu/
    $page_title = 'Harga Emas Ar-Rahnu Malaysia - Senarai Ar-Rahnu Bank & Institusi';
    $page_slug = 'ar-rahnu';
    $page_description = 'Dapatkan harga emas Ar-Rahnu terkini dari semua bank dan institusi Ar-Rahnu di Malaysia. Bandingkan harga Ar-Rahnu Agrobank, Bank Islam, Bank Muamalat, X\'Change, YaPEIM, CIMB Islamic, RHB Islamic, dan banyak lagi.';
    $page_keywords = 'harga emas ar-rahnu, ar-rahnu malaysia, ar-rahnu xchange, ar-rahnu yapeim, ar-rahnu bank, ar-rahnu agrobank, ar-rahnu bank islam, ar-rahnu bank muamalat, ar-rahnu cimb islamic, ar-rahnu rhb islamic, harga ar-rahnu, pinjaman ar-rahnu';
}

// Fetch Ar-Rahnu prices from API
$ar_rahnu_prices = hrgms_fetch_ar_rahnu_prices();

// Get current date for SEO
$current_date = date('d F Y');
$current_year = date('Y');

// Get Ar-Rahnu list
$ar_rahnu_list = array();
if ($ar_rahnu_prices && isset($ar_rahnu_prices['arRahnu']) && is_array($ar_rahnu_prices['arRahnu'])) {
    $ar_rahnu_list = $ar_rahnu_prices['arRahnu'];
}

// Sort by name for better organization
usort($ar_rahnu_list, function($a, $b) {
    $name_a = isset($a['name']) ? $a['name'] : '';
    $name_b = isset($b['name']) ? $b['name'] : '';
    return strcasecmp($name_a, $name_b);
});

get_header();
?>

<!-- Structured Data for SEO (JSON-LD) -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebPage",
  "name": "<?php echo esc_js($page_title); ?> <?php echo $current_year; ?>",
  "description": "<?php echo esc_js($page_description); ?>",
  "url": "<?php echo esc_url(home_url('/' . $page_slug . '/')); ?>",
  "mainEntity": {
    "@type": "FAQPage",
    "mainEntity": [
      {
        "@type": "Question",
        "name": "Apakah harga emas Ar-Rahnu di Malaysia?",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "Harga emas Ar-Rahnu di Malaysia berbeza mengikut institusi. Harga Ar-Rahnu adalah harga marhun (cagaran) yang digunakan oleh bank Ar-Rahnu, lembaga zakat negeri, dan syarikat berasaskan Islamik. Harga biasanya lebih rendah daripada harga spot emas kerana ia digunakan untuk pinjaman dengan cagaran emas."
        }
      },
      {
        "@type": "Question",
        "name": "Di mana boleh bandingkan pinjaman Ar-Rahnu?",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "Anda boleh bandingkan pinjaman Ar-Rahnu dari pelbagai institusi menggunakan kalkulator perbandingan Ar-Rahnu di hargaemas.my/ar-rahnu/calculator. Tambah item emas anda dan pilih Ar-Rahnu untuk dibandingkan untuk melihat jumlah pinjaman yang boleh diperolehi."
        }
      },
      {
        "@type": "Question",
        "name": "Apakah perbezaan Ar-Rahnu X'Change, Ar-Rahnu YaPEIM, dan Ar-Rahnu Bank?",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "Ar-Rahnu X'Change, Ar-Rahnu YaPEIM, dan Ar-Rahnu Bank adalah institusi yang berbeza yang menawarkan perkhidmatan pajak gadai Islam. Setiap institusi mempunyai kadar harga Ar-Rahnu yang berbeza. Ar-Rahnu X'Change adalah perkhidmatan dari X'Change, Ar-Rahnu YaPEIM adalah dari Yayasan Pembangunan Ekonomi Islam Malaysia, manakala Ar-Rahnu Bank merujuk kepada bank-bank Islam seperti Bank Islam, Bank Muamalat, CIMB Islamic, dan RHB Islamic."
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
<header class="hrgms-hero hrgms-hero-simple" style="padding: 40px 0;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center">
                <?php hrgms_breadcrumb(); ?>
                <h1 class="hrgms-hero-title" style="font-size: 2rem; margin-bottom: 1rem;">
                    <i class="bi bi-bank me-2"></i><?php echo esc_html($page_title); ?>
                </h1>
                <p class="hrgms-hero-subtitle" style="font-size: 1.1rem;">
                    <?php echo $is_harga_emas_ar_rahnu_hari_ini ? 'Harga Ar-Rahnu terkini hari ini dari semua bank dan institusi di Malaysia' : 'Senarai lengkap harga Ar-Rahnu dari semua bank dan institusi di Malaysia'; ?>
                </p>
                <?php if ($ar_rahnu_prices && isset($ar_rahnu_prices['lastUpdate'])) : ?>
                <p class="text-white-50 mt-2 small">
                    <i class="bi bi-clock me-1"></i>Dikemaskini: <?php echo date('d M Y, H:i', strtotime($ar_rahnu_prices['lastUpdate'])); ?>
                </p>
                <?php endif; ?>
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
                        <h2 class="h4 mb-3">Apakah Ar-Rahnu?</h2>
                        <p class="lead">
                            <strong>Ar-Rahnu</strong> adalah sistem pajak gadai Islam yang membolehkan anda mendapatkan pinjaman dengan 
                            menggunakan emas sebagai cagaran. Berbeza dengan pajak gadai konvensional, Ar-Rahnu mengikut prinsip syariah 
                            dan tidak mengenakan faedah (riba).
                        </p>
                        
                        <h3 class="h5 mt-4 mb-3">Cara Ar-Rahnu Berfungsi</h3>
                        <ol>
                            <li>Anda membawa emas (barang kemas, jongkong emas) ke institusi Ar-Rahnu</li>
                            <li>Emas dinilai berdasarkan harga Ar-Rahnu semasa (biasanya 65-70% dari harga spot)</li>
                            <li>Anda menerima pinjaman berdasarkan nilai emas yang dinilai</li>
                            <li>Anda boleh menebus emas dengan membayar balik pinjaman dalam tempoh yang ditetapkan</li>
                            <li>Jika tidak ditebus, emas akan dijual dan baki (jika ada) akan dikembalikan</li>
                        </ol>
                        
                        <div class="alert alert-info mt-4">
                            <i class="bi bi-info-circle me-2"></i>
                            <strong>Nota Penting:</strong> Harga Ar-Rahnu yang dipaparkan adalah per gram dan mungkin berbeza mengikut cawangan. 
                            Harga ini adalah untuk rujukan sahaja. Sila hubungi institusi Ar-Rahnu terdekat untuk harga terkini dan terma pinjaman.
                        </div>
                        
                        <div class="text-center mt-4">
                            <a href="https://www.hargaemas.my/ar-rahnu/calculator?selected=ARX" target="_blank" rel="noopener" class="btn btn-hrgms-primary btn-lg">
                                <i class="bi bi-calculator me-2"></i>Bandingkan Pinjaman Ar-Rahnu
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Ar-Rahnu Institutions Listing -->
                <?php if (!empty($ar_rahnu_list)) : ?>
                <div class="card mb-4" style="border: 1px solid var(--hrgms-card-border); box-shadow: var(--hrgms-card-shadow);">
                    <div class="card-body p-4 p-lg-5">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h2 class="h3 mb-0">
                                <i class="bi bi-bank me-2"></i>Senarai Institusi Ar-Rahnu di Malaysia
                            </h2>
                            <span class="badge bg-primary"><?php echo count($ar_rahnu_list); ?> Institusi</span>
                        </div>
                        
                        <div class="row g-4">
                            <?php 
                            foreach ($ar_rahnu_list as $institution) : 
                                $name = isset($institution['name']) ? $institution['name'] : 'Ar-Rahnu';
                                $id = isset($institution['id']) ? $institution['id'] : '';
                                
                                // Get prices from prices array (structure: prices['999'], prices['916'], etc.)
                                $prices = isset($institution['prices']) && is_array($institution['prices']) ? $institution['prices'] : array();
                                $price_999 = isset($prices['999']) ? floatval($prices['999']) : 0;
                                $price_916 = isset($prices['916']) ? floatval($prices['916']) : 0;
                                $price_835 = isset($prices['835']) ? floatval($prices['835']) : 0;
                                $price_750 = isset($prices['750']) ? floatval($prices['750']) : 0;
                                
                                // Get highest price for display
                                $highest_price = max($price_999, $price_916, $price_835, $price_750);
                                
                                // Generate card color based on institution type
                                $card_colors = array(
                                    'Agrobank' => array('bg' => '#77ac68', 'text' => '#fff'),
                                    'Bank Islam' => array('bg' => '#1e3a5f', 'text' => '#fff'),
                                    'Bank Muamalat' => array('bg' => '#e95420', 'text' => '#fff'),
                                    'X\'Change' => array('bg' => '#f39c12', 'text' => '#fff'),
                                    'YaPEIM' => array('bg' => '#9b59b6', 'text' => '#fff'),
                                    'CIMB' => array('bg' => '#e74c3c', 'text' => '#fff'),
                                    'RHB' => array('bg' => '#3498db', 'text' => '#fff'),
                                );
                                
                                $card_color = array('bg' => '#1e3a5f', 'text' => '#fff');
                                foreach ($card_colors as $key => $color) {
                                    if (stripos($name, $key) !== false) {
                                        $card_color = $color;
                                        break;
                                    }
                                }
                            ?>
                                <div class="col-6 col-md-4 col-lg-3">
                                    <div class="product-card h-100" style="border: 2px solid <?php echo esc_attr($card_color['bg']); ?>; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                                        <div class="product-image" style="height: 120px; background: linear-gradient(135deg, <?php echo esc_attr($card_color['bg']); ?>, <?php echo esc_attr($card_color['bg']); ?>dd); display: flex; align-items: center; justify-content: center;">
                                            <i class="bi bi-bank text-white" style="font-size: 3rem;"></i>
                                        </div>
                                        <div class="product-body p-3">
                                            <h4 class="product-title" style="font-size: 0.95rem; margin-bottom: 0.75rem; min-height: 2.5rem;">
                                                <?php echo esc_html($name); ?>
                                            </h4>
                                            
                                            <?php if ($highest_price > 0) : ?>
                                                <div class="mb-2">
                                                    <small class="text-muted d-block mb-1">Harga Tertinggi:</small>
                                                    <strong class="text-primary" style="font-size: 1.1rem;">
                                                        <?php echo hrgms_format_ar_rahnu_price($highest_price); ?>/g
                                                    </strong>
                                                </div>
                                                
                                                <div class="small text-muted mb-3">
                                                    <?php if ($price_999 > 0) : ?>
                                                        <div>999: <?php echo hrgms_format_ar_rahnu_price($price_999); ?>/g</div>
                                                    <?php endif; ?>
                                                    <?php if ($price_916 > 0) : ?>
                                                        <div>916: <?php echo hrgms_format_ar_rahnu_price($price_916); ?>/g</div>
                                                    <?php endif; ?>
                                                    <?php if ($price_835 > 0) : ?>
                                                        <div>835: <?php echo hrgms_format_ar_rahnu_price($price_835); ?>/g</div>
                                                    <?php endif; ?>
                                                    <?php if ($price_750 > 0) : ?>
                                                        <div>750: <?php echo hrgms_format_ar_rahnu_price($price_750); ?>/g</div>
                                                    <?php endif; ?>
                                                </div>
                                            <?php else : ?>
                                                <p class="text-muted small mb-3">Harga tidak tersedia</p>
                                            <?php endif; ?>
                                            
                                            <a href="https://www.hargaemas.my/ar-rahnu/calculator?selected=<?php echo esc_attr($id); ?>" 
                                               target="_blank" 
                                               rel="noopener" 
                                               class="btn btn-sm btn-product w-100"
                                               style="background: <?php echo esc_attr($card_color['bg']); ?>; color: <?php echo esc_attr($card_color['text']); ?>; border: none;">
                                                <i class="bi bi-calculator me-1"></i>Kira Pinjaman
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        
                        <div class="text-center mt-4">
                            <a href="https://www.hargaemas.my/ar-rahnu/calculator?selected=ARX" target="_blank" rel="noopener" class="btn btn-hrgms-primary btn-lg">
                                <i class="bi bi-calculator me-2"></i>Bandingkan Semua Ar-Rahnu
                            </a>
                        </div>
                    </div>
                </div>
                <?php else : ?>
                <div class="card mb-4" style="border: 1px solid var(--hrgms-card-border); box-shadow: var(--hrgms-card-shadow);">
                    <div class="card-body p-4 p-lg-5">
                        <div class="alert alert-warning">
                            <i class="bi bi-exclamation-triangle me-2"></i>
                            Data Ar-Rahnu tidak tersedia pada masa ini. Sila cuba lagi kemudian atau 
                            <a href="https://www.hargaemas.my/ar-rahnu/calculator" target="_blank" rel="noopener" class="alert-link">lawati kalkulator Ar-Rahnu</a>.
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                
                <!-- Additional Information -->
                <div class="card mb-4" style="border: 1px solid var(--hrgms-card-border); box-shadow: var(--hrgms-card-shadow);">
                    <div class="card-body p-4 p-lg-5">
                        <h2 class="h4 mb-3">Maklumat Penting tentang Ar-Rahnu</h2>
                        
                        <h3 class="h5 mt-4 mb-3">Kelebihan Ar-Rahnu</h3>
                        <ul>
                            <li><strong>Tiada faedah (riba)</strong> - Mengikut prinsip syariah Islam</li>
                            <li><strong>Proses cepat</strong> - Pinjaman boleh diperolehi dalam masa yang singkat</li>
                            <li><strong>Selamat</strong> - Emas disimpan dengan selamat di institusi Ar-Rahnu</li>
                            <li><strong>Fleksibel</strong> - Boleh menebus emas pada bila-bila masa</li>
                            <li><strong>Transparent</strong> - Harga dan terma jelas dan telus</li>
                        </ul>
                        
                        <h3 class="h5 mt-4 mb-3">Perkara yang Perlu Diperhatikan</h3>
                        <ul>
                            <li>Harga Ar-Rahnu biasanya lebih rendah daripada harga spot emas (sekitar 65-70%)</li>
                            <li>Setiap institusi mempunyai terma dan syarat yang berbeza</li>
                            <li>Tempoh pinjaman berbeza mengikut institusi (biasanya 6-12 bulan)</li>
                            <li>Yuran penyimpanan mungkin dikenakan</li>
                            <li>Jika tidak ditebus dalam tempoh yang ditetapkan, emas akan dijual</li>
                        </ul>
                        
                        <div class="alert alert-success mt-4">
                            <i class="bi bi-lightbulb me-2"></i>
                            <strong>Tips:</strong> Gunakan kalkulator perbandingan Ar-Rahnu untuk melihat jumlah pinjaman yang boleh diperolehi 
                            dari setiap institusi sebelum membuat keputusan. Ini membantu anda memilih Ar-Rahnu yang paling sesuai dengan keperluan anda.
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

