<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Contribuable;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('matricule_fiscale', 'password');

        $contribuable = Contribuable::where('matricule_fiscale', $credentials['matricule_fiscale'])->first();

        if ($contribuable && is_null($contribuable->password)) {
            // If password is null, set it for the first time
            $contribuable->password = Hash::make($request->password);
            $contribuable->save();

            Auth::login($contribuable);

            return redirect()->route('user.dashboard')->with('success', 'Password set successfully.');
        }



        if ($contribuable && Hash::check($credentials['password'], $contribuable->password)) {
            Auth::login($contribuable);
            if ($contribuable->role == 'admin') {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('user.dashboard');
            }
        }

        return back()->withErrors([
            'matricule_fiscale' => 'Les informations d identification sont invalides.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }
}
