<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

![image](https://github.com/user-attachments/assets/9cb2cb3c-9a77-49a2-871e-d53dbddfe19f)
![image](https://github.com/user-attachments/assets/8a73503c-ad76-4a74-890b-333d9cdef053)
![image](https://github.com/user-attachments/assets/af1ba500-f089-43b0-a1cb-d2aa7b86e108)


## Simple Student Management System

-   Provides Role and Permission
-   View Student Details
-   Create Student
-   Edit and Update Student
-   Delete Student
-   Create, Edit, and Delete Role
-   Create, Edit, and Delete User

## Laravel System Installation Guide

This guide will help you set up the Laravel system on your local machine. Follow the steps below to get started.

### Requirements

Before proceeding, ensure you have the following installed:

-   Composer (PHP dependency manager)
-   Node.js (for JavaScript dependencies)
-   XAMPP (Apache/MySQL server)
-   Laravel (check if installed using `composer global show laravel/installer`)

### Installation Steps

1. **Clone the Repository**

    Clone the repository to your htdocs directory:

    ```bash
    git clone https://github.com/nm-safran/SM.git
    ```

2. **Start XAMPP Server**

    Open the XAMPP Control Panel and start Apache and MySQL servers.

3. **Create a Database**

    Go to phpMyAdmin at [http://localhost/phpmyadmin](http://localhost/phpmyadmin) and create a new database named `sm`.

4. **Install Dependencies**

    Open a terminal (Command Prompt or Git Bash) in the project directory and run the following commands:

    **Install PHP Dependencies**

    ```bash
    composer install
    composer require laravel/ui
    php artisan ui bootstrap --auth
    composer require spatie/laravel-permission
    php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
    ```

    **Install JavaScript Dependencies**

    ```bash
    npm install
    npm run build
    ```

5. **Set Up the Database**

    Run migrations and seed the database:

    ```bash
    php artisan migrate:fresh --seed
    ```

6. **Generate Application Key**

    Generate the Laravel application key:

    ```bash
    php artisan key:generate
    ```

7. **Serve the Application**

    Start the Laravel development server:

    ```bash
    php artisan serve
    ```

8. **Access the Application**

    Visit the application in your browser:

    ```
    http://127.0.0.1:8000/
    ```

### Default Credentials

Here are the default credentials for testing:

**Super Admin**

-   Email: admin@example.com
-   Password: admin

**Student**

-   Email: student@example.com
-   Password: student1

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

-   [Simple, fast routing engine](https://laravel.com/docs/routing).
-   [Powerful dependency injection container](https://laravel.com/docs/container).
-   Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
-   Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
-   Database agnostic [schema migrations](https://laravel.com/docs/migrations).
-   [Robust background job processing](https://laravel.com/docs/queues).
-   [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

-   **[Vehikl](https://vehikl.com/)**
-   **[Tighten Co.](https://tighten.co)**
-   **[WebReinvent](https://webreinvent.com/)**
-   **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
-   **[64 Robots](https://64robots.com)**
-   **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
-   **[Cyber-Duck](https://cyber-duck.co.uk)**
-   **[DevSquad](https://devsquad.com/hire-laravel-developers)**
-   **[Jump24](https://jump24.co.uk)**
-   **[Redberry](https://redberry.international/laravel/)**
-   **[Active Logic](https://activelogic.com)**
-   **[byte5](https://byte5.de)**
-   **[OP.GG](https://op.gg)**

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).
