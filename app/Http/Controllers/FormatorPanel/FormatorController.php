<?php

namespace App\Http\Controllers\FormatorPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FormatorController extends Controller
{
    public function index (){
        return view('formateur.dashboard');
    }
}
