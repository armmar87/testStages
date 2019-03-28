<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    public $fillable = ['question_id', 'answer', 'right_answer'];

    public $timestamps = false;

    public static function storeAnswer($question, $request) : bool
    {
        try {
            foreach ($request->answers as $key => $answer) {
                $model = new self();
                $model->question_id = $question->id;
                $model->answer = $answer;
                if($key == $request->rightAnswer)
                    $model->right_answer = 1;

                $model->save();
            }
            return true;
        } catch (Exception $e) {
            DB::rollback();
            return false;
        }
         }

}
