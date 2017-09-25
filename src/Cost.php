<?php
namespace Pewe\RajaOngkir;
use \GuzzleHttp\Client as Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Promise;
/**
* 
*/
class Cost
{
	public function calculate($destination,$courier,$weight=1000,$origin=null,$service=null){
		try {
			$origin=is_null($origin)?config('rajaongkir.origin'):$origin;
			$headers=['key'=> config('rajaongkir.api_key')];
			$client=new Client([
				'base_uri'=>'https://api.rajaongkir.com/starter/',
				'headers'=>$headers
			]);
			$response=$client->post('cost',[
				'form_params'=>[
					'origin'=>$origin,
					'destination'=>$destination,
					'weight'=>$weight,
					'courier'=>$courier,
				]
			]);
			if($response->getStatusCode()==200)
			{
				$results=json_decode($response->getBody())->rajaongkir->results;
				$availableService=['REG','YES','OKE','EKO','CTC','CTCYES','ECO','ONS','SDS','Paket Kilat Khusus','Express Next Day Barang','Express Sameday Barang'];
				$resultArray=[];
				$resultArray['code']=$results[0]->code;
				$resultArray['name']=$results[0]->name;
				$resultArray['costs']=array();
				if(is_null($service))
				{
					$resultArray['costs']=array();
					foreach ($results[0]->costs as $cost) {
						if(in_array($cost->service, $availableService))
							array_push($resultArray['costs'], [
	                        	'service'=>$cost->service,
	                        	'description'=>$cost->description,
	                        	'cost'=>$cost->cost[0],
	                        ]);
					}					
				}
				else{
					foreach ($results[0]->costs as $cost) {
						if (strtolower($cost->service)==strtolower($service)) {
	                        array_push($resultArray['costs'], [
	                        	'service'=>$cost->service,
	                        	'description'=>$cost->description,
	                        	'cost'=>$cost->cost[0],
	                        ]);
	                      break;   
	                    }
	                    else
	                    {
	                       if (strtolower($service)=="reg") {
	                          if (strtolower($cost->service)=="ctc") {
		                        array_push($resultArray['costs'], [
		                        	'service'=>$cost->service,
		                        	'description'=>$cost->description,
		                        	'cost'=>$cost->cost[0],
		                        ]);
	                            break;   
	                          }
	                       }
	                       else if (strtolower($service)=="yes") {
	                          if (strtolower($cost->service)=="ctcyes") {
		                        array_push($resultArray['costs'], [
		                        	'service'=>$cost->service,
		                        	'description'=>$cost->description,
		                        	'cost'=>$cost->cost[0],
		                        ]);
	                            break;   
	                          }
	                       }

	                    }
					}

				}
				return collect($resultArray);
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
	public function couriers($destination,$couriers,$weight=1000,$origin=null)
	{
		try {
			$cList=explode(',', $couriers);
			$origin=is_null($origin)?config('rajaongkir.origin'):$origin;
			$headers=['key'=> config('rajaongkir.api_key')];
			$client=new Client([
				'base_uri'=>'https://api.rajaongkir.com/starter/',
				'headers'=>$headers
			]);
			$promises=[];
			$resultArray=array();
			foreach ($cList as $courier) {
				$params=[
					'form_params'=>[
						'origin'=>$origin,
						'destination'=>$destination,
						'weight'=>$weight,
						'courier'=>$courier,
					]
				];
				$promises[$courier]=$client->postAsync('cost',$params);
			}
			$results = Promise\settle($promises)->wait();
			foreach ($results as $r) {
				if($r['value']->getStatusCode()==200)
				{
					$obj=json_decode($r['value']->getBody())->rajaongkir;
					if(count($obj->results[0]->costs)>0)
						array_push($resultArray, [
							'code'=>$obj->results[0]->code,
							'name'=>$obj->results[0]->name
						]);					
				}
			}
			return collect($resultArray);
		} catch (RequestException $e) {
		    if ($e->hasResponse()) {
		        echo Psr7\str($e->getResponse());
		    }
			
		}
		catch (Exception $e) {
			
		}
	}
}