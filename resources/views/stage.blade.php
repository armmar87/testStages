@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Թեստ</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ $stage ? route('create.next.question') : route('create.stage') }}">
                        @csrf

                        <div class="form-group">
                            <h5>Գրել հարցը</h5>
                            <div class="input-group">
                                <div class="col-md-7">
                                    <label for="question">Հարց</label>
                                    <input id="question" type="text" class="form-control{{ $errors->has('question') ? ' is-invalid' : '' }}"
                                           name="question" value="{{ old('question') }}" autofocus>

                                    @if ($errors->has('question'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('question') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    <label for="right_answer_point">Ճիշտ պատասխանի բալ</label>
                                    <input id="right_answer_point" type="number" class="form-control{{ $errors->has('right_answer_point') ? ' is-invalid' : '' }}"
                                           name="right_answer_point" value="{{ old('right_answer_point') }}" autofocus>

                                    @if ($errors->has('right_answer_point'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('right_answer_point') }}</strong>
                                        </span>
                                    @endif
                                </div>

                            </div>

                            <div class="input-group">
                                <div class="col-md-3">
                                    <label for="win_point">Հաղթական բալ</label>
                                    <input id="win_point" type="number" class="form-control{{ $errors->has('win_point') ? ' is-invalid' : '' }}"
                                           name="win_point" @if($stage) value="{{ $stage->win_point }}" @endif @if($stage) disabled @endif autofocus>

                                    @if ($errors->has('win_point'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('win_point') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    <label for="question">Պատասխանելու ժամանակ</label>

                                    <input id="answer_time" type="number" class="form-control{{ $errors->has('answer_time') ? ' is-invalid' : '' }}"
                                           name="answer_time" @if($stage) value="{{ $stage->answer_time }}" @endif @if($stage) disabled @endif autofocus>

                                    @if ($errors->has('answer_time'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('answer_time') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="col-md-3">
                                    <label for="question"> </label>
                                    <select name="time_type" class="form-control" @if($stage) disabled @endif>
                                        <option value="second">Վարկյան</option>
                                        <option value="minute">Րոպե</option>
                                    </select>
                                </div>

                            </div>
                        </div>

                        <div class="form-group">
                            <h5>Գրել պատասխաններ և նշել ճիշտ պատասխանը</h5>
                            <a type="button" id="addAnswer" class="btn float-right mb-2">
                                <i class="fa fa-plus fa-1x"></i>
                            </a>
                        </div>

                        <div class="form-group">
                            <div id="answerBlock">

                                <div class="input-group mb-2">
                                    <input name="rightAnswer" value="0" type="checkbox" class="m-3" style="height: 25px;width: 25px">
                                    <textarea class="form-control" name="answers[]" rows="2"></textarea>
                                </div>
                                <div class="input-group mb-2">
                                    <input name="rightAnswer" value="1"  type="checkbox" class="m-3" style="height: 25px;width: 25px">
                                    <textarea class="form-control" name="answers[]" rows="2"></textarea>
                                </div>

                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8">
                                <button type="submit" class="btn btn-primary">Ավելացնել նոր հարց</button>
                                <button type="button" class="btn" id="saveStage" data-url="{{url('/save-stage')}}">Պահպանել</button>
                                <a type="button" class="btn" href="{{url('/delete-stage')}}">
                                    <i class="fa fa-trash-alt fa-1x"></i>
                                </a>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
