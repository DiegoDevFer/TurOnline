<?php

namespace TurOnline\Http\Controllers;

use Illuminate\Http\Request;

class PontoTuristicoController extends Controller
{
    public function index(){
        return view('admin.pt_turistico.pt_index');
    }

    public function create(){
        return view('admin.pt_turistico.pt_create');
    }

    public function store(){
        return "Você está em store: aguarde! funcionalidade em desenvolvimento";
    }
}
