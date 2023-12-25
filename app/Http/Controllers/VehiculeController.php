<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Vehicule;
use Illuminate\Http\Request;
use App\Filters\VehiculesFilter;
use App\Http\Controllers\Controller;
use App\Http\Resources\VehiculeResource;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\VehiculeCollection;

class VehiculeController extends Controller

{
    
    public function index(Request $request)
    {
        try{

            $filter = new VehiculesFilter();
            $filterItems = $filter->transform($request);
            $vehicules = Vehicule::Where($filterItems)->get();
            return new VehiculeCollection($vehicules);
            
        } catch (\Throwable $th) {
            return Helper::handleException($th);
        }
    }
//------------------------store----------------   
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'modele' => 'required|integer',
            'matricule' => 'required|unique:vehicules|string',
            'marque' => 'required|string',
            'couleur' => 'required|string',
            'autoEcole_id' => 'required|integer',
            'permis_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try
        {
            $vehicule = Vehicule::create($validator->validate());
            return response()->json(["data" => ["message" => "Vehicule created with success", "id" => $vehicule->id]], 201);
        } catch (\Throwable $th) {
            return Helper::handleException($th);
        }
    }
//------------------------show vehicule by ID----------------
    public function show($id)
    {
        // if the vehicule is not your vehicule then you can't get it
        try
        {
            $vehicule = Vehicule::find($id);

            if (!$vehicule)
            {
                return response()->json(['errors' => ["message" => "this vehicule not found"]], 404);
            } 
            return new VehiculeResource($vehicule);

        } catch (\Throwable $th) {
            return Helper::handleException($th);
        }
    }
    
//--------------------------update vehicule-------------------
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
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $vehicule = Vehicule::find($id);
        
        if (!$vehicule) {
            return response()->json(['message' => 'Vehicule not found',], 404);  
        }   
        try 
        {
            $vehicule->update([ 
            'modele' => $request->modele,
            'matricule' => $request->matricule,
            'marque' => $request->marque,
            'couleur' => $request->couleur,
            'autoEcole_id' => $request->autoEcole_id,
            'permis_id' => $request->permis_id,
            ]);
                
           return response()->json(["data" => ['message' => 'Vehicule updated successfully']], 200);
        
        }catch (\Throwable $th)
            { 
                return Helper::handleException($th);
            }
   }
    
//--------------------------------delete vehicule---------------------
    public function destroy(Request $request, $id)
    {
        try {
            $vehicule = Vehicule::find($id);
            
            if (!$vehicule) {
                return response()->json(['message' => 'Not found'], 404);
            }

            $vehicule->delete();
            return response()->json(['message' => 'Vehicule deleted successfully'], 200);

        } catch (\Throwable $th)
        { 
            return Helper::handleException($th);
        }
    }

}


