@extends('layout')

@section('content')
<div class="grid lg:grid-cols-12 gap-10">
    
    <div class="lg:col-span-4">
        <div class="sticky top-28">
            <div class="bg-zinc-900/50 backdrop-blur-sm border border-zinc-800 rounded-3xl p-6 shadow-2xl shadow-black/50">
                <div class="mb-6">
                    <h2 class="text-lg font-semibold text-white">Peserta Baru</h2>
                    <p class="text-xs text-zinc-500 mt-1">Isi data lengkap calon peserta didik.</p>
                </div>

                <form action="{{ route('students.store') }}" method="POST" class="space-y-5">
                    @csrf
                    <div class="space-y-1.5">
                        <label class="text-xs font-medium text-zinc-400 ml-1">Nama Lengkap</label>
                        <input type="text" name="name" class="w-full bg-zinc-950 border border-zinc-800 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500/50 transition-all placeholder:text-zinc-700" placeholder="Contoh: Budi Santoso" required>
                    </div>
                    
                    <div class="space-y-1.5">
                        <label class="text-xs font-medium text-zinc-400 ml-1">Alamat Email</label>
                        <input type="email" name="email" class="w-full bg-zinc-950 border border-zinc-800 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:ring-2 focus:ring-indigo-500/50 transition-all placeholder:text-zinc-700" placeholder="budi@example.com" required>
                    </div>
                    
                    <div class="space-y-1.5">
                        <label class="text-xs font-medium text-zinc-400 ml-1">No. WhatsApp</label>
                        <input type="text" name="phone" class="w-full bg-zinc-950 border border-zinc-800 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:ring-2 focus:ring-indigo-500/50 transition-all placeholder:text-zinc-700" placeholder="0812...">
                    </div>

                    <button type="submit" class="w-full bg-white text-black hover:bg-zinc-200 font-semibold py-3 rounded-xl text-sm transition-all shadow-lg shadow-white/5 active:scale-95">
                        Simpan Peserta
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="lg:col-span-8">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-white tracking-tight">Daftar Peserta</h1>
            <span class="bg-zinc-800 text-zinc-300 text-xs px-3 py-1 rounded-full border border-zinc-700">Total: {{ $students->count() }}</span>
        </div>

        <div class="grid gap-4">
            @foreach($students as $student)
            <div class="group relative bg-zinc-900/30 hover:bg-zinc-900 border border-zinc-800 hover:border-zinc-700 p-5 rounded-2xl transition-all duration-300 flex items-center justify-between">
                
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-full bg-zinc-800 flex items-center justify-center text-sm font-semibold text-zinc-400 group-hover:bg-indigo-500/20 group-hover:text-indigo-400 transition-colors">
                        {{ substr($student->name, 0, 1) }}
                    </div>
                    <div>
                        <h3 class="font-medium text-white group-hover:text-indigo-400 transition-colors">{{ $student->name }}</h3>
                        <p class="text-xs text-zinc-500">{{ $student->email }}</p>
                    </div>
                </div>

                <div class="flex items-center gap-2 opacity-100 md:opacity-0 md:group-hover:opacity-100 transition-all translate-x-0 md:translate-x-4 md:group-hover:translate-x-0">
                    <a href="{{ route('students.courses', $student->id) }}" class="px-4 py-2 rounded-lg bg-zinc-950 border border-zinc-800 text-xs font-medium text-zinc-300 hover:text-white hover:border-zinc-600 transition-all">
                        Detail
                    </a>

                    <a href="{{ route('students.edit', $student->id) }}" class="p-2 rounded-lg text-zinc-400 hover:text-indigo-400 hover:bg-indigo-500/10 transition-colors" title="Edit Data">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
    </a>
                    
                    <form action="{{ route('students.destroy', $student->id) }}" method="POST" onsubmit="return confirm('Yakin hapus data ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="p-2 rounded-lg text-zinc-600 hover:text-red-400 hover:bg-red-500/10 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </button>
                    </form>
                </div>
            </div>
            @endforeach

            @if($students->isEmpty())
                <div class="py-16 text-center border-2 border-dashed border-zinc-800 rounded-3xl">
                    <p class="text-zinc-600">Belum ada data peserta.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection