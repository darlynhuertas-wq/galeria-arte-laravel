@extends('layouts.app')
@section('title', 'Gestión de Artistas')
@section('content')

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <div>
        <h2 style="font-size: 2.2rem; margin: 0 0 0.3rem 0;">Páginas de Maestros (Artistas)</h2>
        <p style="color: var(--text-muted); margin: 0;">Mantenimiento y control de los autores de la galería.</p>
    </div>
    <a href="{{ route('artistas.create') }}" class="btn btn-gold">+ Registrar Artista</a>
</div>

<div class="table-responsive">
    <table>
        <thead>
            <tr>
                <th style="width: 80px;">ID</th>
                <th>Nombre del Artista</th>
                <th>Nacionalidad</th>
                <th>Semblanza / Biografía</th>
                <th style="text-align: center; width: 180px;">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($artistas as $art)
            <tr>
                <td><span style="color: var(--text-muted); font-weight: 500;">#{{ $art->id }}</span></td>
                <td><strong style="font-size: 1rem; color: #111;">{{ $art->nombre }}</strong></td>
                <td><span style="background: #eee; padding: 4px 8px; border-radius: 4px; font-size: 0.85rem;">{{ $art->nacionalidad }}</span></td>
                <td style="color: var(--text-muted); font-size: 0.85rem; max-width: 400px; line-height: 1.5;">{{ $art->bio }}</td>
                <td style="text-align: center;">
                    <div style="display: flex; gap: 8px; justify-content: center;">
                        <a href="{{ route('artistas.edit', $art->id) }}" class="btn btn-dark" style="padding: 6px 12px; font-size: 0.8rem;">Editar</a>
                        
                        <form action="{{ route('artistas.destroy', $art->id) }}" method="POST" style="margin: 0;" onsubmit="return confirm('¿Seguro que deseas eliminar este artista? Se removerán en cascada todas sus obras asociadas.');">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger" style="padding: 6px 12px; font-size: 0.8rem;">Eliminar</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align: center; color: var(--text-muted); padding: 3rem;">No hay artistas registrados en el sistema actualmente.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection