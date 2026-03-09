<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\GuestTicketController;
use App\Http\Controllers\GuestProfileController;
use App\Http\Controllers\StaffDashboardController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminTicketController;
use App\Http\Controllers\Auth\StaffRegisterController;

/*
|-------------------------------------------------------------------------- 
| PUBLIC / GUEST TICKET ROUTES
|-------------------------------------------------------------------------- 
*/

// Landing page
Route::get('/', fn () => view('guests.index'));

// Guest login & registration
Route::get('/guest/login', [LoginController::class, 'showLoginForm'])->name('guest.login');
Route::get('/guest/register', fn () => view('guests.register'))->name('guest.register');

// ===== PUBLIC TICKET PAGE =====
// Accessible to everyone (no auth required)
Route::get('/tickets', [AdminTicketController::class, 'create'])->name('tickets.public');
Route::post('/tickets', [AdminTicketController::class, 'store'])->name('tickets.store');

// Guest routes (for unauthenticated or authenticated guests)
Route::prefix('guest')->name('guest.')->group(function () {

    // Allow non-authenticated and authenticated guests to create tickets
    Route::get('/tickets/create', [AdminTicketController::class, 'create'])->name('tickets.create');
    Route::post('/tickets', [AdminTicketController::class, 'store'])->name('tickets.store');

    // If guest is authenticated, show their tickets
    Route::middleware(['auth'])->get('/mytickets', [GuestTicketController::class, 'index'])->name('mytickets');
    Route::middleware(['auth'])->get('/tickets/{ticket}', [GuestTicketController::class, 'show'])->name('tickets.show');
    Route::middleware(['auth'])->get('/profile', [GuestProfileController::class, 'edit'])->name('profile');
    Route::middleware(['auth'])->post('/profile', [GuestProfileController::class, 'update'])->name('profile.update');
});

// ===== STAFF ROUTES =====
Route::middleware(['auth', 'role:staff'])->prefix('staff')->name('staff.')->group(function () {
    Route::get('/dashboard', [StaffDashboardController::class, 'index'])->name('dashboard');
    Route::get('/tickets', [StaffDashboardController::class, 'allTickets'])->name('tickets.all');
    Route::get('/my-tickets', [StaffDashboardController::class, 'myTickets'])->name('tickets.my');
    Route::get('/tickets/create', [StaffDashboardController::class, 'create'])->name('tickets.create');
    Route::post('/tickets', [StaffDashboardController::class, 'store'])->name('tickets.store');
    Route::get('/tickets/{ticket}', [StaffDashboardController::class, 'show'])->name('tickets.show');
    Route::patch('/tickets/{ticket}/status', [StaffDashboardController::class, 'updateStatus'])->name('tickets.updateStatus');
    Route::patch('/tickets/{ticket}/assign', [StaffDashboardController::class, 'assign'])->name('tickets.assign');
    Route::delete('/tickets/{ticket}', [StaffDashboardController::class, 'destroy'])->name('tickets.destroy');
});

// ===== ADMIN ROUTES =====
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', fn () => view('admin.dashboard'))->name('dashboard');

    // User management
    Route::get('/users', [AdminUserController::class,'index'])->name('users.index');
    Route::get('/users/pending', [AdminUserController::class, 'pending'])->name('users.pending');
    Route::get('/users/create', [AdminUserController::class,'create'])->name('users.create');
    Route::post('/users/store', [AdminUserController::class,'store'])->name('users.store');
    Route::patch('/users/{id}/approve', [AdminUserController::class, 'approve'])->name('users.approve');
    Route::patch('/users/{id}/reject', [AdminUserController::class, 'reject'])->name('users.reject');
    Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');

    // Ticket management
    Route::get('/tickets', [AdminTicketController::class, 'index'])->name('tickets.index');
    Route::get('/tickets/{ticket}', [AdminTicketController::class, 'show'])->name('tickets.show');
    Route::patch('/tickets/{ticket}/status', [AdminTicketController::class, 'updateStatus'])->name('tickets.updateStatus');
    Route::patch('/tickets/{ticket}/assign', [AdminTicketController::class, 'assign'])->name('tickets.assign');
});

/*
|-------------------------------------------------------------------------- 
| AUTH ROUTES 
|-------------------------------------------------------------------------- 
*/
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Staff registration
Route::get('/staff/register', [StaffRegisterController::class, 'showRegistrationForm'])->name('staff.register');
Route::post('/staff/register', [StaffRegisterController::class, 'register'])->name('staff.register.submit');


Route::get('/tickets/public', [AdminTicketController::class, 'create'])->name('tickets.public');
Route::post('/tickets/store', [AdminTicketController::class, 'store'])->name('guest.tickets.store');

// status 

Route::get('/ticket/status', [GuestTicketController::class, 'statusForm'])
    ->name('guest.ticket.status.form');

Route::post('/ticket/status', [GuestTicketController::class, 'checkStatus'])
    ->name('guest.ticket.status.check');

    Route::post('/guest/ticket/{id}/reply', [GuestTicketController::class, 'reply'])
    ->name('guest.ticket.reply');

    