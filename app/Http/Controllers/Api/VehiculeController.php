<?php

namespace App\Http\Controllers\Api;

use App\Models\Vehicule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class VehiculeController extends Controller
{

    //-------------------------List of vehicules--------------------------
    public function index(){
    $vehicules = Vehicule::all();
    if ( count ($vehicules) > 0){
        return response()->json([
            "status" => 200,
            "vehicules"=>$vehicules
        ],200);
    }else{
        return response()->json([
            "status"=>404,
            "message"=>'NO Results Found'
        ],404);
    }
  
    }
//-------------------------AddVehicule-------------------------- 
public function addVehicule(Request $request)
{
    // Validation rules
    $validator = Validator::make($request->all(), [
        'modele' => 'required|integer',
        'matricule' => 'required|unique:vehicules|string',
        'marque' => 'required|string',
        'autoEcole_id' => 'required|integer',
        'permis_id' => 'required|integer',
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 422);//422: for input errors
    }
    $vehicule = Vehicule::create([
        'modele' => $request->modele,
        'matricule' => $request->matricule,
        'marque' => $request->marque,
        'autoEcole_id' => $request->autoEcole_id,
        'permis_id' => $request->permis_id,
    ]);
    if ($vehicule) {
        return response()->json(['message' => 'Vehicule added successfully', 'data' => $vehicule], 201);
    } else {
        return response()->json(['error' => 'Failed to create vehicule'], 500);
    }
}

//--------------------------------show details of vehicul--------------------
public function Details($id)
    {
        $vehicule = Vehicule::find($id);
        if ($vehicule) {
            return response()->json([
                'status' => 'success',
                'data' => $vehicule,
            ],200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'the Vehicule with ID ' . $id.'  Not found',
            ], 404); 
        }
    }

//------------------------------------Edit function------------------
public function Edit($id)
    {
        $vehicule = Vehicule::find($id);
        if ($vehicule) {
            return response()->json([
                'status' => 'success',
                'data' => $vehicule,
            ],200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'the Vehicule with ID ' . $id.'  Not found',
            ], 404); 
        }
    }
//-------Update-----------
public function Update(Request $request, $id)
    {        
        $validator = Validator::make($request->all(), [
            'modele' => 'required|integer',
            'matricule' => 'required|string|unique:vehicules,matricule,'.$id,
            'marque' => 'required|string',
            'autoEcole_id' => 'required|integer',
            'permis_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422); 
        }

        $vehicule = Vehicule::find($id);
        
        if ($vehicule) {
            $vehicule->update([ 
                'modele' => $request->modele,
                'matricule' => $request->matricule,
                'marque' => $request->marque,
                'autoEcole_id' => $request->autoEcole_id,
                'permis_id' => $request->permis_id,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Vehicule updated successfully',
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Vehicule not found',
            ], 404);
        }
    }
//----------------------------Delete------------------------------------
public function Delete(Request $request, $id){
    $vehicule = Vehicule::find($id);
    if ($vehicule) {
        $vehicule->delete();
        return response()->json([
            'status'=> 'success',
            'message'=> ' Vehicule deleted successfully',
            ],200);
        }
        else {
            return response()->json([
                'status'=> 'error',
                'message'=> 'Not found',
                ],404);
        }

}
//-----------------List of vehicles by AutoEcole ID-----------------
public function vehiclesByAutoEcole($autoEcoleId)
{
    $vehicles = Vehicule::where('autoEcole_id', $autoEcoleId)->get();

    if ($vehicles->isNotEmpty()) {
        return response()->json([
            'status' => 'success',
            'data' => $vehicles,
        ], 200);
    } else {
        return response()->json([
            'status' => 'error',
            'message' => 'No vehicles found for AutoEcole ID ' . $autoEcoleId,
        ], 404);
    }
}

//-----------------List of vehicles by PermisId-----------------
public function vehiclesByPermis($PermisId)
{
    $vehicles = Vehicule::where('permis_id', $PermisId)->get();

    if ($vehicles->isNotEmpty()) {
        return response()->json([
            'status' => 'success',
            'data' => $vehicles,
        ], 200);
    } else {
        return response()->json([
            'status' => 'error',
            'message' => 'No vehicles found for Permis ID ' . $PermisId,
        ], 404);
    }
}

}
