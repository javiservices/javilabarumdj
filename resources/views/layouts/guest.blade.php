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
                background: linear-gradient(135deg, #0f172a 0%, #1a4d2e 50%, #d4af37 100%);
                min-height: 100vh;
                position: relative;
                overflow-x: hidden;
            }
            body::before {
                content: '';
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: 
                    radial-gradient(circle at 20% 50%, rgba(26, 77, 46, 0.3) 0%, transparent 50%),
                    radial-gradient(circle at 80% 80%, rgba(212, 175, 55, 0.2) 0%, transparent 50%);
                pointer-events: none;
                z-index: 0;
            }
            .heading-font {
                font-family: 'Montserrat', sans-serif;
            }
            .gradient-text {
                background: linear-gradient(135deg, #d4af37 0%, #f4d03f 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }
            .login-card {
                background: rgba(15, 23, 42, 0.8);
                backdrop-filter: blur(20px);
                border: 2px solid rgba(212, 175, 55, 0.3);
                box-shadow: 
                    0 20px 60px rgba(0, 0, 0, 0.5),
                    0 0 40px rgba(212, 175, 55, 0.2);
                transition: all 0.3s ease;
            }
            .login-card:hover {
                border-color: rgba(212, 175, 55, 0.5);
                box-shadow: 
                    0 20px 60px rgba(0, 0, 0, 0.6),
                    0 0 50px rgba(212, 175, 55, 0.3);
            }
            .input-field {
                background: rgba(26, 77, 46, 0.2);
                border: 2px solid rgba(212, 175, 55, 0.3);
                transition: all 0.3s ease;
            }
            .input-field:focus {
                background: rgba(26, 77, 46, 0.4);
                border-color: #d4af37;
                box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.1);
            }
            .btn-primary {
                background: linear-gradient(135deg, #1a4d2e 0%, #2d6e3f 100%);
                border: 2px solid #d4af37;
                color: #d4af37;
                transition: all 0.3s ease;
                position: relative;
                overflow: hidden;
            }
            .btn-primary::before {
                content: '';
                position: absolute;
                top: 50%;
                left: 50%;
                width: 0;
                height: 0;
                border-radius: 50%;
                background: rgba(212, 175, 55, 0.2);
                transform: translate(-50%, -50%);
                transition: width 0.6s, height 0.6s;
            }
            .btn-primary:hover::before {
                width: 300px;
                height: 300px;
            }
            .btn-primary:hover {
                background: linear-gradient(135deg, #d4af37 0%, #f4d03f 100%);
                color: #0f172a;
                transform: translateY(-2px);
                box-shadow: 0 10px 30px rgba(212, 175, 55, 0.5);
            }
            .content-wrapper {
                position: relative;
                z-index: 1;
            }
        </style>
    </head>
    <body class="font-sans text-gray-100 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 px-4 content-wrapper">
            <div class="mb-8">
                <a href="/" class="block text-center">
                    <img src="{{ asset('logo_white.png') }}" alt="Javi Labarum DJ" class="h-20 sm:h-24 mx-auto hover:scale-105 transition-all duration-300">
                    <h1 class="sr-only">JAVI LABARUM DJ</h1>
                    <p class="text-amber-400 text-center mt-4 font-semibold tracking-wide text-sm sm:text-base">Afro Latin Tech House</p>
                </a>
            </div>

            <div class="w-full sm:max-w-md login-card px-8 py-10 overflow-hidden rounded-3xl">
                {{ $slot }}
            </div>
            
            <div class="mt-8 text-center">
                <a href="{{ url('/') }}" class="inline-flex items-center text-amber-300 hover:text-amber-400 transition-all duration-300 font-medium group">
                    <i class="fas fa-arrow-left mr-2 group-hover:-translate-x-1 transition-transform duration-300"></i>
                    <span>Volver al inicio</span>
                </a>
            </div>
        </div>
    </body>
</html>
