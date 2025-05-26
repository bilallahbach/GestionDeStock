<?php

use App\Mail\MyTestMail;
use App\Http\Controllers\Dashboard;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\DashboardController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;


Route::get('/login', [AuthController::class, 'showLogin'])->middleware('guest')->name('auth.login');
Route::get('/register', [AuthController::class, 'showRegister'])->middleware('guest')->name('auth.register');

    Route::get('/email/verify', function () {
        return view('component.verify-email');
    })->middleware('auth')->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill(); // mark as verified
        return redirect('/');
    })->middleware(['auth', 'signed'])->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Verification link sent!');
    })->middleware(['auth', 'throttle:6,1'])->name('verification.send');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->middleware('guest')->name('password.request');

Route::post('/forgot-password', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('/reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->middleware('guest')->name('password.reset');

Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');


Route::get('/', [Dashboard::class, 'index'])->name('dashboard')->middleware('auth');

Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
;
Route::get('/customers/create', [CustomerController::class, 'create'])->name('customers.create');
Route::get('/customers/{customers}/edit', [CustomerController::class, 'edit'])->name('customers.edit');

Route::post('/customers', [CustomerController::class, 'store'])->name('customers.store');
Route::put('/customers/{customers}', [CustomerController::class, 'update'])->name('customers.update');
Route::delete('/customers/{customers}', [CustomerController::class, 'destroy'])->name('customers.destroy');
Route::get('/search', [CustomerController::class, 'search'])->name('customers.search');

Route::get('/supplier', [SupplierController::class, 'index'])->name('suppliers.index');
Route::get('/supplierB', [SupplierController::class, 'productsBySupplier'])->name('suppliersB.index');
Route::get('/api/products-by-supplier/{supplier}', [SupplierController::class, 'getProductsBySupplier'])->name('api.products.by.supplier');
;

Route::get('/product', [ProductController::class, 'index'])->name('products.index');
Route::post('/product', [ProductController::class, 'store'])->name('products.store');
Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');



Route::get('/order', [OrderController::class, 'index'])->name('orders.index');
;

Route::get('/orderV', [OrderController::class, 'index2'])->name('orders.index2');
;


Route::get('/products-by-category', [CategoryController::class, 'productsByCategory'])->name('products.by.category');
Route::get('/products-by-category/{category}', [CategoryController::class, 'getProductsByCategory'])->name('products.filter.by.category');
Route::get('/products/print', [ProductController::class, 'print'])->name('products.print');
Route::get('/products-by-store', [ProductController::class, 'productsByStore'])->name('products.by.store');
Route::get('/api/products-by-store/{store}', [ProductController::class, 'getProductsByStore'])->name('api.products.by.store');
Route::get('products-export', [ProductController::class, 'export'])->name('products.export');
Route::post('products-import', [ProductController::class, 'import'])->name('products.import');

Route::get('/api/customers/search', [CustomerController::class, 'search'])->name('customers.search');

Route::get('/api/customers/search/{term}', [CustomerController::class, 'searchTerm'])->name('customers.search.term');
Route::get('/api/customers/{customer}/orders', [OrderController::class, 'getCustomerOrders'])->name('customers.orders');
Route::get('/api/orders/{order}/details', [OrderController::class, 'getOrderDetails'])->name('orders.details');

Route::get('/api/customers/{customer}/orderss', [OrderController::class, 'getCustomerOrderss'])->name('customers.orders');
Route::get('/api/orders/{order}/detailss', [OrderController::class, 'getOrderDetailss'])->name('orders.details');
Route::get('/api/customers/search/{term}', [OrderController::class, 'searchCustomers'])->name('customers.search.term');


Route::get('/changeLocale/{locale}', function (string $locale) {
    if (in_array($locale, ['en', 'es', 'fr', 'ar'])) {
        session()->put('locale', $locale);
    }
    return redirect()->back();
});

Route::get('/q1', [StoreController::class, 'q1'])->name('q1');
Route::get('/q2', [StoreController::class, 'q2'])->name('q2');
Route::get('/q3', [StoreController::class, 'q3'])->name('q3');
Route::get('/q4', [StoreController::class, 'q4'])->name('q4');
Route::get('/q5', [StoreController::class, 'q5'])->name('q5');
Route::get('/q6', [StoreController::class, 'q6'])->name('q6');

#cookies/session/image
Route::post("/saveCookie", [Dashboard::class, 'saveCookie'])->name("saveCookie");
Route::post("/saveSession", [Dashboard::class, 'saveSession'])->name("saveSession");
Route::post("/saveAvatar", [Dashboard::class, 'saveAvatar'])->name("saveAvatar");

Route::get('/TestMail', function () {
    $name = "Funny Coder";

    // The email sending is done using the to method on the Mail facade
Mail::to('lhbachbilal@gmail.com')->send(new MyTestMail($name));


});