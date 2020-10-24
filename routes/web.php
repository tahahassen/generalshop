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
use App\Role;
use App\State;
use App\Tag;
use App\User;

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
    return 'hello';
})->middleware(['userisadmine']);
Route::group(['auth','userisadmin'], function () {
    
    Route::get('units','UnitController@index')->name('units');
    Route::post('units','UnitController@store');
    Route::delete('units','UnitController@destroy');
    Route::put('units','UnitController@update');
    Route::post('search-units','UnitController@search')->name('search-units');
    //Categories
    Route::get('categories','CategoryController@index')->name('categories');
    //Products
    Route::get('products','ProductController@index')->name('products');

    //Tags
    Route::get('tags','TagController@index')->name('tags');
    Route::post('tags','TagController@store');
    Route::post('search-tags','TagController@search')->name('search-tags');
    Route::delete('tags','TagController@destroy');
    //payments
    //orders
    //shipments

    //countries
    Route::get('countries','CountryController@index')->name('countries');
    //cities
    Route::get('cities','CityController@index')->name('cities');
    //states
    Route::get('states','StateController@index')->name('states');
    //reviews
    Route::get('reviews','ReviewController@index')->name('reviews');
    //tickets
    Route::get('tickets','TicketController@index')->name('tickets');
    //roles
    Route::get('roles','RoleController@index')->name('roles');
});
