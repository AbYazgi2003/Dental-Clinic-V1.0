<?php

use App\Http\Controllers\AdminOperationsController;
use App\Http\Controllers\AvailavleTimesController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\DoctorOperationsController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function(){
Route::get('/',[AdminOperationsController::class,'index'])->name('adminMainPage');
Route::resource('departments',DepartmentController::class);
Route::resource('doctors',DoctorController::class);
Route::get('/logout',[AdminOperationsController::class,'logout'])->name('admin.logout');

});


Route::prefix('doctor')->middleware(['auth', 'role:doctor'])->group(function(){
    Route::get('' ,[DoctorOperationsController::class,'bio'])->name('doctor.Bio');
    Route::get('Appointments' ,[DoctorOperationsController::class,'appointments'] )->name('doctor.Appointments');
    Route::get('BookedAppointments' ,[DoctorOperationsController::class,'BookedAppointments'] )->name('doctor.BookedAppointments');
    Route::get('doctoredit/{id}',[DoctorOperationsController::class,'doctorEdit'])->name('doctor.doctorEdit' );
    Route::get('/logout',[PatientController::class,'logout'])->name('doctor.logout');

});

Route::post('appointments/store',[AvailavleTimesController::class,'store'])->name('appointments.store');
Route::get('/get-doctors/{department}', [PatientController::class, 'getDoctors']);


Route::prefix('patient')->middleware(['auth', 'role:patient'])->group(function(){
Route::get('/',[PatientController::class,'Bio'])->name('patient.Bio');
Route::get('/departments/{id}',[PatientController::class,'department'])->name('patient.departments');
Route::get('/BookedAppointment',[PatientController::class,'showBookedAppointments'])->name('patient.getBookedAppointment');
});
Route::get('/get-doctor-times/{id}', [PatientController::class, 'getDoctorTimes']);
Route::post('reservation',[PatientController::class,'reservation'])->name('reservation');

Route::get('/logout',[PatientController::class,'logout'])->name('patient.logout');

require __DIR__.'/auth.php';

