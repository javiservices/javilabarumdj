@extends('layouts.app')

@section('title', '- Administrar Redes Sociales')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-center mb-8">
        <div>
            <h1 class="text-4xl font-bold heading-font gradient-text mb-2">Administrar Redes Sociales</h1>
            <p class="text-gray-600">Gestiona tus enlaces para la página de bio</p>
        </div>
        <a href="{{ route('social-links.create') }}" class="bg-gradient-to-r from-purple-500 to-indigo-600 text-white font-bold py-3 px-6 rounded-lg hover:shadow-lg transition mt-4 md:mt-0">
            <i class="fas fa-plus mr-2"></i>
            Agregar Red Social
        </a>
    </div>

    <!-- Preview Link -->
    <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-8 rounded">
        <div class="flex items-center">
            <i class="fas fa-info-circle text-blue-500 mr-3"></i>
            <div>
                <p class="font-semibold text-blue-900">Vista Previa</p>
                <a href="{{ route('links') }}" target="_blank" class="text-blue-600 hover:underline">
                    {{ url('/links') }} <i class="fas fa-external-link-alt ml-1 text-sm"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Social Links List -->
    @if($socialLinks->count() > 0)
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Orden</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Plataforma</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">URL</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($socialLinks as $link)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-gray-900 font-semibold">{{ $link->order }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <i class="{{ $link->icon ?? 'fas fa-link' }} text-2xl text-purple-600 mr-3"></i>
                                    <span class="text-gray-900 font-medium">{{ $link->platform }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ $link->url }}" target="_blank" class="text-blue-600 hover:underline truncate block max-w-xs">
                                    {{ $link->url }}
                                </a>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($link->is_active)
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        <i class="fas fa-check-circle mr-1"></i> Activo
                                    </span>
                                @else
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                        <i class="fas fa-times-circle mr-1"></i> Inactivo
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <a href="{{ route('social-links.edit', $link) }}" class="text-indigo-600 hover:text-indigo-900">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('social-links.destroy', $link) }}" method="POST" class="inline" onsubmit="return confirm('¿Estás seguro de eliminar este enlace?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">
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
        <div class="bg-white rounded-lg shadow-lg p-12 text-center">
            <i class="fas fa-link text-gray-300 text-6xl mb-4"></i>
            <h3 class="text-xl font-bold text-gray-700 mb-2">No hay redes sociales configuradas</h3>
            <p class="text-gray-500 mb-6">Agrega tus primeros enlaces para comenzar</p>
            <a href="{{ route('social-links.create') }}" class="inline-block bg-gradient-to-r from-purple-500 to-indigo-600 text-white font-bold py-3 px-6 rounded-lg hover:shadow-lg transition">
                <i class="fas fa-plus mr-2"></i>
                Agregar Primera Red Social
            </a>
        </div>
    @endif
</div>
@endsection
