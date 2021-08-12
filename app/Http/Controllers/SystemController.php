<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class SystemController extends Controller
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

    public function ip_addresses(Request $request) {

    	try {

	    	// Get account_id parameter that generated from middleware
	    	$account_id = $request -> get('account_id');

	    	$page = $request -> input('page', 0);
	    	$limit = $request -> input('limit', 10);

	    	$offset = ($page - 1) * $limit;

	    	$ip_address = app('db')->table("ip_addresses")
					-> where('account_id', $account_id)
					-> offset($offset)
					-> take($limit)
					-> orderBy('id', 'desc')
					-> get();

	    	$ip_address_count = app('db')->table("ip_addresses")
					-> where('account_id', $account_id)
					-> count();

			$response = [
				'records' => $ip_address,
				'total' => $ip_address_count,
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

    public function create_ip_addresses(Request $request) {

    	try {


		    $this->validate($request, [
		        'ip' => 'required',
		        'label' => 'required'
		    ]);


		    $ip = $request -> input('ip');
		    $label = $request -> input('label');

			if(!filter_var($ip, FILTER_VALIDATE_IP)){

				$response = [
					'success' => false,
					"error" => "You entered an invalid IP Address"
				];

				return response()->json(
					$response,
					200, [], JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT
				);
			}

	    	// Get account_id parameter that generated from middleware
	    	$account_id = $request -> get('account_id');

			$data = [
				"ip_address" => $ip,
				"label" => $label,
				"account_id" => $account_id,
				"created_at" => date('Y-m-d H:i:s'),
				"updated_at" => date('Y-m-d H:i:s'),
			];

			$insert_ip_address = app('db')->table("ip_addresses") -> insertGetId($data);

			if(!$insert_ip_address){
				throw new \Exception("Failed to create IP Address");
			}

			// Get the insert IP Address details
			$ip_address = app('db')->table("ip_addresses") -> where("id", $insert_ip_address) -> first();

			create_logs([
				"type" => "CRTIPA",
				"message" => "Created an IP Address",
				"meta" => serialize([
					"ip_address" => $ip,
					"label" => $label,
				]),
				"account_id" => $account_id,
			]);


			$response = [
				'success' => true,
				"details" => $ip_address
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


    public function update_ip_addresses(Request $request) {

    	try {

		    $this->validate($request, [
		    	'id' => 'required',
		        'ip' => 'required',
		        'label' => 'required'
		    ]);

		    $id = $request -> input('id');
		    $ip = $request -> input('ip');
		    $label = $request -> input('label');

			if(!filter_var($ip, FILTER_VALIDATE_IP)){

				$response = [
					'success' => false,
					"error" => "You entered an invalid IP Address"
				];

				return response()->json(
					$response,
					200, [], JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT
				);
			}

	    	// Get account_id parameter that generated from middleware
	    	$account_id = $request -> get('account_id');

			$data = [
				'ip_address' => $ip,
				'label' => $label,
				"updated_at" => date('Y-m-d H:i:s')
			];

			$existing_address_details = app('db')->table("ip_addresses") -> where("id", $id) -> first();

			$update_ip_address = app('db')->table("ip_addresses") 
				-> where('id', $id)
				-> where('account_id', $account_id)
				-> update($data);

			if(!$update_ip_address){
				throw new \Exception("Failed to update IP Address");
			}

			// Get the insert IP Address details
			$ip_address = app('db')->table("ip_addresses") -> where("id", $id) -> first();

			create_logs([
				"type" => "UPTIPA",
				"message" => "Updated an IP Address",
				"meta" => serialize([
					"old" => [
						'ip_address' => $existing_address_details -> ip_address,
						'label' => $existing_address_details -> label
					],
					"new" => [
						'ip_address' => $ip,
						'label' => $label
					]
				]),
				"account_id" => $account_id,
			]);

			$response = [
				'success' => true,
				"details" => $ip_address
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

    public function ip_addresses_details($id, Request $request) {

    	try {

	    	// Get account_id parameter that generated from middleware
	    	$account_id = $request -> get('account_id');

	    	$ip_address = app('db')->table("ip_addresses")
					-> where('id', $id)
					-> where('account_id', $account_id)
					-> first();

			// If specified ID not found under account
			if(!$ip_address){

				return response()->json(
					[
						"found" => false
					],
					404, [], JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT
				);
			}

			$response = [
				'details' => $ip_address,
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
}
