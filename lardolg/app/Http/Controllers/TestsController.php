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
        
        $name=NULL;
        foreach($tests as $test){
            $name[$test->id]=DB::table('users')->where('id', '=', $test->teacherid)->select('name','id')->first();
        }
        return view('tests', [
            'lessons' => $lessons,
            'tests' => $tests,
            'names' => $name
        ]);
    }
    public function test($id){
        $test = DB::table('tests')->where('id', '=', $id)->first();
        $who = DB::table('users')->where('id','=',$test->teacherid)->select('name', 'id')->first();
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
            $name[$test->id]=DB::table('users')->where('id', '=', $test->teacherid)->select('name', 'id')->first();
        }
        return view('tests', [
            'lessons' => $lessons,
            'tests' => $tests,
            'names' => $name,
            'object' => $request->object
        ]);
    }
    public function editTest($id){
        $test = DB::table('tests')->where('id', '=', $id)->first();
        if(!isset($test)){
            return abort(404);
        }
        $who = DB::table('users')->where('id','=',$test->teacherid)->select('name','id')->first();
        $lessons = DB::table('lessons')->get();
        $questions = DB::table('questions')->where('testid', '=', $test->id)->get();
        foreach($questions as $question):
            $answer[$question->id] =  DB::table('answers')->where('questionid', '=', $question->id)->get(); 
            
        endforeach;
        return view('editTest',[
            'test' => $test,
            'who' => $who,
            'lessons' => $lessons,
            'question' => $questions,
            'answers' => $answer
        ]);
    }
    public function loock($fileId){
        $pathToFile=public_path('/docs/'.$fileId);
        return response()->file($pathToFile);      
    }
    public function download($fileId){
        $pathToFile=public_path('/docs/'.$fileId);
        return response()->download($pathToFile);      
    }
}
