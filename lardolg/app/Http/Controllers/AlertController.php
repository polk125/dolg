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
            ->where([['teacher_id','=', Auth::user()->id],['value','=','н'],['tire','=','0']])
            ->orWhere([['teacher_id','=', Auth::user()->id],['value','=','н'],['tire','=','1']])
            ->get();
            $names=NULL;
            $classes=NULL;
            $lessons=NULL;
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
        }elseif(Auth::user()->typeAdmin==3){
            $passes = DB::table('pass')
            ->join('students', function ($join) {
                $join->on('students.id', '=', 'pass.student_id')
                        ->where([['students.user_id', '=', Auth::user()->id],['pass.value','=', 'н']])
                        ->orWhere([['students.user_id', '=', Auth::user()->id],['pass.value','=','Н']]);
                    })
                ->get();
            $names=NULL;
            $classes=NULL;
            $lessons=NULL;
            $teachers=NULL;
            foreach($passes as $pass){
                $teachers[$pass->id] = DB::table('users')
                                        ->where('id', '=', $pass->teacher_id)
                                        ->first();
                $names[$pass->id] = DB::table('students')
                                        ->where('id', '=', $pass->student_id)
                                        ->first();
                $classes[$pass->id] = DB::table('classes')
                                        ->where('id', '=', $pass->class_id)
                                        ->first();
                $lessons[$pass->id] = DB::table('lessons')
                                        ->where('id', '=', $pass->lesson_id)
                                        ->first();
                
            }
            return view('alerts',[
                'teachers' => $teachers,
                'passes' => $passes,
                'names' => $names,
                'classes' => $classes,
                'lessons' => $lessons
            ]);
        }elseif(Auth::user()->typeAdmin==4){
            $passes = DB::table('pass')
            ->join('students', function ($join) {
                $join->on('students.id', '=', 'pass.student_id')
                        ->where([['students.parenth_id', '=', Auth::user()->id],['pass.value','=', 'н']])
                        ->orWhere([['students.parenth_id', '=', Auth::user()->id],['pass.value','=','Н']]);
                    })
                ->select('pass.id', 'student_id', 'teacher_id', 'lesson_id', 'date', 'why')
                ->get();
                $names=NULL;
            $classes=NULL;
            $lessons=NULL;
            $teachers=NULL;
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
                $teachers[$pass->id] = DB::table('users')
                                        ->where('id', '=', $pass->teacher_id)
                                        ->first();
                
            }
            return view('alerts',[
                'teachers' => $teachers,
                'passes' => $passes,
                'names' => $names,
                'classes' => $classes,
                'lessons' => $lessons
            ]);
        }
    }
}
