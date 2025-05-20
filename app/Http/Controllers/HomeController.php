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
    return view('admin.dashboard', [
        'equipementsNeufs' => Equipement::where('etat', 'neuf')->count(),
        'equipementsBonEtat' => Equipement::where('etat', 'bon état')->count(),
        'equipementsAffectes' => Equipement::where('etat', 'affecté')->count(),
        'equipementsHorsService' => Equipement::where('etat', 'hors service')->count(),
        'equipementsNonAffectes' => Equipement::where('etat', 'non affecté')->count(),
        'recentEquipements' => Equipement::latest()->take(5)->get(),
        'totalTechniciens' => User::where('role', 'technicien')->count(),
        'totalAffectations' => Affectation::count(),
    ]);
}

    public function indexx()
{
    $user = auth()->user();

    // Par exemple, considérer "hors service" et "à réparer" comme problèmes
    $equipementsAffectes = Equipement::where('id', $user->id)->count();
    $equipementsAvecProbleme = Equipement::where('id', $user->id)
        ->whereIn('etat', ['hors service'])
        ->count();

    $equipements = Equipement::where('id', $user->id)->get();

    return view('technicien.dashboard', compact('equipementsAffectes', 'equipementsAvecProbleme', 'equipements'));
}


}
