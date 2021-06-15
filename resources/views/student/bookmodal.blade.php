@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<div class="container">
  <!-- Trigger the modal with a button -->
  <!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button> -->

  <!-- Modal -->
  <div class="modal show" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="text-align:center">Book Your Time Now</h4>
        </div>
        <div class="modal-body">
          
        <label for="from">From</label>
                <input class="date form-control" type="text" name="from" value="<?php
                
                echo Auth::user()->email;
                ?>" >
                <br>
                        
             <?php 
             $fetchmail =  DB::table('users')->select('email')->where('name', '=', $name)->get();

             $CurrentStudent = Auth::user()->name;

             ?>
             <label for="from">To:</label>
                <input class="date form-control" type="text" name="from" value="<?php
                foreach($fetchmail as $email){
                    echo $email->email;
                }
                ?> " readonly>

            <br>
            
            <label for="from">Description:</label>
            <div class="form-group">
             <textarea class="form-control ph" rows="5" readonly>
            Hello Advisor : <?php echo $name; ?> 
            My Name Is: <?php echo Auth::user()->name; ?> 
            I am going to Book this Available Time <?php echo $time."/".$date; ?> 
            So Please If you Don't have any Problem. Can You Confirm on this!
        
            Regards! 
            </textarea>
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" onclick="location.href='/student'" class="btn btn-default" data-dismiss="modal">Close</button>
          <a href="<?php echo "/sendRequest/".$name."/".$CurrentStudent."/".$date."/".$time; ?>" class="btn btn-success">Book</a>
        </div>
      </div>
      
    </div>
  </div>
  
</div>
@endsection