<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view("public.index");
    }

    public function cours()
    {
        return view('public.cours');
    }

    public function contact()
    {
        return view('public.contact');
    }
}
