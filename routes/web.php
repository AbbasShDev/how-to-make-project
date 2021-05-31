<?php

use Illuminate\Support\Facades\Route;

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

Route::view('/','welcome')->name('welcome');

Route::view('/home', 'home');

//Route::get('tutorial/create', function (){
//    return request('title');
//});
//
//Route::get('page/create', function (){
//    return request('title');
//});

