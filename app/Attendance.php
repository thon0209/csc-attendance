<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Attendance extends Model
{
    protected $table='attendance';
    protected $fillable=['activity_id','student_no','time_log'];

    public static function search(Request $query,$per_page)
    {
      $attendance = (new Attendance)->newQuery();
      if($query->has('search'))
      {
        $attendance ->where('students.student_id','like','%'.$query->input('search').'%')
                    ->join('students','attendance.student_no','students.id')
                    ->join('activities','attendance.activity_id','activities.id')
                    ->join('school_year','activities.schoolyear_id','school_year.id');
      } else {
        $attendance ->join('students','attendance.student_no','students.id')
                    ->join('activities','attendance.activity_id','activities.id')
                    ->join('school_year','activities.schoolyear_id','school_year.id')
                    ->latest('attendance.id')->paginate($per_page);

      }

      return $attendance->latest('attendance.id')->paginate($per_page);

    }


}
