<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Learning History & Certificates') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <style>
                /* Gunakan CSS yang sama dengan dashboard agar pohonnya rapi */
                .tree-container { padding: 40px; color: white; overflow-x: auto; }
                .node-group { display: flex; flex-direction: column; align-items: center; }
                .branch { display: flex; justify-content: center; gap: 40px; margin-top: 0; }
                .node { background: #1e293b; border: 2px solid #38bdf8; padding: 20px; width: 250px; border-radius: 15px; text-align: center; }
                .completed { background: #0c4a6e; }
                .line { width: 2px; height: 40px; background: #334155; margin: 0; }
            </style>

            <div class="bg-gray-800 p-8 rounded-xl shadow-lg border border-gray-700">
                <div class="flex justify-between items-center mb-8 border-b border-gray-700 pb-4">
                    <div>
                        <h3 class="text-3xl font-bold text-white">Arsip Perjalanan Engineer</h3>
                        <p class="text-gray-400 mt-2">Daftar kurikulum yang telah Anda tamatkan dengan sempurna.</p>
                    </div>
                    
                    <a href="{{ route('history.pdf') }}" target="_blank" class="bg-blue-600 hover:bg-blue-500 text-white font-bold py-3 px-6 rounded-lg shadow-lg flex items-center gap-2 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        Download Laporan AI (PDF)
                    </a>
                </div>

                @if(count($historyTasks) == 0)
                    <div class="text-center py-10">
                        <p class="text-gray-500 text-lg">Belum ada kurikulum yang diselesaikan 100%.</p>
                    </div>
                @else
                    <div class="tree-container w-full overflow-x-auto opacity-90 scale-95 origin-top">
                        <div style="display: flex; justify-content: center; align-items: flex-start; gap: 80px; padding: 0 40px;">
                            @foreach ($historyTasks as $task)
                                @include('partials.tree_branch', ['task' => $task])
                            @endforeach
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>