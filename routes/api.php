<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ContenuController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\PlaylistController;
use App\Http\Controllers\Api\FavoriController;
use App\Http\Controllers\Api\HistoriqueController;
use App\Http\Controllers\Api\TelechargementController;
use App\Http\Controllers\Api\AbonnementController;
use App\Http\Controllers\Api\CommentaireController;

// ==================
// AUTH (toujours en haut)
// ==================
//Route::post('/auth/register', [AuthController::class, 'register']);
//Route::post('/auth/login', [AuthController::class, 'login']);

Route::post('/login', [AuthController::class, 'login']);       // Alias
Route::post('/register', [AuthController::class, 'register']); // Alias
// ==================
// ACCUEIL
// ==================
Route::get('/home/stats', [HomeController::class, 'stats']);
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/contenus/featured', [ContenuController::class, 'featured']);
Route::get('/contenus/popular', [ContenuController::class, 'popular']);

// ==================
// EXPLORER
// ==================
Route::get('/contenus', [ContenuController::class, 'index']);
Route::get('/contenus/categorie/{slug}', [ContenuController::class, 'byCategory']);
Route::post('/contenus', [ContenuController::class, 'store']);
Route::post('/upload', [ContenuController::class, 'upload']);

// ==================
// CONTENU PAR ID (toujours à la fin)
// ==================
Route::get('/contenus/{id}', [ContenuController::class, 'show']);

// ==================
// PROFIL
// ==================
Route::get('/profile/{userId}/summary', [ProfileController::class, 'summary']);
Route::get('/profile/{userId}/favoris', [ProfileController::class, 'favoris']);
Route::get('/profile/{userId}/historiques', [ProfileController::class, 'historiques']);
Route::get('/profile/{userId}/telechargements', [ProfileController::class, 'telechargements']);
Route::get('/profile/{userId}/playlists', [ProfileController::class, 'playlists']);

// ==================
// PLAYLIST
// ==================
Route::post('/playlists', [PlaylistController::class, 'store']);
Route::post('/playlists/{playlistId}/items', [PlaylistController::class, 'addItem']);
Route::delete('/playlists/{playlistId}/items/{itemId}', [PlaylistController::class, 'removeItem']);

// ==================
// FAVORIS
// ==================
Route::post('/favoris/toggle', [FavoriController::class, 'toggle']);

// ==================
// HISTORIQUE
// ==================
Route::post('/historiques', [HistoriqueController::class, 'store']);

// ==================
// TELECHARGEMENTS
// ==================
Route::post('/telechargements', [TelechargementController::class, 'store']);

// ==================
// ABONNEMENTS
// ==================
Route::post('/abonnements/toggle', [AbonnementController::class, 'toggle']);

// ==================
// COMMENTAIRES
// ==================
Route::get('/contenus/{contenuId}/commentaires', [CommentaireController::class, 'index']);
Route::post('/contenus/{contenuId}/commentaires', [CommentaireController::class, 'store']);
