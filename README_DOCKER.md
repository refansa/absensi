# Docker Setup - Just Expose PHP-FPM Container

**Simple setup**: You already have a web server running. Just expose the Docker container on port 9000 for PHP-FPM.

## 🚀 Quick Start

### 1. Build the Image

```bash
docker build -t absensi-app .
```

### 2. Run the Container

**Windows PowerShell:**
```powershell
docker run -d --name absensi -p 9000:9000 -v ${PWD}:/var/www/html absensi-app
```

**Windows CMD:**
```cmd
docker run -d --name absensi -p 9000:9000 -v %cd%:/var/www/html absensi-app
```

**Git Bash:**
```bash
docker run -d --name absensi -p 9000:9000 -v "$(pwd):/var/www/html" absensi-app
```

### 3. Configure Your Web Server

Point your web server's PHP-FPM to `127.0.0.1:9000`

**Nginx example:**
```nginx
location ~ \.php$ {
    fastcgi_pass 127.0.0.1:9000;
    fastcgi_index index.php;
    fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    include fastcgi_params;
}
```

**Apache example (.htaccess or config):**
```apache
<FilesMatch \.php$>
    SetHandler "proxy:fcgi://127.0.0.1:9000"
</FilesMatch>
```

### 4. That's It!

Your Laravel app is now running in Docker, and your web server can communicate with it through port 9000.

## 📋 What This Setup Includes

✅ PHP 8.2-FPM
✅ SQLite support (`pdo_sqlite`)
✅ Required PHP extensions (GD, mbstring, etc.)
✅ Composer (with dependencies installed)
✅ Node.js 20 (with Vite assets built)
✅ Proper file permissions

## 🔧 Common Commands

```bash
# Start container
docker start absensi

# Stop container
docker stop absensi

# View logs
docker logs -f absensi

# Run artisan commands
docker exec absensi php artisan migrate
docker exec absensi php artisan cache:clear

# Access container shell
docker exec -it absensi bash

# Restart container
docker restart absensi
```

## 🔄 Rebuild After Changes

If you modify the Dockerfile or need to rebuild:

```bash
docker stop absensi
docker rm absensi
docker build -t absensi-app .
docker run -d --name absensi -p 9000:9000 -v ${PWD}:/var/www/html absensi-app
```

## 📝 Notes

- **Port 9000**: Standard PHP-FPM port
- **Volume mount**: Your code is mounted, so changes reflect immediately
- **SQLite**: Database file is in your project directory (persistent)
- **Web server**: Use your existing Nginx/Apache setup

## 🔍 Troubleshooting

### Web server can't connect to PHP-FPM

Make sure:
1. Container is running: `docker ps`
2. Port 9000 is exposed and not blocked by firewall
3. Web server config points to `127.0.0.1:9000`

### Permission issues

```bash
docker exec absensi chmod -R 775 storage bootstrap/cache
docker exec absensi chown -R www-data:www-data storage bootstrap/cache
```

### Check if PHP-FPM is responding

```bash
docker exec absensi php-fpm -t
```

---

**That's all you need!** Simple Docker container exposing PHP-FPM. 🚀
