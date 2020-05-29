<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MakeTestController extends Controller
{
    public function index(){
        $lessons = DB::table('lessons')->get();
        return view('makeTests', [
            'objs' => $lessons
        ]);
    }
    public function post(Request $request){
        $load = '';
        if($request->hasFile('test_load')) {
            $file_exploded = explode(".", $request->file('test_load')->getClientOriginalName());
            $pref = $file_exploded[0];
            $suf = $file_exploded[1];
            $load =$pref.'.'.$suf;
            $file = $request->file('test_load');
            $file->move(public_path() . '/docs', $load);
        }
        return view('makeTests', [
            'request' => $request,
            'load' => $load
        ]);
    }
    public function add(Request $request){
        $stuck = array();

        foreach($request->all() as $key => $all):
            if(strripos($key,'answer')!==false && strripos($key,'correct')===false && strripos($key,'img')===false){
                $keys = explode( "_",$key);
                $stuck[$keys[0]][$keys[1]]=$all;
            }elseif(strripos($key,'answer')===false && strripos($key,'question')!==false && strripos($key,'img')===false){
                $stuck[$key]['name'] = $all;
            }
        endforeach;
        
        $testid = DB::table('tests')->insertGetId(
            ['name' => $request->test_name,
            'teacherid' => Auth::user()->id,
            'lessonid' => $request->quest_type,
            'include' => $request->quest_load,
            'theme' => $request->test_theme, 
            'date' => Carbon::now(),
            'hours'=>$request->test_hours,
            'minutes'=>$request->test_minutes
            ]
        );
        foreach($stuck as  $kluch =>$array):
            $img ='';
            if($request->hasFile($kluch.'_img')) {
                $file_exploded = explode(".", $request->file($kluch.'_img')->getClientOriginalName());
                $pref = $file_exploded[0];
                $suf = $file_exploded[1];
                $img =$pref.'.'.$suf;
                $file = $request->file($kluch.'_img');
                $file->move(public_path() . '/docs', $img);
            }
            foreach($array as $key => $insert):
                $imgquestion='';
                if($request->hasFile($kluch.'_'.$key.'_img')) {
                   
                    $file_exploded = explode(".", $request->file($kluch.'_'.$key.'_img')->getClientOriginalName());
                    $pref = $file_exploded[0];
                    $suf = $file_exploded[1];
                    $imgquestion =$pref.'.'.$suf;
                    $file = $request->file($kluch.'_'.$key.'_img');
                    $file->move(public_path() . '/docs', $imgquestion);
                }
                $correct=0;
                $requestkey=$kluch."_".$key."_correct";
                if(isset($request->$requestkey))
                {
                    $correct=1;
                }
                if($key=='name'){
                    $questionid = DB::table('questions')->insertGetId(
                        ['question' => $insert,
                        'quality' => 3,
                        'include' => $img,
                        'testid' => $testid 
                        ]
                    );
        
                }elseif($insert!==''){
                $answerid = DB::table('answers')->insert(
                    ['questionid' => $questionid,
                    'text' => $insert,
                    'include' => $imgquestion,
                    'correct' => $correct 
                    ]
                );
                }
            endforeach;
        endforeach;

        return redirect('tests');
    }
}
