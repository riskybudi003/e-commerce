<?php

use App\Http\Controllers\AuthAdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileUserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::controller(AuthAdminController::class)->group(function () {
    Route::get('login-admin', 'login')->name('login');
    Route::get('registrasion-admin', 'Regist')->name('regist');
    Route::post('post-login-admin', 'postLogin')->name('post-login');
    Route::post('regist-post-admin', 'postRegist')->name('regist-post');
    Route::get('logout-admin', 'logout')->name('logout-admin');
    Route::get('login', 'LoginUser')->name('login-user');
    Route::get('Regist', 'RegistUser')->name('regist-user');
    Route::post('post-login', 'postLoginUser')->name('post-login-user');
    Route::post('post-regist-user', 'postRegistUser')->name('post-regist-user');
    Route::get('logout-user', 'logoutUser')->name('logout-user');
});

// Halaman User

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'Home')->name('home');
    Route::get('all-product', 'allProduct')->name('all-product');
    Route::get('category-product/{slug}', 'CategoryProduct')->name('category-product');
    Route::get('Detail-product/{slug}', 'DetailProduct')->name('detail-product');
});


Route::controller(CartController::class)->group(function () {

    Route::post('addToCart', 'addToCart')->name('addToCart');
    Route::get('Detail-cart', 'detailCart')->name('detail-cart');
    Route::post('Delete-Item-Cart', 'deleteItemCart')->name('delete-Item-Cart');
    Route::post('Cekout', 'cekout')->name('cekout');
});

Route::middleware(['customer'])->group(function () {
    Route::controller(ProfileUserController::class)->group(function () {

        Route::get('profile', 'profile')->name('user_profile');
        Route::post('update-profile/{id}', 'UpdateUser')->name('update-user');
    });
});


Route::middleware(['admins'])->group(function () {
    Route::get('Dashboard', [DashboardController::class, 'Dashboard'])->name('dashboard');

    Route::controller(CategoryController::class)->group(function () {
        Route::get('data-category', 'DataCategory')->name('Data_Category');
        Route::get('form-category', 'CreateCat')->name('from-create-cat');
        Route::post('post-category', 'PostCategory')->name('post-category');
        Route::get('edit-category/{id}', 'EditCat')->name('edit-category');
        Route::post('update-category/{id}', 'UpdateCat')->name('update-category');
        Route::get('delete-category/{id}', 'deleteCat')->name('delete-category');
    });

    Route::controller(ProductController::class)->group(function () {
        Route::get('data-product', 'DataProducts')->name('products');
        Route::get('form-product', 'CreateProduct')->name('create-product');
        Route::post('post-data-product', 'postProduct')->name('post-product');
        Route::get('edit-product/{id}', 'EditProduct')->name('edit-product');
        Route::post('update-product/{id}', 'UpdateProduct')->name('update-product');
        Route::get('delete-product/{id}', 'deleteProduct')->name('delete-product');
    });

    Route::controller(ProductController::class)->group(function () {
    });

    Route::controller(OrderController::class)->group(function () {
        Route::get('data-order', 'DataOrders')->name('order');
        Route::post('approve-order/{id}', 'approveOrder')->name('Approve');
        Route::post('finish-order/{id}', 'FinishOrder')->name('Finish');
        Route::get('delete-order/{id}', 'DeleteOrder')->name('delete-order');
        Route::get('invoice-order/{id}', 'invoice')->name('invoice');
    });
});
