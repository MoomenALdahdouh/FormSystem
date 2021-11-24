<x-app-layout>
    <script type="text/javascript" src="{{asset('js/jquery-3.6.0.min.js')}}"></script>
    <x-slot name="header">
        <h2 class="title-header font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit User') }}
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
                                    <a href="{{url('/users/view/'.$user->id)}}"><i
                                            class="las la-binoculars btn-outline-primary sm:rounded-md"></i></a>
                                </div>

                                <div class="alert alert-light">
                                    <div class="alert alert-secondary">
                                        <strong><i class="las la-user-tie text-primary"></i>Email
                                        </strong>
                                        <br>
                                        <p> &nbsp &nbsp {{$user->email}}</p>
                                        <strong><i class="las la-phone text-primary"></i>Phone
                                        </strong>
                                        <br>
                                        @if($user->phone==''||$user->phone==NULL)
                                            <p> &nbsp &nbsp no phone ...</p>
                                        @else
                                            <p> &nbsp &nbsp {{@$user->phone}}</p>
                                        @endif
                                    </div>
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{--User edit--}}
            <br id="edit-user">
            <br>
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-header alert alert-secondary">
                        <h4><i class="las la-pen-square"></i>Edit</h4>
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <ul class="ul-project">
                                <li>
                                    <div class="">
                                        <strong><i
                                                class="las la-signature text-primary"></i>Name
                                        </strong>
                                        &nbsp &nbsp<input class="rounded-md col-md-12 alert alert-secondary"
                                                          id="name" type="text" value="{{$user->name}}">
                                    </div>
                                    <div class="">
                                        <strong>
                                            <i class="las la-signature text-primary"></i>Nickname
                                        </strong>
                                        @if ($user->nickname === '' || $user->nickname === NULL)
                                            &nbsp &nbsp<input class="rounded-md col-md-12 alert alert-secondary"
                                                              type="text" value="no nickname ...">
                                        @else
                                            &nbsp &nbsp<input class="rounded-md col-md-12 alert alert-secondary"
                                                              type="text" value="{{$user->nickname}}">
                                        @endif
                                    </div>
                                    <div class="">
                                        <strong>
                                            <i class="las la-phone text-primary"></i>Phone
                                        </strong>
                                        @if ($user->phone === '' || $user->phone === NULL)
                                            &nbsp &nbsp<input class="rounded-md col-md-12 alert alert-secondary"
                                                              type="text" value="no nickname ...">
                                        @else
                                            &nbsp &nbsp<input class="rounded-md col-md-12 alert alert-secondary"
                                                              type="text" value="{{$user->phone}}">
                                        @endif
                                    </div>
                                </li>
                                <li>
                                    <strong><i class="las la-toggle-off text-primary"></i>&nbspStatus</strong>
                                    <br>
                                    <div class="row alert alert-secondary"
                                         style=" margin: 0; padding-left:0; padding-right: 0">
                                        <div class="col-md-11">
                                            @if($user->status == 1)
                                                <strong id="status-project"
                                                        class=" paragraph-active shadow">Active</strong>
                                            @else
                                                <strong id="status-project"
                                                        class=" paragraph-pended shadow">Pended</strong>
                                            @endif
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-check form-switch">
                                                @if($user->status == 1)
                                                    <input class="form-check-input" type="checkbox"
                                                           id="flexSwitchCheckChecked" value="1" checked>
                                                @else
                                                    <input class="form-check-input" type="checkbox"
                                                           id="flexSwitchCheckChecked" value="0">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <br>
                                <br>
                                <li>
                                    <button id="update-project" class="btn btn-primary float-right"><i
                                            class="lar la-save"></i> Save
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            {{--Section Remove project--}}
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="row alert alert-danger text-dark"
                             style=" margin: 0; padding-left:0; padding-right: 0">
                            <div class="col-md-10">
                                <strong><i class="las la-trash"></i>&nbsp Remove this user! you
                                    can not restore it.</strong>
                            </div>
                            <div class="col-md-2">
                                <button id="remove-project" class="btn btn-danger float-right">Remove Now</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>

        </div>
        <script>
            $(function () {
                $(document).ready(function () {
                    $("#name").focus();
                });
            });
        </script>
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
