# Microservice API using Lumen Framework (PHP)

## Setup
1. Clone this repository
```bash
git clone http://api_repository_url
```

2. Open the folder
```bash
cd lumen-api
```

3. Run composer install
```bash
composer install
```
  
4. Copy file .env.sample and rename into .env  
   Adjust the credentials

5. Create table on database
```
php artisan migrate
```

6. Generate data on table users
```
php artisan db:seed --class=UsersTableSeeder
```

7. Publish and generate swagger documentation
```bash
php artisan swagger-lume:publish
php artisan swagger-lume:generate
```

8. Serve PHP file
```bash
php -S localhost:8000 -t public/index.php
```

9. Open API documentation  
```
http://localhost:8000/api/documentation
```
