<?php
namespace Pewe\RajaOngkir;
use \GuzzleHttp\Client as Client;
/**
* 
*/
class Province
{
	public function all(){
		try {
			$headers=['key'=> config('rajaongkir.api_key')];
			$client=new Client([
				'base_uri'=>'https://api.rajaongkir.com/starter/',
				'headers'=>$headers
			]);
			$response=$client->get('province');
			if($response->getStatusCode()==200)
			{
				$results=json_decode($response->getBody());
				return collect($results->rajaongkir->results);
			}
			return collect();
		} catch (Exception $e) {
			
		}
	}
	public function find($id){
		try {
			$headers=['key'=> config('rajaongkir.api_key')];
			$client=new Client([
				'base_uri'=>'https://api.rajaongkir.com/starter/',
				'headers'=>$headers
			]);
			$response=$client->get('province',['query'=>['id'=>$id]]);
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