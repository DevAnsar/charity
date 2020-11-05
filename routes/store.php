<?php

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
Route::namespace('Store')->group(function () {
    Route::get('/', 'IndexController@index')->name('site.index');
    Route::get('/product/{slug}', 'ProductController@get_info')->name('site.product');
    Route::post('/product/{product}/getFavorite', 'ProductController@get_favorite');

    Route::get('/getUserBasket', 'UserController@get_basket');
    Route::post('/addToBasket', 'UserController@add_basket');
    Route::post('/deleteFromBasket', 'UserController@delete_basket');
//    Route::post('/setBasket', 'UserController@setBasket');

    Route::get('/cart', 'CartController@get_cart')->name('site.cart');
    Route::get('/getCart', 'CartController@get_cart_details');
    Route::post('/setUp', 'CartController@StepUp');
    Route::post('/setDown', 'CartController@StepDown');

    Route::get('/product-reviews/{slug}', 'ProductController@getReviewForm')->name('site.products.reviews.get');
    Route::post('/product-reviews/{slug}', 'ProductController@getReviewStore')->name('site.products.reviews.send');

    Route::post('/product-question/{product}', 'ProductController@getQuestionStore')->name('site.products.questions.send');
    Route::post('/product-question/{product}/reply/{productQuestion}', 'ProductController@getReplyStore')
        ->name('site.products.questions.reply');

    Route::group(['prefix' => 'profile','as'=>'site.'], function () {
        Route::get('/', 'ProfileController@index')->name('profile.index');
        Route::get('/orders', 'ProfileController@orders')->name('profile.orders');
        Route::get('/orders/{order}', 'ProfileController@orders_show')->name('profile.orders.show');
        Route::patch('/orders/{order}/send_type/update', 'ProfileController@orders_send_type_update')->name('profile.orders.send_type.update');

        //address
        Route::get('/address', 'ProfileController@get_address')->name('profile.addresses');
        Route::post('/address', 'ProfileController@addNewAddress')->name('profile.addresses.new');
        Route::delete('/address/{user_address}/delete', 'ProfileController@address_delete');
        Route::patch('/address/{user_address}/update', 'ProfileController@address_update');

        //favorites
        Route::get('/favorites', 'ProfileController@get_favorites')->name('profile.favorites');
        Route::delete('/favorites/{favorite}/delete', 'ProfileController@favorites_delete')->name('profile.favorites.destroy');

        Route::get('/additional-info', 'ProfileController@get_additional_info')->name('profile.edit');
        Route::patch('/additional-info/update', 'ProfileController@additional_info_update')->name('profile.update');

        Route::get('/comments', 'ProfileController@comments')->name('profile.comments');
        Route::delete('/comments/{productReview}/delete', 'ProfileController@comments_destroy')->name('profile.comments.destroy');
    });

    //Auth
    Route::get('/login', 'UserController@showLoginForm')->name('site.login');
    Route::post('/send_code', 'UserController@send_code');
    Route::post('/login', 'UserController@login');
    Route::post('/logout', 'UserController@logout')->name('site.logout');
    Route::get('/register', 'UserController@showLoginForm')->name('site.register');
    Route::post('/register', 'UserController@register');
    //

    //shopping
    Route::get('/shopping', 'ShoppingController@index')->middleware('auth')->name('site.shopping');
    Route::post('/add-address', 'ShoppingController@addNewAddress');
    Route::delete('/remove-address/{address_id}', 'ShoppingController@RemoveAddress');
    Route::post('/change-address', 'ShoppingController@changeAddress');
    Route::post('/change-send-type', 'ShoppingController@changeSendType');
    Route::get('/get_state', 'ShoppingController@get_province');
    Route::get('/get_city/{state_id}', 'ShoppingController@get_city');

    //payments
    Route::get('/payment', 'PaymentController@index')->middleware(['auth','paymentCheck']);
    Route::get('/get-pay', 'PaymentController@getPay')->middleware(['auth','paymentCheck'])->name('site.get-pay');
    Route::get('/callback/zarin', 'PaymentController@zarin_chacker')->name('site.callback.zarin');
    Route::post('/checkMyNeedyStatus', 'PaymentController@check_needy');
    Route::post('/deleteMyNeedySession', 'PaymentController@delete_needy_session');
    Route::get('/get-pay-again/{order}', 'PaymentController@getPayAgain')->middleware(['auth'])->name('site.get-pay-again');

    //faqs
    Route::get('/faq', 'FaqController@index')->name('site.faq.index');
    Route::get('/faq/category/{faqCategory}', 'FaqController@getCategory')->name('site.faq.category');
    Route::get('/faq/question/{faq}', 'FaqController@getQuestion')->name('site.faq.question');

    //pages
    Route::get('/page/{slug}', 'PageController@page_show')->name('site.pages.show');

    //blog
    Route::get('/blog', 'BlogController@index')->name('site.blog.index');
    Route::get('/blog/get/{slug}', 'BlogController@show')->name('site.blog.show');

    //search
    Route::get('/search', 'SearchController@search_product')->name('site.search');
    Route::get('getProduct/search','SearchController@get_search_product');
    Route::get('/search/{category_slug}','SearchController@cat_product')->name('site.getCat');
    Route::get('getProduct/search/{category_slug}','SearchController@get_cat_product');


//    app payment
    Route::get('/app/order/{order}/payment', 'PaymentController@app_payment')->middleware('auth:api');
    Route::get('/app/callback/zarin', 'PaymentController@app_zarin_chacker')->name('site.app_callback.zarin');


    Route::get('/collaborator', 'IndexController@collaborator')->name('site.collaborator.index');
    Route::post('/collaborator/create', 'IndexController@collaborator_create')->name('site.collaborator.create');

});
