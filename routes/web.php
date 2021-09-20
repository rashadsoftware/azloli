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
    Route::get('/settings', 'AdminController@settings')->name('settings')->middleware('isLoggedAdmin');
    Route::put('/settings/optional', 'AdminController@ajaxOptional')->name('settings.ajax.optional');
    Route::put('/settings/logo', 'AdminController@ajaxLogo')->name('settings.ajax.logo');
    Route::put('/settings/favicon', 'AdminController@ajaxFavicon')->name('settings.ajax.favicon');
    Route::put('/settings/social', 'AdminController@ajaxSocial')->name('settings.ajax.social');
});