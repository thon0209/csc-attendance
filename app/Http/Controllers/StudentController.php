<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Student;
use App\Http\Resources\StudentResource as StudentResource;
use App\Http\Requests\StudentEditRequest;
use App\Http\Requests\StudentRequest;

class StudentController extends Controller
{
    public function index(Request $request)
    {
      $per_page = $request->per_page;
      $students = Student::search($request,$per_page);
      return StudentResource::collection($students);
    }

    public function scanBarcode(Request $request)
    {
      $per_page = $request->per_page;
      $students = Student::scan($request,1);
      return StudentResource::collection($students);
    }

    public function scanID(Request $request)
    {
      $per_page = $request->per_page;
      $students = Student::searchstudentID($request,1);
      return StudentResource::collection($students);
    }


    public function store(StudentRequest $request)
    {
      $validated = $request->validated();
      $students = new Student;
      $students->fill(Input::get());
      if($students->save()){
        return new StudentResource($students);
      }
    }

    public function update(StudentEditRequest $request,$id)
    {
      $validated = $request->validated();
      $students = Student::findOrFail($id);
      $students->fill(Input::get());
      if($students->save()){
        return new StudentResource($students);
      }
    }

}
