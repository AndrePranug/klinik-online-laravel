<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\DoctorController as AdminDoctor;
use App\Http\Controllers\Admin\SpecializationController;
use App\Http\Controllers\Admin\AppointmentController as AdminAppointment;
use App\Http\Controllers\Admin\UserManagementController;
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

/*
|--------------------------------------------------------------------------
| UNIVERSAL DASHBOARD SELECTOR (WAJIB ADA)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    $user = auth()->user();

    if ($user->hasRole('admin')) {
        return redirect()->route('admin.dashboard');
    }

    if ($user->hasRole('doctor')) {
        return redirect()->route('doctor.dashboard');
    }

    if ($user->hasRole('patient')) {
        return redirect()->route('patient.dashboard');
    }

    abort(403, 'Role tidak dikenali');
})->middleware('auth')->name('dashboard');


/*
|--------------------------------------------------------------------------
| PROFILE ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
    Route::resource('specializations', SpecializationController::class);
    Route::resource('doctors', AdminDoctor::class);
    Route::resource('appointments', AdminAppointment::class);
    Route::resource('users', UserManagementController::class);
    Route::post('users/{user}/reset-password', [UserManagementController::class, 'resetPassword'])->name('users.reset-password');
});


/*
|--------------------------------------------------------------------------
| DOCTOR ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:doctor'])->prefix('doctor')->name('doctor.')->group(function () {
    Route::get('/dashboard', [DoctorDashboard::class, 'index'])->name('dashboard');
    Route::resource('schedules', ScheduleController::class);
    Route::resource('appointments', DoctorAppointment::class);
    Route::patch('/appointments/{appointment}/update-status', [DoctorAppointment::class, 'updateStatus'])->name('appointments.update-status');
});


/*
|--------------------------------------------------------------------------
| PATIENT ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:patient'])->prefix('patient')->name('patient.')->group(function () {
    Route::get('/dashboard', [PatientDashboard::class, 'index'])->name('dashboard');
    Route::get('/doctors', [PatientDoctor::class, 'index'])->name('doctors.index');
    Route::get('/doctors/{doctor}', [PatientDoctor::class, 'show'])->name('doctors.show');
    Route::resource('appointments', PatientAppointment::class);
    Route::get('/appointments/{appointment}/cancel', [PatientAppointment::class, 'cancel'])->name('appointments.cancel');
});


require __DIR__.'/auth.php';
