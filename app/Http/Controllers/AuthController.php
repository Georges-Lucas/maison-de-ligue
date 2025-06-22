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
    public function edit()
    {
        $collaborateur = Collaborateur::findOrFail(Session::get('collaborateur_id'));
        return view('edit', ['collaborateur' => $collaborateur]);
    }
}
