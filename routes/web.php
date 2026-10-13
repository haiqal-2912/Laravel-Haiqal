<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\DashboardController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home',[HomeController::class, 'index']);
Route::post('question/store', [QuestionController::class, 'store'])
		->name('question.store');

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
// Route untuk mengirim data dari form
Route::post('/kirim-jawaban', [QuestionController::class, 'store']);

// Route halaman tujuan tempat data ditampilkan
Route::get('/home-question-respon', function () {
    return view('home-question-respon');
});
