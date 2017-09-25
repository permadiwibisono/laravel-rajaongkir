<?php
namespace Pewe\RajaOngkir\Facades;
use Illuminate\Support\Facades\Facade;
/**
* 
*/
class Province extends Facade
{
	/**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { 
    	return 'Pewe\RajaOngkir\Province'; 
    }
}