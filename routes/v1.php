<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

//$router->get('practices', 'CustomerController@practices');


// Begin Account API
$router->group(['prefix' => 'account'], function () use ($router) {
	$router->post('login', 'AccountController@login');
});

$router->group(['middleware' => 'auth'], function () use ($router) {


	$router->group(['prefix' => 'account'], function () use ($router) {
		$router->get('activities', 'AccountController@activities');
	});

	$router->get('ipaddress', 'SystemController@ip_addresses');
	$router->get('ipaddress/{id}', 'SystemController@ip_addresses_details');
	$router->post('ipaddress', 'SystemController@create_ip_addresses');
	$router->patch('ipaddress', 'SystemController@update_ip_addresses');

});







