<?php

use Illuminate\Support\Facades\Route;

/* Front section
====================================================> */
Route::get('/', 'HomeController@index')->name('index');
Route::get('/about', 'HomeController@about')->name('about');

// contact
Route::get('/contact', 'HomeController@contact')->name('contact');
Route::post('/contact', 'HomeController@contactPost')->name('contact.post');

// login
Route::get('/login', 'HomeController@login')->name('login');
Route::post('/login', 'HomeController@loginPost')->name('login.post');

// register
Route::get('/register', 'HomeController@register')->name('register');
Route::post('/register', 'HomeController@registerPost')->name('register.post');

// advert add
Route::get('/adverts/add', 'HomeController@advertsAdd')->name('adverts.add'); 

// profile
Route::prefix('/profile')->name('profile.')->group(function(){
	
	// dashboard
    Route::get('/dashboard', 'ProfileController@index')->name('dashboard');

    // adverts
    Route::get('/adverts', 'ProfileController@adverts')->name('adverts');       
    Route::get('/adverts/{seflink}', 'ProfileController@advertsDetail')->name('adverts.detail');    
    Route::get('/adverts/edit/{seflink}', 'ProfileController@advertsUpdate')->name('adverts.update');
    Route::get('/adverts/delete/{seflink}', 'ProfileController@advertsDelete')->name('adverts.delete');

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

    // users
    Route::prefix('/users')->name('users')->middleware('isLoggedAdmin')->group(function(){
        Route::get('/', 'AdminController@users'); 
		Route::get('/toggle', 'AdminController@toggleUser')->name('.toggle');
		Route::get('/delete/{id}', 'AdminController@userDelete')->name('.delete');
    });
	
	// category
    Route::prefix('/category')->middleware('isLoggedAdmin')->name('category')->group(function(){
        Route::get('/', 'AdminController@category');
        Route::get('/toggle', 'AdminController@toggleCategory')->name('.toggle');
        Route::get('/create', 'AdminController@categoryCreate')->name('.create');
        Route::post('/create', 'AdminController@categoryInsert')->name('.insert');
        Route::get('/{id}/edit', 'AdminController@categoryEdit')->name('.edit');
        Route::put('/{id}/edit', 'AdminController@categoryUpdate')->name('.update');
        Route::get('/{id}/delete', 'AdminController@categoryDelete')->name('.delete');
    });
	
	// subcategory
    Route::prefix('/subcategory')->middleware('isLoggedAdmin')->name('subcategory')->group(function(){
        Route::get('/', 'AdminController@subcategory');
        Route::get('/toggle', 'AdminController@toggleSubCategory')->name('.toggle');
        Route::get('/create', 'AdminController@subcategoryCreate')->name('.create');
        Route::post('/create', 'AdminController@subcategoryInsert')->name('.insert');
        Route::get('/{id}/edit', 'AdminController@subcategoryEdit')->name('.edit');
        Route::put('/{id}/edit', 'AdminController@subcategoryUpdate')->name('.update');
        Route::get('/{id}/delete', 'AdminController@subcategoryDelete')->name('.delete');
    });
});