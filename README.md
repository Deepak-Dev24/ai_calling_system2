
# 🚀 AI Calling System – NGINX + PHP-FPM + MySQL (FINAL INSTALL DOC)

> **Stack**: NGINX (LEMP) + PHP-FPM + MySQL
> **No Apache | No phpMyAdmin | Secure & Production-Ready**

---

## 📌 SYSTEM REQUIREMENTS

* Ubuntu 22.04+
* Internet access
* GitHub repository access
* Non-root user with `sudo`

---

## 🔹 PART 1: BASIC SERVER SETUP

### 1️⃣ Update system

```bash
sudo apt update && sudo apt upgrade -y
```
`
---

### 2️⃣ Install NGINX

```bash
sudo apt install nginx -y
```

Check:

```bash
sudo systemctl status nginx
```

---

### 3️⃣ Install MySQL

```bash
sudo apt install mysql-server -y
```

Secure MySQL:

```bash
sudo mysql_secure_installation
```

Check:

```bash
sudo systemctl status mysql
```

---

### 4️⃣ Install PHP + PHP-FPM + Extensions

```bash
sudo apt install -y \
php8.1 \
php8.1-fpm \
php8.1-mysql \
php8.1-curl \
php8.1-zip \
php8.1-mbstring \
php8.1-xml

```

Check:

```bash
sudo systemctl status php8.1-fpm
```

⚠️ **Do NOT install `libapache2-mod-php`**

---

## 🔹 PART 2: PROJECT CLONING

### 5️⃣ Install Git

```bash
sudo apt install git -y
```

---

### 6️⃣ Clone project

```bash
cd /var/www
sudo git clone https://github.com/Deepak-Dev24/ai_calling_system.git
```

Fix ownership:

```bash
sudo chown -R ubuntu:ubuntu /var/www/ai_calling_system
```

---

## 🔹 PART 3: NGINX CONFIGURATION (CRITICAL)

### 7️⃣ Create NGINX site config

```bash
sudo nano /etc/nginx/sites-available/ai_calling_system
```

Paste **exactly this**:

Update this one...

server {
    listen 80;
    server_name sushruteyehospital.in www.sushruteyehospital.in;

    root /var/www/sushruteyehospital;
    index index.php index.html;

    access_log /var/log/nginx/sushruteyehospital.access.log;
    error_log  /var/log/nginx/sushruteyehospital.error.log;

    location / {
        try_files $uri $uri/ /index.php?$args;
    }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/run/php/php8.1-fpm.sock;
    }

    location ~ /\.ht {
        deny all;
    }
}


---

### 8️⃣ Enable site

```bash
sudo ln -s /etc/nginx/sites-available/ai_calling_system /etc/nginx/sites-enabled/
sudo rm /etc/nginx/sites-enabled/default
sudo nginx -t
sudo systemctl reload nginx
```

---

### 9️⃣ Local DNS entry

```bash
sudo nano /etc/hosts
```

Add:

```
SERVER_IP ai-calling.local
```

Access:

```
http://ai-calling.local
```

---

## 🔹 PART 4: DATABASE SETUP

### 🔟 Create DB & user

```bash
sudo mysql
```

```sql
CREATE DATABASE call_billing;

CREATE USER 'aiuser'@'localhost'
IDENTIFIED BY 'AiUser@123';

GRANT ALL PRIVILEGES ON call_billing.* TO 'aiuser'@'localhost';

FLUSH PRIVILEGES;
EXIT;

```

---



Create a database folder inside the project

cd /var/www/ai_calling_system
mkdir database     ->/////now add db at this location

### 1️⃣1️⃣ Import DB

```bash

mysql -u aiuser -p call_billing < /var/www/database/call_billing.sql

```

---

## 🔹 PART 5: APPLICATION CONFIG

### 1️⃣2️⃣ Configure DB connection

Edit:

```bash
nano /var/www/ai_calling_system/core/db.php
```

Example:

```php
$host = "127.0.0.1";
$db   = "call_billing";
$user = "aiuser";
$pass = "AiUser@123";
```

---

### 1️⃣3️⃣ Permissions

```bash
sudo chown -R www-data:www-data /var/www/ai_calling_system
sudo chmod -R 755 /var/www/ai_calling_system
sudo chmod -R 775 /var/www/ai_calling_system/logs
```

---

## 🔹 PART 6: SECURITY RULES (IMPORTANT)

✔ Only `public/` exposed
✔ Core logic protected (`core/`, `config/`, `api/`)
✔ APIs require session auth
✔ Rate-limited via NGINX
✔ No phpMyAdmin installed

---

## 🔹 PART 7: CRON AUTOMATION (BILLING)

### 1️⃣4️⃣ Create cron job

```bash
crontab -e
```

Add:

```bash
*/10 * * * * /usr/bin/php /var/www/ai_calling_system/public/api/sync_cdr_to_db.php >> /var/www/ai_calling_system/logs/cron_sync.log 2>&1
```

Create log file:

```bash
touch /var/www/ai_calling_system/logs/cron_sync.log
chmod 664 /var/www/ai_calling_system/logs/cron_sync.log
```

Verify:

```bash
tail -f /var/www/ai_calling_system/logs/cron_sync.log
```

---

## 🔹 PART 8: FIREWALL (OPTIONAL BUT RECOMMENDED)

```bash
sudo ufw allow OpenSSH
sudo ufw allow 'Nginx Full'
sudo ufw enable
```

---

## 🔹 PART 9: SERVICE VERIFICATION

```bash
sudo systemctl status nginx
sudo systemctl status php8.1-fpm
sudo systemctl status mysql
```

✔ All must be **active (running)**

