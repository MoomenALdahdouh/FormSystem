<x-app-layout>
    <script type="text/javascript" src="{{asset('js/jquery-3.6.0.min.js')}}"></script>
    <x-slot name="header">
        <br>
        <h1 class="title-header font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View User') }}
            {{--<button class="btn btn-danger" style="float: right">{{ __('Create Project') }}</button>--}}
        </h1>
    </x-slot>
    <br>
    <div class="header-section">
        <div class="container">
            {{--User details header--}}
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-1">
                                    <img class="user-image" width="70" src="{{asset('images/user.png')}}">
                                </div>
                                <div class="col-10 row-2">
                                    <h5 class="name">{{$user->name}}</h5>
                                    @switch($user->type)
                                        @case(0)
                                        <p class="paragraph-admin shadow">&nbsp;Admin&nbsp;</p>
                                        @break
                                        @case (1)
                                        <p class="paragraph-manager shadow">Manager</p>
                                        @break
                                        @case (2)
                                        <p class="paragraph-worker shadow">&nbsp; Worker &nbsp;</p>
                                        @break
                                    @endswitch
                                    @switch($user->staus)
                                        @case (0)
                                        <p class="paragraph-pended shadow">Pended</p>
                                        @break
                                        @case(1)
                                        <p class="paragraph-active shadow">&nbsp;Active&nbsp;</p>
                                        @break
                                    @endswitch
                                </div>
                                <div class="col-1 row-3">
                                    <a href="{{url('/users/edit/'.$user->id.'#edit-user')}}"><i
                                            class="lar la-edit btn-outline-primary sm:rounded-md"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{--User details--}}
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="container">
                            <ul class="ul-project">
                                <br>
                                <li>
                                    <div class="alert alert-secondary">
                                        <strong><i
                                                class="las la-audio-description text-primary"></i>Nickname
                                        </strong>
                                        <br>
                                        @if ($user->nickname === '' || $user->nickname === NULL)
                                            <p>&nbsp &nbsp no nickname ...</p>
                                        @else
                                            <p>&nbsp &nbsp {{$user->nickname}}</p>
                                        @endif
                                    </div>
                                </li>
                                <li>
                                    <div class="alert alert-secondary">
                                        <strong><i class="las la-user-tie text-primary"></i>Email
                                        </strong>
                                        <br>
                                        <p> &nbsp &nbsp {{$user->email}}</p>
                                        <strong><i class="las la-user-tie text-primary"></i>Phone
                                        </strong>
                                        <br>
                                        @if($user->phone==''||$user->phone==NULL)
                                            <p> &nbsp &nbsp no phone ...</p>
                                        @else
                                            <p> &nbsp &nbsp {{@$user->phone}}</p>
                                        @endif
                                    </div>
                                </li>
                                <li>
                                    <div class="alert alert-secondary">
                                        <div class="">
                                            <strong><i class="las la-calendar-check text-primary"></i>Created At
                                            </strong>
                                            <br>
                                            <p>&nbsp &nbsp {{$user->created_at}}</p>
                                        </div>
                                        <div class="">
                                            <strong><i class="las la-clock text-primary"></i></i>&nbspUpdate At
                                            </strong>
                                            <br>
                                            <p>&nbsp &nbsp {{$user->updated_at}}</p>
                                        </div>
                                    </div>

                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 alert alert-dark">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-11">
                                    <strong><i class="las la-calendar-check text-primary"></i>Account Type</strong>
                                </div>
                                <div class="col-md-1">
                                    @switch($user->type)
                                        @case(0)
                                        <p class="paragraph-admin shadow">&nbsp;Admin&nbsp;</p>
                                        @break
                                        @case (1)
                                        <p class="paragraph-manager shadow">Manager</p>
                                        @break
                                        @case (2)
                                        <p class="paragraph-worker shadow">Worker</p>
                                        @break
                                    @endswitch
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-11">
                                    <strong><i class="las la-calendar-check text-primary"></i>Status</strong>
                                </div>
                                <div class="col-md-1">
                                    @switch($user->staus)
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
            <br>
            {{--Section user, Here list all activites for all user as his type--}}
            <div class="col-md-12">
                {{--First step check the user type--}}
                @switch($user->type)
                    {{--Admin--}}
                    @case(0)
                    <div class="card shadow">
                        <div class="card-header alert alert-secondary">
                            <strong><i class="las la-user-tie"></i>&nbsp;Admin Projects List</strong>
                        </div>
                        <div class="card-body">
                            @include('pagination_projects')
                        </div>
                    </div>
                    <br>
                    <div class="card shadow">
                        <div class="card-header alert alert-secondary">
                            <strong><i class="las la-user-tie"></i>&nbsp;Admin Subprojects List</strong>
                        </div>
                        <div class="card-body">
                            <div id="table-subprojects" class="card-body">
                                @include('pagination_subproject2')
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="card shadow">
                        <div class="card-header alert alert-secondary">
                            <strong><i class="las la-user-tag"></i>&nbsp;Admin Activities List</strong>
                        </div>
                        <div class="card-body">
                            <div id="table-activities" class="card-body">
                                @include('pagination_activities2')
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="card shadow">
                        <div class="card-header alert alert-secondary">
                            <strong><i class="las la-user-tag"></i>&nbsp;Admin Users List</strong>
                        </div>
                        <div class="card-body">
                            @include('pagination_users')
                        </div>
                    </div>

                    @break
                    {{--Manager--}}
                    @case(1)
                    <div class="card shadow">
                        <div class="card-header alert alert-secondary">
                            <strong><i class="las la-user-cog"></i>&nbsp;Manager Projects List</strong>
                        </div>
                        <div class="card-body">
                            @include('pagination_projects')
                        </div>
                    </div>
                    <br>
                    <div class="card shadow">
                        <div class="card-header alert alert-secondary">
                            <strong><i class="las la-user-cog"></i>&nbsp;Manager Subprojects List</strong>
                        </div>
                        <div class="card-body">
                            @include('pagination_subproject2')
                        </div>
                    </div>
                    <br>
                    <div class="card shadow">
                        <div class="card-header alert alert-secondary">
                            <strong><i class="las la-user-tag"></i>&nbsp;Manager Activities List</strong>
                        </div>
                        <div class="card-body">
                            <div id="table-activities" class="card-body">
                                @include('pagination_activities2')
                            </div>
                        </div>
                    </div>
                    @break
                    {{--Worker--}}
                    @case(2)
                    <div class="card shadow">
                        <div class="card-header alert alert-secondary">
                            <strong><i class="las la-user-tag"></i>&nbsp;Worker Activities List</strong>
                        </div>
                        <div class="card-body">
                            <div id="table-activities" class="card-body">
                                @include('pagination_activities2')
                            </div>
                        </div>
                    </div>

                    @break
                @endswitch

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
