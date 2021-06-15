<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class deleteMeeting extends Controller
{
    function delete($Time, $Date){
        $deletion = DB::table('meetings')->where('Time', '=', $Time)->where('Date', '=' , $Date)->where('Advisor_Name', '=' , Auth::user()->name)->delete();
        if($deletion === true){
            return redirect()->back()->with('NotDeleted', 'Something Went Wrong');
            }
            else {
            return redirect()->back()->with('Deleted', 'Deleted Successfully');
            }
            return redirect()->back();
    }
}
