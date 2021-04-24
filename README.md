## MiniSend
A mini version of a transactional email app built with laravel on the backend as an API service and VueJs on the frontend.

### Front End (VueJs) Project set up
```angular2html
cd web
```
then run

```
npm install
```

Set your api url in .env file e.g.
```angular2html
VUE_APP_API_URL=http://api.test/api
```
Compiles and hot-reloads for development
```
npm run serve
```

Compiles and minifies for production
```
npm run build
```

### Backend (Laravel) Project setup
Open a new terminal
```angular2html
cd api
```

Install packages with composer
```angular2html
composer install
```

Make a copy of .env.example as .env
```angular2html
cp .env.example .env
```
   

Generate app key
```angular2html
php artisan key:generate
```

Create your database and add the database credentials to `.env` file

Run migration
```angular2html
php artisan migrate
```

Run database seed to create sample data
```angular2html
php artisan db:seed
```

Run Tests 
```angular2html
php artisan test
```

Start laravel local server



