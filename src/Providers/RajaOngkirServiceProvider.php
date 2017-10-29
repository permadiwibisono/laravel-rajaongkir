<?php

namespace Pewe\RajaOngkir\Providers;

use Illuminate\Support\ServiceProvider;

class RajaOngkirServiceProvider extends ServiceProvider
{
	/**
	 * Perform post-registration booting of services.
	 *
	 * @return void
	*/
	public function boot()
	{
	    $this->publishes([
	        __DIR__.'/../config/rajaongkir.php' => config_path('rajaongkir.php'),
	    ],'laravel-rajaongkir-config');
	}
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
