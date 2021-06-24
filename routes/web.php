<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ManualController;
use App\Http\Controllers\TutorialController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('welcome');

Route::view('/home', 'home')->name('home');

Route::middleware('auth')->group(function () {

    Route::get('/tutorial/create', [TutorialController::class, 'create'])->name('tutorial.create');
    Route::post('/tutorial/create', [TutorialController::class, 'store'])->name('tutorial.store');
    Route::get('/tutorial/{tutorial}', [TutorialController::class, 'show'])->name('tutorial.show');

    Route::get('/article/create', [ArticleController::class, 'create'])->name('article.create');
    Route::post('/article/create', [ArticleController::class, 'store'])->name('article.store');

    Route::get('/manual/create', [ManualController::class, 'create'])->name('manual.create');
    Route::post('/manual/create', [ManualController::class, 'store'])->name('manual.store');

});
