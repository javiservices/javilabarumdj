@extends('layouts.app')

@section('title', '- Eventos')
@section('seo_title', 'Próximos Eventos - Javi Labarum DJ | Shows y Presentaciones de Afro Latin Tech House')
@section('seo_description', 'Consulta los próximos eventos y presentaciones de Javi Labarum DJ. Shows de Afro Latin Tech House en clubs, festivales y fiestas. Reserva tu entrada y no te pierdas ninguna fecha.')

@section('content')
<!-- Hero Section -->
<section class="relative py-20 overflow-hidden bg-slate-950">
    <div class="absolute inset-0 gradient-bg opacity-80"></div>
    <div class="absolute inset-0 bg-black opacity-50"></div>
    
    <div class="container mx-auto px-4 relative z-10">
        <div class="text-center text-white">
            <h1 class="text-5xl md:text-6xl font-bold heading-font mb-4 text-amber-400">Próximos Eventos</h1>
            <p class="text-xl text-emerald-200">No te pierdas ninguna de mis presentaciones en clubs y festivales</p>
        </div>
    </div>
</section>

<div class="container mx-auto px-4 py-8">
    <!-- Actions -->
    <div class="mb-12">
        <div class="flex justify-center space-x-4">
            <a href="{{ route('events.calendar') }}" class="inline-block bg-gradient-to-r from-emerald-700 to-amber-600 text-white font-bold py-3 px-8 rounded-full hover:shadow-xl transition transform hover:scale-105">
                <i class="far fa-calendar-alt mr-2"></i>
                Ver Calendario
            </a>
        </div>
    </div>

    <!-- Events Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($events as $event)
            <div class="bg-slate-800 rounded-2xl shadow-lg overflow-hidden card-hover border border-amber-600">
                @if($event->image)
                    <div class="h-56 overflow-hidden relative">
                        <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}" class="w-full h-full object-cover">
                        <div class="absolute top-0 left-0 bg-gradient-to-r from-emerald-700 to-amber-600 text-white font-bold py-2 px-4 rounded-br-2xl">
                            <i class="far fa-calendar-alt mr-2"></i>
                            {{ $event->event_date->format('d M') }}
                        </div>
                    </div>
                @else
                    <div class="h-56 bg-gradient-to-br from-emerald-700 to-amber-600 flex items-center justify-center relative">
                        <i class="fas fa-music text-white text-6xl opacity-50"></i>
                        <div class="absolute top-0 left-0 bg-slate-900 bg-opacity-60 text-white font-bold py-2 px-4 rounded-br-2xl">
                            <i class="far fa-calendar-alt mr-2"></i>
                            {{ $event->event_date->format('d M') }}
                        </div>
                    </div>
                @endif

                <div class="p-6">
                    <h2 class="text-2xl font-bold heading-font mb-3 text-white">
                        {{ $event->title }}
                    </h2>

                    <div class="space-y-2 mb-4">
                        <div class="flex items-center text-gray-300">
                            <i class="far fa-clock mr-3 text-amber-400"></i>
                            <span>{{ $event->event_date->format('H:i') }} hrs</span>
                        </div>

                        @if($event->location)
                            <div class="flex items-center text-gray-300">
                                <i class="fas fa-map-marker-alt mr-3 text-amber-400"></i>
                                <span>{{ $event->location }}</span>
                            </div>
                        @endif

                        @if($event->google_event_id)
                            <div class="flex items-center text-emerald-400 text-sm">
                                <i class="fab fa-google mr-2"></i>
                                <span>Sincronizado con Google Calendar</span>
                            </div>
                        @endif
                    </div>

                    @if($event->description)
                        <p class="text-gray-400 text-sm mb-6 line-clamp-3">
                            {{ Str::limit($event->description, 120) }}
                        </p>
                    @endif

                    <a href="{{ route('events.show', $event) }}" class="block w-full text-center bg-gradient-to-r from-emerald-700 to-amber-600 hover:from-emerald-800 hover:to-amber-700 text-white font-bold py-3 px-6 rounded-lg transition transform hover:scale-105">
                        <i class="fas fa-ticket-alt mr-2"></i>
                        Ver Detalles
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-16">
                <div class="mb-6">
                    <i class="fas fa-calendar-times text-gray-600 text-8xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-300 mb-2">No hay eventos próximos</h3>
                <p class="text-gray-400 mb-6">Pronto habrá nuevas fechas disponibles</p>
                <a href="{{ route('links') }}" class="inline-block bg-gradient-to-r from-emerald-700 to-amber-600 text-white font-bold py-3 px-8 rounded-full hover:shadow-xl transition">
                    <i class="fas fa-link mr-2"></i>
                    Sígueme en redes sociales
                </a>
            </div>
        @endforelse
    </div>
</div>
@endsection