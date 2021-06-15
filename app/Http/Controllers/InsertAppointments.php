<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Appointments;
use App\User;
use Carbon\Carbon;
use Route;
use Auth;
use App\Meeting;
use DB;
use App\Acceptable;
use App\HelperTime;
use DateTimeZone;

class InsertAppointments extends Controller
{
    
    protected function addData(Request $request)
    {       
        $sDateforChecking = \Carbon\Carbon::parse($request->startdatetime); 
        $eDateforChecking = \Carbon\Carbon::parse($request->enddatetime);


        $check = Appointments::where('Advisor_Name', '=', Auth::user()->name)->first();
        if ($check === null) {

        $CurrentDateTime = Carbon::now();
        if($request->startdatetime < $CurrentDateTime){    
            return redirect()->back()->with('failed', 'Please Enter A Valid Date Or Time');
        }
        else{
        if($request->startdatetime > $request->enddatetime){
            return redirect()->back()->with('failed', 'Check Your Time Or Date');
        }
        else{
            if(!($sDateforChecking->format('Y-m-d') == $eDateforChecking->format('Y-m-d'))){
                return redirect()->back()->with('failed', 'Your Meeting Will Be So Long');
            }
        else{
        $appointment = new Appointments();
        $appointment->Advisor_Name = $request->username;
        $appointment->Start_Date_Time = $request->startdatetime;
        $appointment->End_Date_Time = $request->enddatetime;
        $appointment->Duration = $request->duration; 
        $appointment->save();

        }

        $data = Appointments::where('Advisor_Name', Auth::user()->name)->get();
        
        foreach($data as $appointment){
            $startDT =  Carbon::createFromFormat('Y-m-d H:i:s', $appointment->Start_Date_Time);
            $endDT = Carbon::createFromFormat('Y-m-d H:i:s', $appointment->End_Date_Time);
            $durat = $appointment->Duration;
        }

        
        function SplitTime($StartTime, $EndTime, $Duration="60"){
            $ReturnArray = array ();// Define output
            $StartTime    = strtotime ($StartTime); //Get Timestamp
            $EndTime      = strtotime ($EndTime); //Get Timestamp
        
            $AddMins  = $Duration * 60;
        
            while ($StartTime < $EndTime) //Run loop
            {
                $ReturnArray[] = date("G:i:s", $StartTime);
                $StartTime += $AddMins; //Endtime check
            }
            return $ReturnArray;
        }
        

        //Calling the function
        $Data = SplitTime($startDT, $endDT, $durat);
        echo "<pre>";

        $all_Meetings = Meeting::where('Advisor_Name', Auth::user()->name)->get();

        $arrayOfDateTime = [];
        for($j=0; $j<count($all_Meetings); $j++){
            $DateWithTime = $all_Meetings[$j]->Time." ".$all_Meetings[$j]->Date;
            array_push($arrayOfDateTime, $DateWithTime);
        }


        for($i=0; $i<count($arrayOfDateTime) ; $i++){
            echo $arrayOfDateTime[$i]."<br>";
        }
        
        for($i=0; $i<count($Data) ; $i++){
            $helper = new HelperTime();
            $helper->Advisor_Name = Auth::user()->name;
            $helper->Time = $Data[$i];
            $helper->save();
        
        }
        $accepted_Meetings = Acceptable::where('Advisor_Name', Auth::user()->name)->get();
                $arrayOfDateTimeFromAccepts = [];
                for($i=0; $i<count($accepted_Meetings); $i++){
                    $DateWithTimeA = $accepted_Meetings[$i]->Time." ".$accepted_Meetings[$i]->Date;
                    array_push($arrayOfDateTimeFromAccepts, $DateWithTimeA);
        }

        $All_Times = HelperTime::where('Advisor_Name', Auth::user()->name)->get();
        
        for($i=0; $i<count($All_Times) ; $i++){
            $TimeWithDate = $All_Times[$i]->Time." ".$startDT->toDateString();
            $TimeOnly = $All_Times[$i]->Time;
        
            if(in_array($TimeWithDate, $arrayOfDateTimeFromAccepts)){
                $delete = DB::table('appointments')->where('Advisor_Name', '=', Auth::user()->name)->delete();
                $delete = DB::table('HelperTime')->where('Advisor_Name', '=', Auth::user()->name)->delete();
                return redirect()->back()->with('failed', 'There Are Some Times Already Booked !');
            }
            else if(in_array($TimeWithDate, $arrayOfDateTime))
            {
            $delete = DB::table('appointments')->where('Advisor_Name', '=', Auth::user()->name)->delete();
            $delete = DB::table('HelperTime')->where('Advisor_Name', '=', Auth::user()->name)->delete();   
            return redirect()->back()->with('success', 'There Are Similar Time That Did Not Created !');
            }     
            else if(!in_array($TimeWithDate, $arrayOfDateTime)){
            $meeting = new Meeting();
            $meeting->Advisor_Name = Auth::user()->name;
            $meeting->Date = $startDT->toDateString();
            $meeting->Time = $TimeOnly;
            $meeting->Condition = 'Not Booked';
            $meeting->save();
          }
    }

}
       $delete = DB::table('appointments')->where('Advisor_Name', '=', Auth::user()->name)->delete();
       $delete = DB::table('HelperTime')->where('Advisor_Name', '=', Auth::user()->name)->delete();
        return redirect()->back()->with('success', 'Your Meeting Created Successfully');
    }
}
     else{
         return redirect()->back()->with('failed', 'Your Have Reached The Maximum Number Of Creation Meetings');
    }
    }}
