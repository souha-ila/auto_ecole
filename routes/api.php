<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VehiculeController;




Route::get('vehicules/autoecole/{autoEcoleId}', [VehiculeController::class, 'vehiculesByAutoEcole']);
Route::get('vehicules/permis/{PermisId}', [VehiculeController::class, 'vehiculesByPermis']);
Route::apiResource('vehicules', VehiculeController::class);
