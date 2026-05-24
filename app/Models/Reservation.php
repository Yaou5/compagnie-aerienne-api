<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $table = 'reservations';

    protected $fillable = [
        'user_id',
        'vol_id',
        'vol_retour_id',
        'type_voyage',
        'date_reservation',
        'statut'
    ];

    // Une réservation appartient à un user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Une réservation appartient à un vol aller
    public function vol()
    {
        return $this->belongsTo(Vol::class, 'vol_id');
    }

    // Une réservation appartient à un vol retour
    public function volRetour()
    {
        return $this->belongsTo(Vol::class, 'vol_retour_id');
    }
}