@extends('layouts.app')
@section('content')
<h2>Configuración de Mi Perfil de Usuario</h2>
<div style="display:grid; grid-template-columns: 1fr 1fr; gap:30px; margin-top:2rem;">
    <div style="background:white; padding:2rem; border-radius:8px; box-shadow:0 2px 5px rgba(0,0,0,0.1);">
        <h3>Actualizar Datos Personales</h3>
        <form action="{{ route('perfil.nombre') }}" method="POST">
            @csrf @method('PUT')
            <div class="form-group">
                <label>Nombre de Usuario</label>
                <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                @error('name') <span style="color:var(--accent);">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label>Correo Electrónico (No modificable)</label>
                <input type="text" class="form-control" value="{{ $user->email }}" disabled style="background:#f2f2f2;">
            </div>
            <button type="submit" class="btn btn-primary">Actualizar Nombre</button>
        </form>
    </div>

    <div style="background:white; padding:2rem; border-radius:8px; box-shadow:0 2px 5px rgba(0,0,0,0.1);">
        <h3>Seguridad de la Cuenta</h3>
        <form action="{{ route('perfil.password') }}" method="POST">
            @csrf @method('PUT')
            <div class="form-group">
                <label>Contraseña Actual</label>
                <input type="password" name="current_password" class="form-control">
                @error('current_password') <span style="color:var(--accent);">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label>Nueva Contraseña (Mínimo 8 caracteres)</label>
                <input type="password" name="new_password" class="form-control">
                @error('new_password') <span style="color:var(--accent);">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label>Confirmar Nueva Contraseña</label>
                <input type="password" name="new_password_confirmation" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Cambiar mi Contraseña</button>
        </form>
    </div>
</div>
@endsection