<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('test', 'TestController@index')->name('test');

Route::get('testdb', 'TestController@testDb')->name('testdb');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/listen', function () {
    return view('listen');
});
