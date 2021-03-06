<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Http\Requests\StoreStage;
use App\Question;
use App\Stage;
use App\UserAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class StageController extends Controller
{
    public function index()
    {
        $stage = Stage::with('questions')->first();
        $userAnswersCount = UserAnswer::count();

        return view('home', compact('stage', 'userAnswersCount'));
    }

    public function adminIndex()
    {
        $stage = Stage::first();
        return view('stage', compact('stage'));
    }

    public function createStage(StoreStage $request)
    {
        Stage::storeStage($request);
        return redirect()->back();
    }

    public function deleteStage()
    {
        $stage = Stage::first();
        $stage->delete();
        return redirect()->back();
    }

    public function saveStage(Request $request)
    {
        DB::beginTransaction();
        try {
            $stage = Stage::get()->first();
            $question = Question::storeQuestion($stage, $request);
            Answer::storeAnswer($question, $request);

            DB::commit();
            return response()->json(['status'=>'success'],200);

        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['status'=>'error'],200);

        }


    }

    public function userAnswers(Request $request)
    {
        $stage = Stage::with('questions')->first();
        UserAnswer::storeUserAnswer($request, $stage);
        $questionCount = $stage->questions()->count();
        $userAnswersCount = UserAnswer::count();

        $endStage = true;
        $content = '';
        if( $questionCount - $userAnswersCount ){
            $endStage = false;
            $content = view('question-block', compact('stage','userAnswersCount'))->render();
        }

        return response()->json(['status' => 'success', 'endStage' => $endStage,'content'=>$content],200);
    }

    public function endStage()
    {
        $userAnswers = UserAnswer::with(['question','stage'])->get();

        $message = 'Ձեր միավորները բավարար չեն թեստն անցնելքու համար';
        $win = false;
        $pointSum = 0;
        foreach ($userAnswers as $userAnswer){
            foreach ($userAnswer->question->answers as $answer){
                if( ($answer->id == $userAnswer->answer_id) && $answer->right_answer ){
                    $pointSum = $pointSum + $userAnswer->question->right_answer_point;
                }
            }
        }
        if( $pointSum >= $userAnswers->first()->stage->win_point){
            $message = 'Դուք հաջեղությամբ անցաք թեստը';
            $win = true;
        }

        return view('end-stage', compact('pointSum', 'message', 'win'));
    }

    public function stageResults()
    {
        $questions = Question::with(['answers','userAnswer'])->get();

        return view('stage-results', compact('questions'));
    }

}
