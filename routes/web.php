<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard'); // kõik mis kasutavad auth middleware siis vaatab üle kas on õigusi ja suunab vastavalt


// Route::middleware('auth')->prefix('/admin')->group(function () { kui soov eraldi nn kaustale reegel lisada
Route::middleware('auth')->group(function () {
    Route::resource('authors', AuthorController::class); // php artisan route:list
    Route::resource('clients', ClientController::class);
    Route::resource('orders', OrderController::class);
    Route::resource('clients', ClientController::class);
    Route::resource('books', BookController::class);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::delete('/detachauthor/{book}', [BookController::class, 'detachAuthor'])->name('book.detach.author');
    Route::post('/attachauthor/{book}', [BookController::class, 'attachAuthor'])->name('book.attach.author');
    Route::get('search', [BookController::class, 'search'])->name('search');
    Route::get('searchauthors', [AuthorController::class, 'searchauthors'])->name('searchauthors');
});


require __DIR__ . '/auth.php';
