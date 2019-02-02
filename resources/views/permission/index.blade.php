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
            <div class="card-header">Permissions 
                {{-- @can('create') --}}
                    <span class="float-right"><a href="{{ url('/permission/create') }}" title="New Permission">
                        <button class="btn btn-primary btn-sm">New Permission</button></a>
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
                  <form method="GET" action="{{ action('PermissionController@index') }}">
                    <input type="text" class="form-control" name="search" placeholder="permission" value="{{ request('search') }}">
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
                              <th colspan="2" class="text-center">Actions</th>
                          </tr>
                      </thead>
                      <tbody>
                      @foreach($permission as $item)

                          <tr>
                              <td>{{ $loop->iteration or $item->id }}</td>
                              <td>{{ $item->name }}</td>

                              <td width="5%">
                                {{-- @can('edit') --}}
                                <a href="{{ url('/permission/' . $item->id . '/edit') }}" title="Edit Permission"><button class="btn btn-primary btn-sm">Edit</button></a>
                                {{-- @endcan --}}
                              </td>


                              <td width="5%">
                                {{-- @can('delete') --}}
                                <form action ="{{action('PermissionController@destroy',$item->id)}}" method="POST">
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
              <div class="pagination-wrapper"> {{$permission->appends(Request::get('search'))->links()}} </div>
          </div>
        </div>

  </div>
</div>
@endsection
