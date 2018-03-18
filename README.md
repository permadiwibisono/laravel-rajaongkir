# laravel-rajaongkir
A wrapper for Raja Ongkir API built for laravel and lumen (only available for *Starter* Account)
*Basic* and *Pro* Accounts available soon

## Installations
```
composer require pewe/laravel-rajaongkir
```

## Configuration
Edit your ```.env``` file. Place your key, you can get your key in [Raja Ongkir](http://www.dropwizard.io/1.0.2/docs/) page
```
RAJAONGKIR_API_KEY=12345667
```

### For Lumen
Edit your ```boostrap/app.php```


Enable Facades
```php
$app->withFacades();
```
Enable class_alias (Optional)
```php
class_alias('Pewe\RajaOngkir\Facades\Province', 'Province');
class_alias('Pewe\RajaOngkir\Facades\City', 'City');
class_alias('Pewe\RajaOngkir\Facades\Cost', 'Cost');
```
Register RajaOngkirServiceProvider (Optional)
```php
$app->register(Pewe\RajaOngkir\Providers\RajaOngkirServiceProvider::class);
```
Copy config file rajaongkir.php (```vendor/pewe/laravel-rajaongkir/src/config/rajaongkir.php```) to your folder config. Or if You're already install package [laravelista/lumen-vendor-publish](https://github.com/laravelista/lumen-vendor-publish).
 You must register RajaOngkirServiceProvider before, then use this command:
```
php artisan vendor:publish --tag=laravel-rajaongkir-config
```
Configure your config
```php
$app->configure('rajaongkir');
```


## Usage

### Import
```php
<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
/*...*/


use City; //if using class_alias
//use Pewe\RajaOngkir\Facades\City; //if not using class_alias

class ExampleController extends Controller
{
  /*...*/
  public function getCities(){
    dd(City::all());
  }
}
```

### City
#### Get All City
```php
City::all();
```
#### Get City by Id
```php
City::find($id);
```

| Parameters        | Type           | Description  			| Default  					| Example	|
| ----------------- |:--------------:| ------------------------	| ------------------------- | ---------:|
| $id 				| Integer		 | City ID					| *Required*				| 147		|


### Province
#### Get All Province
```php
Province::all();
```
#### Get Province by Id
```php
Province::find($id);
```

| Parameters        | Type           | Description  			| Default  					| Example	|
| ----------------- |:--------------:| ------------------------	| ------------------------- | ---------:|
| $id 				| Integer		 | Province ID				| *Required*				| 1			|


### Available Couriers & Cost
#### Get Available Couriers
```php
Cost::couriers($destination,$weight,$origin);
```

| Parameters        | Type           | Description  			| Default  					| Example	|
| ----------------- |:--------------:| ------------------------	| ------------------------- | ---------:|
| $destination 		| Integer		 | City ID of Destination	| *Required*				| 147		|
| $weight 			| Integer		 | Weight of package		| 1000						| 1000		|
| $origin 			| Integer		 | City ID of Origin		| config(rajaongkir.origin) | 146		|

#### Get Cost
```php
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

## Problem 
* Call undefined function ```Pewe\RajaOngkir\Providers\config_path()```
  #### To resolve this:
  Create a file called ```helpers.php``` in the ```app/``` directory. Paste the code inside it.
  ```php
  <?php
   if ( ! function_exists('config_path'))
   {
     /**
      * Get the configuration path.
      *
      * @param  string $path
      * @return string
      */
      function config_path($path = '')
      {
         return app()->basePath() . '/config' . ($path ? '/' . $path : $path);
      }
    }
  ```
  Go to ```composer.json``` and add files to autoload so that it looks like this:

  ```json
   ...
   "autoload": {
        "psr-4": {
        "App\\": "app/"
      },
      "files": [
         "app/helpers.php"
      ]
    },
   ...
  ```
  Run ```composer dump-autoload``` to load the newly created helpers file. 
  Or just following this [gist](https://gist.github.com/mabasic/21d13eab12462e596120).


## Contribute

Show your :heart: and support by giving a :star2: or fork. Any suggestions, issues and pull request are welcome :beers:!