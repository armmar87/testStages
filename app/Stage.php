<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Stage extends Model
{
    public $fillable = ['win_point'];

    public $timestamps = false;

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public static function storeStage($request) : bool
    {
        DB::beginTransaction();
        try {
            $model = new self();
            $model->win_point = $request->win_point;
            $model->save();
            $question = Question::storeQuestion($model, $request);
            Answer::storeAnswer($question, $request);

            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollback();
            return false;
        }
    }
}
