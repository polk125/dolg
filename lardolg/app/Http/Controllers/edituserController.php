<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class edituserController extends Controller
{
    public function add(Request $request)
    {
        $result = DB::table('users')->where('id', '=', $request->temp['id'])
        ->update(['about'=>$request->temp['value']]);
    return ($request->temp);
    }
    public function phone(Request $request)
    {
        $result = DB::table('users')->where('id', '=', $request->temp['id'])
        ->update(['phone'=>$request->temp['value']]);
    return ($request->temp);
    }
    public function email(Request $request)
    {
        $result = DB::table('users')->where('id', '=', $request->temp['id'])
        ->update(['email'=>$request->temp['value']]);
    return ($request->temp);
    }
    public function class(Request $request)
    {
        $result = DB::table('students')->where('user_id', '=', $request->temp['id'])
        ->update(['class_id'=>$request->temp['value']]);
    return ($request->temp);
    }
    public function parent(Request $request)
    {
        $result = DB::table('students')->where('user_id', '=', $request->temp['id'])
        ->update(['parenth_id'=>$request->temp['value']]);
    return ($request->temp);
    }
    public function newpass(Request $request)
    {
        $random = str_shuffle('abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ1234567890');
        $password = substr($random, 0, 7);
        $result = DB::table('users')->where('id', '=', $request->temp)
        ->update(['password'=>Hash::make($password)]);
    return ($password);
    }
    public function editClassTeacher(Request $request)
    {
        $result = DB::table('classes')->where('id', '=', $request->temp['id'])
        ->update(['teacher_id'=>$request->temp['value']]);
    return ($request->temp);
    }
    public function lessonteacher(Request $request)
    {
        $result = DB::table('lessonteacher')->where('id', '=', $request->temp['id'])
        ->update(['teacher_id'=>$request->temp['value']]);
    return ($request->temp);
    }
    public function deleteuser(Request $request)
    {
        DB::beginTransaction();
        $who = DB::table('users')->where('id','=', $request->temp)->first();
        if($who->typeAdmin == 2){
            $admin = DB::table('users')->where('id','=', $request->temp)->delete();
            $pass = DB::table('pass')->where('teacher_id','=',$request->temp)->delete();
            $lessonteacher = DB::table('lessonteacher')->where('teacher_id','=',$request->temp)->update(['teacher_id'=>NULL]);
            $class = DB::table('classes')->where('teacher_id','=',$request->temp)->update(['teacher_id'=>NULL]);
            $test = DB::table('tests')->where('teacherid','=',$request->temp)->update(['teacherid'=>NULL]);
            $connect = DB::table('userconnect')->where('userid','=',$request->temp)->delete();
            $material = DB::table('materials')->where('teacher_id','=',$request->temp)->update(['teacher_id'=>NULL]);
            
        }elseif($who->typeAdmin == 3){
            $studentid = DB::table('students')->where('user_id','=', $request->temp)->first();
            $student = DB::table('students')->where('user_id','=', $request->temp)->delete();
            $admin = DB::table('users')->where('id','=', $request->temp)->delete();
            $pass = DB::table('pass')->where('student_id','=', $studentid->id)->delete();
            $pass = DB::table('coplitedquestion')->where('student_id','=', $studentid->id)->delete();
            $connect = DB::table('userconnect')->where('userid','=',$request->temp)->delete();
        }elseif($who->typeAdmin == 4){
            $parenth = DB::table('users')->where('id','=', $request->temp)->delete();
            $student = DB::table('students')->where('parenth_id','=',$request->temp)->update(['parenth_id' => NULL]);
            $connect = DB::table('userconnect')->where('userid','=',$request->temp)->delete();
        }else{
            $admin = DB::table('users')->where('id','=', $request->temp)->delete();
            $connect = DB::table('userconnect')->where('userid','=',$request->temp)->delete();
        }
        DB::commit();
    }
    public function deleteclass(Request $request)
    {
        DB::beginTransaction();
        $class=DB::table('classes')->where('id','=',$request->temp)->delete();
        $lessons=DB::table('lessonteacher')->where('class_id','=',$request->temp)->delete();
        $student = DB::table('students')->where('class_id','=',$request->temp)->update(['class_id'=>NULL]);
        DB::commit();
    }
    public function deletelessonteacher(Request $request)
    {
        DB::beginTransaction();
        $lessons=DB::table('lessonteacher')->where('id','=',$request->temp)->delete();
        DB::commit();
    }
    public function deletelesson(Request $request)
    {
        DB::beginTransaction();
        $class=DB::table('lessons')->where('id','=',$request->temp)->delete();
        $lessons=DB::table('lessonteacher')->where('lesson_id','=',$request->temp)->delete();
        $pass =DB::table('pass')->where('lesson_id','=',$request->temp)->delete();
        $test = DB::table('tests')->where('lessonid','=',$request->temp)->delete();
        $material = DB::table('materials')->where('lesson_id','=',$request->temp)->delete();
        $student = DB::table('students')->where('class_id','=',$request->temp)->update(['class_id'=>NULL]);
        DB::commit();
    }
    public function teacherclass(Request $request)
    {   

        $class=DB::table('classes')->where('id','=',$request->temp)->update(['teacher_id' => NULL]);
    }
    public function teacherlesson(Request $request)
    {   

        $class=DB::table('lessonteacher')->where('id','=',$request->temp)->update(['teacher_id' => NULL]);
    }
    public function deleteparenth(Request $request)
    {   
        $class=DB::table('students')->where('id','=',$request->temp)->update(['parenth_id' => NULL]);
    }
    public function download($fileId){
        $pathToFile=public_path('dowload/'.$fileId);
        return response()->download($pathToFile);      
    }
}
