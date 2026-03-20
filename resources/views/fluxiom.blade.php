<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Fluxiom Mastery Tree</title>
    <style>
        body { background: #0f172a; color: white; font-family: sans-serif; padding: 50px; }
        .wrapper { display: flex; flex-direction: column; align-items: center; }
        .branch { display: flex; justify-content: center; gap: 30px; margin-top: 40px; position: relative; }
        .node { 
            background: #1e293b; border: 2px solid #334155; padding: 20px; 
            width: 250px; border-radius: 15px; text-align: center; transition: 0.4s;
        }
        .available { border-color: #10b981; box-shadow: 0 0 15px #10b98155; }
        .completed { border-color: #38bdf8; background: #0c4a6e; }
        .locked { opacity: 0.5; border-style: dashed; }
        button { 
            background: #10b981; border: none; color: white; padding: 10px; 
            width: 100%; border-radius: 8px; cursor: pointer; font-weight: bold; margin-top: 10px;
        }
        .line { width: 2px; height: 40px; background: #334155; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h1>FLUXIOM : Engineer's Journey</h1>
        
        @foreach ($tasks as $task)
            {{-- Level 1 --}}
            @include('partials.task_node', ['task' => $task])

            @if ($task->children->count() > 0)
                <div class="line"></div>
                <div class="branch">
                    @foreach ($task->children as $child)
                        <div>
                            {{-- Level 2 --}}
                            @include('partials.task_node', ['task' => $child])

                            @if ($child->children->count() > 0)
                                <div class="line"></div>
                                <div class="branch">
                                    @foreach ($child->children as $grandchild)
                                        {{-- Level 3 --}}
                                        @include('partials.task_node', ['task' => $grandchild])
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
        @endforeach
    </div>
</body>
</html>