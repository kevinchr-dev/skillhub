@extends('layout')

@section('content')
<div class="max-w-3xl mx-auto">
    
    <div class="text-center mb-10">
        <h1 class="text-3xl font-bold text-white mb-2 tracking-tight">Hubungkan Peserta & Kelas</h1>
        <p class="text-zinc-500">Daftarkan peserta ke kelas yang tersedia untuk memulai pembelajaran.</p>
    </div>

    <div class="bg-zinc-900 border border-zinc-800 p-8 rounded-[2rem] shadow-2xl shadow-black relative overflow-hidden">
        <div class="absolute -top-20 -right-20 w-64 h-64 bg-indigo-500/10 rounded-full blur-3xl pointer-events-none"></div>

        <form action="{{ route('enrollments.store') }}" method="POST" class="relative z-10 flex flex-col gap-6">
            @csrf
            
            <div class="grid md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-xs font-bold uppercase tracking-wider text-zinc-500 ml-1">Pilih Peserta</label>
                    <div class="relative">
                        <select name="student_id" class="w-full appearance-none bg-zinc-950 border border-zinc-800 text-white text-sm rounded-xl px-4 py-3.5 focus:outline-none focus:ring-2 focus:ring-indigo-500/50 cursor-pointer hover:border-zinc-600 transition-colors">
                            <option value="" disabled selected>-- Cari nama peserta --</option>
                            @foreach($students as $student)
                                <option value="{{ $student->id }}">{{ $student->name }}</option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-4 flex items-center pointer-events-none text-zinc-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-xs font-bold uppercase tracking-wider text-zinc-500 ml-1">Pilih Kelas</label>
                    <div class="relative">
                        <select name="course_id" class="w-full appearance-none bg-zinc-950 border border-zinc-800 text-white text-sm rounded-xl px-4 py-3.5 focus:outline-none focus:ring-2 focus:ring-indigo-500/50 cursor-pointer hover:border-zinc-600 transition-colors">
                            <option value="" disabled selected>-- Pilih kelas tujuan --</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->name }}</option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-4 flex items-center pointer-events-none text-zinc-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-500 text-white font-medium py-4 rounded-xl shadow-lg shadow-indigo-500/20 hover:shadow-indigo-500/30 transition-all active:scale-[0.98] mt-2">
                Daftarkan Sekarang
            </button>
        </form>
    </div>

    <div class="mt-10 grid grid-cols-2 gap-4">
        <a href="{{ route('students.index') }}" class="block p-6 rounded-2xl bg-zinc-900/30 border border-zinc-800 hover:bg-zinc-800 transition-colors text-center group">
            <span class="text-4xl font-bold text-white group-hover:text-indigo-400 transition-colors">{{ $students->count() }}</span>
            <p class="text-xs uppercase tracking-wider text-zinc-500 mt-2">Total Peserta</p>
        </a>
        <a href="{{ route('courses.index') }}" class="block p-6 rounded-2xl bg-zinc-900/30 border border-zinc-800 hover:bg-zinc-800 transition-colors text-center group">
            <span class="text-4xl font-bold text-white group-hover:text-indigo-400 transition-colors">{{ $courses->count() }}</span>
            <p class="text-xs uppercase tracking-wider text-zinc-500 mt-2">Total Kelas</p>
        </a>
    </div>

</div>
@endsection