<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Acceptable;
use DB;
use Auth;

class AcceptMeeting extends Controller
{
    function accept($AdvisorName, $StudentName, $Date, $Time){

      $DateTimeOfRequest = $Time." ".$Date;
      $accepted_Meetings = Acceptable::where('Advisor_Name', Auth::user()->name)->get();
                $arrayOfDateTime = [];
                for($i=0; $i<count($accepted_Meetings); $i++){
                    $DateWithTime = $accepted_Meetings[$i]->Time." ".$accepted_Meetings[$i]->Date;
                    array_push($arrayOfDateTime, $DateWithTime);
                }
      if (in_array($DateTimeOfRequest, $arrayOfDateTime))
      {
      $deletion = DB::table('requests')->where('Time', '=', $Time)->where('Date', '=' , $Date)->where('Advisor_Name', '=' , Auth::user()->name)->delete();  
      return redirect()->back()->with('not accepted', 'This Time Is Already Booked From Another Student!');
      }          
      else{
      $acceptable = new Acceptable();
      
      $acceptable->Advisor_Name = $AdvisorName;
      $acceptable->Student_Name = $StudentName;
      $acceptable->Date = $Date;
      $acceptable->Time = $Time;
      $acceptable->save();

      $delete_From_Request_Table = DB::table('requests')->where('Advisor_Name', '=', $AdvisorName)->
      where('Student_Name', '=' , $StudentName)->where('Date', '=', $Date)->where('Time', '=', $Time)->delete();

      $delete_From_Meeting_Table = DB::table('meetings')->where('Advisor_Name', '=', $AdvisorName)
      ->where('Date', '=', $Date)->where('Time', '=', $Time)->delete();  

      return redirect()->back()->with('Acceptable', 'This Time Has been Booked');
    }
  }
}
