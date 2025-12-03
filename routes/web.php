<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\Admin\LaporanController as AdminLaporanController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\PolisiAuthController;
use App\Http\Controllers\Auth\PolisiDashboardController;


/*
|--------------------------------------------------------------------------
| Default route (login & halaman awal)
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    if (auth('polisi')->check()) {
        return redirect()->route('polisi.dashboard');
    }

    if (auth('web')->check()) {
        if (auth()->user()->role === 'admin') {
            return view('welcome_admin');
        } else {
            return view('welcome_user');
        }
    }

    // jika belum login
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Halaman Admin & User (bisa diakses langsung kalau login)
|--------------------------------------------------------------------------
*/
Route::get('/admin', function () {
    // Kalau belum login → redirect ke login
    if (!auth()->check()) {
        return redirect('/login');
    }

    // Kalau bukan admin → lempar ke login
    if (auth()->user()->role !== 'admin') {
        auth()->logout();
        return redirect('/login')->with('error', 'Akses ditolak! Anda bukan admin.');
    }

    // Kalau role admin → tampilkan halaman admin
    return view('welcome_admin');
})->name('welcome.admin');

Route::get('/user', function () {
    // Kalau belum login → redirect ke login
    if (!auth()->check()) {
        return redirect('/login');
    }

    // Kalau bukan user → lempar ke login
    if (auth()->user()->role !== 'user') {
        auth()->logout();
        return redirect('/login')->with('error', 'Akses ditolak! Anda bukan user.');
    }

    // Kalau role user → tampilkan halaman user
    return view('welcome_user');
})->name('welcome.user');

/*
|--------------------------------------------------------------------------
| Profile (semua role)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| User routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('user')->group(function () {
    // FIX: Mengganti Closure dengan pemanggilan Controller LaporanController@dashboard
    Route::get('/dashboard', [LaporanController::class, 'dashboard'])->name('user.dashboard');

    Route::get('/laporan/create', [LaporanController::class, 'create'])->name('laporan.create');
    Route::post('/laporan', [LaporanController::class, 'store'])->name('laporan.store');
    Route::get('/laporan/{id}', [LaporanController::class, 'show'])->name('laporan.show');
});

/*
|--------------------------------------------------------------------------
| Admin routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('admin')->group(function () {
    // FIX: Memastikan rute dashboard memanggil Controller admin
    Route::get('/dashboard', [AdminLaporanController::class, 'dashboard'])
        ->name('admin.dashboard');

    // RUTE BARU UNTUK CHART/REPORTS
    Route::get('/laporan/reports', [AdminLaporanController::class, 'reports'])->name('admin.laporan.reports');

    Route::get('/laporan', [AdminLaporanController::class, 'adminIndex'])->name('admin.laporan.index');
    Route::get('/laporan/{id}', [AdminLaporanController::class, 'show'])->name('admin.laporan.show');
    Route::get('/laporan/{id}/edit', [AdminLaporanController::class, 'edit'])->name('admin.laporan.edit');
    Route::put('/laporan/{id}', [AdminLaporanController::class, 'update'])->name('admin.laporan.update');
    Route::delete('/laporan/{id}', [AdminLaporanController::class, 'destroy'])->name('admin.laporan.destroy');

    // FIX PENTING: Mengganti LaporanController::assignStore menjadi AdminLaporanController::assignStore
    Route::get('/laporan/{id}/assign', [AdminLaporanController::class, 'assignForm'])->name('admin.laporan.assign');
    Route::post('/laporan/{id}/assign', [AdminLaporanController::class, 'assignStore'])->name('admin.laporan.assign.store');
});

// Welcome Polisi (tanpa login)
Route::get('/polisi', function () {
    return view('welcome_polisi');
})->name('polisi.welcome');

// Login
Route::get('/polisi/login', [PolisiAuthController::class, 'showLoginForm'])->name('polisi.login');
Route::post('/polisi/login', [PolisiAuthController::class, 'login'])->name('polisi.login.submit');
Route::post('/polisi/logout', [PolisiAuthController::class, 'logout'])->name('polisi.logout');

// ✅ Tambahan untuk Register Polisi
Route::get('/polisi/register', [PolisiAuthController::class, 'showRegisterForm'])->name('polisi.register');
Route::post('/polisi/register', [PolisiAuthController::class, 'register'])->name('polisi.register.submit');

// Dashboard
Route::middleware('auth:polisi')->prefix('polisi')->name('polisi.')->group(function () {
    Route::get('/dashboard', [PolisiDashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/laporan/{id}', [PolisiDashboardController::class, 'show'])
        ->name('laporan.show');

    Route::get('/profil', [PolisiDashboardController::class, 'profil'])
        ->name('profil');

    Route::get('/profil/edit', [PolisiDashboardController::class, 'edit'])->name('edit');
    Route::put('/profil/{id}', [PolisiDashboardController::class, 'update'])->name('update');

    Route::post('/laporan/{id}/status',
        [PolisiDashboardController::class, 'updateStatus'])
        ->name('laporan.status');

    Route::post('/laporan/{id}/tangani', [PolisiDashboardController::class, 'tangani'])
        ->name('laporan.tangani');

    Route::get('/laporan/{id}/edit', [PolisiDashboardController::class, 'editLaporan'])
        ->name('laporan.edit');

    Route::put('/laporan/{id}', [PolisiDashboardController::class, 'updateStatus'])
        ->name('laporan.update');

});

require __DIR__ . '/auth.php';
