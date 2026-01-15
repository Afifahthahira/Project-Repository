<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DokumenController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\RakController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ActivityLogController;

// ============================================================
// PUBLIC (bebas akses)
// ============================================================

// Landing page
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Public search dokumen (tanpa login)
Route::get('/search', [DokumenController::class, 'publicSearch'])->name('public.search');

// Operasional Page
Route::get('/operasional', function () {
    return view('operasional.index');
})->name('operasional');

// ============================================================
// AUTH (login, register, logout)
// ============================================================

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::get('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');


// ============================================================
// DASHBOARD ROUTING (redirect berdasarkan role)
// ============================================================

Route::get('/dashboard', function () {

    // Pastikan user tidak null ketika belum login
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    // Redirect admin
    if (Auth::user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }


    // Dashboard user biasa
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// ============================================================
// PROFILE USER
// ============================================================

Route::middleware('auth')->group(function () {
    Route::get('/profile',  [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// ADMIN ROUTES
Route::middleware(['auth', 'isAdmin'])->group(function () {

    Route::get('/admin', [DashboardController::class, 'index'])
        ->name('admin.dashboard');

    Route::get('/admin/settings', function () {
        return view('admin.settings');
    })->name('admin.settings');

    Route::get('/admin/dokumen/{id}', [DokumenController::class, 'view'])
        ->name('admin.dokumen.view');
    
    Route::get('/admin/dokumen/{id}/download', [DokumenController::class, 'download'])
        ->name('admin.dokumen.download');


    Route::get('/admin/dokumen', [DokumenController::class, 'index'])
        ->name('admin.dokumen')
        ->middleware(['auth', 'isAdmin']);




    Route::resource('dokumen', DokumenController::class);
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('kategori', KategoriController::class);
    });
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('rak', RakController::class);
        Route::resource('divisi', DivisiController::class);
        Route::resource('users', UserController::class);
        Route::get('activity-logs', [ActivityLogController::class, 'index'])->name('activity-logs.index');
        Route::get('activity-logs/export', [ActivityLogController::class, 'export'])->name('activity-logs.export');
    });
});



// USER ROUTES
Route::middleware(['auth'])->group(function () {

    Route::get('/user-dashboard', function () {
        return view('dashboard');
    })->name('user.dashboard');
});


// ============================================================
// USER – lihat dokumen tertentu setelah login
// ============================================================

Route::get('/dokumen/view/{id}', [DokumenController::class, 'showPublic'])
    ->middleware('auth')
    ->name('dokumen.view');


require __DIR__ . '/auth.php';
