📘 PHP Dashboard Deployment Guide

Domain: sushruteyehospital.in
Server: Ubuntu
Web Server: Nginx
Backend: PHP 8.3 (PHP-FPM)
SSL: Let’s Encrypt (Certbot)

1. Project Overview

This document describes the complete deployment of a PHP-based dashboard on an Ubuntu server using Nginx, PHP-FPM, and HTTPS (Let’s Encrypt).
The setup ensures secure, production-ready hosting for the hospital dashboard.

2. Prerequisites

Ubuntu Server (22.04 / 24.04)

Public IP assigned to server

Domain purchased: sushruteyehospital.in

DNS access to domain provider

SSH access to server

Ports open in firewall / security group:

22 (SSH)

80 (HTTP)

443 (HTTPS)

3. DNS Configuration
Required DNS Records
Type	Host	Value
A	@	Server Public IP
CNAME	www	sushruteyehospital.in

📌 Ensure no parking or forwarding IPs are present.

Verification:

dig sushruteyehospital.in


Expected result:

Only the server IP should appear.

4. Install Required Packages
sudo apt update
sudo apt install -y nginx \
php8.3 php8.3-fpm php8.3-cli \
php-curl php-mbstring php-xml unzip git


Verify services:

systemctl status nginx
systemctl status php8.3-fpm


Verify PHP socket:

ls /run/php/


Expected:

php8.3-fpm.sock

5. Deploy PHP Project
Create web root
sudo mkdir -p /var/www/sushruteyehospital

Copy project files
sudo cp -r ~/Call-Records-Dashboard/* /var/www/sushruteyehospital/

Set permissions
sudo chown -R www-data:www-data /var/www/sushruteyehospital
sudo find /var/www/sushruteyehospital -type d -exec chmod 755 {} \;
sudo find /var/www/sushruteyehospital -type f -exec chmod 644 {} \;

6. Nginx Virtual Host Configuration

Create site config:

sudo nano /etc/nginx/sites-available/sushruteyehospital.in

Nginx Configuration
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
        fastcgi_pass unix:/run/php/php8.3-fpm.sock;
    }

    location ~ /\.ht {
        deny all;
    }
}


Enable site and reload:

sudo ln -s /etc/nginx/sites-available/sushruteyehospital.in /etc/nginx/sites-enabled/
sudo rm -f /etc/nginx/sites-enabled/default
sudo nginx -t
sudo systemctl reload nginx

7. Enable HTTPS (Let’s Encrypt SSL)
Install Certbot
sudo apt install -y certbot python3-certbot-nginx

Issue SSL Certificate
sudo certbot --nginx \
-d sushruteyehospital.in \
-d www.sushruteyehospital.in


Select:

Agree to terms → Yes

Redirect HTTP to HTTPS → Yes

Verify SSL
sudo certbot renew --dry-run

8. Post-Deployment Notes
PHP File Changes

Updating .php files (e.g., login.php) does not require any service restart

PHP is interpreted on every request

When Restart Is Required
Change Type	Action
PHP config (php.ini)	systemctl restart php8.3-fpm
Nginx config	systemctl reload nginx
PHP code only	No restart needed
9. Final Result

✅ Dashboard live on https://sushruteyehospital.in

✅ HTTPS secured with valid SSL

✅ Nginx + PHP-FPM production setup

✅ Clean file permissions

✅ Ready for future enhancements

10. Optional Enhancements (Future Scope)

IP-based access restriction

Session timeout hardening

Fail2Ban security

Log monitoring & analytics

Auto-deploy via GitHub webhook

Docker-based deployment

✅ Deployment Status: SUCCESSFUL
