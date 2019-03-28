@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Թեստ</div>

                <div class="card-body ">

                    <h3 class="m-5" style="text-align: center">{{ $message }}</h3>

                    <div class="mb-3 col text-center">
                        <button type="button" class="btn btn-{{$win ? 'primary' : 'danger'}} mr-2" >{{ $pointSum }} միավոր</button>
                        <button type="button" class="btn btn-{{$win ? 'primary' : 'danger'}} ">
                            {!! $win ? '<i class="fa fa-check-circle fa-1x"></i>' : 'X' !!}
                        </button>
                    </div>

                    <div class="col text-right">
                        <a href="{{ url('/stage-results') }}">Նայել թեստի արդյունքները</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
