<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Collaborateur;

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
            return view('connect', ['collaborateur' => $collaborateur]);
        } else {
            return back()->withErrors(['email' => 'Identifiants incorrects.']);
        }    
        
    }
}
