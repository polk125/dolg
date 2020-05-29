<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class compliteController extends Controller
{
    public function test($id){
        $pass = DB::table('pass')->where('id', '=', $id)->select( 'id','test_id','started','tire')->first();
        if($pass->tire >= 1){
            return redirect('../start/'.$pass->id);
        }
        if($pass->tire == 2){
            return redirect('../alert');
        }
        if($pass->started !== NULL){ 

            $test = DB::table('tests')->where('id', '=', $pass->test_id)->first();
            $who = DB::table('users')->where('id','=',$test->teacherid)->select('name','id')->first();
            $lesson = DB::table('lessons')->where('id','=',$test->lessonid)->select('name')->first();
            $questions = DB::table('questions')->where('testid', '=', $test->id)->get();
            foreach($questions as $question):
                $answer[$question->id] =  DB::table('answers')->where('questionid', '=', $question->id)->get(); 
            
            endforeach;
            return view('comliteTest',[
                'test' => $test,
                'who' => $who,
                'lesson' => $lesson,
                'question' => $questions,
                'answers' => $answer,
                'pass'=> $pass
            ]);
        }else{
        $test = DB::table('tests')->where('id', '=', $pass->test_id)->first();
        $who = DB::table('users')->where('id','=',$test->teacherid)->select('name','id')->first();
        $lesson = DB::table('lessons')->where('id','=',$test->lessonid)->select('name')->first();
        $questions = DB::table('questions')->where('testid', '=', $test->id)->get();
        foreach($questions as $question):
            $answer[$question->id] =  DB::table('answers')->where('questionid', '=', $question->id)->get(); 
            
        endforeach;
        return view('comliteTest',[
            'test' => $test,
            'who' => $who,
            'lesson' => $lesson,
            'question' => $questions,
            'answers' => $answer,
            'pass'=> $pass
        ]);
        }
    }
    public function start($id){
        $pass = DB::table('pass')->where('id', '=', $id)->select( 'id','test_id','tire')->first();
        if($pass->tire == 1){            
            $test = DB::table('tests')->where('id', '=', $pass->test_id)->first();
            $who = DB::table('users')->where('id','=',$test->teacherid)->select('name','id')->first();
            $lesson = DB::table('lessons')->where('id','=',$test->lessonid)->select('name')->first();
            $questions = DB::table('questions')->where('testid', '=', $test->id)->count();
            $quests = DB::table('questions')->where('testid', '=', $test->id)->get();
            $count = 0;
            $questtype = NULL;
            foreach($quests as $quest):
                $corrects[$quest->id]= DB::table('coplitedquestion')->where([['complitedpass_id', '=', $pass->id], ['question_id', '=', $quest->id]])->get();
                $answer[$quest->id] =  DB::table('answers')->where('questionid', '=', $quest->id)->get(); 
                $countanswer[$quest->id] = DB::table('coplitedquestion')->where([['complitedpass_id', '=', $pass->id],['question_id', '=', $quest->id],['correct', '=', 1]])->count(); 
                $incorectanswer[$quest->id] = DB::table('coplitedquestion')->where([['complitedpass_id', '=', $pass->id],['question_id', '=', $quest->id],['correct', '=', 0]])->count(); 
                $countans[$quest->id] =  DB::table('answers')->where([['questionid', '=', $quest->id],['correct', '=', 1]])->count(); 
                if(($countans[$quest->id] == $countanswer[$quest->id] && $countans[$quest->id] > 0)||($countans[$quest->id]==0 && $incorectanswer[$quest->id]==0)){
                    $count++;
                    $questtype[$quest->id]="correct";
                }
                
            endforeach;
            return view('starttest',[
                'test' => $test,
                'who' => $who,
                'lesson' => $lesson,
                'question' => $questions,
                'quests' => $quests,
                'pass'=> $pass,
                'count' => $count,
                'answers' => $answer,
                'corrects' => $corrects,
                'questtype' => $questtype
            ]);
        }
        $test = DB::table('tests')->where('id', '=', $pass->test_id)->first();
        $who = DB::table('users')->where('id','=',$test->teacherid)->select('name','id')->first();
        $lesson = DB::table('lessons')->where('id','=',$test->lessonid)->select('name')->first();
        $questions = DB::table('questions')->where('testid', '=', $test->id)->count();
        return view('starttest',[
            'test' => $test,
            'who' => $who,
            'lesson' => $lesson,
            'question' => $questions,
            'pass'=> $pass
        ]);
    
    }
    public function addanswer(Request $request){
        $answer = DB::table('answers')->where('id', '=', $request->data['id'])->first();
        $pass = DB::table('pass')->where('id', '=', $request->data['pass'])->first();
        $question = DB::table('questions')->where('id', '=', $answer->questionid)->first();
        $add = DB::table('coplitedquestion')->insert(
            ['complitedpass_id' => $request->data['pass'],
            'question_id' => $question->id,
            'answer_id' => $request->data['id'],
            'student_id' => $pass->student_id,
            'correct' => $answer->correct
            ]
        );
    }
    public function deleteanswer(Request $request){
        $delete = DB::table('coplitedquestion')->where([
            ['complitedpass_id' => $request->data['pass']],
            ['answer_id', '=', $request->data['id']]
        ])->delete();
    }
    public function endtest(Request $request){
        $delete = DB::table('pass')->where([
            ['id', '=', $request->data['id']]
        ])->update(['tire' => 1]);
    }
    
    public function starttest(Request $request){
        $delete = DB::table('pass')->where([
            ['id', '=', $request->data['id']]
        ])->update(['started' => $request->data['time']]);
    }
}
