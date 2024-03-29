<x-app-layout>
    <script type="text/javascript" src="{{asset('js/jquery-3.6.0.min.js')}}"></script>
    <x-slot name="header_2">
        <br>
        <h1 class="title-header font-semibold text-xl text-gray-800 leading-tight">
            {{ __('strings.view_activity') }}
            {{--<button class="btn btn-danger" style="float: right">{{ __('Create Project') }}</button>--}}
        </h1>
    </x-slot>
    <br>
    <br>
    <div class="header-section">
        <div class="container">
            {{--Alert actions--}}
            @if(session('successUpdate'))
                <div class="alert alert-success d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                        <use xlink:href="#check-circle-fill"/>
                    </svg>
                    <strong>{{session('successUpdate')}}</strong>
                </div>
            @endif
            <button id="sdf" type="button"></button>
            {{--activity details--}}
            <div class="row">
                <div class="col-md-9">
                    {{--activity details header--}}
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-1">
                                        <img class="activity-image" width="70" src="{{asset('images/list.png')}}">
                                    </div>
                                    <div class="col-10 row-2">
                                        <h5 class="name">{{$activity->name}}</h5>
                                        @switch($activity->type)
                                            @case(0)
                                            <p class="activity-type shadow">&nbsp;{{ __('strings.form') }}&nbsp;</p>
                                            @break
                                            @case (1)
                                            <p class="activity-type shadow">activity2</p>
                                            @break
                                        @endswitch
                                        @switch($activity->staus)
                                            @case (0)
                                            <p class="paragraph-pended shadow">{{ __('strings.pended') }}</p>
                                            @break
                                            @case(1)
                                            <p class="paragraph-active shadow">&nbsp;{{ __('strings.active') }}
                                                &nbsp;</p>
                                            @break
                                        @endswitch
                                    </div>
                                    <div class="col-1 row-3">
                                        <a href="{{url('/activities/edit/'.$activity->id.'#edit-activity')}}"><i
                                                    class="lar la-edit btn-outline-primary rounded-2 p-1"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--activity details body--}}
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="container">
                                <ul class="ul-project">
                                    <br>
                                    <li class="alert alert-secondary">
                                        <div>
                                            <strong><i
                                                        class="las la-audio-description text-primary"></i>{{ __('strings.name') }}
                                            </strong>
                                            <br>
                                            @if ($activity->name === '' || $activity->name === NULL)
                                                <p>&nbsp; &nbsp; {{ __('strings.no_name') }}</p>
                                            @else
                                                <p>&nbsp &nbsp {{$activity->name}}</p>
                                            @endif
                                        </div>
                                        <div class="">
                                            <strong><i
                                                        class="las la-audio-description text-primary"></i>{{ __('strings.description') }}
                                            </strong>
                                            <br>
                                            <p> &nbsp; &nbsp; {{$activity->description}}</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="alert alert-secondary">
                                            <strong><i
                                                        class="las la-audio-description text-primary"></i>{{ __('strings.type') }}
                                            </strong>
                                            <br>
                                            <p class="">&nbsp; &nbsp; {{ __('strings.form') }}&nbsp;</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="alert alert-secondary">
                                            <div class="">
                                                <strong><i
                                                            class="las la-calendar-check text-primary"></i>{{ __('strings.created_at') }}
                                                </strong>
                                                <br>
                                                <p>&nbsp &nbsp {{$activity->created_at}}</p>
                                            </div>
                                            <div class="">
                                                <strong><i
                                                            class="las la-clock text-primary"></i></i>&nbsp;{{ __('strings.update_at') }}
                                                </strong>
                                                <br>
                                                <p>&nbsp; &nbsp; {{$activity->updated_at}}</p>
                                            </div>
                                        </div>

                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <br>
                    {{--Section View Form Questions --}}
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card shadow">
                                <div class="row alert alert-success text-dark"
                                     style=" margin: 0; padding-left:0; padding-right: 0">
                                    <div class="col-md-10">
                                        <strong><i
                                                    class="lab la-wpforms"></i>&nbsp; {{ __('strings.view_form_questions') }}
                                        </strong>
                                    </div>
                                    <div class="col-md-2">
                                        <a href="{{url("/form/apply/$activity->id")}}"
                                           class="btn btn-success float-right">{{ __('strings.view') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                </div>
                {{--Subproject and Manager details--}}
                <div class="col-md-3">
                    <div class="card shadow">
                        <div class="card-header">
                            <br>
                            <div class="row">
                                <div class="col-sm-1">
                                    <i class='bx bx-file' style="font-size: 30px; line-height: 60px"></i>
                                </div>
                                <div class="col-sm-11">
                                    <p class="hint">&nbsp;{{ __('strings.subproject') }}</p>
                                    <p class="float-right">
                                        @if($activity->subproject->status == 1)
                                            <strong class=" paragraph-active shadow">{{ __('strings.active') }}</strong>
                                        @else
                                            <strong class=" paragraph-pended shadow">{{ __('strings.pended') }}</strong>
                                        @endif
                                    </p>
                                    <p>&nbsp;<strong>{{$activity->subproject->name}}</strong>
                                        <a href="{{url('/subprojects/view/'.$activity->subproject->id)}}"><i
                                                    class="las la-external-link-square-alt btn-outline-primary rounded-2 p-1"></i></a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--<div class="card shadow">
                        <br>
                        <div class="p-3">
                            <img class="" height="30" width="30" src="{{asset('images/user.png')}}">
                            <p class="hint mb-2 mt-2">{{ __('strings.manage_by_workers') }}</p>
                            @foreach($workers as $worker)
                                @php
                                    $worker_user = App\Models\User::query()->find($worker->worker_fk_id	);

                                @endphp

                                <div class="alert-secondary mb-2 p-2">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <span>{{$worker_user->name}}</span>
                                            <a href="{{url('/users/view/'.$worker->id)}}">
                                                <i class="las la-external-link-square-alt btn-outline-primary rounded-2 p-1"></i>
                                            </a>
                                            <br>
                                            @if($worker_user->status == 1)
                                                <span class=" paragraph-active shadow">{{ __('strings.active') }}</span>
                                            @else
                                                <span class=" paragraph-pended shadow">{{ __('strings.pended') }}</span>
                                            @endif
                                        </div>
                                        <div class="col-md-2">
                                            <i id="remove_worker" data-id="{{$worker->id}}" class="las la-trash btn-outline-danger rounded-2 p-1"></i>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                        <br>
                    </div>--}}
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
</x-app-layout>
