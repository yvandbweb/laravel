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

Route::get('/', 'Index@first')->name('default');

Route::get('/addpost', 'Index@addpost')->name('addpost');

Route::get('/addcomment', 'Index@addcomment')->name('addcomment');

Route::get('/adduser', 'Index@adduser')->name('adduser');

Route::get('/deletecomment', 'Index@deletecomment')->name('deletecomment');

Route::get('/deletepost', 'Index@deletepost')->name('deletepost');


Route::post('/addformpost', 'Index@addformpost')->name('addformpost');

Route::post('/addformcoment', 'Index@addformcoment')->name('addformcoment');

Route::post('/addformuser', 'Index@addformuser')->name('addformuser');
