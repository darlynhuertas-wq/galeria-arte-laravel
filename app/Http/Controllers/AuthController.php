<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller {
    public function showLogin() {
        if (Auth::check()) {
            return Auth::user()->rol === 'admin' ? redirect()->route('artistas.index') : redirect()->route('galeria.index');
        }
        return view('auth.login');
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'El campo correo electrónico es obligatorio.',
            'email.email' => 'Ingrese una dirección de correo válida.',
            'password.required' => 'El campo contraseña es obligatorio.'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // Escudo de seguridad contra secuestro de sesiones
            
            if (Auth::user()->rol === 'admin') {
                return redirect()->route('dashboard')
                    ->with('success', '¡Bienvenido Administrador!');
            }
            return redirect()->route('galeria.index')->with('success', '¡Sesión iniciada con éxito!');
        }

        return back()->withErrors([
            'email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ])->onlyInput('email');
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'Sesión cerrada correctamente.');
    }
}