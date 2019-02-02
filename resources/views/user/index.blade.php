@extends('layouts.app')
@section('content')

<div class="container py-4">
        @if(Session::has('flash_message'))
            <div class="container">
                <div class="alert alert-success"><em> {!! session('flash_message') !!}</em>
                </div>
            </div>
        @endif

        <div class="card">
          <div class="card-header">Users 
              {{-- @can('create') --}}
              <span class="float-right">
                  <a href="{{ url('/user/create') }}" title="New User">
                    <button class="btn btn-primary btn-sm">New User</button></a>
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
                  <form method="GET" action="{{ action('UserController@index') }}">
                    <input type="text" class="form-control" name="search" placeholder="user" value="{{ request('search') }}">
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
                              <th>Username</th>
                              <th>Email</th>
                              <th>Roles</th>
                              <th>Created at</th>
                              <th class="text-center">Actions</th>
                          </tr>
                      </thead>
                      <tbody>
                      @foreach($user as $item)
                          <tr>
                              <td>{{ $loop->iteration or $item->id }}</td>
                              <td>{{ $item->name }}</td>
                              <td>{{ $item->username }}</td>
                              <td>{{ $item->email }}</td>
                              <td>{{ implode(',', $item->roles->pluck('name')->toArray())  }}</td>
                              <td>{{ $item->created_at}}</td>

                              <td width="1%">
                                {{-- @can('delete') --}}
                                <a href="{{ url('/user/' . $item->id . '/edit') }}" title="Edit User"><button class="btn btn-primary btn-sm">Edit</button></a>
                                {{-- @endcan --}}
                              </td>

                          </tr>
                      @endforeach
                      </tbody>
                  </table>
              </div>
              <div class="pagination-wrapper"> {{$user->appends(Request::get('search'))->links()}} </div>
          </div>
        </div>

      </div>
</div>
@endsection
