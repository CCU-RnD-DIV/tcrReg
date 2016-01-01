<?php

/** @var Router $router */

use Illuminate\Routing\Router;

$router->get('/', 'IndexController@Index');



/* Obtain Json Data */

$router->post('get-school', ['uses' => 'DataController@getSchool']);
$router->get('get-junior-school', 'DataController@getJuniorSchool');


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

    $router->get('reset-password', 'LoginController@reset');
    $router->post('reset-password', 'LoginController@resetGenerate');

    $router->get('reset-verify', 'LoginController@resetVerifyView');
    $router->post('reset-verify', 'LoginController@resetVerify');

    /* Under Auth Protection */

    $router->group(['prefix' => 'general', 'middleware' => 'auth'], function() {
        Route::get('/', 'AdminController@General');

        Route::get('/update', 'AdminController@UpdateView');
        Route::post('/update', 'AdminController@Update');

        Route::get('/select-habits', 'RegisterController@selectHabits');
        Route::post('/select-habits', 'RegisterController@selectHabitsUpdate');

        Route::get('/select-subject', 'RegisterController@selectSubject');
        Route::post('/select-subject', 'RegisterController@selectSubjectUpdate');
    });

    $router->get('logout', 'LoginController@logout');




});


