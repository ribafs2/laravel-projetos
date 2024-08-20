composer create-project --prefer-dist laravel/laravel authjs

cd authjs

composer require laravel/jetstream

php artisan jetstream:install livewire

npm install
npm run dev

php artisan migrate

config/jetstream.php
....
'features' => [
        Features::profilePhotos(),
        Features::api(),
        Features::teams(),
    ],
...

php artisan serve

Assim temos a estrutura de login e registro

