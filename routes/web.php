<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();

//frontent route
Route::get('/','HomeController@index')->name('home');
Route::post('subscribe','Subscribers@subscribe')->name('subscriber.email');


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

});

//Author route group
Route::group(['as'=>'author.','prefix'=>'author','namespace'=>'Author','middleware'=>['auth','author']],function(){

    Route::get('dashboard','DashboardController@index')->name('dashboard');
    Route::resource('post','PostController');

});

