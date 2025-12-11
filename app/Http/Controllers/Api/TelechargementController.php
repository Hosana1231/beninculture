<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Telechargement;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TelechargementController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'user_id'    => 'required|exists:users,id',
            'contenu_id' => 'required|exists:contenus,id',
        ]);

        $telech = Telechargement::create([
            'user_id'       => $request->user_id,
            'contenu_id'    => $request->contenu_id,
            'telecharge_le' => Carbon::now(),
        ]);

        return response()->json($telech, 201);
    }
}
