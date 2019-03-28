@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Թեստ</div>

                <div class="card-body">

                    @if($stages)
                        @foreach($stages->questions as $question)

                            <div class="col mb-4 stage-block" style="display: {{$loop->index == $userAnswersCount?'block':'none'}}">
                                <h3 class="mb-3">Հարց {{$loop->iteration}}</h3>
                                <h4 class="mb-4">{{ $question->question }}</h4>

                                <div>
                                    <form method="POST" action="{{ url('user-answers') }}">
                                        <input type="hidden" name="question_id" value="{{$question->id}}">

                                        <div class="form-group">
                                            <div id="answerBlock">
                                                @foreach($question->answers as $answer)

                                                    <div class="input-group mb-2">
                                                        <input name="answer_id" value="{{ $answer->id }}" type="checkbox" class="m-1" style="height: 15px;width: 15px">
                                                        <p>{{$answer->answer}}</p>
                                                    </div>

                                                @endforeach
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="text-center">
                                                <h5 style="color: #327ba7" id="secondBlock"></h5>
                                            </div>
                                            <button type="button" class="btn float-right" id="nextQuestion">Հաջորդը</button>

                                        </div>

                                    </form>
                                </div>
                            </div>

                        @endforeach
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script>
        let second = {!!  $stages->answer_time !!}
        answerTime(second);
    </script>
@endsection
