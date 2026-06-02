@extends('layouts.app')

@section('title','Mis Compras')

@section('content')

<div class="page-title-row">
    <div>
        <h1 class="page-title">Mis Compras</h1>
        <p class="page-subtitle">Historial completo de pedidos</p>
    </div>
</div>

@forelse($pedidos as $pedido)

<div class="panel" style="margin-bottom:20px">

    <div class="panel-header">
        <div>
            <strong>Pedido #{{ $pedido->id }}</strong>
            <div>{{ $pedido->created_at->format('d/m/Y H:i') }}</div>
        </div>

        <div>
            <strong>S/. {{ number_format($pedido->total,2) }}</strong>
        </div>
    </div>

    <table class="custom-table">
        <thead>
            <tr>
                <th>Obra</th>
                <th>Cantidad</th>
                <th>Precio</th>
            </tr>
        </thead>

        <tbody>
            @foreach($pedido->detalles as $detalle)
            <tr>
                <td>{{ $detalle->obra->titulo }}</td>
                <td>{{ $detalle->cantidad }}</td>
                <td>S/. {{ number_format($detalle->precio,2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

@empty

<div class="empty-state">
    <div class="empty-icon">🛒</div>
    <h3>Aún no tienes compras</h3>
</div>

@endforelse

@endsection