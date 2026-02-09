@extends('layouts.app')

@section('title', '- Agregar Red Social')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('social-links.index') }}" class="inline-flex items-center text-purple-600 hover:text-purple-800 font-semibold">
                <i class="fas fa-arrow-left mr-2"></i>
                Volver
            </a>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-lg shadow-lg p-8">
            <h1 class="text-3xl font-bold heading-font gradient-text mb-6">Agregar Red Social</h1>

            <form action="{{ route('social-links.store') }}" method="POST">
                @csrf

                <!-- Platform -->
                <div class="mb-6">
                    <label for="platform" class="block text-gray-700 font-semibold mb-2">
                        Plataforma *
                    </label>
                    <select name="platform" id="platform" required class="w-full border-gray-300 rounded-lg shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 p-3" onchange="updateIcon()">
                        <option value="">Selecciona una plataforma</option>
                        <option value="Instagram" data-icon="fab fa-instagram">Instagram</option>
                        <option value="Facebook" data-icon="fab fa-facebook">Facebook</option>
                        <option value="Twitter/X" data-icon="fab fa-twitter">Twitter/X</option>
                        <option value="TikTok" data-icon="fab fa-tiktok">TikTok</option>
                        <option value="YouTube" data-icon="fab fa-youtube">YouTube</option>
                        <option value="Spotify" data-icon="fab fa-spotify">Spotify</option>
                        <option value="SoundCloud" data-icon="fab fa-soundcloud">SoundCloud</option>
                        <option value="Apple Music" data-icon="fab fa-apple">Apple Music</option>
                        <option value="Beatport" data-icon="fas fa-music">Beatport</option>
                        <option value="Mixcloud" data-icon="fab fa-mixcloud">Mixcloud</option>
                        <option value="WhatsApp" data-icon="fab fa-whatsapp">WhatsApp</option>
                        <option value="Telegram" data-icon="fab fa-telegram">Telegram</option>
                        <option value="Email" data-icon="fas fa-envelope">Email</option>
                        <option value="Website" data-icon="fas fa-globe">Website</option>
                        <option value="Otro" data-icon="fas fa-link">Otro</option>
                    </select>
                    @error('platform')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- URL -->
                <div class="mb-6">
                    <label for="url" class="block text-gray-700 font-semibold mb-2">
                        URL *
                    </label>
                    <input type="url" name="url" id="url" required 
                           class="w-full border-gray-300 rounded-lg shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 p-3"
                           placeholder="https://instagram.com/tuusuario">
                    @error('url')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Icon -->
                <div class="mb-6">
                    <label for="icon" class="block text-gray-700 font-semibold mb-2">
                        Icono (Font Awesome class)
                    </label>
                    <div class="flex items-center space-x-3">
                        <input type="text" name="icon" id="icon" 
                               class="flex-1 border-gray-300 rounded-lg shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 p-3"
                               placeholder="fab fa-instagram">
                        <div id="icon-preview" class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-link text-purple-600 text-2xl"></i>
                        </div>
                    </div>
                    <p class="text-gray-500 text-sm mt-1">
                        Visita <a href="https://fontawesome.com/icons" target="_blank" class="text-purple-600 hover:underline">Font Awesome</a> para buscar iconos
                    </p>
                    @error('icon')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Order -->
                <div class="mb-6">
                    <label for="order" class="block text-gray-700 font-semibold mb-2">
                        Orden
                    </label>
                    <input type="number" name="order" id="order" value="0" min="0"
                           class="w-full border-gray-300 rounded-lg shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 p-3">
                    <p class="text-gray-500 text-sm mt-1">Los enlaces se mostrarán ordenados de menor a mayor</p>
                    @error('order')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Is Active -->
                <div class="mb-6">
                    <label class="flex items-center">
                        <input type="checkbox" name="is_active" value="1" checked
                               class="rounded border-gray-300 text-purple-600 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200">
                        <span class="ml-2 text-gray-700 font-semibold">Activo</span>
                    </label>
                </div>

                <!-- Submit -->
                <div class="flex space-x-4">
                    <button type="submit" class="flex-1 bg-gradient-to-r from-purple-500 to-indigo-600 text-white font-bold py-3 px-6 rounded-lg hover:shadow-lg transition">
                        <i class="fas fa-save mr-2"></i>
                        Guardar
                    </button>
                    <a href="{{ route('social-links.index') }}" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-3 px-6 rounded-lg text-center transition">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function updateIcon() {
        const select = document.getElementById('platform');
        const iconInput = document.getElementById('icon');
        const iconPreview = document.getElementById('icon-preview');
        
        const selectedOption = select.options[select.selectedIndex];
        const icon = selectedOption.getAttribute('data-icon');
        
        if (icon) {
            iconInput.value = icon;
            iconPreview.innerHTML = `<i class="${icon} text-purple-600 text-2xl"></i>`;
        }
    }

    document.getElementById('icon').addEventListener('input', function() {
        const iconPreview = document.getElementById('icon-preview');
        const iconClass = this.value || 'fas fa-link';
        iconPreview.innerHTML = `<i class="${iconClass} text-purple-600 text-2xl"></i>`;
    });
</script>
@endpush

@endsection
