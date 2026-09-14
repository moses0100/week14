<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClaimController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BlogController;

//นักอ่าน
Route::get('/', [BlogController::class, 'index']);
Route::get('detail/{id}', [BlogController::class,'detail']);
Route::get('/about', function () {
    return view('about');
});

Route::get('/blog', function () {
    return redirect()->route('author.blogs');
})->name('blog');

Route::get('/student/{id}', function ($id) {
    return view('student', ['id' => $id]);
})->name('student.profile');
//นักเขียน
Route::prefix('author')->name('author.')->group(function () {
    Route::get('/abouts', [AdminController::class, 'abouts'])->name('abouts');
    Route::get('/blogs', [AdminController::class, 'blogs'])->name('blogs');
    Route::get('/create', [AdminController::class, 'create'])->name('create');
    Route::post('/insert', [AdminController::class, 'insert'])->name('insert');
    Route::get('/delete/{id}', [AdminController::class, 'delete'])->name('delete');
    Route::get('/change/{id}', [AdminController::class, 'change'])->name('change');
    Route::get('/edit/{id}', [AdminController::class, 'edit'])->name('edit');
    Route::post('/update/{id}', [AdminController::class, 'update'])->name('update');
});

Route::get('/test-db', function () {
    try {
        DB::connection()->getPdo();
        return "เชื่อมต่อฐานข้อมูลสำเร็จ! Database name: " . DB::connection()->getDatabaseName();
    } catch (\Exception $e) {
        return "ไม่สามารถเชื่อมต่อฐานข้อมูลได้: " . $e->getMessage();
    }
});

Route::get('/claims/create', [ClaimController::class, 'create'])->name('claims.create');
Route::post('/claims', [ClaimController::class, 'store'])->name('claims.store');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::fallback(function () {
    return 'ไม่พบหน้าเว็บ';
});
