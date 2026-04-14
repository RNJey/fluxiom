<div class="node {{ $task->status }}">
    <small style="color: #38bdf8;">{{ strtoupper($task->status) }}</small>
    <h3 style="margin: 5px 0;">{{ $task->title }}</h3>
    <p style="font-size: 12px; color: #94a3b8;">{{ $task->description }}</p>
    
    @if ($task->status != 'locked')
    <a href="{{ route('task.show', $task->id) }}" class="inline-block mt-3 bg-blue-600 hover:bg-blue-500 text-white text-xs font-bold py-2 px-4 rounded-full transition">
        {{ $task->status == 'completed' ? 'Lihat Materi' : 'Mulai Belajar' }}
    </a>
    @else
    <div class="mt-3 text-gray-500 text-xs italic">🔒 Terkunci</div>
    @endif
</div>