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
*/

Route::get('/', function () {
    if(Auth::check()){
        return redirect('/home');
    }else{
        return view('auth.login');
    }
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/banks','HomeController@banks');
Route::get('validate','HomeController@validateForm');
Route::post('validate','HomeController@validateForm');
Route::post('enviardatos','HomeController@validateDate');
Route::get('validarEnd','HomeController@validateEnd');