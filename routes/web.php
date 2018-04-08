<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|


Route::get('/', function () {
    return view('home');
});
/*
Route::get('login ', function () {
    return view('login');
});

Route::get('index', function () {
    return view('index');
  });

  */
  Route::get('login', 'Auth\LoginController@getLogin');
  Route::post('login', ['as'=>'login', 'uses'=>'Auth\LoginController@postLogin']);
  Route::get('logout', ['as'=>'logout', 'uses'=>'Auth\LoginController@getLogout']);

  //Registro de rutas
 Route::get('register', 'Auth\RegisterController@getRegister');
 Route::post('register', ['as'=>'auth\register', 'uses'=>'Auth\RegisterController@postRegister']);

 Route::get('/', 'HomeController@index');
 Route::get('home', 'HomeController@index');
 Route::get('index', 'HomeController@index');