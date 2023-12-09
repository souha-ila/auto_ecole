<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VehiculeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'modele' => $this->modele,
            'matricule' => $this->matricule,
            'marque' => $this->marque,
            'couleur' => $this->couleur,
            'autoEcoleId' => $this->autoEcole_id,
            'permisId' => $this->permis_id,
            
        ];
    }
}
