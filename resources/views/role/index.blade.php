@extends('layouts.app')
@section('content')

<div class="container py-4">
  <div class="row justify-content-center">

        @if(Session::has('flash_message'))
            <div class="container">
                <div class="alert alert-success"><em> {!! session('flash_message') !!}</em>
                </div>
            </div>
        @endif
        <div class="card" style="width: 30rem;">
          <div class="card-header">Roles 
              {{-- @can('create') --}}
            <span class="float-right">
                <a href="{{ url('role/create') }}" title="New Role">
                <button class="btn btn-primary btn-sm">New Role</button></a>
            </span>
                {{-- @endcan --}}
            </div>
          <div class="card-body text-dark">
            <div class="input-group mb-2 mr-sm-2">
              <div class="input-group-prepend">
                <div class="input-group-text">Search</div>
              </div>
              <div class="row">
                <div class="col-12">
                  <form method="GET" action="{{ action('RoleController@index') }}">
                    <input type="text" class="form-control" name="search" placeholder="role" value="{{ request('search') }}">
                  </form>
                </div>
              </div>
            </div>
              <div class="table-responsive">
                  <table class="table table-borderless">
                      <thead>
                          <tr>
                              <th>#</th>
                              <th>Name</th>
                              <th colspan="3" class="text-center">Actions</th>
                          </tr>
                      </thead>
                      <tbody>
                      @foreach($role as $item)
                          <tr>
                              <td>{{ $loop->iteration or $item->id }}</td>
                              <td>{{ $item->name }}</td>
                              <td width="1%">
                                {{-- @can('show') --}}
                                <a href="{{ url('/role/'.$item->id) }}" title="Show Role"><button class="btn btn-success btn-sm">Show</button></a>
                                {{-- @endcan --}}
                              </td>
                              <td width="1%">
                                {{-- @can('edit') --}}
                                <a href="{{ url('/role/' . $item->id . '/edit') }}" title="Edit Role"><button class="btn btn-primary btn-sm">Edit</button></a>
                                {{-- @endcan --}}
                              </td>
                              <td width="1%">
                                {{-- @can('delete') --}}
                                <form action ="{{action('RoleController@destroy',$item->id)}}" method="POST">
                                  @csrf
                                  <input name="_method" type="hidden" value="DELETE">
                                  <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                                {{-- @endcan --}}
                              </td>
                          </tr>
                      @endforeach
                      </tbody>
                  </table>
              </div>
              <div class="pagination-wrapper"> {{$role->appends(Request::get('search'))->links()}} </div>
          </div>
        </div>

</div>
</div>
@endsection
