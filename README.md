# Absensi (Attendance System)

A web-based attendance system built with Laravel.

## 🚀 Getting Started

This project uses Docker to simplify the development environment. Follow the steps below to get the project running.

### Prerequisites

- [Docker](https://www.docker.com/)
- [Docker Compose](https://docs.docker.com/compose/)

### Installation & Running

1.  **Clone the repository** (if you haven't already):
    ```bash
    git clone https://github.com/refansa/absensi.git
    cd absensi
    ```

2.  **Setup Environment Variables**:
    Copy the Docker-specific environment file to `.env`:
    ```bash
    cp .env.docker .env
    ```

3.  **Start the Containers**:
    Build and start the services (App, Web, Database, Redis, Mailpit):
    ```bash
    docker-compose up -d --build
    ```

4.  **Install Dependencies**:
    Install PHP dependencies via Composer inside the container:
    ```bash
    docker-compose exec app composer install
    ```

5.  **Run Migrations**:
    Set up the database tables:
    ```bash
    docker-compose exec app php artisan migrate
    ```

6.  **Access the Application**:
    - **Web App**: [http://localhost:8000](http://localhost:8000)
    - **Mailpit (Email Testing)**: [http://localhost:8025](http://localhost:8025)

## 📂 Project Structure (Traversing the Project)

This project follows the standard Laravel directory structure:

-   **`app/`**: Contains the core code of the application (Models, Controllers, etc.).
-   **`routes/`**: Defines the application routes (`web.php`, `api.php`).
-   **`resources/views/`**: Contains the Blade templates for the frontend.
-   **`database/`**: Contains database migrations and seeders.
-   **`docker/`**: Contains Docker configuration files (e.g., Nginx config).
-   **`public/`**: The entry point for the web server (`index.php`) and static assets.

### Docker Services

-   **App**: PHP 8.2 FPM container serving the Laravel application.
-   **Web**: Nginx web server handling HTTP requests.
-   **DB**: MySQL 8.0 database.
-   **Redis**: In-memory data structure store, used for caching and queues.
-   **Mailpit**: A tool for testing emails locally without sending them to real addresses.

## 🛠 Tech Stack

-   **Framework**: [Laravel](https://laravel.com/)
-   **Frontend**: Blade Templates, [Tailwind CSS](https://tailwindcss.com/), [Vite](https://vitejs.dev/)
-   **Database**: MySQL
-   **Cache/Queue**: Redis

## 👥 Contributors

-   **Refansa**

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
