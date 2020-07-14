<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Laravel\Lumen\Routing\Controller as BaseController;

class UserController extends BaseController
{
    public function __construct()
    {
        // header('Access-Control-Allow-Origin: *');
        // header('Access-Control-Allow-Methods: *');
    }

    public function showIndex(){
        return response()->json(User::all());
    }
    public function AddUser(){
        dd("44444444444444");

    }
}
