<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex items-center justify-center bg-gray-50">
        <div class="  min-h-[450px] w-full max-w-2xl flex bg-white rounded-2xl shadow-xl overflow-hidden">

            <div class="hidden lg:flex lg:w-1/2 flex-col items-center justify-center">
                <a href="/">
                    <img src="{{ asset('images/logo.crea.ucsc.webp') }}" alt="CREA UCSC" class="h-16">
                </a>

                <p class="mt-6 text-center text-xl font-semibold text-gray-700">
                    Sistema de Información<br>
                    Departamento de Ecotoxicología
                </p>
            </div>

            <div class="w-full lg:w-1/2 flex flex-col items-center justify-center px-6 py-4">
                <a href="/" class="lg:hidden mb-6">
                    <img src="{{ asset('images/logo.crea.ucsc.webp') }}" alt="CREA UCSC" class="h-12">
                </a>
                {{ $slot }}
            </div>

        </div>
    </div>
</body>

</html>