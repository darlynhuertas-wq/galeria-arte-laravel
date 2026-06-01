<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PerfilController extends Controller {
    public function index() {
        return view('perfil.index', ['user' => Auth::user()]);
    }

    public function updateNombre(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
        ], ['name.required' => 'El nombre no puede quedar vacío.']);

        $user = Auth::user();
        $user->name = $request->name;
        $user->save();

        return back()->with('success', 'Nombre de perfil actualizado con éxito.');
    }

    public function updatePassword(Request $request) {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ], [
            'current_password.required' => 'Debe ingresar su contraseña actual.',
            'new_password.required' => 'Debe ingresar una nueva contraseña.',
            'new_password.min' => 'La nueva contraseña debe tener al menos 8 caracteres.',
            'new_password.confirmed' => 'La confirmación de la nueva contraseña no coincide.'
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'La contraseña actual no es correcta.']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Contraseña modificada correctamente.');
    }
}