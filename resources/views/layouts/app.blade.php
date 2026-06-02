<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MUSeoVIRTUAL — Galería de Arte')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,700;0,900;1,400;1,700&family=DM+Sans:wght@300;400;500;600&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
    <style>
        /* ═══════════════════════════════════════════
           TOKENS DE DISEÑO
        ═══════════════════════════════════════════ */
        :root {
            --gold:          #c9a84c;
            --gold-light:    #e8c97a;
            --gold-pale:     #f5e9c4;
            --gold-dark:     #9a7530;
            --gold-dim:      rgba(201,168,76,.12);
            --navy:          #070e1c;
            --navy-2:        #0d1929;
            --navy-3:        #142338;
            --navy-4:        #1c2f47;
            --cream:         #f8f5ef;
            --cream-2:       #f2ede3;
            --white:         #ffffff;
            --text:          #1a1a22;
            --text-2:        #454550;
            --text-3:        #9090a0;
            --border:        rgba(0,0,0,.08);
            --border-gold:   rgba(201,168,76,.22);
            --success:       #166534;
            --danger:        #991b1b;
            --shadow-sm:     0 1px 3px rgba(0,0,0,.06), 0 1px 2px rgba(0,0,0,.04);
            --shadow-md:     0 4px 16px rgba(0,0,0,.08), 0 2px 6px rgba(0,0,0,.04);
            --shadow-lg:     0 12px 40px rgba(0,0,0,.12), 0 4px 12px rgba(0,0,0,.06);
            --shadow-xl:     0 24px 64px rgba(0,0,0,.18), 0 8px 24px rgba(0,0,0,.08);
            --radius:        10px;
            --radius-lg:     16px;
            --radius-xl:     24px;
            --transition:    all .22s cubic-bezier(.4,0,.2,1);
        }

        /* ═══════════════════════════════════════════
           BASE
        ═══════════════════════════════════════════ */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; font-size: 16px; }
        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--cream);
            color: var(--text);
            line-height: 1.65;
            -webkit-font-smoothing: antialiased;
            min-height: 100vh;
        }

        /* ═══════════════════════════════════════════
           BARRA DE ANUNCIO (dorada top)
        ═══════════════════════════════════════════ */
        .announce-bar {
            background: var(--gold);
            color: var(--navy);
            text-align: center;
            font-size: 0.72rem;
            font-weight: 600;
            letter-spacing: 1.8px;
            text-transform: uppercase;
            padding: 7px 20px;
        }

        /* ═══════════════════════════════════════════
           NAVBAR
        ═══════════════════════════════════════════ */
        .navbar {
            background: var(--navy);
            padding: 0 48px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 68px;
            position: sticky;
            top: 0;
            z-index: 200;
            border-bottom: 1px solid var(--border-gold);
            backdrop-filter: blur(20px);
        }
        .navbar::after {
            content: '';
            position: absolute;
            bottom: 0; left: 0; right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--gold), transparent);
            opacity: .3;
        }
        .navbar-brand {
            font-family: 'Playfair Display', serif;
            font-size: 1.45rem;
            font-weight: 700;
            color: #fff;
            text-decoration: none;
            letter-spacing: -.3px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .navbar-brand .brand-dot {
            width: 6px; height: 6px;
            background: var(--gold);
            border-radius: 50%;
            display: inline-block;
        }
        .navbar-brand em { font-style: italic; color: var(--gold-light); font-weight: 400; }
        .navbar-nav {
            display: flex;
            gap: 2px;
            align-items: center;
            list-style: none;
        }
        .nav-link {
            color: rgba(255,255,255,.55);
            text-decoration: none;
            font-size: 0.82rem;
            font-weight: 500;
            padding: 7px 14px;
            border-radius: 7px;
            transition: var(--transition);
            letter-spacing: .2px;
        }
        .nav-link:hover { color: #fff; background: rgba(255,255,255,.07); }
        .nav-link.active { color: var(--gold-light); }
        .nav-sep { width: 1px; height: 18px; background: rgba(255,255,255,.1); margin: 0 8px; }
        .nav-user {
            font-size: 0.75rem;
            color: rgba(255,255,255,.35);
            padding: 0 6px;
            font-weight: 500;
        }
        .cart-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: var(--gold);
            color: var(--navy);
            font-size: 0.6rem;
            font-weight: 700;
            min-width: 17px;
            height: 17px;
            border-radius: 9px;
            padding: 0 4px;
            margin-left: 5px;
            line-height: 1;
        }

        /* ═══════════════════════════════════════════
           HERO DE PÁGINA
        ═══════════════════════════════════════════ */
        .page-hero {
            background: var(--navy-2);
            padding: 72px 48px 60px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .page-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse 800px 400px at 50% 120%, rgba(201,168,76,.07) 0%, transparent 70%),
                url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23c9a84c' fill-opacity='0.025'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
        .page-hero-tag {
            display: inline-block;
            border: 1px solid var(--border-gold);
            color: var(--gold-light);
            font-size: 0.65rem;
            letter-spacing: 3px;
            text-transform: uppercase;
            padding: 5px 18px;
            border-radius: 20px;
            margin-bottom: 22px;
            font-family: 'DM Mono', monospace;
            position: relative;
        }
        .page-hero h1 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2.4rem, 5vw, 3.8rem);
            font-weight: 700;
            color: #fff;
            line-height: 1.1;
            margin: 0 0 16px;
            position: relative;
        }
        .page-hero h1 em {
            font-style: italic;
            color: var(--gold-light);
            font-weight: 400;
        }
        .page-hero p {
            color: rgba(255,255,255,.4);
            font-size: 0.92rem;
            max-width: 500px;
            margin: 0 auto 36px;
            line-height: 1.75;
            position: relative;
        }
        .stats-strip {
            display: inline-flex;
            background: rgba(255,255,255,.04);
            border: 1px solid var(--border-gold);
            border-radius: var(--radius-lg);
            overflow: hidden;
            position: relative;
        }
        .stats-strip-item {
            padding: 14px 28px;
            text-align: center;
            border-right: 1px solid var(--border-gold);
        }
        .stats-strip-item:last-child { border-right: none; }
        .stats-num {
            font-family: 'Playfair Display', serif;
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--gold);
            display: block;
            line-height: 1;
        }
        .stats-lbl {
            font-size: 0.62rem;
            color: rgba(255,255,255,.3);
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-top: 4px;
            display: block;
            font-family: 'DM Mono', monospace;
        }

        /* ═══════════════════════════════════════════
           CONTENEDOR PRINCIPAL
        ═══════════════════════════════════════════ */
        .container {
            max-width: 1240px;
            margin: 0 auto;
            padding: 3rem 48px;
        }

        /* ═══════════════════════════════════════════
           FILTROS
        ═══════════════════════════════════════════ */
        .filters-bar {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 20px 24px;
            margin-bottom: 2rem;
            display: flex;
            gap: 12px;
            align-items: flex-end;
            flex-wrap: wrap;
            box-shadow: var(--shadow-sm);
        }
        .filter-pills {
            display: flex;
            gap: 6px;
            flex-wrap: wrap;
            margin-bottom: 2rem;
        }
        .filter-pill {
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 0.78rem;
            cursor: pointer;
            border: 1px solid var(--border);
            background: var(--white);
            color: var(--text-2);
            transition: var(--transition);
            text-decoration: none;
            font-weight: 500;
        }
        .filter-pill:hover { border-color: var(--gold); color: var(--gold-dark); }
        .filter-pill.active {
            background: var(--navy);
            color: var(--gold-light);
            border-color: var(--navy);
            font-weight: 600;
        }

        /* ═══════════════════════════════════════════
           GRID DE OBRAS
        ═══════════════════════════════════════════ */
        .grid-gallery {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(310px, 1fr));
            gap: 28px;
        }
        .card-art {
            background: var(--white);
            border-radius: var(--radius-lg);
            border: 1px solid var(--border);
            overflow: hidden;
            transition: transform .3s cubic-bezier(.34,1.56,.64,1), box-shadow .3s ease;
            cursor: pointer;
            group: true;
        }
        .card-art:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-xl);
            border-color: transparent;
        }
        .card-img-wrap {
            position: relative;
            height: 255px;
            background: var(--cream-2);
            overflow: hidden;
        }
        .card-img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .6s cubic-bezier(.25,.46,.45,.94);
        }
        .card-art:hover .card-img-wrap img { transform: scale(1.08); }
        .card-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(7,14,28,.75) 0%, rgba(7,14,28,.1) 50%, transparent 100%);
            opacity: 0;
            transition: opacity .35s ease;
        }
        .card-art:hover .card-overlay { opacity: 1; }
        .card-overlay-cta {
            position: absolute;
            bottom: 16px;
            left: 50%;
            transform: translateX(-50%) translateY(8px);
            opacity: 0;
            transition: all .3s ease;
            white-space: nowrap;
        }
        .card-art:hover .card-overlay-cta {
            opacity: 1;
            transform: translateX(-50%) translateY(0);
        }
        .card-style-tag {
            position: absolute;
            top: 14px;
            left: 14px;
            background: rgba(7,14,28,.75);
            backdrop-filter: blur(8px);
            color: var(--gold-light);
            font-size: 0.62rem;
            letter-spacing: 1.8px;
            text-transform: uppercase;
            padding: 4px 11px;
            border-radius: 4px;
            font-family: 'DM Mono', monospace;
            border: 1px solid rgba(201,168,76,.2);
        }
        .card-no-img {
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: var(--text-3);
            gap: 10px;
        }
        .card-no-img-icon {
            width: 60px;
            height: 60px;
            border: 1.5px solid var(--border);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            background: var(--white);
        }
        .card-body { padding: 20px 22px 18px; }
        .card-artist-name {
            font-size: 0.68rem;
            color: var(--gold-dark);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 6px;
            font-family: 'DM Mono', monospace;
        }
        .card-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--text);
            margin: 0 0 4px;
            line-height: 1.25;
        }
        .card-meta {
            font-size: 0.75rem;
            color: var(--text-3);
            margin-bottom: 16px;
        }
        .card-footer-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-top: 1px solid var(--border);
            padding-top: 14px;
        }
        .card-price-lbl {
            font-size: 0.6rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--text-3);
            display: block;
            margin-bottom: 2px;
            font-family: 'DM Mono', monospace;
        }
        .card-price-val {
            font-family: 'Playfair Display', serif;
            font-size: 1.15rem;
            font-weight: 700;
            color: var(--text);
        }
        .card-actions { display: flex; gap: 7px; }

        /* ═══════════════════════════════════════════
           BOTONES
        ═══════════════════════════════════════════ */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 10px 20px;
            font-size: 0.82rem;
            font-weight: 600;
            border-radius: var(--radius);
            cursor: pointer;
            text-decoration: none;
            transition: var(--transition);
            border: 1.5px solid transparent;
            font-family: 'DM Sans', sans-serif;
            letter-spacing: .2px;
            white-space: nowrap;
        }
        .btn-gold {
            background: var(--gold);
            color: var(--navy);
            border-color: var(--gold);
        }
        .btn-gold:hover {
            background: var(--gold-dark);
            border-color: var(--gold-dark);
            color: #fff;
            transform: translateY(-1px);
            box-shadow: 0 4px 14px rgba(201,168,76,.35);
        }
        .btn-navy {
            background: var(--navy);
            color: #fff;
            border-color: var(--navy);
        }
        .btn-navy:hover {
            background: var(--navy-3);
            transform: translateY(-1px);
        }
        .btn-outline {
            background: transparent;
            color: var(--text-2);
            border-color: var(--border);
        }
        .btn-outline:hover {
            border-color: var(--gold);
            color: var(--gold-dark);
            background: var(--gold-dim);
        }
        .btn-danger {
            background: transparent;
            color: var(--danger);
            border-color: rgba(153,27,27,.2);
            font-size: 0.78rem;
            padding: 8px 14px;
        }
        .btn-danger:hover {
            background: var(--danger);
            color: #fff;
            border-color: var(--danger);
        }
        .btn-sm { padding: 7px 13px; font-size: 0.76rem; border-radius: 7px; }
        .btn-lg { padding: 15px 34px; font-size: 0.9rem; border-radius: var(--radius-lg); }
        .btn-full { width: 100%; justify-content: center; }

        /* ═══════════════════════════════════════════
           FORMULARIOS
        ═══════════════════════════════════════════ */
        .form-group { margin-bottom: 1.3rem; }
        .form-label {
            display: block;
            font-size: 0.78rem;
            font-weight: 600;
            color: var(--text-2);
            margin-bottom: 7px;
            text-transform: uppercase;
            letter-spacing: .7px;
        }
        .form-control {
            width: 100%;
            padding: 11px 15px;
            border: 1.5px solid var(--border);
            border-radius: var(--radius);
            font-family: 'DM Sans', sans-serif;
            font-size: 0.9rem;
            color: var(--text);
            background: var(--white);
            transition: border-color .2s, box-shadow .2s;
            -webkit-appearance: none;
        }
        .form-control:focus {
            outline: none;
            border-color: var(--gold);
            box-shadow: 0 0 0 4px rgba(201,168,76,.1);
        }
        .form-control::placeholder { color: var(--text-3); }
        .form-control:disabled { background: var(--cream-2); color: var(--text-3); cursor: not-allowed; }
        textarea.form-control { resize: vertical; min-height: 110px; }
        select.form-control { cursor: pointer; }
        input[type="file"].form-control { padding: 8px 12px; cursor: pointer; }
        .error-msg {
            color: var(--danger);
            font-size: 0.75rem;
            margin-top: 5px;
            display: block;
            font-weight: 500;
        }

        /* ═══════════════════════════════════════════
           ALERTAS
        ═══════════════════════════════════════════ */
        .alert {
            padding: 13px 18px;
            border-radius: var(--radius);
            font-size: 0.85rem;
            font-weight: 500;
            margin-bottom: 1.75rem;
            display: flex;
            align-items: center;
            gap: 10px;
            animation: slideDown .3s ease;
        }
        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-8px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .alert-success {
            background: #f0fdf4;
            color: var(--success);
            border: 1.5px solid #bbf7d0;
        }
        .alert-error {
            background: #fff5f5;
            color: var(--danger);
            border: 1.5px solid #fecaca;
        }

        /* ═══════════════════════════════════════════
           PANELES / TABLAS ADMIN
        ═══════════════════════════════════════════ */
        .panel {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
        }
        .panel-header {
            padding: 20px 28px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: var(--cream);
        }
        .panel-title {
            font-size: 0.88rem;
            font-weight: 600;
            color: var(--text);
        }
        .panel-subtitle {
            font-size: 0.76rem;
            color: var(--text-3);
            margin-top: 2px;
        }
        .custom-table {
            width: 100%;
            border-collapse: collapse;
        }
        .custom-table thead tr { background: var(--cream); }
        .custom-table th {
            padding: 13px 22px;
            font-size: 0.68rem;
            font-weight: 700;
            color: var(--text-3);
            text-transform: uppercase;
            letter-spacing: 1px;
            border-bottom: 1.5px solid var(--border);
            text-align: left;
            font-family: 'DM Mono', monospace;
        }
        .custom-table tbody tr {
            border-bottom: 1px solid rgba(0,0,0,.05);
            transition: background .15s;
        }
        .custom-table tbody tr:last-child { border-bottom: none; }
        .custom-table tbody tr:hover { background: var(--cream); }
        .custom-table td {
            padding: 15px 22px;
            font-size: 0.88rem;
            vertical-align: middle;
        }
        .table-thumb {
            width: 52px;
            height: 40px;
            border-radius: 6px;
            object-fit: cover;
            border: 1px solid var(--border);
        }
        .badge {
            display: inline-block;
            padding: 3px 11px;
            border-radius: 12px;
            font-size: 0.68rem;
            font-weight: 700;
            font-family: 'DM Mono', monospace;
        }
        .badge-gold {
            background: var(--gold-pale);
            color: var(--gold-dark);
            border: 1px solid rgba(201,168,76,.3);
        }
        .badge-navy {
            background: rgba(7,14,28,.07);
            color: var(--navy-3);
        }

        /* ═══════════════════════════════════════════
           DETALLE DE OBRA
        ═══════════════════════════════════════════ */
        .obra-detail-grid {
            display: grid;
            grid-template-columns: 1.1fr 1fr;
            gap: 52px;
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: var(--radius-xl);
            padding: 44px;
            box-shadow: var(--shadow-md);
        }
        .obra-img-frame {
            background: var(--cream-2);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 440px;
            position: relative;
        }
        .obra-img-frame img {
            max-width: 100%;
            max-height: 500px;
            object-fit: contain;
            border-radius: 8px;
        }
        .obra-tag {
            font-size: 0.65rem;
            letter-spacing: 2.5px;
            text-transform: uppercase;
            color: var(--gold-dark);
            font-weight: 700;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
            font-family: 'DM Mono', monospace;
        }
        .obra-tag::before {
            content: '';
            width: 20px;
            height: 1.5px;
            background: var(--gold);
            flex-shrink: 0;
        }
        .obra-titulo {
            font-family: 'Playfair Display', serif;
            font-size: clamp(1.8rem, 3vw, 2.8rem);
            font-weight: 700;
            line-height: 1.1;
            margin: 0 0 8px;
            color: var(--text);
        }
        .obra-artista-block {
            background: linear-gradient(135deg, var(--cream) 0%, var(--gold-pale) 100%);
            border: 1px solid rgba(201,168,76,.25);
            border-left: 3px solid var(--gold);
            border-radius: var(--radius);
            padding: 15px 20px;
            margin: 18px 0 22px;
        }
        .obra-artista-block strong { font-size: 0.95rem; color: var(--text); display: block; }
        .obra-artista-block span { font-size: 0.78rem; color: var(--text-3); margin-top: 2px; display: block; }
        .obra-ficha { margin-bottom: 22px; display: flex; flex-direction: column; gap: 9px; }
        .obra-ficha-item {
            display: flex;
            align-items: baseline;
            gap: 12px;
            font-size: 0.9rem;
            padding: 6px 0;
            border-bottom: 1px solid var(--border);
        }
        .obra-ficha-item:last-child { border-bottom: none; }
        .obra-ficha-key {
            color: var(--text-3);
            min-width: 90px;
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: .7px;
            font-family: 'DM Mono', monospace;
        }
        .obra-ficha-val { color: var(--text); font-weight: 500; }
        .obra-precio-section {
            border-top: 1.5px solid var(--border);
            padding-top: 22px;
            margin-top: 4px;
        }
        .obra-precio-lbl {
            font-size: 0.65rem;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: var(--text-3);
            margin-bottom: 5px;
            font-family: 'DM Mono', monospace;
        }
        .obra-precio-val {
            font-family: 'Playfair Display', serif;
            font-size: 2.8rem;
            font-weight: 700;
            color: var(--navy);
            line-height: 1;
            margin-bottom: 22px;
        }

        /* ═══════════════════════════════════════════
           CARRITO
        ═══════════════════════════════════════════ */
        .carrito-layout {
            display: grid;
            grid-template-columns: 1fr 360px;
            gap: 32px;
            align-items: start;
        }
        .carrito-item {
            display: grid;
            grid-template-columns: 88px 1fr auto;
            gap: 18px;
            align-items: center;
            padding: 20px 24px;
            border-bottom: 1px solid var(--border);
            transition: background .15s;
        }
        .carrito-item:hover { background: var(--cream); }
        .carrito-item:last-child { border-bottom: none; }
        .carrito-item-img {
            width: 88px;
            height: 66px;
            border-radius: 8px;
            object-fit: cover;
            border: 1px solid var(--border);
        }
        .carrito-item-no-img {
            width: 88px;
            height: 66px;
            border-radius: 8px;
            background: var(--cream-2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            border: 1px solid var(--border);
        }
        .qty-control {
            display: inline-flex;
            align-items: center;
            gap: 0;
            border: 1.5px solid var(--border);
            border-radius: 8px;
            overflow: hidden;
            background: var(--white);
        }
        .qty-btn {
            background: none;
            border: none;
            padding: 6px 12px;
            cursor: pointer;
            font-weight: 700;
            font-size: 1rem;
            color: var(--text-2);
            transition: background .15s;
            line-height: 1;
        }
        .qty-btn:hover { background: var(--cream-2); color: var(--text); }
        .qty-val {
            font-weight: 700;
            min-width: 28px;
            text-align: center;
            font-size: 0.88rem;
            border-left: 1px solid var(--border);
            border-right: 1px solid var(--border);
            padding: 6px 0;
        }
        .resumen-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            overflow: hidden;
            position: sticky;
            top: 88px;
            box-shadow: var(--shadow-md);
        }
        .resumen-header {
            background: var(--navy);
            padding: 20px 24px;
            position: relative;
            overflow: hidden;
        }
        .resumen-header::after {
            content: '';
            position: absolute;
            bottom: 0; left: 0; right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--gold), transparent);
            opacity: .4;
        }
        .resumen-header h3 {
            font-family: 'Playfair Display', serif;
            color: #fff;
            font-size: 1.05rem;
            font-weight: 700;
            margin: 0;
        }
        .resumen-body { padding: 22px 24px; }
        .resumen-row {
            display: flex;
            justify-content: space-between;
            font-size: 0.85rem;
            margin-bottom: 10px;
            color: var(--text-2);
        }
        .resumen-total {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            border-top: 1.5px solid var(--border);
            padding-top: 16px;
            margin-top: 6px;
            margin-bottom: 20px;
        }
        .resumen-total-lbl {
            font-size: 0.72rem;
            color: var(--text-3);
            text-transform: uppercase;
            letter-spacing: 1px;
            font-family: 'DM Mono', monospace;
        }
        .resumen-total-val {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--navy);
        }
        .empty-state {
            text-align: center;
            padding: 72px 32px;
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: var(--radius-xl);
            grid-column: 1 / -1;
        }
        .empty-icon {
            width: 76px;
            height: 76px;
            border: 1.5px solid var(--border);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin: 0 auto 20px;
            background: var(--cream-2);
        }
        .empty-state h3 {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 8px;
        }
        .empty-state p { color: var(--text-3); font-size: 0.88rem; }

        /* ═══════════════════════════════════════════
           PERFIL
        ═══════════════════════════════════════════ */
        .perfil-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: var(--radius-xl);
            overflow: hidden;
            box-shadow: var(--shadow-md);
        }
        .perfil-header {
            background: linear-gradient(135deg, var(--navy) 0%, var(--navy-3) 100%);
            padding: 44px 36px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .perfil-header::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse 60% 80% at 50% 120%, rgba(201,168,76,.15) 0%, transparent 70%);
        }
        .perfil-avatar {
            width: 84px;
            height: 84px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--gold) 0%, var(--gold-dark) 100%);
            color: var(--navy);
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 18px;
            border: 3px solid rgba(201,168,76,.4);
            box-shadow: 0 8px 24px rgba(0,0,0,.3);
            position: relative;
        }
        .perfil-name {
            font-family: 'Playfair Display', serif;
            font-size: 1.65rem;
            color: #fff;
            font-weight: 700;
            margin: 0;
            position: relative;
        }
        .perfil-role {
            display: inline-block;
            font-size: 0.65rem;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--gold-light);
            margin-top: 8px;
            border: 1px solid rgba(201,168,76,.3);
            padding: 4px 14px;
            border-radius: 20px;
            font-family: 'DM Mono', monospace;
            position: relative;
        }
        .perfil-body { padding: 32px 36px; }

        /* ═══════════════════════════════════════════
           FORMULARIOS ADMIN (paneles)
        ═══════════════════════════════════════════ */
        .form-panel {
            background: var(--white);
            padding: 40px;
            border-radius: var(--radius-xl);
            border: 1px solid var(--border);
            max-width: 700px;
            margin: 0 auto;
            box-shadow: var(--shadow-md);
        }
        .form-panel-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.7rem;
            font-weight: 700;
            margin: 0 0 8px;
            padding-bottom: 20px;
            border-bottom: 1.5px solid var(--border);
            margin-bottom: 28px;
        }
        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 0.8rem;
            color: var(--text-3);
            text-decoration: none;
            margin-bottom: 28px;
            font-weight: 500;
            transition: color .2s;
        }
        .back-link:hover { color: var(--gold-dark); }

        /* ═══════════════════════════════════════════
           PAGE TITLE (admin pages sin hero)
        ═══════════════════════════════════════════ */
        .page-title-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }
        .page-title {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 700;
            margin: 0 0 4px;
        }
        .page-subtitle {
            font-size: 0.82rem;
            color: var(--text-3);
            margin: 0;
        }

        /* ═══════════════════════════════════════════
           SECCIÓN BIO (detalle obra)
        ═══════════════════════════════════════════ */
        .bio-section {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 32px 36px;
            margin-top: 28px;
            box-shadow: var(--shadow-sm);
        }
        .bio-section-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.2rem;
            font-weight: 700;
            margin: 0 0 14px;
            padding-bottom: 14px;
            border-bottom: 1px solid var(--border);
        }

        /* ═══════════════════════════════════════════
           MODAL CONFIRMACIÓN
        ═══════════════════════════════════════════ */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(7,14,28,.6);
            backdrop-filter: blur(6px);
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: fadeIn .25s ease;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .modal-card {
            background: var(--white);
            border-radius: var(--radius-xl);
            padding: 44px 40px;
            max-width: 460px;
            width: 92%;
            text-align: center;
            box-shadow: var(--shadow-xl);
            animation: scaleIn .3s cubic-bezier(.34,1.56,.64,1);
        }
        @keyframes scaleIn {
            from { opacity: 0; transform: scale(.92); }
            to { opacity: 1; transform: scale(1); }
        }
        .modal-icon {
            width: 76px;
            height: 76px;
            background: #f0fdf4;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
            font-size: 2.2rem;
        }
        .modal-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.7rem;
            font-weight: 700;
            margin: 0 0 8px;
            color: var(--text);
        }
        .modal-sub {
            color: var(--text-3);
            font-size: 0.9rem;
            line-height: 1.65;
            margin-bottom: 22px;
        }
        .modal-total {
            background: #f0fdf4;
            border: 1.5px solid #bbf7d0;
            border-radius: var(--radius);
            padding: 12px 20px;
            margin-bottom: 24px;
            color: var(--success);
            font-weight: 700;
            font-size: 0.9rem;
        }

        /* ═══════════════════════════════════════════
           FOOTER
        ═══════════════════════════════════════════ */
        .footer {
            background: var(--navy);
            border-top: 1px solid var(--border-gold);
            padding: 36px 48px;
            text-align: center;
            margin-top: 80px;
            position: relative;
        }
        .footer::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--gold), transparent);
            opacity: .3;
        }
        .footer-brand {
            font-family: 'Playfair Display', serif;
            font-size: 1.15rem;
            color: #fff;
            margin-bottom: 6px;
            font-weight: 700;
        }
        .footer-brand em { font-style: italic; color: var(--gold); font-weight: 400; }
        .footer p { font-size: 0.72rem; color: rgba(255,255,255,.2); margin: 0; font-family: 'DM Mono', monospace; }

        /* ═══════════════════════════════════════════
           RESPONSIVE
        ═══════════════════════════════════════════ */
        @media (max-width: 900px) {
            .obra-detail-grid { grid-template-columns: 1fr; gap: 28px; padding: 28px; }
            .carrito-layout { grid-template-columns: 1fr; }
            .grid-gallery { grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 20px; }
            .navbar { padding: 0 20px; }
            .container { padding: 2rem 20px; }
            .page-hero { padding: 52px 24px 44px; }
            .form-panel { padding: 28px 24px; }
            .perfil-body { padding: 24px; }
        }
        @media (max-width: 600px) {
            .grid-gallery { grid-template-columns: 1fr; }
            .stats-strip { flex-direction: column; }
            .page-title-row { flex-direction: column; align-items: flex-start; gap: 12px; }
        }
    </style>
</head>
<body>

<div class="announce-bar">✦ Colección Permanente — Obras maestras disponibles para adquisición ✦</div>

<nav class="navbar">
    @if(auth()->check() && auth()->user()->rol === 'admin')
        <a href="{{ route('artistas.index') }}" class="navbar-brand">
            <span class="brand-dot"></span>
            Museo<em>Virtual</em>
        </a>
    @else
        <a href="{{ route('galeria.index') }}" class="navbar-brand">
            <span class="brand-dot"></span>
            Museo<em>Virtual</em>
        </a>
    @endif
    <ul class="navbar-nav">
        @if(auth()->check() && auth()->user()->rol === 'admin')
            <li><a href="{{ route('artistas.index') }}" class="nav-link">Artistas</a></li>
            <li><a href="{{ route('obras.index') }}" class="nav-link">Obras</a></li>
        @elseif(auth()->check())
            <li><a href="{{ route('galeria.index') }}" class="nav-link">Exposición</a></li>
            <li>
                <a href="{{ route('carrito.ver') }}" class="nav-link">
                    Carrito
                    @php
                        $itemsSession = session()->get('carrito', []);
                        $cartCount = array_sum(array_column($itemsSession, 'cantidad'));
                    @endphp
                    @if($cartCount > 0)<span class="cart-badge">{{ $cartCount }}</span>@endif
                </a>
                <li>
                    <a href="{{ route('mis-compras') }}" class="nav-link">
                        Mis Compras
                    </a>
                 </li>
            </li>
        @endif
        @auth
            <li class="nav-sep"></li>
            <li class="nav-user">{{ auth()->user()->name }}</li>
            <li><a href="{{ route('perfil.index') }}" class="nav-link">Mi Perfil</a></li>
            <li>
                <form action="{{ route('logout') }}" method="POST" style="margin:0">
                    @csrf
                    <button type="submit" class="btn btn-outline btn-sm">Salir</button>
                </form>
            </li>
        @endauth
    </ul>
</nav>

@yield('hero')

<div class="container">
    @if(session('success'))
        <div class="alert alert-success">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor"><path d="M8 0a8 8 0 110 16A8 8 0 018 0zm3.78 4.22a.75.75 0 00-1.06 0L7 7.94 5.28 6.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.06 0l4.25-4.25a.75.75 0 000-1.06z"/></svg>
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-error">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor"><path d="M8 0a8 8 0 110 16A8 8 0 018 0zm-.75 4.25a.75.75 0 011.5 0v4.5a.75.75 0 01-1.5 0v-4.5zm.75 7.25a1 1 0 110-2 1 1 0 010 2z"/></svg>
            {{ session('error') }}
        </div>
    @endif
    @yield('content')
</div>

<footer class="footer">
    <div class="footer-brand">Museo<em>Virtual</em></div>
    <p>© {{ date('Y') }} — Galería de Arte Digital &nbsp;·&nbsp; Todos los derechos reservados</p>
</footer>

</body>
</html>