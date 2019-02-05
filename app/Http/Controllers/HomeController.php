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
        $students = DB::table('users')->where('role','=','Student')->get();
        return view('home', compact('students'));
    }

    public function loadTeachers(){
        $teachers = DB::table('users')->where('role','=','Teacher')->get();
        return view('home', compact('teachers'));
    }
}
