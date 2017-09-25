<?php
namespace Pewe\RajaOngkir;
use \GuzzleHttp\Client as Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;
/**
* 
*/
class City
{
	public function all(){
		try {
			$headers=['key'=> config('rajaongkir.api_key')];
			$client=new Client([
				'base_uri'=>'https://api.rajaongkir.com/starter/',
				'headers'=>$headers
			]);
			$response=$client->get('city');
			if($response->getStatusCode()==200)
			{
				$results=json_decode($response->getBody());
				return collect($results->rajaongkir->results);
			}
			return collect();
		} catch (RequestException $e) {
		    if ($e->hasResponse()) {
		        echo Psr7\str($e->getResponse());
		    }
			
		}
		catch (Exception $e) {
			
		}
	}
	public function find($id){
		try {
			$headers=['key'=> config('rajaongkir.api_key')];
			$client=new Client([
				'base_uri'=>'https://api.rajaongkir.com/starter/',
				'headers'=>$headers
			]);
			$response=$client->get('city',['query'=>['id'=>$id]]);
			if($response->getStatusCode()==200)
			{
				$results=json_decode($response->getBody());
				return collect($results->rajaongkir->results);
			}
			return collect();
		} catch (Exception $e) {
			
		}
	}
}