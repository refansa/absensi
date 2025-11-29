# Absensi (Attendance System)

A web-based attendance system built with Laravel.

## 🚀 Getting Started

### Prerequisites

- **Docker** (if using Docker setup)
- **PHP 8.2+** (if running locally)
- **Composer**
- **Node.js** & **npm**
- **Web Server** (Nginx/Apache)

## 📦 Installation

### Option 1: Local Setup

1. **Clone the repository**:
   ```bash
   git clone https://github.com/refansa/absensi.git
   cd absensi
   ```

2. **Install dependencies**:
   ```bash
   composer install
   npm install
   ```

3. **Setup environment**:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Setup database**:
   SQLite is used by default. The database file will be created automatically.
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

5. **Build assets**:
   ```bash
   npm run build
   ```

6. **Serve the application**:
   ```bash
   php artisan serve
   ```
   Access at: http://localhost:8000

### Option 2: Docker Setup (Production-Ready) 🐳

**One-command production deployment with SQLite database:**

```bash
docker-compose up -d --build
```

**What's included:**
- ✅ Production-optimized Alpine Linux image (~150MB)
- ✅ PHP 8.4-FPM with OPcache enabled
- ✅ Nginx web server with gzip compression
- ✅ SQLite database with persistent storage
- ✅ Automatic database migrations
- ✅ Pre-built assets (Vite)
- ✅ Auto-restart on failure
- ✅ Health checks

**Quick Start:**

1. **Deploy (that's it! 🚀):**
   ```bash
   docker-compose up -d --build
   ```
   
   > **What happens automatically:**
   > - `.env` file is created from `.env.production.example` if it doesn't exist
   > - `APP_KEY` is auto-generated if not set
   > - Database is created and migrated
   > - **Default admin user created** (username: `admin`, password: `admin`)
   > - Application is optimized for production

2. **Access:** http://localhost:8000

3. **Login with default admin credentials:**
   - **Username:** `admin`
   - **Password:** `admin`
   - ⚠️ **Change the password immediately after first login!**

> **💡 Pro Tip:** To persist the auto-generated `.env` and `APP_KEY`, copy it from the container:
> ```bash
> docker cp absensi-app:/var/www/html/.env ./.env.production
> ```
>
> **🎨 Customize Settings (Optional):** Create a `.env` file before running to customize `APP_NAME`, `APP_URL`, etc.
> ```bash
> cp .env.production.example .env
> # Edit .env with your settings
> docker-compose up -d --build
> ```

For detailed production deployment instructions, see **[PRODUCTION.md](PRODUCTION.md)**

## 📂 Project Structure

This project follows the standard Laravel directory structure:

- **`app/`**: Core application code (Models, Controllers, Middleware, etc.)
- **`routes/`**: Application routes (`web.php`, `api.php`)
- **`resources/views/`**: Blade templates for the frontend
- **`database/`**: Database migrations, seeders, and factories
- **`public/`**: Web server document root and static assets
- **`config/`**: Application configuration files

## 🛠 Tech Stack

- **Framework**: [Laravel 12](https://laravel.com/)
- **PHP**: 8.4
- **Frontend**: Blade Templates, [Tailwind CSS](https://tailwindcss.com/), [Vite](https://vitejs.dev/)
- **Database**: SQLite (production & development)
- **Build Tool**: Vite
- **Containerization**: Docker & Docker Compose (Alpine Linux)
- **Web Server**: Nginx

## 🔧 Development Commands

```bash
# Run development server
php artisan serve

# Run migrations
php artisan migrate

# Seed database
php artisan db:seed

# Clear cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Build assets for production
npm run build

# Watch assets during development
npm run dev
```

## 🐳 Docker Commands (Production)

```bash
# Deploy application
docker-compose up -d --build

# Stop application
docker-compose down

# View logs
docker-compose logs -f app

# Run artisan commands
docker-compose exec app php artisan [command]

# Examples:
docker-compose exec app php artisan db:seed
docker-compose exec app php artisan cache:clear
docker-compose exec app php artisan optimize

# Access container shell
docker-compose exec app sh

# Restart application
docker-compose restart app

# Update application (after code changes)
git pull
docker-compose up -d --build

# Backup database
docker cp absensi-app:/var/www/html/database/database.sqlite ./backup.sqlite

# View container health
docker-compose ps
```

For complete production deployment guide, see **[PRODUCTION.md](PRODUCTION.md)**

## 👥 Contributors

- **Refansa** - [@refansa](https://github.com/refansa)

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
