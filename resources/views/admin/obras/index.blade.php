@extends('layouts.app')
@section('title', 'Control de Catálogo de Obras')

@section('content')

<div class="page-title-row">
    <div>
        <h2 class="page-title">Catálogo de Obras</h2>
        <p class="page-subtitle">Administración central de la colección.</p>
    </div>
    <a href="{{ route('obras.create') }}" class="btn btn-gold">+ Nueva Obra</a>
</div>

<div class="panel">
    <div class="panel-header">
        <div>
            <div class="panel-title">Obras registradas</div>
            <div class="panel-subtitle">{{ $obras->count() }} obra(s) en catálogo</div>
        </div>
    </div>
    <table class="custom-table">
        <thead>
            <tr>
                <th style="width:80px;text-align:center">Imagen</th>
                <th>Título</th>
                <th>Artista</th>
                <th>Ficha Técnica</th>
                <th>Precio</th>
                <th style="text-align:center;width:200px">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($obras as $obra)
            <tr>
                <td style="text-align:center">
                    @if($obra->imagen)
                        <img src="{{ asset('uploads/obras/'.$obra->imagen) }}" class="table-thumb">
                    @else
                        <div style="width:52px;height:40px;background:var(--cream-2);border-radius:6px;display:inline-flex;align-items:center;justify-content:center;font-size:1.1rem;color:var(--text-3);border:1px solid var(--border)">🖼️</div>
                    @endif
                </td>
                <td>
                    <div style="font-weight:700;font-family:'Playfair Display',serif;font-size:0.97rem;color:var(--text)">{{ $obra->titulo }}</div>
                    <div style="font-family:'DM Mono',monospace;font-size:0.68rem;color:var(--text-3);margin-top:2px">#{{ $obra->id }}</div>
                </td>
                <td>
                    <span class="badge badge-gold">{{ $obra->artista->nombre ?? 'Sin Autor' }}</span>
                </td>
                <td style="font-size:0.83rem;color:var(--text-2)">
                    <div>{{ $obra->tecnica }}</div>
                    <div style="font-family:'DM Mono',monospace;font-size:0.72rem;color:var(--text-3);margin-top:2px">{{ $obra->anio }}</div>
                </td>
                <td>
                    <div style="font-family:'Playfair Display',serif;font-size:1rem;font-weight:700;color:var(--text)">S/. {{ number_format($obra->precio, 2) }}</div>
                </td>
                <td style="text-align:center">
                    <div style="display:inline-flex;gap:5px">
                        <a href="{{ route('obras.show', $obra->id) }}" class="btn btn-outline btn-sm">Ver</a>
                        <a href="{{ route('obras.edit', $obra->id) }}" class="btn btn-outline btn-sm">Editar</a>
                        <form action="{{ route('obras.destroy', $obra->id) }}" method="POST" style="margin:0"
                              onsubmit="return confirm('¿Eliminar esta obra definitivamente?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align:center;color:var(--text-3);padding:3.5rem;font-family:'Playfair Display',serif;font-style:italic;font-size:1rem">
                    No hay obras registradas en el catálogo.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection