@extends('layouts.app')
@section('content')

<div class="container py-4">
  <div class="row justify-content-center">

        <div class="card" style="width: 41rem;">
          <div class="card-header">
            Edit Role # {{$role->id}}
            <span class="float-right">
              <a href="{{ url('/role') }}" title="back">
                <button class="btn btn-primary btn-sm">Back</button>
              </a>
            </span>
          </div>
          <div class="card-body text-dark">

            <form method="POST" action="{{ action('RoleController@update',$role->id) }}">
              @csrf
              <input name="_method" type="hidden" value="PATCH">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Role</label>
                <div class="col-sm-10">
                  <input type="name" name="name" id="name" class="form-control" placeholder="Role" value="{{$role->name}}">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Permission</label>
                <div class="col-sm-10">

                  <select required multiple class="form-control" name="permissions[]" id="permissions">
                      @foreach($permissionsArray as $key => $permission)
                        <option value="{{ $key }}"
                        @if (collect(old('permission', $role->permissions->pluck('id') ?? []))->contains($key))
                          selected="selected"
                        @endif>
                        {{ $permission }}
                      </option>
                      @endforeach
                  </select>

                </div>
            </div>

              <button type="submit" class="btn btn-primary float-right">Save</button>

            </form>

          </div>
        </div>

</div>
</div>
@endsection
