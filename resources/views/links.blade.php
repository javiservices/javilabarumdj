<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Links - Javi Labarum DJ | Redes Sociales y Contacto</title>
    <meta name="description" content="Todas las redes sociales de Javi Labarum DJ en un solo lugar. Sígueme en Instagram, Spotify, SoundCloud y más. Booking disponible vía WhatsApp y email.">
    <meta name="keywords" content="Javi Labarum DJ, redes sociales DJ, instagram DJ, spotify DJ, soundcloud, contacto DJ">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url()->current() }}">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('favicon.ico') }}">
    
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background: linear-gradient(135deg, #0f172a 0%, #1a4d2e 50%, #d4af37 100%);
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 20% 50%, rgba(26, 77, 46, 0.3) 0%, transparent 50%),
                        radial-gradient(circle at 80% 80%, rgba(212, 175, 55, 0.2) 0%, transparent 50%);
            pointer-events: none;
        }
        .link-card {
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            background: rgba(15, 23, 42, 0.6);
            border: 2px solid rgba(212, 175, 55, 0.3);
        }
        .link-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(212, 175, 55, 0.4);
            background: rgba(26, 77, 46, 0.7);
            border-color: rgba(212, 175, 55, 0.6);
        }
        .profile-image {
            width: 150px;
            height: 150px;
            border: 5px solid #d4af37;
            box-shadow: 0 10px 30px rgba(212, 175, 55, 0.5);
            background: #0f172a;
        }
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }
        .animate-pulse-slow {
            animation: pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        .float-animation {
            animation: float 3s ease-in-out infinite;
        }
    </style>
</head>
<body>
    <!-- Hero Section -->
    <section class="relative py-20 overflow-hidden bg-slate-950">
        <div class="absolute inset-0" style="background: linear-gradient(135deg, #1a4d2e 0%, #d4af37 100%);"></div>
        <div class="absolute inset-0 bg-black opacity-50"></div>
        
        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center text-white">
                <div class="inline-block mb-6">
                    <img src="{{ asset('logo_white.png') }}" alt="Javi Labarum DJ - Afro Latin Tech House" class="h-32 mx-auto">
                </div>
                <h1 class="sr-only">Javi Labarum DJ - Afro Latin Tech House | Links y Redes Sociales</h1>
            </div>
        </div>
    </section>

    <!-- Links Section -->
    <div class="py-12 bg-slate-950">
        <div class="max-w-md w-full mx-auto px-4">
        <!-- Profile Section -->
        <div class="text-center mb-8">
            <div class="rounded-full mx-auto mb-4 flex items-center justify-center overflow-hidden">
                <img src="{{ asset('logo_white.png') }}" alt="Javi Labarum DJ" class="h-24">
            </div>
            <h1 class="text-4xl font-bold text-white mb-2 sr-only">JAVI LABARUM DJ</h1>
            <p class="text-amber-300 text-lg font-semibold mb-1">Afro Latin Tech House</p>
            <p class="text-emerald-200 text-sm opacity-90">🔥 Ritmos que hacen vibrar la pista 🔥</p>
        </div>

        <!-- Social Links -->
        <div class="space-y-4">
            @forelse($socialLinks as $link)
                <a href="{{ $link->url }}" target="_blank" 
                   class="link-card block text-white font-semibold py-4 px-6 rounded-full text-center hover:text-amber-300 transition">
                    <i class="{{ $link->icon ?? 'fas fa-link' }} mr-3 text-amber-400"></i>
                    {{ $link->platform }}
                </a>
            @empty
                <div class="text-center text-white">
                    <p class="text-lg">No hay enlaces disponibles</p>
                    <p class="text-sm text-emerald-200 mt-2">Configura tus redes sociales en el panel de administración</p>
                </div>
            @endforelse
        </div>

        <!-- Events Section -->
        <div class="mt-8 text-center">
            <a href="{{ route('events.index') }}" 
               class="inline-block bg-gradient-to-r from-emerald-700 to-amber-600 text-white font-bold py-3 px-8 rounded-full hover:shadow-lg transition transform hover:scale-105 border-2 border-amber-400">
                <i class="fas fa-calendar-alt mr-2"></i>
                Ver Próximos Eventos
            </a>
        </div>

        <!-- Footer -->
        <div class="mt-12 text-center text-emerald-200 text-sm">
            <p>&copy; {{ date('Y') }} Javi Labarum DJ</p>
            <p class="mt-2 text-amber-400 font-semibold">Afro Latin Tech House</p>
            <div class="mt-4 flex justify-center space-x-4 text-amber-400">
                <i class="fas fa-music animate-pulse-slow"></i>
                <i class="fas fa-compact-disc animate-pulse-slow"></i>
                <i class="fas fa-headphones animate-pulse-slow"></i>
            </div>
        </div>
        </div>
    </div>
</body>
</html>
