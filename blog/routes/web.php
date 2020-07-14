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

// header("Access-Control-Allow-Origin: *");
// header('Access-Control-Allow-Methods: *');
// header('Access-Control-Allow-Headers: *');

$router->get('/', function () use ($router) {
    return $router->app->version();
});
$router->group(['prefix'=>'api'],function($router){
    $router->get('user','UserController@showIndex');
    $router->post('user/create','UserController@AddUser');

});
