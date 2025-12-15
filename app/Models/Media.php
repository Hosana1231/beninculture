<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class Media extends Model
{
    protected $table = 'media';

    protected $fillable = [
        'contenu_id',
        'type_media',
        'url',
        'extension',
        'taille'
    ];

    // Relation avec le contenu
    public function contenu()
    {
        return $this->belongsTo(Contenu::class, 'contenu_id');
    }

    // Méthode pour uploader un fichier
    public static function uploadFile(UploadedFile $file, $contenuId, $typeMedia)
    {
        // Génère un nom unique
        $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

        // Chemin de stockage
        $folder = $typeMedia . 's'; // images, videos, audios
        $path = $file->storeAs($folder, $fileName, 'public');

        // Crée l'enregistrement dans la base
        return self::create([
            'contenu_id' => $contenuId,
            'type_media' => $typeMedia,
            'url' => Storage::url($path), // URL publique
            'extension' => $file->getClientOriginalExtension(),
            'taille' => $file->getSize(),
        ]);
    }
}
