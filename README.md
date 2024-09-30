# User Management
## This project is a simple REST API server implemented using Laravel 9+, with a Vue.js frontend to demonstrate user listing and creation. It includes features such as data seeding, image handling.

Requirements
## PHP 8.x
## Laravel 9+

Installation and Setup
Clone the Repository:

Install Dependencies: Install the necessary PHP dependencies using Composer:
```composer install ```
Install the frontend dependencies using NPM:

```
npm install
```
Environment Configuration: Copy the example .env file and set up the environment variables:

## I will attach my .ENV in REPO as .env.example so you can use it, it includes API key for image thing
```
cp .env.example .env
```

Generate Application Key:

```
php artisan key:generate
```
Run Migrations and Seeders: 
Run the database migrations and seed the database with initial data (45 users):

```
php artisan migrate --seed
```
Start the Server: To start the Laravel development server:

```
php artisan serve
```
Build the Frontend: To compile and build the frontend assets for production:

```
npm run build
```
During development, you can use:

```
Copy code
npm run dev
```

## Data Seeder
The seeder generates 45 users with realistic data. You can find the seeder in database/seeders/UserSeeder.php.
