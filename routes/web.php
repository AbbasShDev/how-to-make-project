<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Dashboard\DashboardManualController;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\ManualController;
use App\Http\Controllers\TutorialController;
use \App\Http\Controllers\ProfileController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\DashboardTutorialController;
use App\Http\Controllers\Dashboard\DashboardArticleController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('welcome');

Route::view('/home', 'home')->name('home');

Route::get('/user/{user}', [ProfileController::class, 'show'])->name('profile.show');

Route::post('upload-uppy-files', [FileUploadController::class, "uppy"])->name('upload.uppy.files');

Route::middleware('auth')->group(function () {

    Route::get('/user/{user}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/user/{user}', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/user/{user}/password', [ProfileController::class, 'updatePassword'])->name('profile.update.password');
    Route::patch('/user/{user}/picture', [ProfileController::class, 'updatePicture'])->name('profile.update.picture');

    Route::get('/tutorial/create', [TutorialController::class, 'create'])->name('tutorial.create');
    Route::post('/tutorial/create', [TutorialController::class, 'store'])->name('tutorial.store');

    Route::get('/article/create', [ArticleController::class, 'create'])->name('article.create');
    Route::post('/article/create', [ArticleController::class, 'store'])->name('article.store');

    Route::get('/manual/create', [ManualController::class, 'create'])->name('manual.create');
    Route::post('/manual/create', [ManualController::class, 'store'])->name('manual.store');

    Route::prefix('dashboard')->as('dashboard.')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('index');

        Route::get('/tutorials', [DashboardTutorialController::class, 'index'])->name('tutorial.index');
        Route::delete('/tutorial/{tutorial}', [DashboardTutorialController::class, 'destroy'])->name('tutorial.destroy')
            ->can("delete", "tutorial");

        Route::middleware('can:update,tutorial')->group(function () {
            Route::get('/tutorial/{tutorial}/edit', [DashboardTutorialController::class, 'edit'])->name('tutorial.edit');
            Route::put('/tutorial/{tutorial}', [DashboardTutorialController::class, 'update'])->name('tutorial.update');
        });

        Route::get('/articles', [DashboardArticleController::class, 'index'])->name('article.index');
        Route::delete('/article/{article}', [DashboardArticleController::class, 'destroy'])->name('article.destroy')
            ->can("delete", "article");

        Route::middleware('can:update,article')->group(function () {
            Route::get('/article/{article}/edit', [DashboardArticleController::class, 'edit'])->name('article.edit');
            Route::put('/article/{article}', [DashboardArticleController::class, 'update'])->name('article.update');
        });

        Route::get('/manuals', [DashboardManualController::class, 'index'])->name('manual.index');
        Route::delete('/manual/{manual}', [DashboardManualController::class, 'destroy'])->name('manual.destroy')
            ->can("delete", "manual");

        Route::middleware('can:update,manual')->group(function () {
            Route::get('/manual/{manual}/edit', [DashboardManualController::class, 'edit'])->name('manual.edit');
            Route::put('/manual/{manual}', [DashboardManualController::class, 'update'])->name('manual.update');
        });


    });
});

Route::get('/tutorial/{tutorial}', [TutorialController::class, 'show'])->name('tutorial.show');
Route::get('/article/{article}', [ArticleController::class, 'show'])->name('article.show');
Route::get('/manual/{manual}', [ManualController::class, 'show'])->name('manual.show');
