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

use App\City;
use App\Country;
use App\Product;
use App\State;
use App\Tag;

Route::get('states', function(){
    return State::with(['country','cities'])->paginate(1);
});
//Route::get('units-test','DataImportController@importUnits');
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/test', function(){
    $product=Product::find(1501);
    return $product->tags;
});
