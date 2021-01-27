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
                            <h2>Ask Question</h2>
                            <div class="ml-auto">
                                <a href="{{ route('questions.index') }}" class="btn btn-outline-primary">Back to all questions</a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('questions.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="question-title">Question Title</label>
                                <input type="text" name="title" id="question-title" value="{{ old('title') }}" class="form-control">
                                @error('title')
                                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="question-body">Explain your question</label>
                                <textarea name="body" id="question-body" cols="30" rows="10" class="form-control">{{ old('body') }}</textarea>
                                @error('body')
                                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-outline-info btn-lg">Ask this question</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
