<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    // GET /api/students
public function index(Request $request)
{
    $query = Student::with('course');

    // Search
    if ($request->has('search')) {
        $search = $request->search;

        $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('id_number', 'like', "%{$search}%");
        });
    }

    // Filter by course
    if ($request->has('course_id')) {
        $query->where('course_id', $request->course_id);
    }

    return response()->json(
        $query->paginate(10)
    );
}

    // POST /api/students
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'id_number' => 'required',
            'course_id' => 'required|exists:courses,id',
        ]);

        $student = Student::create([
            'name' => $request->name,
            'id_number' => $request->id_number,
            'course_id' => $request->course_id,
        ]);

        return response()->json($student->load('course'), 201);
    }

    // GET /api/students/{id}
    public function show(string $id)
    {
        $student = Student::with('course')->findOrFail($id);

        return response()->json($student);
    }

    // PUT /api/students/{id}
    public function update(Request $request, string $id)
    {
        $student = Student::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'id_number' => 'required',
            'course_id' => 'required|exists:courses,id',
        ]);

        $student->update([
            'name' => $request->name,
            'id_number' => $request->id_number,
            'course_id' => $request->course_id,
        ]);

        return response()->json($student->load('course'));
    }

    // DELETE /api/students/{id}
    public function destroy(string $id)
    {
        $student = Student::findOrFail($id);

        $student->delete();

        return response()->json([
            'message' => 'Student deleted successfully'
        ]);
    }
}