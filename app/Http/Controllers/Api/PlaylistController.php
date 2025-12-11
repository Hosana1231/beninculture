<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Playlist;
use App\Models\PlaylistItem;
use Illuminate\Http\Request;

class PlaylistController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'nom'     => 'required|string|max:255',
        ]);

        $playlist = Playlist::create([
            'user_id' => $request->user_id,
            'nom'     => $request->nom,
            'couleur' => $request->couleur,
        ]);

        return response()->json($playlist, 201);
    }

    public function addItem($playlistId, Request $request)
    {
        $request->validate([
            'contenu_id' => 'required|exists:contenus,id',
        ]);

        $playlist = Playlist::findOrFail($playlistId);

        $item = PlaylistItem::create([
            'playlist_id' => $playlist->id,
            'contenu_id'  => $request->contenu_id,
        ]);

        return response()->json($item, 201);
    }

    public function removeItem($playlistId, $itemId)
    {
        $item = PlaylistItem::where('playlist_id', $playlistId)
            ->where('id', $itemId)
            ->firstOrFail();

        $item->delete();

        return response()->json(['message' => 'Supprimé']);
    }
    public function items($playlistId)
{
    $items = PlaylistItem::where('playlist_id', $playlistId)
        ->with('contenu') // charge le contenu lié
        ->get()
        ->map(function ($item) {
            return [
                'id'        => $item->contenu->id,
                'titre'     => $item->contenu->titre,
                'type'      => $item->contenu->type_contenu,
                'pivot_id'  => $item->id,
            ];
        });

    return response()->json([
        'items' => $items
    ]);
}

}
