<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('user.registration');
});

Route::post('/register', [ProfileController::class, 'register'])->name('Register');
Route::get('/login', [ProfileController::class, 'login'])->name('Login');
Route::post('/checkmail', [ProfileController::class, 'checkmail'])->name('CheckEmail');
Route::get('/generate-qrcode/{id}', [ProfileController::class, 'generate_qrcode'])->name('GenerateQrcode');
Route::get('/get-profile/{id}', [ProfileController::class, 'get_profile'])->name('GetProfile');
Route::post('/update-profile/{id}', [ProfileController::class, 'update_profile'])->name('UpdateProfile');
Route::get('/get-all-user', [ProfileController::class, 'get_all_user'])->name('GetAllUser');
