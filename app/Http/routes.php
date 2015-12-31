<?php

/** @var Router $router */

use Illuminate\Routing\Router;

$router->get('/', function () {return view('index');});



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

    $router->get('register', 'RegisterController@reg');
    $router->post('register', 'RegisterController@store');

    $router->get('verify', 'RegisterController@verify');
    $router->post('verify', 'RegisterController@verifyCheck');



    /* LOGIN_PAGE -- Start of Login Purpose Method */

    $router->get('generalLogin', 'LoginController@generalLogin');
    $router->get('consoleLogin', 'LoginController@consoleLogin');

    $router->post('generalLogin', 'LoginController@CheckGeneralLogin');
    $router->post('consoleLogin', 'LoginController@CheckConsoleLogin');

    $router->group(['prefix' => 'general', 'middleware' => 'auth'], function() {
        Route::get('/', 'AdminController@General');

        Route::get('/update', 'AdminController@Update');
        Route::post('/update', 'AdminController@Update');

        Route::get('/select-subject', 'RegisterController@selectSubject');
        Route::post('/select-subject', 'RegisterController@selectSubjectUpdate');
    });

    $router->get('logout', 'LoginController@logout');


});


