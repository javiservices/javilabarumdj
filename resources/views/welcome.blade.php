@extends('layouts.app')

@section('seo_title', 'Javi Labarum DJ - Afro Latin Tech House | Booking DJ para Fiestas, Clubs y Festivales en España')
@section('seo_description', 'DJ Profesional especializado en Afro Latin Tech House. Disponible para bookings en toda España. Ritmos tribales africanos y latinos fusionados con tech house. Perfecto para fiestas, discotecas, beach clubs, festivales y eventos privados. Contacto: +34 622 323 976 | booking@javilabarumdj.com')

@section('content')
<!-- Hero Section -->
<section class="relative min-h-screen flex items-center justify-center overflow-hidden bg-slate-950">
    <div class="absolute inset-0 gradient-bg opacity-80"></div>
    <div class="absolute inset-0 bg-black opacity-50"></div>
    
    <!-- Animated Background Elements -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute w-96 h-96 bg-emerald-600 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob" style="top: 10%; left: 10%;"></div>
        <div class="absolute w-96 h-96 bg-amber-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000" style="top: 50%; right: 10%;"></div>
        <div class="absolute w-96 h-96 bg-green-700 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-4000" style="bottom: 10%; left: 50%;"></div>
    </div>

    <div class="container mx-auto px-4 text-center relative z-10">
        <div class="">
            <div class="inline-block mb-8">
                <img src="{{ asset('logo_white.png') }}" alt="Javi Labarum DJ - Afro Latin Tech House" class="h-48 md:h-64 mx-auto">
            </div>
        </div>
        
        <h1 class="sr-only">Javi Labarum - DJ Profesional de Afro Latin Tech House | Bookings para Fiestas, Clubs y Festivales en España</h1>
        <p class="text-2xl md:text-3xl text-amber-400 mb-4 font-light">Afro Latin Tech House DJ</p>
        <p class="text-xl text-emerald-200 mb-12 max-w-2xl mx-auto">
            Fusionando ritmos tribales africanos y latinos con beats electrónicos | Fiestas · Discotecas · Beach Clubs · Festivales 🔥
        </p>
        
        <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-6">
            <a href="{{ route('events.index') }}" class="bg-white text-purple-600 font-bold py-4 px-10 rounded-full hover:shadow-2xl transition transform hover:scale-110 inline-block">
                <i class="far fa-calendar-alt mr-2"></i>
                Ver Eventos
            </a>
            <a href="{{ route('links') }}" class="bg-transparent border-2 border-white text-white font-bold py-4 px-10 rounded-full hover:bg-white hover:text-purple-600 transition transform hover:scale-110 inline-block">
                <i class="fas fa-link mr-2"></i>
                Mis Redes
            </a>
        </div>

        <!-- Social Icons -->
        @php
            $socialLinks = \App\Models\SocialLink::active()->ordered()->limit(5)->get();
        @endphp
        @if($socialLinks->count() > 0)
            <div class="mt-16 flex justify-center space-x-6">
                @foreach($socialLinks as $link)
                    <a href="{{ $link->url }}" target="_blank" class="text-white hover:text-purple-200 transition transform hover:scale-125 text-3xl">
                        <i class="{{ $link->icon ?? 'fas fa-link' }}"></i>
                    </a>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Scroll Down Indicator -->
    <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 text-white">
        <i class="fas fa-chevron-down text-3xl"></i>
    </div>
</section>

<!-- Stats Section -->
<section class="py-20 bg-slate-900" aria-label="Experiencia y estadísticas">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold heading-font gradient-text mb-4">Afro Latin Tech House - Mi Especialidad</h2>
            <p class="text-xl text-gray-400">Donde los ritmos africanos y latinos se encuentran con el tech house moderno</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 text-center">
            <div class="p-6 bg-slate-800 rounded-xl hover:bg-slate-700 transition">
                <div class="text-5xl font-bold gradient-text mb-2">8+</div>
                <p class="text-gray-300 font-semibold">Años en la Escena</p>
            </div>
            <div class="p-6 bg-slate-800 rounded-xl hover:bg-slate-700 transition">
                <div class="text-5xl font-bold gradient-text mb-2">50+</div>
                <p class="text-gray-300 font-semibold">Fiestas & Clubs</p>
            </div>
            <div class="p-6 bg-slate-800 rounded-xl hover:bg-slate-700 transition">
                <div class="text-5xl font-bold gradient-text mb-2">5+</div>
                <p class="text-gray-300 font-semibold">Festivales</p>
            </div>
            <div class="p-6 bg-slate-800 rounded-xl hover:bg-slate-700 transition">
                <div class="text-5xl font-bold gradient-text mb-2">127BPM</div>
                <p class="text-gray-300 font-semibold">Pura Energía</p>
            </div>
        </div>
    </div>
</section>

<!-- My Sound Section -->
<section class="py-20 bg-gradient-to-br from-slate-950 via-emerald-950 to-slate-900 text-white relative overflow-hidden">
    <!-- Animated Background -->
    <div class="absolute inset-0 opacity-20">
        <div class="absolute w-96 h-96 bg-emerald-600 rounded-full mix-blend-multiply filter blur-3xl animate-blob" style="top: 0%; left: 20%;"></div>
        <div class="absolute w-96 h-96 bg-amber-500 rounded-full mix-blend-multiply filter blur-3xl animate-blob animation-delay-2000" style="top: 40%; right: 20%;"></div>
        <div class="absolute w-96 h-96 bg-green-700 rounded-full mix-blend-multiply filter blur-3xl animate-blob animation-delay-4000" style="bottom: 0%; left: 40%;"></div>
    </div>

    <div class="container mx-auto px-4 relative z-10">
        <div class="text-center mb-12">
            <h2 class="text-5xl font-bold heading-font mb-4 text-amber-400">Mi Sonido</h2>
            <p class="text-xl text-emerald-300">Afro Latin Tech House</p>
        </div>

        <div class="max-w-4xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                <div class="bg-slate-900 bg-opacity-60 backdrop-blur-lg rounded-xl p-8 hover:bg-opacity-80 transition border border-amber-600">
                    <div class="text-4xl mb-4">🥁</div>
                    <h3 class="text-2xl font-bold mb-3 text-amber-400">Ritmos Tribales</h3>
                    <p class="text-emerald-100">
                        Percusiones africanas y latinas que crean grooves hipnóticos. Congas, bongós y tambores fusionados con la electrónica moderna.
                    </p>
                </div>

                <div class="bg-slate-900 bg-opacity-60 backdrop-blur-lg rounded-xl p-8 hover:bg-opacity-80 transition border border-amber-600">
                    <div class="text-4xl mb-4">⚡</div>
                    <h3 class="text-2xl font-bold mb-3 text-amber-400">Tech House Energy</h3>
                    <p class="text-emerald-100">
                        Basslines profundos y beats minimalistas entre 120-128 BPM. La potencia del tech house que hace vibrar cualquier dancefloor.
                    </p>
                </div>

                <div class="bg-slate-900 bg-opacity-60 backdrop-blur-lg rounded-xl p-8 hover:bg-opacity-80 transition border border-amber-600">
                    <div class="text-4xl mb-4">🌴</div>
                    <h3 class="text-2xl font-bold mb-3 text-amber-400">Sabor Latino</h3>
                    <p class="text-emerald-100">
                        Elementos de salsa, cumbia y ritmos caribeños. La esencia latina que conecta con el alma de la pista.
                    </p>
                </div>

                <div class="bg-slate-900 bg-opacity-60 backdrop-blur-lg rounded-xl p-8 hover:bg-opacity-80 transition border border-amber-600">
                    <div class="text-4xl mb-4">🔥</div>
                    <h3 class="text-2xl font-bold mb-3 text-amber-400">Underground Vibes</h3>
                    <p class="text-emerald-100">
                        Sonidos frescos y originales. Tracks exclusivos y selecciones únicas para crear experiencias memorables en cada set.
                    </p>
                </div>
            </div>

            <div class="text-center bg-slate-900 bg-opacity-60 backdrop-blur-lg rounded-xl p-8 border border-amber-600">
                <h3 class="text-2xl font-bold mb-4 text-amber-400">Perfecto para:</h3>
                <div class="flex flex-wrap justify-center gap-4">
                    <span class="bg-emerald-700 px-6 py-3 rounded-full font-semibold">🎪 Festivales</span>
                    <span class="bg-emerald-800 px-6 py-3 rounded-full font-semibold">🏖️ Beach Clubs</span>
                    <span class="bg-amber-600 px-6 py-3 rounded-full font-semibold">🌃 Discotecas</span>
                    <span class="bg-emerald-700 px-6 py-3 rounded-full font-semibold">🎉 Fiestas Privadas</span>
                    <span class="bg-amber-700 px-6 py-3 rounded-full font-semibold">🏙️ Rooftops</span>
                    <span class="bg-emerald-800 px-6 py-3 rounded-full font-semibold">🌅 Afterhours</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Próximos Eventos -->
<section class="py-20 bg-slate-950 relative overflow-hidden">
    <div class="absolute inset-0 gradient-bg opacity-5"></div>
    
    <div class="container mx-auto px-4 relative z-10">
        <div class="text-center mb-12">
            <h2 class="text-5xl font-bold heading-font gradient-text mb-4">Próximos Eventos</h2>
            <p class="text-xl text-gray-300">No te pierdas ninguna de mis presentaciones</p>
        </div>

        @if($upcomingEvents->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
                @foreach($upcomingEvents as $event)
                    <a href="{{ route('events.show', $event) }}" class="block group">
                        <div class="bg-slate-800 rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition card-hover border border-amber-600">
                            @if($event->image)
                                <div class="h-48 overflow-hidden relative">
                                    <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900 to-transparent opacity-60"></div>
                                </div>
                            @else
                                <div class="h-48 bg-gradient-to-br from-emerald-700 to-amber-600 flex items-center justify-center">
                                    <i class="fas fa-music text-white text-6xl opacity-50"></i>
                                </div>
                            @endif
                            
                            <div class="p-6">
                                <div class="flex items-center mb-3">
                                    <span class="bg-gradient-to-r from-emerald-700 to-amber-600 text-white text-xs font-bold px-3 py-1 rounded-full">
                                        <i class="far fa-calendar-alt mr-1"></i>
                                        {{ $event->event_date->format('d M Y') }}
                                    </span>
                                </div>
                                
                                <h3 class="text-xl font-bold text-white mb-2 group-hover:text-amber-400 transition">
                                    {{ $event->title }}
                                </h3>
                                
                                @if($event->location)
                                    <p class="text-emerald-200 text-sm flex items-center">
                                        <i class="fas fa-map-marker-alt mr-2 text-amber-400"></i>
                                        {{ Str::limit($event->location, 40) }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            
            <div class="text-center mt-12">
                <a href="{{ route('events.index') }}" class="inline-block bg-gradient-to-r from-emerald-700 to-amber-600 hover:from-emerald-800 hover:to-amber-700 text-white font-bold py-4 px-8 rounded-full transition transform hover:scale-105">
                    <i class="fas fa-calendar-alt mr-2"></i>
                    Ver Todos los Eventos
                </a>
            </div>
        @else
            <div class="text-center">
                <div class="bg-slate-800 rounded-xl p-12 max-w-2xl mx-auto border border-amber-600">
                    <i class="fas fa-calendar-times text-6xl text-amber-400 mb-4"></i>
                    <h3 class="text-2xl font-bold text-white mb-2">Próximamente</h3>
                    <p class="text-gray-300">Nuevos eventos se anunciarán pronto. ¡Mantente atento!</p>
                </div>
            </div>
        @endif
    </div>
</section>

<!-- Contacto -->
<section id="contacto" class="py-20 relative overflow-hidden bg-slate-900" aria-label="Contacto y bookings">
    <div class="absolute inset-0 gradient-bg opacity-5"></div>
    
    <div class="container mx-auto px-4 relative z-10">
        <div class="text-center mb-12">
            <h2 class="text-5xl font-bold heading-font gradient-text mb-4">Bookings y Contacto</h2>
            <p class="text-xl text-gray-300">¿Buscas un DJ de Afro Latin Tech House para tu club, festival o evento? ¡Hablemos!</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-5xl mx-auto mb-12">
            <!-- Email -->
            <a href="mailto:booking@javilabarumdj.com" class="bg-slate-800 rounded-xl shadow-lg p-8 text-center hover:shadow-2xl transition transform hover:scale-105 card-hover border border-amber-600">
                <div class="w-20 h-20 gradient-bg rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-envelope text-white text-3xl"></i>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">Email</h3>
                <p class="text-amber-400 font-semibold">booking@javilabarumdj.com</p>
                <p class="text-sm text-gray-400 mt-2">Respuesta en 24h</p>
            </a>

            <!-- WhatsApp -->
            <a href="https://wa.me/34622323976?text=Hola%20Javi!%20Me%20interesa%20un%20booking%20para%20mi%20evento..." target="_blank" class="bg-slate-800 rounded-xl shadow-lg p-8 text-center hover:shadow-2xl transition transform hover:scale-105 card-hover border border-amber-600">
                <div class="w-20 h-20 gradient-bg rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fab fa-whatsapp text-white text-3xl"></i>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">WhatsApp</h3>
                <p class="text-amber-400 font-semibold">+34 622 323 976</p>
                <p class="text-sm text-gray-400 mt-2">Respuesta inmediata</p>
            </a>

            <!-- Instagram -->
            <a href="https://instagram.com/javilabarumdj" target="_blank" class="bg-slate-800 rounded-xl shadow-lg p-8 text-center hover:shadow-2xl transition transform hover:scale-105 card-hover border border-amber-600">
                <div class="w-20 h-20 gradient-bg rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fab fa-instagram text-white text-3xl"></i>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">Instagram</h3>
                <p class="text-amber-400 font-semibold">@javilabarumdj</p>
                <p class="text-sm text-gray-400 mt-2">Envíame un DM</p>
            </a>
        </div>

        <div class="text-center">
            <a href="{{ route('contact.show') }}" class="inline-block gradient-bg text-white font-bold py-4 px-10 rounded-full hover:shadow-2xl transition transform hover:scale-110">
                <i class="fas fa-paper-plane mr-2"></i>
                Formulario de Contacto Completo
            </a>
        </div>
    </div>
</section>
@endsection
