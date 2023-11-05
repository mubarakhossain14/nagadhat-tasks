# Application Setup Documentation

This documentation will guide you through the process of setting up a Laravel application from cloning it from a Git repository to serving it locally with database seeding, using Composer and npm.

## Cloning the Laravel Project

First, clone the Laravel project from the Git repository to your local machine. You can do this using the `git clone` command followed by the URL of the Git repository. For example:

```bash
git clone git@github.com:mubarakhossain14/nagadhat-tasks.git nagadhat-tasks
```

## Installing Dependencies

After cloning the project, navigate to the project directory and install the necessary dependencies. Laravel uses Composer for PHP dependencies and npm for JavaScript dependencies. You can install these dependencies using the following commands:

```bash
composer install
npm install
```


## Setting Up Environment Variables

Next, set up the environment variables for your Laravel application. Laravel uses the `.env` file to manage environment variables. You can create a `.env` file by copying the `.env.example` file:

```bash
cp .env.example .env
```

Then, open the `.env` file and set up your database connection details. You will need to specify the database name, username, and password. For example:

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

Replace `your_database_name`, `your_username`, and `your_password` with your actual database name, username, and password 

## Generating Application Key

After setting up the `.env` file, generate an application key using the `php artisan key:generate` command:

```bash
php artisan key:generate
```

This command will generate a unique key for your Laravel application and store it in the `APP_KEY` field of the `.env` file.

## Running Database Migrations and Seeding

Next, run the database migrations using the `php artisan migrate` command:

```bash
php artisan migrate
```

This command will create the necessary tables in your database. If your project includes a database seeder, you can run it using the `php artisan db:seed` command:

```bash
php artisan db:seed
```

This command will populate your database with some initial data.

## Serving the Application

Finally, serve your Laravel application locally using the `php artisan serve` command:

```bash
php artisan serve
```

By default, your application will be served at `http://localhost:8000`. You can access your application by opening this URL in your web browser.

## Building the Application

After setting up the application, you may need to build it using npm. You can do this using the `npm run dev` command:

```bash
npm run dev
```

This command will compile your JavaScript and CSS assets. After building the application, you may need to clear the configuration cache using the `php artisan config:clear`
