@extends('layouts.app')
@section('title', 'Exposición General de Obras')
@section('content')

<div style="text-align: center; margin-bottom: 2.5rem;">
    <h2 style="font-size: 2.5rem; margin-bottom: 0.5rem; letter-spacing: -0.5px;">Obras de Arte Disponibles</h2>
    <p style="color: var(--text-muted); max-width: 600px; margin: 0 auto; font-size: 1rem;">Disfruta de piezas maestras exclusivas. Usa los filtros para explorar colecciones específicas.</p>
</div>

<div style="background: white; padding: 1.5rem; border-radius: 8px; border: 1px solid var(--border); margin-bottom: 2.5rem; box-shadow: 0 4px 12px rgba(0,0,0,0.02);">
    <form action="{{ route('galeria.index') }}" method="GET" style="display: flex; gap: 15px; flex-wrap: wrap; align-items: flex-end;">
        
        <div style="flex: 2; min-width: 250px; display: flex; flex-direction: column; gap: 5px;">
            <label style="font-size: 0.85rem; font-weight: 500; color: var(--text-dark);">Buscar por título de obra</label>
            <input type="text" name="buscar" value="{{ request('buscar') }}" placeholder="Ej. El Grito, Noche Estrellada..." 
                   style="padding: 10px; border: 1px solid var(--border); border-radius: 4px; font-family: inherit; font-size: 0.9rem; width: 100%; box-sizing: border-box;">
        </div>

        <div style="flex: 1; min-width: 200px; display: flex; flex-direction: column; gap: 5px;">
            <label style="font-size: 0.85rem; font-weight: 500; color: var(--text-dark);">Filtrar por Artista</label>
            <select name="artista_id" style="padding: 10px; border: 1px solid var(--border); border-radius: 4px; font-family: inherit; font-size: 0.9rem; background: #fff; width: 100%; box-sizing: border-box;">
                <option value="">-- Todos los Artistas --</option>
                @foreach($artistas as $art)
                    <option value="{{ $art->id }}" {{ request('artista_id') == $art->id ? 'selected' : '' }}>
                        {{ $art->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div style="display: flex; gap: 10px;">
            <button type="submit" class="btn btn-gold" style="padding: 10px 20px; height: 42px;">Filtrar Catálogo</button>
            @if(request('buscar') || request('artista_id'))
                <a href="{{ route('galeria.index') }}" class="btn btn-outline" style="padding: 10px 15px; height: 42px; display: flex; align-items: center; justify-content: center; box-sizing: border-box;">Limpiar</a>
            @endif
        </div>
    </form>
</div>

<div class="grid-gallery">
    @forelse($obras as $ob)
    <div class="card-art">
        <div style="position: relative; overflow: hidden; background: #eaeaea; height: 250px; border-bottom: 1px solid var(--border);">
            @if($ob->imagen)
                <img src="{{ asset('uploads/obras/'.$ob->imagen) }}" alt="{{ $ob->titulo }}" 
                     style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease;" 
                     onmouseover="this.style.transform='scale(1.04)'" onmouseout="this.style.transform='scale(1)'">
            @else
                <div style="width: 100%; height: 100%; display: flex; flex-direction:column; align-items: center; justify-content: center; color: #999;">
                    <span style="font-size: 3rem;">🖼</span>
                    <span style="font-size: 0.8rem; margin-top: 8px; font-weight: 500; letter-spacing: 0.5px; text-transform: uppercase;">Fotografía en Curaduría</span>
                </div>
            @endif
        </div>
        
        <div style="padding: 1.5rem;">
            <h3 style="margin: 0 0 0.4rem 0; font-size: 1.3rem; line-height: 1.2; font-family: 'Playfair Display', serif;">{{ $ob->titulo }}</h3>
            <p style="margin: 0 0 1rem 0; font-size: 0.9rem; color: var(--gold); font-weight: 500;">
                Maestro: {{ $ob->artista->nombre ?? 'Autor Anónimo' }}
            </p>
            
            <div style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid #f5f5f5; padding-top: 1rem; margin-top: 0.5rem;">
                <div>
                    <span style="display: block; font-size: 0.75rem; color: var(--text-muted); text-transform: uppercase;">Valoración</span>
                    <span style="font-size: 1.25rem; font-weight: 600; color: var(--text-dark);">S/. {{ number_format($ob->precio, 2) }}</span>
                </div>
                <div style="display: flex; gap: 8px;">
                    <a href="#" class="btn btn-outline" style="padding: 8px 12px; font-size: 0.85rem;" title="Ver Ficha Técnica">Ficha</a>
                    
                    <form action="{{ route('carrito.agregar', $ob->id) }}" method="POST" style="margin:0;">
                        @csrf
                        <button type="submit" class="btn btn-gold" style="padding: 8px 14px; font-size: 0.85rem;">Adquirir 🛒</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div style="grid-column: 1 / -1; background: white; padding: 4rem 2rem; text-align: center; border-radius: 8px; border: 1px solid var(--border);">
        <span style="font-size: 3rem;">🔍</span>
        <h3 style="font-size: 1.4rem; margin: 1rem 0 0.5rem 0;">No se encontraron obras concordantes</h3>
        <p style="color: var(--text-muted); margin: 0;">Prueba modificando los criterios de búsqueda o seleccionando otro artista.</p>
    </div>
    @endforelse
</div>

@endsection