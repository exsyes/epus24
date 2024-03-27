<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowedBookController;
use App\Http\Controllers\borrowerController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\OnlyAdminMiddleware;
use App\Http\Middleware\OnlyGuestMiddleware;
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

//Route::get('/dashboard', function () {
//    return view('dashboard');
//});
//Route::get('/books', function () {
//    return view('books');
//});

Route::controller(BookController::class)->middleware([OnlyAdminMiddleware::class])->group(function (){
//    Route untuk manajemen buku
    Route::get('/books', 'books');
    Route::post('/books/store', 'createBook');
    Route::post('/books/{id}/delete', 'removeBook');

//    Route untuk peminjaman buku
});

Route::controller(BorrowedBookController::class)->middleware([OnlyAdminMiddleware::class])->group(function (){
    Route::post('/borrowed-books/store', 'storeBorrowedBooks');
    Route::post('/borrowed-books/{id}/update', 'updateBorrowedBooks');
    Route::get('/borrowed-books', 'borrowedBooks');
    Route::post('/borrowed-books/{id}/delete', 'delete');
});

Route::controller(UserController::class)->group(function (){
    Route::get("/login","login")->middleware([OnlyGuestMiddleware::class]);
    Route::post("/login", "doLogin")->middleware([OnlyGuestMiddleware::class]);
    Route::get("/logout",  "doLogout")->middleware([OnlyAdminMiddleware::class]);

});


Route::controller(BorrowerController::class)->group(function (){
    Route::get('/borrowers', 'borrowers');
});

Route::fallback(function (){
    return redirect('login');
});
