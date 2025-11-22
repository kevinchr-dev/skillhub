@extends('layout')

@section('content')
<div class="max-w-xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('courses.index') }}" class="text-sm text-zinc-500 hover:text-white flex items-center gap-2 mb-4 transition-colors">
            &larr; Batal & Kembali
        </a>
        <h1 class="text-2xl font-bold text-white">Edit Kelas</h1>
        <p class="text-zinc-500 text-sm">Perbarui informasi materi atau instruktur.</p>
    </div>

    <div class="bg-zinc-900/50 border border-zinc-800 rounded-3xl p-8 shadow-xl">
        <form action="{{ route('courses.update', $course->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="space-y-2">
                <label class="text-xs font-medium text-zinc-400 ml-1">Nama Kelas</label>
                <input type="text" name="name" value="{{ old('name', $course->name) }}" class="w-full bg-zinc-950 border border-zinc-800 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:ring-2 focus:ring-indigo-500/50 transition-all">
            </div>
            
            <div class="space-y-2">
                <label class="text-xs font-medium text-zinc-400 ml-1">Instruktur</label>
                <input type="text" name="instructor" value="{{ old('instructor', $course->instructor) }}" class="w-full bg-zinc-950 border border-zinc-800 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:ring-2 focus:ring-indigo-500/50 transition-all">
            </div>
            
            <div class="space-y-2">
                <label class="text-xs font-medium text-zinc-400 ml-1">Deskripsi Singkat</label>
                <textarea name="description" rows="4" class="w-full bg-zinc-950 border border-zinc-800 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:ring-2 focus:ring-indigo-500/50 transition-all">{{ old('description', $course->description) }}</textarea>
            </div>

            <div class="pt-4 flex gap-4">
                <button type="submit" class="flex-1 bg-indigo-600 hover:bg-indigo-500 text-white font-medium py-3 rounded-xl text-sm transition-all shadow-lg shadow-indigo-500/20">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection