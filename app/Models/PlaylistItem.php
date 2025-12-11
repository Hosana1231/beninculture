<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PlaylistItem extends Model
{
    use HasFactory;

    protected $fillable = ['playlist_id', 'contenu_id'];

    public function playlist()
    {
        return $this->belongsTo(Playlist::class);
    }

    public function contenu()
    {
        return $this->belongsTo(Contenu::class);
    }
}
