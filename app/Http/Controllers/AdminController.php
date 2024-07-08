<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Contribuable;

class AdminController extends Controller
{
    public function index()
    {
        if (!Auth::check() || Auth::user()->role != 'admin') {
            return redirect()->route('login');
        }
        $contribuables = Contribuable::where('role', 'user')->get();
        $contribuables = $contribuables->sortByDesc(function ($contribuable) {
            return $contribuable->depots->where('situation', 'en cours')->count();
        });

        return view('admin.dashboard', compact('contribuables'));

    }
    public function showContribuableDepots($id)
    {
        // Fetch the specific contribuable
        $contribuable = Contribuable::findOrFail($id);

        // Fetch and sort depots, with "en cours" depots first
        $depots = $contribuable->depots->sortByDesc(function ($depot) {
            return $depot->situation === 'en cours';
        });

        return view('admin.contribuable_depots', compact('contribuable', 'depots'));
    }
}
