<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentDetailController;

Auth::routes();

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

// Remove the general resources route for studentdetails
// Route::resources([
//     'roles' => RoleController::class,
//     'users' => UserController::class,
//     'studentdetails' => StudentDetailController::class,
// ]);

// Define roles and users resources
Route::resources([
    'roles' => RoleController::class,
    'users' => UserController::class,
]);

// Define studentdetails routes explicitly
Route::controller(StudentDetailController::class)->group(function () {
    Route::get('/studentdetails', 'index')->name('studentdetails.index');
    Route::get('/studentdetails/create', 'create')->name('studentdetails.create');
    Route::post('/studentdetails', 'store')->name('studentdetails.store');
    Route::get('/studentdetails/{studentDetail}', 'show')->name('studentdetails.show');
    Route::get('/studentdetails/{studentDetail}/edit', 'edit')->name('studentdetails.edit');
    Route::put('/studentdetails/{studentDetail}', 'update')->name('studentdetails.update');
    Route::delete('/studentdetails/{studentDetail}', 'destroy')->name('studentdetails.destroy');
});

Route::resource('studentdetails', StudentDetailController::class);
