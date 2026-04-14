<div class="node-group" style="display: flex; flex-direction: column; align-items: center;">
    
    {{-- 1. Tampilkan Kotak Materi Saat Ini --}}
    @include('partials.task_node', ['task' => $task])

    {{-- 2. Jika punya anak, panggil file INI SENDIRI (Teknik Rekursif) --}}
    @if ($task->children->count() > 0)
        <div class="branch" style="display: flex; gap: 20px; margin-top: 20px; border-top: 2px solid #38bdf8; padding-top: 20px; position: relative;">
            
            {{-- Garis vertikal penghubung (Opsional untuk mempercantik) --}}
            <div style="position: absolute; top: 0; left: 50%; width: 2px; height: 20px; background-color: #38bdf8; transform: translateX(-50%); mt:-20px;"></div>

            @foreach ($task->children as $child)
                {{-- PERHATIKAN: Dia memanggil 'tree_branch' lagi --}}
                @include('partials.tree_branch', ['task' => $child])
            @endforeach
        </div>
    @endif

</div>