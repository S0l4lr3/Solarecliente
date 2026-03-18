<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SOLARE | Regístrate</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Crimson+Pro:ital,wght@0,200..900;1,200..900&family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <style>
        .serif { font-family: "Crimson Pro", serif; }
        body { font-family: "Inter", sans-serif; }
        .bg-solare-musgo { background-color: #50594e; }
        .text-solare-arcilla { color: #958174; }
        .bg-solare-arcilla { background-color: #958174; }
        .hover\:bg-solare-musgo:hover { background-color: #50594e; }
    </style>
</head>
<body class="bg-[#f3f1ef]">

<div class="flex min-h-screen">
    {{-- Formulario Central --}}
    <div class="flex-1 flex items-center justify-center p-6 lg:p-24 bg-white shadow-2xl relative z-10">
        <div class="max-w-[420px] w-full">
            <div class="text-center mb-10">
                <a href="/" style="text-decoration: none; color: inherit;">
                    <span class="serif text-3xl tracking-[4px] block mb-1">SOLARE</span>
                </a>
                <span class="text-[9px] font-bold tracking-[2.5px] uppercase text-solare-arcilla block mb-2">Nueva cuenta</span>
                <h1 class="serif text-2xl text-gray-900">Regístrate</h1>
            </div>

            {{-- Alertas de Errores y Éxito --}}
            @if($errors->any())
                <div class="bg-red-50 p-4 mb-6 border-l-4 border-red-500">
                    <p class="text-[10px] uppercase font-bold text-red-500">{{ $errors->first() }}</p>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6">
                    <p class="text-[10px] uppercase tracking-widest font-bold text-red-500">{{ session('error') }}</p>
                </div>
            @endif

            <form action="{{ route('register.post') }}" method="POST" class="space-y-5">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[9px] font-bold uppercase text-gray-400 tracking-widest mb-1.5">Nombre</label>
                        <input type="text" name="nombre" value="{{ old('nombre') }}" required class="w-full bg-[#f3f1ef] border-b border-gray-300 focus:border-solare-arcilla border-x-0 border-t-0 text-sm p-3 outline-none transition" placeholder="María">
                    </div>
                    <div>
                        <label class="block text-[9px] font-bold uppercase text-gray-400 tracking-widest mb-1.5">Apellido</label>
                        <input type="text" name="apellido_paterno" value="{{ old('apellido_paterno') }}" required class="w-full bg-[#f3f1ef] border-b border-gray-300 focus:border-solare-arcilla border-x-0 border-t-0 text-sm p-3 outline-none transition" placeholder="García">
                    </div>
                </div>

                <div>
                    <label class="block text-[9px] font-bold uppercase text-gray-400 tracking-widest mb-1.5">Correo Corporativo</label>
                    <input type="email" name="correo" value="{{ old('correo') }}" required class="w-full bg-[#f3f1ef] border-b border-gray-300 focus:border-solare-arcilla border-x-0 border-t-0 text-sm p-3 outline-none transition" placeholder="maria@hotel.mx">
                </div>

                <div>
                    <label class="block text-[9px] font-bold uppercase text-gray-400 tracking-widest mb-1.5">Contraseña de Acceso</label>
                    <input type="password" name="contrasena" required class="w-full bg-[#f3f1ef] border-b border-gray-300 focus:border-solare-arcilla border-x-0 border-t-0 text-sm p-3 outline-none transition" placeholder="Mínimo 8 carac. (A, a, 1, @)">
                </div>
                
                {{-- Campo necesario para la validación confirmed de Laravel --}}
                <div>
                    <label class="block text-[9px] font-bold uppercase text-gray-400 tracking-widest mb-1.5">Confirmar Contraseña</label>
                    <input type="password" name="contrasena_confirmation" required class="w-full bg-[#f3f1ef] border-b border-gray-300 focus:border-solare-arcilla border-x-0 border-t-0 text-sm p-3 outline-none transition" placeholder="Repite tu contraseña">
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full bg-solare-arcilla text-white py-4 text-[11px] font-bold uppercase tracking-widest hover:bg-solare-musgo transition flex items-center justify-center gap-2">
                        REGÍSTRATE <span class="text-lg">→</span>
                    </button>
                </div>
            </form>

            <div class="mt-8 text-center pt-6 border-t border-gray-100">
                <p class="text-xs text-gray-400">¿Ya tienes cuenta? <a href="{{ route('login') }}" class="text-solare-arcilla font-bold hover:underline">Iniciar sesión</a></p>
            </div>
        </div>
    </div>

    {{-- Panel de Marca Lateral ORIGINAL --}}
    <div class="hidden lg:flex w-[350px] bg-solare-musgo p-12 flex-col justify-center gap-12 text-white">
        <blockquote class="serif text-2xl font-light leading-relaxed italic opacity-90">
            "El exterior es una extensión del hogar."
        </blockquote>
        
        <div class="space-y-8">
            <div class="flex gap-4 items-start">
                <span class="text-solare-arcilla font-serif text-2xl leading-none">◈</span>
                <p class="text-[10px] text-white/60 leading-relaxed tracking-widest uppercase">Acceso al catálogo completo y precios exclusivos</p>
            </div>
            <div class="flex gap-4 items-start">
                <span class="text-solare-arcilla font-serif text-2xl leading-none">≡</span>
                <p class="text-[10px] text-white/60 leading-relaxed tracking-widest uppercase">Ver disponibilidad de stock en tiempo real</p>
            </div>
            <div class="flex gap-4 items-start">
                <span class="text-solare-arcilla font-serif text-2xl leading-none">◎</span>
                <p class="text-[10px] text-white/60 leading-relaxed tracking-widest uppercase">Generación de cotizaciones directas</p>
            </div>
        </div>

        <div class="mt-auto opacity-30 text-[10px] tracking-widest uppercase">
            © 2026 Solare — Muebles
        </div>
    </div>
</div>

</body>
</html>