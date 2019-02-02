@extends('layouts.app')

@section('content')

<div class="container py-5">
    <div class="container-fluid">
        <div class="row justify-content-md-center">
            <div class="col-lg-3 col-6">
                <div class="card bg-primary">
                    <div class="card-body text-white">
                        <h3>{{ $countStudents }}</h3>
                        <p>Total students</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="card bg-success">
                    <div class="card-body text-white">
                        <h3>{{ $countActivities }}</h3>
                        <p>Total activities</p>
                    </div>
                </div>
            </div>  
            <div class="col-lg-3 col-6">  
                <div class="card bg-info">
                    <div class="card-body text-white">
                        <h3>{{ $countAttendance }}</h3>
                        <p>Total of student attend this day.</p>
                    </div>
                </div>
            </div>  
        </div>
    </div>
</div>
@endsection
