<?php
namespace Pewe\RajaOngkir;
use GuzzleHttp\Exception\RequestException;
use Pewe\RajaOngkir\Traits\RajaOngkirTrait;
use \GuzzleHttp\Client as Client;
/**
* 
*/
class Province
{
	use RajaOngkirTrait;
	public function all(){
		try {
			$client=$this->getClient();
			$response=$client->get('province');
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
			$response=$client->get('province',['query'=>['id'=>$id]]);
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