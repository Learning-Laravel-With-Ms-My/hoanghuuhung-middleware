<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\Admin\ProductsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can egister web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/',[HomeController::class,'index'])->name('home');
Route::get('/san-pham',[HomeController::class,'products'])->name('product');
Route::get('/them-san-pham',[HomeController::class,'getAdd']);
Route::post('/them-san-pham',[HomeController::class,'postAdd']);
Route::put('/them-san-pham',[HomeController::class,'putAdd']);
// client route 
// Route::prefix('categories')->group(function(){
//     // danh sách chuyên mục
//     Route::get('/',[CategoriesController::class,'index'])->name('categories.list');
//     // lấy chi tiết 1 chuyên mục
//     Route::get('/edit/{id}',[CategoriesController::class,'getCategory']);
//     //xử lý hàm update chuyên mục
//     Route::post('/edit/{id}',[CategoriesController::class,'updateCategory']);
//     //hiển thị form add dữ liệu 
//     Route::get('/add',[CategoriesController::class,'addCategory'])->name('categories.add');
//     // xử lý thêm chuyên mục
//     Route::post('/add',[CategoriesController::class,'handleAddCategory']);
//     //xóa chuyên mục
//     Route::delete('/delete/{id}',[CategoriesController::class,'deleteCategory'])->name('categories.delete');

//     //getfile
//     Route::get('/upload',[CategoriesController::class,'getFile']);

//     //xử lý file upoload
//     Route::post('/upload',[CategoriesController::class,'handleFile'])->name('categories.upload');
// });

// Route::get('san-pham/{id}',[HomeController::class,'getProductDetails']);
// //admin route
// Route::middleware('auth.admin')->prefix('admin')->group(function(){
//     Route::get('/dashboard',[DashboardController::class,'index']);
//     Route::resource('products',ProductsController::class);
// });