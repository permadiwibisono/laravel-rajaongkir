<?php
namespace Pewe\RajaOngkir\Facades;
use Illuminate\Support\Facades\Facade;
/**
* 
*/
class Cost extends Facade
{
	/**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { 
    	return 'Pewe\RajaOngkir\Cost'; 
    }
}