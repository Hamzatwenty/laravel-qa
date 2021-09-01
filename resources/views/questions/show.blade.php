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
        {{--Question part--}}
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
                            {{--Vote Control System--}}
                            <div class="d-flex flex-column vote-controls">
                                <a href="javascript:void(0);" title="This question is useful" class="vote-up">
                                    <i class="fas fa-caret-up fa-3x"></i>
                                </a>
                                <span class="votes-count">123</span>
                                <a href="javascript:void(0);" title="This question is not useful" class="vote-down off">
                                    <i class="fas fa-caret-down fa-3x"></i>
                                </a>
                                <a href="javascript:void(0);"
                                   title="Click to mark as favorite question (Click again to undo)"
                                   class="favorite mt-2 {{ \Illuminate\Support\Facades\Auth::guest() ? 'off' : ($question->is_favorited) ? 'favorited' : '' }}"
                                onclick="event.preventDefault(); document.getElementById('favorite-question-{{$question->id}}').submit();">
                                    <i class="fas fa-star fa-2x"></i>
                                </a>
                                <span class="favorites-count">{{ $question->favorites_count }}</span>
                                <form style="display: none;" action="{{url('/questions/'.$question->id.'/favorites')}}" method="post" id="favorite-question-{{ $question->id }}">
                                    @csrf
                                    @if($question->is_favorited)
                                        @method('DELETE')
                                    @endif
                                </form>
                            </div>
                            {{--End Vote Control System--}}
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
        {{--Answers part of that question--}}
        @include('answers._index',[
            'answers' => $question->answers,
            'answersCount' => $question->answers_count,
        ])

        @include('answers._create')
    </div>
@endsection
