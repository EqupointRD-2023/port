<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\DispatchController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LeaseController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\RequsitionController;
use App\Http\Controllers\ReturnedFromPortController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\SwapDeviceController;
use App\Http\Controllers\test;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();
Route::get('/', function () {
    return view('auth.login');
});

Route::post('test', [test::class, 'test'])->name('test');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/home-port', [HomeController::class, 'index2'])->name('home-port');
    Route::get('/requsition', [RequsitionController::class, 'index2'])->name('requsition');
    Route::post('/requsition/{id}/update', [RequsitionController::class, 'update'])->name('requsition-update');
    Route::post('/requsition/{id}/cancel', [RequsitionController::class, 'cancel'])->name('requsition-cancel');
    Route::get('/requsition-port', [RequsitionController::class, 'index'])->name('requsition-port');
    Route::post('/requsition-port-store', [RequsitionController::class, 'create'])->name('requsition-store');
    Route::get('device', [test::class, 'test'])->name('device');
    Route::get('devices', [DeviceController::class, 'index'])->name('devices');
    Route::post('devices', [DeviceController::class, 'store'])->name('devices-store');
    Route::post('user', [UserController::class, 'store'])->name('user-store');
    Route::post('role', [RoleController::class, 'store'])->name('role-store');
    // Route::post('user-create', [UserController::class, 'store'])->name('users-store');
    Route::get('users', function () {
        return view('user.index');
    })->name('users');

    Route::get('roles', function () {
        return view('roles.role');
    })->name('roles');

    Route::get('departments', function () {
        return view('user.departments');
    })->name('departments');

    Route::get('/prices', [PriceController::class, 'index'])->name('price');
    Route::get('/customer', [CustomerController::class, 'index'])->name('customer');
    Route::get('/dispatch', [DispatchController::class, 'index'])->name('dispatch');
    Route::get('/dispatch/{id}/show', [DispatchController::class, 'show'])->name('dispatch-show');
    Route::post('/dispatch-', [DispatchController::class, 'dispatcch'])->name('dispatch-store');
    Route::post('/dispatch-put', [DispatchController::class, 'dispatcch'])->name('dispatch-put');
    Route::post('/dispatch/send', [DispatchController::class, 'send'])->name('dispatch-send');
    Route::post('/dispatch/{id}/update', [DispatchController::class, 'update'])->name('dispatch-update');
    Route::get('/dispatch/receive/device', [DispatchController::class, 'receiveDeviceView'])->name('receiveDevice');
    Route::post('/dispatch/{id}/receive', [DispatchController::class, 'receiveDevice'])->name('receiveDeviceToStcok');
    Route::get('/stock/port', [StockController::class, 'index'])->name('stock-port');
    Route::post('/stock/{id}/return', [StockController::class, 'create'])->name('stock-return');
    Route::get('/stock/receive', [ReturnedFromPortController::class, 'index'])->name('stock-from-port');
    Route::post('/stock/{id}/receive', [ReturnedFromPortController::class, 'create'])->name('stock-from-port-receive');
    Route::get('/lease', [LeaseController::class, 'index'])->name('lease');
    Route::get('/lease/{report}/report', [LeaseController::class, 'filterGet'])->name('lease-view');
    Route::post('/lease-report/GT', [LeaseController::class, 'filter'])->name('lease-get-report');
    Route::get('/lease-history', [LeaseController::class, 'history'])->name('lease-history');
    Route::get('/lease-report-port', [LeaseController::class, 'create'])->name('lease-report-port');
    Route::post('/lease/store', [LeaseController::class, 'lease'])->name('lease-store');
    Route::get('/lease/{id}/receipt', [LeaseController::class, 'receipt'])->name('lease-receipt');
    Route::post('/lease/receipt', [LeaseController::class, 'manyreceipt'])->name('lease-receipt-many');
    Route::get('/lease/{id}/swap', [SwapDeviceController::class, 'index'])->name('swap-device');
    Route::post('/lease/swap', [SwapDeviceController::class, 'store'])->name('swap-store');
    Route::get('/generate-pdf/{id}/receipt', [PdfController::class, 'generatePDF'])->name('pdf');
    Route::post('/comment', [HomeController::class, 'comment'])->name('coment');
    Route::get('/filter/reports', [HomeController::class, 'reportAll'])->name('report-all');
    Route::post('/reports', [HomeController::class, 'reportAllReturn'])->name('report-all-return');
});
