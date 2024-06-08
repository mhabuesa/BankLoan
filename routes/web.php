<?php

use App\Http\Controllers\BankController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index'])->middleware('auth', 'verified')->name('index');
Route::get('/user', [UserController::class, 'user'])->middleware('auth', 'verified')->name('user');
Route::post('/add/user', [UserController::class, 'add_user'])->name('add.user');
Route::get('/user/delete/{id}', [UserController::class, 'user_delete'])->name('user.delete');
Route::get('/user/info/{id}', [UserController::class, 'user_info'])->name('user.info');


Route::get('/bank', [BankController::class, 'bank'])->name('bank');
Route::post('/bank/store', [BankController::class, 'bank_store'])->name('bank.store');

Route::get('/loan', [LoanController::class, 'loan'])->middleware('auth', 'verified')->name('loan');
Route::get('/showUserInfo/{id}', [LoanController::class, 'showUserInfo'])->name('showUserInfo');
Route::post('/loan/calculate', [LoanController::class, 'loan_calculate'])->name('loan.calculate');
Route::post('/loan/store', [LoanController::class, 'loan_store'])->name('loan.store');
Route::get('/loan/history', [LoanController::class, 'loan_history'])->name('loan.history');
Route::get('/showUserLoan/{id}', [LoanController::class, 'showUserLoan'])->name('showUserLoan');












Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
