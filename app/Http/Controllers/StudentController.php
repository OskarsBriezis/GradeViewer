<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    // Visu studentu saraksts
    public function index()
    {
        // Filtrācija pēc vārda vai uzvārda, augošā/dilstošā secībā
        $query = Student::query();

        if ($search = request('search')) {
            $query->where('first_name', 'like', "%{$search}%")
                ->orWhere('last_name', 'like', "%{$search}%");
        }

        if ($sort = request('sort')) {
            $direction = request('direction') == 'desc' ? 'desc' : 'asc';
            if (in_array($sort, ['first_name', 'last_name'])) {
                $query->orderBy($sort, $direction);
            }
        } else {
            $query->orderBy('last_name', 'asc');
        }

        $students = $query->paginate(10);

        return view('students.index', compact('students'));
    }

    // Forma jauna studenta pievienošanai
    public function create()
    {
        return view('students.create');
    }

    // Jauna studenta saglabāšana
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
        ]);

        Student::create($request->only('first_name', 'last_name'));

        return redirect()->route('students.index')->with('success', 'Student added successfully.');
    }

    // Studentu rediģēšanas forma
    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    // Studentu datu atjaunošana
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
        ]);

        $student->update($request->only('first_name', 'last_name'));

        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }

    // Studenta dzēšana
    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }
}
