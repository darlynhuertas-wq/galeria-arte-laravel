@extends('layouts.app')
@section('title', 'Nueva Obra')

@section('content')

<a href="{{ route('obras.index') }}" class="back-link">← Volver al catálogo</a>

<div class="form-panel">
    <h2 class="form-panel-title">Registrar nueva <em style="font-style:italic;font-weight:400">obra</em></h2>

    <form action="{{ route('obras.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label class="form-label">Título de la obra</label>
            <input type="text" name="titulo" class="form-control"
                   value="{{ old('titulo') }}" placeholder="Ej: Impresión, sol naciente">
            @error('titulo')<span class="error-msg">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
            <label class="form-label">Artista autor</label>
            <select name="artista_id" class="form-control">
                <option value="">— Seleccione un artista —</option>
                @foreach($artistas as $art)
                    <option value="{{ $art->id }}" {{ old('artista_id') == $art->id ? 'selected' : '' }}>
                        {{ $art->nombre }}
                    </option>
                @endforeach
            </select>
            @error('artista_id')<span class="error-msg">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
            <label class="form-label">Técnica de elaboración</label>
            <input type="text" name="tecnica" class="form-control"
                   value="{{ old('tecnica') }}" placeholder="Ej: Óleo sobre lienzo">
            @error('tecnica')<span class="error-msg">{{ $message }}</span>@enderror
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px">
            <div class="form-group">
                <label class="form-label">Año de creación</label>
                <input type="number" name="anio" class="form-control"
                       value="{{ old('anio') }}" placeholder="Ej: 1889">
                @error('anio')<span class="error-msg">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label class="form-label">Precio (S/.)</label>
                <input type="number" step="0.01" name="precio" class="form-control"
                       value="{{ old('precio') }}" placeholder="0.00">
                @error('precio')<span class="error-msg">{{ $message }}</span>@enderror
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Imagen de la obra (opcional)</label>
            <input type="file" name="imagen" class="form-control" accept="image/*">
            @error('imagen')<span class="error-msg">{{ $message }}</span>@enderror
            <span style="font-size:0.74rem;color:var(--text-3);margin-top:5px;display:block;font-family:'DM Mono',monospace">
                jpg, jpeg, png, gif — máx. 2 MB
            </span>
        </div>

        <div style="display:flex;gap:12px;margin-top:2rem">
            <button type="submit" class="btn btn-gold" style="flex:1;justify-content:center">Guardar obra</button>
            <a href="{{ route('obras.index') }}" class="btn btn-outline">Cancelar</a>
        </div>
    </form>
</div>

@endsection