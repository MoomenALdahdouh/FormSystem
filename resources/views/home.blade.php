<x-app-layout>
    <x-slot name="header_2">
        <br>
        <div class="row">
            <div class="col-md-11">
                <h1 class="home-section font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('strings.home') }}
                    {{--<h3>{{__('strings.welcome')}}</h3>--}}
                </h1>
            </div>
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

    {{--//TODO:: MOOMEN S. ALDAHDOUH 11/15/2021--}}
    <br>
    <div class="header-section">
        <div class="container">
            {{--<h1>Admin Dashboard</h1>--}}
            <div class=" row section-one">
                <div class="col-sm-12 col-md-4 col-lg-4 col-one">
                    <ul class="main-ul">
                        <li>
                            <ul class="group-one">
                                <li class="list-one">
                                    {{--Larapex chart--}}
                                    <div class="pt-3">
                                        {!! $chart->container() !!}
                                    </div>
                                    <br>
                                    <br>
                                </li>
                                <li class="list-item-two">
                                    <div class="row">
                                        <div class="h-75 card-style-1 col-sm-6 col-md-6 col-lg-6  ">
                                            <i class='icon-size bx bx-folder'></i>
                                            <div class="mr-5">
                                                <p>{{__('strings.projects')}}</p>
                                                <p>{{count($projects)}}</p>
                                            </div>
                                        </div>
                                        <div class="h-75 card-style-2 col-sm-6 col-md-6 col-lg-6  ">
                                            <i class='icon-size bx bx-file'></i>
                                            <p>{{__('strings.subprojects')}}</p>
                                            <p>{{count($subprojects)}}</p>

                                        </div>
                                        <div class="card-style-3 col-sm-6 col-md-6 col-lg-6  ">
                                            <i class='icon-size bx bxl-react'></i>
                                            <p>{{__('strings.activities')}}</p>
                                            <p>{{count($activities)}}</p>

                                        </div>
                                        <div class="card-style-4 col-sm-6 col-md-6 col-lg-6  ">
                                            <i class="icon-size lab la-wpforms"></i>
                                            <p>{{__('strings.forms')}}</p>
                                            <p>{{count($forms)}}</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <br>
                        <li class="col-one-second-list">
                            <ul class="col-two-group-one">
                                <li>
                                    <p>
                                        <i class="lab la-wpforms"></i>&nbsp;<strong>{{__('strings.latest_projects')}}</strong>
                                    </p>
                                </li>
                                <div>
                                    @foreach($latestProjects as $form)
                                        <li class="m-3">
                                            <div class="row">
                                                <div class="col-1">
                                                    @php
                                                        $date=date_create($form->created_at);

                                                    @endphp
                                                    <strong>{{date_format($date,"H:i")}}</strong>
                                                </div>
                                                <div class="col-2">
                                                    &nbsp;&nbsp;<i class="size-icon fa fa-genderless text-warning"></i>
                                                </div>
                                                <div class="col-9">
                                                    {{$form->name}}
                                                </div>
                                            </div>
                                            {{-- <p><span class=" paragraph--span">&nbsp;&nbsp;</span></p>--}}
                                        </li>
                                    @endforeach
                                </div>
                            </ul>
                        </li>
                        </li>
                    </ul>

                </div>
                {{--Latest form submitions--}}
                <div class="col-sm-12 col-md-8 col-lg-8 col-one">
                    <div class="row">
                        <div class="col-sm-6 col-md-6 col-lg-6 col-two">
                            <ul class="col-two-group-one">
                                <li>
                                    <p>
                                        <i class="lab la-wpforms"></i>&nbsp;<strong>{{__('strings.latest_forms')}}</strong>
                                    </p>
                                </li>
                                <div>
                                    @foreach($latestActivities as $form)
                                        <li class="m-3">
                                            <div class="row">
                                                <div class="col-1">
                                                    @php
                                                        $date=date_create($form->created_at);

                                                    @endphp
                                                    <strong>{{date_format($date,"H:i")}}</strong>
                                                </div>
                                                <div class="col-2">
                                                    &nbsp;<i class="size-icon fa fa-genderless text-warning"></i>
                                                </div>
                                                <div class="col-9">
                                                    {{$form->name}}
                                                </div>
                                            </div>
                                            {{-- <p><span class=" paragraph--span">&nbsp;&nbsp;</span></p>--}}
                                        </li>
                                    @endforeach
                                </div>
                            </ul>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6 col-three">
                            <ul class="col-two-group-one">
                                <li>
                                    <p><i class="las la-user"></i>&nbsp;<strong>{{__('strings.latest_users')}}</strong>
                                    </p>
                                </li>
                                {{--@for ($i = 0; $i < 3; $i++)
                                @endfor--}}
                                @foreach($latestUsers as $user)
                                    <li class="mt-2">
                                        <div class="row">
                                            <div class="col-1">
                                                @if($user->status == 0)
                                                    <span class=" paragraph-pended shadow">{{__('strings.p')}}</span>
                                                @else
                                                    <span class=" paragraph-active shadow">{{__('strings.a')}}</span>
                                                @endif
                                            </div>
                                            <div class="col-7 text-left">
                                                <p>&nbsp;&nbsp;{{$user->name}}</p>
                                            </div>
                                            <div class="col-4">
                                                @switch($user->type)
                                                    @case(0)
                                                    <span
                                                        class="hint paragraph-admin shadow">{{__('strings.admin')}}</span>
                                                    @break
                                                    @case (1)
                                                    <span
                                                        class="hint paragraph-manager shadow">{{__('strings.manager')}}</span>
                                                    @break
                                                    @case (2)
                                                    <span
                                                        class="hint paragraph-worker shadow">{{__('strings.worker')}}</span>
                                                    @break
                                                @endswitch
                                            </div>

                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <ul class="form-chart">
                            <li>
                                {!! $formChart->container() !!}
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
            <br>
            <br>
        </div>
    </div>
    {{--Forms table--}}
    <div class="header-section">
        <div class="container">
            <div class="row section-tow">
                <p class="mt-3"><i class='bx bxl-react'></i>&nbsp;<strong>{{__('strings.forms_activity')}}</strong></p>
                <div class="col-md-12">
                    <div class="table-responsive" style="padding: 30px">
                        <table id="interviews-table" class="text-center table table-bordered table-striped"
                               style="width: 100%; padding-top: 30px;margin-bottom: 15px">
                            <thead class="">
                            <tr>
                                <th>{{__('strings.sl_no')}}</th>
                                <th>{{__('strings.title')}}</th>
                                <th>{{__('strings.location')}}</th>
                                <th>{{__('strings.created_at')}}</th>
                                <th>{{__('strings.action')}}</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ $chart->cdn() }}"></script>
    <script src="{{ $formChart->cdn() }}"></script>
    {{ $chart->script() }}
    {{ $formChart->script() }}
    @include('modal_alert')
    @push('js')
        <script src="{{asset('js/interview.js')}}" defer></script> {{--Must add defer to active js file--}}
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
</x-app-layout>

