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
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h1>{{ $question->title }}</h1>
                            <div class="ml-auto">
                                <a href="{{ route('questions.index') }}" class="btn btn-outline-primary">Back to all questions</a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        {!! $question->body_html !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection