## PHP Test Laravel

##### Get started

First you will need to install the composer packages:

```composer install```

After this you will need to copy the ```env.example``` to ```.env```

You can do this manually or run:

```php -r "file_exists('.env') || copy('.env.example', '.env');```

Lastly you'll need to generate the application key:

```php artisan key:generat --ansi```

Welcome to your new Pokedex

