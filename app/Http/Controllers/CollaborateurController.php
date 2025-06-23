<?php

namespace App\Http\Controllers;
use App\Models\Collaborateur;

use Illuminate\Http\Request;

class CollaborateurController extends Controller
{
    public function liste(){
        $collaborateurs = Collaborateur::all();
        return view('list', ['collaborateurs' => $collaborateurs]);
    }
}
