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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/programma/{id}', 'ProgrammaController@show');

Route::get('/admin', 'AdminController@index')->name('admin');

Route::get('/programma', 'ProgrammaController@index')->name('programma');
Route::post('/store/programma', 'ProgrammaController@store');
Route::get('/edit/programma/{id}', 'ProgrammaController@edit');
Route::put('/update/programma/{programma}', 'ProgrammaController@update');
Route::delete('/delete/programma/{programma}', 'ProgrammaController@destroy');

Route::get('/liedjes', 'LiedjesController@index')->name('liedje');
Route::post('/store/liedje', 'LiedjesController@store');
Route::get('/edit/liedje/{id}', 'LiedjesController@edit');
Route::put('/update/liedje/{liedje}', 'LiedjesController@update');
Route::delete('/delete/liedje/{liedje}', 'LiedjesController@destroy');
