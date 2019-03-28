@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Թեստի արդյունքերը</div>

                <div class="card-body ">

                    @foreach($questions as $question)
                        @php $rightAnswer = $question->answers->where('right_answer',1)->first()->id; @endphp

                        <div class="col mb-4">
                            <h5 class="mb-3">Հարց {{ $loop->iteration }}</h5>

                            <div class="col input-group">
                                <div class="col-md-10">
                                    <p class="mb-3">{{ $question->question }}</p>
                                </div>
                                <div class="col-md-2 ">
                                    <a class="btn btn-circle btn-{{($rightAnswer == $question->userAnswer->answer_id) ? 'primary' : 'danger'}}
                                        text-right" style="border-radius: 20px;">
                                        {!! ($rightAnswer == $question->userAnswer->answer_id) ? '<i class="fa fa-check"></i>' : 'X' !!}</a>
                                </div>
                            </div>


                            @foreach($question->answers as $answer)
                                <div class="col input-group mb-1">

                                        <input name="answer_id" disabled value="{{ $answer->id }}" type="checkbox"
                                                @if( ($answer->id == $question->userAnswer->answer_id)) checked @endif
                                               class="m-1" style="height: 15px;width: 15px">
                                        <p>{{$answer->answer}}</p>

                                </div>
                            @endforeach
                        </div>


                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

