<?php

// Set CMS database credentials
if (!function_exists('sanitize_string')) {
    function sanitize_string($string) {
		$safe_string = trim($string); 
		return $safe_string;
    }
}

// Get form link
if (!function_exists('create_logs')) {
    function create_logs($params) {

		$data = [
			"type" => $params['type'],
			"account_id" => $params['account_id'],
			"message" => $params['message'],
			"meta" => $params['meta'],
			"created_at" => date('Y-m-d H:i:s'),
		];

		app('db')->table("logs") -> insert($data);
    }
}