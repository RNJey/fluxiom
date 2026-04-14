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

            {{-- PERBAIKAN: Cek apakah kedua array kosong --}}
            @if(count($activeTasks) == 0 && count($historyTasks) == 0)
                <div class="text-center mt-10">
                    <h3 class="text-2xl font-bold text-gray-800 dark:text-gray-300 mb-4">Skill Tree Anda Masih Kosong</h3>
                    <p class="text-gray-600 dark:text-gray-500 mb-6">Upload silabus kuliah Anda dan biarkan AI menyusun peta kompetensinya!</p>
                    <a href="{{ route('tasks.autoCreate') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-full shadow-[0_0_20px_rgba(79,70,229,0.5)] transition inline-block">
                        🚀 Generate Skill Tree Baru
                    </a>
                </div>
            @else

                <div class="bg-gray-800 p-6 rounded-xl shadow-lg border border-gray-700 mb-8 max-w-4xl mx-auto">
                    
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

                    <div class="flex items-center justify-between mb-2">
                        <div class="flex items-center space-x-4">
                            <div class="bg-indigo-600 rounded-full h-16 w-16 flex items-center justify-center border-4 border-indigo-400 shadow-[0_0_15px_rgba(79,70,229,0.5)]">
                                <span class="text-2xl font-bold text-white">{{ auth()->user()->level }}</span>
                            </div>
                            <div>
                                <h2 class="text-2xl font-bold text-white">{{ auth()->user()->name }}</h2>
                                <p class="text-indigo-400 font-bold uppercase tracking-widest text-sm">{{ auth()->user()->gelar }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="text-2xl font-bold text-yellow-400">{{ auth()->user()->xp }} XP</span>
                            <p class="text-gray-400 text-sm">Next Level: {{ auth()->user()->level * 500 }} XP</p>
                        </div>
                    </div>

                    @php
                        $currentLevelXp = auth()->user()->xp % 500;
                        $progressPercentage = ($currentLevelXp / 500) * 100;
                    @endphp
                    
                    <div class="w-full bg-gray-900 rounded-full h-4 mt-4 border border-gray-700">
                        <div class="bg-gradient-to-r from-blue-500 to-indigo-500 h-full rounded-full transition-all duration-1000 shadow-[0_0_10px_rgba(59,130,246,0.8)]" style="width: {{ $progressPercentage }}%"></div>
                    </div>
                </div>

                @if($isAllCompleted)
                    <div class="max-w-4xl mx-auto mb-8 bg-gradient-to-r from-green-600 to-emerald-800 p-8 rounded-xl shadow-[0_0_30px_rgba(16,185,129,0.4)] text-center border border-green-400">
                        <h2 class="text-3xl font-bold text-white mb-2">🎉 Selamat! Semua Quest Diselesaikan!</h2>
                        <p class="text-green-100 mb-6">Anda telah menamatkan seluruh kurikulum. AI telah menganalisis performa Anda.</p>

                        <div class="flex justify-center gap-4">
                            <a href="#" class="bg-white text-green-700 font-bold py-3 px-8 rounded-full hover:bg-gray-100 transition shadow-lg">
                                📄 Download PDF Summary & Sertifikat
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

                @if(count($historyTasks) > 0)
                    <div class="mt-20 pt-10 border-t border-gray-700 opacity-75 hover:opacity-100 transition">
                        <h3 class="text-xl font-bold text-gray-400 text-center mb-6">📚 Archive / History</h3>
                        <div class="tree-container w-full overflow-x-auto pb-10 scale-90 origin-top">
                            <div style="display: flex; justify-content: center; align-items: flex-start; gap: 60px; padding: 0 40px;">
                                @foreach ($historyTasks as $task)
                                    @include('partials.tree_branch', ['task' => $task])
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

            @endif

        </div>
    </div>
</x-app-layout>