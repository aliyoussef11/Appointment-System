<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class editMeeting extends Controller
{
    function edit($Time, $Date){
        return view('advisor.edit', ['time'=>$Time, 'date'=>$Date]);
    }
}
