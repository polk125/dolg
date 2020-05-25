<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class renderTestController extends Controller
{
    public function name(Request $request){
        $result = DB::table('tests')->where('id', '=', $request->data['id'])
            ->update(['name'=>$request->data['new_name']]);
        return ($request->data['new_name']);
    }
    public function theme(Request $request){
        $result = DB::table('tests')->where('id', '=', $request->data['id'])
            ->update(['theme'=>$request->data['new_theme']]);
        return ($request->data['new_theme']);
    }
    public function lesson(Request $request){
        $result = DB::table('tests')->where('id', '=', $request->data['id'])
            ->update(['lessonid'=>$request->data['new_lesson']]);
        return ($request->data['new_lesson']);
    }
    public function delete($id){
        $result = DB::table('tests')->where('id', '=', $id)
        ->delete();
    }
    public function question(Request $request){
        $result = DB::table('questions')->where('id', '=', $request->data['id'])
            ->update(['question'=>$request->data['new_question']]);
        return ($request->data['new_question']);
    }
    public function answer(Request $request){
        $result = DB::table('answers')->where('id', '=', $request->data['id'])
            ->update(['text'=>$request->data['new_answer'],'correct'=>$request->data['new_correct']]);
        return ($request->data);
    }
    public function editFirstImg(Request $request){
        $result = DB::table('tests')->where('id', '=', $request->data['id'])
            ->update(['include'=>$request->data['src']]);
    }
    public function editImg(Request $request){
        $result = DB::table('questions')->where('id', '=', $request->data['id'])
            ->update(['include'=>$request->data['src']]);
    }
    public function editAnswerImg(Request $request){
        $result = DB::table('answers')->where('id', '=', $request->data['id'])
            ->update(['include'=>$request->data['src']]);
    }
    public function deleteFirstImg(Request $request){
        $result = DB::table('tests')->where('id', '=', $request->data['id'])
            ->update(['include'=> NULL]);
    }
    public function deleteImg(Request $request){
        $result = DB::table('questions')->where('id', '=', $request->data['id'])
            ->update(['include'=> '']);
    }
    public function deleteAnswerImg(Request $request){
        $result = DB::table('answers')->where('id', '=', $request->data['id'])
            ->update(['include'=> '']);
    }
}
