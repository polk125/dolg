<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\classes;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ClassesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $tasks = \App\classes::orderBy('created_at', 'asc')->get();
        $usr = DB::table('users')->get();
        foreach($usr as $use){
            $users[$use->name] = DB::table('classes')
            ->where('teacher_id', '=', $use->id)
            ->get();
            
        }
        return view('classes', [
            'tasks' => $tasks,
            'users' => $users
        ]);
    }

    public function post(Request $request) {
        
        $task = new \App\classes;
        $task->type=$request->name;
        $task->user_id=1;
        $task->save();
        return redirect('/');
    
    }

    public function delete(\App\classes $task) {
        $task -> delete();
        
        return redirect('/');
    }
}
