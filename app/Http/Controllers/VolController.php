<?php

namespace App\Http\Controllers;

use App\Models\Vol;
use Illuminate\Http\Request;

class VolController extends Controller
{
    // GET /api/vols → lister tous les vols
    public function index()
    {
        $vols = Vol::all();
        return response()->json($vols);
    }

    // GET /api/vols/1 → voir un vol précis
    public function show($id)
    {
        $vol = Vol::find($id);

        if (!$vol) {
            return response()->json(['message' => 'Vol non trouvé'], 404);
        }

        return response()->json($vol);
    }

    // POST /api/vols → créer un vol (Admin)
    public function store(Request $request)
    {
        $request->validate([
            'numero_vol'         => 'required',
            'origine'            => 'required',
            'destination'        => 'required',
            'date_depart'        => 'required|date',
            'date_arrivee'       => 'required|date',
            'prix'               => 'required|numeric',
            'places_disponibles' => 'required|integer'
        ]);

        $vol = Vol::create($request->all());
        return response()->json($vol, 201);
    }

    // PUT /api/vols/1 → modifier un vol (Admin)
    public function update(Request $request, $id)
    {
        $vol = Vol::find($id);

        if (!$vol) {
            return response()->json(['message' => 'Vol non trouvé'], 404);
        }

        $vol->update($request->all());
        return response()->json($vol);
    }

    // DELETE /api/vols/1 → supprimer un vol (Admin)
    public function destroy($id)
    {
        $vol = Vol::find($id);

        if (!$vol) {
            return response()->json(['message' => 'Vol non trouvé'], 404);
        }

        $vol->delete();
        return response()->json(['message' => 'Vol supprimé']);
    }

    // GET /api/vols/search → rechercher des vols
    public function search(Request $request)
    {
        $vols = Vol::where('origine', $request->origine)
                   ->where('destination', $request->destination)
                   ->whereDate('date_depart', $request->date_depart)
                   ->where('places_disponibles', '>', 0)
                   ->get();

        return response()->json($vols);
    }
    
public function volsRetour(Request $request)
{
    $vols = Vol::where('origine', $request->destination)
               ->where('destination', $request->origine)
               ->where('places_disponibles', '>', 0)
               ->get();

    return response()->json($vols);
}
    }
