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
Route::prefix('garage')->group(function() {
    
});
*/

 // Garage Account
/*Route::group(['prefix' => 'partner', 'middleware' => ['guest:garage']], function () {
    Route::get('/login', 'LoginController@login')->name('garage.login');
    Route::post('/authenticate', 'LoginController@authenticate')->name('garage.authenticate');
    Route::post('/register', 'LoginController@register')->name('garage.register');
});
*/


Route::group(['middleware' => 'web'], function () {
	Route::group(['prefix' => 'partner', 'middleware' => ['auth:vendor']], function () {

		// Garage dashbard
		Route::get('/dashboard', 'GarageController@dashboard')->name('garage.dashboard');
		Route::get('/logout', 'GarageController@logout')->name('garage.logout');

		Route::group(['prefix' => 'garage'], function (){
			/*
			// Garage setup
			Route::get('/setup', 'GarageController@garageSetup')->name('garage.setup.veiw');
			Route::post('/garage/save', 'GarageController@saveGarageDetail')->name('garage.setup.save');
			
			// Garage detail
			Route::get('/detail', 'GarageController@viewGarageDetail')->name('garage.detail.view');
			Route::post('/detail/update', 'GarageController@updateGarageDetail')->name('garage.detail.update');
			// Garage team
			Route::post('/team/update', 'GarageController@updateGarageTeam')->name('garage.team.update');
			Route::get('/team/delete/{id}', 'GarageController@deleteGarageTeam')->name('garage.team.delete');
			// Garage image
			Route::post('/media-image/update', 'GarageController@updateGarageImage')->name('garage.image.update');
			Route::get('/media-image/delete/{id}', 'GarageController@deleteGarageImage')->name('garage.image.delete');
			// Garage video
			Route::post('/media-video/update', 'GarageController@updateGarageVideo')->name('garage.video.update');
			Route::get('/media-video/delete/{id}', 'GarageController@deleteGarageVideo')->name('garage.video.delete');

			*/

			Route::get('/', 'GarageController@garage')->name('garage.information');

			Route::get('add', 'GarageController@add')->name('garage.add');
			Route::post('save', 'GarageController@save')->name('garage.save');
			Route::get('/edit', 'GarageController@edit')->name('garage.edit');
			Route::post('update', 'GarageController@update')->name('garage.update');


			Route::get('detail/view', 'GarageController@viewGarageDetail')->name('garage.detail.view');
			Route::post('detail/update', 'GarageController@updateGarageDetail')->name('garage.detail.update');

			Route::get('working-hour/view', 'GarageController@viewGarageWorkingHours')->name('garage.working-hours.view');
			Route::post('working-hour/update', 'GarageController@updateGarageWorkingHours')->name('garage.working-hours.update');

			Route::get('services/view', 'GarageController@viewGarageServices')->name('garage.services.view');
			Route::post('services/update', 'GarageController@updateGarageServices')->name('garage.services.update');

			
			Route::get('members/view', 'GarageController@viewGarageTeam')->name('garage.team.view');
			Route::post('members/update', 'GarageController@updateGarageTeam')->name('garage.team.update');
			Route::get('members/delete/{id}', 'GarageController@deleteGarageTeam')->name('garage.team.delete');
			
			Route::get('images/view', 'GarageController@viewGarageImage')->name('garage.image.view');
			Route::post('images/update', 'GarageController@updateGarageImage')->name('garage.image.update');
			Route::get('images/delete/{id}', 'GarageController@deleteGarageImage')->name('garage.image.delete');
			
			Route::get('videos/view', 'GarageController@viewGarageVideo')->name('garage.video.view');
			Route::post('videos/update', 'GarageController@updateGarageVideo')->name('garage.video.update');
			Route::get('videos/delete/{id}', 'GarageController@deleteGarageVideo')->name('garage.video.delete');
			
		});

		
		

		Route::get('/payments', 'PaymentController@index')->name('garage.payments');


		// Garage Profile
		Route::group(['prefix' => 'profile'], function () {
			Route::get('/view', 'ProfileController@viewProfile')->name('garage.profile.view');
			Route::post('/update', 'ProfileController@updateProfile')->name('garage.profile.update');
			Route::post('/updatepassword', 'ProfileController@updateClientPassword')->name('garage.profile.update-password');

		});
		
		
		// Garage Package Subscribed
		Route::group(['prefix' => 'packages'], function () {
			Route::get('/', 'PackageController@index')->name('garage.packages');
			Route::get('/settings/{id}', 'PackageController@settings')->name('garage.packages.settings');
			Route::get('/logs/{id}', 'PackageController@logs')->name('garage.packages.logs');
			Route::get('/subscribe/{slug}', 'PackageController@buyPackage')->name('garage.packages.buy_or_upgrade');
			Route::post('/subscribe', 'PackageController@buyPackagesave')->name('garage.packages.subscribe');
			Route::post('/cancel-subscribe-request', 'PackageController@cancelSubscription')->name('garage.packages.cancel-subscribe-request');
			Route::post('/cancel-subscription', 'PackageController@cancelSubscription')->name('garage.packages.cancel-subscription');

		});

		// Manage Customer Service Request
		Route::group(['prefix' => 'customer-service-request'], function () {
			Route::get('/', 'CustomerController@serviceRequests')->name('garage.customers.service-request');
			Route::get('/settings/{id}', 'CustomerController@serviceRequestSettings')->name('garage.customers.service-request.settings');
			Route::get('/logs/{id}', 'CustomerController@serviceRequestLogs')->name('garage.customers.service-request.logs');
			Route::post('/update-package-status', 'CustomerController@updateServiceRequestStatus')->name('garage.customers.service-requestd.update-sr-status');
			Route::post('/update-package-payment-status', 'CustomerController@updateserviceRequestPaymentStatus')->name('garage.customers.service-request.update-sr-payment-status');
			Route::post('/update-quote-amount', 'CustomerController@updateserviceRequestQuoteAmount')->name('garage.customers.service-request.update-quote-amount');
			
		});
		

		// Manage Customer ackage subscription
		Route::group(['prefix' => 'customer-package-subscription'], function () {
			Route::get('/', 'CustomerController@customerPackagesSubscription')->name('garage.customers.packages-subscribed');
			//Route::get('/', 'CustomerController@packageSubscriptions')->name('garage.customers.package-subscription');
			Route::post('/cod/update-payment-status', 'CustomerController@updateCodPaymentStatusPackageSubscription')->name('garage.customers.packages-subscription.update-payment-status');
			Route::get('/settings/{id}', 'CustomerController@customerPackagesSubscriptionSettings')->name('garage.customers.packages-subscribed.settings');
			Route::get('/custom/settings/{id}', 'CustomerController@customerCustomPackagesSubscriptionSettings')->name('garage.customers.packages-subscribed.custom.settings');
			Route::get('/logs/{id}', 'CustomerController@customerPackagesSubscriptionLogs')->name('garage.customers.packages-subscribed.logs');

			Route::post('/update-package-status', 'CustomerController@packagesSubscribedUpdatePackageStatus')->name('garage.customers.packages-subscribed.update-package-status');
			Route::post('/update-package-payment-status', 'CustomerController@packagesSubscribedUpdatePackagePaymentStatus')->name('garage.customers.packages-subscribed.update-package-payment-status');

			Route::post('/custom/update-package-quote-amount', 'CustomerController@customerCustomPackagesQuoteAmountUpdate')->name('garage.customers.custom-package.update-package-quote-amount');
		
		});

		//Manage Customer Package Subscription
		Route::get('/customer-payments', 'PaymentController@index')->name('garage.customers.payments');

		// reports
		Route::get('/statscustomers', 'ReportsController@statsCustomers')->middleware('report');
        Route::get('/statsproductspurchased', 'ReportsController@statsProductsPurchased')->middleware('report');
        Route::get('/statsproductsliked', 'ReportsController@statsProductsLiked')->middleware('report');
        Route::get('/outofstock', 'ReportsController@outofstock')->middleware('report');
        Route::get('/lowinstock', 'ReportsController@lowinstock')->middleware('report');
        Route::get('/stockin', 'ReportsController@stockin')->middleware('report');



        // manage coupans

		Route::group(['prefix' => 'coupons'], function () {
	        Route::get('/display', 'CouponsController@display')->middleware('view_coupon');
	        Route::get('/add', 'CouponsController@add')->middleware('add_coupon');
	        Route::post('/insert', 'CouponsController@insert')->middleware('add_coupon');
	        Route::get('/edit/{id}', 'CouponsController@edit')->middleware('edit_coupon');
	        Route::post('/update', 'CouponsController@update')->middleware('edit_coupon');
	        Route::post('/delete', 'CouponsController@delete')->middleware('delete_coupon');
	        Route::get('/filter', 'CouponsController@filter')->middleware('view_coupon');
	    });


		// manage Media

	    Route::group(['prefix' => 'media'], function () {
	        
	        Route::get('/add', 'MediaController@add')->middleware('add_media');
	        Route::post('/updatemediasetting', 'MediaController@updatemediasetting')->middleware('edit_media');
	        Route::post('/uploadimage', 'MediaController@fileUpload')->middleware('add_media');
	        Route::post('/delete', 'MediaController@deleteimage')->middleware('delete_media');
	        Route::get('/detailimage/{id}', 'MediaController@detailimage')->middleware('view_media');
	        Route::get('/refresh', 'MediaController@refresh');
	    });


	     // manage vendor transaction

	    Route::group(['prefix' => 'vendor/transactions'], function () {

	        // Withdraw method CRUD routes...
	        Route::get('/withdrawMethod', 'WithdrawController@withdrawMethod');
	         Route::get('/withdrawMethod/add', 'WithdrawController@addWithdrawMethod');
	        Route::post('/withdrawMethod/store', 'WithdrawController@storeWithdrawMethod');
	        Route::get('/withdrawMethod/edit/{id}', 'WithdrawController@editWithdrawMethod');
	        Route::post('/withdrawMethod/update', 'WithdrawController@updateWithdrawMethod');
	        Route::post('/withdrawMethod/delete', 'WithdrawController@destroyWithdrawMethod');
	        Route::post('/withdrawMethod/enable', 'WithdrawController@enableWithdrawMethod');
	        
	        // Withdraw Money Routes
	        Route::get('/withdrawLog', 'WithdrawController@withdrawLog');
	        Route::get('/successLog', 'WithdrawController@successLog');
	        Route::get('/refundedLog', 'WithdrawController@refundedLog');
	        Route::get('/pendingLog', 'WithdrawController@pendingLog');

	        Route::get('/withdrawLog/{wID}', 'WithdrawController@withdrawLogShow');
	        Route::post('/withdrawLog/message/store', 'WithdrawController@storeMessage');

	        // All withdraw routes...
        	Route::get('/withdrawMoney', 'WithdrawController@withdrawMoney')->name('vendor.withdrawMoney');
        	Route::post('/withdrawRequest/store', 'WithdrawController@withdrawRequestStore')->name('vendor.withdrawRequest.store');

    	});


     	// manage Orders

     	Route::group(['prefix' => 'orders'], function () {
	        Route::get('/display', 'OrdersController@display')->name('partner.orders')->middleware('view_order');
	        Route::get('/vieworder/{id}', 'OrdersController@vieworder')->middleware('view_order');
	        Route::post('/updateOrder', 'OrdersController@updateOrder')->middleware('edit_order');
	        Route::post('/deleteOrder', 'OrdersController@deleteOrder')->middleware('edit_order');
	        Route::get('/invoiceprint/{id}', 'OrdersController@invoiceprint')->middleware('view_order');
	        Route::get('/orderstatus', 'SiteSettingController@orderstatus')->middleware('view_order');
	        Route::get('/addorderstatus', 'SiteSettingController@addorderstatus')->middleware('edit_order');
	        Route::post('/addNewOrderStatus', 'SiteSettingController@addNewOrderStatus')->middleware('edit_order');
	        Route::get('/editorderstatus/{id}', 'SiteSettingController@editorderstatus')->middleware('edit_order');
	        Route::post('/updateOrderStatus', 'SiteSettingController@updateOrderStatus')->middleware('edit_order');
	        Route::post('/deleteOrderStatus', 'SiteSettingController@deleteOrderStatus')->middleware('edit_order');

	    });

	 
	    // manage Products


	    Route::group(['prefix' => 'products'], function () {
	        Route::get('/display', 'ProductController@display')->middleware('view_product');
	        Route::get('/add', 'ProductController@add')->middleware('add_product');
	        Route::post('/add', 'ProductController@insert')->middleware('add_product');
	        Route::get('/edit/{id}', 'ProductController@edit')->middleware('edit_product');
	        Route::post('/update', 'ProductController@update')->middleware('edit_product');
	        Route::post('/delete', 'ProductController@delete')->middleware('delete_product');
	        Route::get('/filter', 'ProductController@filter')->middleware('view_product');
	        Route::group(['prefix' => 'inventory'], function () {
	            Route::get('/display', 'ProductController@addinventoryfromsidebar')->middleware('view_product');
	            // Route::post('/addnewstock', 'ProductController@addinventory')->middleware('view_product');
	            Route::get('/ajax_min_max/{id}/', 'ProductController@ajax_min_max')->middleware('view_product');
	            Route::get('/ajax_attr/{id}/', 'ProductController@ajax_attr')->middleware('view_product');
	            Route::post('/addnewstock', 'ProductController@addnewstock')->middleware('add_product');
	            Route::post('/addminmax', 'ProductController@addminmax')->middleware('add_product');
	            Route::get('/addproductimages/{id}/', 'ProductController@addproductimages')->middleware('add_product');
	        });
	        Route::group(['prefix' => 'images'], function () {
	            Route::get('/display/{id}/', 'ProductController@displayProductImages')->middleware('view_product');
	            Route::get('/add/{id}/', 'ProductController@addProductImages')->middleware('add_product');
	            Route::post('/insertproductimage', 'ProductController@insertProductImages')->middleware('add_product');
	            Route::get('/editproductimage/{id}', 'ProductController@editProductImages')->middleware('edit_product');
	            Route::post('/updateproductimage', 'ProductController@updateproductimage')->middleware('edit_product');
	            Route::post('/deleteproductimagemodal', 'ProductController@deleteproductimagemodal')->middleware('edit_product');
	            Route::post('/deleteproductimage', 'ProductController@deleteproductimage')->middleware('edit_product');
	        });
	        Route::group(['prefix' => 'attach/attribute'], function () {
	            Route::get('/display/{id}', 'ProductController@addproductattribute')->middleware('view_product');
	            Route::group(['prefix' => '/default'], function () {
	                Route::post('/', 'ProductController@addnewdefaultattribute')->middleware('view_product');
	                Route::post('/edit', 'ProductController@editdefaultattribute')->middleware('edit_product');
	                Route::post('/update', 'ProductController@updatedefaultattribute')->middleware('edit_product');
	                Route::post('/deletedefaultattributemodal', 'ProductController@deletedefaultattributemodal')->middleware('edit_product');
	                Route::post('/delete', 'ProductController@deletedefaultattribute')->middleware('edit_product');
	                Route::group(['prefix' => '/options'], function () {
	                    Route::post('/add', 'ProductController@showoptions')->middleware('view_product');
	                    Route::post('/edit', 'ProductController@editoptionform')->middleware('edit_product');
	                    Route::post('/update', 'ProductController@updateoption')->middleware('edit_product');
	                    Route::post('/showdeletemodal', 'ProductController@showdeletemodal')->middleware('edit_product');
	                    Route::post('/delete', 'ProductController@deleteoption')->middleware('edit_product');
	                    Route::post('/getOptionsValue', 'ProductController@getOptionsValue')->middleware('edit_product');
	                    Route::post('/currentstock', 'ProductController@currentstock')->middleware('view_product');

	                });

	            });

	        });

	    });

	    Route::group(['prefix' => 'products/attributes'], function () {
	        Route::get('/display', 'ProductAttributesController@display')->middleware('view_product');
	        Route::get('/add', 'ProductAttributesController@add')->middleware('view_product');
	        Route::post('/insert', 'ProductAttributesController@insert')->middleware('view_product');
	        Route::get('/edit/{id}', 'ProductAttributesController@edit')->middleware('view_product');
	        Route::post('/update', 'ProductAttributesController@update')->middleware('view_product');
	        Route::post('/delete', 'ProductAttributesController@delete')->middleware('view_product');

	        Route::group(['prefix' => 'options/values'], function () {
	            Route::get('/display/{id}', 'ProductAttributesController@displayoptionsvalues')->middleware('view_product');
	            Route::post('/insert', 'ProductAttributesController@insertoptionsvalues')->middleware('edit_product');
	            Route::get('/edit/{id}', 'ProductAttributesController@editoptionsvalues')->middleware('edit_product');
	            Route::post('/update', 'ProductAttributesController@updateoptionsvalues')->middleware('edit_product');
	            Route::post('/delete', 'ProductAttributesController@deleteoptionsvalues')->middleware('edit_product');
	            Route::post('/addattributevalue', 'ProductAttributesController@addattributevalue')->middleware('edit_product');
	            Route::post('/updateattributevalue', 'ProductAttributesController@updateattributevalue')->middleware('edit_product');
	            Route::post('/checkattributeassociate', 'ProductAttributesController@checkattributeassociate')->middleware('edit_product');
	            Route::post('/checkvalueassociate', 'ProductAttributesController@checkvalueassociate')->middleware('edit_product');
	        });
	    });

	});
});

