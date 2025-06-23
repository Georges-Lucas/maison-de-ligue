<?php

namespace App\Http\Controllers;
use App\Models\Collaborateur;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class CollaborateurController extends Controller
{
    public function liste(Request $request) {
        $query = Collaborateur::query();

        if ($request->filled('nom')) {
            $query->where(function($q) use ($request) {
                $q->where('nom', 'like', '%' . $request->nom . '%')
                  ->orWhere('prenom', 'like', '%' . $request->nom . '%');
            });
        }
        if ($request->filled('categorie')) {
            $query->where('rôle', 'like', '%' . $request->categorie . '%');
        }

        $collaborateurs = $query->get();
        $collaborateurConnecte = Collaborateur::find(Session::get('collaborateur_id'));

        return view('list', [
            'collaborateurs' => $collaborateurs,
            'collaborateurConnecte' => $collaborateurConnecte
        ]);

 
    }

    public function edit($id)
    {
        $collaborateur = \App\Models\Collaborateur::findOrFail($id);
        return view('modification', ['collaborateur' => $collaborateur]);
    }
    
    public function update(Request $request, $id)
    {
        $collaborateur = \App\Models\Collaborateur::findOrFail($id);

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

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:collaborateurs,email',
            'mdp' => 'required|string|confirmed',
            'telephone' => 'nullable|string|max:20',
            'naissance' => 'nullable|date',
            'adresse' => 'nullable|string|max:255',
            'ville' => 'nullable|string|max:255',
            'photo' => 'nullable|string|max:255',
            'rôle' => 'required|string|max:255',
        ]);

        $collaborateur = new \App\Models\Collaborateur();
        $collaborateur->nom = $request->nom;
        $collaborateur->prenom = $request->prenom;
        $collaborateur->email = $request->email;
        $collaborateur->password = \Hash::make($request->mdp);
        $collaborateur->telephone = $request->telephone;
        $collaborateur->date_naissance = $request->naissance;
        $collaborateur->adresse = $request->adresse;
        $collaborateur->ville = $request->ville;
        $collaborateur->photo = $request->photo;
        $collaborateur->rôle = $request->rôle;
        $collaborateur->is_admin = $request->has('is_admin');
        $collaborateur->save();

        return redirect()->route('store_utilisateur')->with('success', 'Inscription réussie !');
    }

    public function destroy($id)
    {
        $collaborateur = \App\Models\Collaborateur::findOrFail($id);
        $collaborateur->delete();
        return redirect()->route('liste_utilisateur')->with('success', 'Collaborateur supprimé !');
    }
}
