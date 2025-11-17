<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\DoctorController as AdminDoctor;
use App\Http\Controllers\Admin\SpecializationController;
use App\Http\Controllers\Admin\AppointmentController as AdminAppointment;
use App\Http\Controllers\Doctor\DashboardController as DoctorDashboard;
use App\Http\Controllers\Doctor\ScheduleController;
use App\Http\Controllers\Doctor\AppointmentController as DoctorAppointment;
use App\Http\Controllers\Patient\DashboardController as PatientDashboard;
use App\Http\Controllers\Patient\DoctorController as PatientDoctor;
use App\Http\Controllers\Patient\AppointmentController as PatientAppointment;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
    Route::resource('specializations', SpecializationController::class);
    Route::resource('doctors', AdminDoctor::class);
    Route::resource('appointments', AdminAppointment::class);
});

// Doctor Routes
Route::middleware(['auth', 'role:doctor'])->prefix('doctor')->name('doctor.')->group(function () {
    Route::get('/dashboard', [DoctorDashboard::class, 'index'])->name('dashboard');
    Route::resource('schedules', ScheduleController::class);
    Route::resource('appointments', DoctorAppointment::class);
    Route::patch('/appointments/{appointment}/update-status', [DoctorAppointment::class, 'updateStatus'])->name('appointments.update-status');
});

// Patient Routes
Route::middleware(['auth', 'role:patient'])->prefix('patient')->name('patient.')->group(function () {
    Route::get('/dashboard', [PatientDashboard::class, 'index'])->name('dashboard');
    Route::get('/doctors', [PatientDoctor::class, 'index'])->name('doctors.index');
    Route::get('/doctors/{doctor}', [PatientDoctor::class, 'show'])->name('doctors.show');
    Route::resource('appointments', PatientAppointment::class);
    Route::get('/appointments/{appointment}/cancel', [PatientAppointment::class, 'cancel'])->name('appointments.cancel');
});

require __DIR__.'/auth.php';