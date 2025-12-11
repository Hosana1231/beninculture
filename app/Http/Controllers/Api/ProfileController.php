<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;

class ProfileController extends Controller
{
    public function summary($userId)
    {
        $user = User::withCount([
            'favoris',
            'historiques',
            'telechargements',
            'playlists',
            'abonnements as abonnements_count',
            'abonnés as abonnes_count',
        ])->findOrFail($userId);

        return response()->json($user);
    }

    public function favoris($userId)
    {
        $user = User::findOrFail($userId);

        $favoris = $user->favoris()
            ->with('contenu.categorie')
            ->latest()
            ->get()
            ->map(fn($fav) => $fav->contenu);

        return response()->json($favoris);
    }

    public function historiques($userId)
    {
        $user = User::findOrFail($userId);

        $data = $user->historiques()
            ->with('contenu.categorie')
            ->latest('vu_le')
            ->get();

        return response()->json($data);
    }

    public function telechargements($userId)
    {
        $user = User::findOrFail($userId);

        $data = $user->telechargements()
            ->with('contenu.categorie')
            ->latest('telecharge_le')
            ->get();

        return response()->json($data);
    }

    public function playlists($userId)
{
    $playlists = Playlist::where('user_id', $userId)
        ->withCount('items')   // ajoute total items
        ->get()
        ->map(function ($p) {
            return [
                'id'    => $p->id,
                'nom'   => $p->nom,
                'total' => $p->items_count,
            ];
        });

    return response()->json([
        'playlists' => $playlists
    ]);
}

}
