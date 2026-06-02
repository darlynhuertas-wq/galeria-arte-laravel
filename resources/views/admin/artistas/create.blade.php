@extends('layouts.app')
@section('title', 'Añadir Artista')

@section('content')

<a href="{{ route('artistas.index') }}" class="back-link">← Volver al listado</a>

<div class="form-panel">
    <h2 class="form-panel-title">Inscribir nuevo <em style="font-style:italic;font-weight:400">maestro de arte</em></h2>

    <form action="{{ route('artistas.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label class="form-label">Nombre completo del autor</label>
            <input type="text" name="nombre" class="form-control"
                   value="{{ old('nombre') }}" placeholder="Ej. Claude Monet">
            @error('nombre')<span class="error-msg">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
            <label class="form-label">Nacionalidad de origen</label>
            <input type="text" name="nacionalidad" class="form-control"
                   value="{{ old('nacionalidad') }}" placeholder="Ej. Francesa">
            @error('nacionalidad')<span class="error-msg">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
            <label class="form-label">Biografía resumida / Contexto histórico</label>
            <textarea name="bio" rows="5" class="form-control"
                      placeholder="Escribe los aspectos más relevantes de la trayectoria del artista…">{{ old('bio') }}</textarea>
            @error('bio')<span class="error-msg">{{ $message }}</span>@enderror
        </div>

        <div style="display:flex;gap:10px;margin-top:2rem">
            <button type="submit" class="btn btn-gold" style="flex:1;justify-content:center">Guardar artista</button>
            <a href="{{ route('artistas.index') }}" class="btn btn-outline">Cancelar</a>
        </div>
    </form>
</div>

@endsection