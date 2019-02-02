@extends('layouts.app')
@section('content')
<div class="container py-2">
  <div class="row justify-content-center">
    @if(Session::has('flash_message'))
        <div class="container">
            <div class="alert alert-success"><em> {!! session('flash_message') !!}</em>
            </div>
        </div>
    @endif
        <div class="card" style="width: 30rem;">
          <div class="card-header">
            User Profile
            <span class="float-right">
              <a href="{{ url('/profile/' . Auth::user()->id . '/edit') }}" title="Change Password">
              <button type="button" class="btn btn-primary btn-sm">Change Password</button>
              </a>
            </span>
          </div>
          <div class="card-body text-dark">

            <div class="form-group row">
                <label class="col-sm-4">Username:</label>
                <div class="col-sm-8">
                  <label> {{Auth::user()->username}} </label>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-4">Name:</label>
                <div class="col-sm-8">
                  <label> {{Auth::user()->name}} </label>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-4">Email:</label>
                <div class="col-sm-8">
                  <label> {{Auth::user()->email}} </label>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-4">Member since:</label>
                <div class="col-sm-8">
                  <label> {{Auth::user()->created_at}} </label>
                </div>
            </div>

            </div>
        </div>

  </div>
</div>
@endsection
