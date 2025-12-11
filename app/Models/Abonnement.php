<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Abonnement extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'cible_id'];

    public function utilisateur()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function auteur()
    {
        return $this->belongsTo(User::class, 'cible_id');
    }
}
