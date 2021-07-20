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

    Client Module is not in used....
    All webpage is moved to root Resurce Folder.

*/




 // Super Admin Account
/*Route::group(['prefix' => 'administrator', 'middleware' => ['guest:admin']], function () {
    Route::get('/', 'AccountController@superadminAccount')->name('superadmin.login');
    Route::post('/authenticate', '\Modules\Admin\Http\Controllers\LoginController@authenticate')->name('superadmin.authenticate');
});


// Client Account
Route::group(['prefix' => 'client', 'middleware' => ['guest:client']], function () {
    Route::get('/login', 'AccountController@clientAccount')->name('client.login');
    Route::post('/authenticate', '\Modules\Client\Http\Controllers\LoginController@authenticate')->name('client.authenticate');
    Route::post('/register', '\Modules\Client\Http\Controllers\LoginController@register')->name('client.register');
});




Route::group(['middleware' => ['web','check_language']], function () {

  Route::get('lang/{lang}', ['as'=>'lang.switch', 'uses'=>'WebsiteController@switchLang']);

    
    Route::post('/sign-in-modal', 'LoginController@ajaxSignInModalLogin')->name('website.auth.sign-in-modal');
	
    // Basic Pages
   // Route::get('/', 'PageController@index')->name('page.homepage');
   // Route::get('/faq', 'PageController@faq')->name('page.faq');
   // Route::get('/about-us', 'PageController@aboutUs')->name('page.about-us');
  //  Route::get('/contact-us', 'PageController@contactUs')->name('page.contact-us');
  //  Route::get('/term-and-condtions', 'PageController@termAndCondtions')->name('page.term-and-condtions');;
  //  Route::get('/privacy-policy', 'PageController@privacy')->name('page.privacy');;
   // Route::get('/package-price/{category?}', 'PageController@packagePrice')->name('page.package-price');;
   
   


   	// Listings
    //Route::get('/listings/search', 'ListingController@searchListings')->name('listings.search');
    //Route::get('/listings/search-by-location', 'ListingController@searchByLocationListings')->name('listings.search-by-location');
    //Route::get('/listings/workshops-garages/{category?}', 'ListingController@allworkshopsGarages')->name('listings.workshops-garages');;
    //Route::get('/workshops-garages/{slug}', 'ListingController@singleWorkshopsGarages')->name('listings.workshops-garages.single');;

    
    // AutoShop
    //Route::get('/auto-shop', 'AutoShopController@index')->name('website.auto-shop');;

});

*/

