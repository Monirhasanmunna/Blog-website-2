<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();

//frontent route
Route::get('/','HomeController@index')->name('home');
Route::post('subscribe','Subscribers@subscribe')->name('subscriber.email');
Route::get('post/{slug}/details','PostController@index')->name('post.details');
Route::get('posts','PostController@allPost')->name('post.all');


//Favorite group route
Route::group(['middleware'=>['auth']] , function(){
    Route::post('favorite/{post}/add','FavoriteController@add')->name('favorite.post');
});

//Admin group route
Route::group(['as'=>'admin.','prefix'=>'admin','namespace'=>'Admin','middleware'=>['auth','admin']],function(){

    Route::get('dashboard','DashboardController@index')->name('dashboard');
    Route::resource('tag','TagController');
    Route::resource('category','CategoryController');
    Route::resource('post','PostController');
    Route::get('pending/post','PostController@pending')->name('post.pending');
    Route::put('approve/{id}/post','PostController@approve')->name('post.approve');
    Route::get('subscribers','SubscribersController@index')->name('subscriber.index');
    Route::delete('subscribers/{id}/delete','SubscribersController@delete')->name('subscriber.delete');
    Route::get('settings','SettingsController@index')->name('settings.index');
    Route::put('settings/{id}/update','SettingsController@update')->name('settings.update');
    Route::put('settings/password/{id}/update','SettingsController@passwordUpdate')->name('password.update');
    Route::get('favorite','FavoriteController@index')->name('favorite.index');
    Route::get('favorite/{post}/details','FavoriteController@show')->name('favorite.show');
    Route::delete('favorite/{post}/delete','FavoriteController@destroy')->name('favorite.destroy');
    
});

//Author route group
Route::group(['as'=>'author.','prefix'=>'author','namespace'=>'Author','middleware'=>['auth','author']],function(){

    Route::get('dashboard','DashboardController@index')->name('dashboard');
    Route::resource('post','PostController');
    Route::get('settings','SettingsController@index')->name('settings.index');
    Route::put('settings/{id}/update','SettingsController@update')->name('settings.update');
    Route::put('settings/password/{id}/update','SettingsController@passwordUpdate')->name('password.update');

});

