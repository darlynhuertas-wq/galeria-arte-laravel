<?php

namespace App\Http\Controllers;

use App\Models\Artista;
use Illuminate\Http\Request;

class ArtistaController extends Controller {
    public function index() {
        $artistas = Artista::all();
        return view('admin.artistas.index', compact('artistas'));
    }

    public function create() {
        return view('admin.artistas.create');
    }

    public function store(Request $request) {
        $request->validate([
            'nombre' => 'required|min:3|max:100',
            'nacionalidad' => 'required',
            'bio' => 'required|min:10',
        ], [
            'nombre.required' => 'El nombre del artista es obligatorio.',
            'nombre.min' => 'El nombre debe tener al menos 3 caracteres.',
            'bio.required' => 'La biografía es obligatoria.',
            'bio.min' => 'La biografía debe contener al menos 10 caracteres.'
        ]);

        Artista::create($request->all());
        return redirect()->route('artistas.index')->with('success', 'Artista registrado exitosamente.');
    }

    public function edit(Artista$artista) {
        return view('admin.artistas.edit', compact('artista'));
    }

    public function update(Request $request, Artista $artista) {
        $request->validate([
            'nombre' => 'required|min:3|max:100',
            'nacionalidad' => 'required',
            'bio' => 'required|min:10',
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'bio.required' => 'La biografía es obligatoria.'
        ]);

        $artista->update($request->all());
        return redirect()->route('artistas.index')->with('success', 'Artista actualizado exitosamente.');
    }

    public function destroy(Artista $artista) {
        $artista->delete();
        return redirect()->route('artistas.index')->with('success', 'Artista eliminado correctamente.');
    }
}