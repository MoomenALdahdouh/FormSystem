<x-app-layout>
    <script type="text/javascript" src="{{asset('js/jquery-3.6.0.min.js')}}"></script>
    <x-slot name="header">
        <h2 class="title-header font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View activity') }}
            {{--<button class="btn btn-danger" style="float: right">{{ __('Create Project') }}</button>--}}
        </h2>
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
                <div class="col-md-8">
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
                                    <div class="col-1 row-3">
                                        <a href="{{url('/activities/edit/'.$activity->id.'#edit-activity')}}"><i
                                                class="lar la-edit btn-outline-primary sm:rounded-md"></i></a>
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
                                    <li>
                                        <div class="alert alert-secondary">
                                            <strong><i
                                                    class="las la-audio-description text-primary"></i>Name
                                            </strong>
                                            <br>
                                            @if ($activity->name === '' || $activity->name === NULL)
                                                <p>&nbsp &nbsp no name ...</p>
                                            @else
                                                <p>&nbsp &nbsp {{$activity->name}}</p>
                                            @endif
                                        </div>
                                    </li>
                                    <li>
                                        <div class="alert alert-secondary">
                                            <strong><i class="las la-activity-tie text-primary"></i>Description
                                            </strong>
                                            <br>
                                            <p> &nbsp &nbsp {{$activity->description}}</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="alert alert-secondary">
                                            <div class="">
                                                <strong><i class="las la-calendar-check text-primary"></i>Created At
                                                </strong>
                                                <br>
                                                <p>&nbsp &nbsp {{$activity->created_at}}</p>
                                            </div>
                                            <div class="">
                                                <strong><i class="las la-clock text-primary"></i></i>&nbspUpdate At
                                                </strong>
                                                <br>
                                                <p>&nbsp &nbsp {{$activity->updated_at}}</p>
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
                                        <strong><i class="lab la-wpforms"></i>&nbsp View Form Questions</strong>
                                    </div>
                                    <div class="col-md-2">
                                        <a href="{{url("/form/edit/0")}}" class="btn btn-success float-right">View</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                </div>
                {{--Sub project and Manager details--}}
                <div class="col-md-4">
                    <div class="card shadow">
                        <div class="card-header">
                            <br>
                            <div class="row">
                                <div class="col-sm-1">
                                    <i class='bx bx-file' style="font-size: 30px; line-height: 60px"></i>
                                </div>
                                <div class="col-sm-11">
                                    <p class="hint">Subproject</p>
                                    <p class="paragraph-active shadow float-right">
                                        @if($activity->subproject->status == 1)
                                            Active
                                        @else
                                            Pended
                                        @endif
                                    </p>
                                    <p><strong>{{$activity->subproject->name}}</strong>
                                        <a href="{{url('/subprojects/view/'.$activity->subproject->id)}}"><i
                                                class="las la-external-link-square-alt btn-outline-primary sm:rounded-md"></i></a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow">
                        <br>
                        <div class="text-center">
                            <img class="user-image" width="80" src="{{asset('images/user.png')}}">
                            <p class="hint">worker name</p>
                            <p><strong>{{$activity->worker->name}}</strong>
                                <a href="{{url('/users/view/'.$activity->worker->id)}}"><i
                                        class="las la-external-link-square-alt btn-outline-primary sm:rounded-md"></i></a>
                            </p>
                            <p class="paragraph-active shadow">
                                @if($activity->worker->status == 1)
                                    Active
                                @else
                                    Pended
                                @endif
                            </p>
                        </div>
                        <br>
                    </div>
                </div>
            </div>

            {{--<br>
            <div class="col-md-12 alert alert-dark text-dark">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-11">
                                    <strong><i class="las la-calendar-check text-primary"></i>Activity Type</strong>
                                </div>
                                <div class="col-md-1">
                                    @switch($activity->type)
                                        @case(0)
                                        <p class="paragraph-admin shadow">&nbsp;Form&nbsp;</p>
                                        @break
                                        @case (1)
                                        <p class="paragraph-manager shadow">Activity</p>
                                        @break
                                        @case (2)
                                        <p class="paragraph-worker shadow">&nbsp; Activity &nbsp;</p>
                                        @break
                                    @endswitch
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-11">
                                    <strong><i class="las la-calendar-check text-primary"></i>Status</strong>
                                </div>
                                <div class="col-md-1">
                                    @switch($activity->staus)
                                        @case (0)
                                        <p class="paragraph-pended shadow">Pended</p>
                                        @break
                                        @case(1)
                                        <p class="paragraph-active shadow">&nbsp;Active&nbsp;</p>
                                        @break
                                    @endswitch
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>--}}
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
