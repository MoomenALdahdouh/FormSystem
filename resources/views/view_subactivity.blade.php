<x-app-layout>
    {{--<script type="text/javascript" src="{{asset('js/jquery-3.6.0.min.js')}}"></script>--}}
    <x-slot name="header_2">
        <br>
        <div class="row">
            <div class="col-md-11">
                <h1 class="pt-1 home-section font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('strings.view_subactivity') }}
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
        <input id="subactivity_id" type="hidden" value="{{$activity->id}}">
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
                                            <p class="paragraph-manager shadow">&nbsp;{{ __('strings.subactivity') }}&nbsp;</p>
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
                                            <p class="">&nbsp; &nbsp; {{ __('strings.subactivity') }}</p>
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
                    {{--Section View Subactivity Forms --}}
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card shadow">
                                <div class="card-header">
                                    <h6 class="mt-2 mb-2">SubActivity Forms</h6>
                                </div>
                                <div class="bg-white overflow-hidden shadow-xl ">
                                    <div class="table-responsive" style="padding: 30px">
                                        <table id="subactivity_form-table"
                                               class="text-center table table-bordered table-striped"
                                               style="width: 100%; padding-top: 30px;margin-bottom: 15px">
                                            <thead class="text-light hint" style="background-color: #525256;">
                                            <tr>
                                                <th>{{ __('strings.sl_no') }}</th>
                                                <th>{{ __('strings.name') }}</th>
                                                <th>{{ __('strings.created_at') }}</th>
                                                <th>{{ __('strings.status') }}</th>
                                                <th>{{ __('strings.action') }}</th>
                                            </tr>
                                            </thead>
                                        </table>
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
                        <div class="text-center">
                            <img class="user-image" width="80" src="{{asset('images/user.png')}}">
                            <p class="hint">{{ __('strings.worker_name') }}</p>
                            <p><strong>{{$activity->worker->name}}</strong>
                                <a href="{{url('/users/view/'.$activity->worker->id)}}"><i
                                            class="las la-external-link-square-alt btn-outline-primary rounded-2 p-1"></i></a>
                            </p>
                            <p>
                                @if($activity->worker->status == 1)
                                    <strong class=" paragraph-active shadow">{{ __('strings.active') }}</strong>
                                @else
                                    <strong class=" paragraph-pended shadow">{{ __('strings.pended') }}</strong>
                                @endif
                            </p>
                        </div>
                        <br>
                    </div>--}}
                </div>
            </div>
        </div>
        @include('modal_alert')
        @push('js')
            <script src="{{asset('js/view_subactivity.js')}}" defer></script> {{--Must add defer to active js file--}}
        @endpush
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
