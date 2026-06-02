<?php

namespace App\Http\Controllers;

use App\Models\Obra;
use App\Models\Artista;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ObraController extends Controller {
    public function index() {
        // Eager Loading para evitar el problema de consultas N+1
        $obras = Obra::with('artista')->get(); 
        return view('admin.obras.index', compact('obras'));
    }

    public function create() {
        $artistas = Artista::all();
        return view('admin.obras.create', compact('artistas'));
    }

    public function store(Request $request) {
        $request->validate([
            'titulo' => 'required|min:2',
            'tecnica' => 'required',
            'anio' => 'required|numeric|min:0|max:'.date('Y'),
            'precio' => 'required|numeric|min:0',
            'artista_id' => 'required|exists:artistas,id',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ], [
            'titulo.required' => 'El título de la obra es requerido.',
            'anio.numeric' => 'El año debe ser un número válido.',
            'precio.numeric' => 'El precio debe ser un número válido.',
            'imagen.image' => 'El archivo seleccionado debe ser una imagen válida.'
        ]);

        $data = $request->all();

        if ($request->hasFile('imagen')) {
            $image = $request->file('imagen');
            $imageName = time() . '_' . $image->getClientOriginalName();
            // Guardar directamente en la carpeta pública del servidor
            $image->move(public_path('uploads/obras'), $imageName);
            $data['imagen'] = $imageName;
        }

        Obra::create($data);
        return redirect()->route('obras.index')->with('success', 'Obra de arte guardada exitosamente.');
    }

    public function edit(Obra $obra) {
        $artistas = Artista::all();
        return view('admin.obras.edit', compact('obra', 'artistas'));
    }

    public function update(Request $request, Obra $obra) {
        $request->validate([
            'titulo' => 'required|min:2',
            'tecnica' => 'required',
            'anio' => 'required|numeric',
            'precio' => 'required|numeric',
            'artista_id' => 'required|exists:artistas,id',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('imagen')) {
            // Eliminar imagen física anterior si existía
            if ($obra->imagen && File::exists(public_path('uploads/obras/' . $obra->imagen))) {
                File::delete(public_path('uploads/obras/' . $obra->imagen));
            }

            $image = $request->file('imagen');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/obras'), $imageName);
            $data['imagen'] = $imageName;
        }

        $obra->update($data);
        return redirect()->route('obras.index')->with('success', 'Obra modificada con éxito.');
    }

    public function destroy(Obra $obra) {
        if ($obra->imagen && File::exists(public_path('uploads/obras/' . $obra->imagen))) {
            File::delete(public_path('uploads/obras/' . $obra->imagen));
        }
        $obra->delete();
        return redirect()->route('obras.index')->with('success', 'Obra eliminada permanentemente.');
    }
    public function show($id)
    {
        $obra = \App\Models\Obra::with('artista')->findOrFail($id);

        return view('admin.obras.show', compact('obra'));
    }
}