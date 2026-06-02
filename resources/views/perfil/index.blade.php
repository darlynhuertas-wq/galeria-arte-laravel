@extends('layouts.app')
@section('title', 'Mi Perfil')

@section('content')

<div class="page-title-row" style="margin-bottom:2rem">
    <div>
        <h2 class="page-title">Mi <em style="font-style:italic;font-weight:400">Perfil</em></h2>
        <p class="page-subtitle">Gestiona tu información personal y seguridad.</p>
    </div>
</div>

<div style="display:grid;grid-template-columns:300px 1fr;gap:28px;align-items:start">

    {{-- Avatar card --}}
    <div class="perfil-card">
        <div class="perfil-header">
            <div class="perfil-avatar">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
            <div class="perfil-name">{{ $user->name }}</div>
            <span class="perfil-role">{{ $user->rol ?? 'Usuario' }}</span>
        </div>
        <div class="perfil-body">
            <div style="font-size:0.72rem;color:var(--text-3);text-transform:uppercase;letter-spacing:1px;font-family:'DM Mono',monospace;margin-bottom:4px">Correo electrónico</div>
            <div style="font-size:0.9rem;color:var(--text);font-weight:500;word-break:break-all">{{ $user->email }}</div>

            <div style="height:1px;background:var(--border);margin:18px 0"></div>

            <div style="font-size:0.72rem;color:var(--text-3);text-transform:uppercase;letter-spacing:1px;font-family:'DM Mono',monospace;margin-bottom:4px">Miembro desde</div>
            <div style="font-size:0.9rem;color:var(--text);font-weight:500">{{ $user->created_at ? $user->created_at->format('d/m/Y') : '—' }}</div>
        </div>
    </div>

    {{-- Formularios --}}
    <div style="display:flex;flex-direction:column;gap:24px">

        {{-- Datos personales --}}
        <div class="panel">
            <div class="panel-header">
                <div>
                    <div class="panel-title">Datos Personales</div>
                    <div class="panel-subtitle">Actualiza tu nombre de perfil</div>
                </div>
            </div>
            <div style="padding:28px 32px">
                <form action="{{ route('perfil.nombre') }}" method="POST">
                    @csrf @method('PUT')
                    <div class="form-group">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}">
                        @error('name')<span class="error-msg">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Correo (no modificable)</label>
                        <input type="text" class="form-control" value="{{ $user->email }}" disabled>
                    </div>
                    <button type="submit" class="btn btn-gold">Guardar nombre</button>
                </form>
            </div>
        </div>

        {{-- Cambiar contraseña --}}
        <div class="panel">
            <div class="panel-header">
                <div>
                    <div class="panel-title">Cambiar Contraseña</div>
                    <div class="panel-subtitle">Mínimo 8 caracteres</div>
                </div>
            </div>
            <div style="padding:28px 32px">
                <form action="{{ route('perfil.password') }}" method="POST">
                    @csrf @method('PUT')
                    <div class="form-group">
                        <label class="form-label">Contraseña actual</label>
                        <input type="password" name="current_password" class="form-control">
                        @error('current_password')<span class="error-msg">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Nueva contraseña</label>
                        <input type="password" name="new_password" class="form-control">
                        @error('new_password')<span class="error-msg">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Confirmar nueva contraseña</label>
                        <input type="password" name="new_password_confirmation" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-navy">Cambiar contraseña</button>
                </form>
            </div>
        </div>

    </div>
</div>

@endsection