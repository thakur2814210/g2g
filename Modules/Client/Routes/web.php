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
Route::prefix('client')->group(function() {
   
});
*/


Route::group(['middleware' => 'web'], function () {

Route::group(['prefix' => 'client', 'middleware' => ['auth:customer']], function () {

	//Route::get('/logout', 'LoginController@logout')->name('client.logout');
	//Route::get('/dashboard', 'CustomerController@index')->name('client.dashboard');
	Route::get('/no-access', 'CustomerController@noAccess')->name('client.no-access');

	// Manage Package Subscription 
	Route::group(['prefix' => 'package-subscription'], function () {
		Route::get('/packages', 'PackageController@index')->name('client.packages');
		Route::get('/buy-upgrade/{slug}', 'PackageController@subscribeBuyOrUpgrade')->name('client.packages.buy_or_upgrade');
		Route::post('/subscribe', 'PackageController@subscribe')->name('client.packages.subscribe');
		Route::post('/cancel-request', 'PackageController@cancelSubscription')->name('client.packages.cancel-subscribe-request');
		Route::post('/cancel', 'PackageController@cancelSubscription')->name('client.packages.cancel-subscription');

		Route::get('/settings/{id}', 'PackageController@settings')->name('client.packages.settings');
		Route::get('/logs/{id}', 'PackageController@logs')->name('client.packages.logs');
		

		Route::get('/create/{category?}', 'PackageController@create')->name('client.package-subscription.create');
		Route::post('/create', 'PackageController@save')->name('client.package-subscription.save');
		Route::post('/payment-by-telr', 'PackageController@paymentByTelr')->name('client.package-subscription.payment-by-telr');
		Route::post('/telr-payment-status', 'PackageController@telrpaymentstatus')->name('client.package-subscription.telr-payment-status');
		Route::get('/booking-confimation', 'PackageController@bookingConfrimed')->name('client.package-subscription.booking-confimation');
		Route::post('/garage/list/category', 'PackageController@getGarageByCategory')->name('client.package-subscription.garage-list-category');

		Route::get('/check-package-running/{vehicleId}', 'PackageController@isAlreadyPackageRunning')->name('client.package.check-package-running');
		Route::post('/garage/list', 'PackageController@getGarageByService')->name('client.package.garage-list');
		
	});

	

	// Manage Service Request
	Route::group(['prefix' => 'service-request'], function () {
		Route::get('/list', 'ServiceRequestController@index')->name('client.service-request');
		Route::get('/settings/{id}', 'ServiceRequestController@settings')->name('client.service-request.settings');
		Route::get('/logs/{id}', 'ServiceRequestController@logs')->name('client.service-request.logs');
		Route::post('/update-package-payment-status', 'ServiceRequestController@updatePaymentStatus')->name('client.service-request.update-sr-payment-status');



		Route::get('/garage/list', 'ServiceRequestController@getGarageByService')->name('client.service-request.garage-list');
		Route::post('/garage/list', 'ServiceRequestController@getGarageByLatLong')->name('client.service-request.garage-list-latlong');


		
		Route::get('/create/{category?}', 'ServiceRequestController@category')->name('client.service-request.create');
		Route::post('/save', 'ServiceRequestController@save')->name('client.service-request.save-new');
		Route::get('/booking-confimation', 'ServiceRequestController@bookingConfrimed')->name('client.service-request.booking-confimation');


	
	});

	Route::group(['prefix' => 'custom-package'], function () {
		Route::get('/', 'PackageController@customPackage')->name('client.custom-package');
		Route::post('/save', 'PackageController@saveCustomPackage')->name('client.custom-package.save');
		Route::get('/settings/{id}', 'PackageController@customPackageSettings')->name('client.custom-package.settings');
		Route::post('/update-package-payment-status', 'PackageController@updateCustomPackagePaymentStatus')->name('client.custom-package.update-sr-payment-status');

	});

	Route::post('/subscribe-package', 'ServiceRequestController@subscribePackage')->name('client.service-request.subscribe-package');

	// My payemnts
	Route::group(['prefix' => 'payments'], function () {
		Route::get('/', 'PaymentController@index')->name('client.payments');
	});

	// Manage My Accounts
	Route::group(['prefix' => 'accounts'], function () {

		Route::get('/update-profile', 'CustomerController@editProfile')->name('client.profile.edit');
		Route::post('/update-profile', 'CustomerController@updateProfile')->name('client.profile.update');
		Route::get('/change-password', 'CustomerController@passwordChange')->name('client.profile.password-change');
		Route::post('/update-password', 'CustomerController@updateClientPassword')->name('client.profile.update-password');
		Route::post('/add-locations', 'CustomerController@addNewLocations')->name('client.profile.add-locations');

		// Manage Vehicle 
		/*Route::group(['prefix' => 'vehicles'], function () {
			Route::get('/list', 'VehicleController@index')->name('client.vehicles');
			Route::get('/add', 'VehicleController@add')->name('client.vehicle.add');
			Route::post('/save', 'VehicleController@save')->name('client.vehicle.save');
			Route::get('/edit/{id}', 'VehicleController@edit')->name('client.vehicle.edit');
			Route::get('/view/{id}', 'VehicleController@view')->name('client.vehicle.view');
			Route::post('/update', 'VehicleController@update')->name('client.vehicle.update');
			Route::get('/delete/{id}', 'VehicleController@delete')->name('client.vehicle.delete');
			Route::get('/model/{id}', 'ServiceRequestController@getModels')->name('client.vehicle.model');

		});*/

	});
	
});
});

