<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminUsersController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\MovieCategoryController;


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


Route::get('/', function () {
    return view('backend.login');
});
Route::get('/admin-register', function () {
    return view('backend.register');
});

Route::get('/admin-dashboard', function () {
    return view('backend.index');
});
Route::post('/registerAdmin', [AdminUsersController::class, 'store']);
Route::POST('/adminLogin', [AdminUsersController::class, 'login']);


Route::group(["prefix" => "admin", "as" => "admin."], function () {
    
    Route::get('/addmovie', [MovieController::class, 'addmovie'])->name('addmovie');
    Route::POST('/movie-store', [MovieController::class, 'store'])->name('storemovie');
    Route::get('/listmovies', [MovieController::class, 'index'])->name('getmovies');
    Route::get('/addcategory', [MovieCategoryController::class, 'addcategory'])->name('addcategory');
    Route::post('/storecategory', [MovieCategoryController::class, 'store'])->name('storecategory');
    Route::get('/listcategory', [MovieCategoryController::class, 'index'])->name('listcategory');
    Route::get('/editcategory/{id}', [MovieCategoryController::class, 'edit'])->name('editcategory');
    Route::put('/updatecategory/{id}', [MovieCategoryController::class, 'update'])->name('updatecategory');

});