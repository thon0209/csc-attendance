<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\SchoolYear;
use App\Http\Resources\SchoolYearResource as SchoolYearResource;
use App\Http\Requests\SchoolYearRequest;
use App\Http\Requests\SchoolYearEditRequest;

class SchoolYearController extends Controller
{
  public function index(Request $request)
  {
    $per_page = $request->per_page;
    $schoolyear = SchoolYear::search($request,$per_page);
    return SchoolYearResource::collection($schoolyear);
  }

  public function getSchoolYear()
  {
    return response()->json(['schoolyear'=>SchoolYear::all()]);
  }

  public function store(SchoolYearRequest $request)
  {
    $validated = $request->validated();
    $schoolyear = new SchoolYear;
    $schoolyear->fill(Input::get());
    if($schoolyear->save()){
      return new SchoolYearResource($schoolyear);
    }
  }

  public function update(SchoolYearEditRequest $request,$id)
  {
    $validated = $request->validated();
    $schoolyear = SchoolYear::findOrFail($id);
    $schoolyear->fill(Input::get());
    if($schoolyear->save()){
      return new SchoolYearResource($schoolyear);
    }
  }
}
