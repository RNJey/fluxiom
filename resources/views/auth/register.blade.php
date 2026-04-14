<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register - Fluxiom</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-900 min-h-screen flex items-center justify-center antialiased relative overflow-hidden py-10">
    
    <div class="absolute top-[10%] right-[-5%] w-96 h-96 bg-purple-600/20 rounded-full blur-[100px] pointer-events-none"></div>
    <div class="absolute bottom-[10%] left-[-5%] w-96 h-96 bg-blue-600/20 rounded-full blur-[100px] pointer-events-none"></div>

    <div class="relative z-10 w-full max-w-md p-8 bg-slate-800/50 backdrop-blur-xl border border-slate-700/50 rounded-3xl shadow-[0_0_40px_rgba(0,0,0,0.5)]">
        
        <div class="flex justify-center mb-6">
            <a href="/" class="flex items-center gap-2 group">
                <svg class="w-8 h-8 text-indigo-500 group-hover:text-indigo-400 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                <span class="text-2xl font-black bg-clip-text text-transparent bg-gradient-to-r from-indigo-400 to-purple-500 tracking-wider">FLUXIOM</span>
            </a>
        </div>

        <h2 class="text-2xl font-bold text-white mb-2 text-center">Mulai Perjalananmu</h2>
        <p class="text-slate-400 text-center text-sm mb-8">Buat akun untuk generate Skill Tree pertamamu.</p>

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-slate-400 mb-1">Nama Lengkap</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" 
                    class="w-full px-4 py-3 rounded-xl bg-slate-900/50 border border-slate-700 text-white placeholder-slate-500 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/50 transition outline-none">
                <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-400" />
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-slate-400 mb-1">Email Address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" 
                    class="w-full px-4 py-3 rounded-xl bg-slate-900/50 border border-slate-700 text-white placeholder-slate-500 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/50 transition outline-none">
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-slate-400 mb-1">Password</label>
                <input id="password" type="password" name="password" required autocomplete="new-password" 
                    class="w-full px-4 py-3 rounded-xl bg-slate-900/50 border border-slate-700 text-white placeholder-slate-500 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/50 transition outline-none">
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400" />
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-slate-400 mb-1">Konfirmasi Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" 
                    class="w-full px-4 py-3 rounded-xl bg-slate-900/50 border border-slate-700 text-white placeholder-slate-500 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/50 transition outline-none">
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-400" />
            </div>

            <button type="submit" class="w-full mt-4 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-500 hover:to-purple-500 text-white font-bold py-3.5 rounded-xl shadow-[0_0_20px_rgba(79,70,229,0.4)] transform hover:-translate-y-0.5 transition-all">
                Daftar Sekarang
            </button>

            <p class="text-center text-sm text-slate-400 mt-6">
                Sudah punya akun? <a href="{{ route('login') }}" class="text-indigo-400 hover:text-indigo-300 font-semibold transition">Login di sini</a>
            </p>
        </form>
    </div>
</body>
</html>