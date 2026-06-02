@extends('layouts.app')
@section('title', 'Exposición — MUSeoVIRTUAL')

@section('hero')
<div class="page-hero">
    <div class="page-hero-tag">✦ Colección Permanente</div>
    <h1>Arte sin fronteras,<br><em>belleza sin límites</em></h1>
    <p>Adquiere obras maestras de los grandes genios de la pintura universal directamente desde nuestra galería.</p>
    <div class="stats-strip">
        <div class="stats-strip-item">
            <span class="stats-num">{{ $obras->count() }}</span>
            <span class="stats-lbl">Obras</span>
        </div>
        <div class="stats-strip-item">
            <span class="stats-num">{{ $artistas->count() }}</span>
            <span class="stats-lbl">Artistas</span>
        </div>
        <div class="stats-strip-item">
            <span class="stats-num">S/. {{ number_format($obras->sum('precio') / 1000000, 1) }}M</span>
            <span class="stats-lbl">Valor colección</span>
        </div>
    </div>
</div>
@endsection

@section('content')

<div class="filters-bar">

    <form action="{{ route('galeria.index') }}" method="GET" style="width:100%;">

        <div style="display:flex;gap:10px;flex-wrap:wrap;align-items:end;">

            <div style="flex:2;min-width:220px;">
                <label class="form-label">Buscar por título</label>
                <input
                    type="text"
                    name="buscar"
                    value="{{ request('buscar') }}"
                    placeholder="Ej: Mona Lisa"
                    class="form-control">
            </div>

            <div style="min-width:180px;">
                <label class="form-label">Técnica</label>
                <select name="tecnica" class="form-control">

                    <option value="">Todas las técnicas</option>

                    <option value="Óleo"
                        {{ request('tecnica') == 'Óleo' ? 'selected' : '' }}>
                        Óleo
                    </option>

                    <option value="Acuarela"
                        {{ request('tecnica') == 'Acuarela' ? 'selected' : '' }}>
                        Acuarela
                    </option>

                    <option value="Acrílico"
                        {{ request('tecnica') == 'Acrílico' ? 'selected' : '' }}>
                        Acrílico
                    </option>

                </select>
            </div>

            <div style="min-width:180px;">
                <label class="form-label">Precio</label>
                <select name="precio" class="form-control">

                    <option value="">Todos los precios</option>

                    <option value="1"
                        {{ request('precio') == '1' ? 'selected' : '' }}>
                        Menos de S/.5000
                    </option>

                    <option value="2"
                        {{ request('precio') == '2' ? 'selected' : '' }}>
                        S/.5000 - S/.20000
                    </option>

                    <option value="3"
                        {{ request('precio') == '3' ? 'selected' : '' }}>
                        Más de S/.20000
                    </option>

                </select>
            </div>

            <div style="min-width:180px;">
                <label class="form-label">Ordenar</label>
                <select name="orden" class="form-control">

                    <option value="">Ordenar por</option>

                    <option value="precio_asc"
                        {{ request('orden') == 'precio_asc' ? 'selected' : '' }}>
                        Precio menor
                    </option>

                    <option value="precio_desc"
                        {{ request('orden') == 'precio_desc' ? 'selected' : '' }}>
                        Precio mayor
                    </option>

                    <option value="reciente"
                        {{ request('orden') == 'reciente' ? 'selected' : '' }}>
                        Más reciente
                    </option>

                    <option value="antiguo"
                        {{ request('orden') == 'antiguo' ? 'selected' : '' }}>
                        Más antiguo
                    </option>

                    <option value="az"
                        {{ request('orden') == 'az' ? 'selected' : '' }}>
                        A - Z
                    </option>

                    <option value="za"
                        {{ request('orden') == 'za' ? 'selected' : '' }}>
                        Z - A
                    </option>

                </select>
            </div>

            <button type="submit" class="btn btn-gold">
                Aplicar filtros
            </button>

            <a href="{{ route('galeria.index') }}"
               class="btn btn-outline">
                Limpiar
            </a>

        </div>

    </form>

</div>

<div class="filter-pills">
    <a href="{{ route('galeria.index') }}"
       class="filter-pill {{ !request('artista_id') ? 'active' : '' }}">Todos los artistas</a>
    @foreach($artistas as $art)
        <a href="{{ route('galeria.index', array_merge(request()->all(), ['artista_id' => $art->id])) }}"
           class="filter-pill {{ request('artista_id') == $art->id ? 'active' : '' }}">{{ $art->nombre }}</a>
    @endforeach
</div>
<div class="filter-pills" style="margin-top:15px;">
    <a href="{{ route('galeria.index', array_merge(request()->except('tecnica'), [])) }}"
       class="filter-pill {{ !request('tecnica') ? 'active' : '' }}">
        Todas las técnicas
    </a>

    @foreach($obras->pluck('tecnica')->unique() as $tec)
        <a href="{{ route('galeria.index', array_merge(request()->all(), ['tecnica' => $tec])) }}"
           class="filter-pill {{ request('tecnica') == $tec ? 'active' : '' }}">
            {{ $tec }}
        </a>
    @endforeach
</div>

<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:24px">
    <div>
        <h2 style="font-family:'Playfair Display',serif;font-size:1.55rem;font-weight:700;margin:0">Sala de Exposición</h2>
        <p style="font-size:0.78rem;color:var(--text-3);margin:4px 0 0;font-family:'DM Mono',monospace">
            {{ $obras->count() }} obra(s) disponibles para adquisición
        </p>
    </div>
</div>

<div class="grid-gallery">
    @forelse($obras as $ob)
    <div class="card-art" onclick="window.location='{{ route('galeria.detalle', $ob->id) }}'">
        <div class="card-img-wrap">
            @if($ob->imagen)
                <img src="{{ asset('uploads/obras/'.$ob->imagen) }}" alt="{{ $ob->titulo }}">
            @else
                <div class="card-no-img">
                    <div class="card-no-img-icon">🖼</div>
                    <span style="font-size:0.67rem;text-transform:uppercase;letter-spacing:1.2px;font-family:'DM Mono',monospace">Sin fotografía</span>
                </div>
            @endif
            <div class="card-overlay"></div>
            <div class="card-style-tag">{{ $ob->tecnica }}</div>
            <div class="card-overlay-cta">
                <span class="btn btn-gold btn-sm">Ver detalle →</span>
            </div>
        </div>
        <div class="card-body">
            <div class="card-artist-name">{{ $ob->artista->nombre ?? 'Autor Anónimo' }}</div>
            <h3 class="card-title">{{ $ob->titulo }}</h3>
            <p class="card-meta">{{ $ob->anio }} · {{ $ob->tecnica }}</p>
            <div class="card-footer-row">
                <div>
                    <span class="card-price-lbl">Precio de adquisición</span>
                    <span class="card-price-val">S/. {{ number_format($ob->precio, 2) }}</span>
                </div>
                <div class="card-actions">
                    <a href="{{ route('galeria.detalle', $ob->id) }}" class="btn btn-outline btn-sm"
                       onclick="event.stopPropagation()">Ver</a>
                    <form action="{{ route('carrito.agregar', $ob->id) }}" method="POST" style="margin:0"
                          onclick="event.stopPropagation()">
                        @csrf
                        <button type="submit" class="btn btn-gold btn-sm">+ Carrito</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="empty-state">
        <div class="empty-icon">🔍</div>
        <h3>Sin resultados</h3>
        <p>No encontramos obras con esos criterios. <a href="{{ route('galeria.index') }}" style="color:var(--gold-dark)">Ver todo</a></p>
    </div>
    @endforelse
</div>

@endsection