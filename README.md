# Studying Opportunity Table Management System

## Overview

This is an alternative platform to Excel for recording university and professor information, designed to help manage academic application information to universities. The platform is built using Laravel and Filament, providing a convenient way to organize and track data related to professors, universities, and application processes.

## Features

- **Professor Information**: Store comprehensive details about professors, including their name, university, field of work, and contact information.
- **Email Management**: Track the status of emails sent to professors, making it easy to follow up on communication.
- **Filtering and Sorting**: Use various filters such as country, university, construction time, and field of work to quickly locate information. Sort the data in the table based on your preferences.
- **Search Functionality**: Easily search for specific information within the table to find what you need.
- **CRUD Operations**: Create, modify, and delete professor and university information as needed.
- **Extract Excel Feature**: Utilize Laravel Excel to export data from the platform to Excel spreadsheets for further analysis.
- **Authentication System**: Protect your data with an authentication system that requires a username and password for access.

## Technologies Used

- **Laravel**: A powerful PHP framework used for developing the back-end of the application.
- **Filament**: An admin panel framework for Laravel that provides a user-friendly interface for managing data.
- **Laravel Excel**: A library for importing and exporting Excel and CSV files in Laravel applications.

## Installation

1. Clone this repository to your local machine:

```bash
git clone https://github.com/yourusername/academic-application-management.git
```

2. Change into the project directory:

```bash
cd academic-application-management
```

3. Install composer dependencies:

```bash
composer install
```

4. Create a `.env` file by duplicating the `.env.example` file and configure it with your environment settings:

```bash
cp .env.example .env
```

5. Generate a new application key:

```bash
php artisan key:generate
```

6. Configure your database settings in the `.env` file:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
```

7. Migrate the database:

```bash
php artisan migrate
```
8. make user with:

```bash
php artisan make:filament-user
```

9. Start the development server:

```bash
php artisan serve
```

10.Access the application in your web browser.

## Usage

1. Create an account and log in using the provided authentication system.
2. Use the platform to manage professor and university information, emails, and applications.
3. Utilize the filtering, searching, and sorting features to efficiently navigate and analyze your data.
4. Export data to Excel spreadsheets using the "Extract Excel" feature for further analysis.

## License

This project is licensed under the [MIT License](LICENSE).

## Contact

If you have any questions or suggestions, feel free to contact me at [samasky.rostami@gmail.com](samasky.rostami@gmail.com).

