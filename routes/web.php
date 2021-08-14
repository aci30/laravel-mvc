<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\AuthorController;

use App\Models\Book;
use App\Models\Author;

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
    return view('index', [
        'books' => Book::with('author')->paginate(10),
        'authors' => Author::all()
    ]);
})->name('index');

Route::get('/book/{id}', function ($id) {
    return view('book', [
        'book' => Book::with('author')->findOrFail($id),
    ]);
})->name('book');

Route::get('/author/{id}', function ($id) {
    return view('author', [
        'author' => Author::with('books')->findOrFail($id),
    ]);
})->name('author');


//Admin section
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', function () {
        return view('admin.index');
    })->name('index');
    Route::resource('books', BookController::class);
    Route::resource('authors', AuthorController::class);
});