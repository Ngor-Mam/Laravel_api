<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRequest;
use App\Http\Resources\ShowStudentResource;
use App\Http\Resources\StudentResource;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function index(Request $request)
    {
        $this->params = $request->only('search');
        $students = Student::list($this->params);
        $students = StudentResource::collection($students);
        return response()->json(['success' => true, 'data' => $students], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentRequest $request)
    {
        Student::store($request);
        return response()->json([
            'success' => true,
            'data' => true,
            'message' => 'student created successfully'
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $student = Student::find($id);
        $student = new ShowStudentResource($student);
        return response()->json(['success' => true, 'data' => $student], 200);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StudentRequest $request, string $id)
    {
        Student::store($request,$id);
        return response()->json([
            'success' => true,
            'data' => true,
            'message' => 'student updated successfully'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $student = Student::find($id);
        $student->delete();
        return response()->json([
            'success' => true,
            'data' => true,
            'message' => 'student deleted successfully'
        ], 200);
    }
}
