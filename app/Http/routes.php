<?php

/** @var Router $router */

use Illuminate\Routing\Router;

$router->get('/', function () {return view('index');});

/* LOGIN_PAGE -- Start of Login Purpose Method */

$router->get('generalLogin', 'LoginController@generalLogin');
$router->get('consoleLogin', 'LoginController@consoleLogin');


/* GENERAL_MEMBER -- Start of General Member System Method */



/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

$router->group(['middleware' => ['web']], function (Router $router) {

    /* REG_PAGE -- Start of Registering Pages */

    $router->get('register-primary', 'RegisterController@regPrimary');
    $router->get('register-junior', 'RegisterController@regJunior');

    $router->post('register-primary', 'RegisterController@storePrimary');
    $router->post('register-junior', 'RegisterController@storeJunior');

});
