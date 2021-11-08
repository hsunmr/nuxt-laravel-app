### Nuxt x Laravel application
> a posts application, frontend use nuxt.js, backend use laravel

#### Usage
**Laravel (Backend)**

-- STEP1
create a mysql database

-- STEP2
set env file
```
cd nuxt-laravel-app/laravel-backend

# copy env file
cp .env.example .env

# set database env
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=nuxt_laravel
DB_USERNAME=root
DB_PASSWORD=root

# install packages
composer install

# set app key
php artisan key:generate

# set jwt secret
php artisan jwt:secret

# migrate tables
php artisan migrate
```
-- STEP3
run serve
Starting Laravel development server: http://127.0.0.1:8000
```
php artisan serve
```

**Nuxt (Frontend)**
Listening on: http://localhost:9528/
```
cd nuxt-laravel-app/nuxt-app

# copy env file
cp .env.example .env

# set your backend url
BACKEND_URL=http://127.0.0.1:8000

# npm install
npm install

#run dev
npm run dev
```

#### DEMO
https://nuxt-frontend-app.herokuapp.com/