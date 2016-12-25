<?php

Route::group(['domain' => "www.safeapp.com", "namespace" => "User"],function(){
    route::resource('/login', 'LoginController');
    route::resource('/register', 'RegisterController');
    route::group(['middleware' => 'UserMiddleware'],function(){
        route::resource('/', 'IndexController');
        route::resource('/user', 'UserController');
        Route::get('/sendcode', 'UserController@sendcode');
    });
});

Route::group(['domain' => "admin.safeapp.com", "namespace" => "Admin"],function(){
    route::resource('/login', 'LoginController');
    route::group(['middleware' => 'AdminMiddleware'],function(){
        route::resource('/', 'IndexController');
        route::resource('/user', 'UsersController');
    });
});
