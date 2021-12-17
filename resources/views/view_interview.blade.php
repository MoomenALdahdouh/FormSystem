<x-app-layout>
    <x-slot name="header">
        <br>
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('strings.view_interview') }}
        </h1>
    </x-slot>
    <br>
    <div class="header-section">
        <div class="container">
            <div class="row">
                {{--Activity and form details--}}
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-1">
                                    <img class="activity-image" width="60" src="{{asset('images/list.png')}}">
                                </div>
                                <div class="col-11 row-2">
                                    <h5 class="name">{{$interview->title}}</h5>
                                    <p><i class="fas fa-map-marker-alt "></i><strong
                                            class="">&nbsp; {{$interview->customer_location}}</strong></p>
                                    <p class=""><i class="far fa-clock"></i>&nbsp;{{$interview->created_at}}</p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <br>
                    <div class="card shadow">
                        <div class="card-body alert-secondary">
                            <strong>{{ __('strings.answers') }}</strong>
                            {{-- <input data-question-id="{{$form->id}}" class="rounded-md col-md-12 alert alert-light"
                                    type="text" placeholder="{{ __('strings.submission_title') }}">--}}
                        </div>
                    </div>
                    <div class="card shadow">
                        {{--<div class="card-header">Form body</div>--}}
                        <div class="card-body">
                            <input type="hidden" id="form_id" name="form_id" value="{{$form->id}}">
                            <input type="hidden" id="form_size" name="form_size" value="{{count($questions)}}">
                            {{--<input type="hidden" id="old_questions" name="old_questions" value="{{count($questions)}}">--}}
                            <ul id="form-body" class="questions-list list-group-item">
                                @if(count($questions)>0)
                                    @foreach($questions as $question)
                                        @switch($question->type)
                                            @case(0)
                                            <li>
                                                <strong>&nbsp; {{$question->title}}</strong>
                                                <input data-question-id="{{$question->id}}"
                                                       class="rounded-md col-md-12 alert alert-secondary"
                                                       type="text" placeholder="{{$question->title}}"
                                                       value="@foreach($answers as $answer)@if($answer->questions_fk_id == $question->id){{$answer->answer}}@endif @endforeach">
                                            </li>
                                            @break
                                            @case(1)
                                            <li>
                                                <strong>&nbsp; {{$question->title}}</strong>
                                                <textarea data-question-id="{{$question->id}}" rows="4"
                                                          class="rounded-md col-md-12 alert alert-secondary"
                                                          type="text"
                                                          placeholder="{{$question->title}}">@foreach($answers as $answer)@if($answer->questions_fk_id == $question->id){{$answer->answer}}@endif @endforeach</textarea>
                                            </li>
                                            @break
                                            @case(2)
                                            <li>
                                                <strong>&nbsp; {{$question->title}}</strong>
                                                <input data-question-id="{{$question->id}}"
                                                       class="rounded-md col-md-12 alert alert-secondary"
                                                       type="number" placeholder="{{$question->title}}"
                                                       value="@foreach($answers as $answer)@if($answer->questions_fk_id == $question->id){{$answer->answer}}@endif @endforeach">
                                            </li>
                                            @break
                                            @case(3)
                                            <li>
                                                <strong>&nbsp; {{$question->title}}</strong>
                                                <input data-question-id="{{$question->id}}"
                                                       class="rounded-md col-md-12 alert alert-secondary"
                                                       type="date" placeholder="{{$question->title}}"
                                                       value="@foreach($answers as $answer)@if($answer->questions_fk_id == $question->id){{$answer->answer}}@endif @endforeach">
                                            </li>
                                            @break
                                            @case(4)
                                            <li>
                                                <strong>&nbsp; {{$question->title}}</strong>
                                                <img height="100" width="100" src="@foreach($answers as $answer)@if($answer->questions_fk_id == $question->id){{'http://127.0.0.1:8000/storage/answer_images/'.$answer->answer}}@endif @endforeach">
                                            </li>
                                            @break
                                        @endswitch

                                        {{--{!! $question->body !!}--}}
                                    @endforeach
                                @else
                                    <li class="btn btn-light text-center">
                                        <br>
                                        <br>
                                        <div>
                                            <i class="las la-boxes" style="font-size: 50px"></i>
                                            <p>{{ __('strings.no_questions') }}</p>
                                        </div>
                                        <br>
                                        <br>
                                    </li>
                                @endif
                            </ul>
                            {{--<button id="save_form" class="selector shadow btn btn-primary float-right"><i
                                    class="las la-save"></i> {{ __('strings.submit') }}
                            </button>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
</x-app-layout>
