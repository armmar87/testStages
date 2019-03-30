@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Թեստ</div>

                <div class="card-body">

                    @if($stage && isset($stage->questions[$userAnswersCount]))

                            <div class="col mb-4 stage-block" id="questionBlock">

                                @include('question-block')

                            </div>

                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection



