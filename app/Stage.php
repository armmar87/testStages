<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Stage extends Model
{
    public $fillable = ['win_point', 'answer_time'];

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
            $model->fill($request->toArray());
            if($request->time_type === 'minute')
                $model->answer_time = $model->answer_time * 60;

            $model->save();
            Question::storeQuestion($model, $request);

            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollback();
            return false;
        }
    }
}
