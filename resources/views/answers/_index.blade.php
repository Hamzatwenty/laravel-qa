<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h2>{{ $answersCount . " " . \Illuminate\Support\Str::plural('Answer', $answersCount)}}</h2>
                </div>
                <hr>

                @include('layouts._messages')

                @foreach ($answers as $answer)
                    <div class="media">
                        {{--Vote Control System--}}
                        <div class="d-flex flex-column vote-controls">
                            <a href="javascript:void(0);" title="This answer is useful" class="vote-up {{ \Illuminate\Support\Facades\Auth::guest() ? 'off' : '' }}"
                               onclick="event.preventDefault(); document.getElementById('up-vote-answer-{{$answer->id}}').submit();"
                            >
                                <i class="fas fa-caret-up fa-3x"></i>
                            </a>
                            <form style="display: none;" action="{{url('/answer/'.$answer->id.'/vote')}}" method="post" id="up-vote-answer-{{ $answer->id }}">
                                @csrf
                                <input type="hidden" name="vote" value="1">
                            </form>
                            <span class="votes-count">{{$answer->votes_count}}</span>
                            <a href="javascript:void(0);" title="This answer is not useful" class="vote-down {{ \Illuminate\Support\Facades\Auth::guest() ? 'off' : '' }}"
                               onclick="event.preventDefault(); document.getElementById('down-vote-answer-{{$answer->id}}').submit();"
                            >
                                <i class="fas fa-caret-down fa-3x"></i>
                            </a>
                            <form style="display: none;" action="{{url('/answer/'.$answer->id.'/vote')}}" method="post" id="down-vote-answer-{{ $answer->id }}">
                                @csrf
                                <input type="hidden" name="vote" value="-1">
                            </form>
                            @can('accept',$answer)
                            <a href="javascript:void(0);" title="Mark this answer as best answer"
                                class="{{ $answer->status }} mt-2x"
                                onclick="event.preventDefault(); document.getElementById('accept-answer-{{$answer->id}}').submit();"
                            >
                                <i class="fas fa-check fa-2x"></i>
                            </a>
                            <form style="display: none;" action="{{route('answers.accept',$answer->id)}}" method="post" id="accept-answer-{{ $answer->id }}">
                                @csrf
                            </form>
                            @else
                                @if($answer->is_best)
                                    <a href="javascript:void(0);" title="The question owner accepted this answer as best answer"
                                       class="{{ $answer->status }} mt-2x"
                                    >
                                        <i class="fas fa-check fa-2x"></i>
                                    </a>
                                    @endif
                            @endcan
                        </div>
                        {{--End Vote Control System--}}

                        <div class="media-body">
                            {!! $answer->body_html !!}
                            <div class="row">
                                <div class="col-4">
                                    <div class="ml-auto">
                                        @can('update', $answer)
                                            <a href="{{route('questions.answers.edit',[$question->id, $answer->id])}}" class="btn btn-sm btn-outline-info">Edit</a>
                                        @endcan
                                        @can('delete', $answer)
                                            <form class="form-delete" action="{{ route('questions.answers.destroy', [$question->id, $answer->id]) }}" method="post">
                                                {{ method_field('DELETE') }}
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        @endcan
                                    </div>
                                </div>
                                <div class="col-4">
                                </div>
                                <div class="col-4">
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
                    </div>
                    <hr class="question-show-hr">
                @endforeach
            </div>
        </div>
    </div>
</div>
