<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuestionController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home',[HomeController::class, 'index']);


Route::post('question/store', [QuestionController::class, 'store'])
		->name('question.store');
