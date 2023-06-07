<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\VoucherController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\VendorController;
use App\Http\Controllers\Admin\TestController;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function () {
    return view('auth.login');
});
Auth::routes();
Route::group(['middleware' => 'admin'], function () {
    //admin controller
                Route::get('/admin', [App\Http\Controllers\Admin\AdminController::class, 'index'])->name('admin');
                Route::get('/add-vendor',[App\Http\Controllers\Admin\AdminController::class,'index4']);               
                //Route::get('/category-list',[App\Http\Controllers\Admin\AdminController::class,'index9']);
                Route::get('/edit-discount',[App\Http\Controllers\Admin\AdminController::class,'index10']);
                Route::get('/edit-vendor',[App\Http\Controllers\Admin\AdminController::class,'index12']);
               
 
    //category controller 
                Route::get('/add-category',[App\Http\Controllers\Admin\CategoryController::class,'index']);
                Route::post('/add-category-data',[App\Http\Controllers\Admin\CategoryController::class,'addcategory']);
                Route::get('/showcategory',[App\Http\Controllers\Admin\CategoryController::class,'showcategory']);
                Route::get('/edit-category/{id}',[App\Http\Controllers\Admin\CategoryController::class,'edit']);
                Route::put('/update-category/{id}',[App\Http\Controllers\Admin\CategoryController::class,'update']);
                Route::delete('/delete-category/{id}',[App\Http\Controllers\Admin\CategoryController::class,'destroy']);
                Route::get('/category-list',[App\Http\Controllers\Admin\CategoryController::class,'show']);
   
    //voucher controller
                Route::get('/add-discount',[App\Http\Controllers\Admin\VoucherController::class,'index']);
                Route::post('/add-voucher-data',[App\Http\Controllers\Admin\VoucherController::class,'addvoucher']);
                Route::get('/discount-voucher-list',[App\Http\Controllers\Admin\VoucherController::class,'show']);
                Route::get('/voucher-view/{id}',[App\Http\Controllers\Admin\VoucherController::class,'view']);
                Route::get('/editvoucher/{id}',[App\Http\Controllers\Admin\VoucherController::class,'editvoucher']);
                Route::put('/updatevoucher/{id}',[App\Http\Controllers\Admin\VoucherController::class,'updatevoucher']);
                Route::delete('/deletevoucher/{id}',[App\Http\Controllers\Admin\VoucherController::class,'destroy']);
                Route::get('/subcategory',[App\Http\Controllers\Admin\VoucherController::class,'subcategory']);
                 Route::get('/voucheravals',[App\Http\Controllers\Admin\VoucherController::class,'avals']);
                  Route::get('/vouchersold',[App\Http\Controllers\Admin\VoucherController::class,'sold']);
             
    //student controller          
                //  Route::get('/vendor-list',[App\Http\Controllers\Admin\AdminController::class,'index6']);
                Route::get('/student-list',[App\Http\Controllers\Admin\StudentController::class,'approvestudent']);
                Route::get('/student-registration',[App\Http\Controllers\Admin\StudentController::class,'index']);
                Route::get('/approvedstudent/{id}',[App\Http\Controllers\Admin\StudentController::class,'approved']);
                Route::get('/blockedstudent/{id}',[App\Http\Controllers\Admin\StudentController::class,'blocked']);
                Route::get('/rejectstudent/{id}',[App\Http\Controllers\Admin\StudentController::class,'reject']);
                  Route::get('/qr',[App\Http\Controllers\Admin\StudentController::class,'qrcode']);
             
             
    //vendor controller           
                Route::get('/vendor-registration',[App\Http\Controllers\Admin\VendorController::class,'index']);
                Route::get('/vendor-list',[App\Http\Controllers\Admin\VendorController::class,'approvevendor']);
                Route::get('/approved/{id}',[App\Http\Controllers\Admin\VendorController::class,'approved']);
                Route::get('/blockedvendor/{id}',[App\Http\Controllers\Admin\VendorController::class,'blocked']);
                Route::get('/reject/{id}',[App\Http\Controllers\Admin\VendorController::class,'reject']);
                Route::post('/add-vendor-data',[App\Http\Controllers\Admin\VendorController::class,'addvendor']);
                Route::get('/edit-vendor/{id}',[App\Http\Controllers\Admin\VendorController::class,'editvendor']);
                Route::put('/update-vendor/{id}',[App\Http\Controllers\Admin\VendorController::class,'updatevendor']);
                Route::delete('/delete-vendor/{id}',[App\Http\Controllers\Admin\VendorController::class,'destroy']);
            });
            
             Route::get('/forgot', [App\Http\Controllers\Admin\AdminController::class, 'forgot']);
              Route::post('/reset_password', [App\Http\Controllers\Admin\AdminController::class, 'reset_password']);
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Route::post('password/upadte', [App\Http\Controllers\Auth\ResetPasswordController::class, 'submitResetPasswordForm'])->name('password.update');