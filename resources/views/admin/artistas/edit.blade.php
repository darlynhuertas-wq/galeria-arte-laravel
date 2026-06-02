@extends('layouts.app')
@section('title', 'Modificar Artista')

@section('content')

<a href="{{ route('artistas.index') }}" class="back-link">← Cancelar operación</a>

<div class="form-panel">
    <h2 class="form-panel-title">Actualizar ficha: <em style="font-style:italic;font-weight:400">{{ $artista->nombre }}</em></h2>

    <form action="{{ route('artistas.update', $artista->id) }}" method="POST">
        @csrf @method('PUT')

        <div class="form-group">
            <label class="form-label">Nombre del autor</label>
            <input type="text" name="nombre" class="form-control"
                   value="{{ old('nombre', $artista->nombre) }}">
            @error('nombre')<span class="error-msg">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
            <label class="form-label">Nacionalidad</label>
            <input type="text" name="nacionalidad" class="form-control"
                   value="{{ old('nacionalidad', $artista->nacionalidad) }}">
            @error('nacionalidad')<span class="error-msg">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
            <label class="form-label">Biografía curatorial</label>
            <textarea name="bio" rows="5" class="form-control">{{ old('bio', $artista->bio) }}</textarea>
            @error('bio')<span class="error-msg">{{ $message }}</span>@enderror
        </div>

        <div style="display:flex;gap:10px;margin-top:2rem">
            <button type="submit" class="btn btn-gold" style="flex:1;justify-content:center">Guardar cambios</button>
            <a href="{{ route('artistas.index') }}" class="btn btn-outline">Descartar</a>
        </div>
    </form>
</div>

@endsection