@php
    // Ambil status dari array user, kalau tidak ada, default-nya 'locked'
    $myStatus = $userStatuses[$task->id] ?? 'locked';
@endphp

<div class="node {{ $myStatus }}">
    <small style="color: #38bdf8;">{{ strtoupper($myStatus) }}</small>
    <h3 style="margin: 5px 0;">{{ $task->title }}</h3>
    <p style="font-size: 12px; color: #94a3b8;">{{ $task->description }}</p>
    
    @if ($myStatus == 'available')
        <form action="{{ route('task.complete', $task->id) }}" method="POST">
            @csrf
            <button type="submit" class="unlock-btn">Unlock Next Path</button>
        </form>
    @endif
</div>