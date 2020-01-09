<?php 


namespace App\API;


class ApiError{

	public static function errorMessage($message){

		return ['msg'=>$message,
				'code'=>$code
		];
	}
}