@extends('layouts.app')

@section('title', '- ' . $event->title)

@section('content')
<!-- Hero Section -->
<section class="relative py-20 overflow-hidden bg-slate-950">
    <div class="absolute inset-0 gradient-bg opacity-80"></div>
    <div class="absolute inset-0 bg-black opacity-50"></div>
    
    <div class="container mx-auto px-4 relative z-10">
        <div class="text-center text-white">
            <h1 class="text-5xl md:text-6xl font-bold heading-font mb-4 text-amber-400">{{ $event->title }}</h1>
            <p class="text-xl text-emerald-200">
                <i class="far fa-calendar-alt mr-2"></i>
                {{ $event->event_date->format('d M Y, H:i') }}
                @if($event->location)
                    <span class="mx-3">·</span>
                    <i class="fas fa-map-marker-alt mr-2"></i>
                    {{ $event->location }}
                @endif
            </p>
        </div>
    </div>
</section>

<div class="container mx-auto px-4 py-8">
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('events.index') }}" class="inline-flex items-center text-amber-400 hover:text-amber-300 font-semibold">
            <i class="fas fa-arrow-left mr-2"></i>
            Volver a eventos
        </a>
    </div>

    <!-- Event Detail Card -->
    <div class="bg-slate-800 rounded-2xl shadow-2xl overflow-hidden border border-amber-600">
        <div class="md:flex">
            <!-- Image Section -->
            <div class="md:w-1/2">
                @if($event->image)
                    <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-96 bg-gradient-to-br from-emerald-700 to-amber-600 flex items-center justify-center">
                        <i class="fas fa-music text-white text-9xl opacity-50"></i>
                    </div>
                @endif
            </div>

            <!-- Content Section -->
            <div class="md:w-1/2 p-8 md:p-12">
                <div class="flex items-center mb-4">
                    <span class="bg-gradient-to-r from-emerald-700 to-amber-600 text-white text-sm font-bold px-4 py-2 rounded-full">
                        <i class="far fa-calendar-alt mr-2"></i>
                        {{ $event->event_date->format('d M Y') }}
                    </span>
                    @if($event->google_event_id)
                        <span class="ml-3 text-emerald-400 text-sm font-semibold">
                            <i class="fab fa-google mr-1"></i>
                            Sincronizado
                        </span>
                    @endif
                </div>

                <h1 class="text-4xl md:text-5xl font-bold heading-font gradient-text mb-6">
                    {{ $event->title }}
                </h1>

                <!-- Event Details -->
                <div class="space-y-4 mb-8">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-12 h-12 bg-slate-700 rounded-lg flex items-center justify-center mr-4">
                            <i class="far fa-clock text-amber-400 text-xl"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-white">Hora</h3>
                            <p class="text-gray-300">{{ $event->event_date->format('H:i') }} hrs</p>
                        </div>
                    </div>

                    @if($event->location)
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-12 h-12 bg-slate-700 rounded-lg flex items-center justify-center mr-4">
                                <i class="fas fa-map-marker-alt text-amber-400 text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-white">Ubicación</h3>
                                <p class="text-gray-300">{{ $event->location }}</p>
                            </div>
                        </div>
                    @endif

                    @if($event->description)
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-12 h-12 bg-slate-700 rounded-lg flex items-center justify-center mr-4">
                                <i class="fas fa-info-circle text-amber-400 text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-white mb-2">Descripción</h3>
                                <p class="text-gray-300 leading-relaxed">{{ $event->description }}</p>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Actions -->
                <div class="flex flex-col sm:flex-row gap-4">
                    @if($event->booking_url)
                        <a href="{{ $event->booking_url }}" target="_blank" class="flex-1 bg-gradient-to-r from-emerald-700 to-amber-600 hover:from-emerald-800 hover:to-amber-700 text-white font-bold py-4 px-6 rounded-lg transition transform hover:scale-105 text-center">
                            <i class="fas fa-ticket-alt mr-2"></i>
                            Comprar Entradas
                        </a>
                    @else
                        <a href="https://wa.me/34622323976?text=Hola%20Javi!%20Me%20interesa%20el%20evento:%20{{ urlencode($event->title) }}%20-%20{{ urlencode(url()->current()) }}" target="_blank" class="flex-1 bg-gradient-to-r from-emerald-700 to-amber-600 hover:from-emerald-800 hover:to-amber-700 text-white font-bold py-4 px-6 rounded-lg transition transform hover:scale-105 text-center">
                            <i class="fab fa-whatsapp mr-2"></i>
                            Reservar / Consultar
                        </a>
                    @endif
                    <button onclick="compartirEvento()" class="flex-1 bg-slate-700 hover:bg-slate-600 text-white font-bold py-4 px-6 rounded-lg text-center transition">
                        <i class="fas fa-share-alt mr-2"></i>
                        Compartir
                    </button>
                </div>

                @if($event->synced_at)
                    <p class="text-sm text-gray-400 mt-4">
                        <i class="fas fa-sync-alt mr-1"></i>
                        Última sincronización: {{ $event->synced_at->diffForHumans() }}
                    </p>
                @endif
            </div>
        </div>
    </div>

    <!-- Other Events -->
    @php
        $otherEvents = \App\Models\Event::where('is_active', true)
            ->where('id', '!=', $event->id)
            ->orderBy('event_date', 'asc')
            ->limit(3)
            ->get();
    @endphp

    @if($otherEvents->count() > 0)
        <div class="mt-16">
            <h2 class="text-3xl font-bold heading-font gradient-text text-center mb-8">Otros Eventos</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($otherEvents as $otherEvent)
                    <a href="{{ route('events.show', $otherEvent) }}" class="block bg-slate-800 rounded-lg shadow-lg overflow-hidden card-hover border border-amber-600">
                        @if($otherEvent->image)
                            <img src="{{ asset('storage/' . $otherEvent->image) }}" alt="{{ $otherEvent->title }}" class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gradient-to-br from-emerald-700 to-amber-600 flex items-center justify-center">
                                <i class="fas fa-music text-white text-4xl opacity-50"></i>
                            </div>
                        @endif
                        <div class="p-4">
                            <h3 class="font-bold text-lg mb-2 text-white">{{ $otherEvent->title }}</h3>
                            <p class="text-gray-300 text-sm">
                                <i class="far fa-calendar-alt mr-2 text-amber-400"></i>
                                {{ $otherEvent->event_date->format('d M Y, H:i') }}
                            </p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @endif
</div>

@push('scripts')
<script>
function compartirEvento() {
    const eventUrl = "{{ url()->current() }}";
    const eventTitle = "{{ $event->title }}";
    const shareText = `¡Mira este evento! ${eventTitle} - ${eventUrl}`;
    
    // Verificar si el navegador soporta Web Share API
    if (navigator.share) {
        navigator.share({
            title: eventTitle,
            text: `{{ $event->title }} - {{ $event->event_date->format('d M Y, H:i') }}`,
            url: eventUrl
        }).catch((error) => {
            // Si el usuario cancela, copiar al portapapeles
            copiarAlPortapapeles(eventUrl);
        });
    } else {
        // Fallback: copiar al portapapeles
        copiarAlPortapapeles(eventUrl);
    }
}

function copiarAlPortapapeles(texto) {
    if (navigator.clipboard) {
        navigator.clipboard.writeText(texto).then(() => {
            mostrarNotificacion('¡Enlace copiado al portapapeles!');
        }).catch(() => {
            mostrarNotificacionError('No se pudo copiar el enlace');
        });
    } else {
        // Método antiguo para navegadores sin clipboard API
        const input = document.createElement('textarea');
        input.value = texto;
        document.body.appendChild(input);
        input.select();
        try {
            document.execCommand('copy');
            mostrarNotificacion('¡Enlace copiado al portapapeles!');
        } catch (err) {
            mostrarNotificacionError('No se pudo copiar el enlace');
        }
        document.body.removeChild(input);
    }
}

function mostrarNotificacion(mensaje) {
    const notif = document.createElement('div');
    notif.className = 'fixed bottom-4 right-4 bg-emerald-700 text-white px-6 py-3 rounded-lg shadow-lg z-50 animate-bounce';
    notif.innerHTML = `<i class="fas fa-check-circle mr-2"></i>${mensaje}`;
    document.body.appendChild(notif);
    setTimeout(() => notif.remove(), 3000);
}

function mostrarNotificacionError(mensaje) {
    const notif = document.createElement('div');
    notif.className = 'fixed bottom-4 right-4 bg-red-600 text-white px-6 py-3 rounded-lg shadow-lg z-50';
    notif.innerHTML = `<i class="fas fa-exclamation-circle mr-2"></i>${mensaje}`;
    document.body.appendChild(notif);
    setTimeout(() => notif.remove(), 3000);
}
</script>
@endpush
@endsection
