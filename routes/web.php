<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

// $router->get('/', function () use ($router) {
//     return $router->app->version();
// });

// ROUTE FOR AUTHENTICATION
$router->group(['prefix' => 'api/auth'], function () use ($router) {
    $router->post("register", "API\Auth\RegisterController@register");
    $router->post("login", "API\Auth\LoginController@login");
    $router->post("forgot-password", "Auth\ForgotPasswordController@forgotPassword");
    $router->post("reset-password", "Auth\ResetPasswordController@resetPassword");
});

$router->group(['prefix' => 'api', 'middleware' => ['jwt.verify']], function () use ($router) {

    // ROUTE FOR LOGOUT USER
   $router->post("logout", "API\Auth\LogoutController@logout");

   // ROUTE FOR USER
   $router->group(['prefix' => 'user'], function () use ($router) {
       $router->post('/', "UserController@createUser");
       $router->put('update/{id}', "UserController@updateUser");
       $router->delete('/{id}', "UserController@deleteUser");
   });
});