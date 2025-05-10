<?php

namespace App\Http\Controllers;
use App\Models\Equipement;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\HistoriqueExport;
use Illuminate\Http\Request;

class HistoriqueController extends Controller
{
    public function exportPdf($id)
{
    $equipement = Equipement::with('affectations.member', 'affectations.user')->findOrFail($id);
    $pdf = Pdf::loadView('admin.historiques.pdf', compact('equipement'));
    return $pdf->download('historique_equipement_'.$id.'.pdf');
}

public function exportExcel($id)
{
    return Excel::download(new HistoriqueExport($id), 'historique_equipement_'.$id.'.xlsx');
}
}
