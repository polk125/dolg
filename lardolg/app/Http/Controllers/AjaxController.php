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
        ->where('id','=', $request->params['obj'])
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
                    $result = DB::table('pass')->where([
                    ['student_id', '=', $request->params['user']], 
                    ['teacher_id','=', $lessonteacher->teacher_id], 
                    ['lesson_id','=',$lessonteacher->lesson_id], 
                    ['date','=',$request->params['date']]
                    ])
                    ->update(['value'=>$request->params['value'],
                    'why'=>$request->params['why'],
                    'test_id'=>$request->params['test'],
                    'material_id'=>$request->params['material']]);
                    return($request->params);
                
            }else{     
                $pass = DB::table('pass')->insert(
                    ['student_id' => $request->params['user'], 
                    'teacher_id' => $lessonteacher->teacher_id,
                    'lesson_id' => $lessonteacher->lesson_id,
                    'value' => $request->params['value'],
                    'why' => $request->params['why'],
                    'date' => $request->params['date'],
                    'test_id'=>$request->params['test'],
                    'material_id'=>$request->params['material']           
                    ]
                  );
                  return($request->params);
                  
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
    public function delete(Request $request)
    {
        $lessonteacher = DB::table('lessonteacher')
        ->select('teacher_id','lesson_id')
        ->where('id','=', $request->params['obj'])
        ->first();
        if(preg_match('/^[2345Нн]+$/', $request->params['value'])){
            $result = DB::table('pass')->where([
                ['student_id', '=', $request->params['user']], 
                ['teacher_id','=', $lessonteacher->teacher_id], 
                ['lesson_id','=',$lessonteacher->lesson_id], 
                ['date','=',$request->params['date']]
            ])
            ->update(['value'=>$request->params['value'], 'tire'=>2]);            
        }else{
            $result = DB::table('pass')->where([
                ['student_id', '=', $request->params['user']], 
                ['teacher_id','=', $lessonteacher->teacher_id], 
                ['lesson_id','=',$lessonteacher->lesson_id], 
                ['date','=',$request->params['date']]
                ])
                ->delete();
                
        }
        return($request->params);
    }
    public function render(Request $request)
    {
        $tests = DB::table('tests')
                ->where('lessonid', '=', $request->params['obj'])
                ->get();

        $matreials = DB::table('materials')
                ->where('lesson_id', '=', $request->params['obj'])
                ->get();
            $name=NULL;
        foreach($tests as $test):
            $name[$test->id] = DB::table('users')
                ->where('id', '=', $test->teacherid)
                ->first();
        endforeach;
            $names = NULL;
        foreach($matreials as $matreial):
            $names[$matreial->id] = DB::table('users')
                ->where('id', '=', $test->teacherid)
                ->first();
        endforeach;
        return view('ajax/render', ['tests' => $tests, 'name' =>$name, 'materials' => $matreials, 'names' =>$names]);
    }


    public function updateimg(Request $request)
    {
        foreach ($request->file() as $file) {
            
            $file_exploded = explode(".", $file->getClientOriginalName());
            $pref = $file_exploded[0];
            $suf = $file_exploded[1];
            $load =$pref.'.'.$suf;
            $Dowload = $file;
            $Dowload->move(public_path() . '/docs/materials', $load);
            return view('ajax/addImg', ['load' => $load]);
        }
    }
    public function updateaddimg(Request $request)
    {
        foreach ($request->file() as $file) {
            
            $file_exploded = explode(".", $file->getClientOriginalName());
            $pref = $file_exploded[0];
            $suf = $file_exploded[1];
            $load =$pref.'.'.$suf;
            $Dowload = $file;
            $Dowload->move(public_path() . '/docs/materials', $load);
            return view('ajax/addedImg', ['load' => $load, 'id'=> $request->id]);
        }
    }

    public function testupdateimg(Request $request)
    {
        foreach ($request->file() as $file) {
            
            $file_exploded = explode(".", $file->getClientOriginalName());
            $pref = $file_exploded[0];
            $suf = $file_exploded[1];
            $load =$pref.'.'.$suf;
            $Dowload = $file;
            $Dowload->move(public_path() . '/docs', $load);
            return view('ajax/testaddImg', ['load' => $load]);
        }
    }
    public function testupdateaddimg(Request $request)
    {
        foreach ($request->file() as $file) {
            
            $file_exploded = explode(".", $file->getClientOriginalName());
            $pref = $file_exploded[0];
            $suf = $file_exploded[1];
            $load =$pref.'.'.$suf;
            $Dowload = $file;
            $Dowload->move(public_path() . '/docs', $load);
            return view('ajax/testaddedImg', ['load' => $load, 'id'=> $request->id]);
        }
    }

    public function testupdateanswerimg(Request $request)
    {
        foreach ($request->file() as $file) {
            
            $file_exploded = explode(".", $file->getClientOriginalName());
            $pref = $file_exploded[0];
            $suf = $file_exploded[1];
            $load =$pref.'.'.$suf;
            $Dowload = $file;
            $Dowload->move(public_path() . '/docs', $load);
            return view('ajax/testaddedImg', ['load' => $load, 'id'=> $request->id]);
        }
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
