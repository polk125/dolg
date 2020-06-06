<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class additionalController extends Controller
{
    public function index()
    {
        
        $additional = DB::table('additional')
        ->join('lessons','additional.lesson','=','lessons.id')
        ->join('users','additional.teacher_id','=','users.id')
        ->select('users.name','users.id as uid','lessons.name as lname','additional.theme','additional.about','additional.id','additional.date','additional.howlong','additional.howmuch', 'additional.class')
        ->orderBy('date')
        ->get();
        $count = NULL;
        $d = NULL;
        $t = NULL;
        $to = NULL;
        $who = NULL;
        foreach($additional as $add){
            $count[$add->id] = DB::table('additionalstudent')->where('additional_id','=',$add->id)->count();
            $d[$add->id] = date('d.m.Y',strtotime($add->date));
            $t[$add->id] = date('H:i',strtotime($add->date));
            $to[$add->id] = date('H:i',strtotime($add->howlong));
        }
        if(Auth::user()->typeAdmin==3){
            $who = DB::table('additionalstudent')->where('student_id','=',Auth::user()->id)->count();
            if($who>0){
                $who = 1;
            }else{
                $who = 0;
            }
            return view('additional',['additionals'=>$additional, 'd'=>$d, 't'=>$t,'to'=>$to,'count'=>$count,'who'=>$who]);
        }
        return view('additional',['additionals'=>$additional, 'd'=>$d, 't'=>$t,'to'=>$to,'count'=>$count]);
    }
    public function post(Request $request)
    {
        
    }
    public function make()
    {
        $objs = DB::table('lessons')->get();
        return view('makeadditional',['objs'=>$objs]);
    }
    public function add(Request $request)
    {
        $datetry = $request->date.' '.$request->time.':00';
        $carbon = Carbon::parse($datetry);
        $howlong = $carbon->addHours((int)$request->longhour)->addMinutes((int)$request->longmin);
        $insert = DB::table('additional')->insert([
            'teacher_id'=> Auth::user()->id,
            'theme' => $request->theme,
            'about' => $request->about,
            'lesson'=> $request->lesson,
            'class' => $request->class,
            'howmuch' => $request->maxstudents,
            'howlong' => $howlong,
            'date' => Carbon::parse($datetry)
        ]);
        
        return redirect('additional');
    }
    public function render($id){
        $additional = DB::table('additional')->where('additional.id','=',$id)
        ->join('lessons','additional.lesson','=','lessons.id')
        ->join('users','additional.teacher_id','=','users.id')
        ->select('users.name','users.id as uid','lessons.name as lname','additional.theme','additional.about','additional.id','additional.date','additional.howlong','additional.howmuch', 'additional.class')
        ->first();
            $count = DB::table('additionalstudent')->where('additionalstudent.additional_id','=',$additional->id)
            ->join('students','additionalstudent.student_id','students.user_id')
            ->join('classes','students.class_id','classes.id')
            ->get();
            $d = date('d.m.Y',strtotime($additional->date));
            $t = date('H:i',strtotime($additional->date));
            $to = date('H:i',strtotime($additional->howlong));
        
        return view('renderadditional', ['additional'=>$additional, 'd'=>$d, 't'=>$t,'to'=>$to,'count'=>$count]);
    }
    public function registration(Request $request){
        if($request->temp['value']==0){
            $insert = DB::table('additionalstudent')->insert([
                'additional_id' => $request->temp['id'],
                'student_id' => Auth::user()->id
            ]);
        }else{
            $insert = DB::table('additionalstudent')->where('student_id','=',Auth::user()->id)->delete();
        }
        $count = DB::table('additionalstudent')->where('additional_id','=',$request->temp['id'])->count();
        return $count;
    }
}
