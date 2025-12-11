<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contenu;
use App\Models\User;
use App\Models\Region;

class HomeController extends Controller
{
    public function stats()
    {
        $totalContenus = Contenu::count();
        $totalUtilisateurs = User::count();
        $totalRegions = Region::count();

        return response()->json([
            'total_contenus' => $totalContenus,
            'total_utilisateurs' => $totalUtilisateurs,
            'total_regions' => $totalRegions,
        ]);
    }
}
