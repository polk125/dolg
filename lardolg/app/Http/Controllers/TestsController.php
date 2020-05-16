<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TestsController extends Controller
{
    public function index(){
        $lessons = DB::table('lessons')->get();
        $tests = DB::table('tests')->get();
        foreach($tests as $test){
            $name[$test->id]=DB::table('users')->where('id', '=', $test->teacherid)->select('name')->first();
        }
        return view('tests', [
            'lessons' => $lessons,
            'tests' => $tests,
            'names' => $name
        ]);
    }
    public function test($id){
        $test = DB::table('tests')->where('id', '=', $id)->first();
        $who = DB::table('users')->where('id','=',$test->teacherid)->select('name')->first();
        $lesson = DB::table('lessons')->where('id','=',$test->lessonid)->select('name')->first();
        $questions = DB::table('questions')->where('testid', '=', $test->id)->get();
        foreach($questions as $question):
            $answer[$question->id] =  DB::table('answers')->where('questionid', '=', $question->id)->get(); 
            
        endforeach;
        return view('renderTests',[
            'test' => $test,
            'who' => $who,
            'lesson' => $lesson,
            'question' => $questions,
            'answers' => $answer
        ]);
    }
    public function post(Request $request){
        $lessons = DB::table('lessons')->get();
        if($request->object=='all'){
            $tests = DB::table('tests')->get();
        }else{
            $tests = DB::table('tests')->where('lessonid', '=', $request->object)->get();
        }
        $name=NULL;
        foreach($tests as $test){
            $name[$test->id]=DB::table('users')->where('id', '=', $test->teacherid)->select('name')->first();
        }
        return view('tests', [
            'lessons' => $lessons,
            'tests' => $tests,
            'names' => $name,
            'object' => $request->object
        ]);
    }
}
