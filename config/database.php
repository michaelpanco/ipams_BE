<?php

return [

    'default' => env('DB_CONNECTION', 'mysql'),

	'connections' => [
	    'mysql' => [
	        'driver'    => 'mysql',
	        'host'      => env('DB_HOST'),
	        'port'      => env('DB_PORT'),
	        'database'  => env('DB_NAME'),
	        'username'  => env('DB_USERNAME'),
	        'password'  => env('DB_PASSWORD'),
	        'charset'   => 'utf8',
	        'collation' => 'utf8_unicode_ci',
	        'prefix'    => '',
	        'strict'    => false,
	     ]
	]
];