<?php

use Inertia\Inertia;
use App\Nova\Category;
use App\Models\Promocode;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\CabinetController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\RegisterController;

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
Route::controller(RegisterController::class)->group(function () {
    Route::post('/verify-and-login', 'verifyAndLogin')->name('verify_and_login');
    Route::post('/send-otp-again', 'sendOtpAgain')->name('send_otp_again');
});

Route::controller(PageController::class)->as('page.')->group(function () {

    Route::get('/', 'index')->name('home');
    Route::get('/support', 'support')->name('support');
    Route::get('/contacts', 'contacts')->name('contacts');
    Route::get('/product', 'product')->name('product');
    Route::get('/sales', 'sales')->name('sales');
    Route::get('/searchPage', 'searchPage')->name('searchPage');
    Route::get('/errorPage', 'errorPage')->name('errorPage');
    Route::get('/favorite', 'favorite')->name('favorite');
    Route::get('/pay', 'pay')->name('pay');

});

Route::controller(ProductController::class)->as('product.')->group(function () {
    Route::get('catalog', 'catalog')->name('catalog');
    Route::get('product/{slug}', 'get')->name('get');
});

Route::controller(CategoryController::class)->as('category.')->group(function () {
    Route::get('categories', 'categories')->name('category');
    Route::get('category/{slug}', 'category')->name('category');
});

Route::controller(CartController::class)->prefix('cart')->as('cart.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::post('add', 'add')->name('add');
    Route::get('get', 'get')->name('get');
    Route::put('update', 'update')->name('update');
    Route::delete('delete', 'delete')->name('delete');
    Route::delete('clear', 'clear')->name('clear');
    Route::post('promocode', 'applyPromocode')->name('promocode');
});

Route::controller(GroupController::class)->as('sets.')->group(function () {
    Route::get('sets', 'get')->name('sets');
    Route::get('set/{slug}', 'sets')->name('sets');
});

Route::controller(FavoriteController::class)->prefix('favorites')->as('favorites.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::post('add', 'add')->name('add');
    Route::delete('delete', 'delete')->name('delete');
});

Route::middleware(['auth:customer', config('jetstream.auth_session')])->controller(CabinetController::class)->prefix('cabinet')->as('cabinet.')->group(function () {
    Route::get('profile', 'index')->name('index');
    Route::get('myOrders', 'myOrders')->name('myOrders');
    Route::controller(AddressController::class)->prefix('addresses')->as('addresses.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('add', 'add')->name('add');
        Route::put('update/{id}', 'update')->name('update');
        Route::delete('delete', 'delete')->name('delete');
    });
});

Route::controller(OrderController::class)->prefix('order')->as('order.')->group(function () {
    Route::get('/', 'index')->name('index');
});

Route::controller(SearchController::class)->as('search.')->group(function () {
    Route::post('/', 'search')->name('search');
});

Route::controller(SupportController::class)->prefix('support')->as('support.')->group(function () {
    Route::get('delivery', 'delivery')->name('delivery');
    Route::get('pickup', 'pickup')->name('pickup');
    Route::get('requisites', 'requisites')->name('requisites');
    Route::get('payments', 'payments')->name('payments');
    Route::get('return', 'return')->name('return');
    Route::get('guarantee', 'guarantee')->name('guarantee');
    Route::get('installation', 'installation')->name('installation');
    Route::get('services', 'services')->name('services');
    Route::get('work', 'work')->name('work');
});

// Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
//     Route::get('/', function () {
//         return Inertia::render('Order');
//     })->name('index');
// });


// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return Inertia::render('Dashboard');
//     })->name('dashboard');
// });
