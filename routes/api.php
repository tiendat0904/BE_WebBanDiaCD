<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


//nhà cung cấp
Route::get('/accounts', [\App\Http\Controllers\TaiKhoanController::class, 'index']);

Route::get('/accounts/{id}', [\App\Http\Controllers\TaiKhoanController::class, 'show']);

Route::post('/accounts', [\App\Http\Controllers\TaiKhoanController::class, 'store']);

Route::put('/accounts/{id}', [\App\Http\Controllers\TaiKhoanController::class, 'update']);

Route::post('/accounts/delete', [\App\Http\Controllers\TaiKhoanController::class, 'destroy']);

Route::get('/information-cd', [\App\Http\Controllers\ThongTinCDController::class, 'index']);

Route::get('/information-cd/{id}', [\App\Http\Controllers\ThongTinCDController::class, 'show']);

Route::post('/information-cd', [\App\Http\Controllers\ThongTinCDController::class, 'store']);

Route::put('/information-cd/{id}', [\App\Http\Controllers\ThongTinCDController::class, 'update']);

Route::post('/information-cd/delete', [\App\Http\Controllers\ThongTinCDController::class, 'destroy']);

Route::get('/copyrightstamps', [\App\Http\Controllers\TemBanQuyenController::class, 'index']);

Route::get('/directors', [\App\Http\Controllers\DaoDienController::class, 'index']);

Route::get('/cd-types', [\App\Http\Controllers\LoaiCDController::class, 'index']);



Route::get('/publisher', [\App\Http\Controllers\NhaPhatHanhController::class, 'index']);



Route::get('/coupons', [\App\Http\Controllers\HoaDonNhapController::class, 'index']);

Route::get('/coupons/{id}', [\App\Http\Controllers\HoaDonNhapController::class, 'show']);

Route::put('/coupons/{id}', [\App\Http\Controllers\HoaDonNhapController::class, 'update']);

Route::post('/coupons', [\App\Http\Controllers\HoaDonNhapController::class, 'store']);

Route::post('/coupons/delete', [\App\Http\Controllers\HoaDonNhapController::class, 'destroy']);



Route::get('/coupon-details', [\App\Http\Controllers\ChiTietHoaDonNhapController::class, 'index']);

Route::get('/coupon-details/{id}', [\App\Http\Controllers\ChiTietHoaDonNhapController::class, 'show']);

Route::put('/coupon-details/{id}', [\App\Http\Controllers\ChiTietHoaDonNhapController::class, 'update']);

Route::post('/coupon-details', [\App\Http\Controllers\ChiTietHoaDonNhapController::class, 'store']);

Route::post('/coupon-details/delete', [\App\Http\Controllers\ChiTietHoaDonNhapController::class, 'destroy']);