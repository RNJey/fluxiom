<x-app-layout>
    <div class="py-12 bg-gray-900 min-h-screen text-white">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 p-8 rounded-xl shadow-lg border border-blue-500">
                <h1 class="text-3xl font-bold text-blue-400 mb-4">{{ $task->title }}</h1>
                
                <div class="prose prose-invert max-w-none mb-10 text-gray-300">
                    {!! nl2br(e($task->content ?? 'Materi belum tersedia untuk quest ini.')) !!}
                </div>

                <div class="flex justify-between items-center border-t border-gray-700 pt-6">
                    <a href="{{ route('dashboard') }}" class="text-gray-400 hover:text-white transition">← Kembali ke Map</a>
                    
                    {{-- Notifikasi Jika Salah Jawaban --}}
                @if(session('error'))
                    <div class="mb-6 bg-red-500/20 border border-red-500 text-red-300 px-4 py-3 rounded text-center font-bold animate-bounce">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="border-t border-gray-700 pt-6 mt-10">
                    @if($task->status == 'available')
                        
                        {{-- KOTAK KUIS --}}
                        @if($task->quiz_question)
                        <div class="bg-gray-900 border border-blue-500/50 p-6 rounded-lg mb-6 shadow-[0_0_15px_rgba(59,130,246,0.2)]">
                            <h3 class="text-xl font-bold text-blue-400 mb-4">Ujian Pemahaman</h3>
                            <p class="text-white mb-4">{{ $task->quiz_question }}</p>
                            
                            <form action="{{ route('task.complete', $task->id) }}" method="POST">
                                @csrf
                                <div class="space-y-3 mb-6">
                                    @php $options = json_decode($task->quiz_options, true); @endphp
                                    @if(is_array($options))
                                        @foreach($options as $option)
                                        <label class="flex items-center space-x-3 bg-gray-800 p-3 rounded-md cursor-pointer hover:bg-gray-700 transition border border-gray-700 hover:border-blue-400">
                                            <input type="radio" name="answer" value="{{ $option }}" required class="form-radio text-blue-500 bg-gray-900 border-gray-600 focus:ring-blue-500">
                                            <span class="text-gray-300">{{ $option }}</span>
                                        </label>
                                        @endforeach
                                    @endif
                                </div>
                                <button type="submit" class="w-full bg-green-600 hover:bg-green-500 text-white font-bold py-3 px-10 rounded-full shadow-[0_0_20px_rgba(34,197,94,0.4)] transition">
                                    Kirim Jawaban & Klaim {{ $task->xp_reward }} XP!
                                </button>
                            </form>
                        </div>
                        @else
                            {{-- Fallback jika AI gagal buat kuis --}}
                            <form action="{{ route('task.complete', $task->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-green-600 hover:bg-green-500 text-white font-bold py-3 px-10 rounded-full transition">Selesaikan Quest!</button>
                            </form>
                        @endif

                    @else
                        <span class="text-green-400 font-bold block text-center bg-green-900/30 p-4 rounded-lg border border-green-500/50">
                            ✓ Quest Diselesaikan dengan Sempurna
                        </span>
                    @endif
                </div>
                
                <div class="mt-4 text-center">
                    <a href="{{ route('dashboard') }}" class="text-gray-400 hover:text-white transition">← Kembali ke Map</a>
                </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>