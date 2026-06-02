@extends('layouts.app')
@section('title', 'Modificar Obra')

@section('content')

<a href="{{ route('obras.index') }}" class="back-link">← Descartar modificaciones</a>

<div class="form-panel">
    <h2 class="form-panel-title">Actualizar: <em style="font-style:italic;font-weight:400">{{ $obra->titulo }}</em></h2>

    <form action="{{ route('obras.update', $obra->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="form-group">
            <label class="form-label">Título de la obra</label>
            <input type="text" name="titulo" class="form-control"
                   value="{{ old('titulo', $obra->titulo) }}">
            @error('titulo')<span class="error-msg">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
            <label class="form-label">Artista autor</label>
            <select name="artista_id" class="form-control">
                @foreach($artistas as $art)
                    <option value="{{ $art->id }}"
                        {{ old('artista_id', $obra->artista_id) == $art->id ? 'selected' : '' }}>
                        {{ $art->nombre }}
                    </option>
                @endforeach
            </select>
            @error('artista_id')<span class="error-msg">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
            <label class="form-label">Técnica artística</label>
            <input type="text" name="tecnica" class="form-control"
                   value="{{ old('tecnica', $obra->tecnica) }}">
            @error('tecnica')<span class="error-msg">{{ $message }}</span>@enderror
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px">
            <div class="form-group">
                <label class="form-label">Año de creación</label>
                <input type="number" name="anio" class="form-control"
                       value="{{ old('anio', $obra->anio) }}">
                @error('anio')<span class="error-msg">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label class="form-label">Precio (S/.)</label>
                <input type="number" step="0.01" name="precio" class="form-control"
                       value="{{ old('precio', $obra->precio) }}">
                @error('precio')<span class="error-msg">{{ $message }}</span>@enderror
            </div>
        </div>

        {{-- Imagen actual + reemplazo --}}
        @if($obra->imagen)
        <div style="background:var(--cream);border:1px solid var(--border);border-radius:var(--radius-lg);padding:20px 22px;display:flex;gap:20px;align-items:center;margin-bottom:1rem">
            <div style="text-align:center">
                <div style="font-family:'DM Mono',monospace;font-size:0.62rem;color:var(--text-3);text-transform:uppercase;letter-spacing:1px;margin-bottom:6px">Imagen actual</div>
                <img src="{{ asset('uploads/obras/'.$obra->imagen) }}"
                     style="width:90px;height:66px;object-fit:cover;border-radius:8px;border:1px solid var(--border)">
            </div>
            <div style="flex:1">
                <label class="form-label">Reemplazar imagen (opcional)</label>
                <input type="file" name="imagen" class="form-control" accept="image/*">
                <span style="font-size:0.72rem;color:var(--text-3);margin-top:4px;display:block">Dejar vacío para mantener la imagen actual.</span>
            </div>
        </div>
        @else
        <div class="form-group">
            <label class="form-label">Imagen de la obra (opcional)</label>
            <input type="file" name="imagen" class="form-control" accept="image/*">
        </div>
        @endif

        <div style="display:flex;gap:12px;margin-top:2rem">
            <button type="submit" class="btn btn-gold" style="flex:1;justify-content:center">Guardar cambios</button>
            <a href="{{ route('obras.index') }}" class="btn btn-outline">Descartar</a>
        </div>
    </form>
</div>

@endsection