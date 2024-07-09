<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Depot;
use App\Models\Contribuable;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        if (!Auth::check() || Auth::user()->role != 'user') {
            return redirect()->route('login');
        }

        return view('user.dashboard');
    }

    public function depot()
    {
        if (!Auth::check() || Auth::user()->role != 'user') {
            return redirect()->route('login');
        }

        return view('user.depot');
    }

    public function suivi()
    {
        if (!Auth::check() || Auth::user()->role != 'user') {
            return redirect()->route('login');
        }

        $contribuable = Auth::user();
        $depots = Depot::where('contribuable_id', $contribuable->id)->get();
        return view('user.suivi', compact('depots'));
    }

    public function storeContribuable(Request $request)
    {
        $request->validate([
            'matricule_fiscale' => 'required|unique:contribuables',
            'raison_sociale' => 'required',
            'adresse' => 'required',
            'role' => 'required|in:user,admin',
        ]);

        // Create the new contribuable with a null password
        Contribuable::create([
            'matricule_fiscale' => $request->matricule_fiscale,
            'raison_sociale' => $request->raison_sociale,
            'adresse' => $request->adresse,
            'password' => null,
            'role' => $request->role,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Contribuable added successfully.');
    }
}
