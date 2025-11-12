<?php
////
////use App\Http\Controllers\ProfileController;
////use Illuminate\Support\Facades\Route;
////use App\Http\Controllers\LaporanController;
////use App\Http\Controllers\Admin\LaporanController as AdminLaporanController;
////
////Route::get('/', function () {
////    return view('welcome');
////});
////
////Route::get('/dashboard', function () {
////    return view('dashboard');
////})->middleware(['auth', 'verified'])->name('dashboard');
////
////Route::middleware('auth')->group(function () {
////    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
////    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
////    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
////});
////
////Route::middleware('auth')->group(function () {
////
////    // Rute khusus admin dengan middleware role
////    Route::get('/admin', function () {
////        return view('admin.dashboard');
////    })->middleware('role:admin');
////
////    // Rute khusus user dengan middleware role
////    Route::get('/user', function () {
////        return view('user');
////    })->middleware('role:user');
////});
////
////
////// Untuk user
////Route::middleware(['auth', 'role:user'])->group(function () {
////    Route::get('/laporan/create', [LaporanController::class, 'create'])->name('laporan.create');
////    Route::post('/laporan', [LaporanController::class, 'store'])->name('laporan.store');
////});
////
////// Untuk admin
////Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
////    Route::get('/admin/laporan', [AdminLaporanController::class, 'adminIndex'])->name('admin.laporan.index');
////    Route::get('/laporan/{id}', [AdminLaporanController::class, 'show'])->name('admin.laporan.show');
////    Route::get('/laporan/{id}/edit', [AdminLaporanController::class, 'edit'])->name('admin.laporan.edit');
////    Route::put('/laporan/{id}', [AdminLaporanController::class, 'update'])->name('admin.laporan.update');
////    Route::delete('/laporan/{id}', [AdminLaporanController::class, 'destroy'])->name('admin.laporan.destroy');
////});
////
////require __DIR__.'/auth.php';
//
//
//use App\Http\Controllers\ProfileController;
//use App\Http\Controllers\LaporanController;
//use App\Http\Controllers\Admin\LaporanController as AdminLaporanController;
//use Illuminate\Support\Facades\Route;
//
//Route::get('/', function () {
//    return view('welcome.user');
//})->name('welcome.user');
//
//Route::get('/admin', function () {
//    return view('welcome_admin');
//})->name('welcome.admin');
//
////Route::get('/dashboard', function () {
////    return view('dashboard');
////})->middleware(['auth', 'verified'])->name('dashboard');
//
///*
//|--------------------------------------------------------------------------
//| PROFILE (semua role)
//|--------------------------------------------------------------------------
//*/
//Route::middleware('auth')->group(function () {
//    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
//});
//
///*
//|--------------------------------------------------------------------------
//| USER ROUTES
//|--------------------------------------------------------------------------
//*/
//Route::middleware(['auth', 'role:user'])->prefix('user')->group(function () {
//    // dashboard user
//    Route::get('/', function () {
//        return view('user.dashboard');
//    })->name('user.dashboard');
//
//    // form buat laporan
//    Route::get('/laporan/create', [LaporanController::class, 'create'])->name('laporan.create');
//
//    // simpan laporan
//    Route::post('/laporan', [LaporanController::class, 'store'])->name('laporan.store');
//});
//
///*
//|--------------------------------------------------------------------------
//| ADMIN ROUTES
//|--------------------------------------------------------------------------
//*/
//Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
//    // dashboard admin
//    Route::get('/', function () {
//        return view('admin.dashboard');
//    })->name('admin.dashboard');
//
//    // daftar laporan (index)
//    Route::get('/laporan', [AdminLaporanController::class, 'adminIndex'])->name('admin.laporan.index');
//
//    // detail laporan
//    Route::get('/laporan/{id}', [AdminLaporanController::class, 'show'])->name('admin.laporan.show');
//
//    // edit laporan
//    Route::get('/laporan/{id}/edit', [AdminLaporanController::class, 'edit'])->name('admin.laporan.edit');
//    Route::put('/laporan/{id}', [AdminLaporanController::class, 'update'])->name('admin.laporan.update');
//
//    // hapus laporan
//    Route::delete('/laporan/{id}', [AdminLaporanController::class, 'destroy'])->name('admin.laporan.destroy');
//});
//
//require __DIR__ . '/auth.php';


use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\Admin\LaporanController as AdminLaporanController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Default route (login & halaman awal)
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
})->name('home');

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
});

/*
|--------------------------------------------------------------------------
| Auth (breeze)
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';
