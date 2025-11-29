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

### Option 2: Docker Setup

For detailed Docker instructions, see [README_DOCKER.md](README_DOCKER.md)

**Quick Start:**

1. **Build the Docker image**:
   ```bash
   docker build -t absensi-app .
   ```

2. **Run the container**:
   ```bash
   # Windows PowerShell
   docker run -d --name absensi -p 9000:9000 -v ${PWD}:/var/www/html absensi-app
   
   # Linux/Mac
   docker run -d --name absensi -p 9000:9000 -v "$(pwd):/var/www/html" absensi-app
   ```

3. **Configure your web server** to point to `127.0.0.1:9000` for PHP-FPM

4. **Run migrations**:
   ```bash
   docker exec absensi php artisan migrate
   docker exec absensi php artisan db:seed
   ```

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
- **PHP**: 8.2
- **Frontend**: Blade Templates, [Tailwind CSS](https://tailwindcss.com/), [Vite](https://vitejs.dev/)
- **Database**: SQLite (default), compatible with MySQL/PostgreSQL
- **Build Tool**: Vite

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

## � Docker Commands

```bash
# Start container
docker start absensi

# Stop container
docker stop absensi

# View logs
docker logs -f absensi

# Run artisan commands
docker exec absensi php artisan [command]

# Access container shell
docker exec -it absensi bash
```

## 👥 Contributors

- **Refansa** - [@refansa](https://github.com/refansa)

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
