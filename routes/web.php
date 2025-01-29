<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertyController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\PaymentController;




 //regularroute for the navbar menu


Route::get('/about', function () {
    return view('about');
})->name('about');


Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/service', function () {
    return view('services');
})->name('service');


Route::get('/all-properties', [PropertyController::class, 'allProperties'])->name('all-properties');

Route::get('/', [PropertyController::class, 'index'])->name('properties.index');

Route::get('/properties/{id}/book', [InquiryController::class, 'create'])->name('properties.book');
//Route::post('/properties/{id}/book', [InquiryController::class, 'store'])->name('properties.book.submit');
Route::post('/properties/{property}/book/pay', [PaymentController::class, 'handleBookingAndPayment'])->name('properties.book.pay');
Route::get('/payment/success', [PaymentController::class, 'paymentSuccess'])->name('payment.success');
Route::get('/payment/cancel', [PaymentController::class, 'paymentCancel'])->name('payment.cancel');



Route::get('/properties/{id}', [PropertyController::class, 'show'])->name('show');




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
