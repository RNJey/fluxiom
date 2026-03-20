<div class="node {{ $task->status }}">
    <small style="color: #38bdf8;">{{ strtoupper($task->status) }}</small>
    <h3 style="margin: 5px 0;">{{ $task->title }}</h3>
    <p style="font-size: 12px; color: #94a3b8;">{{ $task->description }}</p>
    
    @if ($task->status == 'available')
        <form action="{{ route('task.complete', $task->id) }}" method="POST">
            @csrf
            <button type="submit">Unlock Next Path</button>
        </form>
    @endif
</div>