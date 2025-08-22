<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AttendanceController;


Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
});

// Dashboard Route (redirect /home to /dashboard)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// User Management Routes
Route::middleware(['auth', 'permission:users.view'])->group(function () {
    Route::view('/users', 'presentation.user-management.users.index')->name('users.index');
    Route::view('/departments', 'presentation.user-management.departments.index')->name('departments.index');
    Route::view('/positions', 'presentation.user-management.positions.index')->name('positions.index');
});


// Role Management Routes  
Route::middleware(['auth', 'permission:roles.view'])->group(function () {
    Route::get('/roles', function () {
        return view('roles.index');
    })->name('roles.index');
});

// Profile Settings Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', function () {
        return view('profile.index');
    })->name('profile.index');
});

Auth::routes();

Route::get('/home', function () {
    return redirect()->route('dashboard');
})->middleware(['auth'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::view('/attendance', 'attendance.index')->name('attendance.index');
    Route::view('/attendance/approvals', 'attendance.approvals')->name('attendance.approvals');
    Route::view('/attendance/submissions', 'attendance.submissions')->name('attendance.submissions');
});
Route::middleware(['auth'])->group(function () {
    Route::view('/learning/php-dasar', 'learning.php-dasar')->name('learning.php-dasar');
    Route::view('/learning/js-dasar', 'learning.js-dasar')->name('learning.js-dasar');
});

Route::middleware(['auth'])->group(function () {

    // Receiving
    Route::prefix('receiving')->name('receiving.')->group(function () {
        Route::redirect('/', '/receiving/input-head-location')->name('index');

        Route::view('/input-head-location', 'inventory.receiving.input-head-location')->name('input-head-location');
        Route::view('/input-location', 'inventory.receiving.input-location')->name('input-location');
        Route::view('/list-part-area', 'inventory.receiving.list-part-area')->name('list-part-area');
        Route::view('/manage-part-data', 'inventory.receiving.manage-part-data')->name('manage-part-data');
        Route::view('/report', 'inventory.receiving.report')->name('report');
    });

    // Inventory lainnya
    Route::prefix('inventory')->name('inventory.')->group(function () {
        Route::view('/warehouse', 'inventory.warehouse')->name('warehouse');
        Route::view('/finished-goods', 'inventory.finished-goods')->name('finished-goods');
        Route::view('/delivery', 'inventory.delivery')->name('delivery');
    });
});
