@extends('layouts.app')
@section('title', 'Carrito de Adquisiciones')
@section('content')

<div style="margin-bottom: 2rem;">
    <h2 style="font-size: 2.2rem; margin: 0 0 0.3rem 0; font-family: 'Playfair Display', serif;">Carrito de Adquisiciones</h2>
    <p style="color: var(--text-muted); margin: 0;">Gestione las cantidades de reproducciones autorizadas de su pedido.</p>
</div>

@if(count($obrasCarrito) > 0)
    <div class="panel-table-container">
        <table class="custom-table">
            <thead>
                <tr>
                    <th style="width: 100px; text-align: center;">Exhibición</th>
                    <th>Detalles del Artículo</th>
                    <th>Valor Unitario</th>
                    <th style="text-align: center; width: 140px;">Cantidad</th>
                    <th>Subtotal</th>
                    <th style="text-align: center; width: 120px;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($obrasCarrito as $item)
                <tr>
                    <td style="text-align: center;">
                        @if($item['imagen'])
                            <img src="{{ asset('uploads/obras/'.$item['imagen']) }}" style="width: 70px; height: 50px; object-fit: cover; border-radius: 6px; border: 1px solid var(--border);">
                        @else
                            <div style="width: 70px; height: 50px; background: #eee; display: inline-flex; align-items: center; justify-content: center; border-radius: 6px;">🖼️</div>
                        @endif
                    </td>
                    <td>
                        <strong style="font-size: 1.05rem; color: #111; font-family: 'Playfair Display', serif;">{{ $item['titulo'] }}</strong>
                        <span style="display: block; font-size: 0.78rem; color: var(--gold);">Autor: {{ $item['artista'] }}</span>
                    </td>
                    <td style="font-weight: 500;">
                        S/. {{ number_format($item['precio'], 2) }}
                    </td>
                    
                    <td style="text-align: center;">
                        <div style="display: inline-flex; align-items: center; gap: 10px; background: #f1f5f9; padding: 4px 10px; border-radius: 20px; border: 1px solid var(--border);">
                            <form action="{{ route('carrito.decrementar', $item['id']) }}" method="POST" style="margin:0;">
                                @csrf
                                <button type="submit" style="background:none; border:none; font-weight:700; cursor:pointer; font-size:1rem;">-</button>
                            </form>
                            
                            <span style="font-weight: 700; font-size: 0.95rem; min-width: 20px; display: inline-block;">{{ $item['cantidad'] }}</span>
                            
                            <form action="{{ route('carrito.incrementar', $item['id']) }}" method="POST" style="margin:0;">
                                @csrf
                                <button type="submit" style="background:none; border:none; font-weight:700; cursor:pointer; font-size:1rem;">+</button>
                            </form>
                        </div>
                    </td>
                    
                    <td style="font-weight: 600; color: var(--text-dark);">
                        S/. {{ number_format($item['subtotal'], 2) }}
                    </td>
                    
                    <td style="text-align: center;">
                        <form action="{{ route('carrito.eliminar', $item['id']) }}" method="POST" style="margin:0;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger-outline" style="padding: 6px 12px; font-size: 0.8rem;">Quitar 🗑️</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div style="display: flex; justify-content: flex-end; margin-top: 2rem;">
        <div style="background: white; padding: 1.5rem 2.5rem; border-radius: 8px; border: 1px solid var(--border); box-shadow: 0 4px 12px rgba(0,0,0,0.02); text-align: right;">
            <span style="font-size: 0.85rem; color: var(--text-muted); text-transform: uppercase; display: block; margin-bottom: 0.3rem;">Total General</span>
            <strong style="font-size: 2rem; color: var(--success); font-family: 'Playfair Display', serif;">S/. {{ number_format($total, 2) }}</strong>
            <div style="margin-top: 1rem;">
                <button onclick="alert('¡Compra de arte simulada con éxito!')" class="btn btn-gold" style="width: 100%; justify-content: center;">Confirmar Pedido</button>
            </div>
        </div>
    </div>
@else
    <div style="background: white; padding: 5rem 2rem; text-align: center; border-radius: 12px; border: 1px solid var(--border);">
        <div style="font-size: 4rem; margin-bottom: 1rem;">🛒</div>
        <h3 style="font-size: 1.6rem; margin: 0 0 0.5rem 0; font-family: 'Playfair Display', serif;">Su carrito está vacío</h3>
        <a href="{{ route('galeria.index') }}" class="btn btn-gold">Ir a la Galería</a>
    </div>
@endif

@endsection