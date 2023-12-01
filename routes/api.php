<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\VehiculeController;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('vehicules', [VehiculeController::class,'index']);
Route::post('vehicules', [VehiculeController::class,'AddVehicule']);
Route::get('vehicules/{id}', [VehiculeController::class,'Details']);
Route::get('vehicules/{id}/edit', [VehiculeController::class,'Edit']);
Route::put('vehicules/{id}/edit', [VehiculeController::class,'Update']);
Route::delete('vehicules/{id}/delete', [VehiculeController::class,'Delete']);
Route::get('vehicules/autoecole/{autoEcoleId}', [VehiculeController::class, 'vehiclesByAutoEcole']);
Route::get('vehicules/permis/{PermisId}', [VehiculeController::class, 'vehiclesByPermis']);

