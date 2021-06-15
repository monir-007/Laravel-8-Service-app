<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\admin\UpdateProfileController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MultiImageController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\SliderController;
use App\Models\AboutUs;
use App\Models\Brand;
use App\Models\MultiImage;
use App\Models\Services;
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
    $services=Services::all();
    $images=MultiImage::all();
    return view('index', compact('brands','abouts', 'services', 'images'));
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

//Services Routes
Route::get('/services/',[ServicesController::class, 'index'])->name('index.services');
Route::post('/services/new',[ServicesController::class, 'saveNew'])->name('save.services');
Route::get('/services/edit/{id}', [ServicesController::class, 'edit']);
Route::post('/services/update/{id}', [ServicesController::class, 'update']);
Route::get('/services/delete/{id}', [ServicesController::class, 'delete']);

//Portfolio Routes
Route::get('/portfolio/',[PortfolioController::class, 'index'])->name('portfolio');

//Contact Routes
Route::get('/contact',[ContactController::class, 'viewContact'])->name('contact');
Route::post('/contact/message',[ContactController::class, 'contactMessage'])->name('message.contact');
Route::get('/contact/admin',[ContactController::class, 'index'])->name('index.contact');
Route::post('/contact/new/admin',[ContactController::class, 'saveNew'])->name('save.contact');
Route::get('/contact/edit/{id}', [ContactController::class, 'edit']);
Route::post('/contact/update/{id}', [ContactController::class, 'update']);
Route::get('/contact/delete/{id}', [ContactController::class, 'delete']);
Route::get('/contact/message/admin', [ContactController::class, 'message'])->name('contactMessage');
Route::get('/contact/message/delete/{id}', [ContactController::class, 'deleteMessage']);

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

//Change Password Routes
Route::get('/user/password',[UpdateProfileController::class, 'changePassword'])->name('change.password');
Route::post('/user/password/update',[UpdateProfileController::class, 'updatePassword'])->name('update.password');

//Update profile Routes
Route::get('/user/profile/',[UpdateProfileController::class, 'updateProfile'])->name('update.profile');
Route::post('/user/profile/update',[UpdateProfileController::class, 'updateProfileNew'])->name('update.profile.new');
