@extends('layouts.app')
@section('content')

<div class="container py-4">
  <div class="row justify-content-center">
        <div class="card" style="width: 42rem;">
          <div class="card-header">
            Edit User # {{$user->id}}
            <span class="float-right">
              <a href="{{ url('/user') }}" title="back">
                <button class="btn btn-primary btn-sm">Back</button>
              </a>
            </span>
          </div>
          <div class="card-body text-dark">

            <form method="POST" action="{{ action('UserController@update',$user->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
              @csrf
            <input name="_method" type="hidden" value="PATCH">

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                  <input type="text" name="name" id="name" class="form-control" placeholder="Name" value="{{$user->name}}">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Username</label>
                <div class="col-sm-10">
                  <input type="text" name="username" id="username" class="form-control" placeholder="Username" value="{{$user->username}}">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                  <input type="email" name="email" id="email" class="form-control" placeholder="Email" value="{{$user->email}}">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                  <input type="password" name="password" id="password" class="form-control" placeholder="Password" value="{{$user->password}}">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Permissions</label>
                <div class="col-sm-10">
                  <select required multiple class="form-control" name="roles[]" id="roles[]">
                      @foreach($rolesArray as $key => $role)
                        <option value="{{ $key }}"
                          @if (collect(old('role', $user->roles->pluck('id') ?? []))->contains($key))
                            selected="selected"
                          @endif>
                        {{ $role }}

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
</div>
@endsection
