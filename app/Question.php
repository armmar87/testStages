<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class Question extends Model
{
    public $fillable = ['question', 'right_answer_point'];

    public $timestamps = false;

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function userAnswer()
    {
        return $this->hasOne(UserAnswer::class);
    }

    public static function storeQuestion($stage, $request) : bool
    {
        DB::beginTransaction();
        try {
            $model = new self();
            $model->fill($request->toArray());
            $model->stage_id = $stage->id;
            $model->save();
            Answer::storeAnswer($model, $request);

            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollback();
            return false;
        }
    }
}
