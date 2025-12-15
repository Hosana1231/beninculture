<?php
namespace App\Http\Controllers\Api;

use App\Models\Contenu;
use App\Models\Media;
use Illuminate\Http\Request;

class ContenuController extends Controller
{
    // GET /api/contenus → Tous les contenus avec leurs médias
    public function index()
    {
        // Charge les contenus avec leurs médias et catégorie
        $contenus = Contenu::with(['media', 'categorie', 'utilisateur'])
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($contenu) {
                // Formate la réponse
                return [
                    'id' => $contenu->id,
                    'titre' => $contenu->titre,
                    'description' => $contenu->description,
                    'type_contenu' => $contenu->type_contenu,
                    'categorie' => $contenu->categorie ? $contenu->categorie->nom : null,
                    'categorie_id' => $contenu->categorie_id,
                    'vues' => $contenu->vues,
                    'likes' => $contenu->likes,
                    'est_featured' => $contenu->est_featured,
                    'couleur_debut' => $contenu->couleur_debut,
                    'couleur_fin' => $contenu->couleur_fin,
                    'artiste' => $contenu->utilisateur ? $contenu->utilisateur->name : 'Anonyme',
                    // Trouve l'image de couverture (premier média de type image)
                    'image_url' => $contenu->media->firstWhere('type_media', 'image')?->url
                                   ?: 'https://images.unsplash.com/photo-1511379938547-c1f69b13d835?w=400&h=400&fit=crop',
                    // Trouve la vidéo/audio (premier média de type video ou audio)
                    'media_url' => $contenu->media->firstWhere('type_media', 'video')?->url
                                   ?: $contenu->media->firstWhere('type_media', 'audio')?->url
                                   ?: null,
                    'created_at' => $contenu->created_at,
                    'updated_at' => $contenu->updated_at,
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $contenus
        ]);
    }

    // GET /api/contenus/featured → Contenus en vedette
    public function featured()
    {
        $contenus = Contenu::with(['media', 'categorie'])
            ->where('est_featured', true)
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        return response()->json([
            'success' => true,
            'data' => $contenus
        ]);
    }

    // GET /api/contenus/{id} → Un contenu spécifique
    public function show($id)
    {
        $contenu = Contenu::with(['media', 'categorie', 'utilisateur'])->find($id);

        if (!$contenu) {
            return response()->json([
                'success' => false,
                'message' => 'Contenu non trouvé'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $contenu
        ]);
    }

    // POST /api/contenus → Ajouter un contenu
    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'categorie_id' => 'required|exists:categories,id',
            'type_contenu' => 'required|in:musique,video,art,tradition,lieu,histoire',
            'description' => 'nullable|string',
        ]);

        // Crée le contenu
        $contenu = Contenu::create([
            'titre' => $request->titre,
            'slug' => \Str::slug($request->titre),
            'categorie_id' => $request->categorie_id,
            'user_id' => $request->user_id ?? 1, // À adapter avec l'auth
            'type_contenu' => $request->type_contenu,
            'description' => $request->description,
            'couleur_debut' => $request->couleur_debut ?? '#FF9800',
            'couleur_fin' => $request->couleur_fin ?? '#FF5722',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Contenu créé avec succès',
            'data' => $contenu
        ], 201);
    }
}
