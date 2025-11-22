<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SkillHub</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        /* Custom Scrollbar untuk kesan premium */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #09090b; }
        ::-webkit-scrollbar-thumb { background: #27272a; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #3f3f46; }
    </style>
</head>
<body class="bg-zinc-950 text-zinc-300 antialiased selection:bg-indigo-500 selection:text-white min-h-screen flex flex-col">

    <nav class="fixed w-full z-50 top-0 border-b border-zinc-800/50 bg-zinc-950/80 backdrop-blur-xl">
        <div class="max-w-6xl mx-auto px-6 h-16 flex items-center justify-between">
            <div class="flex items-center gap-10">
                <a href="/" class="text-xl font-bold text-white tracking-tight flex items-center gap-2">
                    <div class="w-3 h-3 bg-indigo-500 rounded-full"></div>
                    SkillHub.
                </a>
                <div class="hidden md:flex gap-1">
                    <a href="{{ route('students.index') }}" class="px-4 py-2 rounded-lg text-sm font-medium transition-all {{ request()->routeIs('students.*') ? 'bg-zinc-900 text-white' : 'text-zinc-400 hover:text-white hover:bg-zinc-900/50' }}">
                        Peserta
                    </a>
                    <a href="{{ route('courses.index') }}" class="px-4 py-2 rounded-lg text-sm font-medium transition-all {{ request()->routeIs('courses.*') ? 'bg-zinc-900 text-white' : 'text-zinc-400 hover:text-white hover:bg-zinc-900/50' }}">
                        Kelas
                    </a>
                    <a href="{{ route('enrollments.index') }}" class="px-4 py-2 rounded-lg text-sm font-medium transition-all {{ request()->routeIs('enrollments.*') ? 'bg-zinc-900 text-white' : 'text-zinc-400 hover:text-white hover:bg-zinc-900/50' }}">
                        Pendaftaran
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <main class="flex-grow pt-28 pb-12 w-full max-w-6xl mx-auto px-6">
        
        @if(session('success'))
            <div x-data="{ show: true }" x-show="show" class="mb-8 p-4 rounded-2xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-sm font-medium flex items-center justify-between animate-fade-in-down">
                <div class="flex items-center gap-3">
                    <span class="flex h-2 w-2 rounded-full bg-emerald-500"></span>
                    {{ session('success') }}
                </div>
                <button @click="show = false" class="text-emerald-500 hover:text-emerald-300">&times;</button>
            </div>
        @endif
        
        @if(session('error'))
            <div x-data="{ show: true }" x-show="show" class="mb-8 p-4 rounded-2xl bg-red-500/10 border border-red-500/20 text-red-400 text-sm font-medium flex items-center justify-between animate-fade-in-down">
                <div class="flex items-center gap-3">
                    <span class="flex h-2 w-2 rounded-full bg-red-500"></span>
                    {{ session('error') }}
                </div>
                <button @click="show = false" class="text-red-500 hover:text-red-300">&times;</button>
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-8 p-4 rounded-2xl bg-red-500/10 border border-red-500/20 text-red-400 text-sm">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="border-t border-zinc-900 py-8 text-center text-xs text-zinc-600">
        &copy; {{ date('Y') }} SkillHub Learning Center <br> --- <br> Developed for certification purposes <br> Reyhan Jason
    </footer>

</body>
</html>