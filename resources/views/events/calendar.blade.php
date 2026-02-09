@extends('layouts.app')

@section('title', '- Calendario')
@section('seo_title', 'Calendario de Eventos - Javi Labarum DJ | Agenda de Shows y Presentaciones')
@section('seo_description', 'Calendario completo de eventos de Javi Labarum DJ. Consulta todas las fechas disponibles, próximos shows en clubs y festivales. Sincronizado con Google Calendar para estar siempre actualizado.')

@push('styles')
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.css' rel='stylesheet' />
<style>
    .fc {
        max-width: 1200px;
        margin: 0 auto;
    }
    .fc-event {
        cursor: pointer;
        border-radius: 5px;
        padding: 5px;
        background: linear-gradient(135deg, #1a4d2e 0%, #d4af37 100%);
        border-color: #d4af37;
    }
    .fc-daygrid-event {
        white-space: normal !important;
    }
    /* Dark theme for FullCalendar */
    .fc {
        color: #e5e7eb;
    }
    .fc .fc-button-primary {
        background: linear-gradient(135deg, #1a4d2e 0%, #d4af37 100%);
        border-color: #d4af37;
    }
    .fc .fc-button-primary:hover {
        background: linear-gradient(135deg, #2d5016 0%, #b8941f 100%);
    }
    .fc .fc-col-header-cell {
        background-color: #1e293b;
        color: #d4af37;
    }
    .fc .fc-daygrid-day {
        background-color: #0f172a;
    }
    .fc .fc-daygrid-day:hover {
        background-color: #1e293b;
    }
    .fc .fc-daygrid-day-number {
        color: #e5e7eb;
    }
    .fc .fc-toolbar-title {
        color: #d4af37;
    }
    .fc-theme-standard td, .fc-theme-standard th {
        border-color: #334155;
    }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="relative py-20 overflow-hidden bg-slate-950">
    <div class="absolute inset-0 gradient-bg opacity-80"></div>
    <div class="absolute inset-0 bg-black opacity-50"></div>
    
    <div class="container mx-auto px-4 relative z-10">
        <div class="text-center text-white">
            <h1 class="text-5xl md:text-6xl font-bold heading-font mb-4 text-amber-400">Calendario de Eventos</h1>
            <p class="text-xl text-emerald-200">Consulta todas las fechas disponibles y próximos shows</p>
        </div>
    </div>
</section>

<div class="container mx-auto px-4 py-8">
    <!-- Google Calendar Sync -->
    <div class="bg-slate-800 rounded-lg shadow-md p-6 mb-8 border border-amber-600">
        <div class="flex flex-col md:flex-row items-center justify-between">
            <div class="mb-4 md:mb-0">
                <h3 class="text-xl font-bold mb-2 text-white">
                    <i class="fab fa-google text-red-500 mr-2"></i>
                    Sincronización con Google Calendar
                </h3>
                <p class="text-gray-300">Mantén tu calendario siempre actualizado automáticamente</p>
            </div>
            <div class="flex space-x-3">
                @if(isset($isGoogleAuthenticated) && $isGoogleAuthenticated)
                    <form action="{{ route('google.import') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-6 rounded-lg transition">
                            <i class="fas fa-sync-alt mr-2"></i>
                            Importar Eventos
                        </button>
                    </form>
                    <span class="inline-flex items-center text-green-600 font-semibold">
                        <i class="fas fa-check-circle mr-2"></i>
                        Conectado
                    </span>
                @else
                    <a href="{{ route('google.auth') }}" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-6 rounded-lg transition">
                        <i class="fab fa-google mr-2"></i>
                        Conectar Google Calendar
                    </a>
                @endif
            </div>
        </div>
    </div>

    <!-- Calendar -->
    <div class="bg-slate-800 rounded-lg shadow-lg p-6 border border-amber-600">
        <div id="calendar"></div>
    </div>
</div>

@push('scripts')
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,listMonth'
            },
            locale: 'es',
            buttonText: {
                today: 'Hoy',
                month: 'Mes',
                week: 'Semana',
                list: 'Lista'
            },
            events: '/api/events',
            eventColor: '#1a4d2e',
            eventClick: function(info) {
                // Redirect to event details
                window.location.href = '/events/' + info.event.id;
            },
            eventTimeFormat: {
                hour: '2-digit',
                minute: '2-digit',
                hour12: false
            }
        });
        calendar.render();
    });
</script>
@endpush

@endsection
