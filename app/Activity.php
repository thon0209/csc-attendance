<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Activity extends Model
{
    protected $table='activities';
    protected $fillable=['activity_name','activity_date','activity_time','fines','semester','schoolyear_id'];

    public static function search(Request $query,$per_page)
    {
      $activities = (new Activity)->newQuery();
      if($query->has('search'))
      {
        $activities ->where('activities.activity_name','like','%'.$query->input('search').'%')
                    ->join('school_year','activities.schoolyear_id','=','school_year.id')
                    ->select('activities.*','school_year.id AS sy_id','school_year.school_year');
      } else {
        $activities ->join('school_year','activities.schoolyear_id','=','school_year.id')
                    ->select('activities.*','school_year.id AS sy_id','school_year.school_year')
                    ->orderBy('activities.id','desc')->paginate($per_page);
      }
      return $activities->orderBy('activities.id','desc')->paginate($per_page);
    }


}
