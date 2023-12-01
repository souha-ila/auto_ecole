<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vehicule extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table= 'vehicules';

    protected $fillable = [
        
        'modele',
        'matricule',
        'marque',
        'autoEcole_id',
        'permis_id',
        
    ];
    
}
