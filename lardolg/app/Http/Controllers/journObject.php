<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class journObject extends Controller
{
    public function index(){
        $user=Auth::user()->id;
        $lessons=DB::table('lessonteacher')
        ->where('teacher_id', '=', $user)
        ->get();
        foreach($lessons as $lesson){
            $names[$lesson->id] = DB::table('lessons')
                                    ->where('id', '=', $lesson->lesson_id)
                                    ->get();
            $classes[$lesson->id] = DB::table('classes')
                                    ->where('id', '=', $lesson->class_id)
                                    ->get();
            $students[$lesson->id] = DB::table('students')
                                    ->where('class_id', '=', $lesson->class_id)
                                    ->get();
            
        }
        if (!isset($names)) {
            return view('object_journ');
        }
        dd($names);
        $pass = DB::table('pass')->get();
        return view('object_journ', [
            'lessons' => $lessons,
            'names' => $names,
            'students' => $students,
            'classes' => $classes,
            'pass' => $pass
        ]);
    }
    public function post(Request $request){
        $user=Auth::user()->id;
        $lessons=DB::table('lessonteacher')
        ->where('teacher_id', '=', $user)
        ->get();
        foreach($lessons as $lesson){
            $names[$lesson->id] = DB::table('lessons')
                                    ->select('name')
                                    ->where('id', '=', $lesson->lesson_id)
                                    ->get();
            $classes[$lesson->id] = DB::table('classes')
                                    ->where('id', '=', $lesson->class_id)
                                    ->get();
            $students[$lesson->id] = DB::table('students')
                                    ->where('class_id', '=', $lesson->class_id)
                                    ->get();
        }
        $pass = DB::table('pass')->get();

    
        return view('object_journ', [
            'month' => $request->journ_month,
            'lessons' => $lessons,
            'names' => $names,
            'students' => $students,
            'classes' => $classes,
            'pass' => $pass
        ]);
    }
}
