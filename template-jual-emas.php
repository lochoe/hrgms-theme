<?php
/**
 * File: template-jual-emas.php
 * Purpose: SEO-optimized page for Jual Beli Emas with WhatsApp CTA
 * URL: /jual-emas/
 * Notes: Mobile-first design, optimized for conversion with prominent WhatsApp button
 */

if (!defined('ABSPATH')) {
    exit;
}

// Fetch gold prices from API
$gold_prices = hrgms_fetch_gold_prices();

// Get current date for SEO
$current_date = date('d F Y');
$current_year = date('Y');

// Get MksSell price (selling price) for reference
$mks_sell_per_kg = $gold_prices && isset($gold_prices['prices']['MksSell']) 
    ? floatval($gold_prices['prices']['MksSell']) 
    : 0;
$mks_sell_per_gram = $mks_sell_per_kg / 1000;

// SEO variables
$page_title = 'Jual Beli Emas 916 Terpakai - Harga Terbaik di Malaysia';
$page_description = 'Jual dan beli emas 916 terpakai dengan harga terbaik di Malaysia. Kami beli emas 916, 999, 835, 750 dengan harga kompetitif. Harga emas 916 hari ini, kedai emas pembeli emas, surat pajak. Hubungi kami untuk tawaran terbaik.';
$page_keywords = 'jual emas, beli emas, jual emas 916, beli emas 916, jual emas terpakai, beli emas terpakai, harga emas 916 hari ini, kedai emas pembeli emas, surat pajak, jual emas malaysia';

// WhatsApp number
$whatsapp_number = '60122864232';
$whatsapp_url = 'https://wa.me/' . $whatsapp_number . '?text=' . urlencode('Halo, saya ingin jual/beli emas. Boleh dapatkan maklumat lanjut?');

get_header();
?>

<!-- Structured Data for SEO (JSON-LD) -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebPage",
  "name": "<?php echo esc_js($page_title); ?> <?php echo $current_year; ?>",
  "description": "<?php echo esc_js($page_description); ?>",
  "url": "<?php echo esc_url(home_url('/jual-emas/')); ?>",
  "mainEntity": {
    "@type": "FAQPage",
    "mainEntity": [
      {
        "@type": "Question",
        "name": "Berapa harga emas 916 hari ini untuk jualan?",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "Harga emas 916 hari ini berubah setiap hari mengikut pasaran. Harga jualan emas 916 biasanya adalah sekitar <?php echo $mks_sell_per_gram > 0 ? hrgms_format_price_per_gram($mks_sell_per_gram * 1000 * 0.916) : 'RM 50-52'; ?> per gram (selepas tolak susut nilai 5-10%). Hubungi kami melalui WhatsApp untuk harga terkini dan tawaran terbaik."
        }
      },
      {
        "@type": "Question",
        "name": "Apakah beza dan kelebihan emas 916?",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "Emas 916 dikira emas 22K iaitu mempunyai campuran 91.6% emas dan selebihnya adalah logam lain seperti copper, silver, mangan. Emas 916 dikira emas bermutu tinggi dan sesuai untuk dijadikan perhiasan kerana fizikalnya yang lebih keras dari emas 999 dan boleh dibentuk dengan mudah."
        }
      },
      {
        "@type": "Question",
        "name": "Bila waktu terbaik untuk jual emas 916?",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "Harga emas akan berada pada puncak tertinggi apabila berlaku tragedi kepada kuasa ekonomi dunia seperti US, China, India, German, Jepun dan UK, dan juga apa sahaja event yang menyebabkan matawang Ringgit jatuh. Harga emas berubah setiap hari, jadi sentiasa pantau harga terkini sebelum membuat keputusan."
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
        "name": "Jual Beli Emas",
        "item": "<?php echo esc_url(home_url('/jual-emas/')); ?>"
      }
    ]
  }
}
</script>

<!-- Hero Section with WhatsApp CTA -->
<header class="hrgms-hero hrgms-hero-simple" style="padding: 40px 0;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center">
                <?php hrgms_breadcrumb(); ?>
                <h1 class="hrgms-hero-title" style="font-size: 2rem; margin-bottom: 1rem;">
                    <i class="bi bi-cash-coin me-2"></i>Jual Beli Emas 916 Terpakai
                </h1>
                <p class="hrgms-hero-subtitle" style="font-size: 1.1rem;">
                    Harga emas 916 hari ini - Kedai emas pembeli emas - Surat pajak
                </p>
                
                <!-- Prominent WhatsApp CTA Button -->
                <div class="mt-4">
                    <a href="<?php echo esc_url($whatsapp_url); ?>" 
                       target="_blank" 
                       rel="noopener" 
                       class="btn btn-success btn-lg shadow-lg"
                       style="font-size: 1.2rem; padding: 15px 30px; border-radius: 50px; background: linear-gradient(135deg, #25D366 0%, #128C7E 100%); border: none;">
                        <i class="bi bi-whatsapp me-2" style="font-size: 1.5rem;"></i>
                        WhatsApp Kami Sekarang
                    </a>
                    <p class="text-white-50 mt-3 small">
                        <i class="bi bi-telephone me-1"></i>+<?php echo esc_html($whatsapp_number); ?> | 
                        <i class="bi bi-clock me-1"></i>Respon Pantas 24/7
                    </p>
                </div>
                
                <?php if ($gold_prices && isset($gold_prices['lastUpdate'])) : ?>
                <p class="text-white-50 mt-2 small">
                    <i class="bi bi-clock me-1"></i>Harga dikemaskini: <?php echo date('d M Y, H:i', strtotime($gold_prices['lastUpdate'])); ?>
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
                
                <!-- Jual Emas dan Beli Emas untuk Harga Terbaik -->
                <div class="card mb-4" style="border: 1px solid var(--hrgms-card-border); box-shadow: var(--hrgms-card-shadow);">
                    <div class="card-body p-4 p-lg-5">
                        <h2 class="h3 mb-4">
                            <i class="bi bi-gem me-2 text-warning"></i>Jual Emas dan Beli Emas untuk Harga Terbaik
                        </h2>
                        <p class="lead">
                            Harga emas berubah setiap hari, jadi apa waktu terbaik untuk jual emas 916 pada harga paling tinggi? 
                            Harga emas Malaysia bergerak sama seperti harga emas dunia, harga emas akan berada pada puncak tertinggi 
                            apabila berlaku tragedi kepada kuasa ekonomi dunia seperti US, China, India, German, Jepun dan UK, 
                            dan juga apa sahaja event yang menyebabkan matawang Ringgit jatuh.
                        </p>
                        <p>
                            Ingin jual emas pada harga tertinggi? Hubungi kami melalui WhatsApp untuk mendapatkan update harga terkini 
                            dan tawaran terbaik untuk emas anda.
                        </p>
                        
                        <!-- WhatsApp CTA Card -->
                        <div class="alert alert-success border-0 shadow-sm mt-4" style="background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <i class="bi bi-whatsapp text-success" style="font-size: 3rem;"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="alert-heading mb-2">Dapatkan Harga Terkini Sekarang!</h5>
                                    <p class="mb-3">Isikan borang atau WhatsApp kami untuk mendapatkan update harga emas harian dan tawaran terbaik.</p>
                                    <a href="<?php echo esc_url($whatsapp_url); ?>" 
                                       target="_blank" 
                                       rel="noopener" 
                                       class="btn btn-success">
                                        <i class="bi bi-whatsapp me-2"></i>WhatsApp Sekarang
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Kenapa Memilih Kami -->
                <div class="card mb-4" style="border: 1px solid var(--hrgms-card-border); box-shadow: var(--hrgms-card-shadow);">
                    <div class="card-body p-4 p-lg-5">
                        <h2 class="h3 mb-4">
                            <i class="bi bi-star-fill me-2 text-warning"></i>Kenapa Memilih untuk Berurusan dengan Kami?
                        </h2>
                        <div class="row g-4">
                            <div class="col-md-6 col-lg-3">
                                <div class="text-center p-3 h-100" style="background: #f8f9fa; border-radius: 10px;">
                                    <i class="bi bi-calendar-check text-primary" style="font-size: 2.5rem;"></i>
                                    <h5 class="mt-3 mb-2">Sejak 2007</h5>
                                    <p class="small text-muted mb-0">Kami telah beroperasi sejak 2007 dengan pengalaman lebih 15 tahun dalam jual beli emas.</p>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="text-center p-3 h-100" style="background: #f8f9fa; border-radius: 10px;">
                                    <i class="bi bi-people text-primary" style="font-size: 2.5rem;"></i>
                                    <h5 class="mt-3 mb-2">80,000+ Followers</h5>
                                    <p class="small text-muted mb-0">Hampir 80,000 likers di Facebook page kami (real likers, bukan fake).</p>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="text-center p-3 h-100" style="background: #f8f9fa; border-radius: 10px;">
                                    <i class="bi bi-graph-up text-primary" style="font-size: 2.5rem;"></i>
                                    <h5 class="mt-3 mb-2">Harga Setiap Hari</h5>
                                    <p class="small text-muted mb-0">Kami memaparkan harga emas setiap hari di laman web, pelanggan boleh merujuk harga harian di sini.</p>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="text-center p-3 h-100" style="background: #f8f9fa; border-radius: 10px;">
                                    <i class="bi bi-telegram text-primary" style="font-size: 2.5rem;"></i>
                                    <h5 class="mt-3 mb-2">Update Harian</h5>
                                    <p class="small text-muted mb-0">Pelanggan boleh mendapat update harga emas harian di Telegram, klik ke t.me/hrgms</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="alert alert-info mt-4">
                            <i class="bi bi-info-circle me-2"></i>
                            <strong>Bonus:</strong> Pelanggan boleh membeli emas 20% lebih murah dari kedai emas melalui kawan-kawan peniaga online kami di Ibukutu.com
                        </div>
                    </div>
                </div>
                
                <!-- Apakah Beza dan Kelebihan Emas 916 -->
                <div class="card mb-4" style="border: 1px solid var(--hrgms-card-border); box-shadow: var(--hrgms-card-shadow);">
                    <div class="card-body p-4 p-lg-5">
                        <h2 class="h3 mb-4">
                            <i class="bi bi-question-circle me-2 text-primary"></i>Apakah Beza dan Kelebihan Emas 916
                        </h2>
                        <p>
                            Emas 916 dikira emas 22K iaitu mempunyai campuran <strong>91.6%</strong> dan selebihnya adalah logam lain 
                            seperti copper, silver, mangan dan sebagainya. 916 dikira emas bermutu tinggi dan sesuai untuk dijadikan 
                            perhiasan kerana fizikalnya yang lebih keras dari emas 999 dan boleh dibentuk dengan mudah.
                        </p>
                        <p>
                            916 biasanya jarang diletakkan dengan batu permata, diamond, mutiara kerana batu mudah tertanggal dan tidak 
                            dapat diikat dengan kemas. 916 hanya popular di negara asia dari india, china dan asia tenggara sahaja, 
                            di negara barat, kebanyakan barang perhiasan akan dibuat dari emas 18K kebawah.
                        </p>
                        <p class="lead">
                            <strong>Harga emas 916 dikira paling popular di Malaysia</strong>, soalan umum seperti "Berapa harga emas hari ini" 
                            biasanya merujuk kepada harga emas 916.
                        </p>
                    </div>
                </div>
                
                <!-- Apa yang Boleh Menyebabkan Mutu Emas 916 Jatuh -->
                <div class="card mb-4" style="border: 1px solid var(--hrgms-card-border); box-shadow: var(--hrgms-card-shadow);">
                    <div class="card-body p-4 p-lg-5">
                        <h2 class="h3 mb-4">
                            <i class="bi bi-exclamation-triangle me-2 text-warning"></i>Apa yang Boleh Menyebabkan Mutu Emas 916 Jatuh?
                        </h2>
                        <ul class="list-unstyled">
                            <li class="mb-3">
                                <div class="d-flex">
                                    <i class="bi bi-check-circle-fill text-danger me-3" style="font-size: 1.2rem;"></i>
                                    <div>
                                        <strong>Pajak di Ar-Rahnu</strong> - Mutu emas 916 boleh jatuh apabila pemajak memajak di arrahnu, 
                                        ini kerana arrahnu menggunakan timbangan air, iaitu density metre. Ada sesetengah design yang hollow 
                                        memerangkap buih udara menyebabkan mesin tidak dapat memberi bacaan yang tepat.
                                    </div>
                                </div>
                            </li>
                            <li class="mb-3">
                                <div class="d-flex">
                                    <i class="bi bi-check-circle-fill text-danger me-3" style="font-size: 1.2rem;"></i>
                                    <div>
                                        <strong>Banyak Pateri</strong> - Mutu emas juga boleh jatuh apabila pateri banyak digunakan untuk membuat 
                                        design barang kemas terutamanya emas design india. Kebiasaan emas yang ada banyak pateri hanya mendapat 
                                        mutu 87% sahaja selepas dileburkan kerana susut dengan logam lain.
                                    </div>
                                </div>
                            </li>
                            <li class="mb-3">
                                <div class="d-flex">
                                    <i class="bi bi-check-circle-fill text-danger me-3" style="font-size: 1.2rem;"></i>
                                    <div>
                                        <strong>Emas Patern Italy</strong> - Emas patern italy yang popular kini juga banyak menggunakan komponen 
                                        emas mutu rendah menyebabkan mutu emas juga susut.
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <div class="alert alert-warning mt-4">
                            <i class="bi bi-lightbulb me-2"></i>
                            <strong>Tips:</strong> Sebagai langkah selamat untuk mereka membeli emas 916 untuk pelaburan, 
                            belilah emas design biasa sahaja.
                        </div>
                    </div>
                </div>
                
                <!-- WhatsApp CTA Section - Prominent -->
                <div class="card mb-4 border-0 shadow-lg" style="background: linear-gradient(135deg, #25D366 0%, #128C7E 100%);">
                    <div class="card-body p-5 text-center text-white">
                        <i class="bi bi-whatsapp mb-3" style="font-size: 4rem;"></i>
                        <h2 class="h3 mb-3">Sedia untuk Jual atau Beli Emas?</h2>
                        <p class="lead mb-4">
                            Hubungi kami melalui WhatsApp untuk mendapatkan harga terkini dan tawaran terbaik. 
                            Kami akan respon dengan pantas!
                        </p>
                        <a href="<?php echo esc_url($whatsapp_url); ?>" 
                           target="_blank" 
                           rel="noopener" 
                           class="btn btn-light btn-lg shadow"
                           style="font-size: 1.2rem; padding: 15px 40px; border-radius: 50px;">
                            <i class="bi bi-whatsapp me-2"></i>WhatsApp Kami Sekarang
                        </a>
                        <p class="mt-3 mb-0">
                            <i class="bi bi-telephone me-1"></i>+<?php echo esc_html($whatsapp_number); ?> | 
                            <i class="bi bi-clock me-1"></i>Respon Pantas 24/7
                        </p>
                    </div>
                </div>
                
                <!-- Harga Emas Hari Ini Reference -->
                <?php if ($gold_prices && isset($gold_prices['prices'])) : ?>
                <div class="card mb-4" style="border: 1px solid var(--hrgms-card-border); box-shadow: var(--hrgms-card-shadow);">
                    <div class="card-body p-4 p-lg-5">
                        <h2 class="h3 mb-4">
                            <i class="bi bi-graph-up me-2 text-success"></i>Harga Emas Hari Ini (Rujukan)
                        </h2>
                        <p class="mb-3">
                            Harga di bawah adalah harga spot (raw material) untuk rujukan sahaja. 
                            Harga sebenar untuk jualan akan tolak susut nilai 5-10%, manakala untuk belian akan tambah premium 5-10%.
                        </p>
                        <div class="row g-3">
                            <div class="col-6 col-md-3">
                                <div class="p-3 text-center" style="background: #f8f9fa; border-radius: 8px;">
                                    <small class="text-muted d-block mb-1">Emas 999</small>
                                    <strong class="text-primary" style="font-size: 1.2rem;">
                                        <?php echo hrgms_format_price_per_gram($mks_sell_per_kg); ?>/g
                                    </strong>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="p-3 text-center" style="background: #f8f9fa; border-radius: 8px;">
                                    <small class="text-muted d-block mb-1">Emas 916</small>
                                    <strong class="text-primary" style="font-size: 1.2rem;">
                                        <?php echo hrgms_format_price_per_gram($mks_sell_per_kg * 0.916); ?>/g
                                    </strong>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="p-3 text-center" style="background: #f8f9fa; border-radius: 8px;">
                                    <small class="text-muted d-block mb-1">Emas 835</small>
                                    <strong class="text-primary" style="font-size: 1.2rem;">
                                        <?php echo hrgms_format_price_per_gram($mks_sell_per_kg * 0.835); ?>/g
                                    </strong>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="p-3 text-center" style="background: #f8f9fa; border-radius: 8px;">
                                    <small class="text-muted d-block mb-1">Emas 750</small>
                                    <strong class="text-primary" style="font-size: 1.2rem;">
                                        <?php echo hrgms_format_price_per_gram($mks_sell_per_kg * 0.750); ?>/g
                                    </strong>
                                </div>
                            </div>
                        </div>
                        <div class="alert alert-info mt-3">
                            <i class="bi bi-info-circle me-2"></i>
                            <strong>Nota:</strong> Harga di atas adalah untuk rujukan sahaja. Hubungi kami melalui WhatsApp untuk mendapatkan 
                            harga sebenar untuk jualan atau belian emas anda.
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                
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


