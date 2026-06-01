@extends('layouts.app')
@section('title', 'Control de Catálogo de Obras')
@section('content')

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
    <div>
        <h2 style="font-size: 2rem; margin: 0; font-family: 'Playfair Display', serif;">Catálogo de Obras Oficiales</h2>
        <p style="color: var(--text-muted); margin: 0;">Administración central de pinturas y esculturas de la colección.</p>
    </div>
    <a href="{{ route('obras.create') }}" class="btn btn-gold">🎨 Catalogar Nueva Obra</a>
</div>

<div class="panel-table-container">
    <table class="custom-table">
        <thead>
            <tr>
                <th style="text-align: center; width: 110px;">Exhibición</th>
                <th>Título de la Obra</th>
                <th>Maestro Autor</th>
                <th>Ficha Técnica</th>
                <th>Valoración</th>
                <th style="text-align: center; width: 180px;">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($obras as $obra)
            <tr>
                <td style="text-align: center;">
                    @if($obra->imagen)
                        <img src="{{ asset('images/' . $obra->imagen) }}" style="width: 70px; height: 50px; object-fit: cover; border-radius: 6px; border: 1px solid var(--border);">
                    @else
                        <div style="width: 70px; height: 50px; background: #f1f5f9; border-radius: 6px; display: inline-flex; align-items: center; justify-content: center; font-size: 1.2rem; color: #94a3b8;">🖼️</div>
                    @endif
                </td>
                <td>
                    <span style="font-size: 1.05rem; font-weight: 600; color: var(--primary); font-family: 'Playfair Display', serif;">{{ $obra->titulo }}</span>
                    <small style="display: block; color: var(--text-muted); font-size: 0.75rem;">Catálogo ID: #{{ $obra->id }}</small>
                </td>
                <td style="color: var(--gold); font-weight: 500;">👤 {{ $obra->artista->nombre ?? 'Sin Autor' }}</td>
                <td style="color: var(--text-muted); font-size: 0.9rem;">
                    <span style="display: block;"><strong>Técnica:</strong> {{ $obra->tecnica }}</span>
                    <span style="display: block; font-size: 0.8rem;"><strong>Año:</strong> {{ $obra->anio }}</span>
                </td>
                <td><strong style="color: var(--primary); font-size: 1.05rem;">S/. {{ number_format($obra->precio, 2) }}</strong></td>
                <td style="text-align: center;">
                    <div style="display: inline-flex; gap: 8px;">
                        <a href="{{ route('obras.edit', $obra->id) }}" class="btn btn-outline" style="padding: 6px 14px; font-size: 0.85rem;">✏️ Editar</a>
                        <form action="{{ route('obras.destroy', $obra->id) }}" method="POST" style="margin: 0;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger-outline" style="padding: 6px 14px; font-size: 0.85rem;" onclick="return confirm('¿Remover obra?')">Rescindir 🗑️</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection