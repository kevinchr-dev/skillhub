@extends('layout')

@section('content')
<div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
    <div>
        <a href="{{ route('students.index') }}" class="inline-flex items-center text-sm text-zinc-500 hover:text-white mb-2 transition-colors gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali
        </a>
        <h1 class="text-3xl font-bold text-white">{{ $student->name }}</h1>
        <div class="flex items-center gap-3 mt-2 text-zinc-400 text-sm">
            <span>{{ $student->email }}</span>
            <span class="w-1 h-1 bg-zinc-700 rounded-full"></span>
            <span>{{ $student->phone }}</span>
        </div>
    </div>
    
    <div class="bg-zinc-900 border border-zinc-800 px-5 py-3 rounded-xl">
        <span class="block text-xs text-zinc-500 uppercase tracking-wider mb-1">Status</span>
        <span class="text-white font-medium">Mengikuti {{ $student->courses->count() }} Kelas</span>
    </div>
</div>

<div class="border-t border-zinc-800 pt-8">
    <h3 class="text-lg font-semibold text-white mb-6">Kelas yang Sedang Diikuti</h3>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-5">
        @forelse($student->courses as $course)
        <div class="bg-zinc-900/50 border border-zinc-800 rounded-2xl p-5 flex flex-col justify-between h-full hover:border-zinc-700 transition-all">
            <div>
                <h4 class="text-white font-medium text-lg">{{ $course->name }}</h4>
                <p class="text-zinc-500 text-sm mb-4">Instruktur: {{ $course->instructor }}</p>
                <div class="text-xs text-zinc-400 leading-relaxed line-clamp-2">
                    {{ $course->description ?? 'Tidak ada deskripsi.' }}
                </div>
            </div>
            
            <div class="mt-6 pt-4 border-t border-zinc-800/50 flex justify-end">
                <form action="{{ route('enrollments.destroy') }}" method="POST" onsubmit="return confirm('Batalkan pendaftaran peserta di kelas ini?')">
                    @csrf @method('DELETE')
                    <input type="hidden" name="student_id" value="{{ $student->id }}">
                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                    <button class="text-xs text-red-400 hover:text-red-300 font-medium bg-red-500/10 hover:bg-red-500/20 px-3 py-2 rounded-lg transition-colors">
                        Batalkan Kelas
                    </button>
                </form>
            </div>
        </div>
        @empty
        <div class="col-span-full py-12 text-center border-2 border-dashed border-zinc-800 rounded-3xl bg-zinc-900/20">
            <p class="text-zinc-500">Peserta ini belum mendaftar di kelas manapun.</p>
            <a href="{{ route('enrollments.index') }}" class="text-indigo-400 text-sm font-medium hover:underline mt-2 inline-block">Daftarkan sekarang</a>
        </div>
        @endforelse
    </div>
</div>
@endsection