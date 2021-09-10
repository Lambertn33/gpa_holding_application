## About gpa holding apllication management

Web Application that helps to record GPA Holdings (https://gpaholdingsltd.com) Documents(Invoices , Proformas , Receipts,...).

## Requirement
- PHP: 7.4 +
- Composer

## Setting Up

- After cloning the repo
- cd into repo directory
- run `composer install`
- run  `cp .env.example .env` and setting up database config
- run `php artisan key:generate`
- run `php artisan migrate`
- run `php artisan db:seed`
- run `php artisan db:seed 
Then app is ready to run
