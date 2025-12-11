<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Favori;
use Illuminate\Http\Request;

class FavoriController extends Controller
{
    public function toggle(Request $request)
    {
        $request->validate([
            'user_id'    => 'required|exists:users,id',
            'contenu_id' => 'required|exists:contenus,id',
        ]);

        $favori = Favori::where('user_id', $request->user_id)
            ->where('contenu_id', $request->contenu_id)
            ->first();

        if ($favori) {
            $favori->delete();
            return response()->json(['status' => 'removed']);
        } else {
            Favori::create($request->only('user_id', 'contenu_id'));
            return response()->json(['status' => 'added']);
        }
    }
}
