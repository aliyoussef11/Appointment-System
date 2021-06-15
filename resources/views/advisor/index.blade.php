@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<body>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
</head>

 <div class="list-group" style="width:250px;margin-left:16px; float:left">
   
    <a href="/advisor" class="list-group-item active"><i class="fa fa-eyedropper"></i> <span style="margin-left:5px;">Create New Meeting</span></a>
    <a href="/mymeetings" class="list-group-item"><i class="fa fa-eye"></i> <span style="margin-left:5px;">My Available Meetings</span></a>
    <a href="/myrequests" class="list-group-item"><i class="fa fa-envelope-o"></i> <span style="margin-left:5px;">My Requests</span></a>
    <a href="/meetingaccepted" class="list-group-item"><i class="fa fa-thumbs-o-up"></i> <span style="margin-left:5px;">My Accepted Meetings</span></a>

  </div>
  
<div class="container" style="padding-right:120px;padding-top:50px;">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Advisor Page</div>
                <div class="panel-body">

                <form action="submit" method="POST">

                @if (\Session::has('success'))
                <div class="alert alert-success">
                <ul>
                <li>{!! \Session::get('success') !!}</li>
                </ul>
                </div>
                @endif
                @if (\Session::has('failed'))
                <div class="alert alert-danger">
                <ul>
                <li>{!! \Session::get('failed') !!}</li>
                </ul>
                </div>
                @endif

                {{ csrf_field() }}
                <label for="username">Username</label>
                <input class="date form-control" type="text" name="username" value="<?php

                use App\Req;
                use App\User;
                use App\Appointments;
                use Carbon\Carbon;
                use App\Meeting;

                echo Auth::user()->name;
                ?>" readonly>
                
                <br>

                <label for="startdate">Start Date / Time</label>
                <input class="date form-control" type="datetime-local" name="startdatetime" required>
                <br>

                <label for="enddate">End Date / Time</label>
                <input class="date form-control" type="datetime-local" name="enddatetime" required>
                <br>

                <label for="duration">Duration</label>
                <input type="number" min="1" max="60" name="duration" required><br><br>

                <button type="submit" name ="submit" style="text-align:center;margin-left:250px;">Create</button>
                <br><br>
                </form>

                </div>
                </div>
            </div>
        </div>
    </div>
</div>   


               
</body>

</html>
@endsection
