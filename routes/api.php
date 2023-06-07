<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Student\StudentController;
use App\Http\Controllers\API\Vendor\VendorController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });






/****** Student API **********/

Route::group(['prefix' => 'student' ], function () {
    
     /* login api */
    Route::post('login', [App\Http\Controllers\API\Student\StudentController::class, 'login']);

     /*Register api and verify university email */
    Route::post('signup', [App\Http\Controllers\API\Student\StudentController::class, 'signup']);
    
     /* University email verfication send otp api */
    Route::post('request_otp', [App\Http\Controllers\API\Student\StudentController::class, 'sendverificationcode']);

    /* Forgot password verify otp api*/
    Route::post('varification-otp', [App\Http\Controllers\API\Student\StudentController::class, 'verifyotp']);

     /* Forgot password send otp api*/
     Route::post('send_resetlink', [App\Http\Controllers\API\Student\StudentController::class, 'forgotpasssword']);

    /* Forgot password api*/
    Route::post('forget-password',[App\Http\Controllers\API\Student\StudentController::class,'change_password']);
    
    /* login with Facebook */
    Route::post('facebook-login', [App\Http\Controllers\API\Student\SocialLoginController::class,'facebookLogin']);

     /* signup with Facebook */
     Route::post('facebook-signup', [App\Http\Controllers\API\Student\SocialLoginController::class,'facebooksignup']);
    
     /* login with Google */
    Route::post('google-login', [App\Http\Controllers\API\Student\SocialLoginController::class,'googleLogin']);
    
    /* signup with Google */
    Route::post('google-signup', [App\Http\Controllers\API\Student\SocialLoginController::class,'googlesignup']);
});


Route::group(['middleware' => ['auth:api'], 'prefix' => 'student'], function () {

        /*logout to customer*/
       Route::post('logout', [App\Http\Controllers\API\Student\StudentController::class, 'logout']);

        /* show details of users*/
       Route::get('user', [App\Http\Controllers\API\Student\StudentController::class, 'user']);
       
        /* Explore page api*/
       Route::get('explores', [App\Http\Controllers\API\Student\VoucherController::class, 'get_explore_vouchers']);

        /* show voucher details*/
       Route::get('voucher/{id}', [App\Http\Controllers\API\Student\VoucherController::class, 'get_voucher_details']);

        /* Fetch categories api*/
       Route::get('categories', [App\Http\Controllers\API\Student\CategoryController::class, 'list_categories']);

        /* Fetch category detail with voucher and subcategories api*/
       Route::get('category/{id}', [App\Http\Controllers\API\Student\CategoryController::class, 'get_category_detail']);

       /*Fetch subcategory detail api*/
       Route::get('subcategory', [App\Http\Controllers\API\Student\CategoryController::class, 'get_subcategory_detail']);

       /* Search page api*/
       Route::get('search-page', [App\Http\Controllers\API\Student\SearchController::class, 'default_search_page']);

       /* Search result api*/
       Route::get('search-result', [App\Http\Controllers\API\Student\SearchController::class, 'get_search_result']);

        /* Add wishlist product*/
       Route::post('save-product', [App\Http\Controllers\API\Student\WishlistController::class, 'save_product']);

       /* Fetch wishlist product*/
       Route::get('saved-products', [App\Http\Controllers\API\Student\WishlistController::class, 'get_saved_list']);

       /* change password send otp api*/
       Route::post('email-varification', [App\Http\Controllers\API\Student\StudentController::class, 'verificationcode']);

        /* Change password verifiy otp api*/
       Route::post('password-varification-otp', [App\Http\Controllers\API\Student\StudentController::class, 'verify_otp']);

        /* change password after login */
       Route::post('change-password',[App\Http\Controllers\API\Student\StudentController::class,'changepassword']);

       /* Add follow product api*/
       Route::post('save-product-follower', [App\Http\Controllers\API\Student\FollowerController::class, 'save_product']);

        /* fetch follow products*/
       Route::get('follow-products', [App\Http\Controllers\API\Student\FollowerController::class, 'get_saved_list']);

        /* Edit profile api*/
       Route::post('edit-profile', [App\Http\Controllers\API\Student\StudentController::class, 'edituser']);

        /* add like rating*/
       Route::post('rating', [App\Http\Controllers\API\Student\RatingController::class, 'rating']);

       /*Add unlike rating*/
       Route::post('unlike-rating', [App\Http\Controllers\API\Student\RatingController::class, 'unlike_rating']);

       /*Delete recent item*/
       Route::get('remove-recent-item', [App\Http\Controllers\API\Student\VoucherController::class, 'delete_recent_items']);

       /*Add recent item*/
       Route::get('add-recent-item', [App\Http\Controllers\API\Student\VoucherController::class, 'add_recent_item']);

       /*Fetch notifications */
       Route::get('notifications', [App\Http\Controllers\API\Student\StudentController::class, 'notifications']);

       /* delete notification*/
       Route::get('remove-notification', [App\Http\Controllers\API\Student\StudentController::class, 'delnotifications']);
         
       /* refresh firebase device token */
       Route::post('on_token_refresh', [App\Http\Controllers\API\Student\StudentController::class, 'firebase_refresh_token']);
});






/************ Vendor API *********************/

Route::group(['prefix' => 'vendor'], function () {
    
     /* login api */
    Route::post('login', [App\Http\Controllers\API\Vendor\VendorController::class, 'login']);
    
    /*Register api */ 
    Route::post('signup', [App\Http\Controllers\API\Vendor\VendorController::class, 'signup']);
    
    /* Forgot password verify otp api*/
    Route::post('varification-otp', [App\Http\Controllers\API\Vendor\VendorController::class, 'verifyotp']);

    /* Forgot password send otp api*/
    Route::post('send_resetlink', [App\Http\Controllers\API\Vendor\VendorController::class, 'forgotpasssword']);

     /* Forgot password api*/
    Route::post('forget-password',[App\Http\Controllers\API\Vendor\VendorController::class,'change_password']);
});


Route::group(['middleware' => ['auth:api'],'prefix' => 'vendor'], function () {
    

     /*logout to customer*/ 
    Route::post('logout', [App\Http\Controllers\API\Vendor\VendorController::class, 'logout']);
    
    /* show details of users*/
    Route::get('user', [App\Http\Controllers\API\Vendor\VendorController::class, 'user']);
    
    // Route::post('delete', 'API\LoginController@delete_user');

    /* change password send otp api*/
    Route::post('varification', [App\Http\Controllers\API\Vendor\VendorController::class, 'verificationcode']);

     /* Change password verifiy otp api*/
    Route::post('varifiy_otp', [App\Http\Controllers\API\Vendor\VendorController::class, 'verify_otp']);

    /* change password after login */
    Route::post('change_password',[App\Http\Controllers\API\Vendor\VendorController::class,'changepassword']);

    /* Edit profile api*/
    Route::post('edit_profile', [App\Http\Controllers\API\Vendor\VendorController::class, 'edituser']);

    /* Add amount manually and after scan */
    Route::post('voucher_sold', [App\Http\Controllers\API\Vendor\VoucherController::class, 'addmanually']);

    // Route::post('scan-add-amount', [App\Http\Controllers\API\Vendor\VoucherController::class, 'addmanuallyscan']);

    /*Fetch vouchers */ 
    Route::get('sold_vouchers', [App\Http\Controllers\API\Vendor\VoucherController::class, 'voucherhistory']);

    /*Fetch notifications */
    Route::get('notifications', [App\Http\Controllers\API\Vendor\VendorController::class, 'notifications']);

    /* Delete notification*/
    Route::get('remove_notification', [App\Http\Controllers\API\Vendor\VendorController::class, 'delnotifications']);

    /* Refresh firebase device token */
    Route::post('on_token_refresh', [App\Http\Controllers\API\Vendor\VendorController::class, 'firebase_refresh_token']);

});

// Route::get('categories', [App\Http\Controllers\API\NewstudentController::class, 'coupon_category']);
Route::get('vouchers', [App\Http\Controllers\API\NewstudentController::class, 'available_voucher']);
Route::get('sold_vouchers', [App\Http\Controllers\API\NewstudentController::class, 'expire_voucher']);
Route::post('create_wishlist', [App\Http\Controllers\API\NewstudentController::class, 'wishlist']);
Route::get('show_vouchers', [App\Http\Controllers\API\NewstudentController::class, 'display_voucher']);
Route::get('view_particular_voucher', [App\Http\Controllers\API\NewstudentController::class, 'show_particular_voucher']);
Route::get('search', [App\Http\Controllers\API\NewstudentController::class, 'searchapi']);
Route::get('recent_show', [App\Http\Controllers\API\NewstudentController::class, 'recently_view']);
Route::get('view_sub_categories', [App\Http\Controllers\API\NewstudentController::class, 'sub_categories']);
Route::get('show_sub_vouchers', [App\Http\Controllers\API\NewstudentController::class, 'sub_cat_vouchers']);
