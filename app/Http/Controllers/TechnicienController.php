<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class TechnicienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $query = User::where('role', 'technicien');

    if ($search = $request->input('search')) {
        $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%");
        });
    }

    $techniciens = $query->get(); // Ou ->paginate(10) si tu veux paginer

    return view('admin.techniciens.index', compact('techniciens'));
}


    public function create()
    {
        return view('admin.techniciens.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'technicien',
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('techniciens.index')->with('success', 'Technicien ajouté avec succès.');
    }

    public function edit($id)
    {
        $technicien = User::findOrFail($id);
        return view('admin.techniciens.edit', compact('technicien'));
    }

    public function update(Request $request, $id)
    {
        $technicien = User::findOrFail($id);
    
        // Validation des champs
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $technicien->id,
            'password' => 'nullable|min:6', // Le mot de passe est optionnel lors de la modification
        ]);
    
        // Préparation des données de mise à jour
        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
        ];
    
        // Si un mot de passe est fourni, on le hash et on l'ajoute à la mise à jour
        if ($request->filled('password')) {
            $updateData['password'] = bcrypt($request->password);
        }
    
        // Mise à jour des données de l'utilisateur
        $technicien->update($updateData);
    
        // Retour à la liste des techniciens avec un message de succès
        return redirect()->route('techniciens.index')->with('success', 'Technicien modifié avec succès.');
    }
    

    public function destroy($id)
    {
        $technicien = User::findOrFail($id);
        $technicien->delete();

        return redirect()->route('techniciens.index')->with('success', 'Technicien supprimé avec succès.');
    }
}
