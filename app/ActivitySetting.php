<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ActivitySetting extends Model
{
    protected $table='activity_settings';
    protected $fillable = ['id','activity_id'];
}
