<h3 class="mb-3">Հարց {{$userAnswersCount + 1}}</h3>
<h4 class="mb-4">{{ $stage->questions[$userAnswersCount]->question }}</h4>

<div>
    <form method="POST" action="{{ url('user-answers') }}">
        <input type="hidden" name="question_id" value="{{$stage->questions[$userAnswersCount]->id}}">

        <div class="form-group">
            <div id="answerBlock">
                @foreach($stage->questions[$userAnswersCount]->answers as $answer)

                    <div class="input-group mb-2">
                        <input name="answer_id" value="{{ $answer->id }}" type="checkbox" class="m-1" style="height: 15px;width: 15px">
                        <p>{{$answer->answer}}</p>
                    </div>

                @endforeach
            </div>
        </div>

        <div class="form-group">
            <div class="text-center">
                <h5 style="color: #327ba7" id="secondBlock">{{$stage->questions[$userAnswersCount]->answer_time}}</h5>
            </div>
            <button type="button" class="btn float-right next-question" id="nextQuestion">Հաջորդը</button>

        </div>

    </form>
</div>
