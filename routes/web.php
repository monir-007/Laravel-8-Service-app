<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
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
    return view('welcome');
});

Route::get('/category/index', [CategoryController::class, 'index'])->name('index.category');
Route::post('/category/save', [CategoryController::class, 'save'])->name('save.category');
Route::get('/category/edit/{id}',[CategoryController::class, 'edit']);
Route::post('/category/update/{id}',[CategoryController::class, 'update']);
Route::get('/category/softDelete/{id}',[CategoryController::class, 'softDelete']);
Route::get('/category/restore/{id}',[CategoryController::class, 'restoreCategory']);
Route::get('/category/delete/{id}',[CategoryController::class, 'deleteCategory']);

Route::get('/brand/index',[BrandController::class, 'index'])->name('index.brand');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    $users = User::all();
    return view('dashboard', compact('users'));
})->name('dashboard');
