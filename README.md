# API of store project

A simple customer registry developed in  [lARAVEL](https://laravel.com/docs/8.x/eloquent) and [MySQL](https://www.mysql.com/)

Requirements: 
* [COMPOSER](https://getcomposer.org/)
* [Wampserver](https://www.wampserver.com/en/) | [XAMPP](https://www.apachefriends.org/es/index.html)
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
$ composere install
$ npm install ( optional )
$ create database ( customeres )
$ create file .env ( copy file .env.expample and rename it to .env )
$ create key applicaction ( php artisan key:generate )
$
```

Run migrations
```
php artisan migrate

Run seeder (Optionals)
```
php artisan db:seed