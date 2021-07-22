<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    return redirect('login');
});
    
    Auth::routes();
    
    Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
    
    Route::group(['middleware' => 'auth', 'namespace' => 'Admin'], function () {
        
        Route::get('password', ['as' => 'password.edit', 'uses' => 'PasswordController@edit']);
        Route::put('password', ['as' => 'password.update', 'uses' => 'PasswordController@update']);
        Route::get('nfe/{id}', 'NfeController@create')->name('nfe.create');
        Route::post('nfe/{id}', 'NfeController@create')->name('nfe.create');
        Route::any('nfe', 'NfeController@generate')->name('nfe.generate');
        Route::resource('products', 'ProductController');
        Route::resource('users', 'UserController');
    	Route::resource('auth', 'RegisterController');
    });
    
    Route::group(['middleware' => 'auth'], function () {
    	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
    	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
    	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
	});
            