<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Fluxiom: Engineer\'s Journey') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <style>
                .tree-container { background: #0f172a; padding: 40px; border-radius: 12px; color: white; overflow-x: auto; }
                .node-container { display: flex; flex-direction: column; align-items: center; }
                .branch { display: flex; justify-content: center; gap: 40px; margin-top: 0; }
                .node { background: #1e293b; border: 2px solid #334155; padding: 20px; width: 250px; border-radius: 15px; text-align: center; transition: 0.4s; }
                .available { border-color: #10b981; box-shadow: 0 0 15px #10b98155; }
                .completed { border-color: #38bdf8; background: #0c4a6e; }
                .locked { opacity: 0.5; border-style: dashed; }
                .unlock-btn { background: #10b981; border: none; color: white; padding: 10px; width: 100%; border-radius: 8px; cursor: pointer; font-weight: bold; margin-top: 10px; }
                .unlock-btn:hover { background: #059669; }
                .line { width: 2px; height: 40px; background: #334155; margin: 0; }
            </style>

            {{-- Cek apakah user sama sekali belum punya task (aktif maupun tamat) --}}
            @if(count($activeTasks) == 0 && !$isAllCompleted)
                <div class="text-center mt-10">
                    <h3 class="text-2xl font-bold text-gray-800 dark:text-gray-300 mb-4">Skill Tree Anda Masih Kosong</h3>
                    <p class="text-gray-600 dark:text-gray-500 mb-6">Upload silabus kuliah Anda dan biarkan AI menyusun peta kompetensinya!</p>
                    <a href="{{ route('tasks.autoCreate') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-full shadow-[0_0_20px_rgba(79,70,229,0.5)] transition inline-block">
                        🚀 Generate Skill Tree Baru
                    </a>
                </div>
            @else

                <div class="bg-slate-800/50 backdrop-blur-xl p-6 rounded-3xl shadow-lg border border-slate-700/50 mb-8 max-w-4xl mx-auto transition-all">
                    
                    @if(session('level_up'))
                        <div class="mb-4 bg-yellow-500/20 border border-yellow-500 text-yellow-300 px-4 py-3 rounded text-center font-bold animate-pulse shadow-[0_0_15px_rgba(234,179,8,0.5)]">
                            {{ session('level_up') }}
                        </div>
                    @endif
                    @if(session('success'))
                        <div class="mb-4 text-green-400 text-sm font-bold text-center">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="flex flex-col md:flex-row items-center justify-between gap-6 mb-4 text-center md:text-left">
                        
                        <div class="flex flex-col md:flex-row items-center space-y-4 md:space-y-0 md:space-x-4">
                            <div class="bg-blue-600/20 rounded-full h-20 w-20 flex items-center justify-center border-4 border-blue-500 shadow-[0_0_15px_rgba(59,130,246,0.5)] relative">
                                <div class="absolute inset-0 bg-blue-500 rounded-full blur-md opacity-40"></div>
                                <span class="text-3xl font-black text-white relative z-10">{{ auth()->user()->level }}</span>
                            </div>
                            <div>
                                <h2 class="text-2xl font-bold text-white">{{ auth()->user()->name }}</h2>
                                <p class="text-blue-400 font-bold uppercase tracking-widest text-sm bg-blue-900/30 px-3 py-1 rounded-full inline-block mt-2 border border-blue-500/30">
                                    {{ auth()->user()->gelar }}
                                </p>
                            </div>
                        </div>

                        <div class="bg-slate-900/50 px-6 py-3 rounded-2xl border border-slate-700 w-full md:w-auto">
                            <div class="text-3xl font-black text-transparent bg-clip-text bg-gradient-to-r from-yellow-400 to-amber-600">{{ auth()->user()->xp }} XP</div>
                            <p class="text-slate-400 text-sm font-medium mt-1">Next: {{ auth()->user()->level * 500 }} XP</p>
                        </div>
                    </div>

                    @php
                        $currentLevelXp = auth()->user()->xp % 500;
                        $progressPercentage = ($currentLevelXp / 500) * 100;
                    @endphp
                    
                    <div class="w-full bg-slate-900 rounded-full h-3 mt-2 border border-slate-700 overflow-hidden relative">
                        <div class="bg-gradient-to-r from-blue-500 to-indigo-500 h-full rounded-full transition-all duration-1000 shadow-[0_0_10px_rgba(59,130,246,0.8)] relative" style="width: {{ $progressPercentage }}%">
                            <div class="absolute top-0 right-0 bottom-0 w-10 bg-gradient-to-r from-transparent to-white opacity-30"></div>
                        </div>
                    </div>
                </div>

                @if($isAllCompleted)
                    <div class="max-w-4xl mx-auto mb-8 bg-gradient-to-r from-green-600 to-emerald-800 p-8 rounded-xl shadow-[0_0_30px_rgba(16,185,129,0.4)] text-center border border-green-400">
                        <h2 class="text-3xl font-bold text-white mb-2">🎉 Selamat! Semua Quest Diselesaikan!</h2>
                        <p class="text-green-100 mb-6">Anda telah menamatkan seluruh kurikulum. AI telah menganalisis performa Anda.</p>

                        <div class="flex justify-center gap-4">
                            {{-- Tombol ini sekarang mengarah ke halaman History --}}
                            <a href="{{ route('history') }}" class="bg-white text-green-700 font-bold py-3 px-8 rounded-full hover:bg-gray-100 transition shadow-lg">
                                📂 Buka Arsip & Unduh Sertifikat
                            </a>

                            <a href="{{ route('tasks.autoCreate') }}" class="bg-gray-900 text-white border border-gray-500 font-bold py-3 px-8 rounded-full hover:bg-gray-800 transition">
                                🚀 Generate Skill Tree Baru
                            </a>
                        </div>
                    </div>
                @endif

                @if(count($activeTasks) > 0)
                    <h3 class="text-2xl font-bold text-white text-center mb-6">Active Quests</h3>
                    <div class="tree-container w-full overflow-x-auto pb-10">
                        <div style="display: flex; justify-content: center; align-items: flex-start; gap: 80px; padding: 0 40px;">
                            @foreach ($activeTasks as $task)
                                @include('partials.tree_branch', ['task' => $task])
                            @endforeach
                        </div>
                    </div>
                @endif

            @endif

        </div>
    </div>
</x-app-layout>