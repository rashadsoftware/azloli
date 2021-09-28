<?php

use Illuminate\Support\Facades\Route;

/* Front section
====================================================> */
Route::get('/', 'HomeController@index')->name('index');
Route::get('/about', 'HomeController@about')->name('about');
Route::get('/service', 'HomeController@service')->name('service');

// contact
Route::get('/contact', 'HomeController@contact')->name('contact');
Route::post('/contact', 'HomeController@contactPost')->name('contact.post');

// login
Route::get('/login', 'HomeController@login')->name('login');
Route::post('/login', 'HomeController@loginPost')->name('login.post');

// profile
Route::prefix('/profile')->name('profile.')->group(function(){
	
	// dashboard
    Route::get('/dashboard', 'ProfileController@index')->name('dashboard');

    // settings
    Route::get('/settings', 'ProfileController@settings')->name('settings');
    Route::put('/update/optional', 'ProfileController@updateOptional')->name('update.optional');
    Route::put('/update/image', 'ProfileController@updateImage')->name('update.image');
    Route::put('/update/password', 'ProfileController@updatePassword')->name('update.password');
    
    // logout
    Route::get('/logout', 'ProfileController@logout')->name('logout');
});


/* Admin section 
====================================================> */
Route::prefix('/admin')->name('admin.')->group(function(){
    // login
    Route::get('/login', 'AdminController@index')->name('index');
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

    // mail
    Route::prefix('/mail')->name('mail')->middleware('isLoggedAdmin')->group(function(){
        Route::get('/', 'AdminController@mail');
        Route::get('/read-mail/{id}', 'AdminController@readMail')->name('.show');
        Route::get('/delete/{id}', 'AdminController@deleteMail')->name('.delete'); 
    });
});