<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Student extends Model
{
    protected $table="students";
    protected $fillable = ['student_id','last_name','first_name','middle_name','course','year_level','barcode'];

    public static function search(Request $query,$per_page)
    {
      $students = (new Student)->newQuery();
      if($query->has('search'))
      {
        $students->where('student_id','like','%'.$query->input('search').'%');
      } else {
        $students->orderBy('last_name','asc')->paginate($per_page);
      }
      return $students->orderBy('last_name','asc')->paginate($per_page);
    }

    public static function scan(Request $query,$per_page)
    {
      $students = (new Student)->newQuery();
      if($query->has('search'))
      {
        $students->where('barcode','=',$query->input('search'));
      } else {
        echo '<h3>No data found!</h3>';
      }
      return $students->orderBy('last_name','asc')->paginate($per_page);
    }

    public static function searchstudentID(Request $query,$per_page)
    {
      $students = (new Student)->newQuery();
      if($query->has('search'))
      {
        $students->where('student_id','=',$query->input('search'));
      } else {
        echo '<h3>No data found!</h3>';
      }
      return $students->orderBy('last_name','asc')->paginate($per_page);
    }


}
