@extends('layouts.app')
@section('title', 'Carrito de Adquisiciones')

@section('content')

{{-- MODAL PEDIDO CONFIRMADO --}}
@if(session('pedido_confirmado'))
<div class="modal-overlay">
    <div class="modal-card">
        <div class="modal-icon">✅</div>
        <h2 class="modal-title">¡Pedido Confirmado!</h2>
        <p class="modal-sub">Tu adquisición ha sido registrada exitosamente. En breve recibirás los detalles de tu colección.</p>
        <div class="modal-total">Total pagado: S/. {{ session('pedido_total') }}</div>
        <a href="{{ route('galeria.index') }}" class="btn btn-gold btn-full btn-lg">Volver a la Galería →</a>
    </div>
</div>
@endif

<div class="page-title-row">
    <div>
        <h2 class="page-title">Carrito de <em style="font-style:italic;font-weight:400">Adquisiciones</em></h2>
        <p class="page-subtitle">Gestione las cantidades de su pedido.</p>
    </div>
    @if(count($obrasCarrito) > 0)
        <form action="{{ route('carrito.vaciar') }}" method="POST" style="margin:0"
              onsubmit="return confirm('¿Vaciar todo el carrito?')">
            @csrf @method('DELETE')
            <button type="submit" class="btn btn-danger">Vaciar carrito</button>
        </form>
    @endif
</div>

@if(count($obrasCarrito) > 0)

<div class="carrito-layout">

    {{-- ITEMS --}}
    <div class="panel">
        <div class="panel-header">
            <div>
                <div class="panel-title">Obras seleccionadas</div>
                <div class="panel-subtitle">{{ array_sum(array_column($obrasCarrito, 'cantidad')) }} artículo(s)</div>
            </div>
        </div>
        @foreach($obrasCarrito as $item)
        <div class="carrito-item">
            {{-- Imagen --}}
            @if($item['imagen'])
                <img src="{{ asset('uploads/obras/'.$item['imagen']) }}" class="carrito-item-img" alt="{{ $item['titulo'] }}">
            @else
                <div class="carrito-item-no-img">🖼️</div>
            @endif

            {{-- Datos --}}
            <div>
                <div style="font-family:'Playfair Display',serif;font-size:1.05rem;font-weight:700;color:var(--text);margin-bottom:3px">{{ $item['titulo'] }}</div>
                <div style="font-size:0.72rem;color:var(--gold-dark);font-weight:600;letter-spacing:1px;text-transform:uppercase;font-family:'DM Mono',monospace;margin-bottom:8px">{{ $item['artista'] }}</div>
                <div style="font-size:0.82rem;color:var(--text-3)">S/. {{ number_format($item['precio'], 2) }} c/u</div>
            </div>

            {{-- Controles qty + quitar --}}
            <div style="display:flex;flex-direction:column;align-items:flex-end;gap:10px">
                <div class="qty-control">
                    <form action="{{ route('carrito.decrementar', $item['id']) }}" method="POST" style="margin:0">
                        @csrf
                        <button type="submit" class="qty-btn">−</button>
                    </form>
                    <span class="qty-val">{{ $item['cantidad'] }}</span>
                    <form action="{{ route('carrito.incrementar', $item['id']) }}" method="POST" style="margin:0">
                        @csrf
                        <button type="submit" class="qty-btn">+</button>
                    </form>
                </div>
                <div style="font-family:'Playfair Display',serif;font-size:1.05rem;font-weight:700;color:var(--text)">
                    S/. {{ number_format($item['subtotal'], 2) }}
                </div>
                <form action="{{ route('carrito.eliminar', $item['id']) }}" method="POST" style="margin:0">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger" style="padding:5px 10px;font-size:0.72rem">Quitar</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>

    {{-- RESUMEN --}}
    <div class="resumen-card">
        <div class="resumen-header">
            <h3>Resumen del Pedido</h3>
        </div>
        <div class="resumen-body">
            <div class="resumen-row">
                <span>Artículos ({{ array_sum(array_column($obrasCarrito, 'cantidad')) }})</span>
                <span>S/. {{ number_format($total, 2) }}</span>
            </div>
            <div class="resumen-row">
                <span>Envío y gestión</span>
                <span style="color:var(--success);font-weight:600">Gratis</span>
            </div>
            <div class="resumen-total">
                <span class="resumen-total-lbl">Total General</span>
                <span class="resumen-total-val">S/. {{ number_format($total, 2) }}</span>
            </div>

            <form action="{{ route('carrito.confirmar') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-gold btn-full btn-lg">
                    Confirmar Pedido ✓
                </button>
            </form>

            <a href="{{ route('galeria.index') }}"
               style="display:block;text-align:center;margin-top:14px;font-size:0.82rem;color:var(--text-3);text-decoration:none">
                ← Seguir explorando
            </a>
        </div>
    </div>

</div>

@else
<div class="empty-state">
    <div class="empty-icon">🛒</div>
    <h3>Su carrito está vacío</h3>
    <p>Explore la galería y agregue obras a su colección.</p>
    <a href="{{ route('galeria.index') }}" class="btn btn-gold" style="margin-top:20px">Ir a la Galería</a>
</div>
@endif

@endsection