<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Depot;
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
}
