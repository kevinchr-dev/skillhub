@extends('layout')

@section('content')
<div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-10">
    <div>
        <h1 class="text-3xl font-bold text-white tracking-tight">Dashboard</h1>
        <p class="text-zinc-500 mt-1">Selamat datang kembali di SkillHub Control Center.</p>
    </div>
    <div class="flex gap-3">
        <a href="{{ route('students.index') }}" class="px-4 py-2 bg-zinc-800 hover:bg-zinc-700 text-white text-sm font-medium rounded-xl transition-colors border border-zinc-700">
            + Peserta
        </a>
        <a href="{{ route('courses.index') }}" class="px-4 py-2 bg-white text-black hover:bg-zinc-200 text-sm font-medium rounded-xl transition-colors shadow-lg shadow-white/5">
            + Kelas Baru
        </a>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
    
    <div class="p-6 rounded-3xl bg-zinc-900/50 border border-zinc-800 relative overflow-hidden group hover:border-zinc-600 transition-all">
        <div class="relative z-10">
            <div class="flex items-center gap-3 mb-2 text-zinc-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                <span class="text-sm font-medium">Total Peserta</span>
            </div>
            <div class="text-4xl font-bold text-white">{{ $totalStudents }}</div>
        </div>
        <div class="absolute -right-6 -bottom-6 w-24 h-24 bg-indigo-500/20 rounded-full blur-2xl group-hover:bg-indigo-500/30 transition-all"></div>
    </div>

    <div class="p-6 rounded-3xl bg-zinc-900/50 border border-zinc-800 relative overflow-hidden group hover:border-zinc-600 transition-all">
        <div class="relative z-10">
            <div class="flex items-center gap-3 mb-2 text-zinc-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                <span class="text-sm font-medium">Kelas Aktif</span>
            </div>
            <div class="text-4xl font-bold text-white">{{ $totalCourses }}</div>
        </div>
        <div class="absolute -right-6 -bottom-6 w-24 h-24 bg-emerald-500/20 rounded-full blur-2xl group-hover:bg-emerald-500/30 transition-all"></div>
    </div>

    <div class="p-6 rounded-3xl bg-zinc-900/50 border border-zinc-800 relative overflow-hidden group hover:border-zinc-600 transition-all">
        <div class="relative z-10">
            <div class="flex items-center gap-3 mb-2 text-zinc-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                <span class="text-sm font-medium">Total Pendaftaran</span>
            </div>
            <div class="text-4xl font-bold text-white">{{ $totalEnrollments }}</div>
        </div>
        <div class="absolute -right-6 -bottom-6 w-24 h-24 bg-rose-500/20 rounded-full blur-2xl group-hover:bg-rose-500/30 transition-all"></div>
    </div>
</div>

<div class="grid lg:grid-cols-2 gap-8">
    
    <div class="space-y-4">
        <div class="flex items-center justify-between px-1">
            <h2 class="text-lg font-semibold text-white">Kelas Terpopuler</h2>
            <a href="{{ route('courses.index') }}" class="text-xs text-indigo-400 hover:text-indigo-300">Lihat Semua</a>
        </div>
        
        <div class="bg-zinc-900/30 border border-zinc-800 rounded-3xl overflow-hidden">
            @forelse($popularCourses as $index => $course)
                <div class="p-5 flex items-center justify-between border-b border-zinc-800 last:border-0 hover:bg-zinc-900/50 transition-colors">
                    <div class="flex items-center gap-4">
                        <div class="w-8 h-8 flex items-center justify-center rounded-lg bg-zinc-800 text-zinc-400 font-bold text-sm">
                            #{{ $index + 1 }}
                        </div>
                        <div>
                            <h3 class="text-white font-medium text-sm">{{ $course->name }}</h3>
                            <p class="text-xs text-zinc-500">{{ $course->instructor }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="block text-sm font-bold text-white">{{ $course->students_count }}</span>
                        <span class="text-[10px] uppercase text-zinc-600 tracking-wider">Siswa</span>
                    </div>
                </div>
            @empty
                <div class="p-8 text-center text-zinc-600 text-sm">Belum ada data pendaftaran.</div>
            @endforelse
        </div>
    </div>

    <div class="space-y-4">
        <div class="flex items-center justify-between px-1">
            <h2 class="text-lg font-semibold text-white">Siswa Terbaru</h2>
            <a href="{{ route('students.index') }}" class="text-xs text-indigo-400 hover:text-indigo-300">Lihat Semua</a>
        </div>
        
        <div class="bg-zinc-900/30 border border-zinc-800 rounded-3xl overflow-hidden p-2">
            @forelse($latestStudents as $student)
                <div class="p-3 rounded-2xl flex items-center justify-between hover:bg-zinc-800 transition-colors group cursor-pointer">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-zinc-800 flex items-center justify-center text-xs font-bold text-zinc-500 group-hover:bg-indigo-500/20 group-hover:text-indigo-400 transition-colors">
                            {{ substr($student->name, 0, 1) }}
                        </div>
                        <div>
                            <h3 class="text-white font-medium text-sm">{{ $student->name }}</h3>
                            <p class="text-xs text-zinc-500">{{ $student->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    <a href="{{ route('students.courses', $student->id) }}" class="opacity-0 group-hover:opacity-100 p-2 text-zinc-400 hover:text-white transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                </div>
            @empty
                <div class="p-8 text-center text-zinc-600 text-sm">Belum ada siswa mendaftar.</div>
            @endforelse
        </div>
    </div>

</div>
@endsection