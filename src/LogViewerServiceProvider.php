<?php

namespace Ibrah\LaravelLogViewer;

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Ibrah\LaravelLogViewer\Http\Middleware\AuthorizeLogViewer;
use Ibrah\LaravelLogViewer\Http\Middleware\SetLocale;
use Ibrah\LaravelLogViewer\Services\LogParser;

class LogViewerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any package services.
     */
    public function boot(): void
    {
        // Register middleware aliases
        $router = $this->app->make(Router::class);
        $router->aliasMiddleware('log-viewer.authorize', AuthorizeLogViewer::class);
        $router->aliasMiddleware('log-viewer.locale', SetLocale::class);

        // Load routes
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');

        // Load views
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'log-viewer');

        // Load translations
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'log-viewer');

        // Publish configuration
        $this->publishes([
            __DIR__ . '/../config/log-viewer.php' => config_path('log-viewer.php'),
        ], 'log-viewer-config');

        // Publish views
        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/log-viewer'),
        ], 'log-viewer-views');

        // Publish translations
        $this->publishes([
            __DIR__ . '/../resources/lang' => $this->app->langPath('vendor/log-viewer'),
        ], 'log-viewer-lang');

        // Publish assets
        $this->publishes([
            __DIR__ . '/../public' => public_path('vendor/log-viewer'),
        ], 'log-viewer-assets');
    }

    /**
     * Register any package services.
     */
    public function register(): void
    {
        // Merge configuration
        $this->mergeConfigFrom(
            __DIR__ . '/../config/log-viewer.php',
            'log-viewer'
        );

        // Register the LogParser service
        $this->app->singleton(LogParser::class, function ($app) {
            return new LogParser();
        });
    }
}
