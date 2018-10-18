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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/programma/{id}', 'ProgrammaController@show');

Route::get('/admin', 'AdminController@index')->name('admin');

Route::get('/programma', 'ProgrammaController@index')->name('programma');
Route::post('/store/programma', 'ProgrammaController@store');

Route::get('/liedjes', 'LiedjesController@index')->name('liedje');
Route::post('/store/liedje', 'LiedjesController@store');
