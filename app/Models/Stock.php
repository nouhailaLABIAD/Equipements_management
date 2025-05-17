<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    
    protected $table = 'stocks';

    protected $fillable = [
        'type_equipement',
        'reference',
        'configuration',
        'quantite',
        'date_arrivee',
        'numero_marche',
    ];
    public function equipements()
    {
        return $this->hasMany(Equipement::class);
    }
}
