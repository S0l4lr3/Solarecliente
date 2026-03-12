<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SOLARE | Solicitar Acceso</title>
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
    {{-- Formulario Principal --}}
    <div class="flex-1 flex items-center justify-center p-6 lg:p-12">
        <div class="w-full max-w-[550px] bg-white p-10 shadow-sm border border-gray-100">
            
            <div class="text-center mb-10">
                <a href="/" style="text-decoration: none; color: inherit;">
                    <span class="serif text-3xl tracking-[4px] block mb-1">SOLARE</span>
                </a>
                <span class="text-[9px] font-bold tracking-[2.5px] uppercase text-solare-arcilla block mb-2">Nueva cuenta</span>
                <h1 class="serif text-2xl text-gray-900">Solicitar acceso</h1>
            </div>

            {{-- Manejo de Errores de Red --}}
            @if($errors->any())
                <div class="bg-red-50 p-4 mb-6 border-l-4 border-solare-arcilla">
                    <p class="text-[10px] uppercase font-bold text-solare-arcilla">{{ $errors->first() }}</p>
                </div>
            @endif

            <form action="{{ route('register.post') }}" method="POST" class="space-y-5">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[9px] font-bold uppercase text-gray-400 tracking-widest mb-1.5">Nombre</label>
                        <input type="text" name="nombre" required class="w-full bg-[#f3f1ef] border-b border-gray-300 focus:border-solare-arcilla border-x-0 border-t-0 text-sm p-3 outline-none transition" placeholder="María">
                    </div>
                    <div>
                        <label class="block text-[9px] font-bold uppercase text-gray-400 tracking-widest mb-1.5">Apellido</label>
                        <input type="text" name="apellido" required class="w-full bg-[#f3f1ef] border-b border-gray-300 focus:border-solare-arcilla border-x-0 border-t-0 text-sm p-3 outline-none transition" placeholder="García">
                    </div>
                </div>

                <div>
                    <label class="block text-[9px] font-bold uppercase text-gray-400 tracking-widest mb-1.5">Correo Corporativo</label>
                    <input type="email" name="email" required class="w-full bg-[#f3f1ef] border-b border-gray-300 focus:border-solare-arcilla border-x-0 border-t-0 text-sm p-3 outline-none transition" placeholder="maria@hotel.mx">
                </div>

                <div>
                    <label class="block text-[9px] font-bold uppercase text-gray-400 tracking-widest mb-1.5">Contraseña de Acceso</label>
                    <input type="password" name="password" required class="w-full bg-[#f3f1ef] border-b border-gray-300 focus:border-solare-arcilla border-x-0 border-t-0 text-sm p-3 outline-none transition" placeholder="••••••••">
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full bg-solare-arcilla text-white py-4 text-[11px] font-bold uppercase tracking-widest hover:bg-solare-musgo transition flex items-center justify-center gap-2">
                        SOLICITAR ACCESO <span class="text-lg">→</span>
                    </button>
                </div>
            </form>

            <div class="mt-8 text-center pt-6 border-t border-gray-100">
                <p class="text-xs text-gray-400">¿Ya tienes cuenta? <a href="{{ route('login') }}" class="text-solare-arcilla font-bold hover:underline">Iniciar sesión</a></p>
            </div>
        </div>
    </div>

    {{-- Panel de Marca Lateral (Solo Desktop) --}}
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
