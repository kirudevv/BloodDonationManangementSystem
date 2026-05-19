<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\BloodRequestController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\InventoryController;


Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/blood-banks', function () {
    return view('blood-banks');
});

Route::resource('registration', UserController::class); 



Route::get('login', [UserController::class, 'showLogin'])->name('login');

Route::post('login', [UserController::class, 'login'])->name('login.submit');

Route::get('logout', [UserController::class, 'logout'])->name('logout');

Route::get('donation/archive', [DonationController::class, 'showArchive'])->name('donation.archives');
Route::post('/donation/restore/{id}', [DonationController::class, 'restore'])->name('donation.restore');

Route::resource('donation', DonationController::class);
Route::resource('bloodrequest', BloodRequestController::class);


Route::middleware(['auth'])->group(function(){
    Route::resource('appointments', AppointmentController::class)->except(['show', 'create', 'store']);
    Route::get('/appointment/{id}/edit', [AppointmentController::class, 'edit'])->name('appointment.edit');
    Route::put('/appointment/{id}', [AppointmentController::class, 'update'])->name('appointment.update');
    Route::delete('/appointment/{id}', [AppointmentController::class, 'destroy'])->name('appointment.delete');
    
    // Standard CRUD for Appointments
    
    // Inventory Management
    Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory.index');
    Route::get('/inventory/archive', [InventoryController::class, 'showArchive'])->name('inventory.archives');
    Route::post('/inventory/restore/{id}', [InventoryController::class, 'restore'])->name('inventory.restore');
    Route::delete('/inventory/{id}', [InventoryController::class, 'destroy'])->name('inventory.destroy');
    Route::post('/inventory/grant/{id}', [InventoryController::class, 'grantBlood'])->name('inventory.grant');
    
    Route::get('/hospital/{id}/edit', [HospitalController::class, 'edit'])->name('hospital.edit');
    Route::put('/hospital/{id}', [HospitalController::class, 'update'])->name('hospital.update');
    // Donation routes
    Route::post('/donation/{id}/archive', [DonationController::class, 'archive'])->name('donation.archive');
    Route::delete('/donation/{id}', [DonationController::class, 'destroy'])->name('donation.delete');
    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');
    
    // Blood Request routes
    Route::get('/bloodrequest/{id}/edit', [BloodRequestController::class, 'edit'])->name('bloodrequest.edit');
    Route::put('/bloodrequest/{id}', [BloodRequestController::class, 'update'])->name('bloodrequest.update');
    Route::post('/bloodrequest/{id}/archive', [BloodRequestController::class, 'archive'])->name('bloodrequest.archive');
    Route::delete('/bloodrequest/{id}', [BloodRequestController::class, 'destroy'])->name('bloodrequest.delete');
    
    // User routes
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('user.update');
    Route::post('/users/{id}/archive', [UserController::class, 'archive'])->name('user.archive');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('user.delete');
    
    Route::get('/donation/{id}/edit', [DonationController::class, 'edit'])->name('donation.edit');
    Route::put('donation/{id}', [DonationController::class, 'update'])->name('donation.update');
    Route::put('/donation/{id}/status', [DonationController::class, 'updateStatus'])->name('donation.updateStatus');



    Route::get('/transaction', [DonationController::class, 'create'])->name('transaction.create');
    Route::post('/donation/store', [DonationController::class, 'store'])->name('donation.store');
    Route::post('/request/store', [BloodRequestController::class, 'store'])->name('request.store');
    
    // Hospital Resource
    Route::resource('hospital', HospitalController::class);
    Route::post('/hospital/{id}/archive', [HospitalController::class, 'archive'])->name('hospital.archive');
});