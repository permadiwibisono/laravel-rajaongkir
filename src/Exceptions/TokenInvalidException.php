<?php
namespace Pewe\RajaOngkir\Exceptions;
use Exception;
class TokenInvalidException extends \Exception
{
	public function __construct($message='Invalid Token.')
    {
        parent::__construct($message);
    }
}