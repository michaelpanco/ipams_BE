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

$router->get('/', function () use ($router) {

	try {

		return response()->json([
			'name' => 'IP Address Management Solutions API',
		]);

	} catch (Exception $e) {
		return response()->json([
			'name' => 'Iconpractice API',
		]);
	}
});

// API version 1.0
$router->group(['prefix' => 'v1'], function () use ($router) {
	require __DIR__ . '/v1.php';
});

// API version onwards