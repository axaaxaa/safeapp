<?php

Route::resource('/excel', 'ExcelController');

Route::resource('/test', 'TestController@test');
Route::get('/code/captcha/{tmp}', 'CodeController@captcha');
//七牛上传图片
route::resource('/upload', 'QiniuController');

//七牛上传文件
Route::resource('/qiniu', 'Home\QiniuController');
Route::get('/gettoken1', array('as' => 'get_token1', 'uses' => 'Home\QiniuController@upTokenUrl1'));

//支付宝
Route::resource('/alipay', 'AlipayController');

//OSS存储
Route::resource('/alioss', 'AliossController');

//邮件服务
Route::get('/mail/send', 'MailController@send');

Route::group(['domain' => "www.gvlove.com", "namespace" => "User"],function(){
    route::resource('/login', 'LoginController');
    route::resource('/register', 'RegisterController');
    Route::get('/sendcode', 'UserController@sendcode');
    route::group(['middleware' => 'UserMiddleware'],function(){
        route::resource('/', 'IndexController');
        route::resource('/user', 'UserController');
        Route::get('/logout', 'UserController@logout');
    });
});

Route::group(['domain' => "admin.gvlove.com", "namespace" => "Admin"],function(){
    route::resource('/login', 'LoginController');
    route::group(['middleware' => 'AdminMiddleware'],function(){
        route::resource('/', 'IndexController');
        route::resource('/user', 'UsersController');
    });
});



