@extends('layouts.app')
@section('title', 'Catalogar Pieza de Arte')
@section('content')

<div class="form-card">
    <h3 style="margin-top:0; font-family: 'Playfair Display', serif; font-size: 1.8rem; border-bottom: 1px solid var(--border); padding-bottom: 0.8rem;">Inscripción de Pieza Maestra</h3>
    
    <form action="{{ route('obras.store') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label>Título de la Obra de Arte</label>
            <input type="text" name="titulo" class="form-control" placeholder="Ej: Impresión, sol naciente" required>
        </div>

        <div class="form-group">
            <label>Maestro Creador (Artista)</label>
            <select name="artista_id" class="form-control" required>
                <option value="">-- Seleccione un autor avalado --</option>
                @foreach($artistas as $art)
                    <option value="{{ $art->id }}">{{ $art->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Técnica de Elaboración</label>
            <input type="text" name="tecnica" class="form-control" placeholder="Ej: Óleo sobre lienzo / Escultura de Mármol" required>
        </div>

        <div class="form-group">
            <label>Año de Creación</label>
            <input type="number" name="anio" class="form-control" placeholder="Ej: 1872" required>
        </div>

        <div class="form-group">
            <label>Valor Monetario de Tasación (S/.)</label>
            <input type="number" step="0.01" name="precio" class="form-control" placeholder="0.00" required>
        </div>

        <div class="form-group">
            <label>Archivo Estático de Ilustración (.jpg)</label>
            <input type="text" name="imagen" class="form-control" placeholder="Ej: sol_naciente.jpg" required>
            <small style="color: var(--text-muted); font-size: 0.78rem;">Debe estar alojado previamente en la carpeta pública del banco de imágenes.</small>
        </div>

        <div style="display: flex; gap: 12px; margin-top: 2rem;">
            <button type="submit" class="btn btn-gold" style="flex:1; justify-content:center;">Archivar Registro Oficial</button>
            <a href="{{ route('obras.index') }}" class="btn btn-outline">Cancelar</a>
        </div>
    </form>
</div>
@endsection