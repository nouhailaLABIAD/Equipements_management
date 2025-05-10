<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Affectation;
use App\Models\Equipement;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::all();
        return view('technicien.members.index', compact('members'));
    }

    /**
     * Afficher le formulaire pour ajouter un membre.
     */
    public function create()
    {
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

        Member::create($request->all());

        return redirect()->route('members.index')->with('success', 'Membre ajouté avec succès.');
    }

    /**
     * Afficher le formulaire d'édition pour un membre.
     */
    public function edit($id)
    {
        $member = Member::findOrFail($id);
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
