<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use DB;
use Auth;
use App\Meeting;
use Carbon\Carbon;

class Edit extends Controller
{
    function edit(Request $request, $Time, $Date){

      $DateTime = $request->date." ".$request->time;
      $CurrentDateTime = Carbon::now();
      $DateCarbon = $CurrentDateTime->toDateString()." ".$CurrentDateTime->toTimeString();

        if($DateTime < $DateCarbon){    
          return redirect()->guest('/mymeetings')->with('not edited', 'Check Your Date Or Time');
        }
        else{
        $TimeDate = $request->time." ".$request->date;
        $all_Meetings = Meeting::where('Advisor_Name', Auth::user()->name)->get();
                $arrayOfDateTime = [];
                for($i=0; $i<count($all_Meetings); $i++){
                    $DateWithTime = $all_Meetings[$i]->Time." ".$all_Meetings[$i]->Date;
                    array_push($arrayOfDateTime, $DateWithTime);
                }
        
        if (in_array($TimeDate, $arrayOfDateTime))
          {
            return redirect()->guest('/mymeetings')->with('not edited', 'This Time Is Already Available');
          }
        else
          {
        $edit = DB::table('meetings')->where('Time', '=', $Time)->where('Date', '=' , $Date)
        ->where('Advisor_Name', '=' , Auth::user()->name)
        ->update([
            "Time" => $request->time,
            "Date" => $request->date,
        ]);

        return redirect()->guest('/mymeetings')->with('edited', 'Edited Successfully');
        }
    }
  }
}
