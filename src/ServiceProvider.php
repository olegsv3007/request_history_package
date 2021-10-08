<?php

namespace Olegsv\History;

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\Facades\View;
use Olegsv\History\Middleware\StoreRequestInformationMiddleware;
use Olegsv\History\Repositories\RequestClickhouseRepository;
use Olegsv\History\Repositories\RequestRepositoryInterface;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function register()
    {

    }

    public function boot()
    {
        $this->app->bind(RequestRepositoryInterface::class, RequestClickhouseRepository::class);

        $this->publishes([
            __DIR__ . '/config/history.php' => config_path('history.php'),
        ]);

        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        $this->loadTranslationsFrom(__DIR__ . '/resources/lang', 'history');
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'history');

        $kernel = $this->app->make(Kernel::class);
        $kernel->pushMiddleware(StoreRequestInformationMiddleware::class);

        View::composer('history::index', function ($view) {
            $view->with([
                'methods' => config('history.filters.methods'),
                'itemsPerPage' => config('history.filters.items_per_page'),
            ]);
        });

    }
}
