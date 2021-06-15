@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
</head>
<body>

 <div class="list-group" style="width:250px;margin-left:16px; float:left">
   
    <a href="/advisor" class="list-group-item"><i class="fa fa-eyedropper"></i> <span style="margin-left:5px;">Create New Meeting</span></a>
    <a href="/mymeetings" class="list-group-item"><i class="fa fa-eye"></i> <span style="margin-left:5px;">My Available Meetings</span></a>
    <a href="/myrequests" class="list-group-item active"><i class="fa fa-envelope-o"></i> <span style="margin-left:5px;">My Requests</span></a>
    <a href="/meetingaccepted" class="list-group-item"><i class="fa fa-thumbs-o-up"></i> <span style="margin-left:5px;">My Accepted Meetings</span></a>

  </div>

<div class="container" style="padding-right:140px;padding-top:50px;">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">My Requests:</div>
                <div class="panel-body">
                @if (\Session::has('Acceptable'))
                <div class="alert alert-success">
                <ul>
                <li>{!! \Session::get('Acceptable') !!}</li>
                </ul>
                </div>
                @endif
                @if (\Session::has('Rejected'))
                <div class="alert alert-success">
                <ul>
                <li>{!! \Session::get('Rejected') !!}</li>
                </ul>
                </div>
                @endif
                @if (\Session::has('not accepted'))
                <div class="alert alert-danger">
                <ul>
                <li>{!! \Session::get('not accepted') !!}</li>
                </ul>
                </div>
                @endif
                <?php
                use App\Req;

                ?>
                <table class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                <th>Student Name</th>
                <th>Date</th>
                <th>Time</th>
                <th></th>
                <th></th>
                </tr>
                </thead>
                
                <tbody>        
                <?php

                $CurrentAdvisor = Auth::user()->name;

                $requests = Req::where('Advisor_Name', Auth::user()->name)->get();
                foreach($requests as $OneRequest){
                ?>
                <tr>
                <td><?php echo $OneRequest -> Student_Name ?> </td>
                <td><?php echo $OneRequest -> Date ?> </td>
                <td><?php echo $OneRequest ->  Time?> </td>
                <td><a href="<?php echo "accept/".$CurrentAdvisor."/".$OneRequest->Student_Name."/".$OneRequest->Date."/"
                .$OneRequest->Time; ?>" onclick="return  confirm('Do You Want Accept This Time Slot <?php echo $OneRequest->Time ?> For <?php echo $OneRequest->Student_Name ?> Student?')" class="btn btn-success">Accept</a></td>
                
                <td><a href="<?php echo "reject/".$CurrentAdvisor."/".$OneRequest->Student_Name."/".$OneRequest->Date."/"
                .$OneRequest->Time; ?>" onclick="return  confirm('Do You Want Reject This Time Slot <?php echo $OneRequest->Time ?> For <?php echo $OneRequest->Student_Name ?> Student?')" class="btn btn-danger">Decline</a></td>
                    </tr>

                    <?php
                }
                ?>

        </div>
    </div>
</div>  
</div>
</div>
</div>


@endsection