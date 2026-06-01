@extends('layouts.app')
@section('title', 'Modificar Obra')
@section('content')

<div style="margin-bottom: 1.5rem;">
    <a href="{{ route('obras.index') }}" style="color: var(--text-muted); text-decoration: none; font-size: 0.9rem;">← Descartar modificaciones</a>
</div>

<div style="background: white; padding: 2.5rem; border-radius: 12px; border: 1px solid var(--border); max-width: 650px; margin: 0 auto; box-shadow: 0 4px 15px rgba(0,0,0,0.02);">
    <h2 style="margin-top: 0; font-size: 1.8rem; margin-bottom: 1.5rem; border-bottom: 1px solid #f0f0f0; padding-bottom: 1rem;">Actualizar Datos Técnicos: {{ $obra->titulo }}</h2>
    
    <form action="{{ route('obras.update', $obra->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label>Título de la Obra</label>
            <input type="text" name="titulo" class="form-control" value="{{ old('titulo', $obra->titulo) }}">
        </div>
        
        <div class="form-group">
            <label>Artista Autor</label>
            <select name="artista_id" class="form-control">
                @foreach($artistas as $art)
                    <option value="{{ $art->id }}" {{ old('artista_id', $obra->artista_id) == $art->id ? 'selected' : '' }}>{{ $art->nombre }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="form-group">
            <label>Técnica Artística</label>
            <input type="text" name="tecnica" class="form-control" value="{{ old('tecnica', $obra->tecnica) }}">
        </div>
        
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
            <div class="form-group">
                <label>Año de Creación</label>
                <input type="number" name="anio" class="form-control" value="{{ old('anio', $obra->anio) }}">
            </div>
            <div class="form-group">
                <label>Precio de Venta (S/.)</label>
                <input type="number" step="0.01" name="precio" class="form-control" value="{{ old('precio', $obra->precio) }}">
            </div>
        </div>
        
        <div style="margin-top: 1.5rem; display: flex; gap: 20px; align-items: center; background: #fafafa; padding: 1rem; border-radius: 6px; border: 1px solid var(--border);">
            <div style="text-align: center;">
                <span style="display: block; font-size: 0.75rem; color: var(--text-muted); margin-bottom: 5px;">Archivo Actual</span>
                @if($obra->imagen)
                    <img src="{{ asset('uploads/obras/'.$obra->imagen) }}" style="width: 90px; height: 70px; object-fit: cover; border-radius: 4px; border: 1px solid #ddd;">
                @else
                    <div style="width: 90px; height: 70px; background: #eee; border-radius:4px; font-size:11px; display:flex; align-items:center; justify-content:center; color:#999;">Sin Imagen</div>
                @endif
            </div>
            <div style="flex: 1;">
                <label style="font-weight: 600; font-size: 0.9rem;">Reemplazar Imagen (Opcional)</label>
                <input type="file" name="imagen" class="form-control" style="border: none; padding: 5px 0;">
                <small style="color: var(--text-muted);">Dejar vacío si deseas mantener la ilustración original.</small>
            </div>
        </div>
        
        <div style="margin-top: 2rem; display: flex; gap: 10px;">
            <button type="submit" class="btn btn-gold" style="flex: 1; padding: 12px;">Guardar Cambios de la Obra</button>
            <a href="{{ route('obras.index') }}" class="btn btn-outline" style="padding: 12px;">Descartar</a>
        </div>
    </form>
</div>

@endsection