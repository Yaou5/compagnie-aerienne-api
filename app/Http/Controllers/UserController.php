<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // GET /api/users → lister tous les utilisateurs
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    // DELETE /api/users/1 → supprimer un utilisateur
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Utilisateur non trouvé'], 404);
        }

        $user->delete();
        return response()->json(['message' => 'Utilisateur supprimé']);
    }
}