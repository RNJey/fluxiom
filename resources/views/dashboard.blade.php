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

            @if($tasks->isEmpty())
                <div class="text-center mt-10">
                    <h3 class="text-2xl font-bold text-gray-800 dark:text-gray-300 mb-4">Skill Tree Anda Masih Kosong</h3>
                    <p class="text-gray-600 dark:text-gray-500 mb-6">Upload silabus kuliah Anda dan biarkan AI menyusun peta kompetensinya!</p>
                    <a href="{{ route('tasks.autoCreate') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-full shadow-[0_0_20px_rgba(79,70,229,0.5)] transition inline-block">
                        🚀 Generate Skill Tree Baru
                    </a>
                </div>
            @else
                <div class="tree-container">
                    @foreach ($tasks as $task)
                        <div class="node-container">
                            {{-- Level 1 --}}
                            @include('partials.task_node', ['task' => $task])

                            @if ($task->children->count() > 0)
                                <div class="line"></div>
                                <div class="branch">
                                    @foreach ($task->children as $child)
                                        <div class="node-container">
                                            {{-- Level 2 --}}
                                            @include('partials.task_node', ['task' => $child])

                                            @if ($child->children->count() > 0)
                                                <div class="line"></div>
                                                <div class="branch">
                                                    @foreach ($child->children as $grandchild)
                                                        <div class="node-container">
                                                            {{-- Level 3 --}}
                                                            @include('partials.task_node', ['task' => $grandchild])
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</x-app-layout>