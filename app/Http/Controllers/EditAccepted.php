<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Acceptable;
use Auth;
use DB;
use Carbon\Carbon;

class EditAccepted extends Controller
{
    function edit(Request $request, $Time, $Date){
      
      $DateTime = $request->date." ".$request->time;
      $CurrentDateTime = Carbon::now();
      $DateCarbon = $CurrentDateTime->toDateString()." ".$CurrentDateTime->toTimeString();

        if($DateTime < $DateCarbon){    
          return redirect()->guest('/meetingaccepted')->with('not edited', 'Check Your Date Or Time');
        }
        else{
        $TimeDate = $request->time." ".$request->date;
        $accepted_Meetings = Acceptable::where('Advisor_Name', Auth::user()->name)->get();
                $arrayOfDateTime = [];
                for($i=0; $i<count($accepted_Meetings); $i++){
                    $DateWithTime = $accepted_Meetings[$i]->Time." ".$accepted_Meetings[$i]->Date;
                    array_push($arrayOfDateTime, $DateWithTime);
                }
        
        if (in_array($TimeDate, $arrayOfDateTime))
          {
            return redirect()->guest('/meetingaccepted')->with('not edited', 'This Time Is Already Available');
          }
        else
          {
        $edit = DB::table('acceptable')->where('Time', '=', $Time)->where('Date', '=' , $Date)
        ->where('Advisor_Name', '=' , Auth::user()->name)
        ->update([
            "Time" => $request->time,
            "Date" => $request->date,
        ]);

        return redirect()->guest('/meetingaccepted')->with('edited', 'Edited Successfully');
        }
    }
  }
}
