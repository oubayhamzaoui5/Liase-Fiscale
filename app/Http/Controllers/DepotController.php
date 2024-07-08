<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Depot;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Contribuable;

class DepotController extends Controller
{
    public function store(Request $request)
    {
        Log::info('Store function called.');

        $validatedData = $request->validate([
            'declarationType' => 'required|string',
            'exercice' => 'required|string',
            'natureType' => 'required|string',
            'type' => 'required|string',
        ]);

        Log::info('Validation passed.', ['validatedData' => $validatedData]);

        $contribuable = Auth::user();

        $depot = new Depot();
        $depot->contribuable_id = $contribuable->id;
        $depot->declaration_type = $request->declarationType;
        $depot->exercice = $request->exercice;
        $depot->nature = $request->natureType;
        $depot->type = $request->type;
        $depot->situation = 'en cours';

        $files = [
            'bilan_actif' => 'xml',
            'bilan_passif' => 'xml',
            'etat_resultat' => 'xml',
            'flux_tresorerie' => 'xml',
            'resultat_fiscal_partiel' => 'xml',
            'faits_marquants' => 'xml',
            'autres_feuilles' => 'pdf'
        ];

        foreach ($files as $file => $ext) {
            if ($request->hasFile($file)) {
                $extension = $request->file($file)->getClientOriginalExtension();
                if ($extension !== $ext) {
                    return redirect()->back()->withErrors([$file => "The $file must be a file of type: $ext."])->withInput();
                }

                $fileName = date('Ymd_His') . '_' . $file . '_' . $contribuable->name . '.' . $extension;
                $path = $request->file($file)->storeAs('public/files', $fileName);
                $depot->$file = 'storage/files/' . $fileName;
            }
        }

        // Log the data before saving
        Log::info('Depot data: ', $depot->toArray());

        // Attempt to save the depot
        if ($depot->save()) {
            Log::info('Depot saved successfully.');
            return redirect()->back()->with('success', 'Dépôt bien envoyé .');
        } else {
            Log::error('Failed to save depot.');
            return redirect()->back()->with('error', 'Echec à l envoi de dépôt.');
        }
    }

    public function destroy($id)
    {
        $depot = Depot::findOrFail($id);

        // Delete the file from storage
        foreach (['bilan_actif', 'bilan_passif', 'etat_resultat', 'flux_tresorerie', 'resultat_fiscal_partiel', 'faits_marquants', 'autres_feuilles'] as $fileField) {
            if ($depot->$fileField) {
                \Storage::delete($depot->$fileField);
            }
        }

        $depot->delete();

        return redirect()->back();
    }

    public function show($id)
    {
        $depot = Depot::findOrFail($id);
        $contribuable = Contribuable::findOrFail($depot->contribuable_id);

        return view('admin.depot_details', compact('depot', 'contribuable'));
    }

    public function approve(Request $request, $id)
    {
        $request->validate([
            'reception' => 'required|file|mimes:pdf',
        ]);

        $depot = Depot::findOrFail($id);

        if ($request->hasFile('reception')) {
            $file = $request->file('reception');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('files/reception', $filename, 'public');

            $depot->reception = 'storage/' . $path;
        }

        $depot->situation = 'validée';
        $depot->save();

        return redirect()->back()->with('success', 'Depot approved successfully.');
    }

    public function decline($id)
    {
        $depot = Depot::findOrFail($id);
        $depot->situation = 'refusée';
        $depot->save();

        return redirect()->back()->with('success', 'Depot declined successfully.');
    }
}
