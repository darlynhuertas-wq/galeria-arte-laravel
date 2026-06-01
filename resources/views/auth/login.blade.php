@extends('layouts.app')
@section('title', 'Iniciar Sesión')
@section('content')
<div style="max-width: 450px; margin: 5rem auto; background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.15);">
    <h2 style="text-align: center; margin-top:0;">Iniciar Sesión</h2>
    <form action="{{ route('login.procesar') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Correo Electrónico</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}">
            @error('email') <span style="color:var(--accent); font-size:14px;">{{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label>Contraseña</label>
            <input type="password" name="password" class="form-control">
            @error('password') <span style="color:var(--accent); font-size:14px;">{{ $message }}</span> @enderror
        </div>
        <button type="submit" class="btn btn-primary" style="width: 100%; padding: 10px; margin-top: 1rem;">Ingresar al Sistema</button>
    </form>
</div>
@endsection