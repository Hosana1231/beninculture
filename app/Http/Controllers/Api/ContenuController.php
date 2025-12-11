<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contenu;
use App\Models\Category;
use Illuminate\Http\Request;

class ContenuController extends Controller
{
    public function index(Request $request)
    {
        // Optionnel : filtrer par type_contenu, texte de recherche, etc.
        $query = Contenu::with(['categorie', 'auteur', 'medias']);

        if ($request->has('type_contenu')) {
            $query->where('type_contenu', $request->type_contenu);
        }

        if ($request->has('search')) {
            $query->where('titre', 'like', '%'.$request->search.'%');
        }

        return response()->json($query->latest()->get());
    }

    public function show($id)
    {
        $contenu = Contenu::with(['categorie', 'auteur', 'medias', 'commentaires.user'])
            ->findOrFail($id);

        return response()->json($contenu);
    }

    public function featured()
    {
        $items = Contenu::with('auteur')
            ->where('est_featured', true)
            ->latest()
            ->take(10)
            ->get();

        return response()->json($items);
    }

    public function popular()
    {
        $items = Contenu::with('auteur')
            ->orderBy('vues', 'desc')
            ->take(10)
            ->get();

        return response()->json($items);
    }

    public function byCategory($categorieSlug)
    {
        $categorie = Category::where('slug', $categorieSlug)->firstOrFail();

        $contenus = Contenu::with(['auteur', 'medias'])
            ->where('categorie_id', $categorie->id)
            ->latest()
            ->get();

        return response()->json([
            'categorie' => $categorie,
            'contenus' => $contenus,
        ]);
    }
}
