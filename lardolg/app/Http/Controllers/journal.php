<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class journal extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function classes(){

        $user=Auth::user();
        $user = $user->user_id();
        $classes = DB::table('classes')
                    ->where('teacher_id', '=', $user)
                    ->get();
        $lessons = DB::table('lessons')->get();
        $pass = DB::table('pass')->get();
        $students = DB::table('students')
                    ->join('classes', function ($join) {
                        $user=Auth::user();
                         $user = $user->user_id();
                        $join->on('students.class_id', '=', 'classes.id')
                        ->where('classes.teacher_id', '=', $user);
                    })
                    ->get();
        return view('journal', [
            'classes' => $classes,
            'lessons' => $lessons,
            'pass' => $pass,
            'students' => $students
        ]);

    }
    public function leason(){

        return view('journal');
    }

    public function data(Request $request){
        $user=Auth::user();
        $user = $user->user_id();
        $classes = DB::table('classes')
                    ->where('teacher_id', '=', $user)
                    ->get();
        $lessons = DB::table('lessons')->get();
        $pass = DB::table('pass')->get();
        $students = DB::table('students')
                    ->join('classes', function ($join) {
                        $user=Auth::user();
                         $user = $user->user_id();
                        $join->on('students.class_id', '=', 'classes.id')
                        ->where('classes.teacher_id', '=', $user);
                    })
                    ->get();
        return view('/journal',[
            'month' => $request->journ_month,
            'classes' => $classes,
            'lessons' => $lessons,
            'pass' => $pass,
            'students' => $students
        ]);
    }
}
