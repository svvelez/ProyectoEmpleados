<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadoController;
use App\Mail\NotificationMailable;
use Illuminate\Support\Facades\Mail;

 Route::get('/', function () {

     return redirect()->route('empleados.index');
});



Route::resource('empleados',EmpleadoController::class);
Route::get('/exportPdf',[EmpleadoController::class,'exportPdf'])->name('exportPdf');


