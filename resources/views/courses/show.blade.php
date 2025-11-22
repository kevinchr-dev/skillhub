@extends('layout')

@section('content')
<div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
    <div>
        <a href="{{ route('courses.index') }}" class="inline-flex items-center text-sm text-zinc-500 hover:text-white mb-2 transition-colors gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali
        </a>
        <h1 class="text-3xl font-bold text-white">{{ $course->name }}</h1>
        <p class="text-zinc-400 mt-1 text-sm max-w-2xl">{{ $course->description }}</p>
    </div>
    
    <div class="bg-zinc-900 border border-zinc-800 px-5 py-3 rounded-xl text-right">
        <span class="block text-xs text-zinc-500 uppercase tracking-wider mb-1">Instruktur</span>
        <span class="text-white font-medium">{{ $course->instructor }}</span>
    </div>
</div>

<div class="bg-zinc-900/30 border border-zinc-800 rounded-3xl overflow-hidden">
    <div class="px-6 py-4 border-b border-zinc-800 bg-zinc-900/50 flex justify-between items-center">
        <h3 class="font-semibold text-white">Daftar Peserta ({{ $course->students->count() }})</h3>
        <a href="{{ route('enrollments.index') }}" class="text-xs font-medium text-indigo-400 hover:text-indigo-300">
            + Tambah Peserta
        </a>
    </div>

    <div class="divide-y divide-zinc-800">
        @forelse($course->students as $student)
        <div class="p-4 flex items-center justify-between hover:bg-zinc-900/50 transition-colors">
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 rounded-full bg-zinc-800 flex items-center justify-center text-xs font-bold text-zinc-500">
                    {{ substr($student->name, 0, 2) }}
                </div>
                <div>
                    <h4 class="text-white font-medium text-sm">{{ $student->name }}</h4>
                    <p class="text-zinc-500 text-xs">{{ $student->email }}</p>
                </div>
            </div>
            
            <form action="{{ route('enrollments.destroy') }}" method="POST" onsubmit="return confirm('Keluarkan peserta ini dari kelas?')">
                @csrf @method('DELETE')
                <input type="hidden" name="student_id" value="{{ $student->id }}">
                <input type="hidden" name="course_id" value="{{ $course->id }}">
                <button class="p-2 text-zinc-600 hover:text-red-400 transition-colors" title="Keluarkan Peserta">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </form>
        </div>
        @empty
        <div class="p-8 text-center text-zinc-500 text-sm">
            Belum ada peserta yang mendaftar di kelas ini.
        </div>
        @endforelse
    </div>
</div>
@endsection