@extends('layout')

@section('content')
    <div class="grid lg:grid-cols-12 gap-10">

        <div class="lg:col-span-4">
            <div class="sticky top-28">
                <div
                    class="bg-zinc-900/50 backdrop-blur-sm border border-zinc-800 rounded-3xl p-6 shadow-2xl shadow-black/50">
                    <div class="mb-6">
                        <h2 class="text-lg font-semibold text-white">Buat Kelas Baru</h2>
                        <p class="text-xs text-zinc-500 mt-1">Tambahkan materi pelatihan baru.</p>
                    </div>

                    <form action="{{ route('courses.store') }}" method="POST" class="space-y-5">
                        @csrf
                        <div class="space-y-1.5">
                            <label class="text-xs font-medium text-zinc-400 ml-1">Nama Kelas</label>
                            <input type="text" name="name"
                                class="w-full bg-zinc-950 border border-zinc-800 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500/50 transition-all placeholder:text-zinc-700"
                                placeholder="Ex: Master Flutter UI" required>
                        </div>

                        <div class="space-y-1.5">
                            <label class="text-xs font-medium text-zinc-400 ml-1">Instruktur</label>
                            <input type="text" name="instructor"
                                class="w-full bg-zinc-950 border border-zinc-800 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:ring-2 focus:ring-indigo-500/50 transition-all placeholder:text-zinc-700"
                                placeholder="Nama Pengajar" required>
                        </div>

                        <div class="space-y-1.5">
                            <label class="text-xs font-medium text-zinc-400 ml-1">Deskripsi Singkat</label>
                            <textarea name="description" rows="3"
                                class="w-full bg-zinc-950 border border-zinc-800 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:ring-2 focus:ring-indigo-500/50 transition-all placeholder:text-zinc-700"
                                placeholder="Apa yang dipelajari?"></textarea>
                        </div>

                        <button type="submit"
                            class="w-full bg-white text-black hover:bg-zinc-200 font-semibold py-3 rounded-xl text-sm transition-all shadow-lg shadow-white/5 active:scale-95">
                            Simpan Kelas
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="lg:col-span-8">
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-2xl font-bold text-white tracking-tight">Katalog Kelas</h1>
                <span class="bg-zinc-800 text-zinc-300 text-xs px-3 py-1 rounded-full border border-zinc-700">Total:
                    {{ $courses->count() }}</span>
            </div>

            <div class="grid md:grid-cols-2 gap-4">
                @foreach ($courses as $course)
                    <div
                        class="group flex flex-col justify-between h-full bg-zinc-900/30 hover:bg-zinc-900 border border-zinc-800 hover:border-zinc-600 p-6 rounded-3xl transition-all duration-300">
                        <div>
                            <div class="flex justify-between items-start mb-4">
                                <div
                                    class="p-3 bg-zinc-800 rounded-xl text-white group-hover:bg-indigo-600 transition-colors">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                        </path>
                                    </svg>
                                </div>

                                <div class="flex gap-2">
                                    <a href="{{ route('courses.edit', $course->id) }}"
                                        class="text-zinc-600 hover:text-indigo-400 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                            </path>
                                        </svg>
                                    </a>

                                    <form action="{{ route('courses.destroy', $course->id) }}" method="POST" onsubmit="return confirm('Hapus kelas ini? Peserta akan ter-detach otomatis.')">
                            @csrf @method('DELETE')
                            <button class="text-zinc-600 hover:text-red-500 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                        </form>
                                </div>
                            </div>

                            <h3 class="text-lg font-semibold text-white mb-1 group-hover:text-indigo-400 transition-colors">
                                {{ $course->name }}</h3>
                            <p class="text-xs font-medium text-zinc-500 mb-3">By {{ $course->instructor }}</p>
                            <p class="text-sm text-zinc-400 line-clamp-2 leading-relaxed">
                                {{ $course->description ?? 'Tidak ada deskripsi.' }}
                            </p>
                        </div>

                        <div class="mt-6 pt-6 border-t border-zinc-800 flex items-center justify-between">
                            <span class="text-xs text-zinc-500">{{ $course->students->count() }} Peserta</span>
                            <a href="{{ route('courses.students', $course->id) }}"
                                class="text-xs font-medium text-white hover:underline decoration-indigo-500 underline-offset-4">
                                Lihat Detail &rarr;
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            @if ($courses->isEmpty())
                <div class="py-16 text-center border-2 border-dashed border-zinc-800 rounded-3xl">
                    <p class="text-zinc-600">Belum ada kelas tersedia.</p>
                </div>
            @endif
        </div>
    </div>
@endsection
