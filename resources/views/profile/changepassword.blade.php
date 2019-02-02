
@extends('layouts.app')

@section('content')
<div class="container py-4">
  <div class="row justify-content-center">
    <form method="POST" action="{{ action('ProfileController@update',$user->id) }}" accept-charset="UTF-8" class="form-horizontal">
      @csrf
    <input name="_method" type="hidden" value="PATCH">
        <div class="card" style="width: 30rem;">
          <div class="card-header no-border">Change Password</div>
          <div class="card-body text-dark">

              <div class="form-group row">
                  <label class="col-sm-5">New Password:</label>
                  <div class="col-sm-7">
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                  </div>
              </div>

              <div class="form-group row">
                  <label class="col-sm-5">Confirm Password:</label>
                  <div class="col-sm-7">
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirm Password">
                  </div>
              </div>

          </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-primary float-right">Save</button>
            </div>
        </div>
    </form>
  </div>

</div>
</div>
@endsection
