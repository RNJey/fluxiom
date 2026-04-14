<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sertifikat Fluxiom</title>
    <style>
        body { font-family: 'Helvetica', 'Arial', sans-serif; color: #333; line-height: 1.6; }
        .container { border: 5px solid #1e3a8a; padding: 40px; border-radius: 10px; text-align: center; margin: 20px; }
        .header { margin-bottom: 30px; border-bottom: 2px solid #e5e7eb; padding-bottom: 20px; }
        .logo-text { font-size: 28px; font-weight: bold; color: #1e3a8a; letter-spacing: 2px; }
        .title { font-size: 40px; color: #111827; margin: 10px 0; }
        .subtitle { font-size: 18px; color: #6b7280; }
        .name { font-size: 32px; font-weight: bold; color: #2563eb; margin: 20px 0; text-decoration: underline; }
        .rank { font-size: 20px; font-weight: bold; background: #dbeafe; color: #1e40af; display: inline-block; padding: 5px 15px; border-radius: 20px; }
        .ai-summary { background: #f3f4f6; padding: 20px; border-left: 5px solid #3b82f6; margin: 30px 0; text-align: left; font-style: italic; }
        .modules { text-align: left; margin-top: 30px; }
        .modules ul { list-style-type: square; padding-left: 20px; }
        .modules li { margin-bottom: 5px; font-size: 14px; }
        .footer { margin-top: 50px; font-size: 12px; color: #9ca3af; text-align: center; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo-text">FLUXIOM</div>
            <div style="font-size: 14px; color: #666;">Engineer's Journey Record</div>
        </div>

        <div class="subtitle">Diberikan sebagai penghargaan atas dedikasi dan kerja keras kepada:</div>
        <div class="name">{{ $user->name }}</div>
        
        <div>Telah resmi mencapai gelar:</div>
        <div class="rank">{{ $user->gelar }}</div>

        <div class="ai-summary">
            <strong>Analisis AI (Gemini):</strong><br><br>
            {{ $aiSummary }}
        </div>

        <div class="modules">
            <h3 style="color: #1f2937; border-bottom: 1px solid #ccc; padding-bottom: 5px;">Modul yang Diselesaikan:</h3>
            <ul>
                @foreach($completedTasks as $task)
                    <li><strong>{{ $task->title }}</strong> - <span style="color: #666;">{{ $task->xp_reward }} XP</span></li>
                @endforeach
            </ul>
        </div>

        <div class="footer">
            <p>Dokumen ini di-generate secara otomatis oleh Sistem Cerdas Fluxiom pada {{ date('d F Y') }}.</p>
        </div>
    </div>
</body>
</html>