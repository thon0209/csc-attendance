@extends('layouts.app')
@section('content')

<div class="container py-4">
  <div class="row justify-content-center">

        <div class="card" style="width: 27rem;">
          <div class="card-header">
            Edit Permission # {{$permission->id}}
            <span class="float-right">
              <a href="{{ url('/permission') }}" title="back">
                <button class="btn btn-primary btn-sm">Back</button>
              </a>
            </span>
          </div>
          <div class="card-body text-dark">

            <form class="form-inline" method="post" action="{{ action('PermissionController@update',$permission->id) }}">
              @csrf
              <input name="_method" type="hidden" value="PATCH">
              <div class="form-group">
                <label>Permission</label>
                <input type="text" name="name" id="name" class="form-control mx-sm-3" placeholder="Permission" value="{{$permission->name}}">
              </div>
              <button type="submit" class="btn btn-primary">Save</button>
            </form>

          </div>
        </div>

  </div>
</div>
@endsection
