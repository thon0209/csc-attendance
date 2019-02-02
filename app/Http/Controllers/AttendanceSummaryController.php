<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\AttendanceSummaryResource as AttendanceSummaryResource;

class AttendanceSummaryController extends Controller
{
    public function index(Request $request)
    {

      $id = $request->get('q');
      $schoolyear_id = $request->get('schoolyear');
      $semester = $request->get('semester');

      $summary = DB::select("
                SELECT activity_name,activity_date,fines FROM activities
                WHERE semester='$semester' and schoolyear_id = '$schoolyear_id' AND
                (((activities.id)<>ALL(SELECT activity_id from querystudentattendance WHERE id = '$id')))
                ");

      return response()->json($summary);

    }
}
