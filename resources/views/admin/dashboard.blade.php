@extends('layouts.app')

@section('title', '- Panel de Administración')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold heading-font gradient-text mb-2">Panel de Administración</h1>
        <p class="text-gray-600">Bienvenido, {{ auth()->user()->name }} 👋</p>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-gradient-to-br from-purple-500 to-indigo-600 rounded-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-100 text-sm mb-1">Total Eventos</p>
                    <p class="text-3xl font-bold">{{ $totalEvents }}</p>
                </div>
                <i class="fas fa-calendar-alt text-4xl opacity-50"></i>
            </div>
        </div>

        <div class="bg-gradient-to-br from-green-500 to-teal-600 rounded-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-100 text-sm mb-1">Próximos Eventos</p>
                    <p class="text-3xl font-bold">{{ $upcomingEvents }}</p>
                </div>
                <i class="fas fa-arrow-up text-4xl opacity-50"></i>
            </div>
        </div>

        <div class="bg-gradient-to-br from-orange-500 to-red-600 rounded-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-orange-100 text-sm mb-1">Redes Sociales</p>
                    <p class="text-3xl font-bold">{{ $socialLinks }}</p>
                </div>
                <i class="fas fa-share-alt text-4xl opacity-50"></i>
            </div>
        </div>

        <div class="bg-gradient-to-br from-blue-500 to-cyan-600 rounded-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-sm mb-1">Google Calendar</p>
                    <p class="text-2xl font-bold">{{ $isGoogleConnected ? 'Conectado' : 'Desconectado' }}</p>
                </div>
                <i class="fab fa-google text-4xl opacity-50"></i>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <a href="{{ route('events.create') }}" class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition card-hover border-l-4 border-purple-500">
            <div class="flex items-center">
                <div class="flex-shrink-0 w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mr-4">
                    <i class="fas fa-plus text-purple-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="font-bold text-lg mb-1">Crear Nuevo Evento</h3>
                    <p class="text-gray-600 text-sm">Agrega un nuevo evento a tu calendario</p>
                </div>
            </div>
        </a>

        <a href="{{ route('social-links.create') }}" class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition card-hover border-l-4 border-green-500">
            <div class="flex items-center">
                <div class="flex-shrink-0 w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                    <i class="fas fa-link text-green-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="font-bold text-lg mb-1">Agregar Red Social</h3>
                    <p class="text-gray-600 text-sm">Añade un nuevo enlace a tu página de bio</p>
                </div>
            </div>
        </a>
    </div>

    <!-- Events Management -->
    <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold heading-font">
                <i class="fas fa-calendar-alt text-purple-600 mr-2"></i>
                Gestionar Eventos
            </h2>
            <a href="{{ route('events.create') }}" class="bg-gradient-to-r from-purple-500 to-indigo-600 text-white font-bold py-2 px-4 rounded-lg hover:shadow-lg transition">
                <i class="fas fa-plus mr-2"></i>
                Nuevo Evento
            </a>
        </div>

        @if($events->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Evento</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Fecha</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ubicación</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Estado</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($events as $event)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        @if($event->image)
                                            <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}" class="w-12 h-12 rounded object-cover mr-3">
                                        @else
                                            <div class="w-12 h-12 bg-purple-100 rounded flex items-center justify-center mr-3">
                                                <i class="fas fa-music text-purple-600"></i>
                                            </div>
                                        @endif
                                        <div>
                                            <p class="font-semibold">{{ $event->title }}</p>
                                            @if($event->google_event_id)
                                                <span class="text-xs text-green-600">
                                                    <i class="fab fa-google mr-1"></i>Sincronizado
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <p class="text-sm">{{ $event->event_date->format('d/m/Y') }}</p>
                                    <p class="text-xs text-gray-500">{{ $event->event_date->format('H:i') }}</p>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-sm text-gray-900">{{ Str::limit($event->location, 30) }}</p>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($event->is_active)
                                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Activo
                                        </span>
                                    @else
                                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                            Inactivo
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('events.show', $event) }}" class="text-blue-600 hover:text-blue-900" title="Ver">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('events.edit', $event) }}" class="text-indigo-600 hover:text-indigo-900" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('events.destroy', $event) }}" method="POST" class="inline" onsubmit="return confirm('¿Estás seguro de eliminar este evento?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900" title="Eliminar">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-12">
                <i class="fas fa-calendar-times text-gray-300 text-6xl mb-4"></i>
                <p class="text-gray-500 mb-4">No hay eventos creados</p>
                <a href="{{ route('events.create') }}" class="inline-block bg-gradient-to-r from-purple-500 to-indigo-600 text-white font-bold py-2 px-6 rounded-lg hover:shadow-lg transition">
                    Crear Primer Evento
                </a>
            </div>
        @endif
    </div>

    <!-- Quick Links -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <a href="{{ route('events.calendar') }}" class="bg-white rounded-lg shadow p-4 hover:shadow-lg transition text-center">
            <i class="fas fa-calendar text-purple-600 text-3xl mb-2"></i>
            <p class="font-semibold">Ver Calendario</p>
        </a>

        <a href="{{ route('social-links.index') }}" class="bg-white rounded-lg shadow p-4 hover:shadow-lg transition text-center">
            <i class="fas fa-link text-green-600 text-3xl mb-2"></i>
            <p class="font-semibold">Gestionar Enlaces</p>
        </a>

        <a href="{{ route('links') }}" target="_blank" class="bg-white rounded-lg shadow p-4 hover:shadow-lg transition text-center">
            <i class="fas fa-external-link-alt text-blue-600 text-3xl mb-2"></i>
            <p class="font-semibold">Ver Página Pública</p>
        </a>
    </div>
</div>
@endsection
