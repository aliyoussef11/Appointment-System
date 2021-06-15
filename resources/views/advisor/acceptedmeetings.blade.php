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
    <a href="/myrequests" class="list-group-item"><i class="fa fa-envelope-o"></i> <span style="margin-left:5px;">My Requests</span></a>
    <a href="/meetingaccepted" class="list-group-item active"><i class="fa fa-thumbs-o-up"></i> <span style="margin-left:5px;">My Accepted Meetings</span></a>

  </div>

<div class="container" style="padding-right:140px;padding-top:50px;">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">My Accepted Meetings:</div>
                <div class="panel-body">
                <?php
                use App\Acceptable;
              
                $user = Auth::user()->name;
            
                $accepted_meetings = Acceptable::where('Advisor_Name', Auth::user()->name)->get();
                ?>
                @if (\Session::has('NotDeleted'))
                <div class="alert alert-danger">
                <ul>
                <li>{!! \Session::get('NotDeleted') !!}</li>
                </ul>
                </div>
                @endif
                @if (\Session::has('Deleted'))
                <div class="alert alert-success">
                <ul>
                <li>{!! \Session::get('Deleted') !!}</li>
                </ul>
                </div>
                @endif
                @if (\Session::has('edited'))
                <div class="alert alert-success">
                <ul>
                <li>{!! \Session::get('edited') !!}</li>
                </ul>
                </div>
                @endif
                @if (\Session::has('not edited'))
                <div class="alert alert-danger">
                <ul>
                <li>{!! \Session::get('not edited') !!}</li>
                </ul>
                </div>
                @endif
                <table class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                <th>Student Name</th>
                <th>Date</th>
                <th>Time</th>
                <th>Delete</th>
                <th>Edit</th>
                </tr>
                </thead>    
        
                <tbody>
                <?php
                foreach($accepted_meetings as $accept){
                ?>
                <tr>
                <td><?php echo $accept -> Student_Name ?> </td>
                <td><?php echo $accept -> Date ?> </td>
                <td><?php echo $accept ->  Time?> </td>
                <td><a href= "<?php echo "deleteAccepted/".$accept->Time."/".$accept->Date ?>" onclick="return  confirm('Do You Want Delete This Time Slot <?php echo $accept->Time ?>?')">Delete</a></td>
                <td><a href= "<?php echo "editAccepted/".$accept->Time."/".$accept->Date ?>" onclick="return  confirm('Do You Want Edit This Time Slot <?php echo $accept->Time ?>?')">Edit</a></td>
                </tr>

                <?php 
                } 
                ?>

                </div>
                

@endsection