@extends('layouts.app')

@section('title','Dashboard')

@section('content')

<h1 style="margin-bottom:30px">
    Panel Administrativo
</h1>

<div style="
display:grid;
grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
gap:20px;
">

    <div class="card">
        <h3>Total Obras</h3>
        <h1>{{ $totalObras }}</h1>
    </div>

    <div class="card">
        <h3>Total Artistas</h3>
        <h1>{{ $totalArtistas }}</h1>
    </div>

    <div class="card">
        <h3>Total Usuarios</h3>
        <h1>{{ $totalUsuarios }}</h1>
    </div>

</div>

<div style="margin-top:40px">

    <a href="{{ route('artistas.index') }}"
       class="btn btn-gold">
       Gestionar Artistas
    </a>

    <a href="{{ route('obras.index') }}"
       class="btn btn-outline">
       Gestionar Obras
    </a>

</div>

@endsection