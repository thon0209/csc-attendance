@extends('layouts.app')
@section('content')

<div class="container py-4">
  <div class="row justify-content-center">

        <div class="card" style="width: 27rem;">
          <div class="card-header">
            New Permission
            <span class="float-right">
              <a href="{{ url('/permission') }}" title="back">
                <button class="btn btn-primary btn-sm">Back</button>
              </a>
            </span>
          </div>
            <div class="card-body text-dark">
              <form class="form-inline" method="POST" action="{{ action('PermissionController@store') }}">
                @csrf
                <div class="form-group">
                  <label>Permission</label>
                  <input type="text" name="name" id="name" class="form-control mx-sm-3" placeholder="Permission">
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
              </form>
            </div>
        </div>

  </div>
</div>
@endsection
