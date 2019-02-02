<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Input;
use App\ActivitySetting;
use App\Http\Resources\ActivitySettingResource as ActivitySettingResource;
use App\Http\Requests\ActivitySettingRequest;


class ActivitySettingController extends Controller
{
    public function index()
    {

      $settings= ActivitySetting::join('activities','activity_settings.activity_id','activities.id')
                                ->rightjoin('school_year','activities.schoolyear_id','school_year.id')
                                ->select('activity_settings.*','activities.activity_name','activities.semester','activities.activity_date','activities.activity_time','activities.fines', 'school_year.school_year')
                                ->paginate(1);

      return ActivitySettingResource::collection($settings);

    }

    public function update(ActivitySettingRequest $request, $id)
    {
      $settings = ActivitySetting::findOrFail($id);
      $settings->fill(Input::get());
      if($settings->save()){
        return new ActivitySettingResource($settings);
      }
    }
}
