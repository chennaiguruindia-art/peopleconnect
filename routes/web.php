<?php

use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\ComplaintController as AdminComplaintController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\LocationManagementController as AdminLocationController;
use App\Http\Controllers\Admin\PublicUpdateController as AdminUpdateController;
use App\Http\Controllers\Admin\ReportController as AdminReportController;
use App\Http\Controllers\Admin\SettingController as AdminSettingController;
use App\Http\Controllers\Admin\StaffController as AdminStaffController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\TranslationApiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Language Switcher & Dynamic API Translator
|--------------------------------------------------------------------------
*/
Route::get('/lang/{locale}', [LocaleController::class, 'setLocale'])->name('locale.set');
Route::post('/api/translate', [TranslationApiController::class, 'translate'])->name('api.translate');

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [PublicController::class, 'about'])->name('about');
Route::get('/submit-complaint', [ComplaintController::class, 'create'])->name('complaints.create');
Route::post('/complaints', [ComplaintController::class, 'store'])->name('complaints.store');
Route::get('/track-complaint', [ComplaintController::class, 'trackView'])->name('complaints.track');
Route::post('/track-complaint', [ComplaintController::class, 'track'])->name('complaints.track.post');
Route::get('/district-information', [PublicController::class, 'districtInformation'])->name('district.info');
Route::get('/updates', [PublicController::class, 'updates'])->name('updates');
Route::get('/contact', [PublicController::class, 'contact'])->name('contact');
Route::get('/privacy-policy', [PublicController::class, 'privacy'])->name('privacy');
Route::get('/terms-conditions', [PublicController::class, 'terms'])->name('terms');

/*
|--------------------------------------------------------------------------
| Location AJAX Dependent Dropdown Routes
|--------------------------------------------------------------------------
*/
Route::prefix('locations')->name('locations.')->group(function () {
    Route::get('/districts', [LocationController::class, 'districts'])->name('districts');
    Route::get('/divisions', [LocationController::class, 'divisions'])->name('divisions');
    Route::get('/taluks', [LocationController::class, 'taluks'])->name('taluks');
    Route::get('/villages', [LocationController::class, 'villages'])->name('villages');
    Route::get('/blocks', [LocationController::class, 'blocks'])->name('blocks');
    Route::get('/panchayats', [LocationController::class, 'panchayats'])->name('panchayats');
});

/*
|--------------------------------------------------------------------------
| Admin Authentication Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/lang/{locale}', [LocaleController::class, 'setAdminLocale'])->name('locale.set');
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    /*
    |--------------------------------------------------------------------------
    | Protected Admin Routes
    |--------------------------------------------------------------------------
    */
    Route::middleware(['admin.auth'])->group(function () {
        Route::get('/', function () {
            return redirect()->route('admin.dashboard');
        });

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::get('/api/dashboard-charts', [AdminDashboardController::class, 'chartData'])->name('charts.data');

        // Complaints Management
        Route::get('/complaints', [AdminComplaintController::class, 'index'])->name('complaints.index');
        Route::get('/complaints/export', [AdminComplaintController::class, 'exportExcel'])->name('complaints.export');
        Route::get('/complaints/{id}', [AdminComplaintController::class, 'show'])->name('complaints.show');
        Route::match(['post', 'put'], '/complaints/{id}/status', [AdminComplaintController::class, 'updateStatus'])->name('complaints.status');
        Route::post('/complaints/{id}/assign', [AdminComplaintController::class, 'assignStaff'])->name('complaints.assign');
        Route::post('/complaints/{id}/refer', [AdminComplaintController::class, 'referDepartment'])->name('complaints.refer');

        // Locations Management
        Route::get('/locations', [AdminLocationController::class, 'index'])->name('locations.index');
        Route::get('/locations/create', [AdminLocationController::class, 'create'])->name('locations.create');
        Route::post('/locations', [AdminLocationController::class, 'store'])->name('locations.store');
        Route::get('/locations/{id}/edit', [AdminLocationController::class, 'edit'])->name('locations.edit');
        Route::put('/locations/{id}', [AdminLocationController::class, 'update'])->name('locations.update');
        Route::delete('/locations/{id}', [AdminLocationController::class, 'destroy'])->name('locations.destroy');

        // Categories Management
        Route::get('/categories', [AdminCategoryController::class, 'index'])->name('categories.index');
        Route::post('/categories', [AdminCategoryController::class, 'store'])->name('categories.store');
        Route::put('/categories/{id}', [AdminCategoryController::class, 'update'])->name('categories.update');

        // Staff Management
        Route::get('/staff', [AdminStaffController::class, 'index'])->name('staff.index');
        Route::post('/staff', [AdminStaffController::class, 'store'])->name('staff.store');
        Route::put('/staff/{id}', [AdminStaffController::class, 'update'])->name('staff.update');

        // Reports
        Route::get('/reports', [AdminReportController::class, 'index'])->name('reports.index');

        // Public Updates / News
        Route::get('/updates', [AdminUpdateController::class, 'index'])->name('updates.index');
        Route::post('/updates', [AdminUpdateController::class, 'store'])->name('updates.store');
        Route::put('/updates/{id}', [AdminUpdateController::class, 'update'])->name('updates.update');
        Route::delete('/updates/{id}', [AdminUpdateController::class, 'destroy'])->name('updates.destroy');

        // System Settings
        Route::get('/settings', [AdminSettingController::class, 'index'])->name('settings.index');
        Route::post('/settings', [AdminSettingController::class, 'update'])->name('settings.update');
    });
});
