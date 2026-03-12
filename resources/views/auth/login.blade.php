<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SOLARE | Iniciar Sesión</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #edebe8; margin: 0; }
        .serif { font-family: 'Playfair Display', serif; }
        .text-solare-arcilla { color: #958174; }
        .bg-solare-musgo { background-color: #50594e; }
        .bg-solare-arcilla { background-color: #958174; }
        .border-solare-arcilla { border-color: #958174; }
    </style>
</head>
<body class="antialiased">

<div class="flex min-h-screen flex-col lg:flex-row">
    {{-- Panel de Marca Lateral (Lado Izquierdo en Login) --}}
    <div class="flex-1 bg-gradient-to-br from-[#50594e] via-[#798273] to-[#958174] p-12 flex flex-col justify-between relative overflow-hidden text-white">
        <div class="z-10">
            <a href="/" style="text-decoration: none; color: inherit;">
                <span class="serif text-3xl tracking-[4px]">SOLARE</span>
            </a>
            <p class="text-[8px] tracking-[3px] opacity-40 uppercase">Muebles de Exterior</p>
        </div>
        <div class="z-10">
            <h2 class="serif text-5xl font-light leading-tight mb-4">Diseñado para <br> vivir afuera.</h2>
            <p class="text-white/50 text-sm max-w-xs leading-relaxed">Accede a tu cuenta para gestionar tus pedidos y ver colecciones exclusivas.</p>
        </div>
        <p class="z-10 text-[10px] opacity-30">© 2026 Solare — Muebles de Exterior</p>
        <div class="absolute -top-20 -right-20 w-80 h-80 rounded-full border border-white/5"></div>
    </div>

    {{-- Formulario de Inicio de Sesión --}}
    <div class="w-full lg:w-[480px] bg-white p-12 flex flex-col justify-center">
        <div class="mb-10 text-center lg:text-left">
            <span class="text-[10px] font-bold tracking-[2.5px] uppercase text-solare-arcilla">Bienvenido de nuevo</span>
            <h1 class="serif text-3xl text-gray-900 mt-1">Iniciar sesión</h1>
        </div>
        
        @if($errors->any())
            <div class="bg-red-50 border-l-4 border-solare-arcilla p-4 mb-6">
                <p class="text-[10px] uppercase tracking-widest font-bold text-solare-arcilla">
                    {{ $errors->first() }}
                </p>
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label class="block text-[9px] font-bold uppercase text-gray-400 tracking-widest mb-2">Correo electrónico</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                    class="w-full bg-gray-50 border-b-2 border-gray-200 focus:border-solare-arcilla border-x-0 border-t-0 text-sm p-3 outline-none transition" 
                    placeholder="cliente@solare.mx">
            </div>
            <div>
                <label class="block text-[9px] font-bold uppercase text-gray-400 tracking-widest mb-2">Contraseña</label>
                <input type="password" name="password" required
                    class="w-full bg-gray-50 border-b-2 border-gray-200 focus:border-solare-arcilla border-x-0 border-t-0 text-sm p-3 outline-none transition" 
                    placeholder="••••••••">
            </div>
            <button type="submit" 
                class="w-full bg-solare-arcilla text-white py-4 text-xs font-bold uppercase tracking-widest hover:bg-solare-musgo transition shadow-lg shadow-solare-arcilla/20">
                Entrar al sistema
            </button>
        </form>

        <div class="mt-12 pt-8 border-t border-gray-100 text-center">
            <p class="text-[10px] uppercase tracking-widest text-gray-400">
                ¿No tienes cuenta? 
                <a href="{{ route('registro') }}" class="text-solare-arcilla font-bold hover:underline">Solicitar Acceso</a>
            </p>
        </div>
    </div>
</div>

</body>
</html>
