<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\PDFConotroller;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Walmart\Alerts\RatingRaviewController;
use App\Http\Controllers\Walmart\Alerts\OnTimeDeliveryController;
use App\Http\Controllers\Walmart\Alerts\OnTimeShipmentController;
use App\Http\Controllers\Walmart\Alerts\CarrierPerformanceController;
use App\Http\Controllers\Walmart\Alerts\RegionalPerformanceController;
use App\Http\Controllers\Walmart\Alerts\OrdersContnroller;
use App\Http\Controllers\Walmart\Alerts\ShippingPerformanceController;
use App\Http\Controllers\Walmart\Alerts\ItemsController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::group(['middleware' => 'auth'] , function(){

    Route::prefix('dashboard')->group(function () {

        Route::get('/pdf' , [PDFConotroller::class , 'index'])->name('dashboard.pdf');
        Route::get('generatepdf', [PDFConotroller::class, 'generatePDF'])->name('dashboard.generatepdf');

    });

    Route::prefix('dashboard')->group(function () {

        Route::get('shipping-performance', [ShippingPerformanceController::class, 'index'])->name('dashboard.shipping-performance');
        Route::post('shipping-performance-add', [ShippingPerformanceController::class, 'ratingReview'])->name('dashboard.shipping-performance-add');

    });

    Route::prefix('dashboard')->group(function () {

        Route::get('rating-review', [RatingRaviewController::class, 'index'])->name('dashboard.rating-review');
        Route::post('rating-review-add', [RatingRaviewController::class, 'ratingReview'])->name('dashboard.rating-review-add');

    });

    Route::prefix('dashboard')->group(function () {

        Route::get('on-time-delivery', [OnTimeDeliveryController::class, 'index'])->name('dashboard.on-time-delivery');
        Route::get('on-time-delivery-add', [OnTimeDeliveryController::class, 'OnTimeDelivered'])->name('dashboard.on-time-delivery-add');

    });

    Route::prefix('dashboard')->group(function () {

        Route::get('on-time-shipment', [OnTimeShipmentController::class, 'index'])->name('dashboard.on-time-shipment');
        Route::get('on-time-shipment-add', [OnTimeShipmentController::class, 'OnTimeShipment'])->name('dashboard.on-time-shipment-add');

    });

    Route::prefix('dashboard')->group(function () {

        Route::get('carrier-performance', [CarrierPerformanceController::class, 'index'])->name('dashboard.carrier-performance');
        Route::get('carrier-performance-add', [CarrierPerformanceController::class, 'carrierPerformance'])->name('dashboard.carrier-performance-add');

    });

    Route::prefix('dashboard')->group(function () {

        Route::get('regional-performance', [RegionalPerformanceController::class, 'index'])->name('dashboard.regional-performance');
        Route::get('regional-performance-add', [RegionalPerformanceController::class, 'regionalPerformance'])->name('dashboard.regional-performance-add');

    });

    Route::prefix('dashboard')->group(function () {

        Route::get('order', [OrdersContnroller::class, 'index'])->name('dashboard.order');
        Route::post('order-add', [OrdersContnroller::class, 'orderDetails'])->name('dashboard.order-add');

    });

    Route::prefix('dashboard')->group(function () {

        Route::get('items', [ItemsController::class, 'index'])->name('dashboard.items');
        Route::post('items-add', [ItemsController::class, 'walmartItems'])->name('dashboard.items-add');

    });

    Route::prefix('dashboard')->group(function () {

       Route::get('client', [DashboardController::class, 'client'])->name('dashboard.client');

    });

});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');
