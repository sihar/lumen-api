# Microservice API PHP

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

5. Publish and generate swagger documentation
```bash
php artisan swagger-lume:publish
php artisan swagger-lume:generate
```
