<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    // GET /api/students
    public function index()
    {
        return response()->json(Student::all());
    }

    // POST /api/students
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'id_number' => 'required',
            'course' => 'required',
        ]);

        $student = Student::create([
            'name' => $request->name,
            'id_number' => $request->id_number,
            'course' => $request->course,
        ]);

        return response()->json($student, 201);
    }

    // GET /api/students/{id}
    public function show(string $id)
    {
        $student = Student::findOrFail($id);

        return response()->json($student);
    }

    // PUT /api/students/{id}
    public function update(Request $request, string $id)
    {
        $student = Student::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'id_number' => 'required',
            'course' => 'required',
        ]);

        $student->update([
            'name' => $request->name,
            'id_number' => $request->id_number,
            'course' => $request->course,
        ]);

        return response()->json($student);
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