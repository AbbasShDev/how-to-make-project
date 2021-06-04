<?php

use App\Http\Controllers\CKEditorController;
use App\Http\Controllers\TutorialController;
use Illuminate\Support\Facades\Route;

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

Route::view('/','welcome')->name('welcome');

Route::view('/home', 'home');

Route::get('/tutorial/create', [TutorialController::class, 'create'])->name('tutorial.create');
Route::post('/tutorial/create', [TutorialController::class, 'store'])->name('tutorial.store');

Route::post('ckeditor/upload', [CKEditorController::class, 'upload'])->name('ckeditor.image-upload');
