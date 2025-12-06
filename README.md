# HRGMS Theme - WordPress Theme untuk Portal Harga Emas Malaysia

## 📋 Penerangan

**HRGMS Theme** adalah theme WordPress khas yang dibina untuk portal maklumat harga emas Malaysia. Theme ini direka dengan fokus pada:

- ✅ **SEO Optimized** - Compatible dengan Yoast SEO, structured data, meta tags lengkap
- ✅ **Modern Design** - Menggunakan Bootstrap 5, responsive, mobile-first
- ✅ **Performance** - Caching untuk API calls, lazy loading images, optimized assets
- ✅ **User-Friendly** - Navigation mudah, breadcrumbs, pagination
- ✅ **Custom Features** - Harga Emas listing, Ar-Rahnu comparison, kategori management

## 🎯 Features Utama

### 1. Harga Emas Management
- **Custom Category** - Kategori khas untuk post harga emas (configurable via Customizer)
- **Dedicated Listing Page** - URL `/harga-emas/` untuk senarai semua rekod harga emas
- **Front Page Display** - Option untuk papar harga emas di homepage
- **Pagination** - Support untuk banyak rekod dengan pagination

### 2. Live API Integration
- **Gold Prices API** - Fetch harga emas terkini dari API dengan caching (5 minit TTL)
- **Ar-Rahnu API** - Fetch harga Ar-Rahnu dari pelbagai institusi
- **Error Handling** - Graceful fallback jika API tidak available
- **Configurable** - URL API disimpan dalam config file (tidak di-commit ke Git)

### 3. SEO Features
- **Structured Data** - JSON-LD schema untuk FAQ, Breadcrumb, WebPage
- **Meta Tags** - Open Graph, Twitter Cards, description tags
- **Breadcrumbs** - Navigation breadcrumbs untuk better UX & SEO
- **Yoast Compatible** - Tidak duplicate meta tags dengan Yoast SEO

### 4. Custom Templates
- `template-harga-emas.php` - Listing page untuk harga emas
- `template-harga-emas-malaysia.php` - SEO page dengan live data dari API
- `template-pages-list.php` - Listing semua halaman (`/halaman/`)
- `template-categories-list.php` - Listing semua kategori (`/kategori/`)

### 5. Design System
- **Bootstrap 5** - Latest version dengan CDN
- **Custom CSS Variables** - Easy theming dengan CSS custom properties
- **Bootstrap Icons** - Icon library untuk UI
- **Responsive** - Mobile-first design, works on all devices

## 📁 Struktur Fail

```
hrgms-theme/
├── assets/
│   └── js/
│       └── custom.js          # Custom JavaScript
├── 404.php                    # 404 error page
├── archive.php                # Archive template
├── footer.php                 # Footer template
├── front-page.php             # Homepage template
├── functions.php              # Theme functions & setup
├── header.php                 # Header template
├── home.php                   # Blog page template
├── index.php                  # Default template
├── page.php                   # Single page template
├── search.php                 # Search results template
├── single.php                 # Single post template
├── style.css                  # Main stylesheet
├── template-categories-list.php    # Categories listing
├── template-harga-emas.php         # Harga Emas listing
├── template-harga-emas-malaysia.php # Harga Emas Malaysia page
├── template-pages-list.php         # Pages listing
├── hrgms-api-config.php            # API configuration (NOT in Git)
├── .gitignore                 # Git ignore rules
└── README.md                  # This file
```

## 🚀 Installation

### 1. Upload Theme
```bash
# Upload folder hrgms-theme ke wp-content/themes/
```

### 2. Activate Theme
- Go to WordPress Admin → Appearance → Themes
- Activate "HRGMS Theme"

### 3. Setup API Configuration
**PENTING**: File `hrgms-api-config.php` tidak di-commit ke Git untuk keselamatan.

1. Copy `hrgms-api-config.php` (jika belum wujud)
2. Edit file dan isi URL API yang betul:
   ```php
   return array(
       'gold_prices_url' => 'https://your-api-url.com/api/gold-prices.json',
       'ar_rahnu_url' => 'https://your-api-url.com/api/ar-rahnu.json',
       'cache_ttl' => 5 * MINUTE_IN_SECONDS,
       'api_timeout' => 10,
       'ssl_verify' => true,
   );
   ```
3. Save file (file ini akan di-ignore oleh Git)

### 4. Configure Theme Settings
- Go to **Appearance → Customize**
- **Harga Emas Settings**:
  - Set Category ID untuk Harga Emas (default: 9)
  - Set Posts Per Page untuk listing
  - Enable/disable display di front page
  - Set number of posts di front page

### 5. Setup Menus
- Go to **Appearance → Menus**
- Create menu dan assign ke:
  - **Header Menu** - Navigation utama
  - **Footer Menu** - Footer links

### 6. Setup Widgets
- Go to **Appearance → Widgets**
- Add widgets ke:
  - **Sidebar** - Main sidebar
  - **Footer Widget 1, 2, 3** - Footer columns

## ⚙️ Configuration

### API Configuration

File `hrgms-api-config.php` menyimpan semua URL API. File ini **TIDAK** di-commit ke Git untuk keselamatan.

**Lokasi**: `/wp-content/themes/hrgms-theme/hrgms-api-config.php`

**Parameters**:
- `gold_prices_url` - URL untuk gold prices API
- `ar_rahnu_url` - URL untuk Ar-Rahnu prices API
- `cache_ttl` - Cache time dalam saat (default: 300 = 5 minit)
- `api_timeout` - API request timeout dalam saat (default: 10)
- `ssl_verify` - Verify SSL certificate (default: true)

### Theme Customizer

**Location**: Appearance → Customize → Harga Emas Settings

- **Harga Emas Category ID** - ID kategori untuk post harga emas
- **Posts Per Page** - Bilangan post per halaman untuk listing
- **Papar di Front Page** - Toggle untuk papar section di homepage
- **Bilangan di Front Page** - Bilangan post harga emas di homepage

## 🔧 Custom Functions

### API Functions

```php
// Fetch gold prices (with caching)
$gold_prices = hrgms_fetch_gold_prices();

// Fetch Ar-Rahnu prices (with caching)
$ar_rahnu = hrgms_fetch_ar_rahnu_prices();

// Get API config
$config = hrgms_get_api_config();
```

### Helper Functions

```php
// Format currency (RM)
hrgms_format_currency($amount);

// Format price per gram
hrgms_format_price_per_gram($price_per_kg);

// Format Ar-Rahnu price
hrgms_format_ar_rahnu_price($price_per_gram);

// Get first image from post
hrgms_get_first_image($post_id);

// Get placeholder image
hrgms_get_placeholder_image($text, $bg_color, $text_color, $width, $height);

// Check if post is in Harga Emas category
hrgms_is_harga_emas_category($post_id);

// Get Harga Emas category ID
hrgms_get_harga_emas_cat_id();

// Breadcrumb navigation
hrgms_breadcrumb();
```

## 📱 Custom URL Routes

Theme ini menambah custom URL routes:

- `/harga-emas/` - Listing semua post harga emas
- `/harga-emas/page/2/` - Pagination untuk harga emas
- `/halaman/` - Listing semua halaman
- `/halaman/page/2/` - Pagination untuk halaman
- `/kategori/` - Listing semua kategori

**Note**: Selepas activate theme, pergi ke **Settings → Permalinks** dan klik "Save Changes" untuk flush rewrite rules.

## 🎨 Customization

### Colors

Theme menggunakan CSS variables untuk easy customization. Edit `style.css`:

```css
:root {
    --hrgms-nav-bg: #e95420;
    --hrgms-primary: #e95420;
    --hrgms-btn-primary: #77ac68;
    --hrgms-btn-secondary: #f45928;
    /* ... more variables ... */
}
```

### Templates

Semua template files boleh di-override dengan child theme jika perlu.

## 🔒 Security

1. **API URLs** - Disimpan dalam `hrgms-api-config.php` yang di-ignore oleh Git
2. **Input Validation** - Semua user input di-sanitize
3. **Output Escaping** - Semua output di-escape dengan `esc_html()`, `esc_url()`, etc.
4. **Nonce Verification** - Untuk form submissions (jika ada)
5. **ABSPATH Check** - Semua PHP files check `ABSPATH` untuk prevent direct access

## 📊 Performance

- **API Caching** - 5 minit TTL untuk reduce API calls
- **Lazy Loading** - Images menggunakan `loading="lazy"`
- **CDN Assets** - Bootstrap, Google Fonts dari CDN
- **Defer Scripts** - JavaScript files di-defer untuk faster page load
- **Image Optimization** - Support untuk WebP, placeholder images

## 🐛 Troubleshooting

### API tidak berfungsi
1. Check `hrgms-api-config.php` exists dan URL betul
2. Check API endpoint accessible
3. Check WordPress debug log untuk errors
4. Verify SSL certificate jika `ssl_verify` = true

### Rewrite rules tidak berfungsi
1. Go to **Settings → Permalinks**
2. Click "Save Changes" untuk flush rewrite rules
3. Check `.htaccess` file permissions

### Images tidak muncul
1. Check `hrgms_get_first_image()` function
2. Verify image URLs accessible
3. Check placeholder image service (via.placeholder.com)

## 📝 Development Notes

### Code Style
- Mengikuti WordPress Coding Standards
- Semua functions ada PHPDoc comments
- File structure mengikuti WordPress theme hierarchy

### Dependencies
- **Bootstrap 5.3.2** - Via CDN
- **Bootstrap Icons 1.11.1** - Via CDN
- **Google Fonts (Poppins)** - Via CDN

### Browser Support
- Modern browsers (Chrome, Firefox, Safari, Edge)
- Mobile browsers (iOS Safari, Chrome Mobile)
- IE11 tidak supported (Bootstrap 5 tidak support IE)

## 📄 License

GPL-2.0-or-later

## 👤 Author

**Shahrul**
- Website: https://hrgms.com.my
- Theme URI: https://hrgms.com.my

## 🔄 Changelog

### Version 1.0.0
- Initial release
- Harga Emas listing functionality
- API integration dengan caching
- SEO optimization
- Bootstrap 5 design
- Custom templates untuk pages/categories
- Responsive design

## 📞 Support

Untuk bantuan atau pertanyaan, sila hubungi:
- Email: (dari WordPress admin email)
- Website: https://hrgms.com.my

## 📚 Dokumentasi Tambahan

- **LOCAL-DEVELOPMENT.md** - Panduan lengkap untuk setup dan run WordPress local development di Chromebook
  - Lokasi: `/wp-content/themes/hrgms-theme/LOCAL-DEVELOPMENT.md`
  - Mengandungi: Setup guide, troubleshooting, quick start commands

---

**PENTING**: Jangan commit file `hrgms-api-config.php` ke Git repository. File ini mengandungi URL API yang sensitif dan sudah di-ignore dalam `.gitignore`.

