<?php


Route::resource('/excel', 'ExcelController');

Route::resource('/test', 'TestController@test');
Route::resource('/code', 'CodeController');
//七牛上传
route::resource('/upload', 'QiniuController');

Route::group(['domain' => "www.safeapp.com", "namespace" => "User"],function(){
    route::resource('/login', 'LoginController');
    route::resource('/register', 'RegisterController');
    Route::get('/sendcode', 'UserController@sendcode');
    route::group(['middleware' => 'UserMiddleware'],function(){
        route::resource('/', 'IndexController');
        route::resource('/user', 'UserController');
        Route::get('/logout', 'UserController@logout');
    });
});

Route::group(['domain' => "admin.safeapp.com", "namespace" => "Admin"],function(){
    route::resource('/login', 'LoginController');
    route::group(['middleware' => 'AdminMiddleware'],function(){
        route::resource('/', 'IndexController');
        route::resource('/user', 'UsersController');
    });
});


//七牛上传
Route::resource('/qiniu', 'Home\QiniuController');
Route::get('/gettoken1', array('as' => 'get_token1', 'uses' => 'Home\QiniuController@upTokenUrl1'));

