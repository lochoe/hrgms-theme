# 🚀 Panduan WordPress Local Development di Chromebook

Dokumentasi ini untuk reference masa depan - cara setup dan run WordPress local untuk development di Chromebook.

## 📋 Prerequisites

Sebelum start, pastikan anda ada:
- ✅ PHP (version 7.4 atau lebih tinggi)
- ✅ MySQL/MariaDB
- ✅ WordPress files sudah di-download/extract

## 🗂️ Struktur Projek

```
/home/lochoe/sandbox/wp-node/     # WordPress root directory
├── wp-config.php                 # Database configuration
├── wp-content/
│   └── themes/
│       └── hrgms-theme/          # Theme kita (file ini ada di sini)
│           ├── LOCAL-DEVELOPMENT.md  # File ini
│           └── README.md
└── ...
```

## ⚙️ Database Configuration

Dari `wp-config.php`, database settings adalah:
- **Database Name**: `wpnode`
- **Database User**: `wpnodeuser`
- **Database Password**: `970709bss`
- **Database Host**: `localhost`

## 🎯 Cara Start WordPress Local

### Step 1: Start MySQL Database

```bash
# Check jika MySQL sudah running
sudo systemctl status mysql

# Jika tidak running, start MySQL
sudo systemctl start mysql

# Atau jika guna MariaDB
sudo systemctl start mariadb

# Verify MySQL running
sudo systemctl status mysql
```

**Note**: Jika MySQL tidak install, install dulu:
```bash
sudo apt update
sudo apt install mysql-server
```

### Step 2: Verify Database Exists

```bash
# Login ke MySQL
mysql -u wpnodeuser -p970709bss

# Atau jika perlu root access
sudo mysql -u root -p

# Check database exists
SHOW DATABASES;
# Should see 'wpnode' in the list

# Exit MySQL
exit;
```

### Step 3: Start PHP Built-in Server

```bash
# Navigate ke WordPress directory
cd /home/lochoe/sandbox/wp-node

# Start PHP server (port 8000)
php -S localhost:8000

# Atau jika mahu accessible dari network
php -S 0.0.0.0:8000
```

**Output yang akan muncul**:
```
PHP 8.x.x Development Server (http://localhost:8000) started
```

### Step 4: Access WordPress di Browser

Buka browser dan pergi ke:
```
http://localhost:8000
```

Atau jika guna network:
```
http://[your-ip]:8000
```

## 🔄 Quick Start Commands

### Start Semua Services (One Command)

Buat script untuk start semua sekali:

```bash
# Create start script
cat > ~/start-wp.sh << 'EOF'
#!/bin/bash
echo "🚀 Starting WordPress Local Development..."

# Start MySQL
echo "📦 Starting MySQL..."
sudo systemctl start mysql
sleep 2

# Check MySQL status
if sudo systemctl is-active --quiet mysql; then
    echo "✅ MySQL is running"
else
    echo "❌ MySQL failed to start"
    exit 1
fi

# Navigate to WordPress directory
cd /home/lochoe/sandbox/wp-node

# Start PHP server
echo "🌐 Starting PHP server on http://localhost:8000"
echo "Press Ctrl+C to stop"
php -S localhost:8000
EOF

# Make executable
chmod +x ~/start-wp.sh
```

**Cara guna**:
```bash
~/start-wp.sh
```

### Stop Services

```bash
# Stop PHP server
# Press Ctrl+C dalam terminal yang run PHP server

# Stop MySQL (jika perlu)
sudo systemctl stop mysql
```

## 📝 Common Commands

### Check Services Status

```bash
# Check MySQL status
sudo systemctl status mysql

# Check PHP version
php -v

# Check if port 8000 is in use
lsof -i :8000
# atau
netstat -tulpn | grep 8000
```

### MySQL Commands

```bash
# Login ke MySQL
mysql -u wpnodeuser -p970709bss wpnode

# Atau dengan root
sudo mysql -u root -p

# Useful MySQL commands:
SHOW DATABASES;
USE wpnode;
SHOW TABLES;
SELECT * FROM wp_posts LIMIT 5;
exit;
```

### PHP Server Commands

```bash
# Start server di port tertentu
php -S localhost:8000

# Start dengan custom router script (jika perlu)
php -S localhost:8000 router.php

# Start dengan specific document root
php -S localhost:8000 -t /home/lochoe/sandbox/wp-node
```

## 🐛 Troubleshooting

### Problem: MySQL tidak start

```bash
# Check error logs
sudo journalctl -u mysql -n 50

# Restart MySQL
sudo systemctl restart mysql

# Check MySQL service
sudo systemctl status mysql
```

### Problem: Port 8000 sudah digunakan

```bash
# Check apa yang guna port 8000
lsof -i :8000

# Kill process yang guna port tersebut
kill -9 [PID]

# Atau guna port lain
php -S localhost:8080
```

### Problem: Database connection error

1. **Check database exists**:
   ```bash
   mysql -u wpnodeuser -p970709bss -e "SHOW DATABASES;"
   ```

2. **Check user permissions**:
   ```bash
   mysql -u root -p
   SELECT User, Host FROM mysql.user WHERE User='wpnodeuser';
   ```

3. **Verify wp-config.php settings**:
   ```bash
   cat /home/lochoe/sandbox/wp-node/wp-config.php | grep DB_
   ```

### Problem: Permission denied errors

```bash
# Fix WordPress directory permissions
cd /home/lochoe/sandbox/wp-node
sudo chown -R $USER:$USER .
chmod -R 755 wp-content
```

### Problem: PHP extensions missing

```bash
# Install common PHP extensions untuk WordPress
sudo apt install php-mysql php-xml php-mbstring php-curl php-zip php-gd

# Restart PHP (jika guna PHP-FPM)
sudo systemctl restart php8.x-fpm
```

## 💡 Tips & Best Practices

### 1. Auto-start MySQL on Boot (Optional)

```bash
# Enable MySQL to start on boot
sudo systemctl enable mysql
```

### 2. Use Different Ports untuk Multiple Projects

```bash
# Project 1
php -S localhost:8000

# Project 2 (dalam terminal lain)
php -S localhost:8001
```

### 3. Create Alias untuk Quick Access

Tambah dalam `~/.bashrc` atau `~/.zshrc`:

```bash
# WordPress aliases
alias wp-start='cd /home/lochoe/sandbox/wp-node && php -S localhost:8000'
alias wp-mysql='sudo systemctl start mysql'
alias wp-status='sudo systemctl status mysql'
```

Reload shell:
```bash
source ~/.bashrc
```

### 4. Enable WordPress Debug Mode

Edit `wp-config.php`:

```php
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);
```

Debug logs akan disimpan di:
```
wp-content/debug.log
```

### 5. Use .env untuk Sensitive Data (Optional)

Untuk better security, boleh guna environment variables:

```bash
# Create .env file
cat > /home/lochoe/sandbox/wp-node/.env << EOF
DB_NAME=wpnode
DB_USER=wpnodeuser
DB_PASSWORD=970709bss
DB_HOST=localhost
EOF
```

## 📚 Useful URLs

- **WordPress Admin**: `http://localhost:8000/wp-admin`
- **WordPress Site**: `http://localhost:8000`
- **Theme Directory**: `/home/lochoe/sandbox/wp-node/wp-content/themes/hrgms-theme`

## 🔐 Security Notes

⚠️ **PENTING**: 
- Jangan commit `wp-config.php` ke Git (sudah dalam .gitignore)
- Database password adalah sensitive - jangan share
- Local development sahaja - jangan expose ke internet

## 📝 Quick Reference Card

```
┌─────────────────────────────────────────┐
│  WordPress Local Development           │
├─────────────────────────────────────────┤
│  1. Start MySQL:                       │
│     sudo systemctl start mysql         │
│                                         │
│  2. Start PHP Server:                  │
│     cd /home/lochoe/sandbox/wp-node    │
│     php -S localhost:8000              │
│                                         │
│  3. Access:                            │
│     http://localhost:8000              │
│                                         │
│  4. Stop:                              │
│     Ctrl+C (PHP server)                │
│     sudo systemctl stop mysql          │
└─────────────────────────────────────────┘
```

## 🎯 Workflow Harian

1. **Start development session**:
   ```bash
   sudo systemctl start mysql
   cd /home/lochoe/sandbox/wp-node
   php -S localhost:8000
   ```

2. **Edit theme files**:
   - Files: `/home/lochoe/sandbox/wp-node/wp-content/themes/hrgms-theme/`
   - Refresh browser untuk lihat changes

3. **Check logs** (jika ada error):
   ```bash
   tail -f /home/lochoe/sandbox/wp-node/wp-content/debug.log
   ```

4. **Stop development session**:
   - Press `Ctrl+C` untuk stop PHP server
   - (Optional) Stop MySQL jika tidak guna

## 📞 Additional Resources

- WordPress Codex: https://codex.wordpress.org/
- PHP Manual: https://www.php.net/manual/
- MySQL Documentation: https://dev.mysql.com/doc/

---

**Last Updated**: December 2024  
**Environment**: Chromebook Linux (Crostini)  
**WordPress Version**: (check dengan `wp core version` atau dalam admin)

**Lokasi File**: `/home/lochoe/sandbox/wp-node/wp-content/themes/hrgms-theme/LOCAL-DEVELOPMENT.md`

**Note**: Dokumentasi ini untuk reference peribadi. Update jika ada perubahan dalam setup.

