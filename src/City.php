<?php
namespace Pewe\RajaOngkir;
use GuzzleHttp\Exception\RequestException;
use Pewe\RajaOngkir\Traits\RajaOngkirTrait;
use \GuzzleHttp\Client as Client;
/**
* 
*/
class City
{
	use RajaOngkirTrait;
	public function all(){
		try {
			// $headers=['key'=> config('rajaongkir.api_key')];
			$client=$this->getClient();
			$response=$client->get('city');
			if($response->getStatusCode()==200)
			{
				$results=json_decode($response->getBody());
				return collect($results->rajaongkir->results);
			}
			return collect();
		} catch (RequestException $e) {
		    $this->getErrors($e);			
		}
		catch (Exception $e) {
			throw $e;			
		}
	}
	public function find($id){
		try {
			$client=$this->getClient();
			$response=$client->get('city',['query'=>['id'=>$id]]);
			if($response->getStatusCode()==200)
			{
				$results=json_decode($response->getBody());
				return collect($results->rajaongkir->results);
			}
			return collect();
		} catch (RequestException $e) {
		    $this->getErrors($e);			
		}
		catch (Exception $e) {
			throw $e;
		}
	}
}