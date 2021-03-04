@extends('layouts.app')

@section('content')
    <style>
        .counters{
            margin-right: 30px;
            font-size: 10px;
            text-align: center;
        }

        .counters strong {
            display: block;
            font-size: 2em;
        }

        .vote, .answer {
            width: 60px;
            height: 60px;
        }

    </style>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <div class="d-flex align-items-center">
                                <h1>{{ $question->title }}</h1>
                                <div class="ml-auto">
                                    <a href="{{ route('questions.index') }}" class="btn btn-outline-primary">Back to all questions</a>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="media">
                            <div class="d-flex flex-column vote-controls">
                                <a href="javascript:void(0);" title="This is question is useful" class="vote-up">
                                    <i class="fa fa-caret-up"></i>
                                </a>
                                <span class="votes-count">123</span>
                                <a href="javascript:void(0);" title="This question is not useful" class="vote-down off">
                                    Vote Down
                                </a>
                                <a href="javascript:void(0);" title="Click to mark as favorite question (Click again to undo)" class="favorite">
                                    Favorite
                                </a>
                                <span class="favorites-count">123</span>
                            </div>
                            <div class="media-body">
                                {!! $question->body_html !!}
                                <div class="float-right">
                                    <span class="text-muted">Answered {{ $question->created_date }}</span>
                                    <div class="media mt-2">
                                        <a href="{{ $question->user->url }}" class="pr-2">
                                            <img src="{{ $question->user->avatar }}" alt="">
                                        </a>
                                        <div class="media-body mt-1">
                                            <a href="{{ $question->user->url }}">{{ $question->user->name }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h2>{{$question->answers_count . " " . \Illuminate\Support\Str::plural('Answer', $question->answers_count)}}</h2>
                        </div>
                        <hr>
                        @foreach ($question->answers as $answer)
                        <div class="media">
                            <div class="media-body">
                                {!! $answer->body_html !!}
                                <div class="float-right">
                                    <span class="text-muted">Answered {{ $answer->created_date }}</span>
                                    <div class="media mt-2">
                                        <a href="{{ $answer->user->url }}" class="pr-2">
                                            <img src="{{ $answer->user->avatar }}" alt="">
                                        </a>
                                        <div class="media-body mt-1">
                                            <a href="{{ $answer->user->url }}">{{ $answer->user->name }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="question-show-hr">
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
