<?php


Route::get('/', 'StageController@index');
Route::get('/end-stage', 'StageController@endStage');
Route::get('/stage-results', 'StageController@stageResults');
Route::get('/delete-stage', 'StageController@deleteStage');
Route::get('/admin', 'StageController@adminIndex');
Route::post('create-stage', 'StageController@createStage')->name('create.stage');
Route::post('user-answers', 'StageController@userAnswers');

Route::post('create-next-question', 'QuestionsController@createQuestions')->name('create.next.question');


