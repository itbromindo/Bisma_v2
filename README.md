<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Setup Di Local Development

- Clone project :
```bash
git https://github.com/itbromindo/Bisma_v2.git
```
- jalankan perintah :
```bash
composer install 

atau

composer update
```

- Install NPM (pastikan sudah instal node.js):
```bash
npm install
```

- build npm:
```bash
npm run dev
```

- buat file  <b>.env</b>  duplicat file  <b>.env.example</b>  jangan lupa rename jadi  <b>.env</b>
- buka file  <b>.env</b>  Rubah di bagian (Connection ke database kita):

```
DB_DATABASE=nama-database
DB_USERNAME=username-db
DB_PASSWORD=password-db
```

- jalankan perintah (Generate Key):
```bash
php artisan key:generate
```

- jalankan perintah (migration):
```bash
php artisan migrate:fresh --seed
```

## Menjalankan Aplikasi

```bash
php artisan serve --port=8000
```

## Account Admin Default

```
user untuk admin 
 - email : adicahyo@mail.com
 - password : 1234
```



## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
