<?php

/** @var Router $router */

use Illuminate\Routing\Router;

$router->get('/', 'IndexController@Index');

/* Obtain Json Data */

$router->post('get-school', ['uses' => 'DataController@getSchool']);
$router->get('get-junior-school', 'DataController@getJuniorSchool');

$router->group(['middleware' => ['web']], function (Router $router) {
    /* REG_PAGE -- Start of Registering Pages */

    $router->get('register', 'RegisterController@register');
    $router->post('register', 'RegisterController@store');

    $router->get('privacy', 'RegisterController@privacy');

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

    $router->group(['prefix' => 'general', 'middleware' => 'auth'], function(Router $router) {
        $router->get('/', 'AdminController@General');

        $router->get('/update', 'AdminController@UpdateView');
        $router->post('/update', 'AdminController@Update');

        $router->get('/select-habits', 'RegisterController@selectHabits');
        $router->post('/select-habits', 'RegisterController@selectHabitsUpdate');

        $router->get('/select-subject', 'RegisterController@selectSubject');
        $router->post('/select-subject', 'RegisterController@selectSubjectUpdate');
    });

    $router->group(['prefix' => 'console', 'middleware' => 'authConsole'], function(Router $router) {
        $router->get('/', 'AdminController@Console');
    });

    $router->get('logout', 'LoginController@logout');
});
