<?php
/**
 * File: template-calculator-emas.php
 * Purpose: SEO-optimized gold calculator page with live API data
 * URL: /calculator-emas/
 * Notes: Mobile-first design, real-time calculation for all gold karats
 */

if (!defined('ABSPATH')) {
    exit;
}

// Fetch gold prices from API
$gold_prices = hrgms_fetch_gold_prices();

// Get current date for SEO
$current_date = date('d F Y');
$current_year = date('Y');

// Get MksSell price (per kilogram) and convert to per gram
$mks_sell_per_kg = $gold_prices && isset($gold_prices['prices']['MksSell']) 
    ? floatval($gold_prices['prices']['MksSell']) 
    : 0;
$mks_sell_per_gram = $mks_sell_per_kg / 1000;

// Gold karats with their purity percentages
$gold_karats = array(
    '999' => 0.999,
    '950' => 0.950,
    '916' => 0.916,
    '875' => 0.875,
    '835' => 0.835,
    '800' => 0.800,
    '750' => 0.750,
    '585' => 0.585,
    '375' => 0.375,
);

get_header();
?>

<!-- Structured Data for SEO (JSON-LD) -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebPage",
  "name": "Kalkulator Emas - Kira Harga Emas Hari Ini <?php echo $current_year; ?>",
  "description": "Kalkulator emas percuma untuk kira harga emas 999, 916, 835, 750 dan semua karat. Kira nilai tunai emas terpakai dengan susut nilai. Harga emas terkini hari ini.",
  "url": "<?php echo esc_url(home_url('/calculator-emas/')); ?>",
  "mainEntity": {
    "@type": "SoftwareApplication",
    "applicationCategory": "FinanceApplication",
    "name": "Kalkulator Emas Malaysia",
    "operatingSystem": "Web",
    "offers": {
      "@type": "Offer",
      "price": "0",
      "priceCurrency": "MYR"
    }
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
        "name": "Kalkulator Emas",
        "item": "<?php echo esc_url(home_url('/calculator-emas/')); ?>"
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
                    <i class="bi bi-calculator me-2"></i>Kalkulator Emas
                </h1>
                <p class="hrgms-hero-subtitle" style="font-size: 1.1rem;">
                    Kira Harga Emas Terkini Hari Ini - <?php echo $current_date; ?>
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

<!-- Calculator Section -->
<section class="hrgms-products" style="padding: 40px 0; background: var(--hrgms-body-bg);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                
                <!-- Calculator Card -->
                <div class="card shadow-lg mb-4" style="border: none; border-radius: 16px; overflow: hidden;">
                    <div class="card-header text-center" style="background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%); color: white; padding: 20px;">
                        <h2 class="h3 mb-0">
                            <i class="bi bi-calculator-fill me-2"></i>Kalkulator Nilai Emas
                        </h2>
                        <p class="mb-0 mt-2 small" style="opacity: 0.9;">
                            Masukkan berat emas anda untuk kira nilai semua karat
                        </p>
                    </div>
                    <div class="card-body p-4">
                        
                        <!-- Input Section -->
                        <div class="row g-3 mb-4">
                            <div class="col-12 col-md-6">
                                <label for="gold-weight" class="form-label fw-bold">
                                    <i class="bi bi-rulers me-2"></i>Berat Emas (gram)
                                </label>
                                <input 
                                    type="number" 
                                    class="form-control form-control-lg" 
                                    id="gold-weight" 
                                    placeholder="Contoh: 10.5"
                                    step="0.01"
                                    min="0"
                                    value=""
                                    style="font-size: 1.1rem; padding: 15px; border: 2px solid #e2e8f0; border-radius: 8px;"
                                >
                                <small class="text-muted">Masukkan berat emas dalam gram (cth: 10.5, 25, 50)</small>
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="depreciation-rate" class="form-label fw-bold">
                                    <i class="bi bi-percent me-2"></i>Susut Nilai (%)
                                </label>
                                <select 
                                    class="form-select form-select-lg" 
                                    id="depreciation-rate"
                                    style="font-size: 1.1rem; padding: 15px; border: 2px solid #e2e8f0; border-radius: 8px;"
                                >
                                    <option value="5">5% (Emas Baru/Baik)</option>
                                    <option value="7" selected>7% (Emas Terpakai Biasa)</option>
                                    <option value="10">10% (Emas Lama/Rosak)</option>
                                </select>
                                <small class="text-muted">Pilih susut nilai mengikut keadaan emas</small>
                            </div>
                        </div>

                        <!-- Current Gold Price Display -->
                        <?php if ($mks_sell_per_gram > 0) : ?>
                        <div class="alert alert-info mb-4" style="background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%); border-left: 4px solid #2196F3; border-radius: 8px;">
                            <div class="d-flex align-items-center justify-content-between flex-wrap">
                                <div>
                                    <strong><i class="bi bi-info-circle me-2"></i>Harga Jual Emas 999 Hari Ini:</strong>
                                    <span class="ms-2" style="font-size: 1.2rem; font-weight: 700; color: #1976D2;">
                                        <?php echo hrgms_format_price_per_gram($mks_sell_per_kg); ?> / gram
                                    </span>
                                </div>
                                <button type="button" class="btn btn-sm btn-primary mt-2 mt-md-0" id="refresh-price">
                                    <i class="bi bi-arrow-clockwise me-1"></i>Refresh Harga
                                </button>
                            </div>
                        </div>
                        <?php endif; ?>

                        <!-- Results Table -->
                        <div class="table-responsive">
                            <table class="table table-hover mb-0" id="gold-calculator-table" style="display: none;">
                                <thead style="background: linear-gradient(135deg, #f9f3e3 0%, #fef9e7 100%);">
                                    <tr>
                                        <th style="border: none; padding: 15px; font-weight: 600;">
                                            <i class="bi bi-gem me-2"></i>Karat Emas
                                        </th>
                                        <th class="text-end" style="border: none; padding: 15px; font-weight: 600;">
                                            <i class="bi bi-cash-coin me-2"></i>Nilai Spot
                                        </th>
                                        <th class="text-end" style="border: none; padding: 15px; font-weight: 600;">
                                            <i class="bi bi-wallet2 me-2"></i>Nilai Tunai
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($gold_karats as $karat => $purity) : ?>
                                    <tr data-karat="<?php echo esc_attr($karat); ?>" data-purity="<?php echo esc_attr($purity); ?>">
                                        <td style="padding: 15px; border-bottom: 1px solid #e2e8f0;">
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
                                        <td class="text-end spot-value" style="padding: 15px; border-bottom: 1px solid #e2e8f0; font-weight: 600; color: #2d3748;">
                                            RM 0.00
                                        </td>
                                        <td class="text-end cash-value" style="padding: 15px; border-bottom: 1px solid #e2e8f0; font-weight: 700; color: #77ac68; font-size: 1.1rem;">
                                            RM 0.00
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- Empty State -->
                        <div id="calculator-empty" class="text-center py-5">
                            <i class="bi bi-calculator" style="font-size: 4rem; color: #e2e8f0;"></i>
                            <p class="text-muted mt-3">Masukkan berat emas untuk mula kira</p>
                        </div>

                    </div>
                </div>

                <!-- Explanation Section -->
                <div class="card shadow-sm mb-4" style="border: none; border-radius: 16px;">
                    <div class="card-body p-4">
                        <h3 class="h5 mb-3" style="color: var(--hrgms-primary);">
                            <i class="bi bi-question-circle me-2"></i>Kenapa Ada Susut Nilai Emas?
                        </h3>
                        <div class="row g-3">
                            <div class="col-12 col-md-6">
                                <div class="p-3" style="background: #f8f9fa; border-radius: 8px;">
                                    <h5 class="h6 mb-2" style="color: #e67e22;">
                                        <i class="bi bi-exclamation-triangle me-2"></i>Emas Terpakai
                                    </h5>
                                    <p class="small mb-0" style="line-height: 1.7;">
                                        Emas terpakai, second hand, atau emas lama biasanya akan dibeli di bawah spot price kerana:
                                    </p>
                                    <ul class="small mt-2 mb-0" style="line-height: 1.8;">
                                        <li>Mutu emas tidak tepat-tepat mengikut peratusan (cth: 916 tidak tepat 91.6%)</li>
                                        <li>Ada kekotoran, campuran logam lain</li>
                                        <li>Susut berat apabila dibakar/uji</li>
                                        <li>Kos pemprosesan dan penyucian</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="p-3" style="background: #f0f9f0; border-radius: 8px;">
                                    <h5 class="h6 mb-2" style="color: #77ac68;">
                                        <i class="bi bi-info-circle me-2"></i>Kadar Susut Nilai
                                    </h5>
                                    <ul class="small mb-0" style="line-height: 1.8;">
                                        <li><strong>5%</strong> - Emas baru, baik, dengan sijil</li>
                                        <li><strong>7%</strong> - Emas terpakai biasa, keadaan baik</li>
                                        <li><strong>10%</strong> - Emas lama, rosak, patah, atau tanpa sijil</li>
                                    </ul>
                                    <p class="small mt-2 mb-0" style="line-height: 1.7;">
                                        <strong>Nota:</strong> Kadar susut nilai mungkin berbeza mengikut kedai emas. Kalkulator ini memberikan anggaran sahaja.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SEO Content Section -->
                <div class="card shadow-sm mb-4" style="border: none; border-radius: 16px;">
                    <div class="card-body p-4">
                        <h3 class="h5 mb-3">Cara Guna Kalkulator Emas</h3>
                        <ol style="line-height: 2;">
                            <li>Masukkan <strong>berat emas</strong> anda dalam gram (cth: 10.5, 25, 50)</li>
                            <li>Pilih <strong>susut nilai</strong> mengikut keadaan emas anda</li>
                            <li>Lihat <strong>nilai spot</strong> dan <strong>nilai tunai</strong> untuk semua karat emas</li>
                            <li><strong>Nilai Tunai</strong> adalah anggaran yang anda akan dapat jika jual emas hari ini</li>
                        </ol>

                        <h4 class="h6 mt-4 mb-2">Contoh Pengiraan:</h4>
                        <p class="small">
                            Jika anda ada emas 916 seberat 10 gram, dan harga jual emas 999 hari ini adalah 
                            <?php echo $mks_sell_per_gram > 0 ? hrgms_format_price_per_gram($mks_sell_per_kg) : 'RM 55.000'; ?> per gram:
                        </p>
                        <ul class="small" style="line-height: 1.8;">
                            <li>Harga spot emas 916 = (Harga 999 × 0.916) × 10 gram</li>
                            <li>Nilai tunai = Harga spot - (Harga spot × 7%)</li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<!-- JavaScript untuk Calculator -->
<script>
(function() {
    'use strict';

    // Get gold price from PHP (per gram) - using MksSell (selling price)
    const GOLD_PRICE_PER_GRAM = <?php echo json_encode($mks_sell_per_gram); ?>;
    
    // Gold karats data
    const GOLD_KARATS = <?php echo json_encode($gold_karats); ?>;
    
    // DOM elements
    const weightInput = document.getElementById('gold-weight');
    const depreciationSelect = document.getElementById('depreciation-rate');
    const calculatorTable = document.getElementById('gold-calculator-table');
    const emptyState = document.getElementById('calculator-empty');
    const refreshBtn = document.getElementById('refresh-price');

    /**
     * Calculate gold value for all karats
     */
    function calculateGoldValues() {
        const weight = parseFloat(weightInput.value) || 0;
        const depreciation = parseFloat(depreciationSelect.value) || 7;

        if (weight <= 0 || GOLD_PRICE_PER_GRAM <= 0) {
            calculatorTable.style.display = 'none';
            emptyState.style.display = 'block';
            return;
        }

        // Show table, hide empty state
        calculatorTable.style.display = 'table';
        emptyState.style.display = 'none';

        // Calculate for each karat
        const rows = calculatorTable.querySelectorAll('tbody tr');
        rows.forEach(function(row) {
            const karat = row.getAttribute('data-karat');
            const purity = parseFloat(row.getAttribute('data-purity'));
            
            // Calculate spot price: (price_per_gram * purity) * weight
            const spotPrice = (GOLD_PRICE_PER_GRAM * purity) * weight;
            
            // Calculate cash value: spot price - (spot price * depreciation%)
            const cashValue = spotPrice - (spotPrice * (depreciation / 100));
            
            // Update display
            const spotCell = row.querySelector('.spot-value');
            const cashCell = row.querySelector('.cash-value');
            
            if (spotCell) {
                spotCell.textContent = formatCurrency(spotPrice);
            }
            if (cashCell) {
                cashCell.textContent = formatCurrency(cashValue);
            }
        });
    }

    /**
     * Format number as Malaysian Ringgit
     */
    function formatCurrency(amount) {
        return 'RM ' + number_format(amount, 2);
    }

    /**
     * Number format helper
     */
    function number_format(number, decimals) {
        const rounded = Math.round(number * Math.pow(10, decimals)) / Math.pow(10, decimals);
        return rounded.toFixed(decimals).replace(/\B(?=(\d{3})+(?!\d))/g, ',');
    }

    /**
     * Refresh price (reload page)
     */
    if (refreshBtn) {
        refreshBtn.addEventListener('click', function() {
            window.location.reload();
        });
    }

    // Event listeners
    if (weightInput) {
        weightInput.addEventListener('input', calculateGoldValues);
        weightInput.addEventListener('change', calculateGoldValues);
    }

    if (depreciationSelect) {
        depreciationSelect.addEventListener('change', calculateGoldValues);
    }

    // Initial calculation if value exists
    if (weightInput && weightInput.value) {
        calculateGoldValues();
    }

})();
</script>

<?php get_footer(); ?>

