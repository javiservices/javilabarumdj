@extends('layouts.app')

@section('title', '- Crear Evento')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-purple-600 hover:text-purple-800 font-semibold">
                <i class="fas fa-arrow-left mr-2"></i>
                Volver al Dashboard
            </a>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-lg shadow-lg p-8">
            <h1 class="text-3xl font-bold heading-font gradient-text mb-6">Crear Nuevo Evento</h1>

            <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Title -->
                <div class="mb-6">
                    <label for="title" class="block text-gray-700 font-semibold mb-2">
                        Título del Evento *
                    </label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" required 
                           class="w-full border-gray-300 rounded-lg shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 p-3"
                           placeholder="Ej: Sunset Sessions @ Pacha Madrid">
                    @error('title')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div class="mb-6">
                    <label for="description" class="block text-gray-700 font-semibold mb-2">
                        Descripción
                    </label>
                    <textarea name="description" id="description" rows="4" 
                              class="w-full border-gray-300 rounded-lg shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 p-3"
                              placeholder="Describe tu evento...">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Event Date -->
                <div class="mb-6">
                    <label for="event_date" class="block text-gray-700 font-semibold mb-2">
                        Fecha y Hora *
                    </label>
                    <input type="datetime-local" name="event_date" id="event_date" value="{{ old('event_date') }}" required 
                           class="w-full border-gray-300 rounded-lg shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 p-3">
                    @error('event_date')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Location -->
                <div class="mb-6">
                    <label for="location" class="block text-gray-700 font-semibold mb-2">
                        Ubicación
                    </label>
                    <input type="text" name="location" id="location" value="{{ old('location') }}" 
                           class="w-full border-gray-300 rounded-lg shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 p-3"
                           placeholder="Ej: Pacha Madrid, Calle Barceló, 11">
                    @error('location')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Booking URL -->
                <div class="mb-6">
                    <label for="booking_url" class="block text-gray-700 font-semibold mb-2">
                        <i class="fas fa-ticket-alt mr-2 text-amber-600"></i>
                        Enlace de Compra de Entradas
                    </label>
                    <input type="url" name="booking_url" id="booking_url" value="{{ old('booking_url') }}" 
                           class="w-full border-gray-300 rounded-lg shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 p-3"
                           placeholder="https://eventbrite.com/tu-evento">
                    <p class="text-sm text-gray-500 mt-1">
                        <i class="fas fa-info-circle mr-1"></i>
                        Si dejas esto vacío, el botón llevará a WhatsApp. Si añades un enlace, mostrará "Comprar Entradas"
                    </p>
                    @error('booking_url')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Image -->
                <div class="mb-6">
                    <label for="image" class="block text-gray-700 font-semibold mb-2">
                        Imagen del Evento
                    </label>
                    <div class="flex items-center space-x-4">
                        <label class="flex-1 cursor-pointer">
                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-purple-500 transition">
                                <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-2"></i>
                                <p class="text-gray-600">Haz clic para subir una imagen</p>
                                <p class="text-sm text-gray-500 mt-1">PNG, JPG hasta 2MB</p>
                            </div>
                            <input type="file" name="image" id="image" accept="image/*" class="hidden" onchange="previewImage(this)">
                        </label>
                    </div>
                    <div id="image-preview" class="mt-4 hidden">
                        <img src="" alt="Preview" class="rounded-lg max-h-64 mx-auto">
                    </div>
                    @error('image')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Is Active -->
                <div class="mb-6">
                    <label class="flex items-center">
                        <input type="checkbox" name="is_active" value="1" checked
                               class="rounded border-gray-300 text-purple-600 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200">
                        <span class="ml-2 text-gray-700 font-semibold">Evento activo (visible en la web)</span>
                    </label>
                </div>

                <!-- Submit -->
                <div class="flex space-x-4">
                    <button type="submit" class="flex-1 bg-gradient-to-r from-purple-500 to-indigo-600 text-white font-bold py-3 px-6 rounded-lg hover:shadow-lg transition">
                        <i class="fas fa-save mr-2"></i>
                        Crear Evento
                    </button>
                    <a href="{{ route('admin.dashboard') }}" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-3 px-6 rounded-lg text-center transition">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function previewImage(input) {
        const preview = document.getElementById('image-preview');
        const img = preview.querySelector('img');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                img.src = e.target.result;
                preview.classList.remove('hidden');
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush

@endsection
