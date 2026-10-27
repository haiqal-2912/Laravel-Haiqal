<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PengalamanController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\SkillController;
use App\Models\Pengalaman;
use App\Models\Profil;
use App\Models\Skill;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [HomeController::class, 'index']);
Route::post('question/store', [QuestionController::class, 'store'])
    ->name('question.store');

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/home-question-respon', [QuestionController::class, 'respon']);

Route::resource('pelanggan', PelangganController::class);

Route::get('/', function () {
    return view('cv', [
        'profil'     => Profil::first(),
        'pengalaman' => Pengalaman::orderByDesc('tahun_mulai')->get(),
        'skills'     => Skill::orderBy('kategori')->get()->groupBy('kategori'),
    ]);
})->name('cv');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('pengalaman', PengalamanController::class)->except('show');
    Route::resource('skill', SkillController::class)->except('show');
});

Route::get('profil', [ProfilController::class, 'edit'])->name('profil.edit');
Route::put('profil', [ProfilController::class, 'update'])->name('profil.update');
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('profil', [ProfilController::class, 'edit'])->name('profil.edit');
    Route::put('profil', [ProfilController::class, 'update'])->name('profil.update');

    Route::resource('pengalaman', PengalamanController::class)->except('show');
    Route::resource('skill', SkillController::class)->except('show');
});
