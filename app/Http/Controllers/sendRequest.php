<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Req;
use Auth;

class sendRequest extends Controller
{
    function send($AdName, $StName, $Date, $Time){

        $all_requests_for_this_student = Req::where('Student_Name', Auth::user()->name)->get();

        foreach($all_requests_for_this_student as $req){
            if($req->Time == $Time && $req->Date == $Date && $req->Advisor_Name == $AdName){
                return redirect()->guest('/student')->with('danger', 'This Time Is Already Booked');
            }
        }
        
        $request = new Req();
        $request->Advisor_Name = $AdName;
        $request->Student_Name = $StName;
        $request->Date = $Date;
        $request->Time = $Time;
        $request->save();

        return redirect()->guest('/student')->with('success', 'Your Request Has Been Sent');
    }
}
