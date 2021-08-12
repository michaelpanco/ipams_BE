# IP Address Management Solution System Frontend

This project is built for Practical Test

## Requirements

 - PHP 7.2
 - MySQL 5.7
 - OpenSSL PHP Extension
 - PDO PHP Extension
 - Mbstring PHP Extension
 - PHP Dom (Specific to PHP 7.2)
 - Composer

## Setup

 1. Clone the project repository.
 2. Go to the main directory of your project and run `composer install`.
 3. Manually create .env file in your root directory, copy the .env.example and change the setting aside from JWT_SECRET
 4. Import the dbinit.sql (found in the root directory) to your MySQL database,

### Notice

You can change the value of JWT_SECRET however you need to make sure that the frontend also use the same value.

## Full Lumen Framework Documentation

See the [Lumen Framework Docs](https://lumen.laravel.com/docs/7.x)