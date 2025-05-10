<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipement;
use App\Models\Member;
use Illuminate\Support\Facades\Auth;
use App\Models\Affectation;
use App\Models\User;

class AffectationController extends Controller
{
    public function index()
    {
        // On récupère les équipements non affectés
        $equipements = Equipement::whereNotIn('etat', ['Affecté', 'hors service'])->get();

        return view('technicien.affectations.index', compact('equipements'));
    }
    public function create($equipement_id)
{
    $equipement = Equipement::findOrFail($equipement_id);
    $members = Member::all();
    $techniciens = User::where('role', 'technicien')->get(); 
    return view('technicien.affectations.create', compact('equipement', 'members', 'techniciens'));
}


public function store(Request $request)
{
    $request->validate([
        'equipement_id' => 'required|exists:equipements,id',
        'member_id' => 'required|exists:members,id',
        'date_affectation' => 'required|date',
    ]);

    // Création de l'affectation
    Affectation::create([
        'equipement_id' => $request->equipement_id,
        'member_id' => $request->member_id,
        'user_id' => Auth::id(),
        'date_affectation' => $request->date_affectation,
    ]);

    // Mettre à jour l'état de l'équipement en 'Affecté'
    $equipement = Equipement::find($request->equipement_id);
    if ($equipement) {
        $equipement->update(['etat' => 'Affecté']);
    } else {
        return back()->with('error', 'Équipement non trouvé.');
    }

    return redirect()->route('historiques.index')->with('success', 'Équipement affecté avec succès.');
}

}
