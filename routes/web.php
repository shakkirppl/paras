<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StoreTypeController;
use App\Http\Controllers\StoreClassificationsController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\LuckyDrawController;
use App\Http\Controllers\LuckyDrawGiftesController;
use App\Http\Controllers\LuckyDrawImageController;
use App\Http\Controllers\CouponController;
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

Route::get('/clear', function() {
    //   $mytime = Carbon\Carbon::now();
    //  return $mytime->toDateTimeString();
    $exitCode = Artisan::call('cache:clear');
     $exitCode = Artisan::call('config:clear');
     $exitCode = Artisan::call('route:clear');
    $exitCode = Artisan::call('view:clear');
    $exitCode = Artisan::call('config:cache');

    return '<h1>cleared</h1>';
});
Route::get('/', function () {
    return view('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('dashboard', [DashboardController::class,'dashboard']);
    Route::resource('store-type', StoreTypeController::class);
    Route::resource('store-classifications', StoreClassificationsController::class);
    Route::resource('stores', StoreController::class);
    Route::resource('lucky-draws', LuckyDrawController::class);
    
    Route::prefix('lucky_draws/{lucky_draw}/gifts')->group(function () {
        Route::get('create', [LuckyDrawGiftesController::class, 'create'])->name('lucky_draw_giftes.create');
        Route::post('store', [LuckyDrawGiftesController::class, 'store'])->name('lucky_draw_giftes.store');
        Route::get('{gift}/edit', [LuckyDrawGiftesController::class, 'edit'])->name('lucky_draw_giftes.edit');
        Route::put('{gift}', [LuckyDrawGiftesController::class, 'update'])->name('lucky_draw_giftes.update');
        Route::delete('{gift}', [LuckyDrawGiftesController::class, 'destroy'])->name('lucky_draw_giftes.destroy');
        
    });
    Route::post('lucky_draws/{lucky_draw}/images', [LuckyDrawImageController::class, 'store'])->name('lucky_draw_images.store');
    Route::delete('lucky_draws/{lucky_draw}/images/{image}', [LuckyDrawImageController::class, 'destroy'])->name('lucky-draw-images.destroy');
    Route::resource('coupons', CouponController::class);

});

require __DIR__.'/auth.php';
