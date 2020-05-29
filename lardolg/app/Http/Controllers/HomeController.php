<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $includes=DB::table('userconnect')->where('userid', '=', Auth::user()->id)->get();
        if(Auth::user()->typeAdmin == 2){
            $teacherclasses=DB::table('classes')->where('teacher_id', '=', Auth::user()->id)->orderBy('number')->get();

            $teacherlessons=DB::table('lessonteacher')->where('lessonteacher.teacher_id', '=', Auth::user()->id)
            ->join('classes', 'lessonteacher.class_id', '=', 'classes.id' )
            ->join('lessons', 'lessonteacher.lesson_id', '=', 'lessons.id' )
            ->get();
            return view('home',[
                'classes' => $teacherclasses,
                'lesson' => $teacherlessons,
                'includes' => $includes
            ]); 
        }elseif(Auth::user()->typeAdmin == 4){
                $children=DB::table('students')->where('parenth_id', '=', Auth::user()->id)
                ->join('classes', 'students.class_id','=','classes.id')
                ->get();
                return view('home',[
                    'children' => $children,
                    'includes' => $includes
                ]);
        }elseif(Auth::user()->typeAdmin == 3){
                $student=DB::table('students')->where('user_id', '=', $id)->first();
                $parent = DB::table('users')->where('id', '=', $student->parenth_id)->first();
                return view('home',[
                    'parent' => $parent,
                    'student' => $student,
                    'includes' => $includes
                ]);
        }elseif(Auth::user()->typeAdmin == 1){
            return view('home',[
                'includes' => $includes
            ]);
    }
        return view('/home');
    }
    public function add(Request $request)
    {
        $result = DB::table('users')->where('id', '=', Auth::user()->id)
        ->update(['about'=>$request->temp]);
    return ($request->temp);
    }
    public function phone(Request $request)
    {
        $result = DB::table('users')->where('id', '=', Auth::user()->id)
        ->update(['phone'=>$request->temp]);
    return ($request->temp);
    }
    public function email(Request $request)
    {
        $result = DB::table('users')->where('id', '=', Auth::user()->id)
        ->update(['email'=>$request->temp]);
    return ($request->temp);
    }
    public function addhref(Request $request)
    {
        
        if($request->temp['id'] != ''){
            if($request->temp['value'] ==''){
                $result = DB::table('userconnect')->where('id', '=', $request->temp['id'])
            ->delete();
            return 'delete';
            }
            $result = DB::table('userconnect')->where('id', '=', $request->temp['id'])
            ->update(['href'=>$request->temp['value']]);
            return ($request->temp['id']);
        }else{
            $result = DB::table('userconnect')
            ->insertGetId(
                ['href' => $request->temp['value'],
                'userid' => Auth::user()->id
                ]
            );
            return ($result);
        }
    }
    public function adddelete(Request $request)
    {
        $result = DB::table('userconnect')->where('id', '=', $request->temp)
        ->delete();
        return 'delete';
    }
}
