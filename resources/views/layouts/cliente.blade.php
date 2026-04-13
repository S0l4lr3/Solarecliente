<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SOLARE | @yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}"> 
    {{-- Tipografía Playfair Display y Inter --}}
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --color-sage-green: #798273;
            --color-dark-moss: #50594e;
            --color-clay-brown: #958174;
            --color-sand-beige: #edebe8;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #ffffff;
            color: #333333;
        }

        .serif { font-family: 'Playfair Display', serif; }

        .container {
            max-width: 1500px; /* Aumentado de 1200px para que se vea más ancho */
            margin: 0 auto;
            padding: 0 40px; /* Más padding lateral para que no pegue a las orillas */
        }

        /* Header Corporativo */
        .header {
            background-color: #ffffff;
            padding: 1.5rem 0;
            border-bottom: 1px solid var(--color-sand-beige);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .nav-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-family: 'Playfair Display', serif;
            font-size: 2.2rem;
            color: var(--color-dark-moss);
            text-decoration: none;
            letter-spacing: 6px;
        }

        .nav-menu {
            display: flex;
            gap: 3.5rem; /* Espaciado amplio como la imagen */
            align-items: center;
        }

        .nav-link {
            color: var(--color-dark-moss);
            text-decoration: none;
            font-weight: 600;
            font-size: 18px; /* Tamaño solicitado */
            text-transform: uppercase;
            letter-spacing: 2px;
            transition: color 0.3s;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .nav-link:hover {
            color: var(--color-clay-brown);
        }

        /* Dropdown Estilo */
        .user-dropdown {
            position: relative;
            display: inline-block;
        }

        .user-dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            background-color: #ffffff;
            min-width: 220px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.1);
            z-index: 1000;
            border-radius: 8px;
            margin-top: 15px;
            overflow: hidden;
            border: 1px solid var(--color-sand-beige);
        }

        .user-dropdown-content.show {
            display: block;
        }

        .user-dropdown-content a {
            color: var(--color-dark-moss);
            padding: 16px 24px;
            text-decoration: none;
            display: block;
            font-size: 16px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            text-align: left;
            transition: all 0.2s;
            border-bottom: 1px solid var(--color-sand-beige);
        }

        .user-dropdown-content a:hover {
            background-color: var(--color-sand-beige);
            color: var(--color-clay-brown);
        }

        .btn-logout {
            background: none;
            border: none;
            cursor: pointer;
            padding: 0;
            font-family: inherit;
        }

        /* Footer Solare */
        .footer {
            background-color: var(--color-dark-moss);
            color: #ffffff;
            padding: 4rem 0;
            margin-top: 6rem;
        }

        /* Cards de Muebles */
        .product-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 2.5rem;
            margin: 2rem 0;
        }

        .product-card {
            background: #ffffff;
            transition: all 0.4s ease;
        }

        .product-card:hover {
            transform: translateY(-8px);
        }

        .product-img {
            width: 100%;
            height: 350px;
            object-fit: cover;
            object-position: center;
            background-color: var(--color-sand-beige);
            display: block;
        }

        .product-body {
            padding: 1.5rem 0;
            text-align: center;
        }

        .product-title {
            font-family: 'Playfair Display', serif;
            color: #000000;
            font-size: 1.2rem;
            margin-bottom: 0.4rem;
        }

        .product-collection {
            color: var(--color-clay-brown);
            font-size: 9px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 0.6rem;
        }

        .product-price {
            color: #333333;
            font-size: 1rem;
            font-weight: 600;
        }

        /* Botones Base */
        .btn {
            width: 100%; /* Ahora ocupan todo el ancho disponible */
            padding: 16px 30px; /* Un poco más de altura también */
            cursor: pointer;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size: 12px;
            transition: all 0.3s;
            border: none;
            text-align: center;
        }

        .btn-primary {
            background-color: #958174; /* Color Marrón Arcilla exacto */
            color: #ffffff;
        }

        .btn-primary:hover {
            background-color: #50594e; /* Verde Musgo oscuro para el hover */
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="container nav-bar">
            <a href="/" class="logo serif">SOLARE</a>
            <nav class="nav-menu">
                <a href="/" class="nav-link">Inicio</a>
                
                <a href="/carrito" class="nav-link" style="position: relative;">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 38px; height: 38px;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                    </svg>
                    @if(session('cart') && count(session('cart')) > 0)
                        <span style="background: var(--color-clay-brown); color: white; border-radius: 50%; width: 22px; height: 22px; display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: bold; position: absolute; top: -5px; right: -10px; border: 2px solid white;">
                            {{ count(session('cart')) }}
                        </span>
                    @endif
                </a>

                @if(session('token'))
                    <div class="user-dropdown">
                        <a href="javascript:void(0)" class="nav-link" id="userMenuBtn">
                            {{ session('user.nombre') }}
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                            </svg>
                        </a>
                        <div class="user-dropdown-content" id="userDropdown">
                            <a href="{{ route('cliente.perfil') }}">Mi Perfil</a>
                            <a href="{{ route('cliente.pedidos') }}">Mis Pedidos</a>
                        </div>
                    </div>
                    <form action="{{ route('logout') }}" method="POST" style="display:inline">
                        @csrf
                        <button type="submit" class="nav-link btn-logout">Salir</button>
                    </form>
                @else
                    <a href="/login" class="nav-link">Entrar</a>
                    <a href="/registro" class="nav-link" style="color: var(--color-clay-brown); border-bottom: 2px solid var(--color-clay-brown); padding-bottom: 2px;">Regístrate</a>
                @endif
            </nav>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="footer">
        <div class="container">
            <div style="display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 4rem;">
                <div>
                    <h3 class="serif" style="font-size: 1.5rem; letter-spacing: 4px; margin-bottom: 1.5rem; font-weight: 400;">SOLARE</h3>
                    <p style="font-size: 12px; line-height: 1.8; opacity: 0.6; max-width: 300px;">Diseño y fabricación de mobiliario artesanal de alta gama para espacios exteriores.</p>
                </div>
                <div>
                    <h4 class="serif" style="margin-bottom: 1.5rem; font-size: 14px;">Explorar</h4>
                    <ul style="list-style: none; font-size: 10px; text-transform: uppercase; letter-spacing: 1px; line-height: 2.5;">
                        <li><a href="{{ route('aviso.privacidad') }}" style="color: white; opacity: 0.6; text-decoration: none;">Aviso de Privacidad</a></li>
                    </ul>
                </div>
            </div>
            <div>
                <h4 class="serif" style="margin-bottom: 0.8rem; font-size: 12px;">Contacto</h4>
                <p style="font-size: 10px; opacity: 0.6; margin-bottom: 5px;">aclariciones@solaremuebles.mx</p>
                <p style="font-size: 10px; opacity: 0.6;">Tlajomulco, México</p>
            </div>
        </div>

        <div style="border-top: 1px solid rgba(255,255,255,0.1); margin-top: 2rem; padding-top: 1rem; text-align: center; font-size: 9px; opacity: 0.4; letter-spacing: 2px; text-transform: uppercase;">
            © 2026 SOLARE — MUEBLES DE EXTERIOR
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuBtn = document.getElementById('userMenuBtn');
            const dropdown = document.getElementById('userDropdown');

            if (menuBtn && dropdown) {
                menuBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    dropdown.classList.toggle('show');
                });

                document.addEventListener('click', function(e) {
                    if (!dropdown.contains(e.target) && !menuBtn.contains(e.target)) {
                        dropdown.classList.remove('show');
                    }
                });
            }
        });
    </script>
</body>
</html>