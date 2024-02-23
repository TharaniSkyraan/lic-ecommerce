<?php
namespace Sky\LicEcommerce;

use Illuminate\Support\ServiceProvider;

class LicEcommerceServiceProvider extends ServiceProvider
{

        
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        
        $this->loadViewsFrom(__DIR__.'/views', 'lic-ecommerce');
        
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
   
    }

    public function register()
    {

    }

}
