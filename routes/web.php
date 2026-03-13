<?php

use App\Http\Controllers\{WebController, AuthController, MenuController, ChefsController, EventsController, GalleryController, CategoryController, ContactsController, ReservationController, SubcatController, WorkersController, CartController, OrderController};
use Illuminate\Support\Facades\Route;

// ==========================================================
// 1. PUBLIC ROUTES
// ==========================================================
Route::get('/', [WebController::class, 'website'])->name('website');
Route::get('/web/menu', [WebController::class, 'menu'])->name('menu');
Route::get('/web/chefs', [WebController::class, 'chefs'])->name('chefs');
Route::get('/web/events', [WebController::class, 'events'])->name('events');
Route::get('/web/gallery', [WebController::class, 'gallery'])->name('gallery');
Route::get('/web/about', [WebController::class, 'about'])->name('about');
// web.php
Route::get('/web/menu/item/{slug}', [WebController::class, 'itemDetail'])->name('menu.detail');

// CONTACTS & RESERVATION (Public Forms)
Route::get('/contacts/add', [ContactsController::class, 'index'])->name('contacts.add');
Route::post('/contacts/add', [ContactsController::class, 'store']);
Route::get('/reservation/add', [ReservationController::class, 'index'])->name('reservation.add');
Route::post('/reservation/add', [ReservationController::class, 'store'])->name('reservation.store');

// AUTH ROUTES
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'loginform'])->name('login.add');
    Route::post('/login', [AuthController::class, 'authentication']);
    Route::get('/register/add', [AuthController::class, 'register'])->name('register.add');
    Route::post('/register/add', [AuthController::class, 'store']);
});
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


// ==========================================================
// 2. LOGGED-IN USER ROUTES
// ==========================================================
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [AuthController::class, 'profile'])->name('user.profile');
    Route::get('/my-reservations', [ReservationController::class, 'userBookings'])->name('user.reservations');

    // CART & ORDERING
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::get('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/update', [CartController::class, 'update'])->name('cart.update');
    Route::get('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/checkout', [CartController::class, 'checkout'])->name('checkout');
    Route::get('/payment-success', [CartController::class, 'success'])->name('payment.success');
    Route::get('/payment-cancel', fn() => redirect()->route('cart')->with('error', 'Payment was cancelled.'))->name('payment.cancel');
    Route::get('/order-confirmed/{id}', [CartController::class, 'showSuccess'])->name('order.confirmed');

    // ORDERS
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/order/details/{id}', [OrderController::class, 'showDetails'])->name('orders.details');
});


// ==========================================================
// 3. ADMIN PROTECTED ROUTES
// ==========================================================
Route::middleware(['auth', 'admin'])->group(function () {

    // DASHBOARD
    Route::get('/admin', [AuthController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/web/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

    // MENU
    Route::prefix('menu')->group(function () {
        Route::get('/add', [MenuController::class, 'index'])->name('menu.add');
        Route::post('/add', [MenuController::class, 'store']);
        Route::get('/show', [MenuController::class, 'show'])->name('menu.show');
        Route::get('/edit/{id}', [MenuController::class, 'edit'])->name('menu.edit');
        Route::patch('/update/{id}', [MenuController::class, 'update'])->name('menu.update');
        Route::delete('/delete/{id}', [MenuController::class, 'destroy'])->name('menu.delete');
    });

    // CATEGORY
    Route::prefix('category')->group(function () {
        Route::get('/add', [CategoryController::class, 'index'])->name('category.add');
        Route::post('/add', [CategoryController::class, 'store']);
        Route::get('/show', [CategoryController::class, 'show'])->name('category.show');
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
        Route::patch('/update/{id}', [CategoryController::class, 'update'])->name('category.update');
        Route::delete('/delete/{id}', [CategoryController::class, 'destroy'])->name('category.delete');
    });

    // SUBCATEGORY
    Route::prefix('subcategory')->group(function () {
        Route::get('/add', [SubcatController::class, 'index'])->name('subcategory.add');
        Route::post('/add', [SubcatController::class, 'store']);
        Route::get('/show', [SubcatController::class, 'show'])->name('subcategory.show');
        Route::get('/edit/{id}', [SubcatController::class, 'edit'])->name('subcategory.edit');
        Route::patch('/update/{id}', [SubcatController::class, 'update'])->name('subcategory.update');
        Route::delete('/delete/{id}', [SubcatController::class, 'destroy'])->name('subcategory.delete');
    });

    // WORKERS
    Route::prefix('workers')->group(function () {
        Route::get('/add', [WorkersController::class, 'index'])->name('workers.add');
        Route::post('/add', [WorkersController::class, 'store']);
        Route::get('/show', [WorkersController::class, 'show'])->name('workers.show');
        Route::get('/edit/{id}', [WorkersController::class, 'edit'])->name('workers.edit');
        Route::patch('/update/{id}', [WorkersController::class, 'update'])->name('workers.update');
        Route::delete('/delete/{id}', [WorkersController::class, 'destroy'])->name('workers.delete');
    });

    // CHEFS
    Route::prefix('chef')->group(function () {
        Route::get('/add', [ChefsController::class, 'index'])->name('chef.add');
        Route::post('/add', [ChefsController::class, 'store']);
        Route::get('/show', [ChefsController::class, 'show'])->name('chef.show');
        Route::get('/edit/{id}', [ChefsController::class, 'edit'])->name('chef.edit');
        Route::put('/update/{id}', [ChefsController::class, 'update'])->name('chef.update');
        Route::delete('/delete/{id}', [ChefsController::class, 'destroy'])->name('chef.delete');
    });

    // EVENTS
    Route::prefix('events')->group(function () {
        Route::get('/add', [EventsController::class, 'index'])->name('events.add');
        Route::post('/add', [EventsController::class, 'store']);
        Route::get('/show', [EventsController::class, 'show'])->name('events.show');
        Route::get('/edit/{id}', [EventsController::class, 'edit'])->name('events.edit');
        Route::patch('/update/{id}', [EventsController::class, 'update'])->name('events.update');
        Route::delete('/delete/{id}', [EventsController::class, 'destroy'])->name('events.delete');
    });

    // GALLERY
    Route::prefix('gallery')->group(function () {
        Route::get('/add', [GalleryController::class, 'index'])->name('gallery.add');
        Route::post('/add', [GalleryController::class, 'store']);
        Route::get('/show', [GalleryController::class, 'show'])->name('gallery.show');
        Route::get('/edit/{id}', [GalleryController::class, 'edit'])->name('gallery.edit');
        Route::patch('/update/{id}', [GalleryController::class, 'update'])->name('gallery.update');
        Route::delete('/delete/{id}', [GalleryController::class, 'destroy'])->name('gallery.delete');
    });

    // RESERVATION (Admin)
    Route::prefix('reservation')->group(function () {
        Route::get('/show', [ReservationController::class, 'show'])->name('reservation.show');
        Route::get('/edit/{id}', [ReservationController::class, 'edit'])->name('reservation.edit');
        Route::patch('/update/{id}', [ReservationController::class, 'update'])->name('reservation.update');
        Route::delete('/delete/{id}', [ReservationController::class, 'destroy'])->name('reservation.delete');
        Route::patch('/updateStatus/{id}', [ReservationController::class, 'updateStatus'])->name('reservation.update-status');
    });

    // CONTACTS (Admin)
    Route::prefix('contacts')->group(function () {
        Route::get('/show', [ContactsController::class, 'show'])->name('contacts.show');
        Route::delete('/delete/{id}', [ContactsController::class, 'destroy'])->name('contacts.delete');
    });

    // USERS (Admin)
    Route::prefix('register')->group(function () {
        Route::get('/show', [AuthController::class, 'show'])->name('register.show');
        Route::get('/edit/{id}', [AuthController::class, 'edit'])->name('register.edit');
        Route::patch('/update/{id}', [AuthController::class, 'update'])->name('register.update');
        Route::delete('/delete/{id}', [AuthController::class, 'delete'])->name('register.delete');
    });
});
