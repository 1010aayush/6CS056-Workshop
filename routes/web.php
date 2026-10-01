<?php

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;

Route::get('/', function () {
    return view('welcome');
});

// List
Route::get('/students', function () {
    $students = Student::all();

    return view('student.list', [
        'students' => $students
    ]);
})->name('students.index');

// Create form (/students/{id} se pehle hona zaroori hai)
Route::get('/students/create', function () {
    return view('student.create');
});

// Store
Route::post('/students', function (Request $request) {
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:students,email',
        'phone' => 'required|string|max:20',
        'address' => 'nullable|string|max:500',
        'date_of_birth' => 'nullable|date',
    ]);

    $student = Student::create($validated);

    return redirect()->route('students.index')
        ->with('success', "Student {$student->name} created successfully!");
});

// Detail
Route::get('/students/{id}', function ($id) {
    $student = Student::findOrFail($id);

    return view('student.detail', [
        'student' => $student
    ]);
});

// Edit form
Route::get('/students/{id}/edit', function ($id) {
    $student = Student::findOrFail($id);

    return view('student.edit', [
        'student' => $student
    ]);
});

// Update
Route::put('/students/{id}', function (Request $request, $id) {
    $student = Student::findOrFail($id);

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => ['required', 'email', 'max:255', Rule::unique('students')->ignore($student->id)],
        'phone' => 'required|string|max:20',
        'address' => 'nullable|string',
        'date_of_birth' => 'nullable|date',
    ]);

    $student->update($validated);

    return redirect('/students/' . $student->id)
        ->with('success', 'Student updated successfully!');
});

// Delete
Route::delete('/students/{id}', function ($id) {
    $student = Student::findOrFail($id);
    $student->delete();

    return redirect('/students')
        ->with('success', 'Student deleted successfully!');
});

// ---------- COURSES ----------

// List
Route::get('/courses', function () {
    $courses = \App\Models\Course::all();

    return view('course.list', [
        'courses' => $courses
    ]);
})->name('courses.index');

// Create form (/courses/{id} se pehle hona zaroori hai)
Route::get('/courses/create', function () {
    return view('course.create');
});

// Store
Route::post('/courses', function (Request $request) {
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string|max:1000',
        'duration' => 'required|integer|min:1',
        'fee' => 'required|numeric|min:0',
        'difficulty' => ['required', Rule::in(['Easy', 'Medium', 'Hard'])],
        'is_active' => 'required|boolean',
    ]);

    $course = \App\Models\Course::create($validated);

    return redirect()->route('courses.index')
        ->with('success', "Course {$course->name} created successfully!");
});

// Detail
Route::get('/courses/{id}', function ($id) {
    $course = \App\Models\Course::findOrFail($id);

    return view('course.detail', [
        'course' => $course
    ]);
});

// Edit form
Route::get('/courses/{id}/edit', function ($id) {
    $course = \App\Models\Course::findOrFail($id);

    return view('course.edit', [
        'course' => $course
    ]);
});

// Update
Route::put('/courses/{id}', function (Request $request, $id) {
    $course = \App\Models\Course::findOrFail($id);

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string|max:1000',
        'duration' => 'required|integer|min:1',
        'fee' => 'required|numeric|min:0',
        'difficulty' => ['required', Rule::in(['Easy', 'Medium', 'Hard'])],
        'is_active' => 'required|boolean',
    ]);

    $course->update($validated);

    return redirect('/courses/' . $course->id)
        ->with('success', 'Course updated successfully!');
});

// Delete
Route::delete('/courses/{id}', function ($id) {
    $course = \App\Models\Course::findOrFail($id);
    $course->delete();

    return redirect('/courses')
        ->with('success', 'Course deleted successfully!');
});