<?php
namespace Pewe\RajaOngkir\Exceptions;
use Exception;
class RajaOngkirRequestException extends \Exception
{
	public function __construct($message='Bad Request')
    {
        parent::__construct($message);
    }
}