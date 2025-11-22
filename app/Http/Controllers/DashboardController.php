<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Course;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Ambil Statistik Utama
        $totalStudents = Student::count();
        $totalCourses = Course::count();
        // Menghitung baris di tabel pivot
        $totalEnrollments = DB::table('course_student')->count();

        // 2. Ambil 5 Peserta Terbaru
        $latestStudents = Student::latest()->take(5)->get();

        // 3. Ambil 3 Kelas Terpopuler (paling banyak pesertanya)
        // withCount akan menambahkan atribut 'students_count' otomatis
        $popularCourses = Course::withCount('students')
                            ->orderBy('students_count', 'desc')
                            ->take(3)
                            ->get();

        return view('dashboard', compact(
            'totalStudents', 
            'totalCourses', 
            'totalEnrollments',
            'latestStudents',
            'popularCourses'
        ));
    }
}
