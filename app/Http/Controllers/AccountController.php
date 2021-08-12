<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;

class AccountController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function activities(Request $request) {

    	try {

	    	// Get account_id parameter that generated from middleware
	    	$account_id = $request -> get('account_id');

	    	$page = $request -> input('page', 0);
	    	$limit = $request -> input('limit', 10);

	    	$offset = ($page - 1) * $limit;

	    	$logs = app('db')->table("logs")
					-> where('account_id', $account_id)
					-> offset($offset)
					-> take($limit)
					-> orderBy('id', 'desc')
					-> get();

	    	$logs_count = app('db')->table("logs")
					-> where('account_id', $account_id)
					-> count();

			$response = [
				'records' => $logs,
				'total' => $logs_count,
			];

			return response()->json(
				$response,
				200, [], JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT
			);

    	} catch (\Exception $e) {

			return response()->json(
				$e -> getMessage(),
				500, [], JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT
			);
    	}
    }

    public function login(Request $request) {

		try {

		    $this->validate($request, [
		        'username' => 'required',
		        'password' => 'required'
		    ]);

		    $username = $request -> input('username');
		    $password = $request -> input('password');

		    // Check the username if exists
	    	$account = app('db')->table("accounts")
				-> where('username', $username)
				-> first();

			if(!$account){
				throw new \Exception("Your email and/or password is incorrect");
			}

			// Check if the provided password is correct
			$valid_password = password_verify($password, $account -> password);

			if(!$valid_password){
				throw new \Exception("Your email and/or password is incorrect");
			}

			// Inser account details to JWT payload
			$payload = array(
				"id" => $account -> id,
			    "name" => $account -> name,
			    "iat" => time(),
			    "exp" => time() + 86400, // Set 1 day expiration
			);

			//generate JWT Key
			$jwt = JWT::encode($payload, config('app.jwt_secret'));
			//$decoded = JWT::decode($jwt, config('app.jwt_secret'), array('HS256'));

			$response = [
				"type" => "LOGIN",
				"token" => $jwt,
				"account" => [
					"id" => $account -> id,
					"name" => $account -> name
				]
			];

			create_logs([
				"type" => "LOGSUC",
				"message" => "Login Success",
				"meta" => serialize([]),
				"account_id" => $account -> id,
			]);

			return response()->json(
				$response,
				200, [], JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT
			);
			
		} catch (\Exception $e) {
			
			$response = [
				"error" => $e -> getMessage()
			];

			return response()->json(
				$response,
				403, [], JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT
			);

		}
    }
}
