<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use PHPUnit\TextUI\XmlConfiguration\Group;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

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


Auth::routes(['verify' => true]);

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');


Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/search', [App\Http\Controllers\frontend\allProductController::class, 'search'])->name('client.search');
Route::get('/product/all', [\App\Http\Controllers\frontend\allProductController::class, 'index'])->name('all-product');
Route::get('/flush/all', [\App\Http\Controllers\frontend\allProductController::class, 'index2'])->name('flash-product');


Route::get('/product/view{slug}', [\App\Http\Controllers\frontend\SingleProductView::class, 'index'])->name('product-view');


Route::get('{slug}/view', [\App\Http\Controllers\frontend\CategoryWiseProduct::class, 'index'])->name('category-wise-product-view');


Route::get('/omart/', [\App\Http\Controllers\omart\omart::class, 'index'])->name('omart');



Route::post('/getproductreating', [\App\Http\Controllers\frontend\ReatingReviewController::class, 'getallreview'])->name('getproductreating');


// Cart
Route::get('/cart', [App\Http\Controllers\frontend\cartController::class, 'showCart'])->name('client.showCart');
Route::post('/cart', [App\Http\Controllers\frontend\cartController::class, 'addToCart'])->name('client.addCart');
Route::post('/cartRemove', [App\Http\Controllers\frontend\cartController::class, 'RemoveFromCart'])->name('client.cartRemove');
Route::get('/cartClear', [App\Http\Controllers\frontend\cartController::class, 'clearCart'])->name('client.ClearCart');
Route::get('/checkout', [App\Http\Controllers\frontend\cartController::class, 'checkout'])->name('client.checkout');
//shop
Route::get('/shop', [App\Http\Controllers\frontend\shopController::class, 'shopIndex'])->name('client.shop');

//Login
Route::get('/login', [App\Http\Controllers\frontend\authController::class, 'showLogin'])->name('client.login');
Route::post('/onlogin', [App\Http\Controllers\frontend\authController::class, 'onlogin'])->name('client.onlogin');
Route::get('/registration', [App\Http\Controllers\frontend\authController::class, 'registration'])->name('client.registration');
Route::post('/addUser', [App\Http\Controllers\frontend\authController::class, 'addUser'])->name('client.addUser');
Route::get('/active/{token}', [App\Http\Controllers\frontend\authController::class, 'userActive'])->name('client.active');

//reset password
Route::get('/forgot', [App\Http\Controllers\frontend\authController::class, 'forgot'])->name('client.forgot');
Route::post('/forgotPassword', [App\Http\Controllers\frontend\authController::class, 'forgotPassword'])->name('client.forgotPassword');
Route::get('/recoverPassWord/{id}', [App\Http\Controllers\frontend\authController::class, 'recoverPassWord'])->name('client.recoverPassWord');
Route::post('/updatePassword', [App\Http\Controllers\frontend\authController::class, 'updatePassword'])->name('client.updatePassword');



// logout & Profile & Order
Route::group(['middleware' => 'auth'], function () {
    Route::get('/logout', [App\Http\Controllers\frontend\authController::class, 'logout'])->name('client.logout');
    Route::get('/profile', [App\Http\Controllers\frontend\authController::class, 'profile'])->name('client.profile');
    Route::get('/profileEdit/{id}', [App\Http\Controllers\frontend\authController::class, 'profileEdit'])->name('client.profileEdit');
    Route::post('/upadeteProfile/{id}', [App\Http\Controllers\frontend\authController::class, 'upadeteProfile'])->name('client.upadeteProfile');
    Route::post('/processOrder', [App\Http\Controllers\frontend\cartController::class, 'order'])->name('client.processOrder');
    Route::get('/orderDetails/{id}', [App\Http\Controllers\frontend\cartController::class, 'orderDetails'])->name('client.orderDetails');

    // Reating

    Route::post('/reating', [\App\Http\Controllers\frontend\ReatingReviewController::class, 'store'])->name('clint.reatingReview');


    // Asking about Product
    Route::post('/get/all/askabout/ptoduct/messege', [\App\Http\Controllers\frontend\AskAboutProduct::class, 'getallmessege'])->name('askaboutproduct.getallmessege');
    Route::post('/askabout/ptoduct/postmessege', [\App\Http\Controllers\frontend\AskAboutProduct::class, 'store'])->name('askaboutproduct.store');
});




Route::group(['prefix' => 'admin'], function () {
    Route::group(['middleware' => 'admin.guest'], function () {
        Route::view('/login', 'admin.login')->name('admin.login');
        Route::post('login', [\App\Http\Controllers\AdminController::class, 'login'])->name('admin.auth');
    });

    Route::group(['middleware' => 'admin.auth'], function () {
        Route::view('dashboard', 'admin.home')->name('admin.home');
        Route::post('logout', [\App\Http\Controllers\AdminController::class, 'logout'])->name('admin.logout');


        // Admin Route
        Route::get('/adminPannel', [App\Http\Controllers\admin\adminController::class, 'adminIndex'])->name('admin.adminPannel');
        Route::get('/getAdminData', [App\Http\Controllers\admin\adminController::class, 'adminData'])->name('admin.getAdmindata');
        Route::post('/adminAdd', [App\Http\Controllers\admin\adminController::class, 'adminAdd'])->name('admin.adminAdd');
        Route::post('/adminDelete', [App\Http\Controllers\admin\adminController::class, 'adminDelete'])->name('admin.adminDelete');
        Route::post('/adminDetailEdit', [App\Http\Controllers\admin\adminController::class, 'adminDetailEdit'])->name('admin.adminDetailEdit');
        Route::post('/adminDataUpdate', [App\Http\Controllers\admin\adminController::class, 'adminDataUpdate'])->name('admin.adminDataUpdate');

        // Vendor Route
        Route::get('/vendorPannel', [App\Http\Controllers\admin\vendor\VendorController::class, 'vendorIndex'])->name('admin.vendorPannel');
        Route::get('/getVendorData', [App\Http\Controllers\admin\vendor\VendorController::class, 'vendorData'])->name('admin.getVendordata');
        Route::post('/vendorAdd', [App\Http\Controllers\admin\vendor\VendorController::class, 'vendorAdd'])->name('admin.vendorAdd');
        Route::post('/vendorDelete', [App\Http\Controllers\admin\vendor\VendorController::class, 'vendorDelete'])->name('admin.vendorDelete');
        Route::post('/vendorDetailEdit', [App\Http\Controllers\admin\vendor\VendorController::class, 'vendorDetailEdit'])->name('admin.vendorDetailEdit');
        Route::post('/vendorDataUpdate', [App\Http\Controllers\admin\vendor\VendorController::class, 'vendorDataUpdate'])->name('admin.vendorDataUpdate');

        // Slider Section

        Route::get('/slider', [\App\Http\Controllers\admin\HomeSliderController::class, 'SliderIndex'])->name('admin.slider');
        Route::post('/addslider', [\App\Http\Controllers\admin\HomeSliderController::class, 'SliderAdd'])->name('admin.addslider');
        Route::get('/getsliderdata', [\App\Http\Controllers\admin\HomeSliderController::class, 'SliderData'])->name('admin.getsliderdata');
        Route::post('/sliderdelete', [\App\Http\Controllers\admin\HomeSliderController::class, 'SliderDelete'])->name('admin.sliderdelete');
        Route::post('/sliderdetails', [\App\Http\Controllers\admin\HomeSliderController::class, 'SliderDetailEdit'])->name('admin.sliderdetails');
        Route::post('/sliderupdate', [\App\Http\Controllers\admin\HomeSliderController::class, 'SliderUpdate'])->name('admin.sliderupdate');


        // Brand  Section
        Route::resource('brand', \App\Http\Controllers\admin\products\ProductBrandController::class, [
            'except' => ['destroy', 'show', 'update']
        ]);
        Route::get('/brands', [\App\Http\Controllers\admin\products\ProductBrandController::class, 'index'])->name('admin.brands');
        Route::post('/BrandDelete', [\App\Http\Controllers\admin\products\ProductBrandController::class, 'destroy'])->name('admin.BrandDelete');
        Route::post('/getBrandEditData', [\App\Http\Controllers\admin\products\ProductBrandController::class, 'show'])->name('admin.getBrandEditData');
        Route::post('/updateBrand', [\App\Http\Controllers\admin\products\ProductBrandController::class, 'updateBrand'])->name('admin.updateBrand');

        // Category  Section
        Route::get('/categories', [\App\Http\Controllers\admin\products\ProductCategoriesController::class, 'index'])->name('admin.categories');
        Route::post('/addCategory', [\App\Http\Controllers\admin\products\ProductCategoriesController::class, 'store'])->name('admin.addCategory');
        Route::post('/deleteCategory', [\App\Http\Controllers\admin\products\ProductCategoriesController::class, 'destroy'])->name('admin.deleteCategory');
        Route::post('/getEditCategoryData', [\App\Http\Controllers\admin\products\ProductCategoriesController::class, 'edit'])->name('admin.getEditCategoryData');
        Route::post('/updateCategory', [\App\Http\Controllers\admin\products\ProductCategoriesController::class, 'update'])->name('admin.updateCategory');

        //Product Section
        Route::get('/products', [\App\Http\Controllers\admin\products\ProductsController::class, 'index'])->name('admin.products');
        Route::get('/getProductData', [\App\Http\Controllers\admin\products\ProductsController::class, 'getProductData'])->name('admin.getProductData');
        Route::post('/productAdd', [\App\Http\Controllers\admin\products\ProductsController::class, 'store'])->name('admin.productAdd');
        Route::post('/onUpload', [\App\Http\Controllers\admin\products\ProductsController::class, 'onUpload'])->name('admin.onUpload');
        Route::post('/delete', [\App\Http\Controllers\admin\products\ProductsController::class, 'destroy'])->name('admin.delete');
        Route::post('/getEditProductsData', [\App\Http\Controllers\admin\products\ProductsController::class, 'edit'])->name('admin.getEditProductsData');
        Route::post('/productsUpdate', [\App\Http\Controllers\admin\products\ProductsController::class, 'update'])->name('admin.productsUpdate');




        //admin panel Orders
        Route::get('/ordeIndex', [App\Http\Controllers\admin\order\orderController::class, 'ordeIndex'])->name('admin.ordeIndex');
        Route::get('/getOrdersData', [App\Http\Controllers\admin\order\orderController::class, 'getOrdersData'])->name('admin.getOrdersData');
        Route::post('/ordersView', [App\Http\Controllers\admin\order\orderController::class, 'ordersView'])->name('admin.ordersView');
        Route::post('/ordersStatusUpdate', [App\Http\Controllers\admin\order\orderController::class, 'ordersStatusUpdate'])->name('admin.ordersStatusUpdate');
        Route::get('/ordersPrint/{id}', [App\Http\Controllers\admin\order\orderController::class, 'ordersPrint'])->name('admin.ordersPrint');


        //admin panel Review
        Route::get('/review', [App\Http\Controllers\admin\RatingReviewController::class, 'reviewIndex'])->name('admin.review');
        Route::get('/getReviewdata', [App\Http\Controllers\admin\RatingReviewController::class, 'getReviewdata'])->name('admin.getReviewdata');
        Route::post('/deleteReview', [\App\Http\Controllers\admin\RatingReviewController::class, 'deleteReview'])->name('admin.deleteReview');


        //admin panel  Page management

        Route::get('/pages', [\App\Http\Controllers\admin\PagesController::class, 'PageIndex'])->name('admin.pages');
        Route::get('/getpagesdata', [\App\Http\Controllers\admin\PagesController::class, 'PagesData'])->name('admin.getpagesdata');
        Route::post('/addpages', [\App\Http\Controllers\admin\PagesController::class, 'PagesAdd'])->name('admin.addpages');
        Route::post('/pagesdetails', [\App\Http\Controllers\admin\PagesController::class, 'PagesDetailEdit'])->name('admin.pagesdetails');
        Route::post('/pagesupdate', [\App\Http\Controllers\admin\PagesController::class, 'PagesUpdate'])->name('admin.pagesupdate');
        Route::post('/pagesdelete', [\App\Http\Controllers\admin\PagesController::class, 'PagesDelete'])->name('admin.pagesdelete');



        //admin panel Home Page Social Link management
        Route::get('/social', [\App\Http\Controllers\admin\SocialController::class, 'SocialIndex'])->name('admin.social');
        Route::post('/facebook', [\App\Http\Controllers\admin\SocialController::class, 'addFacebook'])->name('admin.facebook');
        Route::post('/twitter', [\App\Http\Controllers\admin\SocialController::class, 'addTwitter'])->name('admin.twitter');
        Route::post('/youtube', [\App\Http\Controllers\admin\SocialController::class, 'addYoutube'])->name('admin.youtube');
        Route::post('/instragram', [\App\Http\Controllers\admin\SocialController::class, 'addInstragram'])->name('admin.instragram');
        Route::post('/linkin', [\App\Http\Controllers\admin\SocialController::class, 'addLinkin'])->name('admin.linkin');
        Route::post('/google', [\App\Http\Controllers\admin\SocialController::class, 'addGoogle'])->name('admin.google');


        //admin panel Home Page Others management with social URL
        Route::get('/others', [\App\Http\Controllers\admin\OthersSettingsController::class, 'otherIndex'])->name('admin.others');
        Route::post('/address', [\App\Http\Controllers\admin\OthersSettingsController::class, 'addAddress'])->name('admin.address');
        Route::post('/phone', [\App\Http\Controllers\admin\OthersSettingsController::class, 'addPhone'])->name('admin.phone');
        Route::post('/email', [\App\Http\Controllers\admin\OthersSettingsController::class, 'addEmail'])->name('admin.email');
        Route::post('/title', [\App\Http\Controllers\admin\OthersSettingsController::class, 'addTitle'])->name('admin.title');
        Route::post('/gmap', [\App\Http\Controllers\admin\OthersSettingsController::class, 'addGmap'])->name('admin.gmap');
        Route::post('/logo', [\App\Http\Controllers\admin\OthersSettingsController::class, 'logoAdd'])->name('admin.logo');
        Route::post('/Banner', [\App\Http\Controllers\admin\OthersSettingsController::class, 'BannerAdd'])->name('admin.Banner');
        Route::post('/promoImageOne', [\App\Http\Controllers\admin\OthersSettingsController::class, 'promoImageOne'])->name('admin.promoImageOne');
        Route::post('/promoImageTwo', [\App\Http\Controllers\admin\OthersSettingsController::class, 'promoImageTwo'])->name('admin.promoImageTwo');
        Route::post('/promoImageThree', [\App\Http\Controllers\admin\OthersSettingsController::class, 'promoImageThree'])->name('admin.promoImageThree');
    });
});



// For Admin & Vendor

        Route::get('/getBrandsData', [\App\Http\Controllers\admin\products\ProductBrandController::class, 'getBrandData'])->name('admin.getBrandsData');
        Route::get('/getCategoriesData', [\App\Http\Controllers\admin\products\ProductCategoriesController::class, 'getCategoriesData'])->name('admin.getCategoriesData');



// For Vendor

Route::group(['prefix' => 'vendor'], function () {
    Route::group(['middleware' => 'vendor.guest'], function () {
        //Login
        Route::get('/login', [App\Http\Controllers\vendor\vendorAuthController::class, 'showLogin'])->name('vendor.login');
        Route::post('/onlogin', [App\Http\Controllers\vendor\vendorAuthController::class, 'onlogin'])->name('vendor.onlogin');
        Route::get('/registration', [App\Http\Controllers\vendor\vendorAuthController::class, 'registration'])->name('vendor.registration');
        Route::post('/addUser', [App\Http\Controllers\vendor\vendorAuthController::class, 'addVendor'])->name('vendor.addVendor');

        //reset password
        Route::get('/forgot', [App\Http\Controllers\vendor\vendorAuthController::class, 'forgot'])->name('vendor.forgot');
        Route::post('/forgotPassword', [App\Http\Controllers\vendor\vendorAuthController::class, 'forgotPassword'])->name('vendor.forgotPassword');
        Route::get('/recoverPassWord/{id}', [App\Http\Controllers\vendor\vendorAuthController::class, 'recoverPassWord'])->name('vendor.recoverPassWord');
        Route::post('/updatePassword', [App\Http\Controllers\vendor\vendorAuthController::class, 'updatePassword'])->name('vendor.updatePassword');


    });


    Route::group(['middleware' => 'vendor.auth',], function () {
        Route::post('/logout', [App\Http\Controllers\vendor\vendorAuthController::class, 'logout'])->name('vendor.logout');
        Route::get('/profile', [App\Http\Controllers\vendor\vendorAuthController::class, 'profile'])->name('vendor.profile');
        Route::get('/profileEdit/{id}', [App\Http\Controllers\vendor\vendorAuthController::class, 'profileEdit'])->name('vendor.profileEdit');
        Route::post('/upadeteProfile/{id}', [App\Http\Controllers\vendor\vendorAuthController::class, 'upadeteProfile'])->name('vendor.upadeteProfile');

        Route::view('dashboard', 'vendor.home')->name('vendor.home');
        //Product Section
        Route::get('/products', [\App\Http\Controllers\vendor\prductController::class, 'index'])->name('vendor.products');
        Route::get('/getProductData', [\App\Http\Controllers\vendor\prductController::class, 'getProductData'])->name('vendor.getProductData');
        Route::post('/productAdd', [\App\Http\Controllers\vendor\prductController::class, 'store'])->name('vendor.productAdd');
        Route::post('/onUpload', [\App\Http\Controllers\vendor\prductController::class, 'onUpload'])->name('vendor.onUpload');
        Route::post('/delete', [\App\Http\Controllers\vendor\prductController::class, 'destroy'])->name('vendor.delete');
        Route::post('/getEditProductsData', [\App\Http\Controllers\vendor\prductController::class, 'edit'])->name('vendor.getEditProductsData');
        Route::post('/productsUpdate', [\App\Http\Controllers\vendor\prductController::class, 'update'])->name('vendor.productsUpdate');


         //vendor panel Orders
         Route::get('/ordeIndex', [App\Http\Controllers\vendor\order\orderController::class,'ordeIndex'])->name('vendor.ordeIndex');
         Route::get('/getOrdersData', [App\Http\Controllers\vendor\order\orderController::class,'getOrdersData'])->name('vendor.getOrdersData');
         Route::post('/ordersView', [App\Http\Controllers\vendor\order\orderController::class,'ordersView'])->name('vendor.ordersView');
         Route::post('/ordersStatusUpdate', [App\Http\Controllers\vendor\order\orderController::class,'ordersStatusUpdate'])->name('vendor.ordersStatusUpdate');
         Route::get('/ordersPrint/{id}', [App\Http\Controllers\vendor\order\orderController::class,'ordersPrint'])->name('vendor.ordersPrint');

    });
});


//Clear Cache facade value:
Route::get('/optimize', function () {
    $exitCode = Artisan::call('optimize:clear');
    return '<h1>optimize cleared</h1>';
});




//Clear View cache:
Route::get('/view-clear', function () {
    $exitCode = Artisan::call('view:clear');
    return '<h1>View cache cleared</h1>';
});

//Clear Config cache:
Route::get('/config-cache', function () {
    $exitCode = Artisan::call('config:cache');
    return '<h1>Clear Config cleared</h1>';
});

//Clear Cache facade value:
Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('cache:clear');
    return '<h1>Cache facade value cleared</h1>';
});



//Clear Route cache:
Route::get('/route-clear', function () {
    $exitCode = Artisan::call('route:clear');
    return '<h1>Route cache cleared</h1>';
});

//Clear Config cache:
Route::get('/Storage-link', function () {
    $exitCode = Artisan::call('storage:link');
    return '<h1>Storage Link Created</h1>';
});


// Migrate Seed

Route::get('/reset', function () {
    Artisan::call('migrate:fresh', ['--seed' => ' ']);
    return '<h1>Migrate Finish</h1>';
});
