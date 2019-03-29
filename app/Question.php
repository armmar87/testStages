<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class Question extends Model
{
    public $fillable = ['question', 'right_answer_point', 'answer_time'];

    public $timestamps = false;

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function userAnswer()
    {
        return $this->hasOne(UserAnswer::class);
    }

    public static function storeQuestion($stage, $request)
    {
        try {
            $model = new self();
            $model->fill($request->toArray());
            $model->stage_id = $stage->id;
            if($request->time_type === 'minute')
                $model->answer_time = $model->answer_time * 60;

            $model->save();

            return $model;
        } catch (Exception $e) {
            return false;
        }
    }
}
