<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Importer;
use Exporter;
class adminController extends Controller

{
    public function index(){
        $classes=DB::table('classes')
        ->get();
        
        $pass = NULL;
        $lessons = NULL;
        $teacher = NULL;
        foreach($classes as $class){
            $teacher[$class->id] = DB::table('users')->where('id','=',$class->teacher_id)->first();
            $lessons[$class->id] = DB::table('lessonteacher')->where('lessonteacher.class_id','=',$class->id)
            ->join('lessons','lessonteacher.lesson_id','=','lessons.id')
            ->join('users','users.id','=','lessonteacher.teacher_id')
            ->select('lessons.id','lessons.name','users.name as uname','users.id as uid')
            ->get();
            foreach($lessons[$class->id] as $lesson){
                
            $pass[$class->id][$lesson->id] = DB::table('pass')
            ->join('students','students.id','pass.student_id')
            ->join('users','users.id','=','pass.teacher_id')
            ->where([['pass.lesson_id','=',$lesson->id],['students.class_id','=',$class->id]])
            ->select('students.fio','users.name','pass.value','pass.date','users.id','students.user_id','pass.tire')
            ->orderBy('pass.date')
            ->get(); 
            }
        }
        return view('admin/admin',['pass'=>$pass,'classes'=>$classes,'lessons'=>$lessons,'teacher'=>$teacher]);
    }
    public function addusers(){
        return view('admin/adduser');
    }
    public function handadd(){
        
        return view('admin/handadd');
    }
    public function uploadstudent(Request $request){
        $validator = Validator::make($request->all(),[
            'file' => 'required|max:5000|mimes:xlsx, xls, csv'
        ]);
        if($validator->passes()){

            $dataTime= date('Ymd_His');
            $file= $request->file('file');
            $fileName = $dataTime.'-'.$file->getClientOriginalName();
            $savePath=public_path('/upload/');
            $file->move($savePath, $fileName);

            $excel= Importer::make('Excel');
            $excel->load($savePath.$fileName);
            $collection = $excel->getCollection();
            if(sizeof($collection[1])==9){
                $collection[0] = array_add($collection[0], 9, 'Пароль Ученика');
                $collection[0] = array_add($collection[0], 10, 'Пароль Родителя');
                $collection[0] = array_add($collection[0], 11, 'Добавление');
                for($row=1; $row<sizeof($collection); $row++){
                    try{

                        $random = str_shuffle('abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ1234567890');
                        $password = substr($random, 0, 7);  
                        $randomparent = str_shuffle('abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ1234567890');
                        $passwordparent = substr($randomparent, 0, 7); 
                        $collection[$row] = array_add($collection[$row], 9, $password);
                        $collection[$row] = array_add($collection[$row], 10, $passwordparent);
                        $class = DB::table('classes')->where([['number','=',$collection[$row][5]],['type','=',$collection[$row][6]]])->first();
                        
                            if(isset($class)){
                                DB::beginTransaction();
                                try{
                                    $parent = DB::table('users')->where('name','=',$collection[$row][7])->orWhere('name','=',$collection[$row][8])
                                    ->first();
                                    if(isset($parent->id)){
                                        $insertparent = $parent->id;
                                    }else{
                                        $insertparent = DB::table('users')->insertGetId([
                                            'name' => $collection[$row][7],
                                            'login' => $collection[$row][8],
                                            'password' => Hash::make($passwordparent),
                                            'typeAdmin' => 4,
                                        ]);
                                    }
                                    $insert = DB::table('users')->insertGetId([
                                        'name' => $collection[$row][0],
                                        'email' => $collection[$row][1],
                                        'phone' => $collection[$row][3],
                                        'login' => $collection[$row][2],
                                        'password' => Hash::make($password),
                                        'typeAdmin' => 3,
                                    ]);
                                    $insertstudent = DB::table('students')->insert([
                                        'fio' => $collection[$row][0],
                                        'user_id' => $insert,
                                        'parenth_id' => $insertparent,
                                        'class_id' => $class->id,
                                        'gender' => $collection[$row][4],
                                    ]);
                                    $collection[$row] = array_add($collection[$row], 11, 'добавлено');
                                }catch(\Exception $e){
                                    DB::rollback();
                                    return $e->getMessage();
                                    $collection[$row] = array_add($collection[$row], 11, 'ошибка');
                                }
                                DB::commit();
                            }else{
                                DB::beginTransaction();
                                try{
                                $class = DB::table('classes')->insertGetId([
                                    'number' => $collection[$row][5],
                                    'type' => $collection[$row][6],
                                ]);
                                $lessons = DB::table('lessons')->where([['start','<=',$collection[$row][5]],['end','>=',$collection[$row][5]]])->get();
                                foreach($lessons as $lesson){
                                    $lessonteacher = DB::table('lessonteacher')->insert(['lesson_id'=>$lesson->id,'class_id'=>$class]);
                                }
                                
                                $parent = DB::table('users')->where('name','=',$collection[$row][7])->orWhere('name','=',$collection[$row][8])
                                ->first();
                                if(isset($parent->id)){
                                    $insertparent = $parent->id;
                                }else{
                                    $insertparent = DB::table('users')->insertGetId([
                                        'name' => $collection[$row][7],
                                        'login' => $collection[$row][8],
                                        'password' => Hash::make($passwordparent),
                                        'typeAdmin' => 4,
                                    ]);
                                }
                                $insert = DB::table('users')->insertGetId([
                                    'name' => $collection[$row][0],
                                    'email' => $collection[$row][1],
                                    'phone' => $collection[$row][3],
                                    'login' => $collection[$row][2],
                                    'password' => Hash::make($password),
                                    'typeAdmin' => 3,
                                ]);
                                $insertstudent = DB::table('students')->insert([
                                    'fio' => $collection[$row][0],
                                    'user_id' => $insert,
                                    'parenth_id' => $insertparent,
                                    'class_id' => $class,
                                    'gender' => $collection[$row][4],
                                ]);
                                $collection[$row] = array_add($collection[$row], 11, 'добавлено');
                                }catch(\Exception $e){
                                    DB::rollback();
                                    $errorinsert[$row] = $e->getMessage();
                                    $collection[$row] = array_add($collection[$row], 11, 'ошибка');
                                }
                                DB::commit();
                            }
                        
                    
                    }catch(\Exception $e){
                        
                        $collection[$row] = array_add($collection[$row], 9, 'ошибка');
                        $collection[$row] = array_add($collection[$row], 10, 'ошибка');
                        $collection[$row] = array_add($collection[$row], 11, 'ошибка');
                        $errorcheck[$row] = $e->getMessage();
                    }
                }
                $fileName=$dataTime.'-'."UploadetStudents.xlsx";
                $savePath=public_path('/dowload/'.$fileName);
                $excel = Exporter::make('Excel');
                $excel->load($collection);
                $excel->save($savePath);
                return view('admin/studentsadd',['collection'=>$collection,'url'=>$fileName]);
            }else{
                return redirect()->back()
            ->with(['errors'=>[0=> 'Пожалуйста соблюдайте правильную модель загружаеммых данных!']]);
            }

            
        }else{
            return redirect()->back()
            ->with(['errors'=>$validator->errors()->all()]);
        }
        
    }
    
    public function uploadteacher(Request $request){
        $validator = Validator::make($request->all(),[
            'file' => 'required|max:5000|mimes:xlsx, xls, csv'
        ]);
        if($validator->passes()){

            $dataTime= date('Ymd_His');
            $file= $request->file('file');
            $fileName = $dataTime.'-'.$file->getClientOriginalName();
            $savePath=public_path('/upload/');
            $file->move($savePath, $fileName);

            $excel= Importer::make('Excel');
            $excel->load($savePath.$fileName);
            $collection = $excel->getCollection();
            $collection[0] = array_add($collection[0], 4, 'Пароль Учителя');
            $collection[0] = array_add($collection[0], 5, 'Добавление');
            if(sizeof($collection[1])==4){
                for($row=1; $row<sizeof($collection); $row++){
                    try{
                        $random = str_shuffle('abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ1234567890');
                        $password = substr($random, 0, 7);  
                        $collection[$row] = array_add($collection[$row], 4, $password);
                                DB::beginTransaction();
                                try{
                                    $insert = DB::table('users')->insertGetId([
                                        'name' => $collection[$row][0],
                                        'email' => $collection[$row][1],
                                        'phone' => $collection[$row][3],
                                        'login' => $collection[$row][2],
                                        'password' => Hash::make($password),
                                        'typeAdmin' => 2,
                                    ]);
                                    $collection[$row] = array_add($collection[$row], 5, 'добавлено');
                                }catch(\Exception $e){
                                    DB::rollback();
                                    return $e->getMessage();
                                    $collection[$row] = array_add($collection[$row], 5, 'ошибка');
                                }
                                DB::commit();
                    }catch(\Exception $e){
                        $collection[$row] = array_add($collection[$row], 5, 'ошибка');
                    }
                }
                $fileName=$dataTime.'-'."UploadetTeacher.xlsx";
                $savePath=public_path('/dowload/'.$fileName);
                $excel = Exporter::make('Excel');
                $excel->load($collection);
                $excel->save($savePath);
                return view('admin/teachersadd',['collection'=>$collection,'url'=>$fileName]);
            }else{
                return redirect()->back()
            ->with(['errors'=>[0=> 'Пожалуйста соблюдайте правильную модель загружаеммых данных!']]);
            }


        }else{
            return redirect()->back()
            ->with(['errors'=>$validator->errors()->all()]);
        }
        
    }

    public function uploadhand(Request $request){
        if($request->role == 1){
            if(!isset($request->phone)){
                $request->phone=NULL;
            }
            if(!isset($request->email)){
                $request->email=NULL;
            }
            $random = str_shuffle('abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ1234567890');
                        $password = substr($random, 0, 7);  
            $insert = DB::table('users')->insertGetId([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'login' => $request->login,
                'password' => Hash::make($password),
                'typeAdmin' => $request->role,
            ]);
            return redirect('adminpanel/users/'.$insert)->with(['password' => $password]);
        }elseif($request->role == 4){
            if(!isset($request->phone)){
                $request->phone=NULL;
            }
            if(!isset($request->email)){
                $request->email=NULL;
            }
            $random = str_shuffle('abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ1234567890');
                        $password = substr($random, 0, 7);  
            $insert = DB::table('users')->insertGetId([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'login' => $request->login,
                'password' => Hash::make($password),
                'typeAdmin' => $request->role,
            ]);
            return redirect('adminpanel/users/'.$insert)->with(['password' => $password]);

        }elseif($request->role == 2){
            if(!isset($request->phone)){
                $request->phone=NULL;
            }
            if(!isset($request->email)){
                $request->email=NULL;
            }
            $random = str_shuffle('abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ1234567890');
                        $password = substr($random, 0, 7);  
            $insert = DB::table('users')->insertGetId([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'login' => $request->login,
                'password' => Hash::make($password),
                'typeAdmin' => $request->role,
            ]);
            return redirect('adminpanel/users/'.$insert)->with(['password' => $password]);
        }
        return view('admin/handadd', ['request' => $request]);
    }






    public function handstudent(Request $request){
        if(!isset($request->phone)){
            $request->phone=NULL;
        }
        if(!isset($request->email)){
            $request->email=NULL;
        }
        DB::beginTransaction();
            
        try{
        if($request->class_number == NULL || $request->class_type == NULL){
            $class=NULL;
        }else{
            $class = DB::table('classes')->where([['number','=',$request->class_number],['type','=',$request->class_type]])->first();
            if(!isset($class)){
                try{
                    $class = DB::table('classes')->insertGetId([
                        'number' => $request->class_number,
                        'type' => $request->class_type,
                    ]);
                    $lessons = DB::table('lessons')->where([['start','<=',$request->class_number],['end','>=',$request->class_number]])->get();
                    foreach($lessons as $lesson){
                        $lessonteacher = DB::table('lessonteacher')->insert(['lesson_id'=>$lesson->id,'class_id'=>$class]);
                    }
                }catch(\Exception $e){
                    $class = NULL;
                }
            }else{
                $class=$class->id;
            }
        }
        $parent = DB::table('users')->where('name', '=', $request->Parenth_fio)->first();
        if(!isset($parent)){
            if($request->Parenth_login !== NULL){
                try{
                    $randomparent = str_shuffle('abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ1234567890');
                    $passwordparent = substr($randomparent, 0, 7); 
                    
                $insertparent = DB::table('users')->insertGetId([
                    'name' => $request->Parenth_fio,
                    'login' => $request->Parenth_login,
                    'password' => Hash::make($passwordparent),
                    'typeAdmin' => 4,
                ]);
                }catch(\Exception $e){
                    $insertparent = NULL;
                }
            }else{
                $insertparent = NULL;
            }
        }
        
        $random = str_shuffle('abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ1234567890');
        $password = substr($random, 0, 7);  
        $insert = DB::table('users')->insertGetId([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'login' => $request->login,
            'password' => Hash::make($password),
            'typeAdmin' => 3,
        ]);
        $insertstudent = DB::table('students')->insert([
            'fio' => $request->name,
            'user_id' => $insert,
            'parenth_id' => $insertparent,
            'class_id' => $class,
            'gender' => $request->gender,
        ]);
        }catch(\Exception $e){
            DB::rollback();
            return redirect('adminpanel/handadd')->with(['error' => "Произошла ошибка"]);
        }
        DB::commit();
        if(isset($passwordparent)){
        return redirect('adminpanel/users/'.$insert)->with(['password' => $password, 'passwordparent' => $passwordparent]);
        }else{
            return redirect('adminpanel/users/'.$insert)->with(['password' => $password]);
        }
    }
    public function users(){
        $users = DB::table('users')->orderBy('typeAdmin','asc')->orderBy('name','asc')->simplePaginate(20);
        return view('admin/pagination', ['users' => $users]);
    }






    public function userid($id){
        $users = DB::table('users')->where('id','=',$id)->first();
        if(!isset($users)){
            return abort(404);
        }
        if($users->typeAdmin==1){
            return view('admin/userrender', ['users' => $users]);
        }elseif($users->typeAdmin==2){
            $classes = DB::table('classes')->where('teacher_id','=', $id)->orderBy('number')->orderBy('type')->get();
            $teacherlessons=DB::table('lessonteacher')->where('lessonteacher.teacher_id', '=', $id)
            ->join('lessons', 'lessonteacher.lesson_id', '=', 'lessons.id' )
            ->join('classes', 'lessonteacher.class_id', '=', 'classes.id' )
            ->select('lessonteacher.id','lessons.name','classes.number','classes.type','classes.id as cid')
            ->orderBy('classes.number')
            ->orderBy('classes.type')
            ->orderBy('lessons.name')
            ->get();
            return view('admin/userrender', ['users' => $users,'classes'=>$classes,'lessonteacher'=>$teacherlessons]);
        }elseif($users->typeAdmin==3){
            $parenth = DB::table('users')->where('typeAdmin','=','4')->orderBy('name')->get();
            $student = DB::table('students')->where('user_id','=',$id)->first();
            $classes=DB::table('classes')->get();
            $pass=DB::table('pass')->where('pass.student_id', '=', $student->id)
            ->join('lessons','pass.lesson_id', '=', 'lessons.id' )
            ->orderby('pass.date')
            ->get();
            return view('admin/userrender', ['users' => $users,'parenth'=>$parenth,'classes'=>$classes,'student' => $student,'pass' => $pass]);
        }elseif($users->typeAdmin==4){
            $children = DB::table('students')->where('students.parenth_id','=',$id)->join('users','users.id','=','students.user_id')
            ->join('classes','classes.id','=','students.class_id')
            ->select('students.id','students.user_id','classes.number','classes.type','users.id as uid','users.name','classes.id as cid')
            ->orderBy('classes.number')
            ->orderBy('classes.type')
            ->get();
            return view('admin/userrender', ['users' => $users,'children' => $children]);
        }
    }
    public function classes(){
        $teachers =NULL;
        $classes = DB::table('classes')->orderBy('classes.number')->orderBy('classes.type','asc')
        ->simplePaginate(20);
        foreach($classes as $class){
            $teachers[$class->id] = DB::table('users')->where('id','=',$class->teacher_id)->first();
            
        }
        
        return view('admin/classes', ['classes' => $classes,'teachers'=>$teachers]);
    }
    public function classeid($id){
        $teachers=DB::table('users')->where('typeAdmin','=','2')->get();
        $students = DB::table('students')->where('class_id','=',$id)->join('users','students.parenth_id','=','users.id')
        ->select('students.id','students.fio','students.parenth_id','users.name','students.gender')
        ->orderBy('students.fio')->get();
        $classes = DB::table('classes')->where('id','=',$id)->first();
        if(!isset($classes)){
            return abort(404);
        }
        $lessonteachers = DB::table('lessonteacher')->where('class_id','=',$id)
        ->join('lessons','lessonteacher.lesson_id','=','lessons.id')
        ->select('lessonteacher.id','lessons.name','lessonteacher.teacher_id')
        ->orderBy('lessons.name')
        ->get();
        $lessons = DB::table('lessons')->get();
        return view('admin/renderclasses', ['classes' => $classes, 'teachers'=>$teachers,
        'students'=>$students,'lessonteachers'=>$lessonteachers,
        'lessons'=>$lessons]);
    }
    public function lessons(){
        $lessons = DB::table('lessons')->orderBy('start','asc')->orderBy('end','asc')->orderBy('name','asc')
        ->simplePaginate(20);
        return view('admin/lessons', ['lessons' => $lessons]);
    }

    public function addlesson(Request $request){
       
        return view('admin/addlessons');
    }

    public function createlesson(Request $request){
        DB::beginTransaction();
        try{
        $lesson = DB::table('lessons')->insertGetId(['name'=>$request->name,'start'=>$request->start,'end'=>$request->end]);
        $classes = DB::table('classes')->where([['number','>=',$request->start],['number','<=',$request->end]])->get();
        foreach($classes as $class){
            $insert[$class->id] = DB::table('lessonteacher')->insertGetId(['lesson_id'=>$lesson,'class_id'=>$class->id]);
        }
        
    }catch(\Exception $e){
        DB::rollback();
        return redirect()->back()->with(['errors'=>[0=> 'Пожалуйста соблюдайте правильную модель загружаеммых данных!']]);
    }
        DB::commit();
        return redirect('adminpanel/lessons');
    }

}
