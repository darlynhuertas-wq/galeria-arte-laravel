@extends('layouts.app')
@section('title', 'Detalle: '.$obra->titulo)

@section('content')

<a href="{{ route('obras.index') }}" class="back-link">← Volver al catálogo</a>

<div class="obra-detail-grid">
    <!-- Imagen -->
    <div class="obra-img-frame">
        @if($obra->imagen)
            <img src="{{ asset('uploads/obras/'.$obra->imagen) }}" alt="{{ $obra->titulo }}">
        @else
            <div style="text-align:center;color:var(--text-3);padding:60px 0">
                <div style="width:84px;height:84px;border:1.5px solid var(--border);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:2.2rem;margin:0 auto 16px;background:var(--cream-2)">🖼</div>
                <p style="font-size:0.82rem;margin:0;font-family:'DM Mono',monospace">Sin imagen cargada</p>
            </div>
        @endif
    </div>

    <!-- Info -->
    <div style="display:flex;flex-direction:column;justify-content:center">
        <span class="obra-tag">Ficha técnica</span>
        <h2 class="obra-titulo">{{ $obra->titulo }}</h2>

        <div class="obra-artista-block">
            <strong>{{ $obra->artista->nombre }}</strong>
            <span>Nacionalidad: {{ $obra->artista->nacionalidad }}</span>
        </div>

        <div class="obra-ficha">
            <div class="obra-ficha-item">
                <span class="obra-ficha-key">Técnica</span>
                <span class="obra-ficha-val">{{ $obra->tecnica }}</span>
            </div>
            <div class="obra-ficha-item">
                <span class="obra-ficha-key">Año</span>
                <span class="obra-ficha-val">{{ $obra->anio }}</span>
            </div>
        </div>

        <div class="obra-precio-section">
            <div class="obra-precio-lbl">Precio de catálogo</div>
            <div class="obra-precio-val">S/. {{ number_format($obra->precio, 2) }}</div>
        </div>

        <div style="display:flex;gap:10px;margin-top:1.5rem">
            <a href="{{ route('obras.edit', $obra->id) }}" class="btn btn-gold">Editar obra</a>
            <a href="{{ route('obras.index') }}" class="btn btn-outline">Volver</a>
        </div>
    </div>
</div>

@endsection