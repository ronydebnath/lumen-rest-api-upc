<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
	/**
	 * Return a JSON response for success
	 * @param  array $data 
	 * @param  string $code 
	 * @return \illuminate\http\jsonresponse      
	 */
    public function success($data, $code){
		return response()->json(['data' => $data], $code);
	}

	/**
	 * return a JSON response for error
	 * @param  array $message 
	 * @param  string $code    
	 * @return \illuminate\http\jsonresponse         
	 */
    public function error($message, $code){
		return response()->json(['message' => $message], $code);
	}
}
