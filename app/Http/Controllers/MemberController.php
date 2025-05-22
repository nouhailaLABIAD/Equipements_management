<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Affectation;
use App\Models\Equipement;
use App\Helpers\ActivityLogger;

class MemberController extends Controller
{
    public function index()
{
    ActivityLogger::log('Consultation des membres', request()->path());

    $search = request('search');

    $members = Member::when($search, function ($query, $search) {
        $query->where(function ($q) use ($search) {
            $q->where('nom', 'like', "%{$search}%")
              ->orWhere('prenom', 'like', "%{$search}%")
              ->orWhere('matricule', 'like', "%{$search}%");
        });
    })->get();

    return view('technicien.members.index', compact('members'));
}


    /**
     * Afficher le formulaire pour ajouter un membre.
     */
    public function create()
    {
        ActivityLogger::log('Appel du fomulaire de création d\'un memebre ', request()->path());
        return view('technicien.members.create');
    }

    /**
     * Enregistrer un nouveau membre.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'matricule' => 'required|unique:members',
            'centre' => 'required',
        ]);
        ActivityLogger::log('Création d\'un nouveau  membre', request()->path());

        Member::create($request->all());

        return redirect()->route('members.index')->with('success', 'Membre ajouté avec succès.');
    }

    /**
     * Afficher le formulaire d'édition pour un membre.
     */
    public function edit($id)
    {
        $member = Member::findOrFail($id);
        ActivityLogger::log('Appel du fomulaire d\'éditon d\'un memebre', request()->path());
        return view('technicien.members.edit', compact('member'));
    }

    /**
     * Mettre à jour un membre existant.
     */
    public function update(Request $request, $id)
    {
        $member = Member::findOrFail($id);
    
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'matricule' => 'required|unique:members,matricule,' . $member->id,
            'centre' => 'required',
        ]);
        ActivityLogger::log('Edition d\'un memebre', request()->path());

        $member->update($request->all());
    
        return redirect()->route('members.index')->with('success', 'Membre modifié avec succès.');
    }
    

    /**
     * Supprimer un membre.
     */
    public function destroy($id)
    {
        $member = Member::findOrFail($id);
        $member->delete();
        ActivityLogger::log('Suppression d\'un memebre', request()->path());
        return redirect()->route('members.index')->with('success', 'Membre supprimé avec succès.');
    }


public function equipements($id)
{
    $member = Member::findOrFail($id);

    // Récupère les ID des équipements dont la dernière affectation est pour ce membre
    $equipementIds = Affectation::select('equipement_id')
        ->whereIn('id', function ($query) {
            $query->selectRaw('MAX(id)')
                ->from('affectations')
                ->groupBy('equipement_id');
        })
        ->where('member_id', $id)
        ->pluck('equipement_id');

    // Charger les équipements correspondant à ces IDs et dont l’état est "Affecté"
    $equipements = Equipement::whereIn('id', $equipementIds)
        ->where('etat', 'Affecté')
        ->get();

    return view('technicien.members.equipements', compact('member', 'equipements'));
}


}
