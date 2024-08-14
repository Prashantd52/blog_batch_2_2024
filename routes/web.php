<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ReportController;

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

Route::get('/dashboard', function () {
    // return view('dashboard');
    return view('backend.dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/categories/index', [CategoryController::class, 'index'])->name('categories.list');
Route::post('/categories/data', [CategoryController::class, 'get_data'])->name('categories.get_data');
Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::post('/categories/store', [CategoryController::class, 'store'])->name('categories.store');

Route::prefix('blog')->name('blogs.')->group(function () {
    Route::get('/index', [BlogController::class, 'index'])->name('list');
    Route::get('/create', [BlogController::class, 'create'])->name('create');
    Route::post('/store', [BlogController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [BlogController::class, 'edit'])->name('edit');

    Route::get('{slug}/show', [BlogController::class, 'show'])->name('show');
});

Route::prefix('reports')->name('reports.')->group(function(){
    Route::get('user_blogs', [ReportController::class, 'user_blogs'])->name('user_blogs');
});
