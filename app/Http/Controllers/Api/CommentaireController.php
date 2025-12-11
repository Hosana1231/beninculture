<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Commentaire;
use Illuminate\Http\Request;

class CommentaireController extends Controller
{
    public function index($contenuId)
    {
        $commentaires = Commentaire::where('contenu_id', $contenuId)
            ->with('user')
            ->latest()
            ->get();

        return response()->json($commentaires);
    }

    public function store($contenuId, Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'message' => 'required|string',
        ]);

        $commentaire = Commentaire::create([
            'user_id'    => $request->user_id,
            'contenu_id' => $contenuId,
            'message'    => $request->message,
        ]);

        return response()->json($commentaire, 201);
    }
}
