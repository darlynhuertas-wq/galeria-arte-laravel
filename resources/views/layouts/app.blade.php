<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Galería de Arte de Lujo')</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">

    <style>
        /* Variables de Identidad de Marca */
        :root {
            --primary: #0f172a;        /* Negro Carbono Profundo */
            --gold: #d4af37;           /* Dorado de Alta Curaduría */
            --gold-hover: #aa8416;     /* Dorado Oscuro Interactivo */
            --bg-app: #f8fafc;         /* Fondo Gris Minimalista */
            --text-dark: #1e293b;      /* Texto de Lectura Principal */
            --text-muted: #64748b;     /* Texto Secundario/Reseñas */
            --border: #edf2f7;         /* Bordes de Separación Finos */
            --success: #15803d;        /* Verde de Confirmación/Ahorro */
            --danger: #ef4444;         /* Rojo de Alertas o Eliminación */
        }

        /* Estilos Generales del Cuerpo */
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: var(--bg-app);
            color: var(--text-dark);
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }

        /* Contenedor Principal Ajustado */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem 1.5rem;
        }

        /* BARRA DE NAVEGACIÓN PREMIUM (Navbar) */
        .navbar {
            background-color: var(--primary);
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }
        .navbar-brand {
            font-family: 'Playfair Display', serif;
            font-size: 1.6rem;
            font-weight: 700;
            color: #ffffff;
            text-decoration: none;
            letter-spacing: 0.5px;
        }
        .navbar-brand span {
            color: var(--gold);
        }
        .navbar-nav {
            display: flex;
            gap: 24px;
            align-items: center;
            list-style: none;
            margin: 0;
            padding: 0;
        }
        .nav-link {
            color: #cbd5e1;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: color 0.2s ease;
            position: relative;
        }
        .nav-link:hover {
            color: var(--gold);
        }
        
        /* Notificación del Carrito (Burbuja Dorada Dinámica) */
        .cart-badge {
            background-color: var(--gold);
            color: var(--primary);
            font-size: 0.75rem;
            font-weight: 700;
            padding: 2px 7px;
            border-radius: 10px;
            margin-left: 5px;
            position: relative;
            top: -1px;
            box-shadow: 0 2px 5px rgba(212,175,55,0.4);
        }

        /* BOTONES UNIVERSALES ESTILIZADOS */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 10px 20px;
            font-size: 0.88rem;
            font-weight: 600;
            border-radius: 6px;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s ease;
            border: 1px solid transparent;
            font-family: 'Montserrat', sans-serif;
        }
        .btn-gold {
            background-color: var(--gold);
            color: var(--primary);
        }
        .btn-gold:hover {
            background-color: var(--gold-hover);
            transform: translateY(-1px);
        }
        .btn-outline {
            background-color: transparent;
            color: var(--gold);
            border-color: var(--gold);
        }
        .btn-outline:hover {
            background-color: var(--gold);
            color: var(--primary);
        }
        .btn-danger-outline {
            background-color: #ffffff;
            color: var(--danger);
            border-color: #fca5a5;
        }
        .btn-danger-outline:hover {
            background-color: var(--danger);
            color: #ffffff;
            border-color: var(--danger);
        }

        /* CONTENEDOR DE TABLAS (Admin y Carrito) */
        .panel-table-container {
            background: #ffffff; 
            border-radius: 12px; 
            border: 1px solid var(--border); 
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.02); 
            overflow: hidden; 
            margin-top: 1.5rem;
        }
        .custom-table {
            width: 100%; 
            border-collapse: collapse; 
            text-align: left; 
            margin: 0;
        }
        .custom-table thead tr {
            background: #f8fafc; 
            border-bottom: 2px solid var(--border);
        }
        .custom-table th {
            padding: 1.2rem 1.5rem; 
            font-size: 0.82rem; 
            font-weight: 700; 
            color: #4a5568; 
            text-transform: uppercase; 
            letter-spacing: 0.5px;
        }
        .custom-table tbody tr {
            border-bottom: 1px solid #f1f5f9; 
            transition: background 0.2s ease;
        }
        .custom-table tbody tr:hover {
            background: #fdfbf7; 
        }
        .custom-table td {
            padding: 1.1rem 1.5rem; 
            vertical-align: middle;
        }

        /* CUADRÍCULA DE LA GALERÍA DE USUARIOS */
        .grid-gallery {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 30px;
            margin-top: 2rem;
        }
        .card-art {
            background: #ffffff;
            border-radius: 12px;
            border: 1px solid var(--border);
            overflow: hidden;
            box-shadow: 0 6px 18px rgba(0,0,0,0.02);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card-art:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 25px rgba(0,0,0,0.05);
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <a href="{{ route('galeria.index') }}" class="navbar-brand">MUSeo<span>VIRTUAL</span></a>
        <ul class="navbar-nav">
            <li><a href="{{ route('galeria.index') }}" class="nav-link">Exposición</a></li>
            <li>
                <a href="{{ route('carrito.ver') }}" class="nav-link">
                    Adquisiciones 🛒
                    @php
                        $itemsSession = session()->get('carrito', []);
                        $count = 0;
                        foreach($itemsSession as $item) {
                            $count += $item['cantidad'];
                        }
                    @endphp
                    @if($count > 0)
                        <span class="cart-badge">{{ $count }}</span>
                    @endif
                </a>
            </li>

            @if(auth()->check() && auth()->user()->rol == 'admin')
                <li style="border-left: 1px solid rgba(255, 255, 255, 0.15); padding-left: 15px; margin-left: 5px;">
                    <a href="{{ route('artistas.index') }}" class="nav-link" style="color: var(--gold);">Maestros</a>
                </li>
                <li>
                    <a href="{{ route('obras.index') }}" class="nav-link" style="color: var(--gold);">Obras Catálogo</a>
                </li>
            @endif
            
            <li>
                <form action="{{ route('logout') }}" method="POST" style="margin:0;">
                    @csrf
                    <button type="submit" class="btn btn-outline" style="padding: 6px 12px; font-size: 0.8rem;">Salir</button>
                </form>
            </li>
        </ul>
    </nav>

    <div class="container">
        @if(session('success'))
            <div style="background: #ecfdf5; color: var(--success); padding: 1rem; border-radius: 6px; border: 1px solid #bbf7d0; margin-bottom: 1.5rem; font-weight: 500; font-size: 0.9rem;">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div style="background: #fef2f2; color: var(--danger); padding: 1rem; border-radius: 6px; border: 1px solid #fca5a5; margin-bottom: 1.5rem; font-weight: 500; font-size: 0.9rem;">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </div>

</body>
</html>