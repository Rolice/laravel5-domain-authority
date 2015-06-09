<?php namespace Rolice\DomainAuthority;

use \Illuminate\Support\ServiceProvider;
use \Illuminate\Support\Facades\Config;

class BraintreeServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

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
            Braintree_Configuration::environment($app['config']->get('braintree.environment'));
            Braintree_Configuration::merchantId($app['config']->get('braintree.merchantId'));
            Braintree_Configuration::publicKey($app['config']->get('braintree.publicKey'));
            Braintree_Configuration::privateKey($app['config']->get('braintree.privateKey'));
        
            return Braintree_Configuration::gateway();
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