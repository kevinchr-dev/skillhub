<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return view('students.index', compact('students')); 
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:students',
            'phone' => 'nullable'
        ]);

        Student::create($validated);
        return redirect()->back()->with('success', 'Peserta berhasil ditambahkan');
    }

    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required',
            // Validasi email unik, TAPI kecualikan ID peserta ini sendiri
            // (agar tidak error "email sudah dipakai" padahal milik dia sendiri)
            'email' => 'required|email|unique:students,email,'.$id, 
            'phone' => 'nullable'
        ]);

        $student->update($validated);
        return redirect()->route('students.index')->with('success', 'Data peserta berhasil diperbarui');
    }

    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();
        return redirect()->back()->with('success', 'Peserta dihapus');
    }
}
