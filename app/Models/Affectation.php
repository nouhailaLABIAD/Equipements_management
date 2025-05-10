<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Affectation extends Model
{
    use HasFactory;
    protected $fillable = [
        'equipement_id',
        'member_id',
        'user_id',
        'date_affectation',
    ];

    // Relations
    public function equipement() {
        return $this->belongsTo(Equipement::class);
    }

    public function member() {
        return $this->belongsTo(Member::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
