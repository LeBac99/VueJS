<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller

{

  public function __construct()

   {

//        $this->middleware('auth', ['only' =>
//  ['authenticate']]);

   }

   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */


   public function register(Request $request){
     $user = User::create([
        'name'=> $request->name,
        'email'=> $request->email,
        'password'=> app('hash')->make($request->password),
        'role_id'=> 5,
        'api_token' => str::random(50),
        
     ]);
     return response()->json(['status'=>'success','user' => $user], 200);

   }

   public function postLogin(Request $request)

   {
      $user = User::where('email',$request->email)->first();      
      
        if($user && Hash::check($request->input('password'), $user->password)) {
            return response()->json(['status'=>'success', 'user'=> $user], 200);
        }
        return response(['error'=>['False user & password .']], 401);    
   }

}    
?>