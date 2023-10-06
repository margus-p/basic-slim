
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


## Run Locally

The built-in PHP development server is fine.

```bash
  php -S localhost:8080 -t public
```
