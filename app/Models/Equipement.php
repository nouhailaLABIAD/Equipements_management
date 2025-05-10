<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipement extends Model
{
    use HasFactory;



     // Indique que le modèle est lié à la table "equipements"
     protected $table = 'equipements';

     // Les champs qui peuvent être assignés en masse
     protected $fillable = ['marque', 'reference', 'configuration', 'date_acquisition', 'etat', 'stock_id'];
 
     // Relation plusieurs-à-un (Chaque équipement appartient à un stock)
     public function stock()
     {
         return $this->belongsTo(Stock::class);
     }
     public function members()
    {
        return $this->belongsToMany(Member::class, 'affectations')
                    ->withPivot('date_affectation', 'user_id')
                    ->withTimestamps();
    }
    public function derniereAffectation()
    {
        return $this->hasOne(Affectation::class)->latestOfMany();
    }
    public function affectations()
    {
        return $this->hasMany(Affectation::class)->orderBy('date_affectation', 'desc');
    }


}
