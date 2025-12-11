<?php
/**
 * File: template-surat-pajak.php
 * Purpose: SEO-optimized page for Jual Surat Pajak with WhatsApp CTA
 * URL: /surat-pajak/
 * Notes: Mobile-first design, optimized for conversion with prominent WhatsApp button
 *        Main income page - highly optimized for SEO and conversion
 */

if (!defined('ABSPATH')) {
    exit;
}

// Get current date for SEO
$current_date = date('d F Y');
$current_year = date('Y');

// SEO variables - optimized for "jual surat pajak" keywords
$page_title = 'Jual Surat Pajak - Cara Jual Surat Pajak Gadai Emas & Ar-Rahnu';
$page_description = 'Jual surat pajak gadai emas dan ar-rahnu dengan harga terbaik. Kami beli surat pajak yang tamat tempoh atau masih aktif. Perkhidmatan jual surat pajak di seluruh Malaysia. Hubungi kami untuk tawaran terbaik.';
$page_keywords = 'jual surat pajak, cara jual surat pajak, jual surat pajak gadai emas, jual surat pajak ar-rahnu, jual surat pajak tamat tempoh, beli surat pajak, jual surat pajak malaysia, surat pajak gadai emas, surat pajak ar-rahnu';

// WhatsApp number
$whatsapp_number = '60122864232';
$whatsapp_url = 'https://wa.me/' . $whatsapp_number . '?text=' . urlencode('Halo, saya ada surat pajak yang nak dijual. Boleh dapatkan maklumat lanjut?');

get_header();
?>

<!-- Structured Data for SEO (JSON-LD) -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebPage",
  "name": "<?php echo esc_js($page_title); ?> <?php echo $current_year; ?>",
  "description": "<?php echo esc_js($page_description); ?>",
  "url": "<?php echo esc_url(home_url('/surat-pajak/')); ?>",
  "mainEntity": {
    "@type": "FAQPage",
    "mainEntity": [
      {
        "@type": "Question",
        "name": "Bagaimana cara jual surat pajak?",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "Untuk jual surat pajak, hubungi kami melalui WhatsApp. Kami akan membantu menebus surat pajak anda dan membeli barang kemas tersebut. Baki dari harga sebenar item ditolak nilai tebusan akan diserahkan kembali kepada pemilik sebelum tempoh masa surat pajak tamat."
        }
      },
      {
        "@type": "Question",
        "name": "Bolehkah jual surat pajak yang sudah tamat tempoh?",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "Ya, kami boleh membantu jual surat pajak yang sudah tamat tempoh. Elakkan dari nama disenarai hitam kerana tidak menebus emas sebelum dilelong, jual surat dengan segera. Anda masih boleh mendapat wang tunai apabila kami menebus item untuk anda."
        }
      },
      {
        "@type": "Question",
        "name": "Apakah perbezaan surat pajak gadai konvensional dan ar-rahnu?",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "Surat pajak gadai konvensional: Bunga pinjaman tinggi (2% sebulan atau 24% setahun), surat pajak tamat tempoh akan dijual. Surat pajak Ar-Rahnu: Upah pinjaman rendah (0.75% sebulan), surat pajak boleh disambung, lelongan dibuat secara terbuka, tetapi nama pemajak dimasukkan dalam CCRIS."
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
        "name": "Jual Surat Pajak",
        "item": "<?php echo esc_url(home_url('/surat-pajak/')); ?>"
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
                    <i class="bi bi-file-earmark-text me-2"></i>Jual Surat Pajak Gadai Emas & Ar-Rahnu
                </h1>
                <p class="hrgms-hero-subtitle" style="font-size: 1.1rem;">
                    Cara jual surat pajak dengan harga terbaik - Perkhidmatan di seluruh Malaysia
                </p>
                
                <!-- Prominent WhatsApp CTA Button -->
                <div class="mt-4">
                    <a href="<?php echo esc_url($whatsapp_url); ?>" 
                       target="_blank" 
                       rel="noopener" 
                       class="btn btn-success btn-lg shadow-lg"
                       style="font-size: 1.2rem; padding: 15px 30px; border-radius: 50px; background: linear-gradient(135deg, #25D366 0%, #128C7E 100%); border: none;">
                        <i class="bi bi-whatsapp me-2" style="font-size: 1.5rem;"></i>
                        WhatsApp untuk Jual Surat Pajak
                    </a>
                    <p class="text-white-50 mt-3 small">
                        <i class="bi bi-telephone me-1"></i>+<?php echo esc_html($whatsapp_number); ?> | 
                        <i class="bi bi-clock me-1"></i>Respon Pantas 24/7 | 
                        <i class="bi bi-geo-alt me-1"></i>Seluruh Malaysia
                    </p>
                </div>
            </div>
        </div>
    </div>
</header>

<section class="hrgms-products">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                
                <!-- Introduction - Jual Surat Pajak -->
                <div class="card mb-4 border-0 shadow-lg" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
                    <div class="card-body p-4 p-lg-5">
                        <h2 class="h3 mb-4">
                            <i class="bi bi-cash-coin me-2 text-success"></i>Jual Surat Pajak dengan Harga Terbaik
                        </h2>
                        <p class="lead">
                            Salah satu kelebihan surat pajak ataupun menyimpan emas adalah kerana komoditi ini sangat mudah dicairkan 
                            (kebentuk tunai) dimana emas boleh dijual atau dipajak pada bila-bila masa.
                        </p>
                        <p>
                            Bagi mereka yang ingin <strong>menjual surat pajak yang tidak ditebus</strong>, kami boleh membantu pemilik untuk 
                            menebus serta membeli barang kemas anda. <strong>Baki dari harga sebenar item ditolak nilai tebusan akan diserahkan 
                            kembali kepada pemilik sebelum tempoh masa surat pajak tamat.</strong>
                        </p>
                        
                        <!-- WhatsApp CTA Card -->
                        <div class="alert alert-success border-0 shadow-sm mt-4" style="background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <i class="bi bi-whatsapp text-success" style="font-size: 3rem;"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="alert-heading mb-2">Nak Jual Surat Pajak? Hubungi Kami Sekarang!</h5>
                                    <p class="mb-3">Kami pakar dalam jual beli surat pajak. WhatsApp kami untuk dapatkan tawaran terbaik dan nasihat percuma tentang surat pajak anda.</p>
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
                
                <!-- Kenapa Pilih Kami untuk Jual Surat Pajak -->
                <div class="card mb-4" style="border: 1px solid var(--hrgms-card-border); box-shadow: var(--hrgms-card-shadow);">
                    <div class="card-body p-4 p-lg-5">
                        <h2 class="h3 mb-4">
                            <i class="bi bi-star-fill me-2 text-warning"></i>Kenapa Pilih Kami untuk Jual Surat Pajak?
                        </h2>
                        <div class="row g-4">
                            <div class="col-md-6 col-lg-4">
                                <div class="text-center p-4 h-100" style="background: #f8f9fa; border-radius: 10px; border: 2px solid #25D366;">
                                    <i class="bi bi-geo-alt-fill text-success" style="font-size: 2.5rem;"></i>
                                    <h5 class="mt-3 mb-2">Seluruh Malaysia</h5>
                                    <p class="small text-muted mb-0">Kami beroperasi di seluruh Malaysia. Tidak kira anda di mana, kami boleh membantu jual surat pajak anda.</p>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="text-center p-4 h-100" style="background: #f8f9fa; border-radius: 10px; border: 2px solid #25D366;">
                                    <i class="bi bi-person-check text-success" style="font-size: 2.5rem;"></i>
                                    <h5 class="mt-3 mb-2">Pakar Surat Pajak</h5>
                                    <p class="small text-muted mb-0">Kepakaran kami dalam jual beli surat pajak. Kami faham semua jenis surat pajak - konvensional dan Ar-Rahnu.</p>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="text-center p-4 h-100" style="background: #f8f9fa; border-radius: 10px; border: 2px solid #25D366;">
                                    <i class="bi bi-shield-check text-success" style="font-size: 2.5rem;"></i>
                                    <h5 class="mt-3 mb-2">Selamat & Boleh Dipercayai</h5>
                                    <p class="small text-muted mb-0">Proses jual surat pajak yang selamat dan telus. Baki wang akan diserahkan sebelum tempoh tamat.</p>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="text-center p-4 h-100" style="background: #f8f9fa; border-radius: 10px; border: 2px solid #25D366;">
                                    <i class="bi bi-clock-history text-success" style="font-size: 2.5rem;"></i>
                                    <h5 class="mt-3 mb-2">Proses Pantas</h5>
                                    <p class="small text-muted mb-0">Respon pantas 24/7 melalui WhatsApp. Kami akan bantu proses jual surat pajak dengan cepat.</p>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="text-center p-4 h-100" style="background: #f8f9fa; border-radius: 10px; border: 2px solid #25D366;">
                                    <i class="bi bi-chat-dots text-success" style="font-size: 2.5rem;"></i>
                                    <h5 class="mt-3 mb-2">Nasihat Percuma</h5>
                                    <p class="small text-muted mb-0">Boleh berbual mesra dengan kami untuk bertanya pasal surat pajak. Ini memang kepakaran kami.</p>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="text-center p-4 h-100" style="background: #f8f9fa; border-radius: 10px; border: 2px solid #25D366;">
                                    <i class="bi bi-cash-stack text-success" style="font-size: 2.5rem;"></i>
                                    <h5 class="mt-3 mb-2">Harga Terbaik</h5>
                                    <p class="small text-muted mb-0">Kami tawarkan harga terbaik untuk jual surat pajak. Hubungi untuk dapatkan tawaran terbaik.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Jenis Pajakan Emas di Malaysia -->
                <div class="card mb-4" style="border: 1px solid var(--hrgms-card-border); box-shadow: var(--hrgms-card-shadow);">
                    <div class="card-body p-4 p-lg-5">
                        <h2 class="h3 mb-4">
                            <i class="bi bi-list-ul me-2 text-primary"></i>Jenis Pajakan Emas di Malaysia
                        </h2>
                        <p class="mb-4">
                            Di Malaysia terdapat <strong>3 jenis pajakan emas</strong> yang biasa digunakan iaitu:
                        </p>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="p-3 h-100" style="background: #e3f2fd; border-radius: 8px; border-left: 4px solid #2196F3;">
                                    <h5 class="mb-2">1. Pajak Gadai Islam (Ar-Rahnu)</h5>
                                    <p class="small mb-0">Sistem Ar-Rahnu adalah lebih baik, lebih afdhal, lebih selamat, tidak membebankan dan lebih tersusun.</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="p-3 h-100" style="background: #fff3e0; border-radius: 8px; border-left: 4px solid #FF9800;">
                                    <h5 class="mb-2">2. Pajak Gadai Konvensional</h5>
                                    <p class="small mb-0">Pajak gadai konvensional dengan bunga pinjaman yang lebih tinggi berbanding Ar-Rahnu.</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="p-3 h-100" style="background: #f3e5f5; border-radius: 8px; border-left: 4px solid #9C27B0;">
                                    <h5 class="mb-2">3. Pajak Gadai Pinjaman Berlesen</h5>
                                    <p class="small mb-0">Pajak gadai dengan lesen khas dari pihak berkuasa.</p>
                                </div>
                            </div>
                        </div>
                        <div class="alert alert-info mt-4">
                            <i class="bi bi-info-circle me-2"></i>
                            <strong>Cadangan:</strong> Kami menyarankan anda memilih pajakan secara Ar-Rahnu berbanding pajakan lain 
                            kerana sistem Ar-Rahnu adalah lebih baik dan lebih selamat.
                        </div>
                    </div>
                </div>
                
                <!-- Perbezaan Surat Pajak Gadai Konvensional dan Ar-Rahnu -->
                <div class="card mb-4" style="border: 1px solid var(--hrgms-card-border); box-shadow: var(--hrgms-card-shadow);">
                    <div class="card-body p-4 p-lg-5">
                        <h2 class="h3 mb-4">
                            <i class="bi bi-arrow-left-right me-2 text-warning"></i>Perbezaan Surat Pajak Gadai Konvensional dan Ar-Rahnu
                        </h2>
                        
                        <div class="row g-4">
                            <!-- Konvensional -->
                            <div class="col-lg-6">
                                <div class="h-100 p-4" style="background: #fff3e0; border-radius: 10px; border: 2px solid #FF9800;">
                                    <h4 class="h5 mb-3">
                                        <i class="bi bi-building me-2"></i>Surat Pajak Gadai Konvensional
                                    </h4>
                                    
                                    <h5 class="h6 text-success mb-2">Kelebihan (Pro):</h5>
                                    <ul class="small mb-3">
                                        <li>Senang dan mudah untuk memajak emas, menerima semua jenis emas</li>
                                        <li>Cepat untuk berurusan dan menerima warganegara luar untuk pajak</li>
                                        <li>Menerima bar, syiling, coin, emas padu dan emas berbatu</li>
                                        <li>Boleh berunding jumlah pinjaman samada lebih atau kurang</li>
                                        <li>Buka hampir setiap hari dan berada di kebanyakan tempat</li>
                                        <li>Nama pemajak tidak dimasukkan dalam sistem CCRIS atau CTOS</li>
                                        <li>Tiada limit untuk pajakan sehari</li>
                                    </ul>
                                    
                                    <h5 class="h6 text-danger mb-2">Kekurangan (Cons):</h5>
                                    <ul class="small mb-0">
                                        <li><strong>Bunga pinjaman dikira tinggi hampir 2% sebulan atau 24% setahun</strong></li>
                                        <li>Surat pajak yang tamat tempoh akan dijual dan dianggap lebur</li>
                                        <li>Item yang dipacking seperti laminate bar akan dikoyakkan</li>
                                        <li>Mutu emas dalam pajakan tidak ditulis dan berat tidak selalu tepat</li>
                                        <li>Barang kemas yang elok biasa ditulis bengkok atau sebagainya</li>
                                    </ul>
                                </div>
                            </div>
                            
                            <!-- Ar-Rahnu -->
                            <div class="col-lg-6">
                                <div class="h-100 p-4" style="background: #e3f2fd; border-radius: 10px; border: 2px solid #2196F3;">
                                    <h4 class="h5 mb-3">
                                        <i class="bi bi-bank me-2"></i>Surat Pajak Gadai Ar-Rahnu
                                    </h4>
                                    
                                    <h5 class="h6 text-success mb-2">Kelebihan (Pro):</h5>
                                    <ul class="small mb-3">
                                        <li><strong>Upah pinjaman rendah sekitar 0.75% sebulan dari harga marhun</strong></li>
                                        <li>Jenis emas, karat dan berat emas tertera dengan jelas pada surat pajak</li>
                                        <li>Surat pajak boleh disambung dengan membayar upah pinjaman</li>
                                        <li>Lelongan emas dibuat secara terbuka dan mengelak syubhah</li>
                                        <li>Ar-rahnu membantu peniaga emas dengan memberi sedikit kelebihan kepada peniaga</li>
                                    </ul>
                                    
                                    <h5 class="h6 text-danger mb-2">Kekurangan (Cons):</h5>
                                    <ul class="small mb-0">
                                        <li><strong>Nama pemajak akan dimasukkan kedalam sistem CCRIS dan ada kesukaran untuk membuat loan</strong></li>
                                        <li>Buka cuma pada waktu pejabat dan lambat untuk menunggu giliran</li>
                                        <li>Tidak menerima bar, coin, syiling, dinar dan emas padu yang lain</li>
                                        <li>Jumlah pinjaman tidak boleh dibincang kerana sistem arrahnu sedikit ketat</li>
                                        <li>Nama pemajak boleh disenarai hitam di CCRIS kerana tidak menjelaskan pinjaman</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Jual Surat Pajak - Important Info -->
                <div class="card mb-4 border-0 shadow-lg" style="background: linear-gradient(135deg, #fff3cd 0%, #ffe69c 100%);">
                    <div class="card-body p-4 p-lg-5">
                        <h2 class="h3 mb-4">
                            <i class="bi bi-exclamation-triangle-fill me-2 text-warning"></i>Jual Surat Pajak - Maklumat Penting
                        </h2>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="p-3" style="background: rgba(255,255,255,0.8); border-radius: 8px;">
                                    <h5 class="h6 mb-2">
                                        <i class="bi bi-shield-exclamation text-danger me-2"></i>Elakkan Disenarai Hitam
                                    </h5>
                                    <p class="small mb-0">
                                        Elakkan dari nama disenarai hitam kerana tidak menebus emas sebelum dilelong. 
                                        <strong>Jual surat dengan segera</strong>, anda masih boleh mendapat wang tunai apabila kami menebus item untuk anda.
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-3" style="background: rgba(255,255,255,0.8); border-radius: 8px;">
                                    <h5 class="h6 mb-2">
                                        <i class="bi bi-arrow-repeat text-success me-2"></i>Tukar kepada Barang Kemas
                                    </h5>
                                    <p class="small mb-0">
                                        Anda juga boleh menukar emas yang dipajak kepada barang kemas. 
                                        Hubungi kami untuk maklumat lanjut tentang perkhidmatan ini.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="alert alert-warning mt-4 mb-0">
                            <i class="bi bi-lightbulb me-2"></i>
                            <strong>Tips:</strong> Setiap surat pajak yang dikeluarkan biasanya mempunyai tempoh masa selama 6 bulan untuk ditebus 
                            dan pinjaman diberikan sehingga maksimum 70% serta mungkin lebih bergantung budi bicara pengurus.
                        </div>
                    </div>
                </div>
                
                <!-- Cara Jual Surat Pajak -->
                <div class="card mb-4" style="border: 1px solid var(--hrgms-card-border); box-shadow: var(--hrgms-card-shadow);">
                    <div class="card-body p-4 p-lg-5">
                        <h2 class="h3 mb-4">
                            <i class="bi bi-list-check me-2 text-primary"></i>Cara Jual Surat Pajak dengan Kami
                        </h2>
                        <div class="row g-4">
                            <div class="col-md-6 col-lg-3">
                                <div class="text-center">
                                    <div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px; font-size: 1.5rem; font-weight: bold;">
                                        1
                                    </div>
                                    <h5 class="h6 mb-2">Hubungi Kami</h5>
                                    <p class="small text-muted mb-0">WhatsApp kami dengan maklumat surat pajak anda (jenis, berat, nilai pajakan).</p>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="text-center">
                                    <div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px; font-size: 1.5rem; font-weight: bold;">
                                        2
                                    </div>
                                    <h5 class="h6 mb-2">Kami Nilai</h5>
                                    <p class="small text-muted mb-0">Kami akan nilai surat pajak anda dan berikan tawaran harga terbaik.</p>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="text-center">
                                    <div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px; font-size: 1.5rem; font-weight: bold;">
                                        3
                                    </div>
                                    <h5 class="h6 mb-2">Kami Tebus</h5>
                                    <p class="small text-muted mb-0">Kami akan tebus surat pajak anda dan beli barang kemas tersebut.</p>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="text-center">
                                    <div class="rounded-circle bg-success text-white d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px; font-size: 1.5rem; font-weight: bold;">
                                        4
                                    </div>
                                    <h5 class="h6 mb-2">Terima Baki</h5>
                                    <p class="small text-muted mb-0">Baki dari harga sebenar item ditolak nilai tebusan akan diserahkan kepada anda.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- WhatsApp CTA Section - Prominent -->
                <div class="card mb-4 border-0 shadow-lg" style="background: linear-gradient(135deg, #25D366 0%, #128C7E 100%);">
                    <div class="card-body p-5 text-center text-white">
                        <i class="bi bi-whatsapp mb-3" style="font-size: 4rem;"></i>
                        <h2 class="h3 mb-3">Nak Jual Surat Pajak? Hubungi Kami Sekarang!</h2>
                        <p class="lead mb-4">
                            Kami pakar dalam jual beli surat pajak. Boleh berbual mesra dengan kami untuk bertanya pasal surat pajak 
                            kerana ini memang kepakaran kami. Kami beroperasi di seluruh Malaysia.
                        </p>
                        <a href="<?php echo esc_url($whatsapp_url); ?>" 
                           target="_blank" 
                           rel="noopener" 
                           class="btn btn-light btn-lg shadow"
                           style="font-size: 1.2rem; padding: 15px 40px; border-radius: 50px;">
                            <i class="bi bi-whatsapp me-2"></i>WhatsApp untuk Jual Surat Pajak
                        </a>
                        <p class="mt-3 mb-0">
                            <i class="bi bi-telephone me-1"></i>+<?php echo esc_html($whatsapp_number); ?> | 
                            <i class="bi bi-clock me-1"></i>Respon Pantas 24/7 | 
                            <i class="bi bi-geo-alt me-1"></i>Seluruh Malaysia
                        </p>
                    </div>
                </div>
                
                <!-- Calculator Link -->
                <div class="card mb-4" style="border: 1px solid var(--hrgms-card-border); box-shadow: var(--hrgms-card-shadow);">
                    <div class="card-body p-4 p-lg-5 text-center">
                        <h3 class="h5 mb-3">Cara untuk Kira Harga Emas dan Surat Pajak</h3>
                        <p class="mb-4">Gunakan kalkulator emas kami untuk mengira nilai emas dan surat pajak anda.</p>
                        <a href="<?php echo esc_url(home_url('/calculator-emas/')); ?>" class="btn btn-hrgms-primary">
                            <i class="bi bi-calculator me-2"></i>Kalkulator Emas
                        </a>
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


