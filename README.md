## Development deploy order

System requirements:
- PHP v7.4
- MySQL v5.7
- Composer
___
Clone repository by command
```
git clone URL
```
Go to your project directory
```
composer install
cp .env.example .env
php artisan key:generate
npm install
npm run dev
php artisan migrate --seed
php artisan serve
```
___

Swagger docs
```
/api/documentation
```

Routes
```
1.1. GET /api/v1/notebooks/
1.2. GET /api/v1/notebooks/store
1.3. POST /api/v1/notebooks/
1.4. GET /api/v1/notebooks/<id>/
1.5. POST /api/v1/notebooks/<id>/
1.6. DELETE /api/v1/notebooks/<id>/
```