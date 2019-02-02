<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Student;
use App\Attendance;
use App\Activity;

class DashboardController extends Controller
{
    public function index()
    {
        $students = Student::all();
        $countStudents = $students->count();

        $activity = Activity::all();
        $countActivities = $activity->count();

        $attendance = Attendance::whereDate('time_log',DB::raw('CURDATE()'))->get();
        $countAttendance = $attendance->count();

        return view('home',compact('countStudents','countActivities','countAttendance'));

    }
}
