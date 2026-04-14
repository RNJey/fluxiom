<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Fluxiom - Engineer's Journey</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body { background-color: #0f172a; color: white; overflow-x: hidden; }
        .glass-panel { background: rgba(30, 41, 59, 0.7); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.1); }
        
        /* Animasi Mengambang (Floating) */
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }
        .animate-float { animation: float 6s ease-in-out infinite; }
        
        /* Animasi Fade In Naik */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .fade-in-up { animation: fadeInUp 1s ease-out forwards; opacity: 0; }
        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; }
    </style>
</head>
<body class="antialiased selection:bg-blue-500 selection:text-white">

    <nav class="absolute w-full z-50 px-8 py-6 flex justify-between items-center">
        <div class="flex items-center gap-2">
            <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
            <span class="text-2xl font-black bg-clip-text text-transparent bg-gradient-to-r from-blue-400 to-indigo-500 tracking-wider">FLUXIOM</span>
        </div>
        <div>
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-gray-300 hover:text-white font-semibold transition px-4">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-gray-300 hover:text-white font-semibold transition px-4">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-500 text-white px-6 py-2 rounded-full font-bold transition shadow-[0_0_15px_rgba(37,99,235,0.5)]">Daftar</a>
                    @endif
                @endauth
            @endif
        </div>
    </nav>

    <div class="relative min-h-screen flex items-center justify-center pt-20">
        <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-blue-600/20 rounded-full blur-[100px]"></div>
        <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-indigo-600/20 rounded-full blur-[100px]"></div>

        <div class="relative z-10 text-center max-w-4xl px-6">
            <div class="inline-block mb-4 px-4 py-1 rounded-full border border-blue-500/30 bg-blue-500/10 text-blue-400 text-sm font-semibold tracking-wide fade-in-up">
                Generasi Baru Learning Management System
            </div>
            
            <h1 class="text-5xl md:text-7xl font-extrabold mb-6 leading-tight fade-in-up delay-100">
                Peta Perjalanan Seorang <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 via-indigo-400 to-purple-400 animate-pulse">Master Engineer</span>
            </h1>
            
            <p class="text-lg md:text-xl text-gray-400 mb-10 max-w-2xl mx-auto fade-in-up delay-200">
                Ubah silabus kuliahmu menjadi petualangan epik. Dibekali AI pintar yang menyusun Skill Tree interaktif, memberikan kuis adaptif, dan mengevaluasi perkembanganmu secara real-time.
            </p>
            
            <div class="fade-in-up delay-300">
                @auth
                    <a href="{{ url('/dashboard') }}" class="inline-block bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-white font-bold text-lg py-4 px-10 rounded-full shadow-[0_0_30px_rgba(59,130,246,0.6)] transform hover:scale-105 transition-all">
                        Lanjutkan Perjalanan ➔
                    </a>
                @else
                    <a href="{{ route('register') }}" class="inline-block bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-white font-bold text-lg py-4 px-10 rounded-full shadow-[0_0_30px_rgba(59,130,246,0.6)] transform hover:scale-105 transition-all">
                        Mulai Petualangan Sekarang
                    </a>
                @endauth
            </div>
        </div>
    </div>

    <div class="py-20 relative z-10 px-6 max-w-7xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <div class="glass-panel p-8 rounded-2xl hover:-translate-y-2 transition-transform duration-300 animate-float" style="animation-delay: 0s;">
                <div class="bg-blue-900/50 w-14 h-14 rounded-lg flex items-center justify-center mb-6 border border-blue-500/50">
                    <svg class="w-8 h-8 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"></path></svg>
                </div>
                <h3 class="text-2xl font-bold mb-3 text-white">AI Skill Tree</h3>
                <p class="text-gray-400">Peta pembelajaran bercabang yang di-generate otomatis oleh AI berdasarkan input silabus Anda.</p>
            </div>

            <div class="glass-panel p-8 rounded-2xl hover:-translate-y-2 transition-transform duration-300 animate-float" style="animation-delay: 1s;">
                <div class="bg-indigo-900/50 w-14 h-14 rounded-lg flex items-center justify-center mb-6 border border-indigo-500/50">
                    <svg class="w-8 h-8 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="text-2xl font-bold mb-3 text-white">Gamifikasi Kuis</h3>
                <p class="text-gray-400">Bukan sekadar membaca. Selesaikan ujian pilihan ganda di setiap materi untuk mengumpulkan XP dan naik level.</p>
            </div>

            <div class="glass-panel p-8 rounded-2xl hover:-translate-y-2 transition-transform duration-300 animate-float" style="animation-delay: 2s;">
                <div class="bg-purple-900/50 w-14 h-14 rounded-lg flex items-center justify-center mb-6 border border-purple-500/50">
                    <svg class="w-8 h-8 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </div>
                <h3 class="text-2xl font-bold mb-3 text-white">Sertifikat Cerdas</h3>
                <p class="text-gray-400">Dapatkan dokumen kelulusan berformat PDF lengkap dengan analisis spesifik dan gelar dari AI Evaluator.</p>
            </div>

        </div>
    </div>
</body>
</html>