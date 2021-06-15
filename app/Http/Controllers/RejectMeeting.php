<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rejected;
use DB;

class RejectMeeting extends Controller
{
    function reject($AdvisorName, $StudentName, $Date, $Time){
      $rejected = new Rejected();
      
      $rejected->Advisor_Name = $AdvisorName;
      $rejected->Student_Name = $StudentName;
      $rejected->Date = $Date;
      $rejected->Time = $Time;
      $rejected->save();

      $delete_From_Request_Table = DB::table('requests')->where('Advisor_Name', '=', $AdvisorName)->
      where('Student_Name', '=' , $StudentName)->where('Date', '=', $Date)->where('Time', '=', $Time)->delete();
      
      return redirect()->back()->with('Rejected', 'This Time Has been Rejected');

    }
}
