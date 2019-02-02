@extends('layouts.app')
@section('content')


<div class="container py-4">
  <div class="row justify-content-center">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card" style="width: 42rem;">
          <div class="card-header">
            New User
            <span class="float-right">
              <a href="{{ url('/user') }}" title="back">
                <button class="btn btn-primary btn-sm">Back</button>
              </a>
            </span>
          </div>
          <div class="card-body text-dark">

            <form method="POST" action="{{ action('UserController@store') }}">
              @csrf
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-9">
                  <input type="text" name="name" id="name" class="form-control" placeholder="Name">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Username</label>
                <div class="col-sm-9">
                  <input type="text" name="username" id="username" class="form-control" placeholder="Username">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-9">
                  <input type="email" name="email" id="email" class="form-control" placeholder="Email">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Password</label>
                <div class="col-sm-9">
                  <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Confirm Password</label>
                <div class="col-sm-9">
                  <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirm Password">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Permissions</label>
                <div class="col-sm-9">
                  <select multiple="multiple" class="form-control" name="roles[]">
                    @foreach($rolesArray as $key => $role)
                        <option value="{{ $key }}">{{ $role }}</option>
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
