<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            ✨ {{ __('AI Automated Quest Architect') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <div class="mb-6 bg-indigo-50 dark:bg-indigo-900/30 p-4 rounded-lg border border-indigo-200 dark:border-indigo-800">
                    <h3 class="text-indigo-800 dark:text-indigo-300 font-bold mb-2">Cara Kerja AI:</h3>
                    <ul class="list-disc list-inside text-sm text-indigo-700 dark:text-indigo-400">
                        <li>Copy teks dari file PDF Silabus/RPS (Rencana Pembelajaran Semester) mata kuliah Anda.</li>
                        <li>Paste ke dalam kotak di bawah ini.</li>
                        <li>AI akan menganalisis topik pembelajaran, menentukan jumlah XP, dan menyusun cabangnya secara otomatis!</li>
                    </ul>
                </div>

                @if($errors->any())
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                        <strong>Error:</strong> {{ $errors->first() }}
                    </div>
                @endif
                
                <form action="{{ route('tasks.autoStore') }}" method="POST">
                    @csrf
                    
                    <div class="mb-6">
                        <label class="block text-gray-800 dark:text-gray-300 text-sm font-bold mb-2">Paste Teks Silabus / RPS / Rangkuman Materi Di Sini:</label>
                        <textarea name="syllabus" rows="12" required placeholder="Contoh: Mata kuliah Pemrograman Web bertujuan agar mahasiswa memahami HTML, CSS, lalu dilanjutkan dengan PHP dan Framework Laravel..." class="w-full bg-gray-50 text-gray-900 rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm"></textarea>
                    </div>

                    <div class="flex justify-end items-center border-t border-gray-200 dark:border-gray-700 pt-5 space-x-6">
                        <a href="{{ route('dashboard') }}" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white font-medium transition">
                            Kembali
                        </a>
                        <button type="submit" onclick="this.innerHTML='Sedang Berpikir...'; this.classList.add('opacity-70');" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-md shadow-[0_0_15px_rgba(79,70,229,0.5)] transition flex items-center">
                            🚀 Generate Skill Tree
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>