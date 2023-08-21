<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PromotionController;
use Illuminate\Support\Facades\Route;

//CLIENT

Route::get('/', [HomeController::class, 'homeClient'])->name('home');
Route::get('/detail/{id}', [HomeController::class, 'detail'])->name('detail');
Route::get('/category/{category_id}', [ProductController::class ,'showProductsByCategory'])->name('category_id');
Route::get('/about',[HomeController::class ,'about'])->name('about');
Route::get('/product',[HomeController::class,'product'])->name('product_client');


//login logout
Route::get('/login',[LoginController::class,'index'])->name('login_show');
Route::post('/login', [LoginController::class, 'login'])->name('auth.login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

//register
Route::get('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/register/store', [RegisterController::class,'store'])->name('create_user');

//Cart

Route::post('/update-cart', [CartController::class,'updateCart'])->name('cart.update');
Route::get('/cart/add/{product_id}/{user_id}', [CartController::class,'addToCart'])->name('cart.add');
Route::get('/cart',  [CartController::class,'index'])->name('cart_index');
Route::get('/cart/{id}/remove', [CartController::class,'removeFromCart'])->name('cart.remove');
Route::post('/promotion/add',[CartController::class,'promotion'])->name('promotion.client');

//ADMIN

Route::middleware(['auth','role:admin'])->group(function(){

    Route::get('/admin', [HomeController::class,'homeAdmin'])->name('home_admin');

    //Category-admin
    
    Route::get('/admin/category', [CategoryController::class,'index'])->name('route_index_category');
    Route::get('/admin/category/create', [CategoryController::class,'create'])->name('create_category');
    Route::post('/admin/category/store', [CategoryController::class,'store'])->name('store_category');
    Route::get('admin/category/edit/{id}', [CategoryController::class,'edit'])->name('edit_category');
    Route::post('admin/category/update/{id}', [CategoryController::class,'update'])->name('update_category');
    Route::get('admin/category/delete/{id}', [CategoryController::class,'destroy'])->name('delete_category');
    
    //Product-admin
    
    Route::get('/admin/product',[ProductController::class,'index'])->name('product_index');
    Route::get('/admin/product/create', [ProductController::class,'create'])->name('create_product');
    Route::post('/admin/product/store', [ProductController::class,'store'])->name('store_product');
    Route::get('admin/product/delete/{id}', [ProductController::class,'destroy'])->name('delete_product');
    Route::get('admin/product/edit/{id}', [ProductController::class,'edit'])->name('edit_product');
    Route::post('admin/product/update/{id}', [ProductController::class,'update'])->name('update_product');
    
    //user-admin
    Route::get('/admin/user',[RegisterController::class,'index'])->name('user');
    Route::get('admin/user/delete/{id}', [RegisterController::class,'destroy'])->name('delete_user');
    
    //Khuyến mãi 
    Route::get('admin/promotion',[PromotionController::class,'index'])->name('promotion');
    Route::get('/admin/promotion/create', [PromotionController::class,'create'])->name('create_promotion');
    Route::post('admin/promotion/add',[PromotionController::class,'store'])->name('store_promotion');
    Route::get('admin/promotion/edit/{id}', [PromotionController::class,'edit'])->name('edit_promotion');
    Route::post('admin/promotion/update/{id}', [PromotionController::class,'update'])->name('update_promotion');
    Route::get('admin/promotion/delete/{id}', [PromotionController::class,'destroy'])->name('delete_promotion');
});

