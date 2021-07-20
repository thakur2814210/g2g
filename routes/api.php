<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware('auth:api', 'cors')->get('/user', function (Request $request) {
    return $request->user();
});




/*
	|--------------------------------------------------------------------------
	| App Controller Routes
	|--------------------------------------------------------------------------
	|
	| This section contains all Routes of application
	|
	|
*/

Route::group(['namespace' => 'App'], function () {

	header("Access-Control-Allow-Origin: *");
	header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
	header("Access-Control-Allow-Headers: Content-Type, Authorization");

	//Route::post('/uploadimage', 'AppSettingController@uploadimage');
	
	Route::post('/getcategories', 'CategoriesController@getcategories');

	//registration url
	Route::post('/registerdevices', 'CustomersController@registerdevices');

	//processregistration url
	Route::post('/processregistration', 'CustomersController@processregistration');

	//update customer info url
	Route::post('/updatecustomerinfo', 'CustomersController@updatecustomerinfo');
	Route::get('/updatepassword', 'CustomersController@updatepassword');

	// login url
	Route::post('/processlogin', 'CustomersController@processlogin');



	//social login
	Route::post('/facebookregistration', 'CustomersController@facebookregistration');
	Route::post('/googleregistration', 'CustomersController@googleregistration');

	//push notification setting
	Route::post('/notify_me', 'CustomersController@notify_me');

	// forgot password url
	Route::post('/processforgotpassword', 'CustomersController@processforgotpassword');
	
	Route::post('/sendVerificationEmail', 'CustomersController@sendVerificationEmail');

	/*
	|--------------------------------------------------------------------------
	| Location Controller Routes
	|--------------------------------------------------------------------------
	|
	| This section contains countries shipping detail
	| This section contains links of affiliated to address
	|
	*/
	//get client locations
	Route::post('/getAllClientLocations', 'LocationController@getClientLocation');
	
	// add client locations
	Route::post('/addClientLocation', 'LocationController@addClientLocation');
	
	// update clinet locations
	Route::post('/updateClientLocation', 'LocationController@updateClientLocation');
	
	// delete client locations
	Route::post('/deleteClientLocation', 'LocationController@deleteClientLocation');

	//get country url
	Route::post('/getcountries', 'LocationController@getcountries');

	//get zone url
	Route::post('/getzones', 'LocationController@getzones');

	//get all address url
	Route::post('/getalladdress', 'LocationController@getalladdress');

	//address url
	Route::post('/addshippingaddress', 'LocationController@addshippingaddress');

	//update address url
	Route::post('/updateshippingaddress', 'LocationController@updateshippingaddress');

	//update default address url
	Route::post('/updatedefaultaddress', 'LocationController@updatedefaultaddress');

	//delete address url
	Route::post('/deleteshippingaddress', 'LocationController@deleteshippingaddress');

	/*
	|--------------------------------------------------------------------------
	| Product Controller Routes
	|--------------------------------------------------------------------------
	|
	| This section contains product data
	| Such as:
	| top seller, Deals, Liked, categroy wise or category individually and detail of every product.
	*/


	//get categories
	Route::post('/allcategories', 'MyProductController@allcategories');
	Route::post('/getCategoryById', 'MyProductController@getCategoryById');
	
	//Other Charges
	Route::get('/otherCharges', 'MyProductController@otherCharges');

	//getAllProducts
	Route::post('/getallproducts', 'MyProductController@getallproducts');

	//like products
	Route::post('/likeproduct', 'MyProductController@likeproduct');

	//unlike products
	Route::post('/unlikeproduct', 'MyProductController@unlikeproduct');

	//get filters
	Route::post('/getfilters', 'MyProductController@getfilters');

	//get getFilterproducts
	Route::post('/getfilterproducts', 'MyProductController@getfilterproducts');

	Route::post('/getsearchdata', 'MyProductController@getsearchdata');

	//getquantity
	Route::post('/getquantity', 'MyProductController@getquantity');


	/*
	|--------------------------------------------------------------------------
	| News Controller Routes
	|--------------------------------------------------------------------------
	|
	| This section contains news data
	| Such as:
	| top news or category individually and detail of every news.

	*/


	//get categories
	Route::post('/allnewscategories', 'NewsController@allnewscategories');

	//getAllProducts
	Route::post('/getallnews', 'NewsController@getallnews');
	

	

	/*
	|--------------------------------------------------------------------------
	| Cart Controller Routes
	|--------------------------------------------------------------------------
	|
	| This section contains customer orders
	|
	*/
	Route::post('/telrtoken', 'OrderController@telrtoken');
	Route::post('/telrpaymentstatus', 'OrderController@telrpaymentstatus');

	//hyperpaytoken
	Route::post('/hyperpaytoken', 'OrderController@hyperpaytoken');

	//hyperpaytoken
	Route::get('/hyperpaypaymentstatus', 'OrderController@hyperpaypaymentstatus');

	//paymentsuccess
	Route::get('/paymentsuccess', 'OrderController@paymentsuccess');

	//paymenterror
	Route::post('/paymenterror', 'OrderController@paymenterror');

	//generateBraintreeToken
	Route::get('/generatebraintreetoken', 'OrderController@generatebraintreetoken');

	//generateBraintreeToken
	Route::get('/instamojotoken', 'OrderController@instamojotoken');

	//add To order
	Route::post('/addtoorder', 'OrderController@addtoorder');

	//updatestatus
	Route::post('/updatestatus/', 'OrderController@updatestatus');

	//get all orders
	Route::post('/getorders', 'OrderController@getorders');

	//get default payment method
	Route::post('/getpaymentmethods', 'OrderController@getpaymentmethods');

	//get shipping / tax Rate
	Route::post('/getrate', 'OrderController@getrate');

	//get Coupon
	Route::post('/getcoupon', 'OrderController@getcoupon');

	//paytm hash key
	Route::get('/generatpaytmhashes', 'OrderController@generatpaytmhashes');

	/*
	|--------------------------------------------------------------------------
	| Banner Controller Routes
	|--------------------------------------------------------------------------
	|
	| This section contains banners, banner history
	|

	*/

	//get banners
	Route::get('/getbanners', 'BannersController@getbanners');

	//banners history
	Route::post('/bannerhistory', 'BannersController@bannerhistory');

	/*
	|--------------------------------------------------------------------------
	| App setting Controller Routes
	|--------------------------------------------------------------------------
	|
	| This section contains app  languages
	|

	*/
	Route::get('/sitesetting', 'AppSettingController@sitesetting');


	//old app label
	Route::post('/applabels', 'AppSettingController@applabels');

	//new app label
	Route::get('/applabels3', 'AppSettingController@applabels3');
	Route::post('/contactus', 'AppSettingController@contactus');
	Route::get('/getlanguages', 'AppSettingController@getlanguages');


	/*
	|--------------------------------------------------------------------------
	| Page Controller Routes
	|--------------------------------------------------------------------------
	|
	| This section contains news data
	| Such as:
	| top Page individually and detail of every Page.

	*/

	//getAllPages
	Route::post('/getallpages', 'PagesController@getallpages');


  /*
	|--------------------------------------------------------------------------
	| reviews Controller Routes
	|--------------------------------------------------------------------------
 */

   Route::post('/givereview', 'ReviewsController@givereview');
   Route::post('/updatereview', 'ReviewsController@updatereview');
   Route::get('/getreviews', 'ReviewsController@getreviews');

  /*
  |--------------------------------------------------------------------------
  | current location Controller Routes
  |--------------------------------------------------------------------------
  */

  Route::get('/getlocation', 'AppSettingController@getlocation');
  
  /*
  |--------------------------------------------------------------------------
  | currency location Controller Routes
  |--------------------------------------------------------------------------
  */

  Route::get('/getcurrencies', 'AppSettingController@getcurrencies');

  /*
	|--------------------------------------------------------------------------
	| Garage Controller Routes
	|--------------------------------------------------------------------------
	|
	| This section contains news data
	| Such as:
	| top news or category individually and detail of every news.

	*/
    
    //getAllPackages	
	Route::post('/getAllPackages', 'Garage\GarageController@getAllPackages');
	
	
	Route::post('/garageclientprocesslogin', 'Garage\CustomersController@processlogin');

	Route::post('/garageclientprocessforgotpassword', 'Garage\CustomersController@processforgotpassword');

	
	Route::post('/garageclientprocessregistration', 'Garage\CustomersController@processregistration');

	Route::get('/getallcities', 'Garage\GarageController@getallcities');

	Route::get('/getallcountries', 'Garage\GarageController@getallcountries');

	//Garage Routes
	Route::post('/getAllMapGarages', 'Garage\GarageController@getAllMapGarages');
	Route::post('/getAllGarages', 'Garage\GarageController@getAllGarages');
	Route::post('/getFeaturedGarages', 'Garage\GarageController@getFeaturedGarages');
	Route::post('/updategaragecustomerinfo', 'Garage\CustomersController@updategaragecustomerinfo');

	//Service Request
	Route::post('/allservicerequests', 'Garage\ServiceRequestController@allservicerequests'); 
	Route::post('/getServiceRequestData', 'Garage\ServiceRequestController@getServiceRequestData');
	Route::post('/getServiceRequestByGarage', 'Garage\ServiceRequestController@getServiceRequestByGarage');
	Route::post('/getGarageByLocation', 'Garage\ServiceRequestController@getGarageByLocation');
	Route::post('/createServiceRequest', 'Garage\ServiceRequestController@createServiceRequest');
	Route::post('/getServiceRequest', 'Garage\ServiceRequestController@getServiceRequest');
	Route::post('/uploadServiceRequestFiles', 'Garage\ServiceRequestController@uploadServiceRequestFiles');
	Route::post('/removeUploadServiceRequestFiles', 'Garage\ServiceRequestController@removeUploadServiceRequestFiles');
	Route::post('/getServiceRequestLog', 'Garage\ServiceRequestController@getServiceRequestLog');
	Route::post('/updateServiceRequest', 'Garage\ServiceRequestController@updateServiceRequest');
	Route::post('/getSingleServiceRequests', 'Garage\ServiceRequestController@getSingleServiceRequests');
	Route::post('/updateServiceRequestPayment', 'Garage\ServiceRequestController@updateServiceRequestPayment');
	

	Route::post('/getPackageSubscriptionData', 'Garage\PackageController@getPackageSubscriptionData');
	Route::post('/getGarageByCategory', 'Garage\PackageController@getGarageByCategory');
	Route::post('/createPackageSubscription', 'Garage\PackageController@createPackageSubscription');
	Route::post('/getPackageSubscription', 'Garage\PackageController@getPackageSubscription');
	Route::post('/getPackageSubscriptionLog', 'Garage\PackageController@getPackageSubscriptionLog');
	Route::post('/updatePackageSubscription', 'Garage\PackageController@updatePackageSubscription');
	Route::post('/getSinglePackageSubscription', 'Garage\PackageController@getSinglePackageSubscription');



	Route::post('/mypayments', 'Garage\CustomersController@mypayments');
	
	Route::post('/getVehicles', 'Garage\CustomersController@getVehicles');
	Route::post('/addVehicle', 'Garage\CustomersController@addVehicle');
	Route::post('/updateVehicle', 'Garage\CustomersController@updateVehicle');
	Route::post('/deleteVehicle', 'Garage\CustomersController@deleteVehicle');
	Route::post('/deleteClientLocation', 'Garage\CustomersController@deleteClientLocation');
	Route::post('/getVehicleMakes', 'Garage\CustomersController@getVehicleMakes');
	Route::post('/getVehicleModels', 'Garage\CustomersController@getVehicleModels');
	Route::post('/getSingleVehicle', 'Garage\CustomersController@getSingleVehicle');

	Route::post('/getGaragefilters', 'Garage\GarageController@getGaragefilters');
	


});
