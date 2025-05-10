<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'prenom',
        'matricule',
        'centre',
    ];
    public function equipements()
    {
        return $this->belongsToMany(Equipement::class, 'affectations')
                    ->withPivot('date_affectation', 'user_id')
                    ->withTimestamps();
    }

}
