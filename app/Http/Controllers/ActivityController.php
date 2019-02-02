<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Activity;
use App\Http\Resources\ActivityResource as ActivityResource;
use App\Http\Requests\ActivityRequest;

class ActivityController extends Controller
{
  public function index(Request $request)
  {
    $per_page = $request->per_page;
    $activities = Activity::search($request,$per_page);
    return ActivityResource::collection($activities);
  }

  public function getActivity()
  {
    return response()->json(['activities'=>Activity::all()]);
  }

  public function store(ActivityRequest $request)
  {
    $validated = $request->validated();
    $activities = new Activity;
    $activities->fill(Input::get());
    if($activities->save()){
      return new ActivityResource($activities);
    }
  }

  public function update(ActivityRequest $request,$id)
  {
    $validated = $request->validated();
    $activities = Activity::findOrFail($id);
    $activities->fill(Input::get());
    if($activities->save()){
      return new ActivityResource($activities);
    }
  }
}
