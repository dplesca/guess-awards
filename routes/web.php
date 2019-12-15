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

use App\Category;
use App\Nominee;


Route::get('/nominees', function(){
    $nominees = Category::with('nominees')->get();
    return response()->json($nominees);
});

Auth::routes();

Route::get('/', 'HomeController@pickForm');
Route::post('/pick', 'HomeController@pick');
Route::get('/users', 'HomeController@listUsers');

Route::get('/want', 'HomeController@wantForm');
Route::post('/want', 'HomeController@want');
//Route::get('/pick', 'HomeController@pickForm')->name('home');
