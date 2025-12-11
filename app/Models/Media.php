<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Media extends Model
{
    use HasFactory;

    protected $fillable = [
        'contenu_id',
        'type_media',
        'url',
        'extension',
        'taille'
    ];

    public function contenu()
    {
        return $this->belongsTo(Contenu::class);
    }
}
