@extends('layouts.app')
@section('title', 'Gestión de Artistas')

@section('content')

<div class="page-title-row">
    <div>
        <h2 class="page-title">Artistas</h2>
        <p class="page-subtitle">Mantenimiento y control de los autores de la galería.</p>
    </div>
    <a href="{{ route('artistas.create') }}" class="btn btn-gold">+ Registrar Artista</a>
</div>

<div class="panel">
    <div class="panel-header">
        <div>
            <div class="panel-title">Maestros de la colección</div>
            <div class="panel-subtitle">{{ $artistas->count() }} artista(s) registrados</div>
        </div>
    </div>
    <table class="custom-table">
        <thead>
            <tr>
                <th style="width:60px">ID</th>
                <th>Nombre del Artista</th>
                <th>Nacionalidad</th>
                <th>Semblanza / Biografía</th>
                <th style="text-align:center;width:180px">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($artistas as $art)
            <tr>
                <td>
                    <span style="font-family:'DM Mono',monospace;font-size:0.75rem;color:var(--text-3)">#{{ $art->id }}</span>
                </td>
                <td>
                    <strong style="font-size:0.95rem;color:var(--text)">{{ $art->nombre }}</strong>
                </td>
                <td>
                    <span class="badge badge-navy">{{ $art->nacionalidad }}</span>
                </td>
                <td style="color:var(--text-3);font-size:0.83rem;max-width:380px;line-height:1.5">
                    {{ Str::limit($art->bio, 100) }}
                </td>
                <td style="text-align:center">
                    <div style="display:inline-flex;gap:6px">
                        <a href="{{ route('artistas.edit', $art->id) }}" class="btn btn-outline btn-sm">Editar</a>
                        <form action="{{ route('artistas.destroy', $art->id) }}" method="POST" style="margin:0"
                              onsubmit="return confirm('¿Eliminar este artista y todas sus obras?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align:center;color:var(--text-3);padding:3.5rem;font-family:'Playfair Display',serif;font-style:italic;font-size:1rem">
                    No hay artistas registrados aún.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection