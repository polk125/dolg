<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class materialsController extends Controller
{
    public function index(){
        $lessons = DB::table('lessons')->get();
        $materials = DB::table('materials')->get();
        $name=NULL;
        foreach($materials as $material){
            $name[$material->id]=DB::table('users')->where('id', '=', $material->teacher_id)->select('name','id')->first();
        }
        return view('materials', [
            'lessons' => $lessons,
            'materials' => $materials,
            'names' => $name
        ]);
    }
    public function post(Request $request){
        $lessons = DB::table('lessons')->get();
        $name=NULL;
        if($request->object=='all'){
            $materials = DB::table('materials')->get();
        }else{
            $materials = DB::table('materials')->where('lesson_id', '=', $request->object)->get();
        }
        $name=NULL;
        foreach($materials as $material){
            $name[$material->id]=DB::table('users')->where('id', '=', $material->teacher_id)->select('name','id')->first();
        }
        return view('materials', [
            'lessons' => $lessons,
            'materials' => $materials,
            'names' => $name,
            'object' => $request->object
        ]);
    }
    public function material($id){
        $materials = DB::table('materials')->where('id', '=', $id)->first();
        $who = DB::table('users')->where('id','=',$materials->teacher_id)->select('name','id')->first();
        $lesson = DB::table('lessons')->where('id','=',$materials->lesson_id)->first();
        $includes = DB::table('includesmaterials')->where('material_id', '=', $materials->id)->get();
        
        return view('renderMaterials',[
            'test' => $materials,
            'who' => $who,
            'lesson' => $lesson,
            'question' => $includes
        ]);
    }
    public function loock($fileId){
        $pathToFile=public_path('/docs/materials/'.$fileId);
        return response()->file($pathToFile);      
    }
    public function download($fileId){
        $pathToFile=public_path('/docs/materials/'.$fileId);
        return response()->download($pathToFile);      
    }

    public function editMaterial($id){
        $materials = DB::table('materials')->where('id', '=', $id)->first();
        $who = DB::table('users')->where('id','=',$materials->teacher_id)->select('name','id')->first();
        $lessons = DB::table('lessons')->get();
        $includes = DB::table('includesmaterials')->where('material_id', '=', $materials->id)->get();
        return view('editmaterial',[
            'test' => $materials,
            'who' => $who,
            'lessons' => $lessons,
            'question' => $includes
        ]);
    }
}
