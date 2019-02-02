<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class SchoolYear extends Model
{
    protected $table="school_year";
    protected $fillable = ['school_year'];

    public static function search(Request $query,$per_page)
    {
      $schoolyear = (new SchoolYear)->newQuery();
      if($query->has('search'))
      {
        $schoolyear->where('school_year','like','%'.$query->input('search').'%');
      } else {
        $schoolyear->orderBy('id','desc')->paginate($per_page);
      }
      return $schoolyear->orderBy('id','desc')->paginate($per_page);
    }
}
