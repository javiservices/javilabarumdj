<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Javi Labarum DJ') }} - Login</title>

        <!-- Favicon -->
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
        <link rel="apple-touch-icon" href="{{ asset('favicon.ico') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600;700;900&family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <!-- Tailwind CSS -->
        <script src="https://cdn.tailwindcss.com"></script>
        
        <style>
            body {
                font-family: 'Poppins', sans-serif;
                background: linear-gradient(135deg, #1a4d2e 0%, #d4af37 100%);
            }
            .heading-font {
                font-family: 'Montserrat', sans-serif;
            }
            .gradient-text {
                background: linear-gradient(135deg, #2d5016 0%, #d4af37 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <div class="mb-6">
                <a href="/" class="text-white">
                    <div class="w-40 h-40 bg-slate-900 border-4 border-amber-500 rounded-full flex items-center justify-center shadow-2xl hover:scale-110 transition transform mx-auto">
                        <img src="{{ asset('logo_white.png') }}" alt="Javi Labarum DJ" class="h-24">
                    </div>
                    <h1 class="text-3xl font-bold heading-font text-white text-center mt-4">JAVI LABARUM DJ</h1>
                    <p class="text-amber-300 text-center mt-2 font-semibold">Afro Latin Tech House</p>
                </a>
            </div>

            <div class="w-full sm:max-w-md px-6 py-8 bg-slate-900 border-2 border-amber-600 shadow-2xl overflow-hidden sm:rounded-2xl">
                {{ $slot }}
            </div>
            
            <div class="mt-6 text-center">
                <a href="{{ url('/') }}" class="text-emerald-200 hover:text-white transition">
                    <i class="fas fa-arrow-left mr-2"></i>Volver al inicio
                </a>
            </div>
        </div>
    </body>
</html>
