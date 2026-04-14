<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Fluxiom') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-slate-900 text-slate-100 relative min-h-screen overflow-x-hidden">
        
        <div class="fixed top-[-10%] left-[-10%] w-[500px] h-[500px] bg-blue-900/20 rounded-full blur-[120px] pointer-events-none z-0"></div>
        <div class="fixed bottom-[-10%] right-[-10%] w-[500px] h-[500px] bg-indigo-900/20 rounded-full blur-[120px] pointer-events-none z-0"></div>

        <div class="min-h-screen relative z-10">
            @include('layouts.navigation')

            @if (isset($header))
                <header class="bg-slate-800/40 backdrop-blur-md border-b border-slate-700/50 shadow-lg">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>