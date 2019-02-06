<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function loadStudents(){
       if(auth()->user()->role == 'Admin' || auth()->user()->role == 'Teacher'  ){
           $students = DB::table('users')->where('role','=','Student')->get();
           return view('home', compact('students'));
       }

        return view('home')->with('message',"You cannot view this page");
    }

    public function loadTeachers(){
        if(auth()->user()->role == 'Admin'){
            $teachers = DB::table('users')->where('role','=','Teacher')->get();
            return view('home', compact('teachers'));
        }

        return view('home')->with('message',"You cannot view this page");

    }
}
