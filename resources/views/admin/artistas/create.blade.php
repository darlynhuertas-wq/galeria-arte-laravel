@extends('layouts.app')
@section('title', 'Añadir Artista')
@section('content')

<div style="margin-bottom: 1.5rem;">
    <a href="{{ route('artistas.index') }}" style="color: var(--text-muted); text-decoration: none; font-size: 0.9rem;">← Volver al listado</a>
</div>

<div style="background: white; padding: 2.5rem; border-radius: 12px; border: 1px solid var(--border); max-width: 650px; margin: 0 auto; box-shadow: 0 4px 15px rgba(0,0,0,0.02);">
    <h2 style="margin-top: 0; font-size: 1.8rem; margin-bottom: 1.5rem; border-bottom: 1px solid #f0f0f0; padding-bottom: 1rem;">Inscribir Nuevo Maestro de Arte</h2>
    
    <form action="{{ route('artistas.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Nombre Completo del Autor</label>
            <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" placeholder="Ej. Claude Monet">
        </div>
        
        <div class="form-group">
            <label>Nacionalidad de Origen</label>
            <input type="text" name="nacionalidad" class="form-control" value="{{ old('nacionalidad') }}" placeholder="Ej. Francesa">
        </div>
        
        <div class="form-group">
            <label>Biografía Resumida / Contexto Histórico</label>
            <textarea name="bio" rows="5" class="form-control" placeholder="Escribe los aspectos más relevantes de la trayectoria del artista...">{{ old('bio') }}</textarea>
        </div>
        
        <div style="margin-top: 2rem; display: flex; gap: 10px;">
            <button type="submit" class="btn btn-gold" style="flex: 1; padding: 12px;">Guardar Registro de Artista</button>
            <a href="{{ route('artistas.index') }}" class="btn btn-outline" style="padding: 12px;">Cancelar</a>
        </div>
    </form>
</div>

@endsection