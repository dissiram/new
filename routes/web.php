<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminPanel\AdminController;
use App\Http\Controllers\FormatorPanel\FormatorController;

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

/*
Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/', [HomeController::class, "index"]);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



Route::middleware(['auth','role:admin'])->group(function () {
    Route::get('admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');  
    
    //customer route 
    Route::get('admin/customer', [AdminController::class, 'getCustomer'])->name('admin.customer'); 
    Route::get('admin/deleteCustomer/{id}', [AdminController::class, 'deleteCustomer'])->name('admin.deleteCustomer'); 
    Route::get('admin/customer/{id}', [AdminController::class, 'editCustomer'])->name('customer.edit'); 
    Route::post('admin/updateCustomer/{id}', [AdminController::class, 'updateCustomer'])->name('admin.updateCustomer'); 

    //formator route
    Route::get('admin/formator', [AdminController::class, 'getFormator'])->name('admin.formator');
    Route::get('admin/formator/{id}', [AdminController::class, 'editFormator'])->name('formator.edit'); 
    Route::get('admin/deleteFormator/{id}', [AdminController::class, 'deleteFormator'])->name('admin.deleteFormator');
    Route::post('admin/updateFormator/{id}', [AdminController::class, 'updateFormator'])->name('admin.updateFormator');   

});

Route::middleware(['auth','role:formator'])->group(function () {
    Route::get('formateur/dashboard', [FormatorController::class, 'index'])->name('formateur.dashboard');  
});
