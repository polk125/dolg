<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AlertController extends Controller
{
    public function index(){
        if(Auth::user()->typeAdmin==2){
            $passes = DB::table('pass')
            ->where('teacher_id','=', 1)
            ->get();
            foreach($passes as $pass){
                $names[$pass->id] = DB::table('students')
                                        ->where('id', '=', $pass->student_id)
                                        ->first();
                $classes[$pass->id] = DB::table('classes')
                                        ->where('teacher_id', '=', $pass->teacher_id)
                                        ->first();
                $lessons[$pass->id] = DB::table('lessons')
                                        ->where('id', '=', $pass->lesson_id)
                                        ->first();
                
            }
            return view('alerts',[
                'passes' => $passes,
                'names' => $names,
                'classes' => $classes,
                'lessons' => $lessons
            ]);
        }else{
            $passes = DB::table('pass')
            ->join('students', function ($join) {
                $join->on('students.id', '=', 'pass.student_id')
                        ->where([['students.user_id', '=', Auth::user()->id],['pass.value','=',2]])
                        ->orWhere([['students.user_id', '=', Auth::user()->id],['pass.value','=','Н']]);
                    })
                ->get();
            $names=NULL;
            $classes=NULL;
            $lessons=NULL;
            foreach($passes as $pass){
                $names[$pass->id] = DB::table('users')
                                        ->where('id', '=', $pass->teacher_id)
                                        ->first();
                $classes[$pass->id] = DB::table('classes')
                                        ->where('id', '=', $pass->class_id)
                                        ->first();
                $lessons[$pass->id] = DB::table('lessons')
                                        ->where('id', '=', $pass->lesson_id)
                                        ->first();
                
            }
            return view('alerts',[
                'passes' => $passes,
                'names' => $names,
                'classes' => $classes,
                'lessons' => $lessons
            ]);
        }
    }
}
