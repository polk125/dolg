<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class deletePass extends Controller
{
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
}
