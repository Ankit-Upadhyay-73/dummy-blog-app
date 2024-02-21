<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## setup
.env is also included in codebase

## About project

this project is to demonstrate 
- Create bulk users using command `php artisan make:users`
    This will create a csv file users_100K.csv in 'storage/app/'
- Import all csv users data in database using `php artisan import:users`
    This will dump users details in users table
- Fetch posts jsonplaceholder api using `hit:jsonPlaceholderApi`
    This command will create batch of 100jobs to import posts and its
    associated comment and write into table
    