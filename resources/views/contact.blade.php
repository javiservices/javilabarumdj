@extends('layouts.app')

@section('title', '- Contacto')
@section('seo_title', 'Booking y Contacto - Javi Labarum DJ | Reserva para tu Evento')
@section('seo_description', 'Contacta con Javi Labarum DJ para bookings. Disponible para fiestas, clubs, festivales y eventos privados en toda España. WhatsApp: +34 622 323 976 | Email: booking@javilabarumdj.com. Respuesta rápida garantizada.')

@section('content')
<!-- Hero Section -->
<section class="relative py-20 overflow-hidden bg-slate-950">
    <div class="absolute inset-0 gradient-bg opacity-80"></div>
    <div class="absolute inset-0 bg-black opacity-50"></div>
    
    <div class="container mx-auto px-4 relative z-10">
        <div class="text-center text-white">
            <h1 class="text-5xl md:text-6xl font-bold heading-font mb-4 text-amber-400">Bookings</h1>
            <p class="text-xl text-emerald-200">¿Buscas Afro Latin Tech House para tu fiesta, club o festival? ¡Conectemos!</p>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="py-16 bg-slate-900">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 max-w-6xl mx-auto">
            <!-- Contact Info -->
            <div class="space-y-8">
                <div>
                    <h2 class="text-3xl font-bold heading-font gradient-text mb-6">Bookings & Contacto</h2>
                    <p class="text-gray-300 text-lg mb-8">
                        Disponible para fiestas, discotecas y festivales. Especializado en Afro Latin Tech House con sets llenos de energía y ritmos hipnóticos. ¡Hagamos vibrar tu evento!
                    </p>
                </div>

                <div class="space-y-6">
                    <!-- Email -->
                    <div class="flex items-start space-x-4 p-6 bg-slate-800 rounded-lg shadow-md hover:shadow-xl transition card-hover border border-amber-600">
                        <div class="flex-shrink-0">
                            <div class="w-14 h-14 gradient-bg rounded-full flex items-center justify-center">
                                <i class="fas fa-envelope text-white text-xl"></i>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-white mb-2">Email</h3>
                            <a href="mailto:booking@javilabarumdj.com" class="text-amber-400 hover:text-amber-300 transition">
                                booking@javilabarumdj.com
                            </a>
                        </div>
                    </div>

                    <!-- WhatsApp -->
                    <div class="flex items-start space-x-4 p-6 bg-slate-800 rounded-lg shadow-md hover:shadow-xl transition card-hover border border-amber-600">
                        <div class="flex-shrink-0">
                            <div class="w-14 h-14 gradient-bg rounded-full flex items-center justify-center">
                                <i class="fab fa-whatsapp text-white text-xl"></i>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-white mb-2">WhatsApp</h3>
                            <a href="https://wa.me/34622323976" target="_blank" class="text-amber-400 hover:text-amber-300 transition">
                                +34 622 323 976
                            </a>
                            <p class="text-sm text-gray-400 mt-1">Click para enviar mensaje directo</p>
                        </div>
                    </div>

                    <!-- Instagram -->
                    <div class="flex items-start space-x-4 p-6 bg-slate-800 rounded-lg shadow-md hover:shadow-xl transition card-hover border border-amber-600">
                        <div class="flex-shrink-0">
                            <div class="w-14 h-14 gradient-bg rounded-full flex items-center justify-center">
                                <i class="fab fa-instagram text-white text-xl"></i>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-white mb-2">Instagram</h3>
                            <a href="https://instagram.com/javilabarumdj" target="_blank" class="text-amber-400 hover:text-amber-300 transition">
                                @javilabarumdj
                            </a>
                            <p class="text-sm text-gray-400 mt-1">Sígueme y envíame DM</p>
                        </div>
                    </div>

                    <!-- Phone -->
                    <div class="flex items-start space-x-4 p-6 bg-slate-800 rounded-lg shadow-md hover:shadow-xl transition card-hover border border-amber-600">
                        <div class="flex-shrink-0">
                            <div class="w-14 h-14 gradient-bg rounded-full flex items-center justify-center">
                                <i class="fas fa-phone text-white text-xl"></i>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-white mb-2">Teléfono</h3>
                            <a href="tel:+34622323976" class="text-amber-400 hover:text-amber-300 transition">
                                +34 622 323 976
                            </a>
                            <p class="text-sm text-gray-400 mt-1">Disponible de 10:00 a 20:00</p>
                        </div>
                    </div>
                </div>

                <!-- Social Media Links -->
                <div class="p-6 bg-slate-800 rounded-lg shadow-md border border-amber-600">
                    <h3 class="text-lg font-semibold text-white mb-4">Sígueme en Redes Sociales</h3>
                    @php
                        $socialLinks = \App\Models\SocialLink::active()->ordered()->get();
                    @endphp
                    <div class="flex flex-wrap gap-3">
                        @forelse($socialLinks as $link)
                            <a href="{{ $link->url }}" target="_blank" class="w-12 h-12 gradient-bg rounded-full flex items-center justify-center text-white hover:shadow-lg transition transform hover:scale-110">
                                <i class="{{ $link->icon ?? 'fas fa-link' }}"></i>
                            </a>
                        @empty
                            <p class="text-gray-400">No hay enlaces disponibles</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div>
                <div class="bg-slate-800 rounded-lg shadow-xl p-8 border border-amber-600">
                    <h2 class="text-3xl font-bold heading-font gradient-text mb-6">Envíame un Mensaje</h2>
                    
                    @if(session('success'))
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded mb-6">
                            <p class="font-bold">¡Mensaje Enviado!</p>
                            <p>{{ session('success') }}</p>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded mb-6">
                            <p class="font-bold">Error</p>
                            <ul class="list-disc list-inside">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('contact.send') }}" method="POST" class="space-y-6">
                        @csrf
                        
                        <div>
                            <label for="name" class="block text-white font-semibold mb-2">
                                Nombre Completo <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                id="name" 
                                name="name" 
                                value="{{ old('name') }}"
                                class="w-full px-4 py-3 bg-slate-700 border border-emerald-600 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition"
                                required
                                placeholder="Tu nombre">
                        </div>

                        <div>
                            <label for="email" class="block text-white font-semibold mb-2">
                                Email <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                value="{{ old('email') }}"
                                class="w-full px-4 py-3 bg-slate-700 border border-emerald-600 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition"
                                required
                                placeholder="tu@email.com">
                        </div>

                        <div>
                            <label for="phone" class="block text-white font-semibold mb-2">
                                Teléfono (opcional)
                            </label>
                            <input 
                                type="tel" 
                                id="phone" 
                                name="phone" 
                                value="{{ old('phone') }}"
                                class="w-full px-4 py-3 bg-slate-700 border border-emerald-600 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition"
                                placeholder="+34 622 323 976">
                        </div>

                        <div>
                            <label for="subject" class="block text-white font-semibold mb-2">
                                Asunto
                            </label>
                            <input 
                                type="text" 
                                id="subject" 
                                name="subject" 
                                value="{{ old('subject') }}"
                                class="w-full px-4 py-3 bg-slate-700 border border-emerald-600 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition"
                                placeholder="¿De qué se trata?">
                        </div>

                        <div>
                            <label for="message" class="block text-white font-semibold mb-2">
                                Mensaje <span class="text-red-500">*</span>
                            </label>
                            <textarea 
                                id="message" 
                                name="message" 
                                rows="6" 
                                class="w-full px-4 py-3 bg-slate-700 border border-emerald-600 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition resize-none"
                                required
                                placeholder="Cuéntame sobre tu evento o consulta...">{{ old('message') }}</textarea>
                        </div>

                        <button 
                            type="submit" 
                            class="w-full gradient-bg text-white font-bold py-4 px-6 rounded-lg hover:shadow-xl transition transform hover:scale-105">
                            <i class="fas fa-paper-plane mr-2"></i>
                            Enviar Mensaje
                        </button>
                    </form>
                </div>

                <!-- Quick Contact -->
                <div class="mt-6 bg-gradient-to-r from-emerald-700 to-amber-600 rounded-lg shadow-lg p-6 text-white text-center">
                    <h3 class="text-xl font-bold mb-2">¿Booking Urgente?</h3>
                    <p class="mb-4">Hablemos directamente por WhatsApp</p>
                    <a href="https://wa.me/34622323976?text=Hola%20Javi,%20me%20interesa%20booking%20para%20mi%20evento..." 
                       target="_blank"
                       class="inline-block bg-white text-emerald-800 font-bold py-3 px-8 rounded-full hover:bg-gray-100 transition transform hover:scale-105">
                        <i class="fab fa-whatsapp mr-2"></i>
                        WhatsApp Directo
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-16 bg-slate-950">
    <div class="container mx-auto px-4 max-w-4xl">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold heading-font gradient-text mb-4">Preguntas Frecuentes</h2>
            <p class="text-gray-400">Respuestas rápidas a las consultas más comunes</p>
        </div>

        <div class="space-y-4">
            <div class="bg-slate-800 rounded-lg p-6 hover:shadow-md transition border border-amber-600">
                <h3 class="text-lg font-bold text-white mb-2">
                    <i class="fas fa-question-circle text-amber-500 mr-2"></i>
                    ¿Qué es el Afro Latin Tech House?
                </h3>
                <p class="text-gray-300">
                    Es la fusión perfecta entre ritmos afro-latinos (congas, bongós, percusiones) con la potencia del tech house. Grooves hipnóticos que hacen vibrar cualquier pista de baile entre 120-128 BPM.
                </p>
            </div>

            <div class="bg-slate-800 rounded-lg p-6 hover:shadow-md transition border border-amber-600">
                <h3 class="text-lg font-bold text-white mb-2">
                    <i class="fas fa-question-circle text-amber-500 mr-2"></i>
                    ¿Qué tipo de eventos son ideales?
                </h3>
                <p class="text-gray-300">
                    Fiestas en clubs, discotecas, beach clubs, rooftops, afterhours y festivales de música electrónica. Mi sonido se adapta perfectamente a ambientes underground y mainstage.
                </p>
            </div>

            <div class="bg-slate-800 rounded-lg p-6 hover:shadow-md transition border border-amber-600">
                <h3 class="text-lg font-bold text-white mb-2">
                    <i class="fas fa-question-circle text-amber-500 mr-2"></i>
                    ¿Cuánto dura un set?
                </h3>
                <p class="text-gray-300">
                    Sets estándar de 1-2 horas, pero puedo adaptar la duración según tu evento. Para festivales, disponible para sets de opening, prime time o closing.
                </p>
            </div>

            <div class="bg-slate-800 rounded-lg p-6 hover:shadow-md transition border border-amber-600">
                <h3 class="text-lg font-bold text-white mb-2">
                    <i class="fas fa-question-circle text-amber-500 mr-2"></i>
                    ¿Viajas para eventos?
                </h3>
                <p class="text-gray-300">
                    ¡Absolutamente! Disponible para bookings en toda España, Ibiza, Europa y Latinoamérica. Consulta mi <a href="{{ route('events.calendar') }}" class="text-amber-400 hover:underline">calendario</a> de disponibilidad.
                </p>
            </div>
        </div>
    </div>
</section>
@endsection
