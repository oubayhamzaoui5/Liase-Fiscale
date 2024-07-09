# Liase-Fiscale

Liase-Fiscale is a comprehensive web application designed to facilitate the management and submission of fiscal documents for businesses. This application provides a user-friendly interface for taxpayers to upload and track their fiscal declarations, and for administrators to manage and verify these submissions efficiently.

## Features

- **User Authentication:** Secure login system with role-based access control for taxpayers and administrators.
- **Taxpayer Management:** Admins can add new taxpayers, who set their password upon first login.
- **Document Upload:** Taxpayers can upload various required and optional documents in XML and PDF formats.
- **Submission Tracking:** Taxpayers can track the status of their submissions, with statuses like "in progress," "not validated," and "validated."
- **Admin Dashboard:** Admins have a dashboard to view all taxpayers, track their submissions, and approve or decline submissions.
- **Real-time Status Updates:** Submissions are updated in real-time to reflect their current status.

## Technologies Used

- **Backend:** Laravel (PHP)
- **Frontend:** Blade Templating, CSS
- **Database:** MySQL
- **Version Control:** Git

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Installation

1. **Clone the repository and navigate to the project directory:**

    ```bash
    git clone https://github.com/your-username/Liase-Fiscale.git
    cd Liase-Fiscale
    ```

2. **Install dependencies:**

    ```bash
    composer install
    npm install
    ```

3. **Set up the environment:**

    - Copy the `.env.example` file to `.env`:

    ```bash
    cp .env.example .env
    ```

    - Edit the `.env` file with your database settings.

4. **Generate the application key:**

    ```bash
    php artisan key:generate
    ```

5. **Run the migrations and seeders:**

    ```bash
    php artisan migrate --seed
    ```

6. **Start the development server:**

    ```bash
    php artisan serve
    ```

## Usage

- **Admin Panel:** Accessible to users with admin roles for managing taxpayers and their submissions.
- **User Dashboard:** Taxpayers can log in, upload their documents, and track the status of their submissions.

## Contribution

We welcome contributions! Please fork the repository and submit pull requests for any features, enhancements, or bug fixes.

## Contact

For more information, please contact Oubay Hamzaoui at [oubayhamzaoui5@gmail.com].
