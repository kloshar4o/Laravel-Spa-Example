<?php

use App\Http\Controllers\Admin\CompanySearchController;
use App\Http\Controllers\Admin\CompanyStatusController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\CompanyController as AdminCompanyController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Profile\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\UserController as AuthUserController;
use App\Http\Controllers\Dashboard\CompanyController;
use App\Http\Controllers\Dashboard\CompanyUsersController;
use App\Http\Controllers\Dashboard\CompanyAddressController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::get('company-search', CompanySearchController::class);

Route::group(
    ['middleware' => 'auth:api'],
    function () {
        Route::get('user', [AuthUserController::class, 'current']);

        Route::patch('profile/update-info', [ProfileController::class, 'updateInfo']);
        Route::patch('profile/update-password', [ProfileController::class, 'updatePassword']);

        Route::resource('company', CompanyController::class)->only(['show', 'edit', 'update']);
        Route::resource('company.users', CompanyUsersController::class);
        Route::resource('company.addresses', CompanyAddressController::class);

        Route::group(
            ['middleware' => 'admin'],
            function () {

                Route::get('roles', RoleController::class);
                Route::get('company-statuses', CompanyStatusController::class);
                Route::get('company-search', CompanySearchController::class);
                Route::resource('users', AdminUserController::class);
                Route::resource('companies', AdminCompanyController::class);
            }
        );

        Route::post('logout', [LoginController::class, 'logout']);
    }
);

Route::group(
    ['middleware' => 'guest:api'],
    function () {
        Route::post('login', [LoginController::class, 'login']);
    }
);
