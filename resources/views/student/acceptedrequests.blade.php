@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
</head>

<body>

<div class="list-group" style="width:250px;margin-left:16px; float:left">
   
    <a href="/student" class="list-group-item"><i class="fa fa-eye"></i> <span style="margin-left:5px;">My Available Advisors</span></a>
    <a href="/accepted" class="list-group-item active"><i class="fa fa-thumbs-o-up"></i> <span style="margin-left:5px;">My Accepted Requests</span></a>
    <a href="/rejected" class="list-group-item"><i class="fa fa-thumbs-o-down"></i> <span style="margin-left:5px;">My Rejected Requests</span></a>

  </div>

<div class="container" style="padding-right:140px;padding-top:50px;">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
            <div class="panel-heading">Student Dashboard</div>
            <div class="panel-body">
            My Accepted Requests:<br><br>
                <?php
                use App\Acceptable;
            
                $accepted_meetings = Acceptable::where('Student_Name', Auth::user()->name)->get();
                ?>
                <table class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                <th>Advisor Name</th>
                <th>Date</th>
                <th>Time</th>
                </tr>
                </thead>    
        
                <tbody>
                <?php
                foreach($accepted_meetings as $accept){
                ?>
                <tr>
                <td><?php echo $accept -> Advisor_Name ?> </td>
                <td><?php echo $accept -> Date ?> </td>
                <td><?php echo $accept ->  Time?> </td>
                </tr>

                <?php 
                } 
                ?>

                </div>
                
                  

@endsection