# Candidate evaluation app

A simple record of candidate evaluations developed in  [Laravel](https://laravel.com/docs/8.x/eloquent) and [MySQL](https://www.mysql.com/)

Requirements: 
* [COMPOSER](https://getcomposer.org/)
* Local php server
* [NPM](https://www.npmjs.com/)

Type: 
* MVC APP

Laravel version:
* v8

PHP version:
* >= v7.3.21 

To run this project, install it locally using composer:

```
$ cd .../projectName
$ composer install
$ npm install ( optional )
$ create database ( evaluactionsdb )
$ create file .env ( copy file .env.expample and rename it to .env )
$ create key applicaction ( php artisan key:generate )
$
```

Run migrations
```
php artisan migrate
```

Run seeder (Optionals)
```
php artisan db:seed
```
