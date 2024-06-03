<?php

namespace App\Http\Controllers\CustomerPanel;

use App\Http\Controllers\Controller;
use App\Models\Formation;
use App\Models\Session;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $formations = Formation::limit(6)->get();
        
        return view('admin.customer.index', [
            'data' => $formations
        ]);
    }

    public function cours()
    {
        // recuperer les formations auxquelles l'utilisateur connecte a souscrit
        $cours = Formation::whereHas("souscrit", function ($q) {
            $q->where("user_id", auth()->user()->id);
        })->get();

        return view('admin.customer.courses', [
            'data' => $cours
        ]);
    }

    public function detail(int $id)
    {
        // Recuperer les informations d'une formation dont l'id est en parametre
        $formation = Formation::findOrFail($id);

        return view('admin.customer.detail', [
            'data' => $formation
        ]);
    }

    public function chapitre(string $cour, int $id)
    {
        // Recupere le contenu de la session $id
        $session = Session::findOrFail($id);

        if ($session->formation['titre'] != $cour) {
            abort(404);
        }

        return view('admin.customer.chapitre', [
            'data' =>  $session
        ]);
    }
}
