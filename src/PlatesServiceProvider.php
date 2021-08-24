<?php
/**
 * 'It is frequently a misfortune to have very brilliant men in charge of affairs. They expect too much of ordinary men.'
 * - Thucydides
 *
 * PHP Plates wrapper
 * @http://platesphp.com/
 *
 */

namespace MillieOfzo\Plates;

use Illuminate\Support\ServiceProvider;
use League\Plates\Engine as PlatesEngine;

class PlatesServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole())
        {
            // Publish config
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('plates.php'),
            ], 'config');
        }
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'plates');

        $app = $this->app;

        $app->singleton('League\Plates\Engine', function () use ($app)
        {
            $path = $app['config']['view.paths'][0];

            return new PlatesEngine($path, config('plates.extension'));
        });

        $app->resolving('view', function ($view) use ($app)
        {
            $view->addExtension(config('plates.extension'), 'plates', function () use ($app)
            {
                return new PlatesTemplater($app->make('League\Plates\Engine'));
            });
        });
    }
}
