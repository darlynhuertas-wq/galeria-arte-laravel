<?php

namespace App\Http\Controllers;

use App\Models\Artista;
use App\Models\Obra;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalArtistas = Artista::count();
        $totalObras = Obra::count();
        $totalUsuarios = User::count();

        return view('admin.dashboard', compact(
            'totalArtistas',
            'totalObras',
            'totalUsuarios'
        ));
    }
}