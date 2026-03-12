<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SOLARE | @yield('title')</title>
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
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        /* Header Corporativo */
        .header {
            background-color: #ffffff;
            padding: 1.5rem 0;
            border-bottom: 1px solid var(--color-sand-beige);
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
            gap: 3rem;
            align-items: center;
        }
        
        .nav-link {
            color: var(--color-dark-moss);
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 2px;
            transition: color 0.3s;
        }
        
        .nav-link:hover {
            color: var(--color-clay-brown);
        }
        
        .btn {
            padding: 14px 30px;
            cursor: pointer;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size: 12px;
            transition: all 0.3s;
        }
        
        .btn-primary {
            background-color: var(--color-clay-brown);
            color: #ffffff;
        }
        
        .btn-primary:hover {
            background-color: var(--color-dark-moss);
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
        
        .filter-section {
            margin-bottom: 3rem;
        }
        
        .filter-title {
            font-family: 'Playfair Display', serif;
            font-size: 14px;
            color: #000000;
            letter-spacing: 1px;
            margin-bottom: 1.5rem;
            border-bottom: 1px solid var(--color-sand-beige);
            padding-bottom: 0.5rem;
        }
        
        .filter-list {
            list-style: none;
        }
        
        .filter-list li {
            margin-bottom: 0.8rem;
        }
        
        .filter-list a {
            color: #888;
            text-decoration: none;
            font-size: 10px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: color 0.3s;
        }
        
        .filter-list a:hover {
            color: var(--color-clay-brown);
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="container nav-bar">
            <a href="/" class="logo serif" style="letter-spacing: 4px; font-weight: 400;">SOLARE</a>
            <nav class="nav-menu">
                <a href="/" class="nav-link">Inicio</a>
                <a href="/catalogo" class="nav-link">Colecciones</a>
                <a href="/carrito" class="nav-link" style="position: relative; display: flex; align-items: center; padding: 10px;">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 48px; height: 48px;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                    </svg>
                    @if(session('cart') && count(session('cart')) > 0)
                        <span style="background: var(--color-clay-brown); color: white; border-radius: 50%; width: 22px; height: 22px; display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: bold; position: absolute; top: 5px; right: 0px; border: 2px solid white;">
                            {{ count(session('cart')) }}
                        </span>
                    @endif
                </a>
                @if(session('cliente_token'))
                    <span class="nav-link" style="color: var(--color-clay-brown)">{{ session('cliente_data.nombre') }}</span>
                    <form action="{{ route('logout') }}" method="POST" style="display:inline">
                        @csrf
                        <button type="submit" class="nav-link" style="background:none; border:none; cursor:pointer">Salir</button>
                    </form>
                @else
                    <a href="/login" class="nav-link">Entrar</a>
                    <a href="/registro" class="btn btn-primary">Solicitar Acceso</a>
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
                        <li><a href="/catalogo" style="color: white; opacity: 0.6; text-decoration: none;">Ver Catálogo</a></li>
                        <li><a href="/registro" style="color: white; opacity: 0.6; text-decoration: none;">Nueva Cuenta</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="serif" style="margin-bottom: 1.5rem; font-size: 14px;">Contacto</h4>
                    <p style="font-size: 11px; opacity: 0.6; margin-bottom: 10px;">hola@solaremuebles.mx</p>
                    <p style="font-size: 11px; opacity: 0.6;">Mérida, Yucatán, México</p>
                </div>
            </div>
            <div style="border-top: 1px solid rgba(255,255,255,0.1); margin-top: 4rem; padding-top: 2rem; text-align: center; font-size: 10px; opacity: 0.4; letter-spacing: 2px; text-transform: uppercase;">
                © 2026 SOLARE — MUEBLES DE EXTERIOR
            </div>
        </div>
    </footer>
</body>
</html>
