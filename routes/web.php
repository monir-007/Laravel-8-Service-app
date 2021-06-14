<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MultiImageController;
use App\Http\Controllers\SliderController;
use App\Models\AboutUs;
use App\Models\Brand;
use App\Models\User;
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

Route::get('/', function () {
    $brands = Brand::all();
    $abouts= AboutUs::first();
    return view('index', compact('brands','abouts'));
});

//Category Routes
Route::get('/category/index', [CategoryController::class, 'index'])->name('index.category');
Route::post('/category/save', [CategoryController::class, 'save'])->name('save.category');
Route::get('/category/edit/{id}', [CategoryController::class, 'edit']);
Route::post('/category/update/{id}', [CategoryController::class, 'update']);
Route::get('/category/softDelete/{id}', [CategoryController::class, 'softDelete']);
Route::get('/category/restore/{id}', [CategoryController::class, 'restoreCategory']);
Route::get('/category/delete/{id}', [CategoryController::class, 'deleteCategory']);

//Brand Routes
Route::get('/brand/index', [BrandController::class, 'index'])->name('index.brand');
Route::post('/brand/save', [BrandController::class, 'save'])->name('save.brand');
Route::get('/brand/edit/{id}', [BrandController::class, 'edit']);
Route::post('/brand/update/{id}', [BrandController::class, 'update']);
Route::get('/brand/delete/{id}', [BrandController::class, 'delete']);

//Multi-Image Routes
Route::get('/multiple/image/', [MultiImageController::class, 'index'])->name('index.multiImage');
Route::post('/multiple/image/save', [MultiImageController::class, 'save'])->name('save.multiImage');

//Slider Routes
Route::get('/slider/', [SliderController::class, 'index'])->name('index.slider');
Route::post('/slider/new', [SliderController::class, 'saveNew'])->name('save.slider');
Route::get('/slider/edit/{id}', [SliderController::class, 'edit']);
Route::post('/slider/update/{id}', [SliderController::class, 'update']);
Route::get('/slider/delete/{id}', [SliderController::class, 'delete']);

//About Us Routes
Route::get('/about-us/',[AboutUsController::class, 'index'])->name('index.aboutUs');
Route::post('/about-us/new', [AboutUsController::class, 'saveNew'])->name('save.aboutUs');
Route::get('/about-us/edit/{id}', [AboutUsController::class, 'edit']);
Route::post('/about-us/update/{id}', [AboutUsController::class, 'update']);
Route::get('/about-us/delete/{id}', [AboutUsController::class, 'delete']);

//dashboard login route
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    //    $users = User::all();
    return view('admin.index');
})->name('dashboard');

//Verify Email Notice
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('user/logout', [UserController::class, 'logout'])->name('user.logout');
