<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::namespace('Api\v1')->prefix('v1')->group(function () {
    Route::get('/index', 'IndexController@index');
    Route::get('/product/{product_id}', 'ProductController@get_info');
    Route::get('/product/{product_id}/reviews', 'ProductController@get_reviews');
    Route::post('/product/{product_id}/reviews/store', 'ProductController@set_reviews')->middleware('auth:api');
    Route::get('/categories', 'CategoryController@get_info');
    Route::get('/categories/{category_id}', 'CategoryController@get_details');

    Route::group(['prefix' => 'auth'], function () {
        Route::post('sendCode', 'AuthController@send_code');
        Route::post('login', 'AuthController@login');
        Route::post('register', 'AuthController@register');
        Route::post('logout', 'AuthController@logout');
        Route::post('refresh', 'AuthController@refresh');
        Route::post('me', 'AuthController@me');
    });

    Route::group(['middleware' => 'auth:api'], function () {

//        Route::get('/getUserBasket', 'UserController@carts');
        Route::post('/addToBasket', 'UserController@add_basket');
        Route::post('/deleteFromBasket', 'UserController@delete_basket');
        Route::post('/stepUp', 'UserController@StepUp');
        Route::post('/stepDown', 'UserController@StepDown');

        Route::resource('/userAddresses', 'AddressController');
        Route::get('/shopping', 'ShoppingController@index');
        Route::post('/getBasket', 'ShoppingController@getBasket');
        Route::post('/checkMyNeedyStatus', 'ShoppingController@check_needy');
        Route::post('/setOrder','OrderController@setOrder');
    });

    Route::post('/carts', 'UserController@carts');
    Route::get('/cities', 'IndexController@getCities');

    Route::group(['prefix' => 'profile','middleware'=>'auth:api'], function () {
        //favorites
        Route::get('/favorites', 'FavoriteController@index');
        Route::post('/favorites/{product_id}', 'FavoriteController@actionFavorites');

        Route::get('/additional_info', 'UserController@additional_info');
        Route::post('/additional_info/edit', 'UserController@additional_info_update');

        Route::get('/orders', 'OrderController@orders');
        Route::get('/orders/{order}', 'OrderController@getOrder');

        Route::get('/reviews', 'UserController@user_reviews');
        Route::delete('/reviews/{review}/destroy', 'UserController@user_reviews_delete');
    });

    Route::post('product/getList','SearchController@product_getList');
    Route::get('category/getFilter/{cat_id}','SearchController@category_getFilter');
});
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
