@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<div class="container">

  <!-- Modal -->
  <div class="modal show" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="text-align:center">Edit Your Time Or Date Now</h4>
        </div>
        <div class="modal-body">
          
          <form action="<?php echo "edit/".$date; ?>" method="POST">
          {{ csrf_field() }}
        <label for="from">Advisor Name</label>
                <input class="date form-control" type="text" name="from" value="<?php
                echo Auth::user()->name;
                ?>" readonly>
                <br>
           
             <label for="from">Date</label>
                <input class="date form-control" type="text" name="date" value="<?php echo $date; 
                ?>">

            <br>

            <label for="from">Time</label>
                <input class="date form-control" type="text" name="time" value="<?php echo $time; ?>">
                <br><br>
                <button type="submit" name="edit" class="btn btn-success" style="margin-left:255px">Edit</button>
                </form>
        </div>
        
      </div>
      
    </div>
  </div>
  
</div>
@endsection