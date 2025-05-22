<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipement;
use App\Models\User;
use App\Models\Affectation;

class HomeController extends Controller
{
    public function index()
{
    $equipementsNeufs = Equipement::where('etat', 'neuf')->count();
    $equipementsBonEtat = Equipement::where('etat', 'bon état')->count();
    $equipementsAffectes = Equipement::where('etat', 'affecté')->count();
    $equipementsHorsService = Equipement::where('etat', 'hors service')->count();
    $equipementsNonAffectes = Equipement::where('etat', 'Non affecté')->count();

    // Dates du dernier ajout / signalement / affectation
    $dernierNeuf = Equipement::where('etat', 'neuf')->latest()->first();
    $dernierBonEtat = Equipement::where('etat', 'bon état')->latest()->first();
    $dernierHorsService = Equipement::where('etat', 'hors service')->latest()->first();

    // Dernière affectation (date max de la table affectations)
    $dernierAffectation = Affectation::latest('created_at')->first();

    return view('admin.dashboard', [
        'equipementsNeufs' => $equipementsNeufs,
        'equipementsBonEtat' => $equipementsBonEtat,
        'equipementsAffectes' => $equipementsAffectes,
        'equipementsHorsService' => $equipementsHorsService,
        'equipementsNonAffectes' => $equipementsNonAffectes,
        'dernierNeufDate' => $dernierNeuf ? $dernierNeuf->created_at->format('d/m') : 'N/A',
        'dernierBonEtatDate' => $dernierBonEtat ? $dernierBonEtat->created_at->format('d/m') : 'N/A',
        'dernierHorsServiceDate' => $dernierHorsService ? $dernierHorsService->created_at->format('d/m') : 'N/A',
        'dernierAffectationDate' => $dernierAffectation ? $dernierAffectation->created_at->format('d/m') : 'N/A',
        'recentEquipements' => Equipement::latest()->take(5)->get(),
        'totalTechniciens' => User::where('role', 'technicien')->count(),
        'totalAffectations' => Affectation::count(),
    ]);
}

    public function indexx()
{
    $user = auth()->user();

    // Récupérer les équipements affectés à l'utilisateur avec la dernière affectation
    $equipements = Equipement::whereHas('affectations', function($query) use ($user) {
        $query->where('user_id', $user->id);
    })
    ->with(['affectations' => function($query) use ($user) {
        // On ne récupère que les affectations pour cet utilisateur, triées par date décroissante
        $query->where('user_id', $user->id)->orderBy('created_at', 'desc');
    }])
    ->get();

    $equipementsAffectes = $equipements->count();

$equipementsAvecProbleme = $equipements->filter(function ($equipement) {
    return $equipement->etat === 'hors service';
})->count();

    return view('technicien.dashboard', compact('equipementsAffectes', 'equipementsAvecProbleme', 'equipements'));
}




}
