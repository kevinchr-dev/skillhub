<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        return view('courses.index', compact('courses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'instructor' => 'required',
            'description' => 'nullable'
        ]);

        Course::create($validated);
        return redirect()->back()->with('success', 'Kelas berhasil dibuat');
    }

    public function edit($id)
    {
        $course = Course::findOrFail($id);
        return view('courses.edit', compact('course'));
    }

    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required',
            'instructor' => 'required',
            'description' => 'nullable'
        ]);

        $course->update($validated);
        return redirect()->route('courses.index')->with('success', 'Data kelas berhasil diperbarui');
    }

    public function destroy($id)
    {
        $courses = Course::findOrFail($id);
        $courses->delete();
        return redirect()->back()->with('success', 'Kelas dihapus');
    }
}
