<?php 
namespace DGvai\Invoicer;

use Illuminate\Support\ServiceProvider;

class InvoicerServiceProvider  extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/invoicer.php' => config_path('invoicer.php')
        ], 'invoicer-config');

        $this->publishes([
            __DIR__.'/assets' => public_path('vendor/invoicer'),
        ], 'invoicer-assets');

        $this->loadViewsFrom(__DIR__.'/views', 'invoicer');
    }
}