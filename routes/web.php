<?php

use App\Http\Controllers\AuthContrller;
use App\Http\Controllers\AuthController;
use App\Models\Chefs;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ChefsController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\ReservationController;

// Route::get('/',[WebController::class,'website']);
// Route::get('/',[WebController::class,'dashboard'])->name('dashboard');
Route::get('/admin', [WebController::class, 'dashboard']);

// Menu-Routes

Route::get('/menu/add', [MenuController::class, 'index'])->name('menu.add');
Route::post('/menu/add', [MenuController::class, 'store']);
Route::get('/menu/show', [MenuController::class, 'show'])->name('menu.show');
Route::get('/menu/edit/{id}', [MenuController::class, 'edit'])->name('menu.edit');
Route::patch('/menu/update/{id}', [MenuController::class, 'update'])->name('menu.update');
Route::delete('/menu/delete/{id}', [MenuController::class, 'destroy'])->name('menu.delete');

// Categories-Routes

Route::get('/category/add', [CategoryController::class, 'index'])->name('category.add');
Route::post('/category/add', [CategoryController::class, 'store']);
Route::get('/category/show', [CategoryController::class, 'show'])->name('category.show');
Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
Route::patch('/category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
Route::delete('/category/delete/{id}', [CategoryController::class, 'destroy'])->name('category.delete');


// Chefs-Routes

Route::get('/chef/add', [ChefsController::class, 'index'])->name('chef.add');
Route::post('/chef/add', [ChefsController::class, 'store']);
Route::get('/chef/show', [ChefsController::class, 'show'])->name('chef.show');
Route::get('/chef/edit/{id}', [ChefsController::class, 'edit'])->name('chef.edit');
Route::put('/chef/update/{id}', [ChefsController::class, 'update'])->name('chef.update');
Route::delete('/chef/delete/{id}', [ChefsController::class, 'destroy'])->name('chef.delete');

// Events-Routes
Route::prefix('events')->group(function () {

    Route::get('/add', [EventsController::class, 'index'])->name('events.add');
    Route::post('/add', [EventsController::class, 'store']);
    Route::get('/show', [EventsController::class, 'show'])->name('events.show');
    Route::get('/edit/{id}', [EventsController::class, 'edit'])->name('events.edit');
    Route::patch('/update/{id}', [EventsController::class, 'update'])->name('events.update');
    Route::delete('/delete/{id}', [EventsController::class, 'destroy'])->name('events.delete');
});

// Gallery-Routes 

Route::prefix('gallery')->group(function () {

    Route::get('/add', [GalleryController::class, 'index'])->name('gallery.add');
    Route::post('/add', [GalleryController::class, 'store']);
    Route::get('/show', [GalleryController::class, 'show'])->name('gallery.show');
    Route::get('/edit/{id}', [GalleryController::class, 'edit'])->name('gallery.edit');
    Route::patch('/update/{id}', [GalleryController::class, 'update'])->name('gallery.update');;
    Route::delete('/delete/{id}', [GalleryController::class, 'destroy'])->name('gallery.delete');
});

// Reservation-Routes

Route::prefix('reservation')->group(function () {

    Route::get('/add', [ReservationController::class, 'index'])->name('reservation.add');
    Route::post('/add', [ReservationController::class, 'store']);
    Route::get('/show', [ReservationController::class, 'show'])->name('reservation.show');
    Route::get('/edit/{id}', [ReservationController::class, 'edit'])->name('reservation.edit');
    Route::patch('/update/{id}', [ReservationController::class, 'update'])->name('reservation.update');
    Route::delete('/delete/{id}', [ReservationController::class, 'destroy'])->name('reservation.delete');

    Route::patch('/updateStatus/{id}', [ReservationController::class, 'updateStatus'])->name('reservation.update-status');
});

// Website routes

Route::get('/', [WebController::class, 'website']);
Route::get('/web/menu', [WebController::class, 'menu'])->name('menu');
Route::get('/web/chefs', [WebController::class, 'chefs'])->name('chefs');
Route::get('/web/events', [WebController::class, 'events'])->name('events');
Route::get('/web/gallery', [WebController::class, 'gallery'])->name('gallery');
// Route::get('/web/contact', [WebController::class, 'contacts'])->name('contacts');
Route::get('/web/about', [WebController::class, 'about'])->name('about');

// Contacts routes

Route::prefix('contacts')->group(function () {

    Route::get('/add', [ContactsController::class, 'index'])->name('contacts.add');
    Route::post('/add', [ContactsController::class, 'store']);
    Route::get('/show', [ContactsController::class, 'show'])->name('contacts.show');
    Route::get('/edit/{id}', [ContactsController::class, 'edit'])->name('contacts.edit');
    Route::patch('/update/{id}', [ContactsController::class, 'update'])->name('contacts.update');
    Route::delete('/delete/{id}', [ContactsController::class, 'destroy'])->name('contacts.delete');
});

// Authentication routes

// Register form

Route::get('/register', [AuthController::class, 'index'])->name('register.add');
Route::post('/register', [AuthController::class, 'store']);
Route::get('/register/show', [AuthController::class, 'forgetPassword'])->name('.add');
Route::post('/register/edit{id}', [AuthController::class, 'sendResetLinkEmail']);
Route::get('/register/update/{id}', [AuthController::class, 'resetPassword'])->name('reset-password.add');
Route::post('/register/delete/{id}', [AuthController::class, 'updatePassword']);

// Login routes

Route::get('/login', [AuthController::class, 'login'])->name('login.add');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout.add');