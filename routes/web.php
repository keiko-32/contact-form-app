<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

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

Route::get('/', [ContactController::class, 'index']);
Route::get('/contacts', [ContactController::class, 'index'])->name('contact.index');
Route::get('/contacts', [ContactController::class, 'showConfirm'])->name('contact.showConfirm');
Route::post('/contacts/confirm', [ContactController::class, 'confirm'])->name('contact.confirm');
Route::post('/contacts', [ContactController::class, 'send'])->name('contact.send');
Route::get('/contacts/thanks', [ContactController::class, 'thanks'])->name('contact.thanks');

