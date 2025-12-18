<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contenu;
use App\Models\Media;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ContenuController extends Controller
{
    // GET /api/contenus → Affiche les contenus avec leurs médias
    public function index()
{
    $contenus = Contenu::with(['media', 'category', 'utilisateur'])
        ->orderBy('created_at', 'desc')
        ->get()
        ->map(function ($contenu) {

            // Cherche l'image dans la table MEDIA
            $imageMedia = $contenu->media->first(function ($media) {
                return $media->type_media === 'image';
            });

            // Cherche la vidéo/audio dans la table MEDIA
            $mediaFile = $contenu->media->first(function ($media) {
                return $media->type_media !== 'image'; // video ou audio
            });

            return [
                'id' => $contenu->id,
                'titre' => $contenu->titre,
                'description' => $contenu->description,
                'type_contenu' => $contenu->type_contenu,
                'categorie' => $contenu->category->nom ?? 'Général',
                'categorie_id' => $contenu->categorie_id,
                'vues' => $contenu->vues,
                'likes' => $contenu->likes,
                'est_featured' => (bool)$contenu->est_featured,
                'couleur_debut' => $contenu->couleur_debut,
                'couleur_fin' => $contenu->couleur_fin,
                'artiste' => $contenu->utilisateur->name ?? 'Anonyme',

                // SEULEMENT si tu as vraiment des médias dans ta table `media`
                'image_url' => $imageMedia ? url($imageMedia->url) : null,
                'media_url' => $mediaFile ? url($mediaFile->url) : null,
                'media_type' => $mediaFile ? $mediaFile->type_media : null,

                'created_at' => $contenu->created_at,
            ];
        });

    return response()->json([
        'success' => true,
        'data' => $contenus
    ]);
}

    // POST /api/contenus → Crée un contenu AVEC UPLOAD DE FICHIERS
    public function store(Request $request)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'categorie_id' => 'required|exists:categories,id',
            'type_contenu' => 'required|in:musique,video,art,tradition,lieu,histoire',
            'image_file' => 'required|file|image|max:5120', // 5MB max, doit être une image
            'media_file' => 'required|file|mimes:mp4,avi,mov,mp3,wav|max:20480', // 20MB max
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Crée le contenu
        $contenu = Contenu::create([
            'titre' => $request->titre,
            'slug' => Str::slug($request->titre),
            'categorie_id' => $request->categorie_id,
            'user_id' => auth()->id() ?? 1,
            'type_contenu' => $request->type_contenu,
            'description' => $request->description,
            'couleur_debut' => $request->couleur_debut ?? '#FF9800',
            'couleur_fin' => $request->couleur_fin ?? '#FF5722',
        ]);

        // Upload l'image
        if ($request->hasFile('image_file')) {
            Media::uploadFile($request->file('image_file'), $contenu->id, 'image');
        }

        // Upload le média (vidéo/audio)
        if ($request->hasFile('media_file')) {
            $type = $request->type_contenu === 'musique' ? 'audio' : 'video';
            Media::uploadFile($request->file('media_file'), $contenu->id, $type);
        }

        return response()->json([
            'success' => true,
            'message' => 'Contenu et fichiers uploadés avec succès!',
            'data' => $contenu->load('media')
        ], 201);
    }

    // POST /api/upload → Juste pour uploader un fichier
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:20480',
            'type' => 'required|in:image,video,audio'
        ]);

        $file = $request->file('file');
        $type = $request->type;

        // Upload le fichier
        $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $folder = $type . 's';
        $path = $file->storeAs($folder, $fileName, 'public');

        return response()->json([
            'success' => true,
            'url' => url('storage/' . $path),
            'path' => $path,
            'filename' => $fileName
        ]);
    }

    // Dans ContenuController.php - ajoutez cette méthode
public function show($id)
{
    // Chercher le contenu avec ses relations
    $contenu = Contenu::with(['media', 'category', 'utilisateur'])
        ->find($id);

    if (!$contenu) {
        return response()->json([
            'success' => false,
            'message' => 'Contenu non trouvé'
        ], 404);
    }

    // Chercher l'image dans les médias
    $imageMedia = $contenu->media->first(function ($media) {
        return $media->type_media === 'image';
    });

    // Chercher le fichier média (vidéo/audio)
    $mediaFile = $contenu->media->first(function ($media) {
        return $media->type_media !== 'image';
    });

    $response = [
        'success' => true,
        'data' => [
            'id' => $contenu->id,
            'titre' => $contenu->titre,
            'description' => $contenu->description,
            'type_contenu' => $contenu->type_contenu,
            'categorie' => $contenu->category->nom ?? 'Général',
            'categorie_id' => $contenu->categorie_id,
            'vues' => $contenu->vues,
            'likes' => $contenu->likes,
            'est_featured' => (bool)$contenu->est_featured,
            'couleur_debut' => $contenu->couleur_debut,
            'couleur_fin' => $contenu->couleur_fin,
            'artiste' => $contenu->utilisateur->name ?? 'Anonyme',
            'image_url' => $imageMedia ? url($imageMedia->url) : null,
            'media_url' => $mediaFile ? url($mediaFile->url) : null,
            'media_type' => $mediaFile ? $mediaFile->type_media : null,
            'created_at' => $contenu->created_at,
        ]
    ];

    return response()->json($response);
}
}
