@extends('layouts.app')
@section('content')

<div class="container py-4">
  <div class="row justify-content-center">


          <div class="card" style="width: 30rem;">
            <div class="card-header">Show # {{$role->id}}
              <span class="float-right">
                <a href="{{ url('/role') }}" title="back">
                  <button class="btn btn-primary btn-sm">Back</button>
                </a>
              </span>
            </div>
            <div class="card-body text-dark">

              <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Role</label>
                  <div class="col-sm-9 col-form-label">
                    <label class="font-weight-bold"> {{$role->name}} </label>
                  </div>
              </div>

              <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Permissions</label>
                  <div class="col-sm-9 col-form-label">
                    <label class="font-weight-bold">  {{ implode(' , ', $role->permissions->pluck('name')->toArray())  }} </label>
                  </div>
              </div>

            </div>
          </div>

</div>
</div>
@endsection
