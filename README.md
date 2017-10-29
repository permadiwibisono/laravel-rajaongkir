# laravel-rajaongkir
A wrapper for Raja Ongkir API built for laravel and lumen (only available for *Starter* Account)
*Basic* and *Pro* Accounts available soon

## Installations
```
composer install pewe/laravel-ongkir --save
```

## Configuration
Edit your ```.env``` file. Place your key, you can get your key in [Raja Ongkir](http://www.dropwizard.io/1.0.2/docs/) page
```
RAJAONGKIR_API_KEY=12345667
```

### For Lumen
* Edit your ```boostrap/app.php```
Configure your config
```
$app->configure('rajaongkir');
```
Enable Facades
```
$app->withFacades();
```
Enable class_alias (Optional)
```
class_alias('Pewe\RajaOngkir\Facades\Province', 'Province');
class_alias('Pewe\RajaOngkir\Facades\City', 'City');
class_alias('Pewe\RajaOngkir\Facades\Cost', 'Cost');
```
Register RajaOngkirServiceProvider
```
$app->register(Pewe\RajaOngkir\Providers\RajaOngkirServiceProvider::class);
```
* Copy config file rajaongkir.php to your folder config. Or if You're already install package [laravelista/lumen-vendor-publish](https://github.com/laravelista/lumen-vendor-publish).
 You can use this command:
```
php artisan vendor:publish --tag=laravel-rajaongkir-config
```


## Usage

### City
#### Get All City
```
City::all();
```
#### Get City by Id
```
City::find($id);
```

| Parameters        | Type           | Description  			| Default  					| Example	|
| ----------------- |:--------------:| ------------------------	| ------------------------- | ---------:|
| $id 				| Integer		 | City ID					| *Required*				| 147		|


### Province
#### Get All Province
```
Province::all();
```
#### Get Province by Id
```
Province::find($id);
```

| Parameters        | Type           | Description  			| Default  					| Example	|
| ----------------- |:--------------:| ------------------------	| ------------------------- | ---------:|
| $id 				| Integer		 | Province ID				| *Required*				| 1			|


### Available Couriers & Cost
#### Get Available Couriers
```
Cost::couriers($destination,$weight,$origin);
```

| Parameters        | Type           | Description  			| Default  					| Example	|
| ----------------- |:--------------:| ------------------------	| ------------------------- | ---------:|
| $destination 		| Integer		 | City ID of Destination	| *Required*				| 147		|
| $weight 			| Integer		 | Weight of package		| 1000						| 1000		|
| $origin 			| Integer		 | City ID of Origin		| config(rajaongkir.origin) | 146		|

#### Get Cost
```
Cost::calculate($destination,$courier,$weight,$origin,$service);
```

| Parameters        | Type           | Description  			| Default  					| Example	|
| ----------------- |:--------------:| ------------------------	| ------------------------- | ---------:|
| $destination 		| Integer		 | City ID of Destination	| *Required*				| 147		|
| $courier  		| String		 | Courier code 			| *Required*				| jne		|
| $weight 			| Integer		 | Weight of package		| 1000						| 1000		|
| $origin 			| Integer		 | City ID of Origin		| config(rajaongkir.origin) | 146		|
| $service 			| String		 | Service name 			| Nullable					| reg		|

If your key submit is invalid ```InvalidTokenException``` will thrown. 
And if Bad Request from their server, ```RajaOngkirRequestException``` will thrown.