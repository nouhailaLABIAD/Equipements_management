<?php

namespace App\Http\Controllers;

use App\Models\Equipement;
use App\Models\Stock;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EquipementsExport;
use App\Imports\EquipementsImport;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Helpers\ActivityLogger;
use Illuminate\Support\Facades\Log;

class EquipementController extends Controller
{
    // Afficher tous les équipements
    public function index()
    {
        // Récupérer tous les équipements
        $equipements = Equipement::all();

        // Passer les équipements à la vue Blade
        return view('admin.equipements.index', compact('equipements'));
    }
 
    public function create()
    {
        $stocks = Stock::all();  // Récupérer tous les stocks disponibles
        return view('admin.equipements.create', compact('stocks'));  // Passer les stocks à la vue
    }

    // Créer un nouvel équipement
    public function store(Request $request)
    {
    // Validation des données entrées
    $request->validate([
        'marque' => 'required|string|max:255',
        'reference' => 'required|string|max:255',
        'configuration' => 'required|string',
        'date_acquisition' => 'required|date',
        'etat' => 'required|in:neuf,bon état,Affecté,Non affecté,hors service', // Validation selon l'énumération
        'stock_id' => 'required|exists:stocks,id', // Assurer que le stock existe
    ]);

    // Création de l'équipement avec les données validées
    Equipement::create($request->all());

    // Redirection vers la page d'affichage des équipements avec un message de succès
    return redirect()->route('equipements.index')->with('success', 'Équipement ajouté avec succès');
    }

    // Afficher un équipement spécifique
    public function show($id)
    {
        $equipement = Equipement::findOrFail($id);
        return response()->json($equipement);
    }

    // Mettre à jour un équipement
    public function update(Request $request, $id)
    {
        $request->validate([
            'marque' => 'required|string|max:255',
            'reference' => 'required|string|max:255',
            'configuration' => 'required|string',
            'date_acquisition' => 'required|date',
            'etat' => 'required|string|max:255',
            'stock_id' => 'required|exists:stocks,id', // Assurer que le stock existe
        ]);

        $equipement = Equipement::findOrFail($id);
        $equipement->update($request->all());
        return redirect()->route('equipements.index')->with('success', 'Équipement mis à jour avec succès');
    }

        // Supprimer un équipement
        public function destroy($id)
        {
            $equipement = Equipement::findOrFail($id);
            $equipement->delete();
            return redirect()->route('equipements.index')->with('success', 'Équipement supprimé avec succès');
        }
        public function edit($id)
        {
            $equipement = Equipement::findOrFail($id);
            $stocks = Stock::all(); // Pour le select des stocks
            return view('admin.equipements.edit', compact('equipement', 'stocks'));
        }
        public function exportExcel()
        {
            return Excel::download(new EquipementsExport, 'equipements.xlsx');
        }

        public function exportPdf()
        {
            $equipements = Equipement::with('stock')->get(); // relation stock chargée
            $pdf = Pdf::loadView('admin.equipements.pdf', compact('equipements'));
            return $pdf->download('equipements.pdf');
        }

        // Afficher le formulaire
        public function editEtat($id)
        {
            ActivityLogger::log('Appel du formulaire d\édition d\état d\'un equipement', request()->path());
            $equipement = Equipement::findOrFail($id);
            return view('technicien.members.edit-etat', compact('equipement'));
        }

    // Enregistrer les modifications
        public function updateEtat(Request $request, $id)
        {
            $request->validate([
                'etat' => 'required|in:neuf,bon état,Affecté,Non affecté,hors service',
            ]);

            $equipement = Equipement::findOrFail($id);
            $equipement->etat = $request->etat;
            $equipement->save();
            ActivityLogger::log('Edition d\état d\'un equipement', request()->path());
            return redirect()->back()->with('success', 'État mis à jour avec succès.');
        }
        public function historique($id)
        {
            $equipement = Equipement::with(['affectations.member', 'affectations.user'])->findOrFail($id);
            return view('admin.historiques.index', compact('equipement'));
        }
    public function importExcel(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|file|mimes:xlsx,xls'
        ]);

        Log::info('Début import Excel');

        Excel::import(new EquipementsImport, $request->file('excel_file'));

        Log::info('Fin import Excel');

        return redirect()->route('equipements.index')->with('success', 'Fichier importé avec succès.');
    }

}
