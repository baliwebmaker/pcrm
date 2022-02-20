## Clone PINGCRM repo locally:

```sh
git clone https://github.com/inertiajs/pingcrm.git pingcrm
cd pingcrm
```
Install PHP dependencies:

```sh
composer install
```

Install NPM dependencies:
```sh
npm ci
```

Build assets:
```sh
npm run dev
```

Setup configuration:
```sh
cp .env.example .env
```

Generate application key:
```sh
php artisan key:generate
```
`
Create an SQLite database. You can also use another database (MySQL, Postgres), simply update your configuration accordingly.


## Installation Spatie

config/permission.php config file 

install the package via composer:
```sh
composer require spatie/laravel-permission
```

Edit config/app.php
```sh
'providers' => [
    // ...
    Spatie\Permission\PermissionServiceProvider::class,
];
```
```sh
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
```
```sh
php artisan optimize:clear
```

```sh
Edit database\seeders\DatabaseSeeder.php
```
```sh
Run database migrations:
php artisan migrate
```

```sh
Edit app\Http\Controllers\UsersController.php
```
```sh
Create app\Http\Controllers\RolesController.php
```
```sh
Create app\Http\Controllers\PermissionsController.php
```
```sh
Edit app\Models\User.php
```
```sh
Edit app\Http\Middleware\HandleInertiaRequests.php
```
```sh
routes\web.php
```

## RESOURCES

```sh
Edit resources\js\Pages\Users
Index,Edit,Create,Register
```
```sh
Create resources\js\Pages\Roles
Index,Edit,Create,
```

```sh
resources\js\Pages\Permissions
Index,Edit,Create,
```

```sh
Create resources\js\Mixins\assignPermission.js
```

