<?php

if(file_exists(storage_path('installed'))){
	$check = DB::table('settings')->where('id', 94)->first();
	if($check->value == 'Maintenance'){
		$middleware = ['installer','env'];
	}
	else{
		$middleware = ['installer'];
	}
}
else{
	$middleware = ['installer'];
}

Route::get('/maintance','Web\IndexController@maintance');

Route::group(['namespace' => 'Website','middleware' => ['installer']], function () {
	Route::get('/login', 'IndexController@login')->name('login');
	Route::get('/register', 'IndexController@register');
});

Route::group(['namespace' => 'Autoshop','middleware' => ['installer']], function () {
	Route::post('/process-login', 'CustomersController@processLogin');
	Route::get('/logout', 'CustomersController@logout')->middleware('Customer');
	Route::get('/vlogout', 'CustomersController@logout1')->middleware('Vendor');
});


Route::group(['namespace' => 'Autoshop','middleware' => $middleware], function () {
	Route::get('general_error/{msg}', function($msg) {
		 return view('errors.general_error',['msg' => $msg]);
	});
		Route::get('autocomplete', 'ProductsController@autocomplete')->name('autocomplete');


		Route::get('/autoshop','IndexController@index')->name('autoshop.homepage');
		Route::post('/change_language', 'WebSettingController@changeLanguage');
		Route::post('/change_currency', 'WebSettingController@changeCurrency');
		Route::post('/addToCart', 'CartController@addToCart');
		Route::post('/modal_show', 'ProductsController@ModalShow');
		Route::get('/deleteCart', 'CartController@deleteCart');
		Route::get('/viewcart', 'CartController@viewcart');
		Route::get('/editcart/{id}/{slug}', 'CartController@editcart');
		Route::post('/updateCart', 'CartController@updateCart');
		Route::post('/updatesinglecart', 'CartController@updatesinglecart');
		Route::get('/cartButton', 'CartController@cartButton');

		Route::get('/dashboard', 'CustomersController@dashboard')->middleware('Customer')->name('client.dashboard');
		Route::get('/profile', 'CustomersController@profile')->middleware('Customer');
		Route::get('/wishlist', 'CustomersController@wishlist')->middleware('Customer');
		Route::post('/updateMyProfile', 'CustomersController@updateMyProfile')->middleware('Customer');
		Route::post('/updateMyPassword', 'CustomersController@updateMyPassword')->middleware('Customer');
		Route::get('UnlikeMyProduct/{id}', 'CustomersController@unlikeMyProduct')->middleware('Customer');
		Route::post('likeMyProduct', 'CustomersController@likeMyProduct');
		Route::post('addToCompare', 'CustomersController@addToCompare');
		Route::get('compare', 'CustomersController@Compare')->middleware('Customer');
		Route::get('deletecompare/{id}', 'CustomersController@DeleteCompare')->middleware('Customer');
		Route::get('/orders', 'OrdersController@orders')->middleware('Customer');
		Route::get('/view-order/{id}', 'OrdersController@viewOrder')->middleware('Customer');
		Route::post('/updatestatus/', 'OrdersController@updatestatus')->middleware('Customer');
		Route::get('/shipping-address', 'ShippingAddressController@shippingAddress')->middleware('Customer');
		Route::post('/addMyAddress', 'ShippingAddressController@addMyAddress')->middleware('Customer');
		Route::post('/myDefaultAddress', 'ShippingAddressController@myDefaultAddress')->middleware('Customer');
		Route::post('/update-address', 'ShippingAddressController@updateAddress')->middleware('Customer');
		Route::get('/delete-address/{id}', 'ShippingAddressController@deleteAddress')->middleware('Customer');
		Route::post('/ajaxZones', 'ShippingAddressController@ajaxZones');
		//news section
		Route::get('/news', 'NewsController@news');
		Route::get('/news-detail/{slug}', 'NewsController@newsDetail');
		Route::post('/loadMoreNews', 'NewsController@loadMoreNews');
		Route::get('/page', 'IndexController@page');
		Route::get('/shop', 'ProductsController@shop');
		Route::post('/shop', 'ProductsController@shop');
		Route::get('/product-detail/{slug}', 'ProductsController@productDetail');
		Route::post('/filterProducts', 'ProductsController@filterProducts');
		Route::post('/getquantity', 'ProductsController@getquantity');

		Route::get('/guest_checkout', 'OrdersController@guest_checkout');
		Route::get('/checkout', 'OrdersController@checkout')->middleware('Customer');
		Route::post('/checkout_shipping_address', 'OrdersController@checkout_shipping_address')->middleware('Customer');
		Route::post('/checkout_billing_address', 'OrdersController@checkout_billing_address')->middleware('Customer');
		Route::post('/checkout_payment_method', 'OrdersController@checkout_payment_method')->middleware('Customer');
		Route::post('/paymentComponent', 'OrdersController@paymentComponent')->middleware('Customer');
		Route::post('/place_order', 'OrdersController@place_order')->middleware('Customer');
		Route::get('/orders', 'OrdersController@orders')->middleware('Customer');
		Route::post('/updatestatus/', 'OrdersController@updatestatus')->middleware('Customer');
		Route::post('/myorders', 'OrdersController@myorders')->middleware('Customer');
		Route::get('/stripeForm', 'OrdersController@stripeForm')->middleware('Customer');
		Route::get('/view-order/{id}', 'OrdersController@viewOrder')->middleware('Customer');
		Route::post('/pay-instamojo', 'OrdersController@payIinstamojo')->middleware('Customer');

        Route::post('/telr-payment-status', 'OrdersController@telrpaymentstatus')->middleware('Customer');
        Route::post('/checkout_telr_method', 'OrdersController@paymentByTelr')->middleware('Customer');
		Route::get('/checkout/hyperpay', 'OrdersController@hyperpay')->middleware('Customer');
		Route::get('/checkout/hyperpay/checkpayment', 'OrdersController@checkpayment')->middleware('Customer');
		Route::post('/checkout/payment/changeresponsestatus', 'OrdersController@changeresponsestatus')->middleware('Customer');
		Route::post('/apply_coupon', 'CartController@apply_coupon');
		Route::get('/removeCoupon/{id}', 'CartController@removeCoupon')->middleware('Customer');
		
			Route::get('/apply_other_charge', 'CartController@apply_other_charge')->middleware('Customer');
			Route::get('/remove_other_charge', 'CartController@remove_other_charge')->middleware('Customer');

		Route::get('/signup', 'CustomersController@signup');
		Route::get('/logoutt', 'CustomersController@logout')->middleware('Customer');
	
		Route::get('/forgotPassword', 'CustomersController@forgotPassword');
		Route::get('/recoverPassword', 'CustomersController@recoverPassword');
		Route::post('/processPassword', 'CustomersController@processPassword');
		
		Route::get('/resend-verification-email', 'CustomersController@resendVerificationEmail');
		Route::post('/processResendVerificationEmail', 'CustomersController@processResendVerificationEmail');

        Route::post('/signupProcess', 'CustomersController@signupProcess');
		Route::post('/signupProcessVendor', 'CustomersController@signupProcessVendor');


		//Route::get('login/{social}', 'CustomersController@socialLogin');
		//Route::get('login/{social}/callback', 'CustomersController@handleSocialLoginCallback');
		

		Route::post('/commentsOrder', 'OrdersController@commentsOrder');
		Route::post('/subscribeNotification/', 'CustomersController@subscribeNotification');
		//Route::get('/contact', 'IndexController@contactus');
		Route::post('/processContactUs', 'IndexController@processContactUs');


		// Manage Vehicle 
		Route::group(['prefix' => 'vehicles'], function () {
			Route::get('/list', 'VehicleController@index')->name('client.vehicles')->middleware('Customer');;
			Route::get('/add', 'VehicleController@add')->name('client.vehicle.add')->middleware('Customer');;
			Route::post('/save', 'VehicleController@save')->name('client.vehicle.save')->middleware('Customer');;
			Route::get('/edit/{id}', 'VehicleController@edit')->name('client.vehicle.edit')->middleware('Customer');;
			Route::get('/view/{id}', 'VehicleController@view')->name('client.vehicle.view')->middleware('Customer');;
			Route::post('/update', 'VehicleController@update')->name('client.vehicle.update')->middleware('Customer');;
			Route::get('/delete/{id}', 'VehicleController@delete')->name('client.vehicle.delete')->middleware('Customer');;
			Route::get('/model/{id}', 'VehicleController@getModels')->name('client.vehicle.model')->middleware('Customer');;

		});
		
		Route::group(['prefix' => 'location'], function () {
			Route::post('/add-new-location', 'CustomersController@addNewLocations')->name('client.add-new-location')->middleware('Customer');;
		});


		Route::group(['prefix' => 'transactions'], function () {
			Route::get('/', 'CustomersController@transactions')->name('client.payments')->middleware('Customer');;
		});

		Route::group(['prefix' => 'service-request'], function () {
			Route::get('/list', 'ServiceRequestController@index')->middleware('Customer');;
			Route::get('/settings/{id}', 'ServiceRequestController@settings')->middleware('Customer');;
			Route::get('/logs/{id}', 'ServiceRequestController@logs')->middleware('Customer');;
			Route::post('/update-package-payment-status', 'ServiceRequestController@updatePaymentStatus')->middleware('Customer');;
		});

		Route::group(['prefix' => 'package-subscription'], function () {
			Route::get('/packages', 'PackageController@index')->middleware('Customer');;
			Route::get('/settings/{id}', 'PackageController@settings')->middleware('Customer');;
			Route::get('/logs/{id}', 'PackageController@logs')->middleware('Customer');;
		});

		Route::group(['prefix' => 'custom-package'], function () {
			
			Route::get('/settings/{id}', 'PackageController@settings');
		

		});

		Route::get('/my-address', 'AddressController@index')->middleware('Customer');
		Route::get('/my-address/add', 'AddressController@add')->middleware('Customer');
		Route::post('/my-address/add', 'AddressController@save')->middleware('Customer');
		Route::get('/my-address/edit/{id}', 'AddressController@edit')->middleware('Customer');
		Route::post('/my-address/update', 'AddressController@update')->middleware('Customer');



	});
	
	
	/*
	    Routes for front web pages
	*/
	

	Route::group(['namespace' => 'Website','middleware' => $middleware], function () {
		Route::get('general_error/{msg}', function($msg) {
			 return view('errors.general_error',['msg' => $msg]);
		});
		
		Route::post('/sign-in-modal', 'IndexController@ajaxSignInModalLogin')->name('website.auth.sign-in-modal');

	 	Route::get('/','IndexController@index')->name('page.homepage');
       	Route::get('/faq', 'IndexController@faq')->name('page.faq');
		Route::get('/about-us', 'IndexController@aboutUs')->name('page.about-us');
		Route::get('/contact', 'IndexController@contactUs')->name('page.contact-us');
		Route::get('/term-and-condtions', 'IndexController@termAndCondtions')->name('page.term-and-condtions');
		Route::get('/privacy-policy', 'IndexController@privacy')->name('page.privacy');
		Route::get('/package-price/{category?}', 'IndexController@packagePrice')->name('page.package-price');

		Route::get('/listings/search', 'IndexController@searchListings')->name('listings.search');
	    Route::get('/listings/search-by-location', 'IndexController@searchByLocationListings')->name('listings.search-by-location');
	    Route::get('/listings/workshops-garages/{category?}', 'IndexController@allworkshopsGarages')->name('listings.workshops-garages');
	    Route::get('/workshops-garages/{slug}', 'IndexController@singleWorkshopsGarages')->name('listings.workshops-garages.single');
	    Route::get('/user/verify/{token}','IndexController@verifyEmailAddress')->name('listings.verify-email-addresss'); 

	});

	

	