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
        font-size: 1.5rem;
    }
    .fc-theme-standard td, .fc-theme-standard th {
        border-color: #334155;
    }
    
    /* Responsive styles for mobile */
    @media (max-width: 768px) {
        .fc .fc-toolbar {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        
        .fc .fc-toolbar-chunk {
            display: flex;
            justify-content: center;
            width: 100%;
        }
        
        .fc .fc-toolbar-title {
            font-size: 1.2rem;
            text-align: center;
        }
        
        .fc .fc-button {
            padding: 8px 12px;
            font-size: 0.875rem;
        }
        
        .fc .fc-button-group {
            display: flex;
        }
        
        /* Make day numbers larger on mobile */
        .fc .fc-daygrid-day-number {
            font-size: 1rem;
            padding: 8px;
        }
        
        /* Better event display on mobile */
        .fc-daygrid-event {
            font-size: 0.75rem;
            margin-bottom: 2px;
        }
        
        /* Hide week view button on mobile */
        .fc-timeGridWeek-button {
            display: none;
        }
        
        /* Stack day headers vertically on very small screens */
        .fc .fc-col-header-cell {
            font-size: 0.75rem;
            padding: 4px 2px;
        }
    }
    
    @media (max-width: 480px) {
        .fc .fc-toolbar-title {
            font-size: 1rem;
        }
        
        .fc .fc-button {
            padding: 6px 10px;
            font-size: 0.75rem;
        }
        
        .fc .fc-daygrid-day-number {
            font-size: 0.875rem;
            padding: 4px;
        }
        
        /* Use abbreviated day names on very small screens */
        .fc .fc-col-header-cell-cushion {
            padding: 4px 1px;
        }
    }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="relative py-12 md:py-20 overflow-hidden bg-slate-950">
    <div class="absolute inset-0 gradient-bg opacity-80"></div>
    <div class="absolute inset-0 bg-black opacity-50"></div>
    
    <div class="container mx-auto px-4 relative z-10">
        <div class="text-center text-white">
            <h1 class="text-3xl md:text-5xl lg:text-6xl font-bold heading-font mb-4 text-amber-400">Calendario de Eventos</h1>
            <p class="text-base md:text-xl text-emerald-200">Consulta todas las fechas disponibles y próximos shows</p>
        </div>
    </div>
</section>

<div class="container mx-auto px-2 sm:px-4 py-4 md:py-8">
    <!-- Calendar -->
    <div class="bg-slate-800 rounded-lg shadow-lg p-2 sm:p-4 md:p-6 border border-amber-600">
        <div id="calendar"></div>
    </div>
</div>

@push('scripts')
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        
        // Detect if mobile
        var isMobile = window.innerWidth < 768;
        
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: isMobile ? 'listMonth' : 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: isMobile ? 'dayGridMonth,listMonth' : 'dayGridMonth,timeGridWeek,listMonth'
            },
            locale: 'es',
            firstDay: 1, // Monday as first day of week
            buttonText: {
                today: 'Hoy',
                month: 'Mes',
                week: 'Semana',
                list: 'Lista'
            },
            height: 'auto',
            contentHeight: 'auto',
            aspectRatio: isMobile ? 1 : 1.8,
            handleWindowResize: true,
            windowResize: function(view) {
                // Adjust view on window resize
                if (window.innerWidth < 768 && calendar.view.type === 'timeGridWeek') {
                    calendar.changeView('dayGridMonth');
                }
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
            },
            // Better mobile display
            dayMaxEvents: isMobile ? 2 : 4,
            moreLinkText: function(num) {
                return '+' + num + ' más';
            }
        });
        calendar.render();
    });
</script>
@endpush

@endsection
