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
*/
Route::group(['middleware' => 'web'], function () {
Route::group(['prefix' => 'administrator', 'middleware' => 'auth'], function () {

	
	
	
	// Categories
	Route::group(['prefix' => 'sections'], function () {
		Route::get('/list', 'CategoryController@allCategoryList')->name('superadmin.category.list');
		Route::get('/add', 'CategoryController@addCategory')->name('superadmin.category.add');
		Route::post('/save', 'CategoryController@saveCategory')->name('superadmin.category.save');
		Route::get('/edit/{id}', 'CategoryController@editCategory')->name('superadmin.category.edit');
		Route::post('/update', 'CategoryController@updateCategory')->name('superadmin.category.update');
		Route::get('/delete/{id}', 'CategoryController@deleteCategory')->name('superadmin.category.delete');

	});
	// Sub Categories
	Route::group(['prefix' => 'subsections'], function () {
		Route::get('/list', 'CategoryController@allsubCategoryList')->name('superadmin.subcategory.list');
		Route::get('/add', 'CategoryController@addSubCategory')->name('superadmin.subcategory.add');
		Route::post('/save', 'CategoryController@saveSubCategory')->name('superadmin.subcategory.save');
		Route::get('/edit/{id}', 'CategoryController@editSubCategory')->name('superadmin.subcategory.edit');
		Route::post('/update', 'CategoryController@updateSubCategory')->name('superadmin.subcategory.update');
		Route::get('/delete/{id}', 'CategoryController@deleteSubCategory')->name('superadmin.subcategory.delete');

	});
	
	
	// Service Package
	Route::group(['prefix' => 'service-package'], function () {
		Route::get('/list', 'ServicePackageController@index')->name('superadmin.service-package');
		Route::get('/add', 'ServicePackageController@servicepackageAdd')->name('superadmin.service-package.add');
		Route::post('/save', 'ServicePackageController@servicepackageSave')->name('superadmin.service-package.save');
		Route::get('/edit/{id}', 'ServicePackageController@servicepackageEdit')->name('superadmin.service-package.edit');
		Route::post('/update', 'ServicePackageController@servicepackageUpdate')->name('superadmin.service-package.update');
		Route::get('/delete/{id}', 'ServicePackageController@servicepackageDelete')->name('superadmin.service-package.delete');


		Route::get('/features/{id?}', 'ServicePackageController@servicepackageFeature')->name('superadmin.service-package.features');
		Route::get('/feature/add', 'ServicePackageController@servicepackageFeatureAdd')->name('superadmin.service-package.features.add');
		Route::post('/feature/save', 'ServicePackageController@servicepackageFeatureSave')->name('superadmin.service-package.features.save');
		Route::get('/feature/edit/{id}', 'ServicePackageController@servicepackageFeatureEdit')->name('superadmin.service-package.features.edit');
		Route::post('/feature/update', 'ServicePackageController@servicepackageFeatureUpdate')->name('superadmin.service-package.features.update');
		Route::get('/feature/delete/{id}', 'ServicePackageController@servicepackageFeatureDelete')->name('superadmin.service-package.features.delete');
		
		Route::get('/transactions', 'ServicePackageController@servicepackageTransaction')->name('superadmin.service-package.transactions');
	});

	// Subscriptions
	Route::group(['prefix' => 'subscriptions'], function () {
		
		// customers
		Route::get('/customers/list', 'SubscriptionController@customerSubscriptionList')->name('superadmin.subscriptions.clients.list');
		Route::get('/customers/settings/{id}', 'SubscriptionController@customerSubscriptionSettings')->name('superadmin.subscriptions.clients.settings');
		Route::get('/customers/logs/{id}', 'SubscriptionController@customerSubscriptionLogs')->name('superadmin.subscriptions.clients.logs');
		
		// garage
		Route::get('/garages/list', 'SubscriptionController@garageSubscriptionList')->name('superadmin.subscriptions.garages.list');
		Route::get('/garages/settings/{id}', 'SubscriptionController@garageSubscriptionSettings')->name('superadmin.subscriptions.garages.settings');
		Route::get('/garages/logs/{id}', 'SubscriptionController@garageSubscriptionLogs')->name('superadmin.subscriptions.garages.logs');
		Route::post('/garages/update-status', 'SubscriptionController@garageSubscriptionUpdateStatus')->name('superadmin.subscriptions.garages.update-status');
		
		Route::post('/update-status', 'SubscriptionController@updateStatus')->name('superadmin.subscriptions.update-status');
		Route::post('/cancel-subscription', 'SubscriptionController@cancelSubscription')->name('superadmin.subscriptions.cancel-subscription');

	});

	//Service Request
	Route::group(['prefix' => 'service-request'], function () {
		Route::get('/lists', 'ServiceRequestController@list')->name('superadmin.service-requests');
		Route::get('/view/{id}', 'ServiceRequestController@view')->name('superadmin.service-requests.view');
	});
	
	
	//General Settings
	Route::group(['prefix' => 'general-settings'], function () {

		Route::get('/', 'GeneralSettingController@setting')->name('superadmin.general-settings');
		Route::post('/', 'GeneralSettingController@updateSetting')->name('superadmin.general-settings.update');

	});

	Route::group(['prefix' => 'vehicles'], function () {
		// Vehicle Make
		Route::get('/vehicle-make', 'GeneralSettingController@vehicleMake')->name('superadmin.settings.vehicle-make');
		Route::get('/vehicle-make/add', 'GeneralSettingController@addVehicleMake')->name('superadmin.settings.vehicle-make.add');
		Route::post('/vehicle-make/save', 'GeneralSettingController@saveVehicleMake')->name('superadmin.settings.vehicle-make.save');
		Route::get('/vehicle-make/edit/{id}', 'GeneralSettingController@editVehicleMake')->name('superadmin.settings.vehicle-make.edit');
		Route::post('/vehicle-make/update', 'GeneralSettingController@updateVehicleMake')->name('superadmin.settings.vehicle-make.update');
		Route::get('/vehicle-make/delete/{id}', 'GeneralSettingController@deleteVehicleMake')->name('superadmin.settings.vehicle-make.delete');
		
		// Vehicle Modal
		Route::get('/vehicle-modal', 'GeneralSettingController@vehicleModal')->name('superadmin.settings.vehicle-modal');
		Route::get('/vehicle-modal/add', 'GeneralSettingController@addVehicleModal')->name('superadmin.settings.vehicle-modal.add');
		Route::post('/vehicle-modal/save', 'GeneralSettingController@saveVehicleModal')->name('superadmin.settings.vehicle-modal.save');
		Route::get('/vehicle-modal/edit/{id}', 'GeneralSettingController@editVehicleModal')->name('superadmin.settings.vehicle-modal.edit');
		Route::post('/vehicle-modal/update', 'GeneralSettingController@updateVehicleModal')->name('superadmin.settings.vehicle-modal.update');
		Route::get('/vehicle-modal/delete/{id}', 'GeneralSettingController@deleteVehicleModal')->name('superadmin.settings.vehicle-modal.delete');
	});
	

	Route::group(['prefix' => 'settings'], function () {
		
		// Commissions
		Route::get('/commissions', 'GeneralSettingController@commission')->name('superadmin.settings.commissions');
		Route::post('/commissions', 'GeneralSettingController@updateCommission')->name('superadmin.settings.commissions.update');

	});

	
	Route::group(['prefix' => 'pages'], function () {
		
		// Multiple Pages 
		Route::get('/about-us', 'PageController@aboutUs')->name('superadmin.pages.aboutus');
		Route::get('/terms-conditions', 'PageController@termsConditions')->name('superadmin.pages.termsconditions');
		Route::get('/privacy-policy', 'PageController@privacyPolicy')->name('superadmin.pages.privacy-policy');
		Route::post('/upadte-page-content', 'PageController@updatePageContent')->name('superadmin.pages.update.content');
		
		// contact-us
		Route::get('/contact-us', 'PageController@contactUs')->name('superadmin.pages.contactus');
		Route::post('/contact-us', 'PageController@updateContactUs')->name('superadmin.pages.contactus.update');

		// faq
		Route::get('/faq/list', 'PageController@faq')->name('superadmin.pages.faq');
		Route::get('/faq/add', 'PageController@faqAdd')->name('superadmin.pages.faq.add');
		Route::post('/faq/save', 'PageController@faqSave')->name('superadmin.pages.faq.save');
		Route::get('/faq/edit/{id}', 'PageController@faqEdit')->name('superadmin.pages.faq.edit');
		Route::post('/faq/update', 'PageController@faqUpdate')->name('superadmin.pages.faq.update');

		// testimonial
		Route::get('/testimonial/list', 'PageController@testimonial')->name('superadmin.pages.testimonial');
		Route::get('/testimonial/add', 'PageController@testimonialAdd')->name('superadmin.pages.testimonial.add');
		Route::post('/testimonial/save', 'PageController@testimonialSave')->name('superadmin.pages.testimonial.save');
		Route::get('/testimonial/edit/{id}', 'PageController@testimonialEdit')->name('superadmin.pages.testimonial.edit');
		Route::post('/testimonial/update', 'PageController@testimonialUpdate')->name('superadmin.pages.testimonial.update');

		// Seo
		Route::get('/seo', 'PageController@pageSeo')->name('superadmin.pages.seo');
		Route::get('/seo/add', 'PageController@addPageSeo')->name('superadmin.pages.seo.add');
		Route::post('/seo/add', 'PageController@savePageSeo')->name('superadmin.pages.seo.save');
		Route::get('/seo/edit/{id}', 'PageController@editPageSeo')->name('superadmin.pages.seo.edit');
		Route::post('/seo/update', 'PageController@upadtePageSeo')->name('superadmin.pages.seo.update');
		Route::get('/seo/delete/{id}', 'PageController@deletePageSeo')->name('superadmin.pages.seo.delete');

	});

	// Garages
	Route::group(['namespace' => '\Modules\Admin\Http\Controllers','prefix' => 'garage'], function () {

		
		Route::get('active/list', 'GarageController@activeGarages')->name('superadmin.garages.active');
		Route::get('pending/list', 'GarageController@pendingGarages')->name('superadmin.garages.pending');
		Route::get('delete/list', 'GarageController@deleteGarages')->name('superadmin.garages.delete');

		Route::get('add', 'GarageController@add')->name('superadmin.garage.add');
		Route::post('save', 'GarageController@save')->name('superadmin.garage.save');
		Route::get('/edit/{id}', 'GarageController@edit')->name('superadmin.garage.edit');
		Route::post('update', 'GarageController@update')->name('superadmin.garage.update');


		Route::get('detail/view/{id}', 'GarageController@viewGarageDetail')->name('superadmin.garage.detail.view');
		Route::post('detail/update', 'GarageController@updateGarageDetail')->name('superadmin.garage.detail.update');

		Route::get('working-hour/view/{id}', 'GarageController@viewGarageWorkingHours')->name('superadmin.garage.working-hours.view');
		Route::post('working-hour/update', 'GarageController@updateGarageWorkingHours')->name('superadmin.garage.working-hours.update');

		Route::get('services/view/{id}', 'GarageController@viewGarageServices')->name('superadmin.garage.services.view');
		Route::post('services/update', 'GarageController@updateGarageServices')->name('superadmin.garage.services.update');

		
		Route::get('members/view/{id}', 'GarageController@viewGarageTeam')->name('superadmin.garage.team.view');
		Route::post('members/update', 'GarageController@updateGarageTeam')->name('superadmin.garage.team.update');
		Route::get('members/delete/{id}', 'GarageController@deleteGarageTeam')->name('superadmin.garage.team.delete');
		
		Route::get('images/view/{id}', 'GarageController@viewGarageImage')->name('superadmin.garage.image.view');
		Route::post('images/update', 'GarageController@updateGarageImage')->name('superadmin.garage.image.update');
		Route::get('images/delete/{id}', 'GarageController@deleteGarageImage')->name('superadmin.garage.image.delete');
		
		Route::get('videos/view/{id}', 'GarageController@viewGarageVideo')->name('superadmin.garage.video.view');
		Route::post('videos/update', 'GarageController@updateGarageVideo')->name('superadmin.garage.video.update');
		Route::get('videos/delete/{id}', 'GarageController@deleteGarageVideo')->name('superadmin.garage.video.delete');
		
		Route::get('package/view/{id}', 'GarageController@viewGaragePackage')->name('superadmin.garage.package.view');
		Route::post('package/update', 'GarageController@updateGaragePackage')->name('superadmin.garage.package.update');
		
		Route::get('invoice/view/{id}', 'GarageController@viewGarageInvoice')->name('superadmin.garage.invoice.view');
		Route::post('invoice/update', 'GarageController@updateGarageInvoice')->name('superadmin.garage.invoice.update');
		
	});

	

	// transactions
	Route::get('/transactions/customers/package-subscription', 'TransactionController@customers_package_subscription')->name('superadmin.transactions.customers_package_subscription');
	Route::get('/transactions/customers/service-request', 'TransactionController@customers_service_request')->name('superadmin.transactions.customers_service_request');
	Route::get('/transactions/garages/package-subscription', 'TransactionController@garages_package_subscription')->name('superadmin.transactions.garages_package_subscription');

	// Language Switcher...
	//Route::get('/languages/{lang}', 'LanguageController@index')->name('superadmin.languages.list');
	//Route::post('/languages/save', 'LanguageController@saveTranslations')->name('superadmin.languages.save');

	Route::get('/logout', 'LoginController@logout')->name('superadmin.logout');
	Route::get('/dashboard', 'AdminController@index')->name('superadmin.dashboard');

	// profiles
	Route::group(['prefix' => 'profile'], function () {
		Route::get('/view-profile', 'AdminController@viewProfile')->name('superadmin.view-profile');
		Route::get('/change-password', 'AdminController@changePassword')->name('superadmin.change-password');
		Route::post('/update-password', 'AdminController@updatePassword')->name('superadmin.update-password');
	});
	

});

});

// Roles
	/*Route::get('/roles', 'AdminController@getAllUserRoles')->name('superadmin.roles');
	Route::get('/role/add', 'AdminController@addUserRole')->name('superadmin.role.add');
	Route::post('/role/edit/save', 'AdminController@createNewUserRole')->name('superadmin.role.save');
	Route::get('/role/edit/{id}', 'AdminController@editUserRole')->name('superadmin.role.edit');
	Route::post('/role/edit/update', 'AdminController@updateUserRole')->name('superadmin.role.update');
	Route::get('/role/delete/{id}', 'AdminController@setUserRoleDelete')->name('superadmin.role.delete');
	Route::get('/roles/assign-user', 'AdminController@assignRoleToUser')->name('superadmin.role.assign-user.add');
	Route::post('/roles/assign-user', 'AdminController@updateAssignRoleToUser')->name('superadmin.role.assign-user.save');
	*/
//Users
	/*Route::get('/users/active/list', 'UserController@activeUserList')->name('superadmin.users.active');
	Route::get('/users/delete/list', 'UserController@deleteUserList')->name('superadmin.users.delete');
	Route::get('/users/pending/list', 'UserController@pendingUserList')->name('superadmin.users.pending');
	Route::get('/user/add', 'UserController@addUser')->name('superadmin.user.add');
	Route::post('/user/save', 'UserController@saveUser')->name('superadmin.user.save');
	Route::get('/user/edit/{id}', 'UserController@editUser')->name('superadmin.user.edit');
	Route::post('/user/update', 'UserController@updateUser')->name('superadmin.user.update');
	Route::get('/user/change-password/{id}', 'UserController@changeUserPassword')->name('superadmin.user.change-password');
	Route::post('/user/update/password', 'UserController@updateUserPassword')->name('superadmin.user.update-password');
	Route::get('/user/change-status/{id}', 'UserController@changeUserStatus')->name('superadmin.user.change-status');
	Route::post('/user/update/status', 'UserController@updateUserStatus')->name('superadmin.user.update-status');*/


	/*
	
	// Clients
	Route::group(['prefix' => 'clients'], function () {
		Route::get('/active/list', 'ClientController@activeClientList')->name('superadmin.clients.active-list');
		Route::get('/delete/list', 'ClientController@deletedClientList')->name('superadmin.clients.delete-list');
		Route::get('/pending/list', 'ClientController@pendingClientList')->name('superadmin.clients.pending-list');
		
		Route::post('/update-image', 'ClientController@updateClientImage')->name('superadmin.client.update-image');
		
		Route::get('/details/{action}/{id}', 'ClientController@clientDetails')->name('superadmin.client.details');
		Route::post('/update', 'ClientController@update')->name('superadmin.client.update');
		
		Route::get('/add', 'ClientController@add')->name('superadmin.client.add');
		Route::post('/save', 'ClientController@save')->name('superadmin.client.save');

		Route::get('/view/{id}', 'ClientController@viewClient')->name('superadmin.client.details.view');
		Route::post('/status/update', 'ClientController@clientStatusUpdate')->name('superadmin.client.status.update');
		
	});*/


