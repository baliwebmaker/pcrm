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
```sh
config/permission.php config file If you already have a file by that name, you must rename or remove it.
```

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

Run database migrations:
```sh
php artisan migrate
```

#### Controllers
```sh
Edit app\Http\Controllers\UsersController.php
```
```sh
Create app\Http\Controllers\RolesController.php
```
```sh
Create app\Http\Controllers\PermissionsController.php
```


#### Models
```sh
Edit app\Models\User.php
```

#### Middlewares
```sh
Edit app\Http\Middleware\HandleInertiaRequests.php
```


#### Routes
```sh
routes\web.php
```

## RESOURCES

VUE / JS

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

