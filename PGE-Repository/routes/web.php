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
use App\Http\Controllers\ChatbotController;

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

    // Dashboard user biasa - tampilkan data personal
    $user = Auth::user();
    
    // Dokumen yang baru diakses oleh user ini
    $recentActivities = \App\Models\Aktivitas::with(['dokumen'])
        ->where('user_id', $user->id_user)
        ->orderBy('created_at', 'DESC')
        ->limit(5)
        ->get();
    
    // Dokumen berdasarkan divisi user (rekomendasi)
    $recommendedDocs = \App\Models\Dokumen::with(['kategori', 'rak', 'divisi'])
        ->where('status', 'aktif');
    
    if ($user->id_divisi) {
        $recommendedDocs = $recommendedDocs->where('id_divisi', $user->id_divisi);
    }
    
    $recommendedDocs = $recommendedDocs->orderBy('id_dokumen', 'DESC')
        ->limit(6)
        ->get();
    
    // Dokumen populer (untuk semua)
    $popularDocs = \App\Models\Dokumen::with(['kategori', 'rak', 'divisi'])
        ->where('status', 'aktif')
        ->orderBy('id_dokumen', 'DESC')
        ->limit(4)
        ->get();
    
    // Statistik personal
    $myDownloads = \App\Models\Aktivitas::where('user_id', $user->id_user)
        ->where('action', 'downloaded')
        ->count();
    
    $myViews = \App\Models\Aktivitas::where('user_id', $user->id_user)
        ->where('action', 'viewed')
        ->count();

    return view('dashboard', compact('recentActivities', 'recommendedDocs', 'popularDocs', 'myDownloads', 'myViews', 'user'));
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
        ->name('admin.dokumen');




    Route::resource('dokumen', DokumenController::class);

    // Resource routes dengan middleware auth.redirect
    Route::prefix('admin')->name('admin.')->middleware(['auth.redirect'])->group(function () {
        Route::resource('kategori', KategoriController::class);
        Route::resource('rak', RakController::class);
        Route::resource('divisi', DivisiController::class);
        Route::resource('users', UserController::class);
        Route::get('activity-logs', [ActivityLogController::class, 'index'])->name('activity-logs.index');
        Route::get('activity-logs/export', [ActivityLogController::class, 'export'])->name('activity-logs.export');
        Route::get('notifications', [ActivityLogController::class, 'getNotifications'])->name('notifications');
        Route::get('chat-history', [ChatbotController::class, 'history'])->name('chat-history.index');
    });
});



// USER ROUTES
Route::middleware(['auth.redirect'])->group(function () {

    Route::get('/user-dashboard', function () {
        return view('dashboard');
    })->name('user.dashboard');

    // Chatbot (dapat diakses baik oleh user maupun admin selama sudah login)
    Route::get('/chatbot', [ChatbotController::class, 'index'])
        ->name('chatbot.index');
    Route::post('/chatbot/send', [ChatbotController::class, 'send'])
        ->name('chatbot.send');
});


// ============================================================
// USER – lihat dokumen tertentu setelah login
// ============================================================

Route::get('/dokumen/view/{id}', [DokumenController::class, 'showPublic'])
    ->middleware('auth.redirect')
    ->name('dokumen.view');

// Download dokumen untuk user biasa
Route::get('/dokumen/{id}/download', [DokumenController::class, 'download'])
    ->middleware('auth.redirect')
    ->name('dokumen.download');

// ============================================================
// USER DOCUMENTS - untuk semua user yang sudah login
// ============================================================

Route::middleware(['auth.redirect'])->group(function () {
    Route::get('/documents', function () {
        if (Auth::user()->role === 'admin') {
            return redirect('/admin/dokumen');
        }

        // Untuk user biasa, tampilkan halaman documents
        $dokumen = \App\Models\Dokumen::with(['kategori', 'rak', 'divisi'])
            ->where('status', 'aktif')
            ->orderBy('id_dokumen', 'DESC')
            ->get();

        return view('user.documents', compact('dokumen'));
    })->name('user.documents');
});


require __DIR__ . '/auth.php';

