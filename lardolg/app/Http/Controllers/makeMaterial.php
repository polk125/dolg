<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class makeMaterial extends Controller
{
    public function index(){
        $lessons = DB::table('lessons')->get();
        return view('makeMaterials', [
            'objs' => $lessons
        ]);
    }
    public function post(Request $request){
        $load=NULL;
        if(!isset($request->check)){
            
            if($request->hasFile('test_load')) {
                $file_exploded = explode(".", $request->file('test_load')->getClientOriginalName());
                $pref = $file_exploded[0];
                $suf = $file_exploded[1];
                $load =$pref.'.'.$suf;
                $file = $request->file('test_load');
                $file->move(public_path() . '/docs/materials', $load);
            }
                $testid = DB::table('materials')->insertGetId(
                    ['name' => $request->name,
                    'teacher_id' => Auth::user()->id,
                    'lesson_id' => $request->obj,
                    'include' => $request->$load,
                    'theme' => $request->theme
                    ]
                );

            return redirect('materials');
        }else{
            if($request->hasFile('test_load')) {
                $file_exploded = explode(".", $request->file('test_load')->getClientOriginalName());
                $pref = $file_exploded[0];
                $suf = $file_exploded[1];
                $load =$pref.'.'.$suf;
                $file = $request->file('test_load');
                $file->move(public_path() . '/docs/materials', $load);
            }
            return view('makeMaterials', [
                'request' => $request,
                'load' => $load
            ]);
        }
    }
    public function add(Request $request){
        $testid = DB::table('materials')->insertGetId(
            ['name' => $request->test_name,
            'teacher_id' => Auth::user()->id,
            'lesson_id' => $request->quest_type,
            'include' => $request->quest_load,
            'theme' => $request->test_theme, 
            ]
        );
        if(count($request->files)==0){
            return redirect('materials');
        }else{
        foreach($request->files as $kluch=>$file){
            $file_exploded = explode(".", $request->file($kluch)->getClientOriginalName());
            $pref = $file_exploded[0];
            $suf = $file_exploded[1];
            $img =$pref.'.'.$suf;
            $file = $request->file($kluch);
            $file->move(public_path() . '/docs/materials', $img);
            $test = DB::table('includesmaterials')->insert(['material_id' => $testid,'include' => $img]);
        }    
        return redirect('materials');
        } 
    }
}
