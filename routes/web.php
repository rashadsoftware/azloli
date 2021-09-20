<?php

use Illuminate\Support\Facades\Route;

/* Front section
====================================================> */
Route::get('/', 'HomeController@index')->name('index');
Route::get('/about', 'HomeController@about')->name('about');
Route::get('/service', 'HomeController@service')->name('service');
Route::get('/contact', 'HomeController@contact')->name('contact');


/* Admin section 
====================================================> */
Route::prefix('/admin')->name('admin.')->group(function(){
    // login
    Route::get('/login', 'AdminController@index')->name('index')->middleware('alreadyLoggedAdmin');
    Route::post('/login', 'AdminController@indexPost')->name('index.post');

    // logout
    Route::get('/logout', 'AdminController@logout')->name('logout')->middleware('isLoggedAdmin');

    // dashboard
    Route::get('/dashboard', 'AdminController@dashboard')->name('dashboard')->middleware('isLoggedAdmin');

    // settings
    Route::prefix('/settings')->name('settings')->middleware('isLoggedAdmin')->group(function(){
        Route::get('/', 'AdminController@settings');
        Route::put('/optional', 'AdminController@ajaxOptional')->name('.ajax.optional');
        Route::put('/logo', 'AdminController@ajaxLogo')->name('.ajax.logo');
        Route::put('/favicon', 'AdminController@ajaxFavicon')->name('.ajax.favicon');
        Route::put('/social', 'AdminController@ajaxSocial')->name('.ajax.social');
    }); 

    // profile
    Route::prefix('/profile')->name('profile')->middleware('isLoggedAdmin')->group(function(){
        Route::get('/', 'AdminController@profile');
        Route::put('/update/optional/{id}', 'AdminController@updateOptional')->name('.update.optional');
        Route::put('/update/image/{id}', 'AdminController@updateImage')->name('.update.image');
        Route::put('/update/password/{id}', 'AdminController@updatePassword')->name('.update.password');
    });
});