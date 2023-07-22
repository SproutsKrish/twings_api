<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function studentdata(Request $request)
    {
        $jsonData = $request->json(); // Access the JSON data from the request

        foreach ($jsonData as $data) {
            $student = Student::create([
                'student_name' => $data['student_name'],
                'student_age' => $data['student_age'],
                'student_dob' => $data['student_dob'],
                'student_gender' => $data['student_gender'],
                'created_by' => $data['created_by'],
            ]);
            // You don't need to call $student->save(); since create() method saves the record automatically.
        }
    }
}
