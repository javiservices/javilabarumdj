<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('seo_title', 'Javi Labarum DJ - Afro Latin Tech House | DJ Profesional para Fiestas, Clubs y Festivales')</title>
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="@yield('seo_description', 'Javi Labarum - DJ especializado en Afro Latin Tech House. Disponible para bookings en fiestas, discotecas, beach clubs y festivales. Fusionando ritmos tribales africanos y latinos con la potencia del tech house. Contacto: +34 622 323 976')">
    <meta name="keywords" content="DJ Afro Latin Tech House, DJ España, booking DJ, DJ fiestas, DJ clubs, DJ festivales, tech house, afro house, latin house, DJ profesional, eventos musicales, discotecas, beach clubs, Javi Labarum">
    <meta name="author" content="Javi Labarum">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="language" content="Spanish">
    <link rel="canonical" href="{{ url()->current() }}">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('seo_title', 'Javi Labarum DJ - Afro Latin Tech House | DJ Profesional')">
    <meta property="og:description" content="@yield('seo_description', 'DJ especializado en Afro Latin Tech House. Disponible para bookings en fiestas, clubs y festivales. Fusionando ritmos tribales con tech house.')">
    <meta property="og:image" content="{{ asset('logo_white.png') }}">
    <meta property="og:site_name" content="Javi Labarum DJ">
    <meta property="og:locale" content="es_ES">
    
    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:title" content="@yield('seo_title', 'Javi Labarum DJ - Afro Latin Tech House')">
    <meta name="twitter:description" content="@yield('seo_description', 'DJ especializado en Afro Latin Tech House. Bookings para fiestas, clubs y festivales.')">
    <meta name="twitter:image" content="{{ asset('logo_white.png') }}">
    
    <!-- Additional SEO -->
    <meta name="geo.region" content="ES">
    <meta name="geo.placename" content="España">
    <meta name="theme-color" content="#1a4d2e">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('favicon.ico') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600;700;900&family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #0f172a;
        }
        .heading-font {
            font-family: 'Montserrat', sans-serif;
        }
        .gradient-bg {
            background: linear-gradient(135deg, #1a4d2e 0%, #d4af37 100%);
        }
        .gradient-text {
            background: linear-gradient(135deg, #2d5016 0%, #d4af37 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .card-hover {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(212, 175, 55, 0.3);
        }
        .nav-link {
            position: relative;
            transition: color 0.3s ease;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -5px;
            left: 50%;
            background: linear-gradient(135deg, #1a4d2e 0%, #d4af37 100%);
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }
        .nav-link:hover::after {
            width: 100%;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        .float-animation {
            animation: float 3s ease-in-out infinite;
        }
        @keyframes blob {
            0%, 100% { transform: translate(0, 0) scale(1); }
            25% { transform: translate(20px, -50px) scale(1.1); }
            50% { transform: translate(-20px, 20px) scale(0.9); }
            75% { transform: translate(50px, 50px) scale(1.05); }
        }
        .animate-blob {
            animation: blob 7s infinite;
        }
        .animation-delay-2000 {
            animation-delay: 2s;
        }
        .animation-delay-4000 {
            animation-delay: 4s;
        }
        .dark-card {
            background: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(10px);
        }
    </style>

    @stack('styles')
    
    <!-- Schema.org structured data -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Person",
        "name": "Javi Labarum",
        "alternateName": "Javi Labarum DJ",
        "url": "{{ url('/') }}",
        "image": "{{ asset('logo_white.png') }}",
        "jobTitle": "DJ Profesional",
        "genre": "Afro Latin Tech House",
        "telephone": "+34622323976",
        "email": "booking@javilabarumdj.com",
        "sameAs": [
            "https://instagram.com/javilabarumdj"
        ],
        "performerIn": {
            "@type": "MusicEvent",
            "name": "Eventos y Fiestas",
            "description": "DJ sets en clubs, festivales, beach clubs y eventos privados"
        },
        "makesOffer": {
            "@type": "Offer",
            "itemOffered": {
                "@type": "Service",
                "name": "Servicios de DJ Profesional",
                "description": "DJ especializado en Afro Latin Tech House para fiestas, discotecas, festivales y eventos privados",
                "serviceType": "DJ Services",
                "areaServed": "España"
            }
        }
    }
    </script>
</head>
<body class="antialiased bg-slate-950">
    <!-- Navigation -->
    <nav class="bg-slate-900 shadow-lg sticky top-0 z-50 border-b border-amber-600">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="text-3xl font-bold heading-font">
                    <a href="{{ url('/') }}" class="hover:opacity-80 transition">
                        <img src="{{ asset('logo_white.png') }}" alt="Javi Labarum DJ" class="h-12">
                    </a>
                </div>

                <div class="hidden md:flex space-x-8 items-center">
                    <a href="{{ url('/') }}" class="nav-link text-gray-300 hover:text-amber-400 font-medium">Inicio</a>
                    <a href="{{ route('events.index') }}" class="nav-link text-gray-300 hover:text-amber-400 font-medium">Eventos</a>
                    <a href="{{ route('events.calendar') }}" class="nav-link text-gray-300 hover:text-amber-400 font-medium">Calendario</a>
                    <a href="{{ route('contact.show') }}" class="nav-link text-gray-300 hover:text-amber-400 font-medium">Contacto</a>
                    <a href="{{ route('links') }}" class="nav-link text-gray-300 hover:text-amber-400 font-medium">Links</a>
                    
                    @auth
                        <a href="{{ route('admin.dashboard') }}" class="nav-link text-gray-300 hover:text-amber-400 font-medium">
                            <i class="fas fa-user-shield mr-1"></i>Admin
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="nav-link text-gray-300 hover:text-amber-400 font-medium">
                                <i class="fas fa-sign-out-alt mr-1"></i>Salir
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="bg-gradient-to-r from-emerald-700 to-amber-500 text-white font-bold py-2 px-6 rounded-full hover:shadow-lg transition">
                            <i class="fas fa-sign-in-alt mr-2"></i>Acceder
                        </a>
                    @endauth
                </div>

                <div class="md:hidden">
                    <button class="mobile-menu-button text-gray-300">
                        <i class="fas fa-bars text-2xl"></i>
                    </button>
                </div>
            </div>

            <!-- Mobile menu -->
            <div class="mobile-menu hidden md:hidden pb-4">
                <a href="{{ url('/') }}" class="block py-2 text-gray-300 hover:text-amber-400">Inicio</a>
                <a href="{{ route('events.index') }}" class="block py-2 text-gray-300 hover:text-amber-400">Eventos</a>
                <a href="{{ route('events.calendar') }}" class="block py-2 text-gray-300 hover:text-amber-400">Calendario</a>
                <a href="{{ route('contact.show') }}" class="block py-2 text-gray-300 hover:text-amber-400">Contacto</a>
                <a href="{{ route('links') }}" class="block py-2 text-gray-300 hover:text-amber-400">Links</a>
                @auth
                    <a href="{{ route('admin.dashboard') }}" class="block py-2 text-gray-300 hover:text-amber-400">Admin</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block py-2 text-gray-300 hover:text-amber-400 w-full text-left">Salir</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="block py-2 text-gray-300 hover:text-amber-400">Acceder</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Alerts (solo para páginas que no tienen su propio diseño de alertas) -->
    @if(session('success') && !Request::is('contacto'))
    <div class="container mx-auto px-4 mt-4">
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded" role="alert">
            <p class="font-bold">¡Éxito!</p>
            <p>{{ session('success') }}</p>
        </div>
    </div>
    @endif

    @if(session('error') && !Request::is('contacto'))
    <div class="container mx-auto px-4 mt-4">
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded" role="alert">
            <p class="font-bold">Error</p>
            <p>{{ session('error') }}</p>
        </div>
    </div>
    @endif

    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="gradient-bg text-white py-12 mt-16">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                <div>
                    <img src="{{ asset('logo_white.png') }}" alt="Javi Labarum DJ" class="h-16 mb-4">
                    <p class="text-gray-200">Afro Latin Tech House · Fiestas · Clubs · Festivales</p>
                    <p class="text-gray-300 text-sm mt-2">Fusionando ritmos tribales con la electrónica del futuro 🔥</p>
                </div>
                
                <div>
                    <h4 class="text-lg font-semibold mb-4">Enlaces Rápidos</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('events.index') }}" class="text-gray-200 hover:text-white transition">Eventos</a></li>
                        <li><a href="{{ route('events.calendar') }}" class="text-gray-200 hover:text-white transition">Calendario</a></li>
                        <li><a href="{{ route('contact.show') }}" class="text-gray-200 hover:text-white transition">Contacto</a></li>
                        <li><a href="{{ route('links') }}" class="text-gray-200 hover:text-white transition">Redes Sociales</a></li>
                        @auth
                            <li><a href="{{ route('admin.dashboard') }}" class="text-gray-200 hover:text-white transition">Panel Admin</a></li>
                        @endauth
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-lg font-semibold mb-4">Sígueme</h4>
                    @php
                        $socialLinks = \App\Models\SocialLink::active()->ordered()->get();
                    @endphp
                    <div class="flex space-x-4">
                        @forelse($socialLinks as $link)
                            <a href="{{ $link->url }}" target="_blank" class="text-2xl hover:text-gray-200 transition transform hover:scale-110">
                                <i class="{{ $link->icon ?? 'fas fa-link' }}"></i>
                            </a>
                        @empty
                            <a href="#" class="text-2xl hover:text-gray-200 transition"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="text-2xl hover:text-gray-200 transition"><i class="fab fa-facebook"></i></a>
                            <a href="#" class="text-2xl hover:text-gray-200 transition"><i class="fab fa-spotify"></i></a>
                            <a href="#" class="text-2xl hover:text-gray-200 transition"><i class="fab fa-soundcloud"></i></a>
                        @endforelse
                    </div>
                </div>
            </div>
            
            <div class="border-t border-amber-600 pt-8 text-center">
                <p>&copy; {{ date('Y') }} Javi Labarum DJ. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>

    <!-- Floating WhatsApp Button -->
    <a href="https://wa.me/34622323976?text=Hola%20Javi!%20Me%20interesa%20un%20booking%20para%20mi%20evento..." 
       target="_blank" 
       class="fixed bottom-6 right-6 w-16 h-16 bg-green-500 hover:bg-green-600 rounded-full flex items-center justify-center text-white shadow-2xl hover:shadow-3xl transition transform hover:scale-110 z-50 animate-bounce"
       title="Booking por WhatsApp">
        <i class="fab fa-whatsapp text-3xl"></i>
    </a>

    <!-- Mobile menu toggle script -->
    <script>
        document.querySelector('.mobile-menu-button').addEventListener('click', function() {
            document.querySelector('.mobile-menu').classList.toggle('hidden');
        });
    </script>

    @stack('scripts')
</body>
</html>
