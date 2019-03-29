<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Http\Requests\StoreQuestion;
use App\Http\Requests\StoreStage;
use App\Question;
use App\Stage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestionsController extends Controller
{
    public function createQuestions(StoreQuestion $request)
    {
        DB::beginTransaction();
        try {
            $stage = Stage::first();
            $question = Question::storeQuestion($stage, $request);
            Answer::storeAnswer($question, $request);

            DB::commit();
            return redirect()->back();

        } catch (Exception $e) {
            DB::rollback();
            return false;
        }

    }
}
