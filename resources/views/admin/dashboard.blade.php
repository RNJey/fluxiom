<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Panel - Kelola Skill Tree') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-bold text-blue-400">Daftar Quest / Materi Pembelajaran</h3>
                        <button class="bg-emerald-500 hover:bg-emerald-600 text-white font-bold py-2 px-4 rounded-md transition">
                            + Tambah Quest Baru
                        </button>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-700 text-gray-300">
                                    <th class="p-3 rounded-tl-lg">ID</th>
                                    <th class="p-3">Judul Tugas</th>
                                    <th class="p-3">XP Reward</th>
                                    <th class="p-3">Syarat (Parent ID)</th>
                                    <th class="p-3 rounded-tr-lg">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tasks as $task)
                                <tr class="border-b border-gray-700 hover:bg-gray-700 transition">
                                    <td class="p-3">{{ $task->id }}</td>
                                    <td class="p-3 font-semibold">{{ $task->title }}</td>
                                    <td class="p-3 text-emerald-400">+{{ $task->xp_reward }} XP</td>
                                    <td class="p-3 text-gray-400">
                                        {{ $task->parent_id ? 'Node ' . $task->parent_id : 'Akar (Tanpa Syarat)' }}
                                    </td>
                                    <td class="p-3">
                                        <button class="text-yellow-400 hover:text-yellow-300 font-bold mr-3">Edit</button>
                                        <button class="text-red-400 hover:text-red-300 font-bold">Hapus</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>