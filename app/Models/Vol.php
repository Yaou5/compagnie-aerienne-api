<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vol extends Model
{
    protected $table = 'vols';

    protected $fillable = [
        'numero_vol',
        'origine',
        'destination',
        'date_depart',
        'date_arrivee',
        'prix',
        'places_disponibles'
    ];

    // Un vol a plusieurs réservations
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}