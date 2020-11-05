<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

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

Route::prefix('panel')->middleware('auth')->namespace('Admin')->as('panel.')->group(function () {
    Route::post('/upload-image','indexController@uploadImageSubject');
    Route::get('/', 'IndexController@dashboard')->name('dashboard');
    Route::resource('categories', 'CategoryController');
    Route::resource('categories/{category}/properties', 'PropertyController');
    Route::resource('categories/{category}/properties/{property}/propertyDefaults', 'PropertyDefaultController');

    Route::group(['middleware' => ['permission:panel.permissions.update']], function () {
        Route::post('permissions/give-permission-to-role', 'PermissionController@givePermissionToRole');
        Route::post('permissions/revoke-permission-to-role', 'PermissionController@revokePermissionToRole');
    });

//    Route::group(['middleware' => ['permission:panel.medias']], function () {
//        Route::post('uploads/store', 'UploadController@store')->name('medias.create');
//        Route::get('uploads/all/{collection?}', 'UploadController@all');
//        Route::get('uploads/collectionsNames', 'UploadController@collectionsNames');
//        Route::post('uploads/clear', 'UploadController@clear')->name('medias.delete');
//        Route::get('medias', 'UploadController@index')->name('medias');
//        Route::get('uploads/clear-all', 'UploadController@clearAll');
//    });

    Route::group(['middleware' => ['permission:panel.app-settings']], function () {
        Route::prefix('settings')->group(function () {
            Route::resource('permissions', 'PermissionController');
            Route::resource('roles', 'RoleController');
            Route::post('users/remove-media', 'UserController@removeMedia');
            Route::resource('users', 'UserController');
            Route::resource('config', 'ConfigController');
        });

    });

    Route::get('products/my_products', 'ProductController@my_products')->name('products.my_products');
    Route::resource('products', 'ProductController');
    Route::get('products/{product}/properties', 'ProductController@get_properties')->name('products.properties.index');
    Route::post('products/{product}/properties', 'ProductController@store_properties')->name('products.properties.store');

    Route::get('products/{product}/images', 'ProductController@product_images')->name('products.images.index');
    Route::post('products/{product}/images', 'ProductController@store_image')->name('products.images.store');
    Route::delete('products/{product}/images/{image}', 'ProductController@delete_image')->name('products.images.destroy');
    Route::patch('products/{product}/images/{image}/setDefault', 'ProductController@set_default_image');

    Route::post('orders/{order}/sponsor', 'OrderController@pay_leftOver_price');
    Route::post('orders/{order}/sponsor/fromWallet', 'OrderController@pay_leftOver_price_from_wallet');
    Route::resource('orders', 'OrderController');
    Route::patch('orders/{order}/sendStatus/update', 'OrderController@sendStatusUpdate')->name('orders.send_status.update');
    Route::patch('orders/{order}/status/update', 'OrderController@cancelOrder')->name('orders.cancel');

    Route::resource('mainSliders', 'MainSliderController');
    Route::resource('brands', 'BrandController');
    Route::resource('categoryInAds', 'CategoryInAdController');
    Route::resource('{product}/productAdminReviews', 'ProductAdminReviewController');

    Route::resource('imageAds', 'ImageAdController');

    Route::resource('cities', 'CityController');

    Route::resource('sendTypes', 'SendTypeController');

    Route::get('configs', 'ConfigController@index')->name('configs.index');
    Route::patch('configs', 'ConfigController@update')->name('configs.update');

    Route::resource('faqCategories', 'FaqCategoryController');
    Route::resource('faqCategories/{faqCategory}/faqs', 'FaqController');

    Route::resource('pages', 'PageController');

    Route::resource('blogCategories', 'BlogCategoryController');
    Route::resource('blogs', 'BlogController');

    Route::resource('productReviews', 'ProductReviewController');
    Route::resource('productQuestions', 'ProductQuestionController');

    Route::get('footer_details', 'FooterDetailController@index')->name('footer_details.index');
    Route::patch('footer_details', 'FooterDetailController@update')->name('footer_details.update');

    Route::resource('footerAds', 'FooterAdController');
    Route::resource('footerLicenses', 'FooterLicenseController');
    Route::resource('footerSocials', 'FooterSocialController');

    Route::resource('collaborators', 'CollaboratorController');
});



//Route::get('/', function () {
//    return view('home');
//});

//Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/storage_link', function () {
    Artisan::call('storage:link');
    return 'done';
});
