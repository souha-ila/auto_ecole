<?php

namespace App\Http\Controllers;

use App\Models\Vehicule;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\VehiculeResource;
use Illuminate\Support\Facades\Validator;

class VehiculeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): JsonResponse
    {
        $vehicules = Vehicule::paginate();
        
        return response()->json(["data" => VehiculeResource::collection($vehicules)], 200);
    }
    
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //----------------------------------AddVehicule----------------------
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'modele' => 'required|integer',
            'matricule' => 'required|unique:vehicules|string',
            'marque' => 'required|string',
            'couleur' => 'required|string',
            'autoEcole_id' => 'required|integer',
            'permis_id' => 'required|integer',
        ]);

        $vehicule = Vehicule::create($request->all());

        if ($vehicule) {
            return response()->json(['message' => 'Vehicule added successfully', 'data' => ['id' => $vehicule->id]], 201);
        } else {
            return response()->json(['error' => 'Failed to create vehicule'], 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //--------------------------------show details of vehicul--------------------
    public function show($id)
    {
        try {
            $vehicule = Vehicule::findOrFail($id);
    
            return response()->json([
                'status' => 'success',
                'data' => $vehicule,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'The Vehicule with ID ' . $id . ' Not found',
            ], 404);
        }
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //-----------------------------------update vehicule---------------------
    public function update(Request $request, $id)
    {        
        $validator = Validator::make($request->all(), [
            'modele' => 'required|integer',
            'matricule' => 'required|string|unique:vehicules,matricule,'.$id,
            'marque' => 'required|string',
            'couleur' => 'required|string',
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
                'couleur' => $request->couleur,
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


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //--------------------------------delete vehicule---------------------
    public function destroy(Request $request, $id)
    {
        try {
            $vehicule = Vehicule::find($id);
            if ($vehicule) {
                $vehicule->delete();
                return response()->json(['status' => 'success', 'message' => 'Vehicule deleted successfully'], 200);
            } else {
                return response()->json(['status' => 'error', 'message' => 'Not found'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], 500);
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


