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
