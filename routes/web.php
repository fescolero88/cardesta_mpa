<?php

Route::get('/', 'HomeController@index')->name('home');

Route::get('/inventory/{dealername?}/{id?}/{zip?}', 'HomeController@car_list')->name('list');
//Route::get('/getmake', 'HomeController@getmodelbymake')->name('getmodelbymake');
Route::get('/gettab', 'HomeController@gettab')->name('gettab');
Route::get('/getmake', 'HomeController@getmake')->name('getmake');
Route::get('/getMarketValue/{vin}/{sellingprice}', 'InventoryController@getMarketValue');
Route::get('/gettrialClientStatus/{dealer_id}', 'InventoryController@gettrialClientStatus');
//Route::get('/getDeal/{vin}', 'InventoryController@getDeal');
Route::namespace('Frontend')->prefix('frontend')->name('frontend.')->group(function () {

    Route::post('/get-trading-value', 'InventoryController@requestTradingValue')->name('request-trading-value');
    Route::post('/check-availability', 'InventoryController@requestVehicleAvailability')->name('request-availability');
    Route::post('/get-lowest-price', 'InventoryController@requestTodayBestPrice')->name('request-lowest-price');
});

Route::get('/dealers', 'HomeController@dealerList')->name('dealerlist');

Route::get('/car/{make}/{model}/{city}/{dealername}/{vin}', 'HomeController@listDetails')->name('list_details');

Route::get('/{id}/details', 'HomeController@listDetails')->name('list_details_ajax');

Route::post('/customer-request', 'HomeController@customerRequest')->name('customerrequest');

Route::post('/phone-enquiry', 'HomeController@phoneEnquiry')->name('phone-enquiry');

Route::get('/getcloserproduct', 'HomeController@getCloserProduct')->name('getcloserproduct');

Route::get('/about-us', 'HomeController@aboutUs')->name('aboutus');
Route::get('/privacy-policy', 'HomeController@privacyPolicy')->name('privacypolicy');
Route::get('/contact-us', 'HomeController@contactUs')->name('contactus');

Route::post('/getmodel', 'HomeController@ajaxGetModel')->name('getmodel');

Route::post('/save-contact-us', 'HomeController@saveContactUs')->name('savecontactus');

Route::get('/searchby_dealername', 'HomeController@searchDealer')->name('searchby_dealername');

//
Auth::routes();


Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/', 'AdminController@index');

    //dealer
    Route::any('/dealers', 'DealerController@index')->name('dealers');
    Route::get('/adddealerform', 'DealerController@create')->name('adddealerform');
    Route::post('/adddealer', 'DealerController@store')->name('adddealer');
    Route::get('/edit-dealer/{id}', 'DealerController@edit')->name('editdealerform');
    Route::post('/edit-dealer', 'DealerController@update')->name('editdealer');
    Route::get('/delete-dealer/{id}', 'DealerController@destroy')->name('deletedealer');
    Route::get('/adddealerthroughapi', 'DealerController@addDealerThroughApi');

    //inventory
    Route::get('/inventories', 'InventoryController@index')->name('inventories');
    Route::any('/import-csv', 'InventoryController@csvImport')->name('import-csv');
    Route::post('/ajaxfilecheck', 'InventoryController@ajaxFileCheck')->name('ajaxfilecheck');
    Route::get('/product-data', 'InventoryController@getInventory')->name('datatables.data');
    Route::get('/dealer-details/{id}', 'InventoryController@dealerDetails')->name('dealer-details');
    Route::post('/getmorecontent', 'InventoryController@getMoreContent')->name('getmorecontent');
    Route::get('/feactured-image', 'InventoryController@feacturedImage')->name('feactured-image');
    Route::get('/marketcheck-import', 'InventoryController@marketCheckImport')->name('marketcheck-import');
    Route::post('/import-inventory', 'InventoryController@marketImportInventory')->name('import-inventory');
    Route::post('/process-inventory', 'InventoryController@processInventory')->name('process-inventory');
    Route::get('/site-settings', 'InventoryController@siteSettings')->name('site-settings');
    Route::post('/save-settings', 'InventoryController@saveSiteSettings')->name('save-settings');
    Route::post('/upload-feactured-image', 'InventoryController@uploadFeacturedImage')->name('upload-feactured-image');
});

