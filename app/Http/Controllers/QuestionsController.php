<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestion;
use App\Http\Requests\StoreStage;
use App\Question;
use App\Stage;
use Illuminate\Http\Request;

class QuestionsController extends Controller
{
    public function createQuestions(StoreQuestion $request)
    {
        $stage = Stage::get()->first();
        Question::storeQuestion($stage, $request);
        return redirect()->back();
    }
}
