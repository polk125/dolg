<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class editMaterialController extends Controller
{
    public function name(Request $request){
        $result = DB::table('materials')->where('id', '=', $request->data['id'])
            ->update(['name'=>$request->data['new_name']]);
        return ($request->data['new_name']);
    }
    public function theme(Request $request){
        $result = DB::table('materials')->where('id', '=', $request->data['id'])
            ->update(['theme'=>$request->data['new_theme']]);
        return ($request->data['new_theme']);
    }
    public function lesson(Request $request){
        $result = DB::table('materials')->where('id', '=', $request->data['id'])
            ->update(['lesson_id'=>$request->data['new_lesson']]);
        return ($request->data['new_lesson']);
    }
    public function delete($id){
        $result = DB::table('materials')->where('id', '=', $id)
        ->delete();
    }
    public function editFirstImg(Request $request){
        $result = DB::table('materials')->where('id', '=', $request->data['id'])
            ->update(['include'=>$request->data['src']]);
    }
    public function editImg(Request $request){
        $result = DB::table('includesmaterials')->where('id', '=', $request->data['id'])
            ->update(['include'=>$request->data['src']]);
    }
    public function deletefirstimg(Request $request){
        $result = DB::table('materials')->where('id', '=', $request->data['id'])
            ->update(['include'=>$request->NULL]);
    }
    
    public function deleteImg(Request $request){
        $result = DB::table('includesmaterials')->where('id', '=', $request->data['id'])
            ->delete();
    }
}
