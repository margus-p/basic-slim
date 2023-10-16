
# Simple Slim v4 skeleton

Simple Slim v4 skeleton featuring: 
* Slim PSR-7
* PHP DI
* Doctrine ORM + Migrations
* DotEnv
* PHP-CS-Fixer




## Requirements

* PHP 8.2
* Composer
* Any database server that's supported by Doctrine 
## Installation

1. Install composer dependencies
   
```bash
  composer install
```

2. Configure
Make a copy of .env.example and rename it as '.env'.
Edit the .env file and add:
* Database credentials
* Database driver (pdo_mysql as default)

3. Initialize the Database
In your project directory, run:
```bash
  php vendor/bin/doctrine migrations:migrate
```

4. By default, the app works in the root directory. To get the app running in a subdirectory, you must edit the .htaccess file in the public directory and add the RewriteBase line. Then, change the value to the subdirectory name. For example, if you want the app to run in the /app directory, the line should look like this:

```bash
  RewriteBase /app
```

Additionally, you must let the Slim router know that the app is running in a subdirectory. To do this, edit the public/index.php file and add the following line after the $app variable is instantiated:

```bash
  $app->setBasePath('/app');
```

## Run Locally

The built-in PHP development server is fine.

```bash
  php -S localhost:8080 -t public
```
