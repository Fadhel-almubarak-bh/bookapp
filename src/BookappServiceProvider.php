<?php

namespace Xs4arabia\Bookapp;

use Illuminate\Support\ServiceProvider;

class BookappServiceProvider extends ServiceProvider
{
    public function boot()
    {
            $this->publishes([
                __DIR__.'/../database/migrations' => database_path('migrations'),
            ], 'bookapp-migrations');
            $this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/bookapp'),
                __DIR__.'/../resources/images' => public_path('/images'),
            ], 'bookapp-views');
            $this->publishes([
                __DIR__.'/Models' => app_path('/Models'),
            ], 'bookapp-models');
            $this->publishes([
                __DIR__.'/Http/Controllers' => app_path('Http/Controllers'),
            ], 'bookapp-controllers');
            $this->publishes([
                __DIR__ . '/../routes/web.php' => base_path('routes/bookapp.php'),
            ], 'bookapp-routes');        

            $this->publishes([
                __DIR__.'/../database/migrations' => database_path('migrations'),
                __DIR__.'/../resources/views' => resource_path('views/vendor/bookapp'),
                __DIR__.'/../resources/images' => public_path('/images'),
                __DIR__ . '/../routes/web.php' => base_path('routes/bookapp.php'),
            ], 'bookapp');  

            $this->publishes([
                __DIR__.'/../database/migrations' => database_path('migrations'),
                __DIR__.'/../resources/views' => resource_path('views/vendor/bookapp'),
                __DIR__.'/../resources/images' => public_path('/images'),
                __DIR__ . '/../routes/web.php' => base_path('routes/web.php'),
            ], 'laravel-assets');  
    }

    public function register()
    {
        // Register bindings or services if any
    }
}