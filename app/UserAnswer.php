<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAnswer extends Model
{
    public $fillable = ['stage_id', 'question_id', 'answer_id'];

    public $timestamps = false;

    public $table = 'user_answers';

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function stage()
    {
        return $this->belongsTo(Stage::class);
    }

    public static function storeUserAnswer($request, $stage) : bool
    {
        $model = new self();
        $model->fill($request->toArray());
        $model->stage_id = $stage->id;
        $model->save();

        return true;
    }
}
