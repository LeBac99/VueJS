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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix'=>'api'],function($router){

    $router->get('user','UserController@showIndex');
    $router->get('user/search/{key}','UserController@search');
    $router->post('user/add-user','UserController@saveAddNew');
 
    $router->get('user/{id}','UserController@showIndexUser');
    $router->put('user/{id}','UserController@saveEditUser');
    $router->delete('user/delete-user/{id}','UserController@deleteUser');

    $router->post('login','UserController@login');
    //product
    $router->get('products','ProductController@showProducts');
    //mail
    $router->get('mail','MailController@mail');
    //password
    $router->post('password','UserController@password');
    $router->get('save-password/{token}','UserController@getpassword');
    $router->put('save-password/{token}','UserController@savepassword');
    //login
    $router->post('register','LoginController@register');
    $router->post('cp-login','LoginController@postLogin');

  
});


