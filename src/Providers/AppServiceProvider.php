<?php

namespace Abedin\WebInstaller\Providers;

use Abedin\WebInstaller\Middleware\CheckHasConfigMiddleware;
use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;

class AppServiceProvider extends ServiceProvider
{

     /**
     * Ragister package config path name here.
     * @param string
     */
    private const CONFIG_FILE = __DIR__ . '/../../config/installer.php';
    
    /**
     * Ragister package path name here.
     * @param string
     */
    private const PATH_VIEWS = __DIR__ . '/../../resources/views';

    private const PATH_ASSETS = __DIR__ . '/../../resources/assets';

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../../routes/web.php');
    }

    /**
     * Bootstrap the application events.
     *
     * @param  \Illuminate\Routing\Router  $router
     */
    public function boot(Router $router)
    {
        $router->middlewareGroup('config_check', [CheckHasConfigMiddleware::class]);
        
        $this->app['router']->aliasMiddleware('config_check', CheckHasConfigMiddleware::class);
        $this->loadViewsFrom(self::PATH_VIEWS, 'joynala.web-installer');

        $this->publishes([
            self::PATH_VIEWS => resource_path('views/vendor/web-installer'),
            self::PATH_ASSETS => public_path('vendor/web-installer'),
        ], 'web-installer');
        

        $this->publishes([
            self::CONFIG_FILE => base_path('config/installer.php'),
        ], 'web-installer-config');
    }


}