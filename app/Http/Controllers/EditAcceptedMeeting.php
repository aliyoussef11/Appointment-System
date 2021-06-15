<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EditAcceptedMeeting extends Controller
{
    function edit($Time, $Date){
        return view('advisor.editAccepted', ['time'=>$Time, 'date'=>$Date]);
    }
}
