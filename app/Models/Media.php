<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
