# Hygge Friends Laravel Test App
> Test app with API endpoints to make/accept/decline friend requests.

## Installation


```sh
composer install
cp .env.example .env
php artisan key:generate
php artisan passport:install
php artisan migrate
php artisan db:seed
```


## Authorization

DB seeder contains test users. 
Just grab on of them and login with email and password.
Password for each user is just `password`

## API docs

You can find API documentation in `apidocs.yaml`

## Postman collection

You can use Postman collection for testing purposes. Find it in `HyggeFriends.postman_collection.json`
