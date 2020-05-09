<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $lessonteacher = DB::table('lessonteacher')
        ->select('teacher_id','lesson_id')
        ->where('id','=', 1)
        ->first();
        if(preg_match('/^[2345Нн]+$/', $request->params['value'])){
            
            $result = DB::table('pass')->where([
                ['student_id', '=', $request->params['user']], 
                ['teacher_id','=', $lessonteacher->teacher_id], 
                ['lesson_id','=',$lessonteacher->lesson_id], 
                ['date','=',$request->params['date']]
                ])
                ->count();
            if($result>0){
                if(!isset($request->params['why'])){
                        $result = DB::table('pass')->where([
                        ['student_id', '=', $request->params['user']], 
                        ['teacher_id','=', $lessonteacher->teacher_id], 
                        ['lesson_id','=',$lessonteacher->lesson_id], 
                        ['date','=',$request->params['date']]
                        ])
                        ->update(['value'=>$request->params['value']]);
                        
                }else{             
                    $result = DB::table('pass')->where([
                    ['student_id', '=', $request->params['user']], 
                    ['teacher_id','=', $lessonteacher->teacher_id], 
                    ['lesson_id','=',$lessonteacher->lesson_id], 
                    ['date','=',$request->params['date']]
                    ])
                    ->update(['value'=>$request->params['value'],'why'=>$request->params['why']]);
                    
                }
            }else{
                if(!isset($request->params['why'])){
            $pass = DB::table('pass')->insert(
                ['student_id' => $request->params['user'], 
                'teacher_id' => $lessonteacher->teacher_id,
                'lesson_id' => $lessonteacher->lesson_id,
                'value' => $request->params['value'],
                'date' => $request->params['date']                
                ]
                
              );
              
            }else{           
                $pass = DB::table('pass')->insert(
                    
                    ['student_id' => $request->params['user'], 
                    'teacher_id' => $lessonteacher->teacher_id,
                    'lesson_id' => $lessonteacher->lesson_id,
                    'value' => $request->params['value'],
                    'why' => $request->params['why'],
                    'date' => $request->params['date']                
                    ]
                  );
                  
            }
            }
        }else{
            $result = DB::table('pass')->where([
                ['student_id', '=', $request->params['user']], 
                ['teacher_id','=', $lessonteacher->teacher_id], 
                ['lesson_id','=',$lessonteacher->lesson_id], 
                ['date','=',$request->params['date']]
                ])
                ->delete();
                
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
