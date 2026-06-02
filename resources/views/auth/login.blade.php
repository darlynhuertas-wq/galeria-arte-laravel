<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso — MUSeoVIRTUAL</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400;1,700&family=DM+Sans:wght@300;400;500;600&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
    <style>
        :root {
            --gold:        #c9a84c;
            --gold-light:  #e8c97a;
            --gold-pale:   rgba(201,168,76,.12);
            --gold-border: rgba(201,168,76,.25);
            --navy:        #070e1c;
            --navy-2:      #0d1929;
            --navy-3:      #142338;
            --cream:       #f8f5ef;
            --text:        #1a1a22;
            --text-2:      #454550;
            --text-3:      #9090a0;
            --border:      rgba(0,0,0,.09);
            --danger:      #991b1b;
        }
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'DM Sans', sans-serif;
            min-height: 100vh;
            display: grid;
            grid-template-columns: 1fr 1fr;
            -webkit-font-smoothing: antialiased;
            overflow: hidden;
        }

        /* Panel izquierdo decorativo */
        .art-panel {
            background: var(--navy);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 60px;
            position: relative;
            overflow: hidden;
        }
        .art-panel::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse 70% 60% at 30% 80%, rgba(201,168,76,.12) 0%, transparent 60%),
                radial-gradient(ellipse 50% 40% at 80% 20%, rgba(201,168,76,.06) 0%, transparent 55%);
        }
        .art-panel-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            width: 100%;
            max-width: 360px;
            margin-bottom: 48px;
            position: relative;
        }
        .art-tile {
            aspect-ratio: 1;
            border-radius: 8px;
            background: rgba(255,255,255,.04);
            border: 1px solid rgba(255,255,255,.06);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            transition: all .3s ease;
            animation: pulse 3s ease-in-out infinite;
        }
        .art-tile:nth-child(2) { animation-delay: .3s; }
        .art-tile:nth-child(3) { animation-delay: .6s; }
        .art-tile:nth-child(4) { animation-delay: .9s; }
        .art-tile:nth-child(5) { animation-delay: 1.2s; background: var(--gold-pale); border-color: var(--gold-border); }
        .art-tile:nth-child(6) { animation-delay: 1.5s; }
        .art-tile:nth-child(7) { animation-delay: 1.8s; }
        .art-tile:nth-child(8) { animation-delay: 2.1s; }
        .art-tile:nth-child(9) { animation-delay: 2.4s; }
        @keyframes pulse {
            0%, 100% { opacity: .4; }
            50% { opacity: .8; }
        }
        .art-panel-quote {
            text-align: center;
            position: relative;
        }
        .art-panel-quote blockquote {
            font-family: 'Playfair Display', serif;
            font-size: 1.35rem;
            font-style: italic;
            color: rgba(255,255,255,.75);
            line-height: 1.55;
            margin: 0 0 14px;
        }
        .art-panel-quote cite {
            font-size: 0.68rem;
            color: rgba(201,168,76,.7);
            letter-spacing: 2px;
            text-transform: uppercase;
            font-family: 'DM Mono', monospace;
            font-style: normal;
        }
        .art-panel-divider {
            width: 40px;
            height: 1.5px;
            background: var(--gold);
            margin: 16px auto;
            opacity: .5;
        }

        /* Panel derecho — formulario */
        .login-panel {
            background: var(--cream);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 60px 56px;
            overflow-y: auto;
        }
        .login-wrap { width: 100%; max-width: 400px; }
        .login-logo {
            font-family: 'Playfair Display', serif;
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--navy);
            margin-bottom: 6px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .login-logo em { font-style: italic; font-weight: 400; color: var(--gold); }
        .login-logo-dot {
            width: 7px; height: 7px;
            background: var(--gold);
            border-radius: 50%;
        }
        .login-tagline {
            font-size: 0.7rem;
            color: var(--text-3);
            letter-spacing: 2px;
            text-transform: uppercase;
            font-family: 'DM Mono', monospace;
            margin-bottom: 48px;
        }
        .login-heading {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 6px;
            line-height: 1.1;
        }
        .login-heading em { font-style: italic; font-weight: 400; color: var(--navy-3); }
        .login-sub {
            font-size: 0.85rem;
            color: var(--text-3);
            margin-bottom: 32px;
        }
        .alert-error {
            background: #fff5f5;
            color: var(--danger);
            border: 1.5px solid #fecaca;
            padding: 11px 16px;
            border-radius: 9px;
            font-size: 0.82rem;
            margin-bottom: 22px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .form-group { margin-bottom: 20px; }
        .form-label {
            display: block;
            font-size: 0.72rem;
            font-weight: 700;
            color: var(--text-2);
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: .9px;
        }
        .form-control {
            width: 100%;
            padding: 12px 16px;
            border: 1.5px solid rgba(0,0,0,.1);
            border-radius: 10px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.92rem;
            color: var(--text);
            background: #fff;
            transition: border-color .2s, box-shadow .2s;
        }
        .form-control:focus {
            outline: none;
            border-color: var(--gold);
            box-shadow: 0 0 0 4px rgba(201,168,76,.1);
        }
        .form-control::placeholder { color: var(--text-3); }
        .error-msg { color: var(--danger); font-size: 0.74rem; margin-top: 5px; display: block; font-weight: 500; }
        .btn-login {
            width: 100%;
            padding: 14px;
            background: var(--navy);
            color: #fff;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.88rem;
            font-weight: 600;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: all .22s ease;
            letter-spacing: .3px;
            margin-top: 8px;
        }
        .btn-login:hover {
            background: var(--navy-3);
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(7,14,28,.25);
        }
        .demo-section {
            margin-top: 36px;
            padding-top: 24px;
            border-top: 1.5px solid rgba(0,0,0,.07);
        }
        .demo-label {
            font-size: 0.63rem;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--text-3);
            font-family: 'DM Mono', monospace;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .demo-label::before, .demo-label::after {
            content: '';
            flex: 1;
            height: 1px;
            background: rgba(0,0,0,.08);
        }
        .demo-creds {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
        .demo-cred-item {
            background: #fff;
            border: 1px solid rgba(0,0,0,.07);
            border-radius: 8px;
            padding: 10px 14px;
            font-size: 0.78rem;
            color: var(--text-2);
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .demo-cred-role {
            background: var(--gold-pale);
            color: #8a6520;
            border-radius: 4px;
            padding: 2px 8px;
            font-size: 0.65rem;
            font-weight: 700;
            text-transform: uppercase;
            font-family: 'DM Mono', monospace;
            flex-shrink: 0;
        }

        @media (max-width: 768px) {
            body { grid-template-columns: 1fr; }
            .art-panel { display: none; }
            .login-panel { padding: 40px 28px; }
        }
    </style>
</head>
<body>

<!-- Panel izquierdo decorativo -->
<div class="art-panel">
    <div class="art-panel-grid">
        <div class="art-tile">🎨</div>
        <div class="art-tile">🖼</div>
        <div class="art-tile">✦</div>
        <div class="art-tile">◈</div>
        <div class="art-tile">🖌</div>
        <div class="art-tile">◈</div>
        <div class="art-tile">✦</div>
        <div class="art-tile">🏛</div>
        <div class="art-tile">🎭</div>
    </div>
    <div class="art-panel-quote">
        <blockquote>"El arte es la mentira que nos permite comprender la verdad."</blockquote>
        <div class="art-panel-divider"></div>
        <cite>Pablo Picasso</cite>
    </div>
</div>

<!-- Panel derecho: login -->
<div class="login-panel">
    <div class="login-wrap">
        <div class="login-logo">
            <span class="login-logo-dot"></span>
            Museo<em>Virtual</em>
        </div>
        <p class="login-tagline">Galería de Arte Digital</p>

        <h1 class="login-heading">Bienvenido<br><em>de vuelta</em></h1>
        <p class="login-sub">Ingresa tus credenciales para acceder a la galería.</p>

        @if($errors->any())
            <div class="alert-error">
                <svg width="15" height="15" viewBox="0 0 15 15" fill="currentColor"><path d="M7.5 0a7.5 7.5 0 110 15A7.5 7.5 0 017.5 0zm-.75 4a.75.75 0 011.5 0v4a.75.75 0 01-1.5 0V4zm.75 7a1 1 0 110-2 1 1 0 010 2z"/></svg>
                Credenciales incorrectas. Verifica e intenta de nuevo.
            </div>
        @endif

        <form action="{{ route('login.procesar') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label">Correo electrónico</label>
                <input type="email" name="email" class="form-control"
                       value="{{ old('email') }}" placeholder="tu@correo.com" autofocus>
                @error('email')<span class="error-msg">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label class="form-label">Contraseña</label>
                <input type="password" name="password" class="form-control" placeholder="••••••••">
                @error('password')<span class="error-msg">{{ $message }}</span>@enderror
            </div>
            <button type="submit" class="btn-login">Ingresar a la galería →</button>
        </form>

        <div class="demo-section">
            <div class="demo-label">Cuentas de demostración</div>
            <div class="demo-creds">
                <div class="demo-cred-item">
                    <span class="demo-cred-role">Admin</span>
                    admin@galeria.com &nbsp;/&nbsp; admin123
                </div>
                <div class="demo-cred-item">
                    <span class="demo-cred-role">Usuario</span>
                    juan@gmail.com &nbsp;/&nbsp; user123
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>