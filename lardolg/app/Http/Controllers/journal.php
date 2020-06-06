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
        $classes = DB::table('classes')
                    ->where('teacher_id', '=', Auth::user()->id)
                    ->get();
    $lessons=NULL;
        foreach($classes as $class){
            $lessons[$class->id] = DB::table('lessonteacher')->where('lessonteacher.class_id','=',$class->id)
            ->join('lessons','lessons.id','=','lessonteacher.lesson_id')
            ->get();
        }
        $pass = DB::table('pass')->get();
        $students = DB::table('students')
                    ->join('classes', function ($join) {
                        $join->on('students.class_id', '=', 'classes.id')
                        ->where('classes.teacher_id', '=', Auth::user()->id);
                    })
                    ->select('students.id','number','type','fio','class_id','user_id','parenth_id','teacher_id')
                    ->get();
        return view('journal', [
            'classes' => $classes,
            'lessons' => $lessons,
            'pass' => $pass,
            'students' => $students
        ]);

    }
}
