<?php namespace DomainAuthority;

use \Illuminate\Support\ServiceProvider as SP;
use \Illuminate\Support\Facades\Config;

class ServiceProvider extends SP {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes(
            [ __DIR__.'/../../config/domainauthority.php' => config_path('domainauthority.php') ],
            'config'
        );

        $this->mergeConfigFrom(__DIR__.'/../../config/braintree.php', 'domainauthority');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        
        $this->app['domainauthority'] = $this->app->share(function($app) {
        
        });
        
        
        
        $this->app->singleton('command.braintree.example', function($app) {
            return new BraintreeExampleCommand();
        });

    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'Rolice\DomainAuthority',
        ];
    }

}