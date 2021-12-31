<x-app-layout>
    <x-slot name="header_2">
        <br>
        <div class="row">
            <div class="col-md-11">
                <h1 class="pt-1 home-section font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('strings.edit_form') }}
                </h1>
            </div>
            {{--Select language--}}
            <div class="col-md-1">
                <div class="dropdown">
                    <button class="btn btn-light dropdown-toggle" type="button"
                            id="dropdownMenuButton1" data-bs-toggle="dropdown"
                            aria-expanded="false">
                        <i class="fas fa-globe"></i>&nbsp; {{ Config::get('language')[App::getLocale()] }}
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        @foreach (Config::get('language') as $lang => $language)
                            @if ($lang != App::getLocale())
                                <li>
                                    <a class="dropdown-item"
                                       href="{{ route('lang.switch', $lang) }}"> {{$language}}</a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </x-slot>
    <br>
    <br>
    <div class="header-section">
        <div class="container">
            <div class="row">
                {{--Activity and form details--}}
                <div class="col-md-3">
                    <div class="card shadow" style="height: 130px">
                        <div class="card-body">
                            <div class="container">
                                {{--If type is activity form--}}
                                @if($form->type == 0)
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <i class='bx bxs-data fs-1'></i>
                                        </div>
                                        <div class="col-sm-9 row-2">
                                            <h5 class="name">{{$activity->name}} <a
                                                        href="{{url('/activities/edit/'.$activity->id.'#edit-activity')}}"><i
                                                            class="lar la-edit btn-outline-primary rounded-2 p-1"></i></a>
                                            </h5>
                                            @switch($activity->type)
                                                @case(0)
                                                <p class="hint activity-type shadow">&nbsp;{{ __('strings.form') }}
                                                    &nbsp;</p>
                                                @break
                                                @case (1)
                                                <p class="hint activity-type shadow">activity2</p>
                                                @break
                                                @case (2)
                                                <p class="hint activity-type shadow">&nbsp; activity2 &nbsp;</p>
                                                @break
                                            @endswitch
                                            @switch($activity->staus)
                                                @case (0)
                                                <p class="hint paragraph-pended shadow">&nbsp;{{ __('strings.pended') }}
                                                    &nbsp;</p>
                                                @break
                                                @case(1)
                                                <p class="hint paragraph-active shadow">&nbsp;{{ __('strings.active') }}
                                                    &nbsp;</p>
                                                @break
                                            @endswitch
                                        </div>
                                    </div>
                                @else
                                    <div class="row">
                                        <div class="col-3">
                                            <i class='bx bxs-data fs-1'></i>
                                        </div>
                                        <div class="col-8">
                                            <h5 class="name">{{$form->name}}</h5>
                                            @switch($form->status)
                                                @case (0)
                                                <p class="paragraph-pended shadow">{{ __('strings.pended') }}</p>
                                                @break
                                                @case(1)
                                                <p class="paragraph-active shadow">&nbsp;{{ __('strings.active') }}
                                                    &nbsp;</p>
                                                @break
                                            @endswitch
                                        </div>
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-9" id="worker_section">
                    <div class="card shadow" style="height: 130px">
                        <div class="p-3">
                            <div class="row">
                                <div class="col-md-9">
                                    <img class="mb-1" height="25" width="25" src="{{asset('images/user.png')}}">
                                    <p class=pt-2">{{ __('strings.manage_by_workers') }}</p>
                                </div>
                                <div class="col-md-3">
                                    <select name="worker" id="worker"
                                            class="btn-outline-primary manager-dropdown form-control input-group-lg "
                                            value="0">
                                        <option hidden>{{__('strings.add_worker')}}</option>
                                        @php
                                            $countWorker = 0;
                                        @endphp
                                        @if($workers == '[]')
                                            <option class="alert-warning"
                                                    value=""> {{ __('strings.empty_workers') }}
                                            </option>
                                        @else
                                            @foreach ($workers as $worker)
                                                @php
                                                    $countWorker =+ 1;
                                                @endphp
                                                <option class="alert-dark"
                                                        value="{{ $worker->id }}">
                                                    {{ $worker->name }}
                                                </option>
                                            @endforeach
                                            @if($countWorker==0)
                                                <option class="alert-warning"
                                                        value=""> {{ __('strings.empty_workers') }}
                                                </option>
                                            @endif
                                        @endif
                                    </select>
                                    {{csrf_field()}}
                                </div>
                            </div>
                            @foreach($form->workers as $worker)
                                @php
                                    $worker_user = App\Models\User::query()->find($worker->worker_fk_id	);
                                @endphp
                                <div id="{{$worker->id}}"
                                     class="alert-secondary d-inline rounded-2 mt-1 mr-2 p-1">{{-- style="display:contents; background-color: #b2b2b2"--}}
                                    <span>{{$worker_user->name}}</span>
                                    <a href="{{url('/users/view/'.$worker_user->id)}}">
                                        <i class="las la-external-link-square-alt btn-outline-primary rounded-2 p-1"></i></a>
                                    <i id="remove_worker" data-id="{{$worker->id}}"
                                       class="las la-trash btn-outline-danger rounded-2 p-1"></i>
                                </div>
                            @endforeach
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
                            <i class="las la-border-style shadow"></i> <strong>{{ __('strings.components') }}</strong>
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
                                                class="button_icon las la-align-justify float-left"></i><span>{{ __('strings.text_area') }}</span>
                                    </button>
                                </li>
                                <li>
                                    <button id="number-button" class="selector btn btn-secondary shadow"><i
                                                class="button_icon las la-sort-numeric-down float-left"></i><span>{{ __('strings.number') }}</span>
                                    </button>
                                </li>
                                <li>
                                    <button id="calender-button" class="selector btn btn-secondary shadow">
                                        <i class="button_icon las la-calendar-plus float-left"></i><span>{{ __('strings.calender') }}</span>
                                    </button>
                                </li>
                                <li>
                                    <button id="form-button" class="selector btn btn-secondary shadow">
                                        <i class="button_icon las la-image float-left"></i><span>{{ __('strings.image') }}</span>
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
                            <i class="las la-border-style shadow"></i> <strong>{{ __('strings.form_area') }}</strong>
                            @if($form->type == 0)
                                <a href="{{url('/form/apply/'.$activity->id)}}">
                                    <i class="apply-icon las la-feather-alt rounded-md btn-outline-primary float-right"
                                       title="apply"></i>
                                </a>
                            @else
                                <a href="{{url('/form/apply/'.$form->id)}}">
                                    <i class="apply-icon las la-feather-alt rounded-md btn-outline-primary float-right"
                                       title="apply"></i>
                                </a>
                            @endif
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
                                            <p>{{ __('strings.drag_components') }}</p>
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
                                            <i class="las la-border-style shadow"></i>&nbsp; {{ __('strings.components') }}
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            <li>
                                                <button id="text-field-button"
                                                        class="selector btn btn-outline-secondary col-md-12 mb-1">
                                                    <i class="button_icon las la-align-left float-left"></i>
                                                    <span>{{ __('strings.text_field') }}</span>
                                                </button>
                                            </li>
                                            <li>
                                                <button id="text-area-button"
                                                        class="selector btn btn-outline-secondary col-md-12 mb-1">
                                                    <i
                                                            class="button_icon las la-align-justify float-left"></i><span>{{ __('strings.text_area') }}</span>
                                                </button>
                                            </li>
                                            <li>
                                                <button id="number-button"
                                                        class="selector btn btn-outline-secondary col-md-12 mb-1"><i
                                                            class="button_icon las la-sort-numeric-down float-left"></i><span>{{ __('strings.number') }}</span>
                                                </button>
                                            </li>
                                            <li>
                                                <button id="calender-button"
                                                        class="selector btn btn-outline-secondary col-md-12 mb-1">
                                                    <i class="button_icon las la-calendar-plus float-left"></i><span>{{ __('strings.calender') }}</span>
                                                </button>
                                            </li>
                                            <li>
                                                <button id="form-button"
                                                        class="selector btn btn-outline-secondary col-md-12 mb-1">
                                                    <i class="button_icon las la-image float-left"></i><span>{{ __('strings.image') }}</span>
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <button id="save_form" class="selector shadow btn btn-primary float-right"><i
                                                class="las la-plus-square"></i> {{ __('strings.save') }}
                                    </button>
                                    <button id="clean_form"
                                            class="selector clear-button shadow btn btn-danger float-right">
                                        <i class="las la-eraser"></i> {{ __('strings.clear') }}
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
                        <strong class="col-sm-11"><i class="las la-edit"></i>{{ __('strings.edit_question') }}</strong>
                        <button class="btn float-right" data-bs-dismiss="modal"><i class="las la-times"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <strong>{{ __('strings.enter_question_title') }}</strong>
                        <input id="title" class="rounded-md alert col-sm-12 alert-secondary" type="text"
                               name="title"
                               placeholder="{{ __('strings.question_title') }}">
                        <br>
                        <p class="alert alert-warning"><i class="las la-key"></i>&nbsp;{{ __('strings.question_key') }}
                            &nbsp; <strong
                                    id="question_key">{{ __('strings.key') }}</strong>
                        </p>
                    </div>
                    <button id="save_edit_question" class="selector btn btn-primary"
                            data-bs-dismiss="modal">{{ __('strings.save') }}
                    </button>
                    {{csrf_field()}}
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
