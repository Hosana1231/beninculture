<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Abonnement;
use Illuminate\Http\Request;

class AbonnementController extends Controller
{
    public function toggle(Request $request)
    {
        $request->validate([
            'user_id'  => 'required|exists:users,id',
            'cible_id' => 'required|exists:users,id',
        ]);

        if ($request->user_id == $request->cible_id) {
            return response()->json(['message' => 'Impossible de vous abonner à vous-même'], 422);
        }

        $abonnement = Abonnement::where('user_id', $request->user_id)
            ->where('cible_id', $request->cible_id)
            ->first();

        if ($abonnement) {
            $abonnement->delete();
            return response()->json(['status' => 'unfollow']);
        } else {
            Abonnement::create($request->only('user_id', 'cible_id'));
            return response()->json(['status' => 'follow']);
        }
    }
}
