<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso Denegado — MUSeoVIRTUAL</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,400&family=DM+Sans:wght@400;500;600&family=DM+Mono:wght@400&display=swap" rel="stylesheet">
    <style>
        :root {
            --gold: #c9a84c;
            --navy: #070e1c;
            --navy-3: #142338;
            --cream: #f8f5ef;
            --text: #1a1a22;
            --text-3: #9090a0;
        }
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--navy);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
            -webkit-font-smoothing: antialiased;
        }
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background: radial-gradient(ellipse 80% 60% at 50% 100%, rgba(201,168,76,.08) 0%, transparent 60%);
            pointer-events: none;
        }
        .box {
            background: var(--cream);
            border-radius: 20px;
            padding: 52px 44px;
            max-width: 460px;
            width: 100%;
            text-align: center;
            box-shadow: 0 32px 80px rgba(0,0,0,.5);
        }
        .error-num {
            font-family: 'Playfair Display', serif;
            font-size: 6rem;
            font-weight: 700;
            color: var(--navy);
            line-height: 1;
            opacity: .06;
            margin-bottom: -24px;
        }
        .icon {
            font-size: 3rem;
            margin-bottom: 20px;
            display: block;
        }
        h1 {
            font-family: 'Playfair Display', serif;
            font-size: 1.9rem;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 12px;
        }
        p {
            color: var(--text-3);
            font-size: 0.9rem;
            line-height: 1.7;
            margin-bottom: 32px;
        }
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 12px 28px;
            background: var(--navy);
            color: #fff;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.86rem;
            transition: all .22s ease;
        }
        .btn:hover {
            background: var(--navy-3);
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(7,14,28,.25);
        }
        .code-tag {
            font-family: 'DM Mono', monospace;
            font-size: 0.65rem;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--gold);
            display: block;
            margin-bottom: 16px;
        }
    </style>
</head>
<body>
    <div class="box">
        <div class="error-num">403</div>
        <span class="icon">🔒</span>
        <span class="code-tag">Error 403 — Acceso Denegado</span>
        <h1>Zona <em style="font-style:italic;font-weight:400">restringida</em></h1>
        <p>No tienes permisos para acceder a esta sección.<br>Si crees que es un error, comunícate con el administrador de la galería.</p>
        <a href="{{ url('/') }}" class="btn">← Volver al inicio</a>
    </div>
</body>
</html>