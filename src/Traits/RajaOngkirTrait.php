<?php
namespace Pewe\RajaOngkir\Traits;
use GuzzleHttp\Exception\RequestException;
use Pewe\RajaOngkir\Exceptions\RajaOngkirRequestException;
use Pewe\RajaOngkir\Exceptions\TokenInvalidException;
use \GuzzleHttp\Client as Client;

trait RajaOngkirTrait{
	private $key;
	private $base_uri;
	private function getKey(){
		$this->key=config('rajaongkir.api_key');
		return $this->key;
	}
	private function getBaseUri(){
		switch (config('rajaongkir.type','starter')) {
			case 'basic':
				$this->base_uri='https://api.rajaongkir.com/basic/';
				break;
			case 'pro':
				$this->base_uri='https://api.rajaongkir.com/api/';
				break;
			
			default:
				$this->base_uri='https://api.rajaongkir.com/starter/';
				break;
		}
		return $this->base_uri;
	}
	public function getClient()
	{
		$headers=['key'=> $this->getKey()];
		$client=new Client([
			'base_uri'=>$this->getBaseUri(),
			'headers'=>$headers
		]);
		return $client;
	}
	public function getErrors(RequestException $e)
	{
	    if ($e->hasResponse()) {
	        $errors=json_decode($e->getResponse()->getBody(true));
	        if($errors->rajaongkir->status->code==400 
	        	&&$errors->rajaongkir->status->description=='Invalid key. API key tidak ditemukan di database RajaOngkir.'){
	        	throw new TokenInvalidException();		        	
	        }
	        else
	        	throw new RajaOngkirRequestException($errors->rajaongkir->status->description);
	    }
	    else
        	throw new RajaOngkirRequestException();
	}
}