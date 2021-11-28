<?php

use App\Http\Controllers\Frontend\SslCommerzPaymentController;
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

Route::group(['namespace' => 'App\Http\Controllers'], function () {
    Route::group(['namespace' => 'Backend'], function () {

        Route::group(['prefix' => 'admin'], function () {
            Route::get('login', [
                'as' => 'backend.admin.login',
                'uses' => 'AuthControllers\LoginController@getLogin'
            ]);
            Route::post('login', [
                'as' => 'backend.admin.login',
                'uses' => 'AuthControllers\LoginController@postLogin'
            ]);
            Route::get('forgot-password', [
                'as' => 'backend.admin.forgot.password',
                'uses' => 'AuthControllers\LoginController@getForgotPassword'
            ]);

            Route::group(['middleware' => ['admin']], function () {
                Route::get('/', [
                    'as' => 'backend.admin.dashboard',
                    'uses' => 'DashboardController@showDashboard'
                ]);
                Route::any('logout', [
                    'as' => 'backend.admin.logout',
                    'uses' => 'AuthControllers\LogoutController@getLogout'
                ]);
                Route::get('profile', [
                    'as' => 'backend.admin.profile.show',
                    'uses' => 'ProfileController@showProfile'
                ]);
                Route::get('profile/edit', [
                    'as' => 'backend.admin.profile.edit',
                    'uses' => 'ProfileController@editProfile'
                ]);
                Route::post('profile/edit', [
                    'as' => 'backend.admin.profile.edit',
                    'uses' => 'ProfileController@editProfileFormSubmit'
                ]);
                Route::get('customer/list', [
                    'as' => 'backend.admin.customer.list',
                    'uses' => 'CustomerController@showCustomerList'
                ]);

                Route::get('system-settings', [
                    'as' => 'backend.admin.system-settings.show',
                    'uses' => 'SystemSettingsController@showSystemSettings'
                ]);
                Route::get('system-settings/edit', [
                    'as' => 'backend.admin.system-settings.edit',
                    'uses' => 'SystemSettingsController@editSystemSettings'
                ]);
                Route::post('system-settings/edit', [
                    'as' => 'backend.admin.system-settings.edit',
                    'uses' => 'SystemSettingsController@editSystemSettingsFormSubmit'
                ]);
                Route::get('page/about-us', [
                    'as' => 'backend.admin.page.about-us.show',
                    'uses' => 'AboutUsPageController@showPageContent'
                ]);
                Route::get('page/about-us/edit', [
                    'as' => 'backend.admin.page.about-us.edit',
                    'uses' => 'AboutUsPageController@editPageContent'
                ]);
                Route::post('page/about-us/edit', [
                    'as' => 'backend.admin.page.about-us.edit',
                    'uses' => 'AboutUsPageController@updatePageContent'
                ]);
                Route::get('page/contact-us', [
                    'as' => 'backend.admin.page.contact-us.show',
                    'uses' => 'ContactUsPageController@showPageContent'
                ]);
                Route::get('page/contact-us/edit', [
                    'as' => 'backend.admin.page.contact-us.edit',
                    'uses' => 'ContactUsPageController@editPageContent'
                ]);
                Route::post('page/contact-us/edit', [
                    'as' => 'backend.admin.page.contact-us.edit',
                    'uses' => 'ContactUsPageController@updatePageContent'
                ]);

                /*order process route start*/
                Route::get('pending-order-list', [
                    'as' => 'backend.admin.order.pending-list',
                    'uses' => 'OrderController@showPendingOrderList'
                ]);
                Route::get('pending-order-details/{order_id}', [
                    'as' => 'backend.admin.order.pending-order.show',
                    'uses' => 'OrderController@showPendingOrderDetails'
                ]);
                Route::get('pending-order-details/reject/{order_id}', [
                    'as' => 'backend.admin.order.pending-order.reject',
                    'uses' => 'OrderController@rejectPendingOrder'
                ]);
                Route::get('pending-order-details/accept/{order_id}', [
                    'as' => 'backend.admin.order.pending-order.accept',
                    'uses' => 'OrderController@acceptPendingOrder'
                ]);
                Route::get('order-details/{id}', [
                    'as' => 'backend.admin.order.order-details',
                    'uses' => 'OrderManagementController@showOrderDetails'
                ]);
                Route::get('accepted-order-list', [
                    'as' => 'backend.admin.order.accepted-list',
                    'uses' => 'OrderController@showAcceptedOrderList'
                ]);
                Route::get('accepted-order-details/{order_id}', [
                    'as' => 'backend.admin.order.accepted-order.show',
                    'uses' => 'OrderController@showAcceptedOrderDetails'
                ]);
                Route::post('accepted-order/{order_id}/update-delivery-status', [
                    'as' => 'backend.admin.order.accepted-order.update-delivery-status',
                    'uses' => 'OrderController@updateDeliveryStatus'
                ]);
                Route::get('completed-order-list', [
                    'as' => 'backend.admin.order.completed-list',
                    'uses' => 'OrderController@showCompletedOrderList'
                ]);
                Route::get('completed-order-details/{order_id}', [
                    'as' => 'backend.admin.order.completed-order.show',
                    'uses' => 'OrderController@showCompletedOrderDetails'
                ]);
                Route::get('rejected-order-list', [
                    'as' => 'backend.admin.order.rejected-list',
                    'uses' => 'OrderController@showRejectedOrderList'
                ]);
                Route::get('rejected-order-details/{order_id}', [
                    'as' => 'backend.admin.order.rejected-order.show',
                    'uses' => 'OrderController@showRejectedOrderDetails'
                ]);
                /*order process route end*/

                /*administrator user resource routes*/
                Route::group(['as' => 'backend.admin.'], function () {
                    /*Route::resource('administrator', 'AdministratorController');*/
                    Route::resource('customer', 'CustomerController');
                    /*Route::resource('slider', 'SliderController');*/

                    Route::post('products/get-sub-categories-by-category', [
                        'as' => 'products.get-sub-categories-by-category',
                        'uses' => 'Product\ProductsController@getSubCategoriesByCategory'
                    ]);

                    Route::resource('products', 'Product\ProductsController');

                    Route::group(['as' => 'product.', 'prefix' => 'product', 'namespace' => 'Product'], function () {
                        Route::resource('category', 'ProductCategoryController');
                        Route::resource('color', 'ProductColorController');

                        Route::post('stock/get-create-partial-form', [
                            'as' => 'stock.get-create-partial-form',
                            'uses' => 'ProductStockController@getCreatePartialForm'
                        ]);
                        Route::post('stock/get-products-by-category', [
                            'as' => 'stock.get-products-by-category',
                            'uses' => 'ProductStockController@getProductsByCategory'
                        ]);
                        Route::post('stock/get-product-size-color', [
                            'as' => 'stock.get-product-size-color',
                            'uses' => 'ProductStockController@getProductSizeColors'
                        ]);

                        Route::get('stock/stock-list', [
                            'as' => 'stock.stock-list',
                            'uses' => 'ProductStockController@index'
                        ]);
                        Route::resource('stock', 'ProductStockController');
                        Route::get('stock/{stock}/edit',[
                            'as'=>'stock.edit',
                        'uses'=>'ProductStockController@edit']);

                        Route::get('getstock', [
                            'as' => 'stock.getstocks',
                            'uses' => 'ProductStockController@getStockList'
                        ]);
                    });
                });

            });
        });
    });



    Route::group(['namespace' => 'Frontend'], function () {
        Route::get('/', [
            'as' => 'frontend.home',
            'uses' => 'HomeController@showHomePage'
        ]);

        Route::get('category/{category_slug}/{sub_category_slug?}', [
            'as' => 'frontend.category-products',
            'uses' => 'ProductPagesController@showCategoryProducts'
        ]);
        Route::get('search-products', [
            'as' => 'frontend.search-products',
            'uses' => 'ProductPagesController@showSearchProducts'
        ]);
        Route::get('product-details/{category}/{slug}', [
            'as' => 'frontend.product-details',
            'uses' => 'ProductPagesController@showProductDetailsPage'
        ]);
        Route::get('upcoming-product-details/{category}/{slug}', [
            'as' => 'frontend.upcoming-product-details',
            'uses' => 'ProductPagesController@showUpcomingProductDetailsPage'
        ]);


        /*start cart-routes*/
        Route::post('cart/add-to-cart', [
            'as' => 'frontend.cart.add-to-cart',
            'uses' => 'CartController@addToCart'
        ]);
        Route::post('cart/remove-cart', [
            'as' => 'frontend.cart.remove-cart',
            'uses' => 'CartController@removeCart'
        ]);
        Route::post('cart/get-cart-content', [
            'as' => 'frontend.cart.get-cart-content',
            'uses' => 'CartController@getCartContent'
        ]);
        Route::post('cart/get-top-cart-content', [
            'as' => 'frontend.cart.get-top-cart-content',
            'uses' => 'CartController@getTopCartContent'
        ]);
        Route::post('cart/remove-top-cart-content', [
            'as' => 'frontend.cart.remove-top-cart-content',
            'uses' => 'CartController@removeTopCartContent'
        ]);
        Route::post('cart/update-cart-content-quantity', [
            'as' => 'frontend.cart.update-cart-content-quantity',
            'uses' => 'CartController@updateCartContentQuantity'
        ]);
        Route::get('cart/viewcart', [
            'as' => 'frontend.viewcart',
            'uses' => 'CartController@viewcart'
        ]);
        Route::get('checkout', [
            'as' => 'frontend.checkout',
            'uses' => 'CheckoutController@showCheckout'
        ]);
        Route::post('checkout', [
            'as' => 'frontend.checkout',
            'uses' => 'CheckoutController@submitCheckout'
        ]);

        Route::get('place-pre-order/{product_id}', [
            'as' => 'frontend.place-pre-order',
            'uses' => 'CheckoutController@showPreOrderCheckout'
        ]);
        Route::post('pre-order-checkout/{product_id}', [
            'as' => 'frontend.pre-order-checkout',
            'uses' => 'CheckoutController@submitPreOrderCheckout'
        ]);
        Route::get('order/{order_id}/payment', [
            'as' => 'frontend.order.payment',
            'uses' => 'OrderPaymentController@showPaymentPage'
        ]);
        Route::post('order/{order_id}/payment', [
            'as' => 'frontend.order.payment',
            'uses' => 'OrderPaymentController@makeOrderPayment'
        ]);
        Route::post('order/payment/success', [
            'as' => 'frontend.order.payment.success',
            'uses' => 'OrderPaymentController@successPayment'
        ]);
        Route::post('order/payment/failed', [
            'as' => 'frontend.order.payment.failed',
            'uses' => 'OrderPaymentController@failedPayment'
        ]);
        Route::post('order/payment/cancel', [
            'as' => 'frontend.order.payment.cancel',
            'uses' => 'OrderPaymentController@cancelPayment'
        ]);
        Route::post('order/payment/ipn', [
            'as' => 'frontend.order.payment.ipn',
            'uses' => 'OrderPaymentController@ipnPayment'
        ]);
        /*end cart-routes*/


        Route::get('pages/about-us', [
            'as' => 'frontend.page.about-us',
            'uses' => 'PagesController@showAboutUsPage'
        ]);
        Route::get('pages/faq', [
            'as' => 'frontend.faq',
            'uses' => 'PagesController@showFaqPage'
        ]);
        Route::get('pages/privacy-and-policy', [
            'as' => 'frontend.privacy-and-policy',
            'uses' => 'PagesController@showPrivacyPage'
        ]);
        Route::get('pages/contact-us', [
            'as' => 'frontend.page.contact-us',
            'uses' => 'PagesController@showContactPage'
        ]);
        Route::get('logout', [
            'as' => 'frontend.logout',
            'uses' => 'AuthControllers\LogoutController@getLogout'
        ]);
        Route::get('login-register', [
            'as' => 'frontend.login-register',
            'uses' => 'AuthControllers\LoginController@getLogin'
        ]);

        Route::post('login', [
            'as' => 'frontend.login',
            'uses' => 'AuthControllers\LoginController@postLogin'
        ]);

        Route::post('register', [
            'as' => 'frontend.register',
            'uses' => 'AuthControllers\RegisterController@postRegister'
        ]);

        Route::get('/sign-in/github',[
            'as'=>'sign-in.github',
            'uses'=>'AuthControllers\LoginController@github'
        ]);
        Route::get('/sign-in/github/redirect',[
            'as'=>'sign-in.github.redirect',
            'uses'=>'AuthControllers\LoginController@githubRedirect'
        ]);

        Route::get('/sign-in/facebook',[
            'as'=>'sign-in.facebook',
            'uses'=>'AuthControllers\LoginController@facebook'
        ]);
        Route::get('/sign-in/facebook/redirect',[
            'as'=>'sign-in.facebook.redirect',
            'uses'=>'AuthControllers\LoginController@facebookRedirect'
        ]);
        Route::get('myorders', [
            'as' => 'frontend.user.myorders',
            'uses' => 'OrderPaymentController@myorders'
        ]);

        /*start user-profile routes*/
        Route::group(['namespace' => 'User'], function () {
            Route::get('user/profile', [
                'as' => 'frontend.user.profile',
                'uses' => 'ProfileController@showUserProfile'
            ]);
            Route::get('user/address-book', [
                'as' => 'frontend.user.address-book',
                'uses' => 'AddressBookController@showUserAddresses'
            ]);
            Route::post('user/add-address-book', [
                'as' => 'frontend.user.add-address-book',
                'uses' => 'AddressBookController@storeUserAddress'
            ]);
            Route::post('user/edit-address-book', [
                'as' => 'frontend.user.edit-address-book',
                'uses' => 'AddressBookController@storeUserAddress'
            ]);

            Route::get('user/my-orders', [
                'as' => 'frontend.user.my-orders',
                'uses' => 'OrderController@showMyOrderList'
            ]);


        });
        /*start user-profile routes*/

        /*start ajax routes*/
        Route::post('ajax/get-districts-by-division', [
            'as' => 'ajax.get-districts-by-division',
            'uses' => 'AjaxController@getDistrictsByDivision'
        ]);
        Route::post('ajax/get-upazilas-by-district', [
            'as' => 'ajax.get-upazilas-by-district',
            'uses' => 'AjaxController@getUpazilasByDistrict'
        ]);
        /*end ajax routes*/
    });
});
