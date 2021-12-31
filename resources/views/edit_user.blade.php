<x-app-layout>
    {{--<script type="text/javascript" src="{{asset('js/jquery-3.6.0.min.js')}}"></script>--}}
    <x-slot name="header_2">
        <br>
        <div class="row">
            <div class="col-md-11">
                <h1 class="pt-1 home-section font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('strings.edit_user') }}
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
                                        <p class="paragraph-admin shadow">{{__('strings.admin')}}</p>
                                        @break
                                        @case (1)
                                        <p class="paragraph-manager shadow">{{__('strings.manager')}}</p>
                                        @break
                                        @case (2)
                                        <p class="paragraph-worker shadow">{{__('strings.worker')}}</p>
                                        @break
                                    @endswitch
                                    @switch($user->staus)
                                        @case (0)
                                        <p class="paragraph-pended shadow">{{__('strings.pended')}}</p>
                                        @break
                                        @case(1)
                                        <p class="paragraph-active shadow">&nbsp;{{__('strings.active')}}&nbsp;</p>
                                        @break
                                    @endswitch
                                </div>
                                <div class="col-1 row-3">
                                    <a href="{{url('/users/view/'.$user->id)}}"><i
                                            class="las la-binoculars btn-outline-primary rounded-2 p-1"></i></a>
                                </div>

                                <div class="alert alert-light">
                                    <div class="alert alert-secondary">
                                        <strong><i class="las la-user-tie text-primary"></i>{{__('strings.email')}}
                                        </strong>
                                        <br>
                                        <p> &nbsp &nbsp {{$user->email}}</p>
                                        <strong><i class="las la-phone text-primary"></i>{{__('strings.phone')}}
                                        </strong>
                                        <br>
                                        @if($user->phone==''||$user->phone==NULL)
                                            <p> &nbsp; &nbsp; {{__('strings.no_phone')}}</p>
                                        @else
                                            <p> &nbsp; &nbsp; {{@$user->phone}}</p>
                                        @endif
                                    </div>
                                    <div class="alert alert-secondary">
                                        <div class="">
                                            <strong><i
                                                    class="las la-calendar-check text-primary"></i>{{__('strings.created_at')}}
                                            </strong>
                                            <br>
                                            <p>&nbsp; &nbsp; {{$user->created_at}}</p>
                                        </div>
                                        <div class="">
                                            <strong><i
                                                    class="las la-clock text-primary"></i></i>&nbsp;{{__('strings.update_at')}}
                                            </strong>
                                            <br>
                                            <p>&nbsp; &nbsp; {{$user->updated_at}}</p>
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
                        <h4><i class="las la-pen-square"></i>{{__('strings.edit')}}</h4>
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <ul class="ul-project">
                                <li>
                                    <input type="hidden" id="user-id" name="user-id"
                                           value="{{$user->id}}">
                                    <div class="">
                                        <strong><i
                                                class="las la-signature text-primary"></i>{{__('strings.name')}}
                                        </strong>
                                        &nbsp; &nbsp;<input class="rounded-md col-md-12 alert alert-secondary"
                                                            id="name" type="text" value="{{$user->name}}">
                                    </div>
                                    <div class="">
                                        <strong>
                                            <i class="las la-signature text-primary"></i>{{__('strings.nickname')}}
                                        </strong>
                                        @if ($user->nickname === '' || $user->nickname === NULL)
                                            &nbsp; &nbsp;<input class="rounded-md col-md-12 alert alert-secondary"
                                                                id="nickname" type="text" value="no nickname ...">
                                        @else
                                            &nbsp; &nbsp;<input class="rounded-md col-md-12 alert alert-secondary"
                                                                id="nickname" type="text" value="{{$user->nickname}}">
                                        @endif
                                    </div>
                                    <div class="">
                                        <strong>
                                            <i class="las la-phone text-primary"></i>{{__('strings.phone')}}
                                        </strong>
                                        @if ($user->phone === '' || $user->phone === NULL)
                                            &nbsp; &nbsp;<input class="rounded-md col-md-12 alert alert-secondary"
                                                                id="phone" type="text"
                                                                value="{{__('strings.no_phone')}}">
                                        @else
                                            &nbsp; &nbsp;<input class="rounded-md col-md-12 alert alert-secondary"
                                                                id="phone" type="text" value="{{$user->phone}}">
                                        @endif
                                    </div>
                                </li>
                                <li>
                                    <strong><i class="las la-toggle-off text-primary"></i>&nbsp;{{__('strings.status')}}
                                    </strong>
                                    <br>
                                    <div class="row alert alert-secondary"
                                         style=" margin: 0; padding-left:0; padding-right: 0">
                                        <div class="col-md-11">
                                            @if($user->status == 1)
                                                <strong id="status-user"
                                                        class=" paragraph-active shadow">{{__('strings.active')}}</strong>
                                            @else
                                                <strong id="status-user"
                                                        class=" paragraph-pended shadow">{{__('strings.pended')}}</strong>
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
                                    <button id="update-user" class="btn btn-primary float-right"><i
                                            class="lar la-save"></i> {{__('strings.save')}}
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
                                <strong><i class="las la-trash"></i>&nbsp; {{__('strings.remove_user')}}</strong>
                            </div>
                            <div class="col-md-2">
                                <button id="remove-user"
                                        class="btn btn-danger float-right">{{__('strings.remove_now')}}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
        </div>
        <input type="hidden" value="0" id="is_user_page">
    </div>
    @include('modal_alert')
    @push('js')
        <script src="{{asset('js/user.js')}}" defer></script> {{--Must add defer to active js file--}}
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
</x-app-layout>
