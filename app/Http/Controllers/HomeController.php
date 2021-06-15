<?php

namespace App\Http\Controllers;

use Auth;
use Route;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        switch(Auth::user()->role){
            case 'student':
                return view('student.index');
            case 'advisor':
                return view('advisor.index');
            case 'administrative assist':
                return view('administrative.index');   
            default:
            return view('welcome');
        }
    }
}
