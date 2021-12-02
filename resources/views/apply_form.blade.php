<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Apply form') }}
        </h2>
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
                                <div class="col-10 row-2">
                                    <h5 class="name">{{$activity->name}}</h5>
                                    @switch($activity->type)
                                        @case(0)
                                        <p class="activity-type shadow">&nbsp;Form&nbsp;</p>
                                        @break
                                        @case (1)
                                        <p class="activity-type shadow">activity2</p>
                                        @break
                                        @case (2)
                                        <p class="activity-type shadow">&nbsp; activity2 &nbsp;</p>
                                        @break
                                    @endswitch
                                    @switch($activity->staus)
                                        @case (0)
                                        <p class="paragraph-pended shadow">Pended</p>
                                        @break
                                        @case(1)
                                        <p class="paragraph-active shadow">&nbsp;Active&nbsp;</p>
                                        @break
                                    @endswitch
                                </div>
                                <div class="col-1 row-3-2">
                                    <a href="{{url('/form/edit/'.$activity->id)}}"><i
                                            class="lab la-wpforms btn-outline-info sm:rounded-md"></i></a>
                                    <a href="{{url('/activities/edit/'.$activity->id.'#edit-activity')}}"><i
                                            class="lar la-edit btn-outline-primary sm:rounded-md"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <br>
                    <div class="card shadow">
                        <div class="card-body alert-secondary">
                            <strong>Submission title</strong>
                            <input data-question-id="{{$form->id}}" class="rounded-md col-md-12 alert alert-light"
                                   type="text" placeholder="Submission Title">
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
                                                <input data-question-id="{{$question->id}}" class="rounded-md col-md-12 alert alert-secondary"
                                                       type="text" placeholder="{{$question->title}}">
                                            </li>
                                            @break
                                            @case(1)
                                            <li>
                                                <strong>&nbsp; {{$question->title}}</strong>
                                                <textarea data-question-id="{{$question->id}}" rows="4" class="rounded-md col-md-12 alert alert-secondary"
                                                          type="text" placeholder="{{$question->title}}"></textarea>
                                            </li>
                                            @break
                                            @case(2)
                                            <li>
                                                <strong>&nbsp; {{$question->title}}</strong>
                                                <input data-question-id="{{$question->id}}" class="rounded-md col-md-12 alert alert-secondary"
                                                       type="number" placeholder="{{$question->title}}">
                                            </li>
                                            @break
                                            @case(3)
                                            <li>
                                                <strong>&nbsp; {{$question->title}}</strong>
                                                <input data-question-id="{{$question->id}}" class="rounded-md col-md-12 alert alert-secondary"
                                                       type="date" placeholder="{{$question->title}}">
                                            </li>
                                            @break
                                            @case(4)
                                            <li>
                                                <strong>&nbsp; {{$question->title}}</strong>
                                                <input data-question-id="{{$question->id}}" class="rounded-md col-md-12 alert alert-secondary"
                                                       type="image" placeholder="{{$question->title}}">
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
                                            <p>Drag Components here!</p>
                                        </div>
                                        <br>
                                        <br>
                                    </li>
                                @endif
                            </ul>
                            <button id="save_form" class="selector shadow btn btn-primary float-right"><i
                                    class="las la-save"></i> Submit
                            </button>
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
