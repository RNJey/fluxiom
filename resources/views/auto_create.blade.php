<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-200 leading-tight flex items-center gap-2">
            <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
            {{ __('AI Generator Engine') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-slate-800/50 backdrop-blur-xl border border-slate-700/50 p-8 md:p-10 rounded-3xl shadow-[0_0_40px_rgba(0,0,0,0.3)]">
                
                <div class="text-center mb-8">
                    <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-blue-500/10 text-blue-400 mb-6 border border-blue-500/30 shadow-[0_0_30px_rgba(59,130,246,0.3)]">
                        <svg class="w-10 h-10 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h3 class="text-3xl font-extrabold text-white mb-3 tracking-wide">Fluxiom AI Engine</h3>
                    <p class="text-slate-400 max-w-2xl mx-auto">
                        Masukkan silabus, modul, atau konsep mata kuliah yang ingin Anda pelajari. AI kami akan membedahnya dan menyusun Peta Kompetensi (Skill Tree) interaktif secara instan.
                    </p>
                </div>

                {{-- Pastikan action route-nya sesuai dengan nama route Anda untuk autoStore --}}
                <form action="{{ route('tasks.autoStore') }}" method="POST">
                    @csrf
                    
                    <div class="mb-8 relative group">
                        <div class="absolute -inset-0.5 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-2xl blur opacity-20 group-hover:opacity-40 transition duration-1000 group-hover:duration-200"></div>
                        <div class="relative bg-slate-900 rounded-xl">
                            <div class="flex items-center justify-between px-5 py-3 border-b border-slate-700/50">
                                <span class="text-xs font-mono text-slate-400 uppercase tracking-widest">Input Data Array</span>
                                <div class="flex space-x-2">
                                    <div class="w-3 h-3 rounded-full bg-red-500/50"></div>
                                    <div class="w-3 h-3 rounded-full bg-yellow-500/50"></div>
                                    <div class="w-3 h-3 rounded-full bg-green-500/50"></div>
                                </div>
                            </div>
                            <textarea id="syllabus" name="syllabus" rows="6" required
                                class="w-full px-5 py-4 bg-transparent border-none text-slate-200 placeholder-slate-600 focus:ring-0 transition outline-none resize-none font-mono text-sm leading-relaxed" 
                                placeholder="> Ketikkan materi di sini...&#10;> Contoh: Buatkan alur belajar Fullstack Web Developer mulai dari dasar HTML, styling layout, hingga pembuatan database MySQL dan API..."></textarea>
                        </div>
                    </div>
                    
                    <button type="submit" class="w-full relative inline-flex items-center justify-center px-8 py-4 font-bold text-white transition-all duration-200 bg-gradient-to-r from-blue-600 to-indigo-600 border border-transparent rounded-xl hover:from-blue-500 hover:to-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600 hover:shadow-[0_0_30px_rgba(79,70,229,0.5)] transform hover:-translate-y-1">
                        <span class="mr-3 text-lg">Mulai Kompilasi Skill Tree</span>
                        <svg class="w-6 h-6 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
                    </button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>