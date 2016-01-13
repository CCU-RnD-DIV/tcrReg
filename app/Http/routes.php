<?php

/** @var Router $router */

use Illuminate\Routing\Router;

$router->get('/', 'IndexController@Index');

/* Obtain Json Data */

$router->post('get-school', ['uses' => 'DataController@getSchool']);

/* Dangerous Toolbox */

/*$router->get('set-bcrypt', 'ToolController@setBcrypt');*/
/*$router->get('set-priority', 'ToolController@setPriority');*/
/*$router->get('set-select', 'ToolController@setSelect');*/
$router->get('send-sms-reg', 'ToolController@RegSMSSend');

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

    $router->get('resend-verify', 'LoginController@resendVerifyView');
    $router->post('resend-verify', 'LoginController@resendVerify');
    Route::get('/export-pdf', 'ExportController@ExportMemberPDF');

    /* Under Auth Protection */


    $router->group(['prefix' => 'console', 'middleware' => 'authConsole'], function() {

        Route::get('/', 'AdminController@Console');

        Route::get('/system-config', 'AdminController@SystemConfigView');
        Route::post('/system-config', 'AdminController@SystemConfigUpdate');

        Route::get('/member-query/{id}', ['uses' => 'AdminController@MemberQuery', 'as' => 'id']);
        Route::get('/old-member-query', 'AdminController@OldMemberQuery');
        Route::get('/priority-member-query', 'AdminController@PriorityMemberQuery');

        Route::get('/member-exchange', 'AdminController@MemberExchange');
        Route::post('/member-exchange', 'AdminController@MemberExchange');

        Route::post('/sms-resend', 'AdminController@SMSSend');
        Route::post('/pwd-resend', 'AdminController@PWDSend');

        Route::get('/export-member/{id}', ['uses' => 'ExportController@ExportMemberExcel', 'as' => 'id']);

    });

    $router->group(['prefix' => 'general', 'middleware' => 'authGeneral'], function() {
        Route::get('/', 'AdminController@General');

        Route::get('/update', 'AdminController@UpdateView');
        Route::post('/update', 'AdminController@Update');

        Route::get('/select-habits', 'RegisterController@selectHabits');
        Route::post('/select-habits', 'RegisterController@selectHabitsUpdate');

        Route::get('/select-traffic', 'RegisterController@selectTraffic');
        Route::post('/select-traffic', 'RegisterController@selectTrafficUpdate');

        Route::get('/select-subject', 'RegisterController@selectSubject');
        Route::get('/export-pdf', 'ExportController@ExportMemberPDF');
        Route::post('/select-subject', 'RegisterController@selectSubjectUpdate');
    });





    $router->get('logout', 'LoginController@logout');
});
