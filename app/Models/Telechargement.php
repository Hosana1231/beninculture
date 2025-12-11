<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Telechargement extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'contenu_id', 'telecharge_le'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function contenu()
    {
        return $this->belongsTo(Contenu::class);
    }
}
