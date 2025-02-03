<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\AccountController;

use App\Http\Controllers\common\EsignAadharController;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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

// Home START
Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('/books', [IndexController::class, 'fetchBooks'])->name('books.fetch');

Route::get('/book/{id}', [IndexController::class, 'show'])->name('book.details');
Route::get('/book/{id}/reviews', [IndexController::class, 'fetchReviews'])->name('book.reviews'); 
Route::post('/book/review/store', [IndexController::class, 'store'])->name('review.store'); 
Route::post('/book/review/update', [IndexController::class, 'update'])->name('review.update'); 
Route::post('/book/review/delete', [IndexController::class, 'delete'])->name('review.delete'); 

Route::post('/login', [AccountController::class, 'customer_login'])->name('customer.login');

Route::get('/logout', [AccountController::class, 'customer_logout'])->name('customer.logout');

Route::post('/register', [AccountController::class, 'register'])->name('register');


Route::middleware('auth.frontend')->group(function () {

    Route::get('/edituserprofile', [AccountController::class, 'edit_user_profile'])->name('edit-user-profile');

    Route::post('/customer-account-update-profile', [AccountController::class, 'account_update_profile'])->name('account.customer.update.profile');

    Route::get('/reset-passoword', [AccountController::class, 'reset_password'])->name('customer.reset_password');
    Route::post('/customer-password-update', [AccountController::class, 'reset_password_update'])->name('customer.password.update');

});

Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('view:clear');
    //$exitCode = Artisan::call('route:cache');
    //$exitCode = Artisan::call('key:generate');
});

Route::get('/key-generate', function () {
    Artisan::call('key:generate', ['--show' => true]);
    return 'Application key generated successfully!';
});

Route::get('/create-storage-link', function () {
    $exitCode = Artisan::call('storage:link');
    
    if ($exitCode === 0) {
        return 'Storage link created successfully.';
    } else {
        return 'Error creating storage link.';
    }
});


