<?php

use App\Http\Controllers\Api\Admin\AuthApiController as AdminAuthApiController;
use App\Http\Controllers\Api\Admin\CategoryApiController as AdminCategoryApiController;
use App\Http\Controllers\Api\Admin\ComplaintApiController as AdminComplaintApiController;
use App\Http\Controllers\Api\Admin\DashboardApiController as AdminDashboardApiController;
use App\Http\Controllers\Api\Admin\SettingApiController as AdminSettingApiController;
use App\Http\Controllers\Api\Admin\StaffApiController as AdminStaffApiController;
use App\Http\Controllers\Api\Citizen\AuthApiController as CitizenAuthApiController;
use App\Http\Controllers\Api\Citizen\ComplaintApiController as CitizenComplaintApiController;
use App\Http\Controllers\Api\MetaApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes - The People Connect (குரலற்ற மக்களின் குரல்)
|--------------------------------------------------------------------------
| Version: v1
| Designed for Mobile Apps (Flutter / React Native / Native iOS & Android)
| and External Civic Integrations.
|--------------------------------------------------------------------------
*/

Route::prefix('v1')->group(function () {

    // =========================================================================
    // 1. PUBLIC META & REFERENCE DATA
    // =========================================================================
    Route::prefix('meta')->group(function () {
        Route::get('/districts', [MetaApiController::class, 'districts']);
        Route::get('/divisions', [MetaApiController::class, 'divisions']);
        Route::get('/taluks', [MetaApiController::class, 'taluks']);
        Route::get('/villages', [MetaApiController::class, 'villages']);
        Route::get('/categories', [MetaApiController::class, 'categories']);
        Route::get('/settings', [MetaApiController::class, 'settings']);
        Route::get('/emergency-directory', [MetaApiController::class, 'emergencyDirectory']);
        Route::get('/announcements', [MetaApiController::class, 'announcements']);
    });

    // =========================================================================
    // 2. CITIZEN / CUSTOMER APIs
    // =========================================================================
    Route::prefix('citizen')->group(function () {

        // Citizen Authentication (Mobile OTP)
        Route::prefix('auth')->group(function () {
            Route::post('/request-otp', [CitizenAuthApiController::class, 'requestOtp']);
            Route::post('/verify-otp', [CitizenAuthApiController::class, 'verifyOtp']);

            Route::middleware('api.auth')->group(function () {
                Route::get('/profile', [CitizenAuthApiController::class, 'profile']);
                Route::post('/logout', [CitizenAuthApiController::class, 'logout']);
            });
        });

        // Grievance Submissions & Public Tracking
        Route::post('/complaints', [CitizenComplaintApiController::class, 'store']);
        Route::post('/complaints/track', [CitizenComplaintApiController::class, 'track']);
        Route::get('/complaints', [CitizenComplaintApiController::class, 'index']);
        Route::get('/complaints/{complaint_id}', [CitizenComplaintApiController::class, 'show']);
        Route::post('/complaints/{id}/feedback', [CitizenComplaintApiController::class, 'feedback']);
    });

    // =========================================================================
    // 3. ADMIN & STAFF APIs
    // =========================================================================
    Route::prefix('admin')->group(function () {

        // Admin Authentication (Email + Password)
        Route::prefix('auth')->group(function () {
            Route::post('/login', [AdminAuthApiController::class, 'login']);

            Route::middleware('api.auth')->group(function () {
                Route::get('/me', [AdminAuthApiController::class, 'me']);
                Route::post('/logout', [AdminAuthApiController::class, 'logout']);
            });
        });

        // Protected Admin / Officer Routes
        Route::middleware(['api.auth'])->group(function () {

            // Dashboard
            Route::get('/dashboard/stats', [AdminDashboardApiController::class, 'stats']);
            Route::get('/dashboard/charts', [AdminDashboardApiController::class, 'charts']);

            // Complaints Management
            Route::get('/complaints', [AdminComplaintApiController::class, 'index']);
            Route::get('/complaints/{id}', [AdminComplaintApiController::class, 'show']);
            Route::post('/complaints/{id}/status', [AdminComplaintApiController::class, 'updateStatus']);
            Route::post('/complaints/{id}/assign', [AdminComplaintApiController::class, 'assign']);
            Route::post('/complaints/{id}/refer', [AdminComplaintApiController::class, 'refer']);

            // Categories Management
            Route::get('/categories', [AdminCategoryApiController::class, 'index']);
            Route::post('/categories', [AdminCategoryApiController::class, 'store']);
            Route::put('/categories/{id}', [AdminCategoryApiController::class, 'update']);
            Route::delete('/categories/{id}', [AdminCategoryApiController::class, 'destroy']);

            // Staff & Officers Management
            Route::get('/staff', [AdminStaffApiController::class, 'index']);
            Route::post('/staff', [AdminStaffApiController::class, 'store']);
            Route::put('/staff/{id}', [AdminStaffApiController::class, 'update']);
            Route::post('/staff/{id}/toggle-status', [AdminStaffApiController::class, 'toggleStatus']);

            // System Settings
            Route::get('/settings', [AdminSettingApiController::class, 'index']);
            Route::post('/settings', [AdminSettingApiController::class, 'update']);
        });
    });
});
