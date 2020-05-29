<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class adminController extends Controller
{
    public function index(){
    return view('admin');
    }
    public function addusers(){
        return view('adduser');
    }
    public function upload(Request $request){
        $validator = Validator::make($request->all(),[
            'file' => 'required|max:5000|mimes:xlsx, xls, csv'
        ]);
        if($validator->passes()){
            return redirect()->back()
            ->with(['success'=>'Пользователи загруженны']);
        }else{
            return redirect()->back()
            ->with(['errors'=>$validator->errors()->all()]);
        }
        
    }
}
