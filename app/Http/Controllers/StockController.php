<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\StocksExport;
use Barryvdh\DomPDF\Facade\Pdf;





class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stocks = Stock::all();
        return view('admin.stocks.index', compact('stocks'));
    }

    
    public function create()
    {
        return view('admin.stocks.create');
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type_equipement' => 'required|string',
            'reference' => 'required|string',
            'configuration' => 'required|string',
            'quantite' => 'required|integer|min:1',
            'date_arrivee' => 'required|date',
        ]);
    
        Stock::create($validated);
    
        return redirect()->route('stocks.index')->with('success', 'Stock ajouté avec succès');
    }
    
   

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    $stock = Stock::findOrFail($id);
    $stock->delete();

    return redirect()->route('stocks.index')->with('success', 'Stock supprimé avec succès.');
}

public function edit($id)
{
    $stock = Stock::findOrFail($id);
    return view('admin.stocks.edit', compact('stock'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'type_equipement' => 'required|string|max:255',
        'reference' => 'required|string|max:255',
        'configuration' => 'required|string',
        'quantite' => 'required|integer|min:0',
        'date_arrivee' => 'required|date',
    ]);

    $stock = Stock::findOrFail($id);
    $stock->update($request->all());

    return redirect()->route('stocks.index')->with('success', 'Stock mis à jour avec succès.');
}

public function exportExcel()
{
    return Excel::download(new StocksExport, 'stocks.xlsx');
}
public function exportPdf()
{
    $stocks = Stock::all();  // Ou ta logique pour récupérer les stocks

    $pdf = Pdf::loadView('admin.stocks.pdf', compact('stocks'));
    return $pdf->download('stocks.pdf');
}





}
