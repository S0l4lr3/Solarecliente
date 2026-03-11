<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S-OLARE - @yield('title')</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #ffffff;
            color: #757575;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        /* Header */
        .header {
            background-color: #798273;
            padding: 1rem 0;
        }
        
        .nav-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo {
            font-size: 2rem;
            font-weight: bold;
            color: #ffffff;
            text-decoration: none;
            letter-spacing: 2px;
        }
        
        .nav-menu {
            display: flex;
            gap: 2rem;
            align-items: center;
        }
        
        .nav-link {
            color: #ffffff;
            text-decoration: none;
            font-weight: 500;
        }
        
        .nav-link:hover {
            color: #50594e;
        }
        
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
        }
        
        .btn-primary {
            background-color: #958174;
            color: #ffffff;
        }
        
        .btn-primary:hover {
            background-color: #798273;
        }
        
        .btn-outline {
            border: 2px solid #958174;
            background: transparent;
            color: #958174;
        }
        
        .btn-outline:hover {
            background-color: #958174;
            color: #ffffff;
        }
        
        /* Footer */
        .footer {
            background-color: #798273;
            color: #ffffff;
            padding: 3rem 0;
            margin-top: 4rem;
        }
        
        /* Cards */
        .product-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 2rem;
            margin: 2rem 0;
        }
        
        .product-card {
            background: #ffffff;
            border: 1px solid #edebe8;
            border-radius: 8px;
            overflow: hidden;
            transition: transform 0.3s;
        }
        
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }
        
        .product-img {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }
        
        .product-body {
            padding: 1.5rem;
        }
        
        .product-title {
            color: #000000;
            font-size: 1.1rem;
            margin-bottom: 0.5rem;
        }
        
        .product-collection {
            color: #958174;
            font-size: 0.9rem;
            text-transform: uppercase;
            margin-bottom: 0.5rem;
        }
        
        .product-price {
            color: #50594e;
            font-size: 1.3rem;
            font-weight: bold;
        }
        
        .section-title {
            color: #000000;
            font-size: 1.8rem;
            margin: 2rem 0 1rem;
        }
        
        .filter-section {
            background-color: #edebe8;
            padding: 2rem;
            border-radius: 8px;
            margin-bottom: 2rem;
        }
        
        .filter-title {
            color: #000000;
            font-weight: bold;
            margin-bottom: 1rem;
        }
        
        .filter-list {
            list-style: none;
        }
        
        .filter-list li {
            margin-bottom: 0.5rem;
        }
        
        .filter-list a {
            color: #757575;
            text-decoration: none;
        }
        
        .filter-list a:hover {
            color: #958174;
        }
        
        .collection-tag {
            background-color: #edebe8;
            color: #50594e;
            padding: 0.2rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            display: inline-block;
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="container nav-bar">
            <!-- CORREGIDO: Rutas directas sin 'cliente.' -->
            <a href="/" class="logo">S-OLARE</a>
            <nav class="nav-menu">
                <a href="/" class="nav-link">Inicio</a>
                <a href="/catalogo" class="nav-link">Catálogo</a>
                <a href="/carrito" class="nav-link">Carrito</a>
                <a href="/login" class="nav-link">Iniciar Sesión</a>
                <a href="/registro" class="btn btn-primary">Registrarse</a>
            </nav>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="footer">
        <div class="container">
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 2rem;">
                <div>
                    <h3 style="color: #ffffff; margin-bottom: 1rem;">S-OLARE</h3>
                    <p style="color: #edebe8;">Diseño y artesanía para tu hogar</p>
                </div>
                <div>
                    <h3 style="color: #ffffff; margin-bottom: 1rem;">Colecciones</h3>
                    <ul style="list-style: none;">
                        <li><a href="/catalogo?coleccion=KULTE" style="color: #edebe8; text-decoration: none;">KULTE</a></li>
                        <li><a href="/catalogo?coleccion=PAM" style="color: #edebe8; text-decoration: none;">PAM</a></li>
                        <li><a href="/catalogo?coleccion=KAMBUL" style="color: #edebe8; text-decoration: none;">KAMBUL</a></li>
                        <li><a href="/catalogo?coleccion=BACALAR" style="color: #edebe8; text-decoration: none;">BACALAR</a></li>
                        <li><a href="/catalogo?coleccion=TULUM" style="color: #edebe8; text-decoration: none;">TULUM</a></li>
                    </ul>
                </div>
                <div>
                    <h3 style="color: #ffffff; margin-bottom: 1rem;">Contacto</h3>
                    <p style="color: #edebe8;">hola@s-olare.mx</p>
                    <p style="color: #edebe8;">(999) 123-4567</p>
                </div>
            </div>
            <hr style="border-color: #edebe8; margin: 2rem 0;">
            <div style="text-align: center; color: #edebe8;">
                © 2024 S-OLARE - Todos los derechos reservados
            </div>
        </div>
    </footer>
</body>
</html>