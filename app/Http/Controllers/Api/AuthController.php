<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\User;

class AuthController extends Controller
{
    public function login(){ 
    	if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ $user = Auth::user(); $success['token'] = $user->createToken('myApp')->accessToken; return response()->json(['success' => $success], 200); 
    		} else{ 
    			return response()->json(['error'=>'Unauthorised'], 401);
    	 } 
    	} 

    public function register(Request $request) { 

    	$validator = Validator::make($request->all(), [ 'name' => 'required', 'email' => 'required|email', 'password' => 'required', 'confirm_password' => 'required|same:password', ]); 
    		if ($validator->fails()) { 
    			return response()->json(['error'=>$validator->errors()], 401); 
            } $input = $request->all(); $input['password'] = bcrypt($input['password']);
    		 $user = User::create($input); $success['token'] = $user->createToken('myApp')->accessToken; 
             $success['name'] = $user->name;
    		  return response()->json(['success'=>$success], 200);
    		   }

}
