<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Historique;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HistoriqueController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'user_id'    => 'required|exists:users,id',
            'contenu_id' => 'required|exists:contenus,id',
        ]);

        $historique = Historique::create([
            'user_id'    => $request->user_id,
            'contenu_id' => $request->contenu_id,
            'vu_le'      => Carbon::now(),
        ]);

        return response()->json($historique, 201);
    }
}
