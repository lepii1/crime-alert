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

//    if (Auth::check()) {
//        if (Auth::user()->role === 'admin') {
//            return view('welcome_admin');
//        } else {
//            return view('welcome_user');
//        }
//    }

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
    Route::get('/dashboard', function () {
        if (auth()->user()->role !== 'user') {
            auth()->logout();
            return redirect('/login')->with('error', 'Akses ditolak! Anda bukan user.');
        }
        return view('user.dashboard');
    })->name('user.dashboard');

    Route::get('/laporan/create', [LaporanController::class, 'create'])->name('laporan.create');
    Route::post('/laporan', [LaporanController::class, 'store'])->name('laporan.store');
});

/*
|--------------------------------------------------------------------------
| Admin routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        if (auth()->user()->role !== 'admin') {
            auth()->logout();
            return redirect('/login')->with('error', 'Akses ditolak! Anda bukan admin.');
        }
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/laporan', [AdminLaporanController::class, 'adminIndex'])->name('admin.laporan.index');
    Route::get('/laporan/{id}', [AdminLaporanController::class, 'show'])->name('admin.laporan.show');
    Route::get('/laporan/{id}/edit', [AdminLaporanController::class, 'edit'])->name('admin.laporan.edit');
    Route::put('/laporan/{id}', [AdminLaporanController::class, 'update'])->name('admin.laporan.update');
    Route::delete('/laporan/{id}', [AdminLaporanController::class, 'destroy'])->name('admin.laporan.destroy');
    Route::get('/laporan/{id}/assign', [LaporanController::class, 'assignForm'])->name('admin.laporan.assign');
    Route::post('/laporan/{id}/assign', [LaporanController::class, 'assignStore'])->name('admin.laporan.assign.store');
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
});


//Route::prefix('polisi')->name('polisi.')->group(function () {
//    Route::get('/polisi/login', [PolisiAuthController::class, 'showLoginForm'])->name('login');
//    Route::post('/polisi/login', [PolisiAuthController::class, 'login'])->name('login.submit');
//    Route::post('/polisi/logout', [PolisiAuthController::class, 'logout'])->name('logout');
//
//    Route::middleware('auth:polisi')->group(function () {
//        Route::get('/polisi/dashboard', function () {
//            return view('polisi.dashboard');
//        })->name('dashboard');
//    });
//});
/*
|--------------------------------------------------------------------------
| Auth (breeze)
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';
