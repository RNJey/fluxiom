<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Fluxiom</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-900 min-h-screen flex items-center justify-center antialiased relative overflow-hidden">
    
    <div class="absolute top-[-10%] left-[-10%] w-96 h-96 bg-blue-600/20 rounded-full blur-[100px] pointer-events-none"></div>
    <div class="absolute bottom-[-10%] right-[-10%] w-96 h-96 bg-indigo-600/20 rounded-full blur-[100px] pointer-events-none"></div>

    <div class="relative z-10 w-full max-w-md p-8 bg-slate-800/50 backdrop-blur-xl border border-slate-700/50 rounded-3xl shadow-[0_0_40px_rgba(0,0,0,0.5)] transform transition-all">
        
        <div class="flex justify-center mb-6">
            <a href="/" class="flex items-center gap-2 group">
                <svg class="w-10 h-10 text-blue-500 group-hover:text-blue-400 transition-transform duration-300 transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                <span class="text-3xl font-black bg-clip-text text-transparent bg-gradient-to-r from-blue-400 to-indigo-500 tracking-wider">FLUXIOM</span>
            </a>
        </div>

        <h2 class="text-2xl font-bold text-white mb-2 text-center">Welcome Back, Engineer!</h2>
        <p class="text-slate-400 text-center text-sm mb-8">Masuk untuk melanjutkan progres Skill Tree Anda.</p>

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium text-slate-400 mb-1">Email Address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" 
                    class="w-full px-4 py-3 rounded-xl bg-slate-900/50 border border-slate-700 text-white placeholder-slate-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/50 transition outline-none" placeholder="engineer@fluxiom.com">
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
            </div>

            <div>
                <div class="flex justify-between items-center mb-1">
                    <label for="password" class="block text-sm font-medium text-slate-400">Password</label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-xs text-blue-400 hover:text-blue-300 transition">Forgot password?</a>
                    @endif
                </div>
                <input id="password" type="password" name="password" required autocomplete="current-password" 
                    class="w-full px-4 py-3 rounded-xl bg-slate-900/50 border border-slate-700 text-white placeholder-slate-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/50 transition outline-none" placeholder="••••••••">
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400" />
            </div>

            <div class="flex items-center">
                <input id="remember_me" type="checkbox" name="remember" class="w-4 h-4 rounded bg-slate-900 border-slate-700 text-blue-500 focus:ring-blue-500/50 focus:ring-offset-slate-900">
                <label for="remember_me" class="ml-2 text-sm text-slate-400 cursor-pointer">Remember me</label>
            </div>

            <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-white font-bold py-3.5 rounded-xl shadow-[0_0_20px_rgba(37,99,235,0.4)] transform hover:-translate-y-0.5 transition-all">
                Login to Dashboard
            </button>

            <p class="text-center text-sm text-slate-400 mt-6">
                Belum punya akun? <a href="{{ route('register') }}" class="text-blue-400 hover:text-blue-300 font-semibold transition">Daftar sekarang</a>
            </p>
        </form>
    </div>
</body>
</html>