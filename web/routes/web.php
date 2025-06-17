<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


use Illuminate\Support\Facades\Mail;

Route::get('/test-mail', function () {
    Mail::raw('This is a test email from DISASTERLINK.', function ($message) {
        $message->to('22-69938@g.batstate-u.edu.ph') // Replace with your Mailtrap email or any email
                ->subject('DISASTERLINK Test Email');
    });

    return 'Test email sent!';
});


Route::middleware(['auth', 'role:admin'])->get('/admin-test', function () {
    return 'Hello, Admin!';
});

