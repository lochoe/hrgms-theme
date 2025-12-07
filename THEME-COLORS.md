# 🎨 HargaEmas Theme Colors Reference

Dokumentasi ini menyimpan semua theme colors untuk reference masa depan.

## 📋 Theme Color Palette

### Navigation
- **Background**: `#e95420` (Orange)
- **Text Color**: `#ffffff` (White)

### Body
- **Background Color**: `#ecf2f7` (Light Blue-Gray)

### Cards
- **Background Color**: `#ffffff` (White)
- **Text Color**: `#2d3748` (Dark Gray)
- **Shadow**: `0 1px 2px 0 rgba(0,0,0,.05)`
- **Border Color**: `#e2e8f0` (Light Gray)

### Footer
- **Background Color**: `#1e2939` (Dark Blue-Gray)
- **Text Color**: `#cccccc` (Light Gray)

### Buttons
- **Button 1 (Primary)**: `#77ac68` (Green)
- **Button 2 (Secondary)**: `#f45928` (Orange-Red)
- **Button 3 (Dark)**: `#282828` (Dark Gray)
- **Button Text Color**: `#ffffff` (White)

## 🎯 CSS Variables

Semua colors disimpan sebagai CSS variables dalam `style.css`:

```css
:root {
    /* Navigation */
    --hrgms-nav-bg: #e95420;
    --hrgms-nav-text: #ffffff;
    
    /* Body */
    --hrgms-body-bg: #ecf2f7;
    
    /* Cards */
    --hrgms-card-bg: #ffffff;
    --hrgms-card-text: #2d3748;
    --hrgms-card-shadow: 0 1px 2px 0 rgba(0,0,0,.05);
    --hrgms-card-border: #e2e8f0;
    
    /* Footer */
    --hrgms-footer-bg: #1e2939;
    --hrgms-footer-text: #cccccc;
    
    /* Buttons */
    --hrgms-btn-primary: #77ac68;
    --hrgms-btn-secondary: #f45928;
    --hrgms-btn-dark: #282828;
    --hrgms-btn-text: #ffffff;
}
```

## 📝 Usage

Gunakan CSS variables untuk consistency:

```css
.my-element {
    background: var(--hrgms-nav-bg);
    color: var(--hrgms-nav-text);
    border: 1px solid var(--hrgms-card-border);
    box-shadow: var(--hrgms-card-shadow);
}
```

## 🔄 Update Colors

Untuk update colors, edit CSS variables dalam `style.css` di section `:root`. Semua elements akan update automatically.

---

**Last Updated**: December 2024  
**File Location**: `/wp-content/themes/hrgms-theme/THEME-COLORS.md`

