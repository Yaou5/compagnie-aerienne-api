<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Vol;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    // GET /api/reservations → lister toutes les réservations (Admin)
    public function index()
    {
        $reservations = Reservation::with(['user', 'vol', 'volRetour'])->get();
        return response()->json($reservations);
    }

    // GET /api/reservations/1 → voir une réservation précise
    public function show($id)
    {
        $reservation = Reservation::with(['user', 'vol', 'volRetour'])->find($id);

        if (!$reservation) {
            return response()->json(['message' => 'Réservation non trouvée'], 404);
        }

        return response()->json($reservation);
    }

    // POST /api/reservations → créer une réservation
    public function store(Request $request)
    {
        $request->validate([
            'vol_id'          => 'required|exists:vols,id',
            'type_voyage'     => 'required|in:aller_simple,aller_retour',
            'vol_retour_id'   => 'required_if:type_voyage,aller_retour|exists:vols,id|nullable',
        ]);

        // Vérifier places disponibles
        $vol = Vol::find($request->vol_id);
        if ($vol->places_disponibles <= 0) {
            return response()->json(['message' => 'Plus de places disponibles'], 400);
        }

        // Créer la réservation
        $reservation = Reservation::create([
            'user_id'          => auth()->id(),
            'vol_id'           => $request->vol_id,
            'vol_retour_id'    => $request->vol_retour_id,
            'type_voyage'      => $request->type_voyage,
            'date_reservation' => now(),
            'statut'           => 'confirmé'
        ]);

        // Décrémenter les places disponibles
        $vol->update([
            'places_disponibles' => $vol->places_disponibles - 1
        ]);

        return response()->json($reservation, 201);
    }

    // DELETE /api/reservations/1 → annuler une réservation
    public function destroy($id)
    {
        $reservation = Reservation::find($id);

        if (!$reservation) {
            return response()->json(['message' => 'Réservation non trouvée'], 404);
        }

        // Remettre la place disponible
        $vol = Vol::find($reservation->vol_id);
        $vol->update([
            'places_disponibles' => $vol->places_disponibles + 1
        ]);

        $reservation->update(['statut' => 'annulé']);
        return response()->json(['message' => 'Réservation annulée']);
    }

    // GET /api/mes-reservations → réservations de l'utilisateur connecté
    public function mesReservations()
    {
        $reservations = Reservation::with(['vol', 'volRetour'])
                        ->where('user_id', auth()->id())
                        ->get();
        return response()->json($reservations);
    }
}