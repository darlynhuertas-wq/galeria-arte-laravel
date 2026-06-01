@extends('layouts.app')
@section('title', $obra->titulo)
@section('content')

<div style="margin-bottom: 1.5rem;">
    <a href="{{ route('galeria.index') }}" style="color: var(--text-muted); text-decoration: none; font-size: 0.9rem;">← Volver a la Sala de Exposición</a>
</div>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(450px, 1fr)); gap: 40px; background: white; padding: 2.5rem; border-radius: 12px; border: 1px solid var(--border); box-shadow: 0 4px 20px rgba(0,0,0,0.03);">
    
    <div style="background: #fdfdfd; border: 1px solid #eee; border-radius: 8px; overflow: hidden; display: flex; align-items: center; justify-content: center; padding: 10px; max-height: 500px;">
        @if($obra->imagen)
            <img src="{{ asset('uploads/obras/'.$obra->imagen) }}" style="max-width: 100%; max-height: 480px; object-fit: contain; border-radius: 4px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
        @else
            <div style="padding: 5rem 0; text-align: center; color: #bbb;">
                <span style="font-size: 4rem;">🖼</span>
                <p style="margin-top: 10px; font-size: 0.9rem;">Visualización Física No Disponible</p>
            </div>
        @endif
    </div>

    <div style="display: flex; flex-direction: column; justify-content: center;">
        <span style="text-transform: uppercase; color: var(--gold); font-size: 0.8rem; font-weight: 600; letter-spacing: 1px;">Ficha Técnica de Catálogo</span>
        <h2 style="font-size: 2.6rem; margin: 0.3rem 0 1rem 0; line-height: 1.1;">{{ $obra->titulo }}</h2>
        
        <div style="background: #f9f9f9; padding: 1.2rem; border-radius: 6px; margin-bottom: 1.5rem; border-left: 3px solid var(--gold);">
            <p style="margin: 0; font-size: 1.05rem;"><strong>Artista Autor:</strong> {{ $obra->artista->nombre }}</p>
            <p style="margin: 5px 0 0 0; font-size: 0.85rem; color: var(--text-muted);">Procedencia / Nacionalidad: {{ $obra->artista->nacionalidad }}</p>
        </div>

        <div style="margin-bottom: 2rem; font-size: 0.95rem; line-height: 1.6;">
            <p style="margin: 0 0 8px 0;">🎨 <strong>Técnica Ejecutada:</strong> {{ $obra->tecnica }}</p>
            <p style="margin: 0 0 8px 0;">📅 <strong>Año de Creación:</strong> Año {{ $obra->anio }}</p>
        </div>

        <div style="border-top: 1px solid var(--border); padding-top: 1.5rem;">
            <span style="font-size: 0.85rem; color: var(--text-muted); text-transform: uppercase; display: block;">Precio de Adquisición</span>
            <span style="font-size: 2.2rem; font-weight: 700; color: var(--gold); display: block; margin-bottom: 1.5rem;">S/. {{ number_format($obra->precio, 2) }}</span>
            
            <form action="{{ route('carrito.agregar', $obra->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-gold" style="padding: 14px 28px; font-size: 1rem; border-radius: 6px; width: 100%; box-shadow: 0 4px 12px rgba(179,143,79,0.2);">
                    Añadir al Carrito de Colección 🛒
                </button>
            </form>
        </div>
    </div>
</div>

<div style="background: #fff; border: 1px solid var(--border); padding: 2rem; border-radius: 12px; margin-top: 2.5rem;">
    <h3 style="margin-top: 0; font-size: 1.3rem;">Sobre el Autor (Biografía Resumida)</h3>
    <p style="color: var(--text-muted); font-size: 0.95rem; line-height: 1.6; margin: 0;">{{ $obra->artista->bio }}</p>
</div>

@endsection