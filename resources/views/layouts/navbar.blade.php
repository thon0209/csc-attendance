<nav class="navbar navbar-expand-lg navbar navbar-dark bg-dark">
    <div class="container">
    <a class="navbar-brand" href="{{url('/home')}}">CSC Attendance System</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="#">Dashboard <span class="sr-only">(current)</span></a>
        </li>
  
        <li class="nav-item dropdown">
          <a class="nav-link" href="{{url('/student')}}">Student</a>
        </li>

        <li class="nav-item dropdown">
        <a class="nav-link" href="{{url('/activity')}}">Activity</a>
          </li>
  
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Attendance
            </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{url('/attendances')}}">Automated Attendance</a>
            <a class="dropdown-item" href="{{url('/manual-attendance')}}">Manual Attendance</a>
            <a class="dropdown-item" href="{{url('/attendance-list')}}">Attendance List</a>
          </div>
        </li>
        {{-- <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Reports
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#">Attendance</a>
          </div>
        </li> --}}
      </ul>
  
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            User Management
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{url('/permission')}}">User</a>
            <a class="dropdown-item" href="{{url('/role')}}">Role</a>
            <a class="dropdown-item" href="{{url('/user')}}">Permission</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{Auth::user()->name}}
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{url('/profile')}}">Profile</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              Log Out
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
              </form>
            </a>
            </div>
          </div>
        </li>
      </ul>
  
    </div>
  </div>
  </nav>
  