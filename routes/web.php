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

Auth::routes();

Route::get('/', 'NotesController@index');

Route::get('/notes', 'NotesController@index')->name('list');
Route::get('/notes/add', 'NotesController@add')->name('add');
Route::put('/notes/add', 'NotesController@addPut')->name('add.put');
Route::get('/notes/update/{id}', 'NotesController@update')->name('update')->where('id','[0-9]');
Route::post('/notes/update/{id}', 'NotesController@updatePost')->name('update.post')->where('id','[0-9]');
Route::delete('/notes/delete/{id}', 'NotesController@delete')->name('delete')->where('id','[0-9]');
Route::get('/notes/delete/{id}', 'NotesController@delete')->name('get.delete')->where('id','[0-9]');
Route::get('/notes/detail/{id}', 'NotesController@detail')->name('detail')->where('id','[0-9]');


