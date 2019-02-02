<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Attendance;
use App\Http\Requests\AttendanceRequest;
use App\Http\Resources\AttendanceResource as AttendanceResource;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
      $per_page = 15;
      $attendance = Attendance::search($request,$per_page);
      return AttendanceResource::collection($attendance);
    }

    public function store(AttendanceRequest $request)
    {
      $validated = $request->validated();
      $attendance = new Attendance;
      $attendance->fill(Input::get());
      if($attendance->save()){
        return response()->json(['message'=>'Success!!']);
      }

    }
}
