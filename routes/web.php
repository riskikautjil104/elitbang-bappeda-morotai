<?php

use App\Http\Controllers\Admin\ReportAdminController;
use App\Http\Controllers\Admin\Role\RoleAdminController;
use App\Http\Controllers\Admin\User\UserAdminController;
use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\Reports\ReportAppController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaporanExportController;

/*
|--------------------------------------------------------------------------
| Root Route - Halaman Frontend (Public)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:opd'])->prefix('dashboard-opd')->group(function () {
    Route::get('/dokumen-perencanaan', [\App\Http\Controllers\Opd\DokumenPerencanaanController::class, 'index'])
        ->name('opd.dokumen.index');
    Route::get('/dokumen-perencanaan/{dokumenPerencanaan}', [\App\Http\Controllers\Opd\DokumenPerencanaanController::class, 'show'])
        ->name('opd.dokumen.show');
    Route::get('/dokumen-perencanaan/{dokumenPerencanaan}/download', [\App\Http\Controllers\Opd\DokumenPerencanaanController::class, 'download'])
        ->name('opd.dokumen.download');
});

// Untuk OPD
Route::middleware(['auth', 'role:opd'])->group(function() {
    Route::get('/panduan', function() {
        return view('panduan.index');
    })->name('panduan');
});

// Untuk Superadmin
Route::middleware(['auth', 'role:superadmin'])->group(function() {
    Route::get('/panduan', function() {
        return view('panduan.index');
    })->name('admin.panduan');
});
Route::get('/', [FrontendController::class, 'home'])->name('frontend.home');
Route::get('/data', [FrontendController::class, 'data'])->name('frontend.data');
Route::get('/data/{id}', [FrontendController::class, 'dataDetail'])->name('frontend.data-detail');
Route::get('/opd', [FrontendController::class, 'opd'])->name('frontend.opd');
Route::get('/opd/{id}', [FrontendController::class, 'opdDetail'])->name('frontend.opd-detail');
// Frontend Routes untuk Tentang (Public)
Route::get('/tentang', [\App\Http\Controllers\Frontend\TentangController::class, 'index'])->name('frontend.tentang');
Route::get('/kontak', [\App\Http\Controllers\Frontend\KontakController::class, 'index'])->name('frontend.kontak');
// Frontend Routes untuk Dokumen Perencanaan (Public)
Route::get('/dokumen-perencanaan', [FrontendController::class, 'dokumenPerencanaan'])->name('frontend.dokumen');
Route::get('/dokumen-perencanaan/{id}', [FrontendController::class, 'dokumenPerencanaanDetail'])->name('frontend.dokumen.detail');
Route::get('/dokumen-perencanaan/{id}/download', [FrontendController::class, 'dokumenPerencanaanDownload'])->name('frontend.dokumen.download');

// Frontend Routes untuk Laporan Realisasi Anggaran (Public)
Route::get('/laporan-realisasi-anggaran', [FrontendController::class, 'laporanRealisasi'])->name('frontend.laporan-realisasi');
Route::get('/laporan-realisasi-anggaran/{id}', [FrontendController::class, 'laporanRealisasiDetail'])->name('frontend.laporan-realisasi.detail');

Route::middleware(['auth'])->group(function () {
    Route::get('/laporan/export/pdf/{id}', [LaporanExportController::class, 'exportPDF'])
        ->name('laporan.export.pdf');
    
    Route::get('/laporan/export/word/{id}', [LaporanExportController::class, 'exportWord'])
        ->name('laporan.export.word');
});
/*
|--------------------------------------------------------------------------
| Guest Routes
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login/authenticate', [LoginController::class, 'authenticate'])
        ->name('authenticate')
        ->middleware('throttle:5,1');

    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

    Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotForm'])
        ->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink'])
        ->name('password.email');
    Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetForm'])
        ->name('password.reset');
    Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword'])
        ->name('password.update');
});

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    
    // Logout
    Route::match(['get', 'post'], '/logout', [LoginController::class, 'logout'])->name('logout');

    // Change Password
    Route::get('/change-password', [DashboardController::class, 'showChangePasswordForm'])
        ->name('change-password.form');
    Route::post('/change-password', [DashboardController::class, 'changePassword'])
        ->name('change-password.update');

    // Change Password OPD
    Route::middleware(['role:opd'])->group(function () {
        Route::get('/change-password-opd', [DashboardController::class, 'showChangePasswordFormOpd'])
            ->name('change-password-opd.form');
        Route::post('/change-password-opd', [DashboardController::class, 'changePasswordOpd'])
            ->name('change-password-opd.update');
    });

    /*
    |--------------------------------------------------------------------------
    | Admin Routes (Superadmin Only)
    |--------------------------------------------------------------------------
    */
    Route::prefix('admin')->middleware(['role:superadmin'])->group(function () {
        
        // Role Management
        Route::prefix('roles')->name('admin.roles.')->group(function () {
            Route::get('/', [RoleAdminController::class, 'index'])->name('index');
            Route::get('/create', [RoleAdminController::class, 'create'])->name('create');
            Route::post('/', [RoleAdminController::class, 'store'])->name('store');
            Route::get('/{role}', [RoleAdminController::class, 'show'])->name('show');
            Route::get('/{role}/edit', [RoleAdminController::class, 'edit'])->name('edit');
            Route::put('/{role}', [RoleAdminController::class, 'update'])->name('update');
            Route::delete('/{role}', [RoleAdminController::class, 'destroy'])->name('destroy');
            
        });
        

        // User Management
        // Route::resource('users', UserController::class);
        // Route::get('user', [UserAdminController::class, 'index'])->name('admin.user.index');

        // Laporan Realisasi Anggaran
        Route::resource('laporan-realisasi', \App\Http\Controllers\Admin\LaporanRealisasiAnggaranController::class)->names([
            'index' => 'admin.laporan-realisasi.index',
            'create' => 'admin.laporan-realisasi.create',
            'store' => 'admin.laporan-realisasi.store',
            'show' => 'admin.laporan-realisasi.show',
            'edit' => 'admin.laporan-realisasi.edit',
            'update' => 'admin.laporan-realisasi.update',
            'destroy' => 'admin.laporan-realisasi.destroy',
        ]);

        // Delete file from laporan realisasi
        Route::delete('laporan-realisasi/{laporan}/file/{fileIndex}', [\App\Http\Controllers\Admin\LaporanRealisasiAnggaranController::class, 'deleteFile'])
            ->name('admin.laporan-realisasi.deleteFile');

        // Reports Management
        Route::prefix('reports')->name('reports.admin.')->group(function () {
            // Route::get('/', [ReportAdminController::class, 'index'])->name('index');
            Route::get('/export', [ReportAdminController::class, 'export'])->name('export');
            // Route::get('/create', [ReportAdminController::class, 'create'])->name('create');
            


            Route::get('/', [ReportAdminController::class, 'index'])->name('index');
            Route::get('/create', [ReportAdminController::class, 'create'])->name('create');
            Route::post('/', [ReportAdminController::class, 'store'])->name('store');
            Route::get('/{report}', [ReportAdminController::class, 'show'])->name('show');
            Route::get('/{report}/edit', [ReportAdminController::class, 'edit'])->name('edit');
            Route::put('/{report}', [ReportAdminController::class, 'update'])->name('update');
            Route::delete('/{report}', [ReportAdminController::class, 'destroy'])->name('destroy');
            Route::post('/{report}/update-status', [ReportAdminController::class, 'updateStatus'])
            ->name('updateStatus');
            
            // Publish/Unpublish routes
            Route::post('/{report}/toggle-publish', [ReportAdminController::class, 'togglePublish'])
            ->name('togglePublish');
            
            // Bulk actions
            Route::post('/bulk-publish', [ReportAdminController::class, 'bulkPublish'])
            ->name('bulkPublish');
            Route::post('/bulk-unpublish', [ReportAdminController::class, 'bulkUnpublish'])
            ->name('bulkUnpublish');
            
            // Archive routes
            Route::post('/{report}/toggle-archive', [ReportAdminController::class, 'toggleArchive'])
            ->name('toggleArchive');
            Route::post('/bulk-archive', [ReportAdminController::class, 'bulkArchive'])
            ->name('bulkArchive');
            Route::post('/bulk-unarchive', [ReportAdminController::class, 'bulkUnarchive'])
            ->name('bulkUnarchive');
            
        });
    });

    Route::middleware(['role:superadmin'])->group(function () {

        Route::resource('users', UserController::class);
        
   });
 // Admin Routes untuk Tentang (Superadmin only)
 Route::prefix('administrator/dashboard')->middleware(['role:superadmin'])->group(function () {
    Route::resource('tentang', \App\Http\Controllers\Admin\TentangController::class)->names([
        'index' => 'tentang.admin.index',
        'create' => 'tentang.admin.create',
        'store' => 'tentang.admin.store',
        'show' => 'tentang.admin.show',
        'edit' => 'tentang.admin.edit',
        'update' => 'tentang.admin.update',
        'destroy' => 'tentang.admin.destroy',
    ]);
});
Route::prefix('administrator/dashboard')->middleware(['role:superadmin'])->group(function () {
    Route::resource('kontak', \App\Http\Controllers\Admin\KontakController::class)->names([
        'index' => 'kontak.admin.index',
        'create' => 'kontak.admin.create',
        'store' => 'kontak.admin.store',
        'show' => 'kontak.admin.show',
        'edit' => 'kontak.admin.edit',
        'update' => 'kontak.admin.update',
        'destroy' => 'kontak.admin.destroy',
    ]);
});

// Admin Routes untuk Dokumen Perencanaan (Superadmin only)
Route::prefix('administrator/dashboard')->middleware(['role:superadmin'])->group(function () {
    Route::resource('dokumen-perencanaan', \App\Http\Controllers\Admin\DokumenPerencanaanController::class)->names([
        'index' => 'dokumen-perencanaan.admin.index',
        'create' => 'dokumen-perencanaan.admin.create',
        'store' => 'dokumen-perencanaan.admin.store',
        'show' => 'dokumen-perencanaan.admin.show',
        'edit' => 'dokumen-perencanaan.admin.edit',
        'update' => 'dokumen-perencanaan.admin.update',
        'destroy' => 'dokumen-perencanaan.admin.destroy',
    ]);
    
    Route::post('dokumen-perencanaan/{dokumenPerencanaan}/toggle-publish', 
        [\App\Http\Controllers\Admin\DokumenPerencanaanController::class, 'togglePublish'])
        ->name('dokumen-perencanaan.admin.togglePublish');
    
    Route::get('dokumen-perencanaan/{dokumenPerencanaan}/download', 
        [\App\Http\Controllers\Admin\DokumenPerencanaanController::class, 'download'])
        ->name('dokumen-perencanaan.admin.download');
});



    /*
    |--------------------------------------------------------------------------
    | Frontend Apps Routes
    |--------------------------------------------------------------------------
    */
    Route::prefix('apps')->group(function () {
        // Route::prefix('reports')->name('apps.reports.')->group(function () {
        //     Route::get('/', [ReportAppController::class, 'index'])->name('index');
        //     Route::get('/create', [ReportAppController::class, 'create'])->name('create');
        //     Route::post('/store', [ReportAppController::class, 'store'])->name('store');
        //     Route::get('/{id}/show', [ReportAppController::class, 'show'])->name('show');
        // });
        Route::prefix('reports')->name('apps.reports.')->group(function () {
            Route::get('/', [ReportAppController::class, 'index'])->name('index');
            Route::get('/drafts', [ReportAppController::class, 'drafts'])->name('drafts');
            Route::get('/create', [ReportAppController::class, 'create'])->name('create');
            Route::post('/store', [ReportAppController::class, 'store'])->name('store');
            Route::get('/{id}/show', [ReportAppController::class, 'show'])->name('show');
            Route::get('/{id}/edit', [ReportAppController::class, 'edit'])->name('edit');
            Route::put('/{id}/update', [ReportAppController::class, 'update'])->name('update');
            Route::post('/{id}/move-to-draft', [ReportAppController::class, 'moveToDraft'])->name('moveToDraft');
            Route::delete('/{id}/destroy', [ReportAppController::class, 'destroy'])->name('destroy');
        });

        Route::get('/apps/reports/export/pdf/{id}', [LaporanExportController::class, 'exportPDF'])
        ->name('apps.reports.export.pdf');
    
    Route::get('/apps/reports/export/word/{id}', [LaporanExportController::class, 'exportWord'])
        ->name('apps.reports.export.word');
    });

    // Notifications
    Route::post('/notifications/mark-read', function () {
        Auth::user()->unreadNotifications->markAsRead();
        return back()->with('success', 'Semua notifikasi sudah dibaca.');
    })->name('notifications.markRead');

    Route::post('/notifications/{id}/read', function ($id) {
        $notification = Auth::user()->unreadNotifications->where('id', $id)->first();
        if ($notification) {
            $notification->markAsRead();
        }
        return back()->with('success', 'Notifikasi ditandai sebagai sudah dibaca.');
    })->name('notifications.read');
});