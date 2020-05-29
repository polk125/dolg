<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

   

class userController extends Controller
{
    public function index($id){
        $user = DB::table('users')->where('id','=',$id)->first();
        $userconnect=NULL;
        $userconnect = DB::table('userconnect')->where('userid','=',$id)->get();
        if($user->id == Auth::user()->id){
            return redirect('home');
        }
        if($user->typeAdmin == 2){
            $teacherclasses=DB::table('classes')->where('teacher_id', '=', $user->id)->orderBy('number')->get();

            $teacherlessons=DB::table('lessonteacher')->where('lessonteacher.teacher_id', '=', $user->id)
            ->join('classes', 'lessonteacher.class_id', '=', 'classes.id' )
            ->join('lessons', 'lessonteacher.lesson_id', '=', 'lessons.id' )
            ->get();
            return view('teacherRender',[
                'user' => $user,
                'classes' => $teacherclasses,
                'lesson' => $teacherlessons,
                'connect'=> $userconnect
            ]); 
        }
        if($user->typeAdmin == 4){
            if(Auth::user()->typeAdmin == 2){
            $children=DB::table('students')->where('parenth_id', '=', $user->id)
            ->join('classes', 'students.class_id','=','classes.id')
            ->get();
            return view('parentRender',[
                'user' => $user,
                'children' => $children,
                'connect'=> $userconnect
            ]);
        }else{
            return redirect('home');
        } 
        }
        if($user->typeAdmin == 3){
            if(Auth::user()->typeAdmin == 2 || Auth::user()->typeAdmin == 4){
            $student=DB::table('students')->where('user_id', '=', $id)->first();
            $parent = DB::table('users')->where('id', '=', $student->parenth_id)->first();
            $pass=DB::table('pass')->where('pass.student_id', '=', $student->id)
            ->join('lessons','pass.lesson_id', '=', 'lessons.id' )
            ->orderby('pass.date')
            ->get();
            return view('studentRender',[
                'user' => $user,
                'pass' => $pass,
                'parent' => $parent,
                'student' => $student,
                'connect'=> $userconnect
            ]);
        }else{
            return redirect('home');
        } 
        }
    }
}
