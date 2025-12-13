# PHP Basic - Layered Architecture Example

A minimal PHP project demonstrating the **Controller → Service → Repository → Database** flow, similar to Spring Boot architecture.

## Project Structure

```
php-basic/
├── composer.json               # Dependency management (like Maven pom.xml)
├── composer.lock               # Locked dependency versions
├── vendor/                     # Installed packages (auto-generated)
├── docker-compose.yml          # PostgreSQL 18 container
├── init.sql                    # Database initialization script
├── config/
│   └── Database.php            # Database connection (PDO)
├── src/
│   ├── Entity/
│   │   └── User.php            # Data model (like Spring @Entity)
│   ├── Repository/
│   │   └── UserRepository.php  # Data access layer (like Spring @Repository)
│   ├── Service/
│   │   └── UserService.php     # Business logic (like Spring @Service)
│   └── Controller/
│       └── UserController.php  # Request handler (like Spring @Controller)
├── views/
│   ├── user_form.php           # User registration form
│   └── user_list.php           # User list page
└── public/
    └── index.php               # Entry point & router
```

## Data Flow

```
Browser Request
       ↓
index.php (Router - like Spring DispatcherServlet)
       ↓
Controller (handles HTTP request/response)
       ↓
Service (business logic & validation)
       ↓
Repository (database operations via PDO)
       ↓
PostgreSQL Database
```

## Requirements

- PHP 8.1+
- Composer (PHP package manager)
- Docker & Docker Compose
- PHP PDO PostgreSQL extension (`pdo_pgsql`)

## Setup & Run

### 1. Install Composer (if not installed)

```bash
# macOS
brew install composer

# Linux
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
```

### 2. Install Dependencies

```bash
composer install
```

### 3. Start Database

```bash
docker-compose up -d
```

### 4. Verify PostgreSQL Extension

```bash
php -m | grep pdo_pgsql
```

If not installed (macOS with Homebrew):
```bash
brew install php  # includes pdo_pgsql by default
```

### 5. Start PHP Built-in Server

```bash
php -S localhost:8080 -t public
```

### 6. Access Application

Open http://localhost:8080 in your browser.

## Available Routes

| Method | URI            | Description          |
|--------|----------------|----------------------|
| GET    | `/`            | Redirect to /users   |
| GET    | `/users`       | List all users       |
| GET    | `/users/create`| Show registration form|
| POST   | `/users`       | Create new user      |

## Database Configuration

Default connection settings in `config/Database.php`:

| Parameter | Value       |
|-----------|-------------|
| Host      | localhost   |
| Port      | 5432        |
| Database  | php_basic   |
| User      | user        |
| Password  | password    |

## Layer Responsibilities

| Layer      | Spring Equivalent | Responsibility                     |
|------------|-------------------|------------------------------------|
| Controller | @Controller       | Handle HTTP requests, call services|
| Service    | @Service          | Business logic, validation         |
| Repository | @Repository       | Database CRUD operations           |
| Entity     | @Entity           | Data structure / model             |

## Spring vs PHP Comparison

| Concept       | Spring/Java          | PHP                          |
|---------------|----------------------|------------------------------|
| Build Tool    | Maven / Gradle       | Composer                     |
| Dependencies  | pom.xml / build.gradle| composer.json               |
| DB Driver     | JDBC                 | PDO (PHP Data Objects)       |
| Autoloading   | Classpath            | PSR-4 (Composer autoload)    |
| Entry Point   | @SpringBootApplication| public/index.php            |

## Notes

- This is a **pure PHP** implementation without frameworks
- Uses **Composer** for dependency management and **PSR-4** autoloading
- **PDO** is PHP's built-in database abstraction layer (like JDBC)
- In production, use frameworks like **Laravel** or **Symfony**