<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit form') }}
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
                            <div class="container">
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
                                        <a href="{{url('/activities/edit/'.$activity->id.'#edit-activity')}}"><i
                                                class="lar la-edit btn-outline-primary sm:rounded-md"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="container">
            <div class="row">
                {{--Section element component form--}}
                <div class="col-md-3">
                    <div class="card shadow">
                        <div class="card-header alert-light">
                            <i class="las la-border-style shadow"></i> <strong>Components</strong>
                        </div>
                        <div class="card-body">
                            <ul class="component-list list-group-item">
                                <li>
                                    <button id="text-field-button" class="selector btn btn-secondary shadow">
                                        <i class="button_icon las la-align-left float-left"></i>
                                        <span>Text Field</span>
                                    </button>
                                </li>
                                <li>
                                    <button id="text-area-button" class="selector btn btn-secondary shadow"><i
                                            class="button_icon las la-align-justify float-left"></i><span>Text Area</span>
                                    </button>
                                </li>
                                <li>
                                    <button id="number-button" class="selector btn btn-secondary shadow"><i
                                            class="button_icon las la-sort-numeric-down float-left"></i><span>Number</span>
                                    </button>
                                </li>
                                <li>
                                    <button id="calender-button" class="selector btn btn-secondary shadow">
                                        <i class="button_icon las la-calendar-plus float-left"></i><span>Calender</span>
                                    </button>
                                </li>
                                <li>
                                    <button id="form-button" class="selector btn btn-secondary shadow">
                                        <i class="button_icon las la-image float-left"></i><span>Image</span>
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                {{--Section qustions form--}}
                <div class="col-md-9">
                    <div class="card shadow">
                        <div class="card-body">
                            <i class="las la-border-style shadow"></i> <strong>Form Area</strong>
                            <a href="{{url('/form/apply/'.$activity->id)}}">
                                <i class="apply-icon las la-feather-alt rounded-md btn-outline-primary float-right"
                                   title="apply"></i></a>
                        </div>
                    </div>
                    <div class="card shadow">
                        <div class="card-body">
                            <input type="hidden" id="form_id" name="form_id" value="{{$form->id}}">
                            <input type="hidden" id="form_size" name="form_size" value="{{count($questions)}}">
                            {{--<input type="hidden" id="old_questions" name="old_questions" value="{{count($questions)}}">--}}
                            <ul id="form-body" class="questions-list list-group-item">
                                @if(count($questions)>0)
                                    @foreach($questions as $question)
                                        {!! $question->body !!}
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
                        </div>
                        <div class="card-footer alert-light">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                                id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                            <i class="las la-border-style shadow"></i>&nbsp; Components
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            <li>
                                                <button id="text-field-button"
                                                        class="selector btn btn-outline-secondary col-md-12 mb-1">
                                                    <i class="button_icon las la-align-left float-left"></i>
                                                    <span>Text Field</span>
                                                </button>
                                            </li>
                                            <li>
                                                <button id="text-area-button"
                                                        class="selector btn btn-outline-secondary col-md-12 mb-1">
                                                    <i
                                                        class="button_icon las la-align-justify float-left"></i><span>Text Area</span>
                                                </button>
                                            </li>
                                            <li>
                                                <button id="number-button"
                                                        class="selector btn btn-outline-secondary col-md-12 mb-1"><i
                                                        class="button_icon las la-sort-numeric-down float-left"></i><span>Number</span>
                                                </button>
                                            </li>
                                            <li>
                                                <button id="calender-button"
                                                        class="selector btn btn-outline-secondary col-md-12 mb-1">
                                                    <i class="button_icon las la-calendar-plus float-left"></i><span>Calender</span>
                                                </button>
                                            </li>
                                            <li>
                                                <button id="form-button"
                                                        class="selector btn btn-outline-secondary col-md-12 mb-1">
                                                    <i class="button_icon las la-image float-left"></i><span>Image</span>
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <button id="save_form" class="selector shadow btn btn-primary float-right"><i
                                            class="las la-plus-square"></i> Save
                                    </button>
                                    <button id="clean_form"
                                            class="selector clear-button shadow btn btn-danger float-right">
                                        <i class="las la-eraser"></i> Clear
                                    </button>
                                </div>
                            </div>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>

        {{--include form component questions--}}
        {{--<div id="divCheckbox" style="display: none;">
            @include('form_body')
        </div>--}}
    </div>
    {{--model edit questions--}}
    <div>
        <div id="edit_question" class="modal">
            <div class="modal-dialog">
                <div class="modal-content model-style">
                    <div class="modal-header">
                        <strong class="col-sm-11"><i class="las la-edit"></i>Edit question</strong>
                        <button class="btn float-right" data-bs-dismiss="modal"><i class="las la-times"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <strong>Enter question title</strong>
                        <input id="title" class="rounded-md alert col-sm-12 alert-secondary" type="text"
                               name="title"
                               placeholder="Question title">
                        <br>
                        <p class="alert alert-warning"><i class="las la-key"></i>&nbsp;question key &nbsp; <strong
                                id="question_key">key</strong>
                        </p>
                    </div>
                    <button id="save_edit_question" class="selector btn btn-primary" data-bs-dismiss="modal">Save
                    </button>
                </div>
            </div>
        </div>
    </div>
    {{--alert--}}
    @include('modal_alert')
    {{--Js--}}
    @push('js')
        <script src="{{asset('js/form.js')}}" defer></script> {{--Must add defer to active js file--}}
    @endpush
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
