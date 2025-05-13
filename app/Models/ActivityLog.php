<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;
    public $timestamps = false; // On utilise manuellement created_at

    protected $fillable = [
        'user_id',
        'action',
        'route',
        'created_at',
    ];
protected $casts = [
        'created_at' => 'datetime', // ✅ CAST automatique en Carbon
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
