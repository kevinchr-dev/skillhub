<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EnrollmentController extends Controller
{
    // Menampilkan form pendaftaran (Opsional, bisa digabung di detail student)
    public function index()
    {
        $students = Student::all();
        $courses = Course::all();
        return view('enrollments.index', compact('students', 'courses'));
    }

    // 3.a Mencatat pendaftaran (Attach)
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:courses,id',
        ]);

        $student = Student::findOrFail($request->student_id);
        
        // Cek apakah sudah terdaftar
        if (!$student->courses()->where('course_id', $request->course_id)->exists()) {
            
            $student->courses()->attach($request->course_id, [
                'id' => (string) Str::uuid7()
            ]);
            
            return redirect()->back()->with('success', 'Pendaftaran berhasil!');
        }

        return redirect()->back()->with('error', 'Peserta sudah terdaftar di kelas ini.');
    }

    // 3.b & 3.c Menampilkan Detail (Siapa ikut kelas apa)
    public function showStudentCourses($studentId)
    {
        $student = Student::with('courses')->findOrFail($studentId);
        // $student->courses akan berisi daftar kelas yang diikuti
        return view('students.show', compact('student'));
    }

    public function showCourseStudents($courseId)
    {
        $course = Course::with('students')->findOrFail($courseId);
        // $course->students akan berisi daftar peserta di kelas tersebut
        return view('courses.show', compact('course'));
    }

    // 3.d Menghapus pendaftaran (Detach / Batal)
    public function destroy(Request $request)
    {
        $student = Student::findOrFail($request->student_id);
        $student->courses()->detach($request->course_id);
        
        return redirect()->back()->with('success', 'Pendaftaran dibatalkan.');
    }
}
