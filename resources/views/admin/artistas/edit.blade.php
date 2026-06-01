@extends('layouts.app')
@section('title', 'Modificar Artista')
@section('content')

<div style="margin-bottom: 1.5rem;">
    <a href="{{ route('artistas.index') }}" style="color: var(--text-muted); text-decoration: none; font-size: 0.9rem;">← Cancelar operación</a>
</div>

<div style="background: white; padding: 2.5rem; border-radius: 12px; border: 1px solid var(--border); max-width: 650px; margin: 0 auto; box-shadow: 0 4px 15px rgba(0,0,0,0.02);">
    <h2 style="margin-top: 0; font-size: 1.8rem; margin-bottom: 1.5rem; border-bottom: 1px solid #f0f0f0; padding-bottom: 1rem;">Actualizar Ficha de: {{ $artista->nombre }}</h2>
    
    <form action="{{ route('artistas.update', $artista->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label>Nombre del Autor</label>
            <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $artista->nombre) }}">
        </div>
        
        <div class="form-group">
            <label>Nacionalidad</label>
            <input type="text" name="nacionalidad" class="form-control" value="{{ old('nacionalidad', $artista->nacionalidad) }}">
        </div>
        
        <div class="form-group">
            <label>Biografía Curatorial</label>
            <textarea name="bio" rows="5" class="form-control">{{ old('bio', $artista->bio) }}</textarea>
        </div>
        
        <div style="margin-top: 2rem; display: flex; gap: 10px;">
            <button type="submit" class="btn btn-gold" style="flex: 1; padding: 12px;">Guardar Cambios del Artista</button>
            <a href="{{ route('artistas.index') }}" class="btn btn-outline" style="padding: 12px;">Descartar</a>
        </div>
    </form>
</div>

@endsection