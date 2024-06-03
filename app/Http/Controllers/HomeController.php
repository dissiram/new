<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Categorie;
use App\Models\Formation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        
        $formations = Formation::all();
        $categories = Categorie::limit(4)->get();

        return view("public.index", [
            'data' => $formations,
            'categories' => $categories
        ]);
    }

    public function cours()
    {
        $formations = Formation::all();
        $categories = Categorie::limit(4)->get();

        return view('public.cours', [
            'data' => $formations,
            'categories' => $categories
        ]);
    }

    public function detail(int  $id)
    {
        // On récupère la formation correspondant à l'ID passé en paramètre
        $cours = Formation::findOrFail($id);

        // On affiche la vue "detail" avec les données de la formation
        return view('public.detail', [
            'data' => $cours
        ]);
    }

    public function contact()
    {
        return view('public.contact');
    }

    public function souscrire(int  $id)
    {
        $formation = Formation::findOrFail($id);
        $student = Auth::user();

        $formation->souscrit()->attach($student);
        return redirect()->route('mes_cours')->with('success', 'Vous avez bien souscrit à cette formation');
    }
}
