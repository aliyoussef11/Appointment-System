@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
</head>

<body>

<div class="list-group" style="width:250px;margin-left:16px; float:left">
   
    <a href="/student" class="list-group-item active"><i class="fa fa-eye"></i> <span style="margin-left:5px;">My Available Advisors</span></a>
    <a href="/accepted" class="list-group-item"><i class="fa fa-thumbs-o-up"></i> <span style="margin-left:5px;">My Accepted Requests</span></a>
    <a href="/rejected" class="list-group-item"><i class="fa fa-thumbs-o-down"></i> <span style="margin-left:5px;">My Rejected Requests</span></a>

  </div>

<div class="container" style="padding-right:120px;padding-top:50px;">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Student Dashboard</div>

                <div class="panel-body">
                    Your Available Advisors:<br><br>

                @if (\Session::has('danger'))
                <div class="alert alert-danger">
                <ul>
                <li>{!! \Session::get('danger') !!}</li>
                </ul>
                </div>
                @endif    

                @if (\Session::has('success'))
                <div class="alert alert-success">
                <ul>
                <li>{!! \Session::get('success') !!}</li>
                </ul>
                </div>
                @endif
                    
                    <?php
                    use App\Meeting;
                    use App\Appointments;
                    use App\User;

                    $all_advisors = Meeting::select('Advisor_Name')->get();

                    $count = count($all_advisors);
                    $Advisors = [];
                    for($i=0; $i<$count; $i++){
                    if(!in_array($all_advisors[$i], $Advisors)){
                    array_push($Advisors, $all_advisors[$i]);
                    }
                    }

// for($i=0;$i<count($Advisors);$i++){
//     echo $Advisors[$i]->Advisor_Name."<br>";
// }

foreach($Advisors as $advisor){
    $data2 = Meeting::where('Advisor_Name', $advisor->Advisor_Name)->get();
    ?>

    
    <table class="table table-striped table-bordered table-hover">
    <thead>
    <tr>
    <th style="width:150px;background-color:lightgray;text-align:center"><?php echo $advisor->Advisor_Name; ?></th>
    <th>Date</th>
    <th>Time</th>
    <th>Book / No</th>
    <th></th>
    </tr>
    </thead>    
        
    <tbody>
    <?php

    foreach($data2 as $Meetings){
        ?>
    <tr>
    <td style="text-align:center"> -- </td>
    <td><?php echo $Meetings -> Date ?> </td>
    <td><?php echo $Meetings -> Time ?> </td>
    <td><?php echo $Meetings ->  Condition?> </td>
    <td><a href="<?php echo "book/".$advisor->Advisor_Name."/".$Meetings->Time."/".$Meetings->Date?>" role="button" class="btn btn-large btn-success" data-toggle="modal">Book Now</a> </td>
    </tr>

<?php 
    } 
}
?>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
