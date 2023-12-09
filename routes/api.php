<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VehiculeController;




Route::apiResource('vehicules', VehiculeController::class);
Route::get('vehicules/autoecole/{autoEcoleId}', [VehiculeController::class, 'vehiclesByAutoEcole']);
Route::get('vehicules/permis/{PermisId}', [VehiculeController::class, 'vehiclesByPermis']);

