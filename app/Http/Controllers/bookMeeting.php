<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Input;

class bookMeeting extends Controller
{
    function book($Name, $Time, $Date){
        return view('student.bookmodal', ['name'=>$Name, 'time'=>$Time, 'date'=>$Date]);
    }
}
