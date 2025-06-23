<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Collaborateur;
use Illuminate\Support\Facades\Session;


class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'mail' => 'required|email',
            'mdp' => 'required'
        ]);

        $collaborateur = Collaborateur::where('email', $request['mail'])->first();

        if ($collaborateur && Hash::check($request->mdp, $collaborateur->password)) {
            Session::put('collaborateur_id', $collaborateur->id);
            return view('connect', ['collaborateur' => $collaborateur]);
        } else {
            return back()->withErrors(['email' => 'Identifiants incorrects.']);
        }    
        
    }

    public function logout()
    {
        Session::forget('collaborateur_id');
        return redirect('/')->with('success', 'Déconnexion réussie !');
    }

    public function edit()
    {
        $collaborateur = Collaborateur::findOrFail(Session::get('collaborateur_id'));
        return view('edit', ['collaborateur' => $collaborateur]);
    }

    public function update(Request $request)
    {
        $collaborateur = \App\Models\Collaborateur::findOrFail(\Session::get('collaborateur_id'));

        if ($request->filled('nom')) {
            $collaborateur->nom = $request->nom;
        }
        if ($request->filled('prenom')) {
            $collaborateur->prenom = $request->prenom;
        }
        if ($request->filled('email')) {
            $collaborateur->email = $request->email;
        }
        if ($request->filled('telephone')) {
            $collaborateur->telephone = $request->telephone;
        }
        if ($request->filled('naissance')) {
            $collaborateur->date_naissance = $request->naissance;
        }
        if ($request->filled('adresse')) {
            $collaborateur->adresse = $request->adresse;
        }
        if ($request->filled('ville')) {
            $collaborateur->ville = $request->ville;
        }
        if ($request->filled('photo')) {
            $collaborateur->photo = $request->photo;
        }

        if ($request->filled('mdp') && $request->mdp === $request->mdp_c) {
            $collaborateur->password = bcrypt($request->mdp);
        }

        $collaborateur->save();

        return redirect()->route('edit_collaborateur', ['id' => $collaborateur->id])->with('success', 'Profil mis à jour !');
    }
}
